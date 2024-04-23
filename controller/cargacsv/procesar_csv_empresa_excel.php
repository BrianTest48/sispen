<?php

ini_set('max_execution_time', 900); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha subido un archivo
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
        // Obtener la información del archivo
        $archivo_temporal = $_FILES["archivo"]["tmp_name"];

        // Leer el contenido del archivo CSV con punto y coma como delimitador
        $datos_csv = array_map(function ($linea) {
            return str_getcsv($linea, ';');
        }, file($archivo_temporal));

        // Conectar a tu base de datos (ajusta estos detalles según tu configuración)
        $conexion = new mysqli("localhost", "root", "", "seguros3_mvc");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        foreach ($datos_csv as $fila) {

            // Verificar si el RUC ya existe en la tabla
            $ruc = $fila[1]; // Índice 3 corresponde al RUC según el orden especificado
            $sql_check = "SELECT COUNT(*) AS count FROM empresas WHERE ruc = '$ruc'";
            $result = $conexion->query($sql_check);
            $row = $result->fetch_assoc();
            $count = $row['count'];
        
            if ($count == 0) {
                // Preparar la consulta de inserción
                $sql_insert = "INSERT INTO empresas (ind, origen, tipo_emp, ruc, empleador, direccion, dpto, prov, dist, estado_emp, habido_emp, f_inic_act, f_baja_act, est) 
                               VALUES ('$fila[0]', '1', 'V', '$fila[1]', '$fila[2]', '$fila[3]', '$fila[4]','$fila[5]' ,'$fila[6]','$fila[7]','$fila[8]','$fila[9]','$fila[10]', '1')";
        
                // Ejecutar la consulta de inserción
                if ($conexion->query($sql_insert) !== TRUE) {
                    echo "Error al insertar datos: " . $conexion->error;
                }
            } else {
                // Preparar la consulta de actualización
                $sql_update = "UPDATE empresas SET ind = '$fila[0]', origen = '1', tipo_emp = 'V', empleador = '$fila[2]', direccion = '$fila[3]', dpto = '$fila[4]', prov = '$fila[5]', dist = '$fila[6]', estado_emp = '$fila[7]', habido_emp = '$fila[8]', f_inic_act = '$fila[9]', f_baja_act = '$fila[10]', est = '1' WHERE ruc = '$ruc'";
        
                // Ejecutar la consulta de actualización
                if ($conexion->query($sql_update) !== TRUE) {
                    echo "Error al actualizar datos: " . $conexion->error;
                }
            }
        }
        

        // Cerrar la conexión
        $conexion->close();

        echo "Datos insertados/actualizados correctamente.";
    } else {
        echo "Error al cargar el archivo.";
    }
}
