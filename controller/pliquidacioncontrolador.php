<?php 
    require_once("../config/conexion.php");
    require_once("../models/Pliquidacion.php");

    session_start();

    $pliqui = new Pliquidacion();

    switch ($_GET["op"]) {
        case 'listar' :
            $datos = $pliqui->get_pliquidacion();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["nombre"];
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
            $datos=$pliqui->get_pliquidacion_x_id($_POST["liqui_id"]);
            if(empty($_POST["liqui_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $pliqui->insert_pliquidacion($_POST["liqui_nom"], $_POST["liqui_desc"]);
                }
            }else{
                $pliqui->update_pliquidacion($_POST["liqui_id"], $_POST["liqui_nom"], $_POST["liqui_desc"]);
            
            }
            
            break;

        case 'mostrar':
            $datos=$pliqui->get_pliquidacion_x_id($_POST["liqui_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["liqui_id"] = $row["id"];
                    $output["liqui_nom"] = $row["nombre"];
                    $output["liqui_desc"] = $row["descripcion"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':
            $pliqui->delete_pliquidacion($_POST["liqui_id"]);
            break; 
//falta realizar combo
        case "combo" :

            $datos = $cargo->get_id_nombre_cargos();
            if(is_array($datos)==true and count($datos)>0){
                $html ="<option label='Seleccione' ></option>";
                //$html="";
                foreach($datos as $row) {
                    $html.= "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
                }
                echo $html;
            }
            break;

        
        
    }
?>