<?php require_once("../Main/sesion.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ  - Usuarios</title>
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
                    <span class="breadcrumb-item active">Usuarios</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Usuarios</h4>
                <p class="mg-b-0">Desde esta ventana podra observar los usuarios.</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Usuarios</h6>
                    <button id="btnnuevo" class="btn btn-outline-primary btn-block mg-b-10">Nuevo Registro de Usuario</button>
                    <br>
                    <div class="table-wrapper">
                        <table id="usuario_data" class="table display responsive nowrap"  style="width:100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p">Id</th>
                                    <th class="wd-20p">Usuario</th>
                                    <th class="wd-20p">Nombres</th>
                                    <th class="wd-15p">Apellidos</th>
                                    <th class="wd-15p">Clave</th>
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
            require_once("modalmantenimientousuario.php"); 
            require_once("../Main/mainjs.php") 
        ?>
        <script src="usuarios.js" type="text/javascript"></script>
    </body>
</html>