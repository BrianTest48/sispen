<?php  

    require_once '../zipeaArchivo.php';

    date_default_timezone_set('America/Lima');

    $directorio = "../../files/";
    $directorio2 = "../../files/zips/";
    $fechaHoraActual = date('d-m-Y_H-i');
    //$nombre_carpeta = "zip_" . strtotime("now");
    $nombre_carpeta = $_POST["nombre_carpeta"];
    $nombre = $_POST["afiliado"];

    $creacion_carpeta = zipeaArchivo::crearCarpetaDown($directorio . $nombre_carpeta, $directorio2);


    echo json_encode( zipeaArchivo::zipearArchivo($directorio . $nombre_carpeta, $directorio2 ,$fechaHoraActual.'_'.$nombre_carpeta."-".$nombre.".zip") );


    

?>