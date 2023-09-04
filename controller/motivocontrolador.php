<?php 
    require_once("../config/conexion.php");
    require_once("../models/Motivo.php");

    session_start();

    $motivo = new Motivo();

    switch ($_GET["op"]) {
        case 'listar' :
            $datos = $motivo->get_motivos();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["descripcion"];
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
            $datos=$motivo->get_motivo_x_id($_POST["motivo_id"]);
            if(empty($_POST["motivo_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $motivo->insert_motivo($_POST["motivo_desc"]);
                }
            }else{
                $motivo->update_motivo($_POST["motivo_id"], $_POST["motivo_desc"]);
            
            }
            
            break;

        case 'mostrar':
            $datos=$motivo->get_motivo_x_id($_POST["motivo_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["motivo_id"] = $row["id"];
                    $output["motivo_desc"] = $row["descripcion"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':
            $cargo->delete_motivo($_POST["motivo_id"]);
            break; 

        case "combo" :
            $datos = $motivo->get_motivos();
            if(is_array($datos)==true and count($datos)>0){
                $html ="<option label='Seleccione' ></option>";
                //$html="";
                foreach($datos as $row) {
                    $html.= "<option value='".$row["id"]."'>".$row["descripcion"]."</option>";
                }
                echo $html;
            }
            break;
        
    }
?>