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


            $ruc = $fila[2]; // Ahora el RUC está en la posición 2 (fila 3), ajusta según tu estructura

            // Verificar si el RUC ya existe en la tabla empresas
            $existe_ruc = $conexion->query("SELECT COUNT(*) as total FROM empresas WHERE ruc = '$ruc'");
            $fila_existe = $existe_ruc->fetch_assoc();

            if ($fila_existe['total'] > 0) {
                // Si el RUC ya existe, realizar una actualización
                $sql = "UPDATE empresas SET
                    origen = '{$fila[0]}',
                    tipo_emp = '{$fila[1]}',
                    empleador = '{$fila[3]}',
                    direccion = '{$fila[4]}',
                    dpto = '{$fila[5]}',
                    prov = '{$fila[6]}',
                    dist = '{$fila[7]}',
                    f_inic_act = '{$fila[8]}',
                    f_baja_act = '{$fila[9]}',
                    rep_legal = '{$fila[10]}',
                    dni_a = '{$fila[11]}',
                    f_inicio_a = '{$fila[12]}',
                    otro_representante = '{$fila[13]}',
                    dni_b = '{$fila[14]}',
                    f_inicio_b = '{$fila[15]}',
                    estado_emp = '{$fila[16]}',
                    habido_emp = '{$fila[17]}',
                    fech_modi = now()
                    WHERE ruc = '$ruc'";
            } else {
                // Si el RUC no existe, realizar una inserción
                $sql = "INSERT INTO empresas (
                    id, 
                    ind, 
                    origen, 
                    tipo_emp, 
                    ruc, 
                    empleador, 
                    direccion, 
                    dpto, 
                    prov, 
                    dist, 
                    f_inic_act, 
                    f_baja_act, 
                    rep_legal, 
                    dni_a, 
                    f_inicio_a, 
                    otro_representante, 
                    dni_b, 
                    f_inicio_b, 
                    imprimir, 
                    estado_emp, 
                    habido_emp, 
                    fech_crea, 
                    fech_modi, 
                    fech_elim, 
                    est
                ) VALUES (
                    NULL,
                    'R',
                    '{$fila[0]}', 
                    '{$fila[1]}',
                    '{$fila[2]}',
                    '{$fila[3]}',
                    '{$fila[4]}',
                    '{$fila[5]}',
                    '{$fila[6]}',
                    '{$fila[7]}',
                    '{$fila[8]}',
                    '{$fila[9]}',
                    '{$fila[10]}',
                    '{$fila[11]}',
                    '{$fila[12]}',
                    '{$fila[13]}',
                    '{$fila[14]}',
                    '{$fila[15]}',
                    'IMPRIMIR',
                    '{$fila[16]}',
                    '{$fila[17]}',
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
