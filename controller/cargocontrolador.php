<?php 
    require_once("../config/conexion.php");
    require_once("../models/Cargo.php");

    session_start();

    $cargo = new Cargo();

    switch ($_GET["op"]) {
        case 'listar' :
            $datos = $cargo->get_cargos();
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
            $datos=$cargo->get_cargo_x_id($_POST["cargo_id"]);
            if(empty($_POST["cargo_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $cargo->insert_cargo($_POST["cargo_nom"], $_POST["cargo_desc"]);
                }
            }else{
                $cargo->update_cargo($_POST["cargo_id"], $_POST["cargo_nom"], $_POST["cargo_desc"]);
            
            }
            
            break;

        case 'mostrar':
            $datos=$cargo->get_cargo_x_id($_POST["cargo_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["cargo_id"] = $row["id"];
                    $output["cargo_nom"] = $row["nombre"];
                    $output["cargo_desc"] = $row["descripcion"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':
            $cargo->delete_cargo($_POST["cargo_id"]);
            break; 

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

        case "comborpt" :

            $datos = $cargo->get_id_nombre_cargos();
            if(is_array($datos)==true and count($datos)>0){
                $html ="<option label='Seleccione' ></option><option value=' '>SIN CARGO</option>";
                foreach($datos as $row) {
                    $html.= "<option value='".$row["nombre"]."'>".$row["nombre"]."</option>";
                }
                echo $html;
            }
            break;
        
        
    }
?>