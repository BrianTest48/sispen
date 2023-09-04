<?php 
    require_once("../config/conexion.php");
    require_once("../models/Salario.php");

    $salario = new Salario();

    switch($_GET["op"]){
        case 'listar' :
            $datos = $salario->get_salario();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["desde"];
                $sub_array[] = $row["hasta"];
                $sub_array[] = $row["unidad_moneda"];
                $sub_array[] = $row["sueldo_minimo"];
                $sub_array[] = $row["at_ss"];
                $sub_array[] = $row["at_pro_desocup"];
                $sub_array[] = $row["at_fondo_juvi"];
                $sub_array[] = $row["ap_ss"];
                $sub_array[] = $row["ap_fondo_juvi"];
                $sub_array[] = $row["ap_fonavi"];
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
            $datos=$salario->get_salario_x_id($_POST["sal_id"]);
            if(empty($_POST["sal_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $salario->insert_salario($_POST["sal_f_inicio"], $_POST["sal_f_final"],$_POST["sal_moneda"],$_POST["sal_minimo"],$_POST["sal_ss_ap_tra"],$_POST["sal_fonavi_ap_tra"],$_POST["sal_p_ap_tra"],$_POST["sal_ss_ap_pat"],$_POST["sal_p_ap_pat"],$_POST["sal_fonavi_ap_pat"]);  
                }
            }else{
                $salario->update_salario($_POST["sal_id"], $_POST["sal_f_inicio"],$_POST["sal_f_final"],$_POST["sal_moneda"],$_POST["sal_minimo"],$_POST["sal_ss_ap_tra"],$_POST["sal_fonavi_ap_tra"],$_POST["sal_p_ap_tra"],$_POST["sal_ss_ap_pat"],$_POST["sal_p_ap_pat"],$_POST["sal_fonavi_ap_pat"]);  
            }
            
            break;
            
        case 'mostrar' :
            $datos=$salario->get_salario_x_id($_POST["sal_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["sal_id"] = $row["id"];
                    $output["sal_f_inicio"] = $row["desde"];
                    $output["sal_f_final"] = $row["hasta"];
                    $output["sal_moneda"] = $row["unidad_moneda"];
                    $output["sal_minimo"] = $row["sueldo_minimo"];
                    $output["sal_ss_ap_tra"] = $row["at_ss"];
                    $output["sal_fonavi_ap_tra"] = $row["at_pro_desocup"];
                    $output["sal_p_ap_tra"] = $row["at_fondo_juvi"];
                    $output["sal_ss_ap_pat"] = $row["ap_ss"];
                    $output["sal_p_ap_pat"] = $row["ap_fondo_juvi"];
                    $output["sal_fonavi_ap_pat"] = $row["ap_fonavi"];
                }
                echo json_encode($output);
            }
            break;
        
        case 'eliminar':
            $salario->delete_salario($_POST["sal_id"]);
            break;
    }
?>