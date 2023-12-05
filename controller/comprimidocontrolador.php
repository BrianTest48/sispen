<?php 
    require_once("../config/conexion.php");
    require_once("../models/Comprimido.php");

    session_start();

    $comp = new Comprimido();

    switch ($_GET["op"]) {
        case 'listar' :

            $datos = $comp->get_comprimido();
            $data = Array();
            $i = 0;

           

            foreach ($datos as $row) {

                $i++;
                $sub_array = array();
                $sub_array[] = $row;
                $sub_array[] = '<button type="button" onclick= "descargar(\''.$row.'\')"   id="'.$i.'" class="btn btn-outline-success btn-icon"><div><i class="fa fa-download"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
         
            break;
        

    }
?>