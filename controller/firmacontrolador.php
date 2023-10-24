<?php 
    require_once("../config/conexion.php");
    require_once("../models/Firmante.php");

    session_start();

    $firmante = new Firmante();

    switch ($_GET["op"]) {
        case 'listar' :
            $datos = $firmante->get_firmante();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["ruc"];
                $sub_array[] = $row["firma_nombre"];
                $sub_array[] = $row["dni"];
                $sub_array[] = $row["nombre"];
                $sub_array[] = $row["fech_inicio"];
                $sub_array[] = $row["fech_fin"];
                $sub_array[] = $row["estado"];
                $sub_array[] = $row["fecha_f"];
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
            $datos1=$firmante->get_firmante_x_id($_POST["firma_id"]);
            if(empty($_POST["firma_id"])){
                if(is_array($datos1)==true and count($datos1)==0){

                    $firmante->insert_firmante($_POST["firma_ruc"], $_POST["firma_nom"], $_POST["firma_dni"], $_POST["id_cargo"], $_POST["firma_f_inicio"], $_POST["firma_f_fin"], $_POST["firma_estado"], $_POST["firma_f_falle"]);
                }     
            }else {
                $firmante->update_firmante($_POST["firma_ruc"], $_POST["firma_id"], $_POST["firma_nom"], $_POST["firma_dni"], $_POST["id_cargo"], $_POST["firma_f_inicio"], $_POST["firma_f_fin"], $_POST["firma_estado"], $_POST["firma_f_falle"]);
            }
            
            break;

        case 'mostrar':
            $datos=$firmante->get_firmante_x_id($_POST["firma_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["firma_id"] = $row["id"];
                    $output["firma_ruc"] = $row["ruc"];
                    $output["firma_nom"] = $row["firma_nombre"];
                    $output["firma_dni"] = $row["dni"];
                    $output["id_cargo"] = $row["id_cargo"];
                    $output["fech_inicio"] = $row["fech_inicio"];
                    $output["fech_fin"] = $row["fech_fin"];
                    $output["estado"] = $row["estado"];
                    $output["fecha_falle"] = $row["fecha_f"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':

            $datos=$firmante->get_firmante_x_id($_POST["firma_id"]);

            $archivo = $datos[0]["imagen"];

            echo($datos[0]["firma_nom"]);
           
            if ($archivo=='') {

            }else {
                If (unlink("../assets/img/".$archivo)) {
                    echo ("Archivo Eliminado");
                } else {
                    echo ("No se elimino el Archivo");
                }
            }

            $firmante->delete_firmante($_POST["firma_id"]);
            break;

            
        case 'combo':
            $datos = $firmante->get_firmante_empresa($_POST["numero"]);
            if(is_array($datos)==true and count($datos)>0){
                
                $html="<option value='....................'>SIN FIRMANTE</option>";
                foreach($datos as $row) {
                    $html.= "<option value='".$row["firma_nombre"]."'>".$row["firma_nombre"]." / ".$row["fech_inicio"]." / ".$row["fech_fin"]." / ".$row["estado"]." / ".$row["fecha_f"]."</option>";
                    //$html.= "<option value='".$row["id"]."'>".$row["firma_nombre"]."<div>".$row["imagen"]."</div></option>";
                }
                echo $html;
            }else {
                $html="<option value='....................'>SIN FIRMANTE</option>";
                echo $html;
            }
        break;
    }
?>