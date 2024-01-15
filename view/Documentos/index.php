<?php require_once("../Main/sesion.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ  - Documentos</title>
        <style>
             .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }
        </style>
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
                    <span class="breadcrumb-item active">Documentos</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Crear Documentos</h4>
                <p class="mg-b-0">Realiza la creacion de documentos</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <div class="row justify-content-between">
                        <div class="col-12 col-sm-6">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10"></h6>
                        </div>
                      
                    </div>
                    <div class="row">
                        <form method="post" id="documento-form">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Guardar" name="submit">
                                </div>
                            </div>
                        </form>
                    </div><!-- row --> 
                </div>
            </div><!-- br-pagebody --> 
        </div><!-- br-mainpanel -->
        <footer class="br-footer">
            <div class="footer-left">
                <div class="mg-b-2"></div>
                <div></div>
            </div>
            <div class="footer-right d-flex align-items-center">
                <span class="tx-uppercase mg-r-10"></span>
            </div>
        </footer>
        <!-- ########## END: MAIN PANEL ########## -->
        <?php 
            
            require_once("../Main/mainjs.php");
        ?>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

        <script src="./documentos.js" type="text/javascript"></script>
    </body>
</html>
