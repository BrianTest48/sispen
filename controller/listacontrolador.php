<?php 
    require_once("../config/conexion.php");
    require_once("../models/Lista.php");

    $lista = new Lista();

    switch($_GET["op"]){

        case 'listar' :
            $datos = $lista->get_lista();
            $data = Array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["nombres"];
                $sub_array[] = $row["ap_pa"];
                $sub_array[] = $row["num_doc"];
                $sub_array[] = $row["cantidad"];
                $sub_array[] = $row["tipo"];
                $sub_array[] = $row["fech_crea"];
                $sub_array[] = $row["fech_modi"];
                $sub_array[] = $row["fech1"];
                $sub_array[] = $row["fech_final_1"];
                $sub_array[] = $row["ruc1"];
                $sub_array[] = $row["cargo1"];
                $sub_array[] = $row["firmante1"];
                $sub_array[] = $row["logo1"];
                $sub_array[] = $row["fech2"];
                $sub_array[] = $row["fech_final_2"];
                $sub_array[] = $row["ruc2"];
                $sub_array[] = $row["cargo2"];
                $sub_array[] = $row["firmante2"];
                $sub_array[] = $row["logo2"];
                $sub_array[] = $row["fech3"];
                $sub_array[] = $row["fech_final_3"];
                $sub_array[] = $row["ruc3"];
                $sub_array[] = $row["cargo3"];
                $sub_array[] = $row["firmante3"];
                $sub_array[] = $row["logo3"];
                $sub_array[] = $row["fech4"];
                $sub_array[] = $row["fech_final_4"];
                $sub_array[] = $row["ruc4"];
                $sub_array[] = $row["cargo4"];
                $sub_array[] = $row["firmante4"];
                $sub_array[] = $row["logo4"];
                $sub_array[] = $row["fech5"];
                $sub_array[] = $row["fech_final_5"];
                $sub_array[] = $row["ruc5"];
                $sub_array[] = $row["cargo5"];
                $sub_array[] = $row["firmante5"];
                $sub_array[] = $row["logo5"];
                $sub_array[] = '<center><button type="button" onClick="editar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-primary btn-icon mg-r-5"><div><i class="fa fa-edit"></i></div></button>
                                <button type="button" onClick="eliminar('.$row["id"].');"  id="'.$row["id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button></center>';
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
            $datos=$lista->get_lista_x_doc($_POST["documento"], $_POST["lista"]);
            //validar si los POST estan vacios
            $af_id = isset($_POST["af_id"]) ? $_POST["af_id"] : '';
            $documento = isset($_POST["documento"]) ? $_POST["documento"] : '';
            $txtcant_emp = isset($_POST["txtcant_emp"]) ? $_POST["txtcant_emp"] : '';
            $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : '';
            $txtdate = isset($_POST["txtdate"]) ? $_POST["txtdate"] : '';

            $f_inicio_1 = isset($_POST["f_inicio_1"]) ? $_POST["f_inicio_1"] : '';
            $f_final_1 = isset($_POST["f_final_1"]) ? $_POST["f_final_1"] : '';
            $tipo_1 = isset($_POST["tipo_1"]) ? $_POST["tipo_1"] : '';
            $base_1 = isset($_POST["base_1"]) ? $_POST["base_1"] : '';
            $estado_1 = isset($_POST["estado_1"]) ? $_POST["estado_1"] : '';
            $condicion_1 = isset($_POST["condicion_1"]) ? $_POST["condicion_1"] : '';
            $ruc_emp1 = isset($_POST["ruc_emp1"]) ? $_POST["ruc_emp1"] : '';
            $cargoc1 = isset($_POST["cargoc1"]) ? $_POST["cargoc1"] : '';
            $firmante1 = isset($_POST["firmante1"]) ? $_POST["firmante1"] : '';
            $logo1 = isset($_POST["logo1"]) ? $_POST["logo1"] : '';

            $f_inicio_2 = isset($_POST["f_inicio_2"]) ? $_POST["f_inicio_2"] : '';
            $f_final_2 = isset($_POST["f_final_2"]) ? $_POST["f_final_2"] : '';
            $tipo_2 = isset($_POST["tipo_2"]) ? $_POST["tipo_2"] : '';
            $base_2 = isset($_POST["base_2"]) ? $_POST["base_2"] : '';
            $estado_2 = isset($_POST["estado_2"]) ? $_POST["estado_2"] : '';
            $condicion_2 = isset($_POST["condicion_2"]) ? $_POST["condicion_2"] : '';
            $ruc_emp2 = isset($_POST["ruc_emp2"]) ? $_POST["ruc_emp2"] : '';
            $cargoc2 = isset($_POST["cargoc2"]) ? $_POST["cargoc2"] : '';
            $firmante2 = isset($_POST["firmante2"]) ? $_POST["firmante2"] : '';
            $logo2 = isset($_POST["logo2"]) ? $_POST["logo2"] : '';

            $f_inicio_3 = isset($_POST["f_inicio_3"]) ? $_POST["f_inicio_3"] : '';
            $f_final_3 = isset($_POST["f_final_3"]) ? $_POST["f_final_3"] : '';
            $tipo_3 = isset($_POST["tipo_3"]) ? $_POST["tipo_3"] : '';
            $base_3 = isset($_POST["base_3"]) ? $_POST["base_3"] : '';
            $estado_3 = isset($_POST["estado_3"]) ? $_POST["estado_3"] : '';
            $condicion_3 = isset($_POST["condicion_3"]) ? $_POST["condicion_3"] : '';
            $ruc_emp3 = isset($_POST["ruc_emp3"]) ? $_POST["ruc_emp3"] : '';
            $cargoc3 = isset($_POST["cargoc3"]) ? $_POST["cargoc3"] : '';
            $firmante3 = isset($_POST["firmante3"]) ? $_POST["firmante3"] : '';
            $logo3 = isset($_POST["logo3"]) ? $_POST["logo3"] : '';

            $f_inicio_4 = isset($_POST["f_inicio_4"]) ? $_POST["f_inicio_4"] : '';
            $f_final_4 = isset($_POST["f_final_4"]) ? $_POST["f_final_4"] : '';
            $tipo_4 = isset($_POST["tipo_4"]) ? $_POST["tipo_4"] : '';
            $base_4 = isset($_POST["base_4"]) ? $_POST["base_4"] : '';
            $estado_4 = isset($_POST["estado_4"]) ? $_POST["estado_4"] : '';
            $condicion_4 = isset($_POST["condicion_4"]) ? $_POST["condicion_4"] : '';
            $ruc_emp4 = isset($_POST["ruc_emp4"]) ? $_POST["ruc_emp4"] : '';
            $cargoc4 = isset($_POST["cargoc4"]) ? $_POST["cargoc4"] : '';
            $firmante4 = isset($_POST["firmante4"]) ? $_POST["firmante4"] : '';
            $logo4 = isset($_POST["logo4"]) ? $_POST["logo4"] : '';

            $f_inicio_5 = isset($_POST["f_inicio_5"]) ? $_POST["f_inicio_5"] : '';
            $f_final_5 = isset($_POST["f_final_5"]) ? $_POST["f_final_5"] : '';
            $tipo_5 = isset($_POST["tipo_5"]) ? $_POST["tipo_5"] : '';
            $base_5 = isset($_POST["base_5"]) ? $_POST["base_5"] : '';
            $estado_5 = isset($_POST["estado_5"]) ? $_POST["estado_5"] : '';
            $condicion_5 = isset($_POST["condicion_5"]) ? $_POST["condicion_5"] : '';
            $ruc_emp5 = isset($_POST["ruc_emp5"]) ? $_POST["ruc_emp5"] : '';
            $cargoc5 = isset($_POST["cargoc5"]) ? $_POST["cargoc5"] : '';
            $firmante5 = isset($_POST["firmante5"]) ? $_POST["firmante5"] : '';
            $logo5 = isset($_POST["logo5"]) ? $_POST["logo5"] : '';

            $lista_id = isset($_POST["lista"]) ? $_POST["lista"] : '';


            if(empty($_POST["lista"])){
                if(is_array($datos)==true and count($datos)==0){

                    $datos_lt = $lista->insert_lista_pension($af_id, $documento, $txtcant_emp, $tipo, $txtdate, 
                        $f_inicio_1, $f_final_1, $tipo_1, $base_1, $estado_1, $condicion_1, $ruc_emp1, $cargoc1, $firmante1, $logo1,
                        $f_inicio_2, $f_final_2, $tipo_2, $base_2, $estado_2, $condicion_2, $ruc_emp2, $cargoc2, $firmante2, $logo2,
                        $f_inicio_3, $f_final_3, $tipo_3, $base_3, $estado_3, $condicion_3, $ruc_emp3, $cargoc3, $firmante3, $logo3,
                        $f_inicio_4, $f_final_4, $tipo_4, $base_4, $estado_4, $condicion_4, $ruc_emp4, $cargoc4, $firmante4, $logo4,
                        $f_inicio_5, $f_final_5, $tipo_5, $base_5, $estado_5, $condicion_5, $ruc_emp5, $cargoc5, $firmante5, $logo5,
                    );
                    //echo(1);
                    $result = $datos_lt[0]["id"];
                    echo $result;
                }
            }else{
                $lista->update_lista_pension($af_id, $documento, $txtcant_emp, $tipo, $txtdate, 
                        $f_inicio_1, $f_final_1, $tipo_1, $base_1, $estado_1, $condicion_1, $ruc_emp1, $cargoc1, $firmante1, $logo1,
                        $f_inicio_2, $f_final_2, $tipo_2, $base_2, $estado_2, $condicion_2, $ruc_emp2, $cargoc2, $firmante2, $logo2,
                        $f_inicio_3, $f_final_3, $tipo_3, $base_3, $estado_3, $condicion_3, $ruc_emp3, $cargoc3, $firmante3, $logo3,
                        $f_inicio_4, $f_final_4, $tipo_4, $base_4, $estado_4, $condicion_4, $ruc_emp4, $cargoc4, $firmante4, $logo4,
                        $f_inicio_5, $f_final_5, $tipo_5, $base_5, $estado_5, $condicion_5, $ruc_emp5, $cargoc5, $firmante5, $logo5, $lista_id
                    );
               
                echo $lista_id;
            }
            
            break;
        
        case 'mostrar':
            $datos=$lista->get_lista_x_doc($_POST["num_doc"], $_POST["lista"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["id"] = $row["id"];
                    $output["id_afiliado"] = $row["id_afiliado"];
                    $output["num_doc"] = $row["num_doc"];
                    $output["cantidad"] = $row["cantidad"];
                    $output["tipo"] = $row["tipo"];
                    $output["fech_nac"] = $row["fech_nac"];
                    $output["fech1"] = $row["fech1"];
                    $output["fech_final_1"] = $row["fech_final_1"];
                    $output["tipo_1"] = $row["tipo_1"];
                    $output["base_1"] = $row["base_1"];
                    $output["estado_1"] = $row["estado_1"];
                    $output["condicion_1"] = $row["condicion_1"];
                    $output["ruc1"] = $row["ruc1"];
                    $output["cargo1"] = $row["cargo1"];
                    $output["firmante1"] = $row["firmante1"];
                    $output["logo1"] = $row["logo1"];  
                    $output["fech2"] = $row["fech2"];
                    $output["fech_final_2"] = $row["fech_final_2"];
                    $output["tipo_2"] = $row["tipo_2"];
                    $output["base_2"] = $row["base_2"];
                    $output["estado_2"] = $row["estado_2"];
                    $output["condicion_2"] = $row["condicion_2"];
                    $output["ruc2"] = $row["ruc2"];
                    $output["cargo2"] = $row["cargo2"];
                    $output["firmante2"] = $row["firmante2"];
                    $output["logo2"] = $row["logo2"]; 
                    $output["fech3"] = $row["fech3"];
                    $output["fech_final_3"] = $row["fech_final_3"];
                    $output["tipo_3"] = $row["tipo_3"];
                    $output["base_3"] = $row["base_3"];
                    $output["estado_3"] = $row["estado_3"];
                    $output["condicion_3"] = $row["condicion_3"];
                    $output["ruc3"] = $row["ruc3"];
                    $output["cargo3"] = $row["cargo3"];
                    $output["firmante3"] = $row["firmante3"];
                    $output["logo3"] = $row["logo3"];   
                    $output["fech4"] = $row["fech4"];
                    $output["fech_final_4"] = $row["fech_final_4"];
                    $output["tipo_4"] = $row["tipo_4"];
                    $output["base_4"] = $row["base_4"];
                    $output["estado_4"] = $row["estado_4"];
                    $output["condicion_4"] = $row["condicion_4"];
                    $output["ruc4"] = $row["ruc4"];
                    $output["cargo4"] = $row["cargo4"];
                    $output["firmante4"] = $row["firmante4"];
                    $output["logo4"] = $row["logo4"];   
                    $output["fech5"] = $row["fech5"];
                    $output["fech_final_5"] = $row["fech_final_5"];
                    $output["tipo_5"] = $row["tipo_5"];
                    $output["base_5"] = $row["base_5"];
                    $output["estado_5"] = $row["estado_5"];
                    $output["condicion_5"] = $row["condicion_5"];
                    $output["ruc5"] = $row["ruc5"];
                    $output["cargo5"] = $row["cargo5"];
                    $output["firmante5"] = $row["firmante5"];
                    $output["logo5"] = $row["logo5"];   
                }
                echo json_encode($output);
            }
            break;
    
        case 'mostrar_id':
            $datos=$lista->get_lista_x_id($_POST["lista_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["id"] = $row["id"];
                    $output["id_afiliado"] = $row["id_afiliado"];
                    $output["tipo_doc"] = $row["tipo_doc"];
                    $output["nombres"] = $row["nombres"];
                    $output["ap_pa"] = $row["ap_pa"];
                    $output["num_doc"] = $row["num_doc"];
                    $output["cantidad"] = $row["cantidad"];
                    $output["tipo"] = $row["tipo"];
                    $output["fech_nac"] = $row["fech_nac"];
                    $output["fech1"] = $row["fech1"];
                    $output["fech_final_1"] = $row["fech_final_1"];
                    $output["tipo_1"] = $row["tipo_1"];
                    $output["base_1"] = $row["base_1"];
                    $output["estado_1"] = $row["estado_1"];
                    $output["condicion_1"] = $row["condicion_1"];
                    $output["ruc1"] = $row["ruc1"];
                    $output["cargo1"] = $row["cargo1"];
                    $output["firmante1"] = $row["firmante1"];
                    $output["logo1"] = $row["logo1"];  
                    $output["fech2"] = $row["fech2"];
                    $output["fech_final_2"] = $row["fech_final_2"];
                    $output["tipo_2"] = $row["tipo_2"];
                    $output["base_2"] = $row["base_2"];
                    $output["estado_2"] = $row["estado_2"];
                    $output["condicion_2"] = $row["condicion_2"];
                    $output["ruc2"] = $row["ruc2"];
                    $output["cargo2"] = $row["cargo2"];
                    $output["firmante2"] = $row["firmante2"];
                    $output["logo2"] = $row["logo2"]; 
                    $output["fech3"] = $row["fech3"];
                    $output["fech_final_3"] = $row["fech_final_3"];
                    $output["tipo_3"] = $row["tipo_3"];
                    $output["base_3"] = $row["base_3"];
                    $output["estado_3"] = $row["estado_3"];
                    $output["condicion_3"] = $row["condicion_3"];
                    $output["ruc3"] = $row["ruc3"];
                    $output["cargo3"] = $row["cargo3"];
                    $output["firmante3"] = $row["firmante3"];
                    $output["logo3"] = $row["logo3"];   
                    $output["fech4"] = $row["fech4"];
                    $output["fech_final_4"] = $row["fech_final_4"];
                    $output["tipo_4"] = $row["tipo_4"];
                    $output["base_4"] = $row["base_4"];
                    $output["estado_4"] = $row["estado_4"];
                    $output["condicion_4"] = $row["condicion_4"];
                    $output["ruc4"] = $row["ruc4"];
                    $output["cargo4"] = $row["cargo4"];
                    $output["firmante4"] = $row["firmante4"];
                    $output["logo4"] = $row["logo4"];   
                    $output["fech5"] = $row["fech5"];
                    $output["fech_final_5"] = $row["fech_final_5"];
                    $output["tipo_5"] = $row["tipo_5"];
                    $output["base_5"] = $row["base_5"];
                    $output["estado_5"] = $row["estado_5"];
                    $output["condicion_5"] = $row["condicion_5"];
                    $output["ruc5"] = $row["ruc5"];
                    $output["cargo5"] = $row["cargo5"];
                    $output["firmante5"] = $row["firmante5"];
                    $output["logo5"] = $row["logo5"];   
                }
                echo json_encode($output);
            }
            break;
        case 'eliminar':
            $lista->delete_lista($_POST["lista_id"]);
            break; 

    }
?>