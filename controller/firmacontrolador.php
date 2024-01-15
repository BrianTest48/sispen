<?php 
    require_once("../config/conexion.php");
    require_once("../models/Firmante.php");
    require_once("../models/Empresa.php");
    require_once("../models/Cargo.php");

    session_start();

    $firmante = new Firmante();
    $cargo = new Cargo();
    $empresa = new Empresa();

    function convertirFecha($fechaOriginal) {
        // Crear un objeto DateTime con el formato original
        $fechaObjeto = DateTime::createFromFormat('d/m/Y', $fechaOriginal);
    
        // Verificar si la conversión fue exitosa
        if ($fechaObjeto !== false) {
            // Obtener la fecha en el nuevo formato
            return $fechaObjeto->format('Y-m-d');
        } else {
            // En caso de error, devolver un mensaje o valor por defecto
            return "Error al convertir la fecha";
        }
    }

    function cambiarFormatoFecha($fecha) {
        // Crear un objeto DateTime con la fecha proporcionada y el formato esperado
        $fechaObjeto = DateTime::createFromFormat('d-m-Y', $fecha);
    
        // Verificar si la conversión fue exitosa
        if ($fechaObjeto) {
            // Formatear la fecha en el nuevo formato "Y-m-d"
            return $fechaObjeto->format('Y-m-d');
        } else {
            // Si la conversión falla, puedes manejar el error según tus necesidades
            return "";
        }
    }
    

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

        case 'actualizar_firmante':
            $ruc_emp = $_POST["ruc"];
            // Recupera los datos JSON de la solicitud POST
            $datosJSON = $_POST['datos'];

            // Decodifica la cadena JSON a un array de PHP
            $datosArray = json_decode($datosJSON, true);
            if ($datosArray !== null) {

                // Itera sobre cada registro y realiza la inserción en la base de datos
                foreach ($datosArray as $registro) {
                    $tipoDocumento = $registro['Tipo de Documento'];
                    $nroDocumento = $registro['Nro. Documento'];
                    $nombre = $registro['Nombre'];
                    $cargo_rp = $registro['Cargo'];
                    $fecha = $registro['Fecha Desde'];
                    //obtener cod de Cargos
                    $dato_cargo = $cargo->get_cargo_x_nombre($cargo_rp);
                    if(is_array($dato_cargo)==true and count($dato_cargo)==0){
                        $cargo_firmante = NULL;
                    }else {
                        $cargo_firmante = $dato_cargo[0]['id'];
                    }
                    //buscar si el firmante existe con relacion al RUC
                    $dato_firmante = $firmante->get_firmante_x_dni_ruc($nroDocumento , $ruc_emp);
                    

                    if(is_array($dato_firmante)==true and count($dato_firmante)==0){
                        //Se inserta un nuevo registro
                        $firmante->insert_firmante($ruc_emp, $nombre, $nroDocumento, $cargo_firmante, convertirFecha($fecha), NULL, NULL, NULL);
                    }else {
                        $dato_id_firmante = $dato_firmante[0]["id"];
                        $firmante->update_firmante($ruc_emp, $dato_id_firmante, $nombre, $nroDocumento, $cargo_firmante, convertirFecha($fecha), NULL, NULL, NULL);
                    }
                
                    
                }
            }

            echo $ruc_emp;
            break;
        case 'update_firmante':
            $ruc_emp = $_POST["ruc"];
            // Recupera los datos JSON de la solicitud POST
            $datosJSON = $_POST['datos'];
            $datosJSON_emp = $_POST['datos_emp'];

            // Decodifica la cadena JSON a un array de PHP
            $datosArray = json_decode($datosJSON, true);
            if ($datosArray !== false) {

                // Itera sobre cada registro y realiza la inserción en la base de datos
                foreach ($datosArray as $registro) {
                    $tipoDocumento = $registro['tipodoc'];
                    $nroDocumento = $registro['numdoc'];
                    $nombre = $registro['nombre'];
                    $cargo_rp = $registro['cargo'];
                    $fecha = $registro['desde'];
                    //obtener cod de Cargos
                    $dato_cargo = $cargo->get_cargo_x_nombre($cargo_rp);
                    if(is_array($dato_cargo)==true and count($dato_cargo)==0){
                        $cargo_firmante = NULL;
                    }else {
                        $cargo_firmante = $dato_cargo[0]['id'];
                    }
                    //buscar si el firmante existe con relacion al RUC
                    $dato_firmante = $firmante->get_firmante_x_dni_ruc($nroDocumento , $ruc_emp);
                    

                    if(is_array($dato_firmante)==true and count($dato_firmante)==0){
                        //Se inserta un nuevo registro
                        $firmante->insert_firmante($ruc_emp, $nombre, $nroDocumento, $cargo_firmante, cambiarFormatoFecha($fecha), NULL, NULL, NULL);
                    }else {
                        $dato_id_firmante = $dato_firmante[0]["id"];
                        $firmante->update_firmante($ruc_emp, $dato_id_firmante, $nombre, $nroDocumento, $cargo_firmante, cambiarFormatoFecha($fecha), NULL, NULL, NULL);
                    }
                
                    
                }
            }

            // Decodificar el JSON a un array de PHP
            $dataEmp = json_decode($datosJSON_emp, true);
            //insertar a mi BD

            $data = $empresa->update_empresa_api($dataEmp["ruc_emp"], $dataEmp["razon"], $dataEmp["direccion"], $dataEmp["departamento"], $dataEmp["provincia"], $dataEmp["distrito"], cambiarFormatoFecha($dataEmp["fecha_inicio"]), cambiarFormatoFecha($dataEmp["fecha_fin"]), $dataEmp["estado"], $dataEmp["condicion"]);

            echo $ruc_emp;
            break;
        case 'update_firmante_sunat':
            $ruc_emp = $_POST["ruc"];
            // Recupera los datos JSON de la solicitud POST
            $datosJSON = $_POST['datos'];

            // Decodifica la cadena JSON a un array de PHP
            $datosArray = json_decode($datosJSON, true);
            if ($datosArray !== false) {

                // Itera sobre cada registro y realiza la inserción en la base de datos
                foreach ($datosArray as $registro) {
                    $tipoDocumento = $registro['tipodoc'];
                    $nroDocumento = $registro['numdoc'];
                    $nombre = $registro['nombre'];
                    $cargo_rp = $registro['cargo'];
                    $fecha = $registro['desde'];
                    //obtener cod de Cargos
                    $dato_cargo = $cargo->get_cargo_x_nombre($cargo_rp);
                    if(is_array($dato_cargo)==true and count($dato_cargo)==0){
                        $cargo_firmante = NULL;
                    }else {
                        $cargo_firmante = $dato_cargo[0]['id'];
                    }
                    //buscar si el firmante existe con relacion al RUC
                    $dato_firmante = $firmante->get_firmante_x_dni_ruc($nroDocumento , $ruc_emp);
                    

                    if(is_array($dato_firmante)==true and count($dato_firmante)==0){
                        //Se inserta un nuevo registro
                        $firmante->insert_firmante($ruc_emp, $nombre, $nroDocumento, $cargo_firmante, cambiarFormatoFecha($fecha), NULL, NULL, NULL);
                    }else {
                        $dato_id_firmante = $dato_firmante[0]["id"];
                        $firmante->update_firmante($ruc_emp, $dato_id_firmante, $nombre, $nroDocumento, $cargo_firmante, cambiarFormatoFecha($fecha), NULL, NULL, NULL);
                    }
                
                    
                }
            }
            echo $ruc_emp;
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

        case 'grilla':
            $datos = $firmante->get_firmante_empresa($_POST["numero"]);
            if(is_array($datos)==true and count($datos)>0){
                
                $html="";
                foreach($datos as $row) {
                    $html.= "<tr>";
                    $html.= "<td style='vertical-align: middle;'><input type='radio' name='firmante' value='".$row["firma_nombre"]."'></td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["firma_nombre"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["fech_inicio"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["fech_fin"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["estado"]."</td>";
                    $html.= "</tr>";
                    //$html.= "<option value='".$row["firma_nombre"]."'>".$row["firma_nombre"]." / ".$row["fech_inicio"]." / ".$row["fech_fin"]." / ".$row["estado"]." / ".$row["fecha_f"]."</option>";
                    //$html.= "<option value='".$row["id"]."'>".$row["firma_nombre"]."<div>".$row["imagen"]."</div></option>";
                }
                echo $html;
            }else {
                //$html="<option value='....................'>SIN FIRMANTE</option>";
                $html= "";
                $html.= "<tr>";
                $html.= "<td colspan=5 class='text-center'>SIN RESULTADOS</td>";
                $html.= "</tr>";
                echo $html;
            }
            break;

        case 'tabla_firmante_ruc':
            $datos = $firmante->get_firmante_empresa($_POST["numero"]);
            if(is_array($datos)==true and count($datos)>0){
                
                $html="";
                $ini = 1;
                foreach($datos as $row) {
                    $html.= "<tr>";
                    $html.= "<td style='vertical-align: middle;'>".$ini++."</td>";
                    $html.= "<td style='vertical-align: middle;'>DNI</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["dni"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["firma_nombre"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["nombre"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["fech_inicio"]."</td>";
                    $html.= "</tr>";
                }
                echo $html;
            }else {
                //$html="<option value='....................'>SIN FIRMANTE</option>";
                $html= "";
                $html.= "<tr>";
                $html.= "<td colspan=6 class='text-center'>SIN RESULTADOS</td>";
                $html.= "</tr>";
                echo $html;
            }
            break;
    }
?>