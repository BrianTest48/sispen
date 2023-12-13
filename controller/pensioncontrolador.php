<?php 
    require_once("../config/conexion.php");
    require_once("../models/Pension.php");
    require_once("../util/cantidad_en_letras.php");

    $pension = new Pension();
    $letras = new EnLetras();

    switch($_GET["op"]){
       
        case 'afiliado':
            if(empty($_POST["af_id"])){    
                $datos = $pension->insert_afiliado($_POST["tipo_doc"], $_POST["num_doc"], $_POST["txtnombre"], $_POST["txtapellido"], $_POST["txtdate"]);
                
                echo json_encode($datos);
            }else{
               
            }  
            break;
        case 'consulta_dni':
            $token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';
            //$dni    =   $_POST['dni'];
            $dni    =   $_POST['dni'];
            // Iniciar llamada a API
            $curl = curl_init();

            // Buscar dni
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                'Referer: https://apis.net.pe/consulta-dni-api',
                'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            // Datos listos para usar
            $persona = json_decode($response);
            echo json_encode($persona);
            break;

        case 'consulta_dni_nac' :  
            $token = '4e3080aa-3abb-4d69-b448-b556701a41c3';
            //$dni    =   $_POST['dni'];
            $dni    =   $_POST['dni'];
            // Iniciar llamada a API
            $curl = curl_init();

            // Buscar dni
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbyoBhxuklU5D3LTguTcYAS85klwFINHxxd-FroauC4CmFVvS0ua/exec?op=dni&token='.$token.'&formato=json&documento=' . $dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET'
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            // Datos listos para usar
            $persona = json_decode($response);
            echo json_encode($persona);
            break;
        case 'buscar':
            $datos = $pension->get_afiliado_x_tipo($_POST["tipo_doc"], $_POST["num_doc"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output['id'] = $row["id"];
                    $output["tipo_doc"] = $row["tipo_doc"];
                    $output["num_doc"] = $row["num_doc"];
                    $output["nombres"] = $row["nombres"];
                    $output["ap_pa"] = $row["ap_pa"];
                    $output["fech_nac"] = $row["fech_nac"];
                }
                echo json_encode($output);
            }
            break;
        
        case 'buscarEmpresas':
            $datos = $pension->get_lista_rptempresas($_POST["nroEmpresas"], $_POST["Fec_Nac"]);
            $data = Array();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array['ruc'] = $row["ruc"];
                    $sub_array['empleador'] = $row["empleador"];
                    $sub_array['fecha_inicio'] = $row["f_inic_act"];
                    $data[] = $sub_array;
                }
                echo json_encode($data);
            }
            break;
        
        case 'pensionaleatorioempresa':

            $datos = $pension->pension_aleatorio_empresa($_POST["txtdateinicio"], $_POST["txtdatefin"], $_POST["tipo"]);
            $data = Array();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array['tipo_emp'] = $row["tipo_emp"];
                    $sub_array['ruc'] = $row["ruc"];
                    $sub_array['empleador'] = $row["empleador"];
                    $sub_array['Anios'] = $row["Anios"];
                    $sub_array['Meses'] = $row["Meses"];
                    $sub_array['Dias'] = $row["Dias"];
                    $sub_array['fechsueldo'] = $row["fechsueldo"];
                    $sub_array['moneda_sueldo'] = $row["moneda_sueldo"];
                    $sub_array['moneda_rm'] = $row["moneda_rm"];
                    $sub_array['dpto'] = $row["dpto"];
                    $sub_array['rep_legal'] = $row["rep_legal"];
                    $sub_array['dni_a'] = $row["dni_a"];
                    $sub_array['f_inic_act'] = $row["f_inic_act"];
                    $sub_array['f_baja_act'] = $row["f_baja_act"];
                    $sub_array['estado_emp'] = $row["estado_emp"];
                    $sub_array['habido_emp'] = $row["habido_emp"];
                    /*$sub_array['at_ss_1'] = $row["at_ss_1"];
                    $sub_array['at_fondo_juvi_1'] = $row["at_fondo_juvi_1"];
                    $sub_array['at_pro_desocup_1'] = $row["at_pro_desocup_1"];
                    $sub_array['ap_ss_1'] = $row["ap_ss_1"];
                    $sub_array['ap_fondo_juvi_1'] = $row["ap_fondo_juvi_1"];
                    $sub_array['ap_fonavi_1'] = $row["ap_fonavi_1"];*/
                    $data[] = $sub_array;
                }
                echo json_encode($data);
            }

            break;
        case 'combo':
            $datos = $pension->pension_aleatorio_empresa($_POST["txtdateinicio"], $_POST["txtdatefin"], $_POST["tipo"]);
            if(is_array($datos)==true and count($datos)>0){
                //$html ="<option value='0' label='Seleccione' ></option>";
                $html="";
                foreach($datos as $row) {
                    //$html.= "<option value='".$row["empleador"]."'>".$row["empleador"]."</option>";
                    $html.= "<option value='".$row["ruc"]."'>".$row["empleador"]."</option>";
                }
                echo $html;
            }
            break;
            
        case 'buscardpto':

            $datos = $pension->pension_empresa_dpto($_POST["txtdateinicio"], $_POST["txtdatefin"],$_POST["txtrazon"]);
            $data = Array();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array['tipo_emp'] = $row["tipo_emp"];
                    $sub_array['ruc'] = $row["ruc"];
                    $sub_array['empleador'] = $row["empleador"];
                    $sub_array['Anios'] = $row["Anios"];
                    $sub_array['Meses'] = $row["Meses"];
                    $sub_array['Dias'] = $row["Dias"];
                    $sub_array['fechsueldo'] = $row["fechsueldo"];
                    $sub_array['moneda_sueldo'] = $row["moneda_sueldo"];
                    $sub_array['moneda_rm'] = $row["moneda_rm"];
                    $sub_array['dpto'] = $row["dpto"];
                    $sub_array['rep_legal'] = $row["rep_legal"];
                    $sub_array['dni_a'] = $row["dni_a"];
                    $sub_array['f_inic_act'] = $row["f_inic_act"];
                    $sub_array['f_baja_act'] = $row["f_baja_act"];
                    $sub_array['estado_emp'] = $row["estado_emp"];
                    $sub_array['habido_emp'] = $row["habido_emp"];
                    
                    $data[] = $sub_array;
                }
                echo json_encode($data);
            }

            break;

        case 'buscar_mes':
            $datos = $pension-> get_sueldo_mes($_POST["fecha"]);

            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array['id'] = $row["id"];
                    $sub_array['desde'] = $row["desde"];
                    $sub_array['hasta'] = $row["hasta"];
                    $sub_array['unidad_moneda'] = $row["unidad_moneda"];
                    $sub_array['sueldo_minimo'] = $row["sueldo_minimo"];
                    $sub_array['at_ss'] = $row["at_ss"];
                    $sub_array['at_pro_desocup'] = $row["at_pro_desocup"];
                    $sub_array['at_fondo_juvi'] = $row["at_fondo_juvi"];
                    $sub_array['ap_ss'] = $row["ap_ss"];
                    $sub_array['ap_fondo_juvi'] = $row["ap_fondo_juvi"];
                    $sub_array['ap_fonavi'] = $row["ap_fonavi"];
                }
                echo json_encode($sub_array);
            }
            break;
        case 'letras_monto':
            $resultado = $letras->ValorEnLetras($_POST["valor"],"");
            echo $resultado;
            break;
    }

?>