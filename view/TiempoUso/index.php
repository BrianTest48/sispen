<?php require_once("../Main/sesion.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ  - Tiempo de Uso</title>
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
                    <span class="breadcrumb-item active">Tiempo de Uso </span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Tiempo de Uso</h4>
                <p class="mg-b-0">Modifica el tiempo de uso de las empresas.</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <div class="row justify-content-between">
                        <div class="col-12 col-sm-6">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Configuracion</h6>
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <form id="pension_form" method="post">
                                <input type="hidden" id="af_id" name="af_id">
                                <input type="hidden" id="lista_id" name="lista_id">
                                <div class="form-layout form-layout-1" style="padding-bottom: 0px">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label class="form-control-label" for="tipo_doc" >Cantidad de Meses: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2" name="txtcant_anios" id="txtcant_anios" data-placeholder="Seleccione" style="width: 100%"> 
                                                    <option label="Seleccione"></option>
                                                    <option value="1">1 Meses</option>
                                                    <option value="2">2 Meses</option>
                                                    <option value="3">3 Meses</option>
                                                    <option value="4">4 Meses</option>
                                                    <option value="5">5 Meses</option>
                                                    <option value="6">6 Meses</option>
                                                    <option value="7">7 Meses</option>
                                                    <option value="8">8 Meses</option>
                                                    <option value="9">9 Meses</option>
                                                    <option value="10">10 Meses</option>
                                                    <option value="11">11 Meses</option>
                                                    <option value="12">12 Meses</option>
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
