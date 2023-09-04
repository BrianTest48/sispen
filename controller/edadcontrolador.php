<?php 
    require_once("../config/conexion.php");
    require_once("../models/Edad.php");

    session_start();

    $edad = new Edad();

    switch ($_GET["op"]) {
        case 'guardaryeditar':
            //$datos=$edad->get_edad_x_id($_POST["edad_id"]);
            if(empty($_POST["edad_id"])){
                /*if(is_array($datos)==true and count($datos)==0){
                    $cargo->insert_cargo($_POST["cargo_nom"], $_POST["cargo_desc"]);
                }*/
            }else{
                $edad->update_edad($_POST["edad_id"], $_POST["edad"]);
                echo "1";
            }
            
            break;

        case 'mostrar':
            $datos=$edad->get_edad_x_id($_POST["edad_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["edad_id"] = $row["id"];
                    $output["edad"] = $row["edad"]; 
                }
                echo json_encode($output);
            }
            break;
    }

    ?>