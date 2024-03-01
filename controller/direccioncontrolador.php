<?php 
    require_once("../config/conexion.php");
    require_once("../models/Direccion.php");


    session_start();

    $direccion = new Direccion();
    switch ($_GET["op"]) {
      
        case 'grilla':
            $datos = $direccion->get_direccion_x_ruc($_POST["ruc"]);
            if(is_array($datos)==true and count($datos)>0){
                
                $html="";
                foreach($datos as $row) {
                    $html.= "<tr>";
                    $html.= "<td style='vertical-align: middle;'><input type='radio' name='direccion_emp' value='".$row["direccion"]."'></td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["direccion"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["departamento"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["provincia"]."</td>";
                    $html.= "<td style='vertical-align: middle;'>".$row["distrito"]."</td>";
                    $html.= "</tr>";
                }
                echo $html;
            }else {
                $html= "";
                $html.= "<tr>";
                $html.= "<td colspan=5 class='text-center'>SIN RESULTADOS</td>";
                $html.= "</tr>";
                echo $html;
            }
            break;

        
    }
?>