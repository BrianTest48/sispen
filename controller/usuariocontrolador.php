<?php 
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");

    session_start();

    $usuario = new Usuario();

    switch ($_GET["op"]) {
        case 'listar' :
            $datos = $usuario->get_usuario();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["alias"];
                $sub_array[] = $row["nombres"];
                $sub_array[] = $row["apellidos"];
                $sub_array[] = $row["clave"];
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

        case 'ingresar':
            $datos = $usuario->loguear_usuario($_POST["alias"], $_POST["clave"]);
            if(is_array($datos) == true and count($datos) > 0){
                $_SESSION["id"] = $datos[0]["id"];
                $_SESSION["nombres"] = $datos[0]["nombres"];
                echo "1";
            }else{
                echo "0";
            }

            break;
        
        case 'guardaryeditar':
            $datos=$usuario->get_usuario_x_id($_POST["us_id"]);
            if(empty($_POST["us_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $usuario->insert_usuario($_POST["us_alias"], $_POST["us_nom"], $_POST["us_ape"], $_POST["us_pass"]);
                    //echo "".$_POST["us_alias"].",".$_POST["us_nom"].",".$_POST["us_ape"].",".$_POST["us_pass"];
                }
            }else{
                $usuario->update_usuario($_POST["us_id"], $_POST["us_alias"], $_POST["us_nom"], $_POST["us_ape"], $_POST["us_pass"]);
            }
            
            break;

        case 'mostrar':
            $datos=$usuario->get_usuario_x_id($_POST["us_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["us_id"] = $row["id"];
                    $output["us_alias"] = $row["alias"];
                    $output["us_nom"] = $row["nombres"];
                    $output["us_ape"] = $row["apellidos"];
                    $output["us_pass"] = $row["clave"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':
            $usuario->delete_usuario($_POST["us_id"]);
            break; 
    }
?>