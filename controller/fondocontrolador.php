<?php 
    require_once("../config/conexion.php");
    require_once("../models/Fondo.php");

    session_start();

    $fondo = new Fondo();

    switch ($_GET["op"]) {
        case 'listar' :
            $datos = $fondo->get_fondos();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["nombre"];
                if(empty($row["imagen"])){
                    $sub_array[] = '<img src="../../assets/no-fotos.png" width="100px" height="100px">';
                }else {
                    $sub_array[] = '<img src="../../assets/img/'.$row["imagen"].'" width="100px" height="100px">';
                }
                $sub_array[] = '<button type="button" onClick="editar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            
            break;
        
        case 'guardaryeditar':
            $datos1=$fondo->get_fondo_x_id($_POST["logo_id"]);
            if(empty($_POST["logo_id"])){
                if(is_array($datos1)==true and count($datos1)==0){

                    if(empty($_FILES['file']['name'])){

                        $datos = $fondo->insert_fondo($_POST["logo_nom"],'');

                        echo("GUARDADO SIN IMAGEN");
                    }else {
                        $datos = $fondo->insert_fondo($_POST["logo_nom"], $_FILES['file']['name'][0]);
                        foreach($datos as $row){

                            //$countfiles = count($_FILES['file']['name']);
                            $ruta = "../assets/img/";
                            //$files_array = array();

                            if(!file_exists($ruta)){
                                mkdir($ruta, 0777, true);
                            }

                            $nombre = $_FILES['file']['tmp_name'][0];
                            $destino = $ruta.$_FILES['file']['name'][0];
                            
                            move_uploaded_file($nombre, $destino);

                        }
                    }

                    echo json_encode($datos);

                }
            }else{

                $archivo = $datos1[0]["imagen"];
                //$imagen = $_FILES['file']['name'][0];
                echo("AQUI ESTA VACIO");
                echo($archivo);
                //echo($datos1[0]["logo_nom"]);

                if(empty($archivo)){
                //if($archivo == ''){
                    if(empty($_FILES['file']['name'][0])){
                        $fondo->update_fondo($_POST["logo_id"], $_POST["logo_nom"],'');
                    }
                    else {
                        $fondo->update_fondo($_POST["logo_id"], $_POST["logo_nom"],$_FILES['file']['name'][0]);

                        //mover la imagen
                        $ruta = "../assets/img/";
        
                        if(!file_exists($ruta)){
                            mkdir($ruta, 0777, true);
                        }

                        $nombre = $_FILES['file']['tmp_name'][0];
                        $destino = $ruta.$_FILES['file']['name'][0];
                        
                        move_uploaded_file($nombre, $destino);
                        echo ("Imagen Insertada");
                    }
  
                }else {

                    if(empty($_FILES['file']['name'][0])){

                        $fondo->update_fondo($_POST["logo_id"], $_POST["logo_nom"], $archivo);

                    }else {
                        $fondo->update_fondo($_POST["logo_id"], $_POST["logo_nom"], $_FILES['file']['name'][0]);
        
                        //Insertar el nuevo valor
                        $ruta = "../assets/img/";
    
                        if(!file_exists($ruta)){
                            mkdir($ruta, 0777, true);
                        }
    
                        $nombre = $_FILES['file']['tmp_name'][0];
                        $destino = $ruta.$_FILES['file']['name'][0];
                        
                        move_uploaded_file($nombre, $destino);
                        echo ("Archivo Eliminado Para Editar");
                    }

                    
                }
            }
            
            break;

        case 'mostrar':
            $datos=$fondo->get_fondo_x_id($_POST["logo_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["logo_id"] = $row["id"];
                    $output["logo_nom"] = $row["nombre"];
                    $output["imagen"] = $row["imagen"];
                    $output["logo_estado"] = $row["estado"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':

            $datos=$fondo->get_fondo_x_id($_POST["logo_id"]);

            $archivo = $datos[0]["imagen"];

            echo($datos[0]["logo_nom"]);
           
            if ($archivo=='') {

            }else {
                If (unlink("../assets/img/".$archivo)) {
                    echo ("Archivo Eliminado");
                } else {
                    echo ("No se elimino el Archivo");
                }
            }

            $fondo->delete_fondo($_POST["logo_id"]);
            break; 

        case 'combo':

            $datos = $fondo->get_fondos_nombre();
            if(is_array($datos)==true and count($datos)>0){
                $html ="<option label='Seleccione'></option>";
                foreach($datos as $row) {
                    //$html.= "<option value='".$row["id"]."' data-img-src= '../../assets/img/".$row["imagen"]."'></option>";
                    //$html.= "<option data-image='../../assets/img/".$row["imagen"]."' value='".$row["id"]."'></option>";
                    $html.= "<option value='".$row["imagen"]."'>".$row["nombre"]."</option>";
                }
                echo $html;
            }
        break;
}
?>