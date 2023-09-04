<?php require_once("../Main/sesion.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ  - Mantenimiento Edad</title>
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
                    <span class="breadcrumb-item active">Mantenimiento Edad</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Mantenimiento Edad</h4>
                <p class="mg-b-0">Realiza las pensiones con los siguientes datos.</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <div class="row justify-content-between">
                        <div class="col-12 col-sm-6">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Configuracion de Edad</h6>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <input type="hidden" id="tipo_lista" name="tipo_lista" value="PENSIONES">
                            
                            <form id="pension_form" method="post">
                                <input type="hidden" id="af_id" name="af_id">
                                <input type="hidden" id="lista_id" name="lista_id">
                                <div class="form-layout form-layout-1" style="padding-bottom: 0px">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="tipo_doc" >Cant. de Años: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2" name="txtcant_anios" id="txtcant_anios" data-placeholder="Seleccione" style="width: 100%"> 
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                    </select>
                                            </div>
                                        </div><!-- col-4 -->
                                        
                                        <div class="col-lg-4  d-flex align-items-center justify-content-center">
                                            <button type="button" id="btnbuscar" name="btnbuscar"  class="btn btn-info" onclick="actualizar()" >Actualizar</button>
                                        </div><!-- col-4 -->
                                    </div>
                                    <br>
                                    
                                </div>
                                <br>
                               
                                
                            </form>
                            <br>
                            
                            <br> 
                        </div>
                        
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
        <script src="edad.js" type="text/javascript"></script>
    </body>
</html>
