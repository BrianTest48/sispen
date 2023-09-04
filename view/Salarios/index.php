<?php require_once("../Main/sesion.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ  - Salarios</title>
    </head>
    <body>
        <?php
            require_once("../Main/mainleftpanel.php") ; 
            require_once("../Main/mainheadpanel.php") ; 
        ?>
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../Inicio/">Inicio</a>
                    <span class="breadcrumb-item active">Salarios</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Salarios</h4>
                <p class="mg-b-0">Desde esta ventana podra observar los salarios.</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Salarios</h6>
                    <button id="btnnuevo" class="btn btn-outline-primary btn-block mg-b-10">Nuevo Registro de Salario</button>
                    <br>
                    <div class="table-wrapper">
                        <table id="salario_data" class="table display responsive nowrap"  style="width:100%">
                            <thead>
                                <tr>
                                    <th class="wd-5p">Id</th>
                                    <th class="wd-10p">Fecha Inicio</th>
                                    <th class="wd-10p">Fecha Final</th>
                                    <th class="wd-10p">Moneda</th>
                                    <th class="wd-10p">Sueldo Minimo</th>
                                    <th class="wd-10p">Seguro Social Trabajador</th>
                                    <th class="wd-10p">FONAVI Trabajador</th>
                                    <th class="wd-10p">Pension Trabajador</th>
                                    <th class="wd-10p">Seguro Social Patrono</th>
                                    <th class="wd-10p">Pension Patrono</th>
                                    <th class="wd-10p">FONAVI Patrono</th>
                                    <th class="wd-10p">Fecha de Creacion</th>
                                    <th class="wd-10p">Fecha de Modificacion</th>
                                    <th class="wd-10p">Fecha de Eliminacion</th>
                                    <th class="wd-10p">Estado</th>
                                    <th class="wd-5p">Ver</th>
                                    <th class="wd-5p">Editar</th>
                                    <th class="wd-5p">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- br-pagebody -->
        </div><!-- br-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->
        <?php 
            require_once("modalmantenimientosalario.php"); 
            require_once("../Main/mainjs.php"); 
        ?>
        <script src="salarios.js" type="text/javascript"></script>
    </body>
</html>