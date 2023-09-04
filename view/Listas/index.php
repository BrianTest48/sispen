<?php require_once("../Main/sesion.php");?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <?php require_once("../Main/mainhead.php") ; ?>
    <title>SDBZ  - Listas</title>
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
                    <span class="breadcrumb-item active">Listas</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Listas</h4>
                <p class="mg-b-0">Desde esta ventana podra observar las listas guardadas en el sistema.</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Listas</h6>
                    <!--<button id="btnnuevo" class="btn btn-outline-primary btn-block mg-b-10">Nuevo Registro de Empresa</button>-->
                    <br>
                    <div class="table-wrapper" >
                        <table id="lista_data" class="table display responsive nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="wd-5p">Id</th>
                                    <th class="wd-5p">Nombres</th>
                                    <th class="wd-5p">Apellidos</th>
                                    <th class="wd-5p">Documento</th>
                                    <th class="wd-5p">Cantidad</th>
                                    <th class="wd-5p">Tipo</th>
                                    <th class="wd-5p">F. Creacion</th>
                                    <th class="wd-5p">F. Modificacion</th>
                                    <th class="wd-5p">Fecha 1</th>
                                    <th class="wd-5p">F.Final 1</th>
                                    <th class="wd-5p">Ruc 1</th>
                                    <th class="wd-5p">Cargo 1</th>
                                    <th class="wd-5p">Firmante 1</th>
                                    <th class="wd-5p">Logo 1</th>
                                    <th class="wd-5p">Fecha 2</th>
                                    <th class="wd-5p">F.Final 2</th>
                                    <th class="wd-5p">Ruc 2</th>
                                    <th class="wd-5p">Cargo 2</th>
                                    <th class="wd-5p">Firmante 2</th>
                                    <th class="wd-5p">Logo 2</th>
                                    <th class="wd-5p">Fecha 3</th>
                                    <th class="wd-5p">F.Final 3</th>
                                    <th class="wd-5p">Ruc 3</th>
                                    <th class="wd-5p">Cargo 3</th>
                                    <th class="wd-5p">Firmante 3</th>
                                    <th class="wd-5p">Logo 3</th>
                                    <th class="wd-5p">Fecha 4</th>
                                    <th class="wd-5p">F.Final 4</th>
                                    <th class="wd-5p">Ruc 4</th>
                                    <th class="wd-5p">Cargo 4</th>
                                    <th class="wd-5p">Firmante 4</th>
                                    <th class="wd-5p">Logo 4</th>
                                    <th class="wd-5p">Fecha 5</th>
                                    <th class="wd-5p">F.Final 5</th>
                                    <th class="wd-5p">Ruc 5</th>
                                    <th class="wd-5p">Cargo 5</th>
                                    <th class="wd-5p">Firmante 5</th>
                                    <th class="wd-5p">Logo 5</th>
                                    <th class="wd-5p"><center>Acciones</center></th>
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
            require_once("./modalmantenimientolistas.php");
            require_once("../Main/mainjs.php"); 
        ?>
        <script src="listas.js" type="text/javascript"></script>
  </body>
</html>