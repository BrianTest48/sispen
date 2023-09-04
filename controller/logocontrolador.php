<?php 
    require_once("../config/conexion.php");
    require_once("../models/Logo.php");

    session_start();

    $logo = new Logo();

    switch ($_GET["op"]) {
        case 'listar' :
            $datos = $logo->get_logos();
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
                $sub_array[] = $row["est"];

                $sub_array[] = '<button type="button" onClick="vista('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-success btn-icon"><div><i class="fa fa-eye"></i></div></button>';
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
            $datos1=$logo->get_logo_x_id($_POST["logo_id"]);
            if(empty($_POST["logo_id"])){
                if(is_array($datos1)==true and count($datos1)==0){

                    if(empty($_FILES['file']['name'])){

                        $datos = $logo->insert_logo($_POST["logo_nom"],'', $_POST["logo_estado"]);

                        echo("GUARDADO SIN IMAGEN");
                    }else {
                        $datos = $logo->insert_logo($_POST["logo_nom"], $_FILES['file']['name'][0],  $_POST["logo_estado"]);
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
                echo($datos1[0]["logo_nom"]);

                if(empty($archivo)){
                //if($archivo == ''){
                    if(empty($_FILES['file']['name'][0])){
                        $logo->update_logo($_POST["logo_id"], $_POST["logo_nom"],'', $_POST["logo_estado"]);
                    }
                    else {
                        $logo->update_logo($_POST["logo_id"], $_POST["logo_nom"],$_FILES['file']['name'][0], $_POST["logo_estado"]);

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

                        $logo->update_logo($_POST["logo_id"], $_POST["logo_nom"], $archivo, $_POST["logo_estado"]);

                    }else {
                        If (unlink("../assets/img/".$archivo)) {

                            $logo->update_logo($_POST["logo_id"], $_POST["logo_nom"], $_FILES['file']['name'][0], $_POST["logo_estado"]);
        
                            //Insertar el nuevo valor
                            $ruta = "../assets/img/";
        
                            if(!file_exists($ruta)){
                                mkdir($ruta, 0777, true);
                            }
        
                            $nombre = $_FILES['file']['tmp_name'][0];
                            $destino = $ruta.$_FILES['file']['name'][0];
                            
                            move_uploaded_file($nombre, $destino);
                            echo ("Archivo Eliminado Para Editar");
        
                        } else {
                            echo ("No se elimino el Archivo");
                        }
                    }

                    
                }
            }
            
            break;

        case 'mostrar':
            $datos=$logo->get_logo_x_id($_POST["logo_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["logo_id"] = $row["id"];
                    $output["logo_nom"] = $row["nombre"];
                    $output["imagen"] = $row["imagen"];
                    $output["logo_estado"] = $row["est"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':

            $datos=$logo->get_logo_x_id($_POST["logo_id"]);

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

            $logo->delete_logo($_POST["logo_id"]);
            break; 

        case 'combo':

            $datos = $logo->get_logos_nombre();
            if(is_array($datos)==true and count($datos)>0){
                $html ="<option label='Seleccione'></option>";
                $html.="<option value='no-fotos.png'>SIN LOGO</option>";
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