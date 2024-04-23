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
            $ruc = $fila[0]; // Ahora el RUC está en la posición 2 (fila 3), ajusta según tu estructura
            $direc = $fila[1];

            // Verificar si el RUC ya existe en la tabla empresas
            $existe_ruc = $conexion->query("SELECT COUNT(*) as total FROM direccion WHERE ruc = '$ruc' AND direccion = '$direc'");
            $fila_existe = $existe_ruc->fetch_assoc();

            if ($fila_existe['total'] > 0) {
                // Si el RUC ya existe, realizar una actualización
                $sql = "UPDATE direccion SET
                    ruc = '{$fila[0]}',
                    departamento = '{$fila[2]}',
                    provincia = '{$fila[3]}',
                    distrito = '{$fila[4]}'
                    WHERE direccion = '$direc'";
            } else {
                // Si el RUC no existe, realizar una inserción
                $sql = "INSERT INTO direccion (
                    id_dir, 
                    ruc, 
                    direccion, 
                    departamento, 
                    provincia, 
                    distrito
                    
                ) VALUES (
                    NULL,
                    '{$fila[0]}',
                    '{$fila[1]}',
                    '{$fila[2]}',
                    '{$fila[3]}',
                    '{$fila[4]}'
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
