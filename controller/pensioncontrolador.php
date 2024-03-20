<?php
require_once("../config/conexion.php");
require_once("../models/Pension.php");

require_once("../util/cantidad_en_letras.php");

$pension = new Pension();
$letras = new EnLetras();


switch ($_GET["op"]) {

    case 'afiliado':
        if (empty($_POST["af_id"])) {
            $datos = $pension->insert_afiliado($_POST["tipo_doc"], $_POST["num_doc"], $_POST["txtnombre"], $_POST["txtapellido"], $_POST["txtdate"]);

            echo json_encode($datos);
        } else {
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

    case 'consulta_dni_nac':
        $token = 'dc81ccc3-4328-4ca1-990d-eab045df8bd3';
        //$dni    =   $_POST['dni'];
        $dni    =   $_POST['dni'];
        // Iniciar llamada a API
        $curl = curl_init();

        // Buscar dni
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbyoBhxuklU5D3LTguTcYAS85klwFINHxxd-FroauC4CmFVvS0ua/exec?op=dni&token=' . $token . '&formato=json&documento=' . $dni,
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
    case 'consulta_api_sunat1':
        //$token_api = '81c7c6aa552ef9ddb3c35c72bbbfd3';
        $token_api = '6e054319b9e1017ca0f7c950470b2a';
        $ruc  =   $_POST['ruc'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://utildatos.com/api/sunat',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('ruc' => $ruc),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token_api
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        break;

    case 'consulta_api_sunat':
        $ruc  =   $_POST['ruc'];
        $arrayDeTokens = ['65d6815b241377b5bccae8fbf76ac0', '968d336a642abdaf2e83f455daa4f8', 'e89e2fa3bf350d6073f7eeb3c41095', '021d33b92bd8bc8fbe6370e88c6f26', '6517c9f91114f647c5583e9ee23d09']; // Agrega todos tus tokens
        foreach ($arrayDeTokens as $token) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://utildatos.com/api/sunat',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('ruc' => $ruc),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            // Verifica si la respuesta es exitosa
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            if ($httpCode == 200) {
                // La solicitud fue exitosa, decodifica el JSON
                $responseData = json_decode($response, true);

                // Verifica si el campo "message" es "false"
                if (isset($responseData['message'])) {
                    //echo json_encode ( "Respuesta con token $token contiene 'message: false'.<br>");
                } else {
                    // La respuesta es exitosa, imprime el JSON y sale del bucle
                    echo $response;
                    break;
                }
            } else {
                // La solicitud no fue exitosa, intenta con el siguiente token
                //echo json_encode ("Intento fallido" . $token);
            }
        }

        break;
    case 'consulta_api_sunat_fecha_fin':
        // URL de la API
        $url = 'https://apiperu.net/api/ruc/plus/';

        // Número de RUC que deseas consultar
        $ruc  =  $_POST['ruc'];

        // Token Bearer
        $token = 'aTZBglxGXo2P5kY1LJoUsEPK3G48jdfte3COley6z1emaLmhy7';

        // Construir la URL completa con el número de RUC como parámetro
        $request_url = $url . $ruc;

        // Inicializar cURL para hacer la solicitud
        $curl = curl_init();

        // Configurar las opciones de cURL
        curl_setopt_array($curl, [
            CURLOPT_URL => $request_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token, // Agregar el token Bearer a la cabecera
            ],
        ]);

        // Ejecutar la solicitud y obtener la respuesta
        $response = curl_exec($curl);
        $err = curl_error($curl);

        // Cerrar la conexión cURL
        curl_close($curl);

        // Si hay algún error, mostrarlo
        if ($err) {
            echo "Error en la solicitud: " . $err;
        } else {
            // Mostrar la respuesta de la API
            echo $response;
        }
        break;
    case 'consultar_firmantes':
        $parametro = $_POST['ruc'];
        // Construye la URL de la API con el parámetro
        $url = "https://sparrow-fair-infinitely.ngrok-free.app/representatives?ruc=" . urlencode($parametro);

        // Realiza la solicitud a la API utilizando file_get_contents
        $response = file_get_contents($url);

        // Decodifica la respuesta JSON
        $data = json_decode($response, true); // Utiliza true para obtener un array asociativo
        // Decodifica la respuesta JSON
        $data1 = json_decode($data, true); // Utiliza true para obtener un array asociativo

        if ($data1 !== null) {
            $html = "";
            $order = 1;
            foreach ($data1 as $row) {
                $html .= "<tr>";
                $html .= "<td style='vertical-align: middle;'>" . $order++ . "</td>";
                $html .= "<td style='vertical-align: middle;'>" . $row['Tipo de Documento'] . "</td>";
                $html .= "<td style='vertical-align: middle;'>" . $row['Nro. Documento'] . "</td>";
                $html .= "<td style='vertical-align: middle;'>" . $row['Nombre'] . "</td>";
                $html .= "<td style='vertical-align: middle;'>" . $row['Cargo'] . "</td>";
                $html .= "<td style='vertical-align: middle;'>" . $row['Fecha Desde'] . "</td>";
                $html .= "</tr>";
                //$html.= "<option value='".$row["firma_nombre"]."'>".$row["firma_nombre"]." / ".$row["fech_inicio"]." / ".$row["fech_fin"]." / ".$row["estado"]." / ".$row["fecha_f"]."</option>";
                //$html.= "<option value='".$row["id"]."'>".$row["firma_nombre"]."<div>".$row["imagen"]."</div></option>";
            }
            //echo $html;

            $responseData = array(
                "res_json" => $data1,
                "table" => $html
            );

            // Convertir el array asociativo a JSON
            echo json_encode($responseData);
        } else {
            echo "0";
        }

        // Verifica si la decodificación fue exitosa



        // Puedes hacer algo con los datos decodificados, por ejemplo, enviarlos de vuelta a JavaScript
        //echo json_encode($data1);
        //echo ($data);
        break;
    case 'buscar':
        $datos = $pension->get_afiliado_x_tipo($_POST["tipo_doc"], $_POST["num_doc"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
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
        $data = array();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
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

        $datos = $pension->pension_aleatorio_empresa($_POST["txtdateinicio"], $_POST["txtdatefin"], $_POST["tipo"], $_POST["base"], $_POST["estado"], $_POST["condicion"]);
        $data = array();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
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
                $sub_array['busqueda'] = $row["busqueda"];
                $sub_array['fecha_busqueda'] = $row["fecha_busqueda"];
                $sub_array['cant_mes'] = $row["cant_mes"];
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
        $datos = $pension->pension_aleatorio_empresa($_POST["txtdateinicio"], $_POST["txtdatefin"], $_POST["tipo"], $_POST["base"], $_POST["estado"], $_POST["condicion"]);
        if (is_array($datos) == true and count($datos) > 0) {
            //$html ="<option value='0' label='Seleccione' ></option>";
            $html = "";
            foreach ($datos as $row) {
                //$html.= "<option value='".$row["empleador"]."'>".$row["empleador"]."</option>";
                $html .= "<option value='" . $row["ruc"] . "'>" . $row["empleador"] . "</option>";
            }
            echo $html;
        }
        break;

    case 'buscardpto':

        $datos = $pension->pension_empresa_dpto($_POST["txtdateinicio"], $_POST["txtdatefin"], $_POST["txtrazon"]);
        $data = array();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
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
                $sub_array['busqueda'] = $row["busqueda"];
                $sub_array['fecha_busqueda'] = $row["fecha_busqueda"];
                $sub_array['cant_mes'] = $row["cant_mes"];

                $data[] = $sub_array;
            }
            echo json_encode($data);
        }

        break;

    case 'buscar_mes':
        $datos = $pension->get_sueldo_mes($_POST["fecha"]);

        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
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
        $resultado = $letras->ValorEnLetras($_POST["valor"], "");
        echo $resultado;
        break;
}
