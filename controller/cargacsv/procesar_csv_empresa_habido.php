<?php

ini_set('max_execution_time', 9000); 

function convertirFecha($fecha) {
    // Verificar si la fecha está en el formato "DD/MM/YYYY"
    if (preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $fecha)) {
        // Convertir a formato "YYYY-MM-DD"
        $partes = explode('/', $fecha);
        return $partes[2] . '-' . $partes[1] . '-' . $partes[0];
    } else {
        // Si la fecha ya está en el formato "YYYY-MM-DD", devolverla sin cambios
        return $fecha;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
        // Obtener la información del archivo
        $archivo_temporal = $_FILES["archivo"]["tmp_name"];

        // Leer el contenido del archivo CSV con punto y coma como delimitador
        $datos_csv = array_map(function ($linea) {
            return str_getcsv($linea, ';');
        }, file($archivo_temporal));

        // Conectar a tu base de datos -- local
        //$conexion = new mysqli("localhost", "root", "", "seguros3_mvc");

        // Conectar a tu base de datos -- PRODUCCTION
        $conexion = new mysqli("localhost", "c1911864_rootsp", "wacU2ZtV8lL9", "c1911864_sispen");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        foreach ($datos_csv as $fila) {
            // Eliminar espacios en blanco antes de validar la longitud del RUC
            $ruc = trim($fila[0]);

            // Validar que el RUC tenga exactamente 11 caracteres
            if (strlen($ruc) < 10) {
                echo "Error: : $ruc<br>";
                continue; // Pasar a la siguiente fila del CSV
            }

            // Convertir las fechas a formato "YYYY-MM-DD"
            $f_inic_act = convertirFecha($fila[1]);
            $f_baja_act = convertirFecha($fila[2]);
            $estado_emp = $fila[3];
            $habido_emp = $fila[4];
            
            // Preparar la consulta de actualización
            if (!empty($f_baja_act)) {
                $sql_update = "UPDATE empresas SET f_inic_act = '$f_inic_act', f_baja_act = '$f_baja_act', estado_emp = '$estado_emp', habido_emp = '$habido_emp' WHERE ruc = '$ruc'";
            } else {
                $sql_update = "UPDATE empresas SET f_inic_act = '$f_inic_act', f_baja_act = NULL, estado_emp = '$estado_emp', habido_emp = '$habido_emp' WHERE ruc = '$ruc'";
            }
        
            // Ejecutar la consulta de actualización
            if ($conexion->query($sql_update) === TRUE) {
                echo "OK :  $ruc. ";
            } else {
                echo "Error al actualizar datos para el RUC $ruc: " . $conexion->error . "<br>";
            }
        }

        // Cerrar la conexión
        $conexion->close();

        echo "Proceso de actualización completado.";
    } else {
        echo "Error al cargar el archivo.";
    }
}
