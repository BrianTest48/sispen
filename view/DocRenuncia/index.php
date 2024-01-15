<?php require_once("../Main/sesion.php");?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <?php require_once("../Main/mainhead.php") ; ?>
    <title>SDBZ  - Creacion Renuncia</title>
    </head>
    <body >
    <?php 
        require_once("../Main/mainleftpanel.php") ; 
        require_once("../Main/mainheadpanel.php") ; 
    ?>
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../Inicio/">Inicio</a>
                    <span class="breadcrumb-item active">Plantilla Renuncia</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Plantillas Renuncia</h4>
                <p class="mg-b-0">Desde esta ventana podra observar las plantillas de Renuncia</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Plantilla - Renuncia</h6>
                    <div class="row justify-content-end">
                       
                        <div class="col-12 col-sm-2">
                            <button id="btnnuevo" class="btn btn-primary btn-block mg-b-10">Nuevo Registro de Plantilla</button>
                        </div>
                    </div>
                    
                    <br>
                    <div class="table-wrapper" >
                        <table id="renuncia_data" class="table display responsive nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p">CONTENIDO</th>
                                    <th class="wd-5p">TIPO EMPRESA</th>
                                    <th class="wd-5p">TIPO DOCUMENTO</th>
                                    <th class="wd-5p">ESTADO</th>
                                    <th class="wd-5p">MODIFICAR</th>
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
            require_once("../Main/mainjs.php"); 
        ?>
        <script src="./docrenuncia.js"></script>
  </body>
</html>