<?php 
    require_once("../config/conexion.php");
    require_once("../models/Empresa.php");

    $empresa = new Empresa();

    switch($_GET["op"]){
        case 'listar' :
            $datos = $empresa->get_empresa();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["ind"];
                $sub_array[] = $row["tipo_emp"];
                $sub_array[] = $row["ruc"];
                $sub_array[] = $row["empleador"];
                $sub_array[] = $row["direccion"];
                $sub_array[] = $row["dpto"];
                $sub_array[] = $row["prov"];
                $sub_array[] = $row["dist"];
                $sub_array[] = $row["f_inic_act"];
                $sub_array[] = $row["f_baja_act"];
                $sub_array[] = $row["rep_legal"];
                $sub_array[] = $row["dni_a"];
                $sub_array[] = $row["f_inicio_a"];
                $sub_array[] = $row["otro_representante"];
                $sub_array[] = $row["dni_b"];
                $sub_array[] = $row["f_inicio_b"];
                $sub_array[] = $row["imprimir"];
                $sub_array[] = $row["fech_crea"];
                $sub_array[] = $row["fech_modi"];
                $sub_array[] = $row["fech_elim"];
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
            $datos=$empresa->get_empresa_x_id($_POST["emp_id"]);
            if(empty($_POST["emp_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    if($_POST["emp_seg_rep"] == ""  and $_POST["emp_dni_seg_rep"] == "" ){
                        $empresa->insert_empresa($_POST["emp_tipo"], $_POST["emp_ruc"],$_POST["emp_razonsocial"],$_POST["emp_direccion"],$_POST["emp_dpto"],$_POST["emp_prov"],$_POST["emp_dist"],$_POST["emp_ini_act"],$_POST["emp_fin_act"],$_POST["emp_rep_legal"],$_POST["emp_dni"], $_POST["emp_fech_rep_legal"],'NO REGISTR','NO REGISTR', $_POST["emp_fech_seg_rep_legal"]);
                        echo("SE GUARDO");
                    }else {
                        $empresa->insert_empresa($_POST["emp_tipo"], $_POST["emp_ruc"],$_POST["emp_razonsocial"],$_POST["emp_direccion"],$_POST["emp_dpto"],$_POST["emp_prov"],$_POST["emp_dist"],$_POST["emp_ini_act"],$_POST["emp_fin_act"],$_POST["emp_rep_legal"],$_POST["emp_dni"], $_POST["emp_fech_rep_legal"],$_POST["emp_seg_rep"],$_POST["emp_dni_seg_rep"], $_POST["emp_fech_seg_rep_legal"]);
                    } 
                }
            }else{
                $empresa->update_empresa($_POST["emp_id"],$_POST["emp_tipo"],$_POST["emp_ruc"],$_POST["emp_razonsocial"],$_POST["emp_direccion"],$_POST["emp_dpto"],$_POST["emp_prov"],$_POST["emp_dist"],$_POST["emp_ini_act"],$_POST["emp_fin_act"],$_POST["emp_rep_legal"],$_POST["emp_dni"], $_POST["emp_fech_rep_legal"],$_POST["emp_seg_rep"],$_POST["emp_dni_seg_rep"], $_POST["emp_fech_seg_rep_legal"]);
                echo json_encode($empresa);
            }
            
            break;
        
        case 'mostrar':
            $datos=$empresa->get_empresa_x_id($_POST["emp_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["id"] = $row["id"];
                    $output["tipo_emp"] = $row["tipo_emp"];
                    $output["ruc"] = $row["ruc"];
                    $output["empleador"] = $row["empleador"];
                    $output["direccion"] = $row["direccion"];
                    $output["dpto"] = $row["dpto"];
                    $output["prov"] = $row["prov"];
                    $output["dist"] = $row["dist"];
                    $output["f_inic_act"] = $row["f_inic_act"];
                    $output["f_baja_act"] = $row["f_baja_act"];
                    $output["rep_legal"] = $row["rep_legal"];
                    $output["dni_a"] = $row["dni_a"];
                    $output["f_inicio_a"] = $row["f_inicio_a"];
                    $output["otro_representante"] = $row["otro_representante"];
                    $output["dni_b"] = $row["dni_b"];
                    $output["f_inicio_b"] = $row["f_inicio_b"];
                }
                echo json_encode($output);
            }
            break;
        
        case 'rucempresa':
            $datos=$empresa->get_empresa_x_ruc($_POST["emp_ruc"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["empleador"] = $row["empleador"];
                }
                echo json_encode($output);
            }
            break;

        case 'combovigencia':
            $datos=$empresa->get_empresa_x_ruc($_POST["numero"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["ruc"] = $row["ruc"];
                    $output["f_inic_act"] = $row["f_inic_act"];
                    $output["f_baja_act"] = $row["f_baja_act"];
                }
                echo json_encode($output);
            }
            break;

        case 'eliminar':
            $empresa->delete_empresa($_POST["emp_id"]);
            break;

        case 'cargar_csv' :
                include 'procesar_csv.php'; // El nombre del script PHP que procesa la carga del CSV
                echo "se pudo";
            break;
        
    }
?>