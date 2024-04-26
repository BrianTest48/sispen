<?php
require_once("../config/conexion.php");
require_once("../models/Empresa.php");

$empresa = new Empresa();

function convertirFecha($fechaOriginal)
{
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

function cambiarFormatoFecha($fecha)
{
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

    case 'listar':
        $datos = $empresa->get_empresa();
        $data = array();
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
            $sub_array[] = '<button type="button" onClick="vista(' . $row["id"] . ');"  id="' . $row["id"] . '" class="btn btn-outline-success btn-icon"><div><i class="fa fa-eye"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="editar(' . $row["id"] . ');"  id="' . $row["id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id"] . ');"  id="' . $row["id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

        break;
    case 'listar_utilizados':
        $datos = $empresa->get_empresa_utilizadas();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["id"];
            $sub_array[] = $row["ruc"];
            $sub_array[] = $row["empleador"];
            if($row["busqueda"]== 1){
                $sub_array[] = 'Utilizado';
            }else {
                $sub_array[] = 'No Utilizado';
            }
            $sub_array[] = $row["fecha_busqueda"];
            $sub_array[] = '<button type="button" onClick="reestablecer(' . $row["ruc"] . ');"  id="' . $row["ruc"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-undo"></i></div></button>';
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

        break;
    case 'guardaryeditar':
        $datos = $empresa->get_empresa_x_id($_POST["emp_id"]);
        if (empty($_POST["emp_id"])) {
            if (is_array($datos) == true and count($datos) == 0) {
                if ($_POST["emp_seg_rep"] == ""  and $_POST["emp_dni_seg_rep"] == "") {
                    $empresa->insert_empresa($_POST["emp_tipo"], $_POST["emp_ruc"], $_POST["emp_razonsocial"], $_POST["emp_direccion"], $_POST["emp_dpto"], $_POST["emp_prov"], $_POST["emp_dist"], $_POST["emp_ini_act"], $_POST["emp_fin_act"], '-', 'NULL', 'NULL', 'NO REGISTR', 'NO REGISTR', $_POST["emp_fech_seg_rep_legal"], $_POST["emp_estado"], $_POST["emp_condicion"]);
                    echo ("SE GUARDO");
                } else {
                    $empresa->insert_empresa($_POST["emp_tipo"], $_POST["emp_ruc"], $_POST["emp_razonsocial"], $_POST["emp_direccion"], $_POST["emp_dpto"], $_POST["emp_prov"], $_POST["emp_dist"], $_POST["emp_ini_act"], $_POST["emp_fin_act"], $_POST["emp_rep_legal"], $_POST["emp_dni"], $_POST["emp_fech_rep_legal"], $_POST["emp_seg_rep"], $_POST["emp_dni_seg_rep"], $_POST["emp_fech_seg_rep_legal"], $_POST["emp_estado"], $_POST["emp_condicion"]);
                }
            }
        } else {
            $empresa->update_empresa($_POST["emp_id"], $_POST["emp_tipo"], $_POST["emp_ruc"], $_POST["emp_razonsocial"], $_POST["emp_direccion"], $_POST["emp_dpto"], $_POST["emp_prov"], $_POST["emp_dist"], $_POST["emp_ini_act"], $_POST["emp_fin_act"], $_POST["emp_rep_legal"], $_POST["emp_dni"], $_POST["emp_fech_rep_legal"], $_POST["emp_seg_rep"], $_POST["emp_dni_seg_rep"], $_POST["emp_fech_seg_rep_legal"], $_POST["emp_estado"], $_POST["emp_condicion"]);
            echo json_encode($empresa);
        }

        break;
    case 'update_empresa':
        $ruc_emp = $_POST["ruc"];
        $datosJSON_emp = $_POST['datos_emp'];
        // Decodificar el JSON a un array de PHP
        $dataEmp = json_decode($datosJSON_emp, true);
        //insertar a mi BD

        $data = $empresa->update_empresa_api($dataEmp["ruc_emp"], $dataEmp["razon"], $dataEmp["direccion"], $dataEmp["departamento"], $dataEmp["provincia"], $dataEmp["distrito"], cambiarFormatoFecha($dataEmp["fecha_inicio"]), cambiarFormatoFecha($dataEmp["fecha_fin"]), $dataEmp["estado"], $dataEmp["condicion"]);

        echo $ruc_emp;
        break;
    case 'update_busqueda_empresa':
        $ruc_emp = $_POST["ruc"];

        $data = $empresa->update_empresa_usada($ruc_emp);
        echo "1";
        break;

    case 'update_busqueda_empresa_restart':
        $ruc_emp = $_POST["ruc"];

        $data = $empresa->update_empresa_restart($ruc_emp);
        echo "1";
        break;

    case 'update_busqueda_empresa_meses':
        $cant = $_POST["cantidad"];
        $data = $empresa->update_empresa_meses($cant);
        echo "1";
        break;
    case 'mostrar':
        $datos = $empresa->get_empresa_x_id($_POST["emp_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
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
                $output["estado_emp"] = $row["estado_emp"];
                $output["habido_emp"] = $row["habido_emp"];
            }
            echo json_encode($output);
        }
        break;

    case 'rucempresa':
        $datos = $empresa->get_empresa_x_ruc($_POST["emp_ruc"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["empleador"] = $row["empleador"];
            }
            echo json_encode($output);
        }
        break;
    case 'mostrar_empresa_ruc':
        $datos = $empresa->get_empresa_ruc($_POST["ruc"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
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
                $output["estado_emp"] = $row["estado_emp"];
                $output["habido_emp"] = $row["habido_emp"];
                $output["busqueda"] = $row["busqueda"];
                $output["cant_mes"] = $row["cant_mes"];
                $output["fecha_busqueda"] = $row["fecha_busqueda"];
            }
            echo json_encode($output);
        }
        break;
    case 'combovigencia':
        $datos = $empresa->get_empresa_x_ruc($_POST["numero"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["ruc"] = $row["ruc"];
                $output["f_inic_act"] = $row["f_inic_act"];
                $output["f_baja_act"] = $row["f_baja_act"];
                $output["estado_emp"] = $row["estado_emp"];
                $output["habido_emp"] = $row["habido_emp"];
            }
            echo json_encode($output);
        }
        break;

    case 'eliminar':
        $empresa->delete_empresa($_POST["emp_id"]);
        break;

    case 'cargar_csv':
        include 'procesar_csv.php'; // El nombre del script PHP que procesa la carga del CSV
        echo "se pudo";
        break;
}
