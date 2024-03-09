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

        // Iterar sobre cada fila del CSV e insertar en la base de datos
        foreach ($datos_csv as $fila) {

            // Verificar si el RUC ya existe en la tabla
            $ruc = $fila[1]; // Índice 3 corresponde al RUC según el orden especificado
            $sql_check = "SELECT COUNT(*) AS count FROM empresas WHERE ruc = '$ruc'";
            $result = $conexion->query($sql_check);
            $row = $result->fetch_assoc();
            $count = $row['count'];

            if ($count == 0) {
                // Preparar la consulta de inserción
                $sql_insert = "INSERT INTO empresas (ind, origen, tipo_emp, ruc, empleador, f_inic_act, f_baja_act, estado_emp, habido_emp est) 
                               VALUES ('$fila[0]', '1', 'V', '$fila[1]', '$fila[2]', '$fila[3]', '$fila[4]','$fila[5]' ,'$fila[6]', '1')";

                // Ejecutar la consulta de inserción
                if ($conexion->query($sql_insert) !== TRUE) {
                    echo "Error al insertar datos: " . $conexion->error;
                }
            } else {
                echo "-"."$ruc";
            }
        }

        // Cerrar la conexión
        $conexion->close();

        echo "Datos insertados/actualizados correctamente.";
    } else {
        echo "Error al cargar el archivo.";
    }
}
