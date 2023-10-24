<?php  
    $tipo = $_POST["tipo"];

    switch ($tipo) {
        case 'P':
            # code...
            $archivos = [
                'certificado_p1.php',
                'certificado_p2.php',
                'certificado_p3.php',
                'certificado_p4.php',
                'certificado_p5.php',
                'certificado_p6.php',
                'certificado_p7.php',
                'certificado_p8.php'
            ];
            break;
        case 'M':
            $archivos = [
                'certificado_m1.php',
                'certificado_m2.php',
                'certificado_m3.php',
                'certificado_m4.php',
                'certificado_m5.php'
            ];
            break;
        case 'G':
            # code...
            break;
    }

    foreach ($archivos as $archivo) {
        require_once $archivo;
    }


    $directorio = "../../files/";
    //$nombre_carpeta = "zip_" . strtotime("now");
    $nombre_carpeta = $_POST["nombre_carpeta"];

    $creacion_carpeta = zipeaArchivo::crearCarpeta($directorio . $nombre_carpeta);


    echo json_encode( zipeaArchivo::zipearArchivo($directorio . $nombre_carpeta, $nombre_carpeta.".zip") );
?>