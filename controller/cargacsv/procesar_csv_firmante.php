<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha subido un archivo
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
        // Obtener la información del archivo
        $archivo_temporal = $_FILES["archivo"]["tmp_name"];

        // Leer el contenido del archivo CSV con punto y coma como delimitador
        $datos_csv = array_map(function($linea) {
            return str_getcsv($linea, ';');
        }, file($archivo_temporal));

        // Conectar a tu base de datos (ajusta estos detalles según tu configuración)
        $conexion = new mysqli("localhost", "root", "", "seguros3_mvc");

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión a la base de datos: " . $conexion->connect_error);
        }

        // Iterar sobre los datos y realizar la inserción o actualización en la base de datos
        foreach ($datos_csv as $fila) {
            $dni = $fila[2]; // Ahora el RUC está en la posición 2 (fila 3), ajusta según tu estructura
            $ruc = $fila[0];

            // Verificar si el RUC ya existe en la tabla empresas
            $existe_ruc = $conexion->query("SELECT COUNT(*) as total FROM firmantes WHERE dni = '$dni' AND ruc = '$ruc'");
            $fila_existe = $existe_ruc->fetch_assoc();

            if ($fila_existe['total'] > 0) {
                // Si el RUC ya existe, realizar una actualización
                $sql = "UPDATE firmantes SET
                    ruc = '{$fila[0]}',
                    firma_nombre = '{$fila[1]}',
                    id_cargo = '{$fila[3]}',
                    fech_inicio = '{$fila[4]}',
                    fech_fin = '{$fila[5]}',
                    estado = '{$fila[6]}',
                    fecha_f = '{$fila[7]}'
                    WHERE dni = '$dni'";
            } else {
                // Si el RUC no existe, realizar una inserción
                $sql = "INSERT INTO firmantes (
                    id, 
                    ruc, 
                    firma_nombre, 
                    dni, 
                    id_cargo, 
                    fech_inicio, 
                    fech_fin, 
                    estado, 
                    fecha_f, 
                    fech_crea, 
                    fech_modi, 
                    fech_elim, 
                    est
                    
                ) VALUES (
                    NULL,
                    '{$fila[0]}',
                    '{$fila[1]}',
                    '{$fila[2]}',
                    '{$fila[3]}',
                    '{$fila[4]}',
                    '{$fila[5]}',
                    '{$fila[6]}',
                    '{$fila[7]}',
                    now(),
                    NULL,
                    NULL,
                    '1'
                )";
            }

            // Ejecutar la consulta
            $resultado = $conexion->query($sql);

            // Verificar si la operación fue exitosa
            if (!$resultado) {
                echo "Error en la operación: " . $conexion->error;
            }
        }

        // Cerrar la conexión
        $conexion->close();

        echo "Datos insertados/actualizados correctamente.";
    } else {
        echo "Error al cargar el archivo.";
    }
}
?>
