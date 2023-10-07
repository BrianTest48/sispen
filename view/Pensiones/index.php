<?php require_once("../Main/sesion.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SDBZ  - Pensiones</title>
    </head>
    <body>
        <?php 
            require_once("../Main/mainleftpanel.php") ; 
            require_once("../Main/mainheadpanel.php") ; 
        ?>
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel" >
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../Inicio/">Inicio</a>
                    <span class="breadcrumb-item active">Pensiones</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Pensión Automático</h4>
                <p class="mg-b-0">Realiza las pensiones con los siguientes datos.</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <div class="row justify-content-between">
                        <div class="col-12 col-sm-6">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Formulario de Pensiones</h6>
                        </div>
                        <div class="col-12 col-sm-1 mg-b-10">
                            <button  type="button" id="btnguardarpension" name="btnguardarpension" class="btn btn-info" onclick="GuardarLista()" style="width :100%;background-color : #A20036;" >Guardar</button>
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
                                                <label class="form-control-label" for="tipo_doc" >Tipo de Doc: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2" name="tipo_doc" id="tipo_doc" data-placeholder="Seleccione" style="width: 100%" onchange="validarInputs()" required> 
                                                    <option label="Seleccione"></option>
                                                    <option value="D.N.I">D.N.I</option>
                                                    <option value="C.E">C.E</option>
                                                    <option value="PAS">PAS</option>
                                                </select>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label text-truncate">Nro de Documento: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" id="num_doc" name="num_doc"  placeholder="Ingrese Numero de Documento" maxlength="11" required >
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4  d-flex align-items-center justify-content-center">
                                            <button type="button" id="btnbuscar" name="btnbuscar"  class="btn btn-info"  >Buscar</button>
                                        </div><!-- col-4 -->
                                    </div>
                                    <br>
                                </div>
                                <br>
                                <div class="d-none" id="form_datos">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Nombres: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="txtnombre" id="txtnombre"  placeholder="Ingrese su Nombre" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">Apellidos: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="text" name="txtapellido" id="txtapellido"  placeholder="Ingrese su Apellido" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label">F. de Nacimiento.:<span class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" max="2999-12-31" name="txtdate" id="txtdate"  placeholder="" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="cant_emp" >Cant. de Empresas: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="number" name="txtcant_emp" id="txtcant_emp" min="1" max="5" placeholder=""  required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-4" hidden>
                                            <div class="form-group">
                                                <label class="form-control-label" for="cant_emp" >Cant. de Años: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2" name="txtcant_anios" id="txtcant_anios" data-placeholder="Seleccione" style="width: 100%" disabled> 
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                </select>
                                            </div>
                                        </div><!-- col-4 -->
                                    </div><!-- row -->
                                    <div class="form-layout-footer text-center">
                                        <button type="submit" id="btnautogenerar" name="btnautogenerar"   class="btn btn-info">Gestionar</button>
                                        <button type="button" id="btnlimpiar" name="btnlimpiar" class="btn btn-secondary">Limpiar</button>
                                    </div><!-- form-layout-footer -->
                                </div><!-- form-datos -->
                            </form>
                            <br>
                            <div class="form-layout form-layout-1" id="divresultado">
                                <div class="accordion" id="acc_resultado" >
                                    
                                </div>
                            </div>
                            <br> 
                        </div>
                        <div class="col-xl-6 " >
                            <div class="form-layout form-layout-1" id="temp_servicio">
                               <h6 class="text-center mg-b-0">Tiempo de Servicio : <label id="tiempo_servicio"></label></h6>
                            </div>
                            <br>
                            <!-- AQUI VA TODO LA VISUALIZACION-->
                            <div id="contemp1" name="contemp1" class="form-layout form-layout-1">
                                <input  type="hidden" id="fech_inicio_emp" name="fech_inicio_emp">
                                <input  type="hidden" id="fech_final_emp" name="fech_final_emp">
                                <input  type="hidden" id="sueldo_emp" name="sueldo_emp">
                                <input  type="hidden" id="moneda_emp" name="moneda_emp">
                                <input  type="hidden" id="cargo_emp" name="cargo_emp">
                                <input  type="hidden" id="dpto_emp" name="dpto_emp">
                                <h5 class="text-center" id="nom_emp_lab"></h5>
                                <br>
                                <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist" style="border-bottom : 0px">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active btn btn-outline-secondary btn-block mg-b-10 "  id="orcinea-tab"  data-bs-toggle="pill" data-bs-target="#certificado" type="button" role="tab" aria-controls="certificado"  aria-selected="true" >Certificado</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="host-tab"     data-bs-toggle="pill" data-bs-target="#liquidacion"    type="button" role="tab" aria-controls="liquidacion"     aria-selected="false">Liquidacion</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="boleta-tab"   data-bs-toggle="pill" data-bs-target="#boleta"  type="button" role="tab" aria-controls="boleta"   aria-selected="false">Boleta</button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- AQUI VA EL CONTENIDO -->
                                    <div id="certificado" class="tab-pane fadein show active">
                                        <form id="form_certificado" action="" method="post" autocomplete="off">
                                            <div class="form-layout form-layout-1">
                                                <div class="row ">
                                                    <input type="hidden" id="emp_certificado" name="emp_certificado">
                                                    <input type="hidden" id="nombre_certificado" name="nombre_certificado">
                                                    <input type="hidden" id="f_ini_certificado" name="f_ini_certificado">
                                                    <input type="hidden" id="f_baj_certificado" name="f_baj_certificado">
                                                    <input type="hidden" id="cargo_certificado" name="cargo_certificado">
                                                    <input type="hidden" id="firmante_certificado" name="firmante_certificado">
                                                    <input type="hidden" id="lugar_certificado" name="lugar_certificado">
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Certificado: </label>
                                                            <div class="col-lg-6 pd-0">
                                                                <select class="form-control col-lg-6 select2" data-placeholder="Seleccione" id="select_certificado"  style="width: 100%" >
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div><!-- row -->
                                            </div>
                                            <div class="form-layout-footer text-right mg-t-20">
                                                <button type="button" id="btnprevcer" name="btnprevcer"  class="btn btn-secondary mg-l-10">Previsualizar</button>
                                                <!--<button type="button" id="btnimprimirbol" name="btnimprimirbol"  class="btn btn-info">Imprimir Boleta</button>-->
                                            </div>
                                        </form>
                                    </div>
                                    <div id="liquidacion" class="tab-pane fade">
                                        <form id="form_liqui" action="" method="post" autocomplete="off">
                                            <input type="hidden" name="" id="dias_liqui">
                                            <input type="hidden" name="" id="meses_liqui">
                                            <input type="hidden" name="" id="anios_liqui">
                                            <div class="form-layout form-layout-1">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Sueldo: </label>
                                                            <input class="form-control col-lg-6" type="number" name="SUELDO" id="sueldo_liquidacion" value="0" placeholder="" disabled>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Adelanto: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="ADELANTO" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Vacaciones:</label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="VACACIONES"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Gratificaciones: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="GRATIFICACIONES"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Reintegro: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="REINTEGRO"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Incentivo: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="INCENTIVO" id="incentivo" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="BONIFICACION" id="bonif" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bon. Extraordinaria:</label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="BON. EXTRAORDINARIA" id="bonif_extra" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bon. Graciosa: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="BON. GRACIOSA" id="bonif_gra" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bon. Por Cumplimiento de Meta: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="BON. POR CUMPLIENTO DE META" id="bonif_meta" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bon. Por Dias Festivos: </label>
                                                            <input class="form-control col-lg-6 liqui_bonif" type="number" name="BON. POR DIAS FESTIVOS" id="bonif_dias" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    
                                                </div><!-- row -->
                                            </div>
                                            <div class="form-layout-footer text-right mg-t-20">
                                                <div class="row">
                                                    <div class="col-12 col-sm-8">
                                                        <select class="form-control select2" data-placeholder="Motivo de Retiro" name="combo_prev_liqui" id="combo_prev_liqui" style="width: 100%;">
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <button type="button" id="btnprevli" name="btnprevli"  class="btn btn-secondary mg-l-10">Previsualizar</button>
                                                    </div>
                                                </div>
                                                
                                                <!--<button type="button" id="btnimprimirli" name="btnimprimirli"  class="btn btn-info">Imprimir Liquidacion</button>-->
                                            </div>
                                        </form>
                                    </div>
                                    <div id="boleta" class="tab-pane fade">
                                        <form id="form_bol" action="" method="post" autocomplete="off">
                                            <div class="form-layout form-layout-1">
                                                <div class="row">
                                                    <!--<div class="col-12 col-sm-4">
                                                        <button type="button" id="btnboletas" name="btnboletas"  class="btn btn-info"  style="width:100%; font-size: 12px">Visualizar Boletas</button>
                                                    </div>-->
                                                    <div class="col-12 col-sm-6">
                                                        <div class="row justify-content-center">
                                                            <button type="button" id="btnboletas_dsc" name="btnboletas_dsc"  class="btn btn-info"   style="width:60%; font-size: 12px">Visualizar Descuentos</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6 ">
                                                        <div class="row justify-content-center">
                                                            <button type="button" id="btnboletas_dsc_mes" name="btnboletas_dsc_mes"  class="btn btn-info" style="width:60%; font-size: 12px">Visualizar Boleta Actual</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row ">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="total_monto_boleta" id="total_monto_boleta">
                                                        <input type="hidden" id="at_ss">
                                                        <input type="hidden" id="at_fonavi">
                                                        <input type="hidden" id="at_pension">
                                                        <input type="hidden" id="ap_ss">
                                                        <input type="hidden" id="ap_fonavi">
                                                        <input type="hidden" id="ap_pension">
                                                        <input type="hidden" id="sueldo_minimo">
                                                        <input type="hidden" id="unidad_moneda">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Año: </label>
                                                            <div class="col-lg-6 pd-0">
                                                                <select class="form-control col-lg-6 select2" data-placeholder="Seleccione" id="select_anio_boletas" name="select_anio_boletas" style="width: 100%">
                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Mes: </label>
                                                            <div class="col-lg-6 pd-0">
                                                                <select class="form-control col-lg-6 select2" data-placeholder="Seleccione" id="select_mes_boletas" name="select_mes_boletas" style="width: 100%" onchange="MostrarBoleta()">
                                                                    <option label="Seleccione"></option>
                                                                    <option value="ene">Enero</option>
                                                                    <option value="feb">Febrero</option>
                                                                    <option value="mar">Marzo</option>
                                                                    <option value="abr">Abril</option>
                                                                    <option value="may">Mayo</option>
                                                                    <option value="jun">Junio</option>
                                                                    <option value="jul">Julio</option>
                                                                    <option value="ago">Agosto</option>
                                                                    <option value="sep">Septiembre</option>
                                                                    <option value="oct">Octubre</option>
                                                                    <option value="nov">Noviembre</option>
                                                                    <option value="dic">Diciembre</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Sueldo: </label>
                                                            <input class="form-control col-lg-6" type="number" name="sueldo_boleta" id="sueldo_boleta" oninput="calcularTotalBoleta()"   placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">REM. Vacacional: </label>
                                                            <input class="form-control col-lg-6" type="number" name="rm_vacacional_boleta" id="rm_vacacional_boleta"  oninput="calcularTotalBoleta()"  placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Reintegro: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="reintegro_boleta" id="reintegro_boleta" oninput="calcularTotalBoleta()"  placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">H. Extras: </label>
                                                            <input class="form-control col-lg-6" type="number" name="horaex_boleta" id="horaex_boleta" oninput="calcularTotalBoleta()"  placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="boni_boleta" id="boni_boleta" oninput="calcularTotalBoleta()"  placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion Por Alimentos: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="bonificacion_alimentos_boleta" id="bonificacion_alimentos_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion Por Metas Cumplidas: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="bonificacion_metas_boleta" id="bonificacion_metas_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion Por Logros Cumplidas: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="bonificacion_logros_boleta" id="bonificacion_logros_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion Por Dias Festivos: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="bonificacion_festivos_boleta" id="bonificacion_festivos_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Pasajes: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="bonificacion_pasajes_boleta" id="bonificacion_pasajes_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Uniforme: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="bonificacion_uniforme_boleta" id="bonificacion_uniforme_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Gratificacion: </label>
                                                            <input class="form-control col-lg-6 bonif" type="number" name="bonificacion_gratificacion_boleta" id="bonificacion_gratificacion_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Otros: </label>
                                                            <input class="form-control col-lg-6" type="number" name="otros_boleta" id="otros_boleta"  oninput="calcularTotalBoleta()" placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                </div><!-- row -->
                                            </div>
                                            <div class="form-layout-footer text-right mg-t-20">
                                                <div class="row">
                                                    <div class="col-12 col-sm-8">
                                                        <select class="form-control select2" name="combo_prev_boleta" id="combo_prev_boleta" style="width: 100%;">
                                                            <option value="1">Modelo Boleta 1</option>
                                                            <option value="2">Modelo Boleta 2</option>
                                                            <option value="3">Modelo Boleta 3</option>
                                                            <option value="4">Modelo Boleta 4</option>
                                                            <option value="5">Modelo Boleta 5</option>
                                                            <option value="6">Modelo Boleta 6</option>
                                                            <option value="7">Modelo Boleta 7</option>
                                                            <option value="8">Modelo Boleta 8</option>
                                                            <option value="9">Modelo Boleta 9</option>
                                                            <option value="10">Modelo Boleta 10</option>
                                                            <option value="11">Modelo Boleta 11</option>
                                                            <option value="12">Modelo Boleta 12</option>
                                                            <option value="13">Modelo Boleta 13</option>
                                                            <option value="14">Modelo Boleta 14</option>
                                                            <option value="15">Modelo Boleta 15</option>
                                                            <option value="16">Modelo Boleta 16</option>
                                                           <option value="17">Modelo Boleta 17</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <button type="button" id="btnprevbol" name="btnprevbol"  class="btn btn-secondary mg-l-10">Previsualizar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--<div class="form-layout-footer text-right mg-t-20">
                                    <button type="button" id="btnimprimir" name="btnimprimir"  class="btn btn-info">Imprimir Certificado</button>
                                </div> form-layout-footer -->
                            </div>
                            <br>
                        
                            <div class="prevs_certificado" id="prev1">
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p1">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p1" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO LABORAL</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp" >
                                                <div class="text-center">
                                                    <div  style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 20px;">EL QUE SUSCRIBE DEJA CONSTANCIA QUE: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">......................................................</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">ha desarrollado sus actividades laborales como: <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">......................................................</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div  style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Desde:<span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;"> .........................</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div  style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Hasta:<span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;"> .........................</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le expide este documento para los fines necesarios.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-right">
                                                    <div  style="text-align: right !important;">
                                                        <span class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;"> ............de............19</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p2">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p2" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div>
                                                        <p style="color: #000;font-weight: 600;font-size: 20px;"><u>SE CERTIFICA A:</u> <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">..................................</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Por haber trabajado en el periodo del <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span> hasta el: <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">en el cargo de: <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Durante el tiempo que estuvo con nosotros observó buena conducta y puntualidad con dedicación exclusiva a las labores encomendadas.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-left">
                                                    <div style="text-align: left !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p3">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p3" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div style="text-align: justify !important;">
                                                    <div>
                                                        <p style="color: #000;font-weight: 600;font-size: 20px;">El que da fé a la presente certifica a <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">________________________________</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">quién ha laborado al servicio nuestro desde <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span> Hasta: <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span>.</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">fecha que se retira voluntariamente siendo su último cargo: <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le expide a solicitud del interesado para los fines que le pueda convenir.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-right">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p4">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p4" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div style="text-align: justify !important;">
                                                    <div>
                                                        <p style="color: #000;font-weight: 600;font-size: 20px;">El que suscribe la presente CERTIFICA:  Que,<span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">_________________________</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">ha laborado en el cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________</span> en el periodo comprendido desde <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_________________</span> 
                                                        hasta <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_______________________</span>, fecha que se retira voluntariamente mediante carta notarial.</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Durante su permenencia ha demostrado eficiencia, puntualidad y espíritu de superación.</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le expide el presente a solicitud verbal del interesado para los fines que convengan.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-right">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p5">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p5" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 20px;">El funcionario autorizado hace constar que:</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 20px;">
                                                            <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">________________________________________</span> ha laborado al servicio nuestro por el periodo
                                                            desde: <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">________________</span> hasta <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">________________</span>
                                                             siendo su último cargo <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">_________________________</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le extiende este documento para los fines que estime conveniente.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-left">
                                                    <div style="text-align: left !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p6">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p6" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CONSTANCIA DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 20px;"><u>Se Certifica:</u></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="text-indent: 5em; color: #000;font-weight: 600;font-size: 20px;">
                                                            Que el Sr. <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">________________________</span> se desempeño como <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________</span> en el
                                                            periodo desde <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span> hasta <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span>.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="text-indent: 5em; color: #000;font-weight: 600;font-size: 18px;">Durante el tiempo que laboró demostró puntualidad, eficiencia espíritu de superación.</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="text-indent: 5em; color: #000;font-weight: 600;font-size: 18px;">Se le otorga este documento para los usos que estime conveniente.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p7">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p7" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO LABORAL</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">
                                                            Se Certifica A <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">______________________________</span>
                                                             por haber laborado desde el <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________________</span>
                                                             hasta el <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span>, siendo su último cargo <span style="color: #FF0000;font-weight: 600;font-size: 18px;" class="cargo_imp">___________________</span>.
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Durante el desarrollo de sus actividades, fue felicitado en reiteradas oportunidades, distinguiéndose por su puntualidad, honradez y dedicación exclusiva a las labores encomendadas.</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le extiende para los fines del caso.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-left">
                                                    <div style="text-align: left !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_p8">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_p8" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style=" text-indent: 5em; color: #000;font-weight: 600;font-size: 18px;">
                                                            Se Certifica A :<span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________________________</span>
                                                             quien trabajó en el cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________________</span>
                                                             con fecha de ingreso el <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_________________________</span>
                                                             y fecha de cese <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________</span>, retirándose voluntariamente mediante aviso notarial.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le extiende para los fines que estime conveniente.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-right">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>  

                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_m1">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_m1" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CONSTANCIA DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="text-indent: 5em;  color: #000;font-weight: 600;font-size: 18px;">
                                                            Se deja constancia que : <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________</span>
                                                            , ha prestado servicios en el cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">_______________</span>,
                                                            desde el <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________</span> hasta el <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________</span>,
                                                             fecha que se retira mediante carta de retiro.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="text-indent: 5em; color: #000;font-weight: 600;font-size: 18px;">Se le otorga en agradecimiento a los servicios prestados para los que crea conveniente.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-right">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_m2">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_m2" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">
                                                            Se certifica : A <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">_____________________________</span>
                                                             quien ha laborado desde el <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________</span>
                                                             hasta el <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________</span> , desempeñando el
                                                             cargo de: <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">_________________________________</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Durante el tiempo que trabajó se distinguió por su puntualidad, sentido de responsabilidad y eficiencia.</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le otorga para los fines del caso.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-right">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_m3">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_m3" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">
                                                            A favor de <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">________________________________</span>
                                                             quién laboró como <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">___________________________</span>
                                                             desde <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">________________</span> hasta <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">________________</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Durante el periodo que estuvo bajo nuestra dependencia se distinguió por su puntualidad, dedicación exclusiva a las labores encomendadas y honradez a toda prueba.</p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le otorga este documento para los fines del caso.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-left">
                                                    <div style="text-align: left !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_m4">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_m4" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CONSTANCIA</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">
                                                            Se Certifica: A: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">____________________________</span>,
                                                             al haberse desempeñado como empleado en el cargo de:
                                                            <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">___________________</span>, desde <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">________________</span>
                                                             Hasta: <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________</span>, fecha en que se retira voluntariamente por motivos particulares, desempeñándose a nuestra entera y completa satisfacción.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Se le extiende el documento a la parte interesada para los usos que estime necesario.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-left">
                                                    <div style="text-align: left !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_m5">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_m5" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1  class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>CONSTANCIA LABORAL</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">
                                                            El que suscribe la presente deja constancia que el Sr.(a) <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">_______________________________________</span>,
                                                            ha trabajado en el Area de <span style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________</span>
                                                            en el cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">______________________________</span>.
                                                        </p>
                                                    </div>
                                                </div>
                                               
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">-desde el : <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_________________________________</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">-hasta el : <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 18px;">_________________________________</span></p>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="text-indent: 1em; color: #000;font-weight: 600;font-size: 18px;">Se otorga este documento a solicitud de la parte interesada para los usos que crea conveniente.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-right">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g1">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g1" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 22px;"><u>SE CERTIFICA QUE:</u></h1>
                                                    </div>
                                                </div>
                                                <br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Al trabajador <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    </div>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">quien laboró como <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    </div>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">durante el tiempo:</p>
                                                    </div>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Fecha de Ingreso: <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    </div>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Fecha de Cese: <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Durante el tiempo de estuvo bajo nuestra dependencia se distingue por ser puntual, responsable de sus actos y honradez a toda prueba.</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">A SOLICITUD DEL INTERESADO, SE EXTIENDE LA CONSTANCIA PARA EL USO QUE EL, LE PUEDA DAR.</p>
                                                        <br>
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se le extiende este documento para los fines que le convenga.</p>
                                                    </div>
                                                </div>
                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g2">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g2" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 22px;"><u>CERTIFICADO DE TRABAJO:</u></h1>
                                                    </div>
                                                </div>
                                                <br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">EL FUNCIONARIO DE LA EMPRESA DEL RUBRO CERTIFICA: </p>
                                                    </div>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">A Don <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> el haber desempeñado sus labores durante el periodo desde el <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> fecha que se retira voluntariamente por razones personales.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se hace hincapié que Don <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> fué un personal diligente y colaborador siempre dispuesto a colaborar en la medida de sus posibilidades, por lo que se cumple con emitirle este certificado para los fines que le convenga.</p>
                                                    </div>

                                                </div>
                                                
                                                <br><br><br><br>
                                                <div class="text-right">
                                                    <div style="text-align: left !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g3">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g3" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA DE SERVICIO LABORAL</u></h1>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: left !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">El representante legal de la empresa conforme a las leyes laborales en vigencia</p>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 22px;"><u>CERTIFICA QUE:</u></h1>
                                                    </div>
                                                </div>
                                                <br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Al Don: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> que se desempeñó como empleado ejerciendo el cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> en el periodo comprendido del <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta el <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, fecha que hizo su retiro voluntariamente. </p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se deja establecido que durante el ejercicio de sus funciones se distinguió por su puntualidad, laboriocidad recibiendo felicitaciones por parte de funcionarios de la empresa; emitiendose la presente para los usos o fines que tenga por conveniente.</p>
                                                    </div>                  
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g4">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g4" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: left !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">El personal directivo de la empresa que suscribe</p>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 22px;">C E R T I F I C A </h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Que, el Sr <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> estuvo laborando a favor nuestro en el periodo comprendido desde el <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta el <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> retirándose mediante carta notarial. </p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Nuestro trabajador tuvo un desempeño satisfactorio en el Cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> siendo felicitado en reiteradas oportunidades por lo que se le extiende este certificado para los usos que estime conveniente. </p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g5">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g5" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA DE LABORES</u></h1>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: left !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">EL PERSONAL REPRESENTANTE LEGAL DE LA EMPRESA</p>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 22px;">CERTIFICA:</h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Al Sr. <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> por haber laborado a nuestro favor en el cargo de  <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                        <br>
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Desde : <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Hasta : <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Retirándose voluntariamente por razones personales. </p>
                                                        <br>
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Expedímos este documento solicitado por la parte interesada para los fines que estime necesario. </p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g6">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g6" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>C e r t i f i c a d o</u></h1>
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>d e</u></h1>
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>T r a b a j o</u></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"><u>Se Certifica</u> A <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> en el cargo de   <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, durante el tiempo comprendido desde <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, fecha que se hace su retiro voluntario.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Cuando estuvo bajo nuestra dependencia se distinguió por su alto sentido de responsabilidad, eficiencia y descreción.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se le expide el presente documento a solicitud verbal de la parte interesada para los fines que estime por conveniente.</p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g7">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g7" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>Certificado de Trabajo</u></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"><u>Se Certifica</u> A: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> quien ha laborado en nuestra representada, como <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, durante el periodo que comprende desde <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Cuando estuvo bajo nuestra dependencia su labor fué satisfactoria, en todo momento apoyó en los trabajos encomendados, siendo puntual, con una honradez acrisolada.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se le emite este documento en concordancia con lo dispuesto a las leyes laborales.</p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g8">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g8" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA LABORAL</u></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"> El que suscribe deja establecido que <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, ha trabajado como <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, con fecha de ingreso: <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, y de salida <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Durante el tiempo de su permanencia fué una persona disciplinada de buena conducta y una honradez a toda prueba.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">A solicitud de la parte interesada se le otorga este documento.</p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g9">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g9" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>Certificado Laboral</u></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"> El Funcionario del rubro deja constancia que la persona de <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> fue trabajador de nuestra representada con fecha de ingreso: <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> siendo su último cargo <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Durante el desempeño de sus actividades fue un personal eficiente de espíritu de superación, diligente y honradez.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se le otorga para los fines que estime conveniente.</p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: left !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g10">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g10" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"> El Funcionario que suscribe hace constar que: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, ha laborado a favor nuestro en el cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> con fecha de Ingreso: <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> Fecha de Salida: <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Desarrollando sus actividades a nuestra completa y entera satisfaccion con disciplina, buena conducta y honradez.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se le otorga para los fines del caso.</p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g11">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g11" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"> El suscrito de conformidad a las leyes laborales en vigencia hace constar que: </p>
                                                        <br>
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"> El trabajador: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, ha laborado desde: <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta el: <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> siendo su último cargo: <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Durante el tiempo de servicio se distingue por su puntualidad, eficiencia y desempeño laboral conforme a los alienamientos de la empresa.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se expide para los fines que sean necesarios.</p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_g12">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_g12" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="certificado_imp">
                                                <div class="text-center">
                                                    <div style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>C e r t i f i c a d o</u></h1>
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>d e</u></h1>
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>T r a b a j o</u></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"> Que, de nuestros archivos se acredita que la persona de <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> ha presentado servicios en el cargo de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, desde el <span class="desde_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> hasta <span class="hasta_imp_num" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>, que se retira voluntariamente.</p>
                                                    </div>
                                                    <br><br>
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">Se deja constancia que el trabajador durante su dependencia demostró eficiencia, puntualidad, dedicación exclusiva a las labores encomendadas, por lo que se le otorga este documento para los fines que le pueda convenir.</p>
                                                    </div>
                                                </div>

                                                <br><br><br><br>
                                                <div class="text-center">
                                                    <div style="text-align: right !important;">
                                                        <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_0">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_0" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;" ></h1>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            
                                            <div class="text-right">
                                                <div  style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 16px;" id="lugardia" ></p>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">SE DEJA CONSTANCIA QUE EL SEÑOR(A) <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;" id="nombre_imp"></span> HA LABORADO PARA NUESTRA EMPRESA COMO <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;" id="cargo_imp"></span>  A PARTIR DEL <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;" id="desde_imp"></span> AL <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;" id="hasta_imp">.</span></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">DURANTE SU TIEMPO DE SERVICIOS EL MENCIONADO SEÑOR, DEMOSTRO EN TODO MOMENTO UN ALTO GRADO DE RESPONSABILIDAD EN LAS TAREAS ENCOMENDADAS POR LA EMPRESA.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">A SOLICITUD DEL INTERESADO, SE EXTIENDE LA CONSTANCIA PARA EL USO QUE EL, LE PUEDA DAR.</p>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-right">
                                                <div  style="text-align: right !important;">
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;" ></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_1">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado();">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_1" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 22px;">EMPRESA</h1>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">MEDIANTE LA PRESENTE, SE CERTIFICA A LA
                                                        SRA. <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, AL HABER
                                                        TRABAJADO EN ESTA EMPRESA, COMO <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">
                                                            XXXXXXXXX </span>, DESDE EL <span class="desde_imp"
                                                            style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span> HASTA EL <span class="hasta_imp"
                                                            style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span> , FECHA EN QUE SE
                                                        RETIRA VOLUNTARIAMENTE.</p>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;"> DURANTE EL TIEMPO DE PERMANENCIA EN LA
                                                        EMPRESA HA DEMOSTRADO RESPONSABILIDAD Y EFICIENCIA EN EL DESEMPEÑO DE SUS FUNCIONES. </p>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;"> SE LE EXPIDE EL PRESENTE CERTIFICADO A
                                                        SOLICITUD DE LA INTERESADA, PARA LOS FINES DE ESTIME CONVENIENTE. </p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;"></p>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">
                                                        .........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">LUIS TORRES HERNANDEZ.</p>
                                                    <!--<p style="color: #000;font-weight: 600;font-size: 16px;">GERENTE</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_2">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_2" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 22px;">EMPRESA</h1>
                                                </div>
                                            </div>
                                            <br><br><br><br>

                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 16px;">FECHA</p>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">SE DEJA CONSTANCIA QUE EL SEÑOR(A) <span class="nombre_imp"
                                                            style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> HA LABORADO PARA
                                                            NUESTRA EMPRESA COMO <span class="cargo_imp"
                                                            style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span>
                                                             A PARTIR DEL <span class="desde_imp"
                                                            style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXXXX</span> AL <span class="hasta_imp"
                                                            style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXXXX.</span></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">DURANTE SU TIEMPO DE SERVICIOS EL
                                                        MENCIONADO SEÑOR, DEMOSTRO EN TODO MOMENTO UN ALTO GRADO DE RESPONSABILIDAD EN LAS TAREAS
                                                        ENCOMENDADAS POR LA EMPRESA.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">A SOLICITUD DEL INTERESADO, SE EXTIENDE LA
                                                        CONSTANCIA PARA EL USO QUE EL, LE PUEDA DAR.</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_3">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_3" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 22px;">EMPRESA</h1>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">CERTIFICAMOS, QUE EL SEÑOR(A) <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, TRABAJO EN NUESTRA INSTITUCIÓN DESDE EL <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span> HASTA EL <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span> , FECHA EN QUE SE RETIRÓ POR CONVENIR A SUS INTERESES.</p>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;"> DEJAMOS CONSTANCIA QUE, DURANTE EL TIEMPO QUE TRABJAÓ EN NUESTRA INSTITUCIÓN, COMO <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span> , EN DIVERSOS CARGOS, HIZO SUS LABORES A NUESTRA SATISFACCIÓN. </p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;"> </p>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">______</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_4">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_4" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 22px;">EMPRESA</h1>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">CERTIFICADO</h1>
                                                </div>
                                            </div>
                                            <br><br><br>

                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 16px;"></p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>EL QUE SUSCRIBE CERTIFICA:</u></h1>
                                                </div>
                                                <br>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">QUE, EL SEÑOR/ <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> HA DESEMPEÑADO SUS LABORES EN NUESTRA COMO <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXXXX</span>, DURANTE EL PERIODO DEL <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">30-01-1995</span> AL <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">30-03-1995</span>. DEMOSTRANDO CAPACIDAD EFICIENCIA Y ENTREGA EN LAS LABORES ENCOMENDADAS</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">SE OTORGA EL PRESENTE DOCUMENTO A SOLICITUD DEL INTERESADO PARA LOS FINES QUE CREA NECESARIOS.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">A SOLICITUD DEL INTERESADO, SE EXTIENDE LA CONSTANCIA PARA EL USO QUE EL, LE PUEDA DAR.</p>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: right !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">LUIS TORRES HERNANDEZ.</p>
                                                    <!--<p style=" text-align: right;color: #000;font-weight: 600;font-size: 16px;">GERENTE</p>-->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_5">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_5" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 22px;">EMPRESA</h1>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u>CERTIFICAMOS</u> : QUE, EL SEÑOR: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> HA TRABAJADO EN <span class="emp_imp"></span> DESDE <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">15.12.70</span> HASTA EL <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">30.11.1979</span>. DESEMPEÑANDOSE COMO ULTIMO CARGO DE <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;"><u>ENCARGADO DE CASA COMERCIALIZADORA</u>.</span></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">DURANTE EL TIEMPO DE SU PERMANENCIA DEMOSTRÓ PUNTUALIDAD, BUENA CONDUCTA, ESPÍRITU DE COLABORACIÓN GANANDOSE EL APRECIO DE SUS SUPERIORES Y COMPAÑEROS DE TRABAJO.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">SE LE OTORGA EL PRESENTE A SOLICITUD VERBAL DEL INTERESADO PARA LOS FINES QUE EL ESTIME NECESARIO..</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 16px;"></p>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">ERNESTO CHONG FLORES</p>
                                                    <!--<p style=" color: #000;font-weight: 600;font-size: 16px;">GERENTE GENERAL</p>-->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_6">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_6" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 24px;">COMPAÑIA AGRICOLA SAN JORGE S.A.</h1>
                                                </div>
                                            </div>

                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">El que uscribe, Sr. <span class="firmante_nom"></span> . en calidad de Gerente de la Compañía <span class="emp_imp"></span> </p>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;"><u>CERTIFICAMOS</u> : Que, doña <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, prestado servicios en esta Compañía desde el <span class="desde_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">10 de enero de 1973</span> HASTA EL <span class="hasta_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">15 de diciembre de 1982</span>. ocupando el puesto de  <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"><u>SECRETARIA DE GERENCIA</u>.</span></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Cabe resaltar que la mencionada ex trabajadora en todo momento demostró eficiencia y cumplimiento de metas establecidas por el Empresa..</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Se extiende el presente documento a favor de la interesada para los fines que ella crea conveniente.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">Chancay, 30 DE NOVIEMBRE DE 1982</p>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 18px;">German Casapia Cano</p>
                                                    <!--<p style=" color: #000;font-weight: 600;font-size: 18px;">GERENTE GENERAL</p>-->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_7">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_7" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 22px;">EMPRESA</h1>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 16px;">LIMA. 20 DE MAYO DE 1995</p>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>

                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">SE DEJA EN CONSTANCIA QUE LA SRA.<span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> HA LABORADO NUESTRA EMPRESA, COMO <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">GERENTE DE RELACIONES PUBLICAS</span> A PARTIR DEL <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">20/02/1983</span> AL <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">31/12/1994</span>. </p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">DURANTE SU TIEMPO DE SERVICIOS LA MENCIONADA SEÑORA OBSERVO EN TODO MOMENTO UN ALTO GRADO DE RESPONSABILIDAD EN LAS TAREAS ENCOMENDADAS POR LA EMPRESA.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">A SOLICITUD DE LA INTERESADA, SE EXTIENDE LA CONSTANCIA PARA EL USO QUE ELLA, LE PUEDA DAR.</p>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">JUSTO I. SALAZAR ORE</p>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">ADMINISTRADOR</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_8">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_8" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 22px;">EMPRESA</h1>
                                                </div>
                                            </div>

                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">QUIEN SUSCRIBE EL SR. <span class="firmante_nom"></span> , ADMINISTRADOR.</p>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICA A:</u></h1>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;"><span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, AL HABER TRABAJADO PARA NUESTRA EMPRESA DSDE EL <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">12 DE ENERO DE 1983</span> Y SIENDO SU TERMINO DE SU VINCULO LABORAL EL  <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 31 DE AGOSTO E 1994 </span>, EL CARGO QUE OCUPO FUE EL DE <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"><u>JEFE DE PRODUCCION TEXTIL</u>.</span></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">LA EMPRESA DEJA CONSTANCIA, DE ESTA SOLICITUD A PEDIDO DEL INTERESADO PARA LOS FINES QUE ESTIME CONVENIENTE.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">LIMA, 15 DE DICIEMBRE DE 1994</p>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 18px;">MIGUEL A. BEGAZO MENDOZA </p>
                                                    <p style=" color: #000;font-weight: 600;font-size: 18px;">ADMINISTRADOR</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1018px !important;" id="prev_certificado_9">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_9" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;" ></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 18px;">CERTIFICAMOS :</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Que el Señor <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span> ha prestado servicios en nuestra empresa desde el <span class="desde_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">03 de junio de 1975</span> hasta el <span clas="hasta_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 19 de Agosto de 1983 </span>.</p>
                                                </div>
                                                <br>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Durante su permanencia en esta Cía, se ha desempeñado como <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"> OFICINISTA </span>, demostrando eficiencia y puntualidad en sus funciones; siendo su retiro voluntario.</p>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <div style="text-align: justify !important;">
                                                        <p style="color: #000;font-weight: 600;font-size: 18px;">Extendemos el pte. a la solicitud de la parte interesada para los fines que crea conveniente.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;"></p>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">ADMINISTRACION</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_10">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_10" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">Cooperativa Agraria de Trabajadores</h1>
                                                    <!--<h1 style="color: #000;font-weight: 600;font-size: 20px;">Cooperativa Agraria de Trabajadores</h1>
                                                    <h2 style="color: #000;font-weight: 600;font-size: 20px;">"CARRASCO Ltda. N° 24 "</h2>
                                                    <h3 style="color: #000;font-weight: 600;font-size: 20px;"><u>PABUR LA MATANZA</u></h3>-->
                                                </div>
                                            </div>

                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">El que suscribe, Presidente del Consejo de Administración de la  <span class="emp_imp"></span>, ubicada en Pabur, Comprensión del Distrito de la Matanza, Provincia de Morropón, Departamento de Piura.</p>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">CERTIFICA :</h1>
                                                    <br>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Que el Señor. <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, Trabajo en <span class="emp_imp"></span> desde el <span class="desde_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">12 de Marzo de 1976 </span>, hasta el  <span class="hasta_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 31 de Diciembre de 1991 </span> desempeñando el Cargo de  <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">OBRERO</span>, su labor ha sido en todo momento eficiente y ha demostrado responsabilidad, honradez, durante los años que prestó servicio. El presente certificado lo extiendo a solicitud del Interesado para los fines que estime conveniente.</p>
                                                </div>
                                            </div>
                                            <br>
                                            
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">Carrasco, 5 de enero de 1992</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_11">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_11" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">CABREDO HERMANOS S. A.</h1>
                                                    <h2 style="color: #000;font-weight: 600;font-size: 16px;text-align: left"><span class="departamento_imp"></span> - PERU</h2>
                                                </div>
                                            </div>    
                                           
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Los suscritos certifican:</p>

                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Que, don <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, ha prestado servicios en nuestra firma desde el <span class="desde_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">8 de Marzo de 1967 </span> hasta el  <span class="hasta_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 31 de Diciembre de 199115 de Agosto de 1970 </span>, como  <span class="cargo_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> Empleado de Oficina - Seccion Contabilidad </span>.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Durante su permanencia en nuestra empresa el Sr. Ancajina Fernández se ha desempeñado eficientemente, habiendo demosrado honradez y dedicación al trabajo, siendo su retiro voluntario.</p>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Se le extiende el presente a solicitud del interesado para los fines que crea convenientes.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p class="lugardia_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">Catacaos, 17 de Agosto de 1970</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_12">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_12" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h2 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">COMERCIAL EYZAGUIRRE E.I.R.L.</h2>
                                                    <h3 class="departamento_imp" style="color: #000;font-weight: 600;font-size: 20px;text-align: left;">P I U R A</h3>
                                                </div>
                                            </div>   
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">El que suscribe el Director Gerente de <span class="emp_imp"></span></p>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">CERTIFICA :</h1>
                                                    <br>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Que, el Sr. <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, ha prestado sus servicios en nuestra empresa desde el <span class="desde_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">01 de Diciembre de 1984 </span> al <span class="hasta_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 31 de Julio de 1986 </span>, desempeñandose en el Cargo de <span class="cargo_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> Auxiliar de Contabildiad </span>.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">El mencionado señor se ha desempeñado con eficiencia, responsabilidad y dedicación a las tareas encomendadas.</p>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Se expide el presente certificado a solicitud del interesado para los fines que crea convenientes.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">Piura, 31 de Julio de 1986</p>
                                                </div>
                                            </div>

                                            <br><br><br><br><br>

                                            <div class="text-center">
                                                <div style="text-align: right !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">NESTOR EYZAGUIRRE ZAPATA</p>
                                                    <!--<p style="color: #000;font-weight: 600;font-size: 16px;">GERENTE</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_13">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_13" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h2 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">COMERCIAL EYZAGUIRRE E.I.R.L.</h2>
                                                    <h3 class="departamento_imp" style="color: #000;font-weight: 600;font-size: 20px;text-align: left;">P I U R A</h3>
                                                </div>
                                            </div>   

                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">El que suscribe,</p>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">CERTIFICA :</h1>
                                                    <br>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Que, el Sr. <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, ha laborado para esta empresa como <span class="cargo_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">OBRERO</span>, desde el <span class="desde_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;">08 de Agosto de 1989 </span>, hasta el <span class="hasta_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 31 de Octubre de 1989 </span>.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Durante su permanencia e la empresa demostró eficiencia y responsabilidad en el desempeño de sus funciones.</p>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Este documento se extiende a solicitud del interesado para los fines que estime conveniente.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">Piura, Octubre de 1989</p>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: right !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">Henry Stewart Ch.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_14">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_14" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h2 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">COMERCIAL EYZAGUIRRE E.I.R.L.</h2>
                                                    <h3 class="departamento_imp" style="color: #000;font-weight: 600;font-size: 20px;text-align: left;">P I U R A</h3>
                                                </div>
                                            </div>   

                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #0000FF;font-weight: 600;font-size: 18px;">El que suscribe: EULOGIO FEDERICO HIGUERAS ALFARO, Propietario de la Hacienda Carrasco, Judireccion del Distrito de la Matanza, Morropon.</p>
                                                </div>
                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>C E R T I F I C A :</u></h1>
                                                    <br>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Que, el Señor <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, ha laborado en nuestro fundo desempeñando labores de Campo en calidad de <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"> OBRERO </span>, durante el periodo del <span class="desde_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 01 de Enero de 1970 </span>, hasta el <span class="hasta_imp_low" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 31 de Diciembre de 1975 </span>, habiendo concluido sus labores por razones de expropiacion de Reforma Agraria.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Durante el tiempo que ha permanecido en nuestro FUNDO, ha demostrado HONRADEZ, CUMPLIMIENTO Y RESPONSABILIDAD en sus funciones, encomendadas</p>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Por lo que se expide la presente Certificación, a solicitud de la parte interesada para los fines que estime conveniente, de lo que doy fé.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">Hda. Pabur Carrasco, 31 de Diciembre de 1975</p>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">Eulogio F. Higueras Alfaro</p>
                                                    <!--<p style="color: #000;font-weight: 600;font-size: 16px;">PROPIETARIO</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_15">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_15" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h2 class="emp_imp" style="color: #000;font-weight: 600;font-size: 24px;">COMERCIAL EYZAGUIRRE E.I.R.L.</h2>  
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>C E R T I F I C A D O</u></h1>
                                                    <br>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;"> QUIEN SUSCRIBE CERTIFICA AL SEÑOR <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, COMO EX-TRABAJADOR NUESTRO POR SU TIEMPO DE LABORES QUE TUVO DESDE EL <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">05-01-1971 </span>, HASTA EL <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 28-12-1984 </span>, OCUPANDO EL CARGO DE <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"> SUPERVISOR </span>.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">SE EXTIENDE EL PRESENTE DOCUMENTO PARA LOS FINES QUE EL INTERESADO CREA CONVENIENTE.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">HUANCAYO, 15 DE DICIEMBRE DE 1999</p>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">HUGO GOICOCHEA HERRERA</p>
                                                    <!--<p style="color: #000;font-weight: 600;font-size: 16px;">LIQUIDADOR</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_16">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_16" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important; margin: auto 0 ;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 24px;"><u>CASAS TRAILERS BUSA S.A.</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>Certificado de Trabajo</u></h1>
                                                    <br>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">El que suscribe Certifica: Al Sr. <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">XXXXXXX</span>, por haber trabajado para nuestra empresa en el periodo comprendido desde el <span class="desde_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;">01 ed Mayo de 1965 </span> hasta el  <span class="hasta_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"> 30 de Abril de 1980 </span>, en el Cargo de  <span class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 18px;"> ALMACENERO </span>.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Distinguiéndose por su eficiencia y dedicación exclusiva a las lavores que le fueron encomendadas.</p>
                                                    <br>
                                                    <p style="color: #000;font-weight: 600;font-size: 18px;">Se expide el presente certificado a solicitud del interesado.</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p class="lugardia" style="color: #FF0000;font-weight: 600;font-size: 18px;">Lima, 13 de Mayo de 1980.</p>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">Juan Bustamante Valdivia</p>
                                                    <!--<p style="color: #000;font-weight: 600;font-size: 16px;">GERENTE</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_17">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_17" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">Compañia Industrial ibatex s.a</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u>SE CETIFICA A: </u><span class="nombre_imp" style="color: #000;font-weight: 600;font-size: 16px;">GENARA HUAINA CHAMBILLA CALIZAYA</span>, por haber trabajado para esta Compañia a partir del <span class="desde_imp_low" style="color: #000;font-weight: 600;font-size: 16px;"></span> hasta el <span class="hasta_imp_low" style="color: #000;font-weight: 600;font-size: 16px;"></span>, como <span class="cargo_imp_low" style="color: #000;font-weight: 600;font-size: 16px;"></span>, Demosatrando puntualidad, eficiencia y honradez en el trabajo encomendado</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><span style="color: #000;font-weight: 600;font-size: 16px;"></span>Se expide el presente certificado a solicitud de la interesada para los fines que estime conveniente.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 26 de Junio de 1982</p>
                                                </div>
                                            </div>
                                            <div class="row justify-content-start mb-5">
                                                <div class="col-6">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_18">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_18" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">MERCANTIL YOLY S.A</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Por el presente Certificado que el señor(a)
                                                        <span class="nombre_imp">JUANA FLORENCIA GUERRERO CANTA</span>, ha trabajado en nuestra Empresa a partir del <span class="desde_imp_num">17-01-1972</span> hasta el dia 
                                                        <span class="hasta_imp_num">15-12-1987</span>, siendo su ocupacion laboral de <span class="cargo_imp">Supervisor</span>, desempeñandose durante ese tiempo a nuestra entera satisfacción, demostrando cumplimento y honradez en sus labores</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Indicamos que el señor(a) <span class="nombre_imp"></span>, se retira por su propia voluntad</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Extendemos el presente certificado a solicitud de la interesada para los fines convenientes</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 28 de Diciembre de 1987</p>
                                                </div>
                                            </div>
                                            <div class="row justify-content-start mb-5">
                                                <div class="col-6">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_19">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_19" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">EMPRESA</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO LABORAL</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Se deja expresa constancia a favor del señor(a) <span class="nombre_imp"></span>, por haber trabajado para esta empresa en calidad de <span class="cargo_imp">SUPERVISOR</span>, desde el <span class="desde_imp_num">01-10-1987</span> hasta el <span class="hasta_imp_num">28-02-1989</span>, habiendo hecho un buen trabajo en nuestra empresa.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Se emite este documento para los fines pertinentes del ex-trabajador</p>
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia_num" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 08/03/1989</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="d-flex justify-content-center mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">LABIDE S.A</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">

                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">Eulogio F. Higueras Alfaro</p>
                                                    <!--<p style="color: #000;font-weight: 600;font-size: 16px;">PROPIETARIO</p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_20">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_20" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">CACEMA S.R.LTDA.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-left">
                                                <div  style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO LABORAL</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> Se certifica a <span class="nombre_imp">DAMASO VICTOR LOPEZ SALAZAR</span>, por haber trabajado para nuestra representada, desde <span class="desde_imp_num">20/01/1969</span> hasta el <span class="hasta_imp_num">05/08/1979</span>, como <span class="cargo_imp_low"></span>. </p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Durante sus labores el señor(a) <span class="nombre_imp"></span> , demostró eficiencia, y una honradez a toda prueba.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Se expide el presente documento de solicitud del interesado para los fines que mas crea conveniente. </p>
                                                </div>
                                            </div>

                                            <br><br>

                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia_num" style="color: #000;font-weight: 600;font-size: 16px;">La Vitcoria, 24/08/1979</p>
                                                </div>
                                            </div>
                                            
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">Eulogio F. Higueras Alfaro</p>
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 16px;">PROPIETARIO</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_21">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_21" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">FACTURA GENERAL S.A.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> El que suscribe certifica a: <span class="nombre_imp">MARUJA KANUELLA MAMANI CONDORI</span> por su desempeño en trabajar para esta empresa a nuestra entera satisfacción durante el periodo del <span class="desde_imp_num">01-11-69</span> al <span class="hasta_imp_num">30-06-81</span>, desempeñando el cargo de <span class="cargo_imp">cargo</span></p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Se deja constancia que desempeñó su labor a nuestra entera satisfacción, por su corrección y eficiencia, reirandose por su propia voluntad</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">El presente certificado se expide a solicitud del interesado para los fines que estime conveniente </p>
                                                </div>
                                            </div>

                                            <br><br>

                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 14 de Setiembre de 1981</p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">Eulogio F. Higueras Alfaro</p>
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 16px;">EMPRESA</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_22">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_22" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-center mb-5">
                                                <div style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">DISTRIBUIDORA DE ALIMENTOS INKARI S.A.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> QUE, EL SEÑOR <span class="nombre_imp">ALBERTO LOPEZ CORDOVA</span> HA LABORADO EN NUESTRA EMPRESA EN EL CARGO DE <span class="cargo_imp">JEFE DE DISTRIBUCION</span>, DURANTE EL PERIODO COMPRENDIDO DESDE EL <span class="desde_imp_num">05-01-1980</span> HASTA EL <span class="hasta_imp_num">30-06-1994</span>. </p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> DURANTE EL TIEMPO QUE ESTUVO A NUESTRO SERVICIO DEMOSTRO PUNTUALIDAD, EFICIENCIA EN LAS LABORES ENCOMENDADAS Y HONRADEZ</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> EL PRESENTE CERTIFICADO SE LE EXPIDE A SOLICITUD DE LA PARTE INTERESADA PARA LOS FINES CONVENIENTES</p>
                                                </div>
                                            </div>

                                            <br><br>

                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">LIMA, 30 DE JUNIO DE 1994</p>
                                                </div>
                                            </div>
                                            <div class="row justify-content-start mb-5">
                                                <div class="col-6">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_23">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_23" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">AUTOMOTIVE PARTS S.A</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u>SE CETIFICA A:</u> don <span class="nombre_imp">NIEVES MOHA OSGO DONGO</span>, como nuestra ex-trabajadora, debido a su tiempo de servicio presentados a esta empresa, a partir del <span class="desde_imp_num">20/02/1974</span> hasta el <span class="hsata_imp_num">23/04/1983</span> habiendo ocupado el cargo de <span class="cargo_imp_low">vendedor</span>.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><span style="color: #000;font-weight: 600;font-size: 16px;"></span>Se expide el presente documento a favor de don <span class="nombre_imp"></span>.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia_num" style="color: #000;font-weight: 600;font-size: 16px;">La Victoria, 23/04/1983</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_24">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_24" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 18px;">CENTRAL DE COOP. AGRARIA "LA NUEVA ESPERANZA" LTDA.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 18px;"><u>CONSTANCIA LABORAL</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> Se deja expresa constancia a favor del Sr(a). <span class="nombre_imp">DARIO FELOZ PEÑA GUARDAMINO</span>, por haber trabajado para esta Institución en calidad de empleado, desempeñando el cargo de <span class="cargo_imp_low">Administrador</span> desde el <span class="desde_imp_num">01-03-1973</span> hasta el <span class="hasta_imp_num">05-01-1977</span>, fecha que se retira por renuncia voluntaria </p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">El Señor(a) <span class="nombre_imp">Dario Felix Peña Guardanino</span>, se desempeño a nuestra entera y completa satisfacción, distinguiendose por su espiritu de colaboracion, eficiencia y laboriosidad </p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> Se le expide esta constancia a solicitud del interesado para los fines que estime conveniente.</p>
                                                </div>
                                            </div>

                                            <br><br>

                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Bambo Grande, 28 de Junio de 1977</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_25">
                                    <div class="card" style="margin-top: 65px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_25" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">CACEMA S.R.LTDA.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-left">
                                                <div  style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO LABORAL</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"> Se certifica a <span class="nombre_imp">LUCILA AMANDA PEÑA GUARDAMINNO</span>, por haber trabajado para nuestra representada, desde <span class="desde_imp">20/01/1969</span> hasta el <span class="hasta_imp">05/08/1979</span>, como <span class="cargo_imp"></span>. </p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Durante sus labores el señor(a) <span class="nombre_imp"></span> , demostró eficiencia, y una honradez a toda prueba.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Se expide el presente documento de solicitud del interesado para los fines que mas crea conveniente. </p>
                                                </div>
                                            </div>

                                            <br><br>

                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia_num" style="color: #000;font-weight: 600;font-size: 16px;">La Vitcoria, 24/08/1979</p>
                                                </div>
                                            </div>
                                            
                                            <br><br><br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 16px;">Eulogio F. Higueras Alfaro</p>
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 16px;">PROPIETARIO</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_26">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_26" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">AUTOMOTIVE PARTS S.A</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>Se deja constancia que el Señor(a) <span class="nombre_imp">MAURILIO PEÑA GUARDAMINO</span>, ha laborado para nuestra empresa, como <span class="cargo_imp">JEFE DE ANALISTA COMERCIAL</span>, a partir del <span class="desde_imp">01 de Agosto de 1984</span> y siendo su cese el <span class="hasta_imp">15 de Marzo de 1994</span>.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><span style="color: #000;font-weight: 600;font-size: 16px;"></span>Durante su tiempo de servicios el mencionado señor <span class="nombre_imp"></span> demostro en todo momento un alto grado de responsabilidad en las tareas encomendadas por nuestra representada.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><span style="color: #000;font-weight: 600;font-size: 16px;"></span>A solicitud del interesado, se extiende la constancia para el uso que le pueda dar.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 10 de Julio de 1994.</p>
                                                </div>
                                            </div>
                                           <br>
                                           <br>
                                           <br>
                                           <div class="row justify-content-end">
                                                <div class="col">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                </div>
                                            </div>         
                                        </div>
                                    </div>
                                </div> 
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_27">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_27" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">DIPER DISTRIBUIDORA PERUANA S.A.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u>QUIEN SUSCRIBE CERTIFICA A:</u> <span class="nombre_imp">FRANCISCO REYES JUAREZ</span>, POR HABER TRABAJADO PARA ESTA EMPRESA DESDE EL <span class="desde_imp">18-01-1964</span> HASTA EL <span class="hasta_imp">20-12-198</span>, OCUPANDO EL CARGO DE <span class="cargo_imp">JEFE DE AREA DISTIBUCION DE PRODUCTOS</span>, CARGO QUE OCUPO A NUESTRA ENTERA SATISCACCION</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><span style="color: #000;font-weight: 600;font-size: 16px;"></span>SE EXPIDE LA PRESENTE SOLICITUD DEL INTERESADO</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia_num" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 30/12/1980</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_28">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_28" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">DISTRIBUCION SERVICIO, TRANSPORTE Y ALMACENAMIENTO S.A</h1>
                                                </div>
                                            </div>
                                            
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u>Certificamos que el Sr(a):</u> <span class="nombre_imp">Encarnación Rojas Lescano</span>, ha trabajado en nuestra empresa desde el <span class="desde_imp_low">25 de enero de 1981</span> y siendo su cese en <span class="hasta_imp_low">15 de octubre de 1995</span>, desempeñando como último cargo de <span class="cargo_imp_low">Gerente Comercial</span>. Durante el tiempo de su permanencia ha demostrado honradez, buena conducta en la empresa, extendiendose el presente certificado para los fines que estime conveniente.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-left">
                                                <div style="text-align:left !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 28 de Octubre de 1995</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="row justify-content-center">
                                                <div class="col">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                </div> 
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_29">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_29" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">CANDADOS PERUANOS S.A.</h1>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"></h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span> MEDIANTE LA PRESENTE, SE CERTIFICA A AL SEÑOR(A) <span class="nombre_imp">TEODOSIA VALENTINA SANCHES ESPINOZA</span>, AL HABER TRABAJADO EN ESTA EMPRESA, COMO <span class="cargo_imp">ATENCION AL PUBLICO</span> DESDE EL <span class="desde_imp_num">01.02.1969</span> HASTA EL <span class="hasta_imp_num">04.07.1978</span>, SEGÚN CONSTA EN LOS DOCUMENTOS REVISADOS DE LA EMPRESA.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>SE LE EXPIDE EL PRESENTE CERTIFICADO, A SOLICITUD DE LA INTERESADA, PARA LOS FINES QUE CREA CONVENIENTE</p>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 20.09.2005</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="row justify-content-start">
                                                <div class="col-6">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_30">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_30" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-center mb-5">
                                                <div  style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">AUTOS Y CAMIONES S.A.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u>Se certifica a <span class="nombre_imp">LEOPOLDO TENAZOA OJANAMA</span>, por haber trabajado para esta empresa, a partir del <span class="deade_imp_num">01-02-1970</span> hasta el <span class="hasta_imp_num">31-12-1982</span> como <span class="cargo_imp_low">Asistente de Abastecimiento</span>.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>Se le expide el presente certificado, a favor del interesado, para los fines que estime conveniente.</p>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Pasamayo, 03-01-1992</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="row justify-content-end">
                                                <div class="col-6">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_31">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_31" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">AGENCIA AYULO DE SUPE LTDA. Callao No. 220</h1>
                                                </div>
                                            </div>
                                            <!--<div class="d-flex justify-content-between mb-4">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">Telefonos 5 y 28 apartado 25 Puerto SUPE</h1>
                                                </div>
                                            </div>-->
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICAMOS</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u>QUE DON <span class="nombre_imp">LUIS ALBERTO ALARCON MARTINEZ</span>, TRABAJO EN ESTA AGENCIA DESDE <span class="desde_imp">21 DE FEBRERO DE 1947</span> DESEMPÑANDOSE COMO <span class="cargo_imp">ASISTENTE ADMINISTRADOR</span>, OBSERVANDO BUENA CONDUCTA, HONRADEZ Y CONTRCCION AL TRABAJO, HASTA EL <span class="hasta_imp">24 DE ABRIL DE 1983</span></p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>SE EXPIDE EL PRESENTE SOLICITUD PARA LOS FINE QUE LE CONVENGA.</p>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">LIMA, 26 DE ABRIL DE 1983</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="row justify-content-end">
                                                <div class="col-6">
                                                    <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">EMPRESA</p>
                                                    <br><br><br>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_32">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_32" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">ASTOR PERUANA S.A.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u>SE CERTIFICA: </u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>AL SEÑOR(A) <span class="nombre_imp">EDMUNDO FASABI</span>, por haber trabajado como <span class="cargo_imp">VENDEDOR</span> desde el <span class="desde_imp_low">20 de Enero de 1986</span> hasta el <span class="hasta_imp_low">31 de Diciembre de 1997</span>, fecha que se retira voluntariamente efectuandose las retenciones a la Caja Nacional de Pensiones conforme a Ley.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u>El Sr. <span class="nombre_imp">Fasabi Fasabi</span> demostró en todo momento eficiencia dediación y una honradez acrisalada.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>Se le expide para los fines que el interesado estime conveniente.</p>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="text-left">
                                                <div style="text-left: right !important;">
                                                    <p class="hasta_imp_num" style="color: #000;font-weight: 600;font-size: 16px;">31/12/1997</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>  
                                <div class="container prev_certificado" style="max-width: 1020px !important;" id="prev_certificado_33">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_certificado_33" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-start mb-5">
                                                <div class="div_logo_pdf" style="text-align: right !important;">
                                                    <img class="img_logo" src="" alt="LOGO" id="" width="80px" height="48px">
                                                </div> 
                                            </div>
                                            <div class="d-flex justify-content-center mb-5">
                                                <div  style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;">CIA. CHIFA KAM WA S.A.</h1>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CERTIFICADO DE TRABAJO</u></h1>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>El que suscribe la presente CERTIFICA A don <span class="nombre_imp">MARIA BEATRIZ SARMIENTO BAUTISTA</span>, al haber laborado para nuestra representada durante el periodo Ingreso <span class="desde_imp_low">01 de Marzo de 1973</span> siendo su cese el <span class="hasta_imp_low">15 de Febrero de 1984</span>, que se retira voluntariamente habiendosele retienido de sus haberes a favor de la Caja Nacional de Pensiones conforme a Ley.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;"><u></u><span style="color: #000;font-weight: 600;font-size: 16px;"></span>Se le expide el presente documento a solicitud de la interesada para los fines del caso.</p>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="lugardia" style="color: #000;font-weight: 600;font-size: 16px;">Lima, 29 de Marzo de 1984</p>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="row justify-content-end">
                                                <div class="col-6">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;text-align: center">................................................</p>
                                                    <p class="firmante_nom" style="color: #000;font-weight: 600;font-size: 13px;text-align: center">FIRMANTE</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prevs_liquidacion" id="prev2">
                                <div class="container prev_liquidacion" style="max-width: 1020px !important;" id="liquidacion_0">
                                    <div class="card" style="margin-top: 30px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_liquidacion()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_liqui_0" class="card-body m-5 p-5 no-print">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;" class="emp_imp"></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>LIQUIDACION DE BENEFICIOS SOCIALES</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRES</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO DESEMPEÑADO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="cargo_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="desde_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE CESE</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="hasta_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TIEMPO DE SERVICIOS</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="tiempo_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;" ></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">MOTIVO DE CESE</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">RENUNCIA VOLUNTARIA</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACIÓN BÁSICA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.345.00</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">PAGO TOTAL</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.57.50</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>CÁLCULO DE LA COMPENSACIÓN</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">10.04.1998 AL 30.04.1999</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CTS DEPOSITADO EN BANCO</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">01.05.1999 AL 30.06.1999</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">2 MES</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REM. COMPEMSABLE: S/.345.00/12x2</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.57.50</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="border-bottom: 0.5mm solid; margin-bottom: 10px; margin-top: 10px;"></div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">Al firmar la presente liquidación dejo constancia expresa que los señores de <span style="color: #FF0000;font-weight: 600;font-size: 12px;" class="emp_imp"></span> han cumplido con abonarme todos los beneficios sociales conforme a Ley, por tanto, firmo dando por cancelado mi liquidación.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-right">
                                                <div  style="text-align: right !important;">
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="lugardia"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div>
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                </div>
                                                <div>
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container prev_liquidacion" style="max-width: 1020px !important;" id="liquidacion_1">
                                    <div class="card" style="margin-top: 30px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_liquidacion(1)">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_liqui_1" class="card-body m-5 p-5 no-print">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;" class="emp_imp"></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>LIQUIDACION DE BENEFICIOS SOCIALES</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">DATOS DEL TRABAJADOR</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">INICIO DE LABORES</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="desde_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE LABORES</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="hasta_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO </h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="cargo_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TIEMPO DE SERVICIOS</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="tiempo_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;" ></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">MOTIVO DE RETIRO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="motivo_retiro" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <!--<div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACIÓN BÁSICA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.345.00</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">PAGO TOTAL</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.57.50</h1>
                                                    </div>
                                                </div>-->
                                            </div>
                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                           
                                            <div id="" class="prev_modelo_liqui modelo_60_79">
                                                <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>CÁLCULO POR TIEMPO DE SERVICIO</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="desde_imp_num"></span> AL <span class="hasta_imp_num"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="tiempo_lq_total" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> <span class="anios_liqui"></span> x <span class="tipo_moneda"></span> <span class="sueldo_rm"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_sldo_anio"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="meses_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_sldo_mes"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SUB - TOTAL:</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_total_lq"></span> </h1>
                                                    </div>
                                                </div>
                                                
                                                <div class="bonif_liquidacion"></div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NETO A PAGAR:</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_total_lq_neto"></span> </h1>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div style="border-bottom: 0.5mm solid; margin-bottom: 10px; margin-top: 10px;"></div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">He recibido de la empresa <span class="emp_imp"></span>, la suma de S/ <span class="monto_total_lq_neto"></span> ( <span class="letras_monto"></span> SOLES DE ORO), por el concepto de mi indemnización por mi tiempo de servicios, conforme a Ley.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">Declaro que, con este pago, no tengo nada que reclamar a esta empresa, habiendo también recibido mi Certificado de Servicios.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">Por lo tanto, firmo el presente documento dando fé de lo recibido, estando totalmente CONFORME.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: right !important;">
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="lugardia"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div>
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                </div>
                                                <div>
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_liquidacion" style="max-width: 1020px !important;" id="liquidacion_2">
                                    <div class="card" style="margin-top: 30px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_liquidacion(2)">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_liqui_2" class="card-body m-5 p-5 no-print">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;" class="emp_imp"></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>LIQUIDACION DE BENEFICIOS SOCIALES</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRES DEL TRABAJADOR</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="desde_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE CESE</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="hasta_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO DESEMPEÑADO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="cargo_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TIEMPO DE SERVICIOS</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="tiempo_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;" ></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">MOTIVO DE RENUNCIA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="motivo_retiro" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <!--<div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACIÓN BÁSICA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.345.00</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">PAGO TOTAL</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.57.50</h1>
                                                    </div>
                                                </div>-->
                                            </div>
                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                            <div id="" class="prev_modelo_liqui modelo_60_79">
                                                <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>CÁLCULO POR TIEMPO DE SERVICIO</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="desde_imp_num"></span> AL <span class="hasta_imp_num"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="tiempo_lq_total" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> <span class="anios_liqui"></span> x <span class="tipo_moneda"></span> <span class="sueldo_rm"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_sldo_anio"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="meses_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_sldo_mes"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SUB - TOTAL:</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_total_lq"></span> </h1>
                                                    </div>
                                                </div>
                                                
                                                <div class="bonif_liquidacion"></div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NETO A PAGAR:</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_total_lq_neto"></span> </h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="" class="prev_modelo_liqui modelo_80_99">
                                                 <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>COMPENSACION POR TIEMPO DE SERVICIOS</u></h1>
                                                    </div>
                                                </div>
                                                 <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACION MENSUAL</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="sueldo_rm"  style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">VACACIONES TRUNCAS</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 12px;">CANCELADO</h1>
                                                    </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">GRATIFICACIONES TRUNCAS</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 12px;">CANCELADO</h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>CALCULO DE LIQUIDACION</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="desde_imp_num"></span> AL <span class="hasta_imp_num"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="tiempo_lq_total" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> <span class="anios_liqui"></span> x <span class="tipo_moneda"></span> <span class="sueldo_rm"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_anio"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="meses_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_mes"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="dias_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12/30</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_dia"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL:</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_total_lq"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="bonif_liquidacion"></div>
                                                <br>
                                                <div class="text-left">
                                                    <div  style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>NETO A PAGAR</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">A DEPOSITAR</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_total_lq_neto"></span></h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="border-bottom: 0.5mm solid; margin-bottom: 10px; margin-top: 10px;"></div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">SON: <span class="letras_monto"></span> SOLES ORO.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">Dejo expresa constancia que el monto indicado en la presente LIQUIDACION, corresponde al total de los BENEFICIOS SOCIALES, que me corresponden de acuerdo a Ley, no teniendo reclamo alguno en lo sucesivo que efectuar por este concepto en contra de la Empresa.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-right">
                                                <div  style="text-align: right !important;">
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="lugardia"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div>
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                </div>
                                                <div>
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_liquidacion" style="max-width: 1020px !important;" id="liquidacion_3">
                                    <div class="card" style="margin-top: 30px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_liquidacion(3)">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_liqui_3" class="card-body m-5 p-5 no-print">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;" class="emp_imp"></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>LIQUIDACION DE BENEFICIOS SOCIALES</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRES Y APELLIDOS</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="desde_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE CESE</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="hasta_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO OCUPADO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="cargo_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">RECORD DE TIEMPO DE SERVICIOS</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="tiempo_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;" ></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">MOTIVO DE SALIDA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="motivo_retiro" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL A COBRAR</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_total_lq_neto"></span></h1>
                                                    </div>
                                                </div>
                                                <!--<div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACIÓN BÁSICA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.345.00</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">PAGO TOTAL</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.57.50</h1>
                                                    </div>
                                                </div>-->
                                            </div>
                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                            <div id="" class="prev_modelo_liqui modelo_80_99">
                                                 <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>COMPENSACION POR TIEMPO DE SERVICIOS</u></h1>
                                                    </div>
                                                </div>
                                                 <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACION MENSUAL</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="sueldo_rm"  style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">VACACIONES TRUNCAS</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 12px;">CANCELADO</h1>
                                                    </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">GRATIFICACIONES TRUNCAS</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 12px;">CANCELADO</h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>CALCULO DE LIQUIDACION</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="desde_imp_num"></span> AL <span class="hasta_imp_num"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="tiempo_lq_total" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> <span class="anios_liqui"></span> x <span class="tipo_moneda"></span> <span class="sueldo_rm"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_anio"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="meses_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_mes"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="dias_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12/30</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_dia"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL:</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_total_lq"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="bonif_liquidacion"></div>
                                                <br>
                                                <div class="text-left">
                                                    <div  style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>NETO A PAGAR</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">A DEPOSITAR</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_total_lq_neto"></span></h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="border-bottom: 0.5mm solid; margin-bottom: 10px; margin-top: 10px;"></div>
                                            <br>
                                            <div class="text-left">
                                                <div  style="text-align: left !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">RECIBO:</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">He recibido de <span class="emp_imp"></span> , la suma de :
                                                        <span class="letras_monto"></span> INTIS, en cancelación de mis derechos y beneficios sociales que me corresponden de acuerdo a Ley, según la Liquidación que antecede y con lo que queda concluida mi relación laboral con dicha empresa.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">Dejo constancia que me encuentro de acuerdo con lo calculado por mi Tiempo de Servicios, elaborado por la Empresa, firmando la presente, no teniendo nada que reclamar en un futuro dado.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-right">
                                                <div  style="text-align: right !important;">
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="lugardia"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div>
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                </div>
                                                <div>
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_liquidacion" style="max-width: 1020px !important;" id="liquidacion_4">
                                    <div class="card" style="margin-top: 30px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_liquidacion(4)">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_liqui_4" class="card-body m-5 p-5 no-print">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div  style="text-align: right !important;">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;" class="emp_imp"></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>LIQUIDACION DE BENEFICIOS SOCIALES</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRES Y APELLIDOS</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="desde_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE CESE</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="hasta_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO OCUPADO</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" class="cargo_imp"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">RECORD DE TIEMPO DE SERVICIOS</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="tiempo_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;" ></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">MOTIVO DE SALIDA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="motivo_retiro" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL A COBRAR</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_total_lq_neto"></span></h1>
                                                    </div>
                                                </div>
                                                <!--<div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACIÓN BÁSICA</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.345.00</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">PAGO TOTAL</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S/.57.50</h1>
                                                    </div>
                                                </div>-->
                                            </div>
                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>

                                            <div id="" class="prev_modelo_liqui modelo_80_99">
                                                 <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>COMPENSACION POR TIEMPO DE SERVICIOS</u></h1>
                                                    </div>
                                                </div>
                                                 <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REMUNERACION MENSUAL</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="sueldo_rm"  style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">VACACIONES TRUNCAS</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 12px;">CANCELADO</h1>
                                                    </div>
                                                </div>
                                                 <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">GRATIFICACIONES TRUNCAS</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 12px;">CANCELADO</h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text-center">
                                                    <div  style="text-align: center !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>CALCULO DE LIQUIDACION</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="desde_imp_num"></span> AL <span class="hasta_imp_num"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 class="tiempo_lq_total" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> <span class="anios_liqui"></span> x <span class="tipo_moneda"></span> <span class="sueldo_rm"></span></h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_anio"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="meses_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_mes"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="dias_liqui"></span> x <span class="tipo_moneda"></span><span class="sueldo_rm"></span>/12/30</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_sldo_dia"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL:</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span><span class="monto_total_lq"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="bonif_liquidacion"></div>
                                                <br>
                                                <div class="text-left">
                                                    <div  style="text-align: left !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px; letter-spacing: 2.4px;"><u>NETO A PAGAR</u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">A DEPOSITAR</h1>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-4" style="text-align: right !important;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span class="tipo_moneda"></span> <span class="monto_total_lq_neto"></span></h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="border-bottom: 0.5mm solid; margin-bottom: 10px; margin-top: 10px;"></div>
                                            <br>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">DECLARO: Haber recibido de la empresa <span class="emp_imp"></span>.</p>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div  style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">La suma de <span class="letras_monto"></span> NUEVOS SOLES, por el concepto de mis Beneficios Sociales, firmando el presente documento en señal de mi CONFORMIDAD.<span class="emp_imp"></span>.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-left">
                                                <div  style="text-align: left !important;">
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="lugardia"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div>
                                                    <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                </div>
                                                <div>
                                                    <p style="color: #FF0000;font-weight: 600;font-size: 12px;" class="nombre_imp"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prevs-boletas" id="prev3">
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_0">
                                    <div class="card" style="margin-top: 30px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_0">
                                            <div style="border: 1px dashed black;" class="card-body m-3 p-3">

                                                <div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO: <span class="desde_imp" id="desde_imp_boleta"></span></h1>
                                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRE: <span class="nombre_imp" id="nombre_imp_boleta"></span></h1>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">BOLETA DE PAGO</h1>
                                                                </div>
                                                                <div class="col">
                                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">MES: <span>ENERO</span></h1>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">AÑO: <span>1980</span></h1>
                                                                </div>
                                                                <div class="col">
                                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">OCUPACIÓN: <span class="cargo_imp" id="cargo_imp_boleta"></span></h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-8 text-center" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">JORNALES: </h1>
                                                        </div>
                                                        <div class="col-4 text-left" style="border-top: 1px dashed black; border-bottom: 1px solid black;"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">DÍAS TRABAJADOS: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">DOMINICALES: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">TRABAJO EN FERIADO: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">DOMINGO TRABAJADO: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">HORAS EXTRAS: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;" id="horas_imp_boleta"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIF DE LA EMPRESA: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;" id="boni_imp_boleta"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIFICACIÓN PONAVIS: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIF FAMILIAR: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">VACACIONES-PERÍODO: </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">SUELDO </h1>
                                                        </div>
                                                        <div class="col-4 text-left">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8" style="border-top: 1px dashed black; border-bottom: 1px solid black; border-right: 2px dashed black; text-align: right !important;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">TOTAL DE REMUNERACIONES S/. </h1>
                                                        </div>
                                                        <div class="col-4 text-left" style="color: #000; font-weight: 600; font-size: 14px; border-top: 1px dashed black; border-bottom: 1px solid black;" id="total_imp_boleta"></div>
                                                    </div>
                                                </div>





                                                <div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">DESCUENTOS EMPLEADO: </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">REG. PREST. SALUD 3% </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">0.00</h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">SIST. NAC. PENSIONES 3% </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">0.00</h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">DESCUENTOS APP. 10% </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">ACC. DE TRABAJO </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">FONAVI 3% </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">0.00</h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">CONTRIBUCIÓN IPSS. 1% </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">SEGURO DE VIDA 2.30% </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="  border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-bottom: 1px solid black; border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">COMISIÓN FIJA </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black;">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black;">

                                                        </div>
                                                        <div class="col-3 text-center">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 text-left" style="border-bottom: 1px solid black; border-right: 2px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">TOTAL DESCUENTOS S/. </h1>
                                                        </div>
                                                        <div class="col-2 text-left" style="border-right: 2px dashed black; border-bottom: 1px solid black; border-top: 1px solid black;">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                        </div>
                                                        <div class="col-3 text-center" style="border-right: 2px dashed black; border-bottom: 1px solid black; border-top: 1px solid black;">

                                                        </div>
                                                        <div class="col-3 text-center" style="border-bottom: 1px solid black; border-top: 1px solid black;">

                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-8" style="border-bottom: 1px solid black; border-right: 2px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">SALDO NETO A COBRAR S/. </h1>
                                                        </div>
                                                        <div class="col-4 text-left" style="color: #000; font-weight: 600; font-size: 14px; border-bottom: 1px solid black;">0.00</div>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">FIRMA DEL EMPLEADOR</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">FIRMA DEL TRABAJADOR</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_1">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_1" class="card-body m-5 p-5">
                                            <div class="text-right">
                                                <div style="text-align: right ">
                                                    <h1 style="color: #000;font-size: 12px;">B.S.013-72-</h1>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>RAZON SOCIAL: <span class="emp_imp"></span></u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>BOLETA DE PAGO DE REMUNERACIONES</u>
                                                    </h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 class="mes_anio_imp" style="color: #000;font-weight: 600;font-size: 16px;">NOVIEMBRE 1992
                                                        </h1>
                                                    </div>
                                                    <div style="border-bottom: solid; margin-bottom: 10px;"></div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Apellidos:</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="apellido_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;">
                                                            XXXXXXXXXXXX</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Nombres:</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="nombre_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;">
                                                            XXXXXXXXXXXX</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Cargo:</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="cargo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX
                                                        </h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Ingreso:</h1>
                                                    </div>
                                                    <div class="col-6 text-left">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;">
                                                            XXXXXXXXXXXX</h1>
                                                    </div>
                                                </div>

                                                <div style="border-bottom: solid; margin-bottom: 10px;"></div>

                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Descanso vacacional:</h1>
                                                    </div>

                                                </div>
                                                <div class="container">
                                                    <div class="row align-items-start">
                                                        <div class="col">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">Desde:</h1>
                                                        </div>
                                                        <div class="col">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                        </div>
                                                        <div class="col">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">Hasta:</h1>
                                                        </div>
                                                        <div class="col">
                                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text" style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                <br>
                                                <table class="table table-bordered" style="width:90%">
                                                    <tr>
                                                        <th class="text-center" colspan="2">REMUNERACIONES</th>
                                                        <th class="text-center" colspan="2">DESCTOS. EMPLEADOR</th>
                                                        <th class="text-center">TRABAJADOR</th>
                                                    </tr>

                                                    <tr>
                                                        <td>HABER BASICO</td>
                                                        <td class="sueldo_afiliado"></td>
                                                        <td>B.L. 77482</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>DOMINICAL</td>
                                                        <td></td>
                                                        <td>B.L. 19990</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>HORAS EXTRAS</td>
                                                        <td class="h_extras_afiliado"></td>
                                                        <td>FONAVI</td>
                                                        <td class="dsc_ap_fonavi_monto"></td>
                                                        <td class="dsc_at_fonavi_monto"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ASIS. FAMILIA</td>
                                                        <td></td>
                                                        <td>B.L.18846</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ALIMENTAC-</td>
                                                        <td></td>
                                                        <td>ADELANTO</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FALTAS</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FERIADO</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BONIFIC.</td>
                                                        <td class="boni_afiliado"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MOVILIDAD</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SUB-TOTALES</td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                            <label class="total_boleta"></label>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>TOTALES</td>
                                                        <td><label class="total_boleta"></label></td>
                                                        <td>NETO A PAGAR SA</td>
                                                        <td class="total_neto_1"></td>
                                                        <td></td>
                                                    </tr>

                                                </table>
                                            </div>
                                            <br><br><br>
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    ___________________________________
                                                    <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                </div>
                                                <div class="col">
                                                    ___________________________________
                                                    <p style="color: dark;font-weight: 600;font-size: 12px;">RECIBI CONFORME</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_2">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_2" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important;">
                                                    <h1 style="color: dark;font-weight: 600;font-size: 20px;">RAZON SOCIAL: <span class="emp_imp"></span></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="mes_anio_imp" style="color: dark;font-weight: 600;font-size: 16px;">SETIEMBRE 1992.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>BOLETA DE PAGO</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRES Y APELLIDOS: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="cargo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">F/INGRESO</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SUELDO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="sueldo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REM/VACACIONAL:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="rem_vaca_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REINTEGRO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="reintegro_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">H. EXTRAS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="h_extras_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">BONIFICACION:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="boni_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="otros_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"><u></u></h1>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="total_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SNP.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;">xxxxx</h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 class="dsc_ap_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;">xxxxxxxx</h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">IPSS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 class="dsc_ap_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 class="dsc_ap_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">QUINCENA:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">ADELANTO:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"><u></u></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"><u></u></h1>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NETO A PAGAR.:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="total_neto_pagar_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>

                                                    </div>
                                                </div>
                                                <br><br><br>

                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">
                                                                .........................................................</p>
                                                            <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">
                                                                .........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <p style="color: #000;font-weight: 600;font-size: 16px;">FECHA: <span class="fecha_boleta"></span> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_3">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_3" class="card-body m-5 p-5">

                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;">BOLETA DE PAGO DEL TRABAJADOR</h1>
                                                </div>
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 16px;">DECRETO SUPREMO N°15-72 TR-28-09-72</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="col-4">
                                                    <span class="border rounded border-dark">DATOS DE LA EMPRESA</span>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Razón Social: </h1>
                                                    </div>
                                                    <div class="col-9">
                                                        <h1 class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Reg. Patronal:</h1>
                                                    </div>
                                                    <div class="col-9">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">__________________________________________</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Dirección:</h1>
                                                    </div>
                                                    <div class="col-9">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">__________________________________________</h1>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="col-4">
                                                    <span class="border rounded border-dark">DATOS DEL TRABAJADOR</span>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Apellidos y Nombres:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="nombre_imp" style="color: #000;font-weight: 600;font-size: 12px;">__________________________________________</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Categ. Ocupación:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="cargo_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">_____________</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Fecha de Ingreso:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">_____________</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">N° Seguro Social:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">_____________</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">L.E.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">_____________</h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="container">
                                                    <div class="row align-items-start">
                                                        <div class="col-6 table-responsive">
                                                            <table class="table table-bordered" style="width:100%">
                                                                <tr>
                                                                    <th colspan="3" class="text text-center">REMUNERACIONES</th>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="3">MESES DE: </th>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="3">SEMANA N°___ Del ___ Al ____</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>Haber Mensual S/.</td>
                                                                    <td class="sueldo_afiliado"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jornal</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hrs. Trab. Días</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Dominical</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Horas Extras</td>
                                                                    <td class="h_extras_afiliado"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Asig. Familiar</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Part. Utilidades</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Feriados</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bonificaciones</td>
                                                                    <td class="boni_afiliado"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Reintegros</td>
                                                                    <td class="reintegro_afiliado"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Vacaciones</td>
                                                                    <td class="rem_vaca_afiliado"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comisiones</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Destajos</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Anticipo</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>TOTAL HABER</td>
                                                                    <td class="total_boleta"></td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                        <div class="col-6 table-responsive">
                                                            <table class="table table-bordered" style="width:100%">
                                                                <tr>
                                                                    <th colspan="4" class="text text-center">DESCUENTOS</th>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>Trabajador</td>
                                                                    <td>Empleador</td>
                                                                    <td>Total</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sist. Nac. Pens.</td>
                                                                    <td class="dsc_at_pension_monto"></td>
                                                                    <td class="dsc_ap_pension_monto"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Seguro Social</td>
                                                                    <td class="dsc_at_ss_monto"></td>
                                                                    <td class="dsc_ap_ss_monto"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>I.R.P.</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>FONAVI</td>
                                                                    <td class="dsc_at_fonavi_monto"></td>
                                                                    <td class="dsc_ap_fonavi_monto"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Comis. Porcent.</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Acidente de Trab.</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mandado Judic.</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Adelantos</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Senati</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Otros</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>TOTAL DSCTO.</td>
                                                                    <td class="total_dsc_trabajador_boleta"></td>
                                                                    <td class="total_dsc_empleador_boleta"></td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>
                                                            <br><br>
                                                            <p>NETO RECIBIDO S/.: <span class="total_neto_pagar_boleta"></span></p>
                                                            <div class="col fecha_boleta">
                                                                __________ de ________ de _________
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <br><br><br>

                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">ADMINISTRADOR</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_4">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_4" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 20px;"></h1>
                                                </div>
                                            </div>
                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="mes_anio_imp" style="color: dark;font-weight: 600;font-size: 16px;">.</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>BOLETA DE PAGO</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRES Y APELLIDOS: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CONCEPTO DE LA REMUNERACION</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">DIRECCION:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">L.E.:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SUELDO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="sueldo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>VACACIONES:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SALIDA:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REGRESO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE CESE:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>APORTACIONES DEL TRABAJADOR:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">I.P.S.S.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S.N.P.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">ADELANTO QUINCENA:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">OTROS DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="total_dsc_trabajador_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>APORTACIONES DEL EMPLEADOR:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">I.P.S.S.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S.N.P.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="total_dsc_empleador_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NETO A PAGAR.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="total_neto_pagar_boleta_4" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br><br>

                                                <div class="col">
                                                    <p class="fecha_boleta" style="color: dark;font-weight: 600;font-size: 12px;">__________ de ________ de _________</p>
                                                </div>

                                                <br><br>
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_5">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_5" class="card-body m-5 p-5">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 22px;">RAZON SOCIAL : <span class="emp_imp"></span></h1>
                                                </div>

                                            </div>
                                            <div class="text-right">
                                                <div style="text-align: right !important;">
                                                    <p class="mes_anio_imp" style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 18px;"><u>BOLETA DE PAGO</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Nombre y Apellidos</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Cargo:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="cargo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Fecha de Ingreso</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SUELDO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="sueldo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Rem. Vacacional: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="rem_vaca_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Reintegro: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="reintegro_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">H. Extras: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="h_extras_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Bonificación: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="boni_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Otros: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="otros_afiliado" style="color: #FF0000;font-weight: 600;font-size: 12px;"><u></u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Total: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="total_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"><u>TRABAJADOR</u></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"><u>EMPLEADOR</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">S.N.P.:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_at_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_ap_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">IPSS:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_at_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_ap_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_at_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_ap_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">QUINCENA:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">ADELANTO:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"><u></u></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;"><u></u></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">TOTAL DSCTO.:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="total_dsc_trabajador_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="total_dsc_empleador_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>NETO A PAGAR</u></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="total_neto_pagar_boleta" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <br><br><br>
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                        <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="col">
                                                <p class="fecha_boleta" style="color: dark;font-weight: 600;font-size: 12px;">__________ de ________ de _________</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_6">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_6" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">CONSTRUCTORA: <span class="emp_imp">COVENSA Y CHAVEZ PAIS-CUADRA AGUERO CONTRATISTAS GENERALES S.A. ASOCIADOS</span></h1>
                                                </div>
                                            </div>
                                            <div style="text-align: justify !important;">
                                                <p style="color: #000;font-weight: 600;font-size: 16px;">SUB-CONTRATISTA: <span style="color: #FF0000;font-weight: 600;font-size: 16px;">____________</span> REG. PAT. <span style="color: #FF0000;font-weight: 600;font-size: 16px;">_______________</span></p>
                                                <p style="color: #000;font-weight: 600;font-size: 16px;">PLANILLA DE REMUNERACIONES: <span style="color: #FF0000;font-weight: 600;font-size: 16px;">____________</span> OBRA: <span style="color: #FF0000;font-weight: 600;font-size: 16px;">__________ </span> FONAV <span style="color: #FF0000;font-weight: 600;font-size: 16px;">____________ </span> </p>
                                                <p style="color: #000;font-weight: 600;font-size: 16px;">BOLETA DE PAGO TRABAJADOR <span style="color: #FF0000;font-weight: 600;font-size: 16px;">____________</span> SEM/NRO <span style="color: #FF0000;font-weight: 600;font-size: 16px;">___________ </span> DEL <span style="color: #FF0000;font-weight: 600;font-size: 16px;">________________ </span> AL <span style="color: #FF0000;font-weight: 600;font-size: 16px;">______________ </span> </p>
                                            </div>
                                            <br>
                                            <br>
                                            <table class="table table-bordered" style="width:100%">
                                                <tr class="text-center">
                                                    <td colspan="2">&nbsp;</td>
                                                    <td class="nombre_imp" colspan="2"></td>
                                                    <td class="cargo_imp" colspan="2"></td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="2">CODIGO</td>
                                                    <td colspan="2">NOMBRES Y APELLIDOS</td>
                                                    <td colspan="2">OCUPACION PARTIDA</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td class="fecha_ingreso_afiliado"></td>
                                                    <td></td>
                                                    <td class="doc_afiliado"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>FECHA INGRESO</td>
                                                    <td>CARNET S.S.P.</td>
                                                    <td>DOC. IDENT.</td>
                                                    <td>MOTIVO INASISTENCIA</td>
                                                    <td>C.C.</td>
                                                    <td>SALARIO/HORA</td>
                                                </tr>

                                            </table>
                                            <table class="table table-bordered" style="width:100%">
                                                <tr class="text-center">
                                                    <td>&nbsp;</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>TARIFA/SALARIO</td>
                                                    <td>VAC.SALIDA</td>
                                                    <td>VAC. RETORNO</td>
                                                    <td>LICENCIA DEL</td>
                                                    <td>LICENCIA AL</td>
                                                    <td> </td>
                                                    <td>FECHA CESE</td>
                                                </tr>
                                            </table>
                                            <table class="table table-bordered" style="width:100%">
                                                <tr class="text-center">
                                                    <td colspan="3">REMUNERACIONES</td>
                                                    <td rowspan="2">DESCTOS. TRABAJADOR</td>
                                                    <td rowspan="2">APORT/EMPLE_ TARIFA</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td>CONCEPTOS</td>
                                                    <td>HORAS</td>
                                                    <td>IMPORTE</td>
                                                </tr>
                                                <tr>
                                                    <td>JORNAL</td>
                                                    <td>&nbsp;</td>
                                                    <td class="sueldo_afiliado"></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>DOMINICAL</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>DINERO DE &nbsp; EXTRAS 100%</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp; EXTRAS</td>
                                                    <td>&nbsp;</td>
                                                    <td class="h_extras_afiliado"></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>DESGASTE HERRAMIENTAS Y ROPA</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>ALZA DE TRANSPORTES</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>PASAJES</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>_________________________</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>BONIFICACION ESPECIAL DL 22462</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>BONIFICACION ESPECIAL DL 22593</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>BONIFICACION ESPECIAL DL 22690</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>BONIFICACION ESPECIAL DL 22848.22978</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>SEGURO SOCIAL DEL PERU</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="dsc_at_ss_monto"></td>
                                                    <td class="dsc_ap_ss_monto"></td>
                                                </tr>
                                                <tr>
                                                    <td>SISTEMA NACIONAL DE PENSIONES</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="dsc_at_pension_monto"></td>
                                                    <td class="dsc_ap_pension_monto"></td>
                                                </tr>
                                                <tr>
                                                    <td>IMPUESTO A LA REMUNERACION</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>FONDO NACIONAL DE VIVIENDA</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td class="dsc_at_fonavi_monto"></td>
                                                    <td class="dsc_ap_fonavi_monto"></td>
                                                </tr>
                                                <tr>
                                                    <td>CONAFOVICFR</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>ACCIDENTES DE TRABAJO</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>_____ ANT. O ACT. 5</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>

                                                </tr>
                                            </table>
                                            <table class="table table-bordered">

                                                <tbody>
                                                    <tr>

                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td>5000</td>
                                                        <td>1000</td>
                                                        <td>500</td>
                                                        <td>200</td>
                                                        <td>100</td>
                                                        <td>50</td>
                                                        <td>10</td>
                                                        <td>5</td>
                                                        <td>1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br><br>
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    ___________________________________
                                                    <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                </div>
                                                <div class="col">
                                                    ___________________________________
                                                    <p style="color: dark;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_7">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_7" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 22px;">BOLETA DE PASO DE REMUNERACIONES</h1>
                                                    <h1 class="mes_anio_imp" style="color: #000;font-weight: 600;font-size: 16px;">OCTUBRE 1992</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Apellidos:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="apellido_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXX</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Carnet S.B.:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Nombres:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="nombre_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXX</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Dias Trabajados:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Cargo:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="cargo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;">XX</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Dia Descansado:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Ingreso:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Dias Feriados:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Feriado Trabajado:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>

                                                <div style="border-bottom: solid; margin-bottom: 10px;"></div>


                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Descanso vacacional:</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Desde:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">Hasta:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="text" style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                <br>
                                                <table class="table table-bordered" style="width:90%">
                                                    <tr>
                                                        <th class="text-center" colspan="2">REMUNERACIONES</th>
                                                        <th class="text-center" colspan="2">DESCTOS. EMPLEADOR</th>
                                                        <th class="text-center">TRABAJADOR</th>
                                                    </tr>

                                                    <tr>
                                                        <td>HABER BASICO</td>
                                                        <td class="sueldo_afiliado">xxxx</td>
                                                        <td>B.L. 77482</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>DOMINICAL</td>
                                                        <td></td>
                                                        <td>B.L. 19990</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>HORAS EXTRAS</td>
                                                        <td class="h_extras_afiliado"></td>
                                                        <td>FONAVI</td>
                                                        <td class="dsc_ap_fonavi_monto"></td>
                                                        <td class="dsc_at_fonavi_monto"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ASIG. FAMILIA</td>
                                                        <td></td>
                                                        <td>B.L.18846</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>ALIMENTAC-RD</td>
                                                        <td></td>
                                                        <td>ADELANTO</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FALTAS</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FERIADO</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>BONO</td>
                                                        <td class="boni_afiliado"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SUB-TOTALES</td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                            <span class="total_sueldo_bono"></span>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                            <span class="dsc_ap_fonavi_monto"></span>
                                                        </td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                            <span class="dsc_at_fonavi_monto"></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>TOTALES</td>
                                                        <td class="total_sueldo_bono"></td>
                                                        <td>NETO A PAGAR SA</td>
                                                        <td class="total_neto_boleta_7"></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <br><br><br>
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    ___________________________________
                                                    <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                </div>
                                                <div class="col">
                                                    ___________________________________
                                                    <p style="color: dark;font-weight: 600;font-size: 12px;">RECIBI CONFORME</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_8">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_8" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>BOLETA DE PAGO</u></h1>
                                                </div>
                                            </div>
                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 20px;">EMPRESA AURIFERA GABY EIRLTDA.</p>
                                                </div>
                                            </div>
                                            <br>

                                            <div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">NOMBRES Y APELLIDOS: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="nombre_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXX</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FECHA DE INGRESO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">CONCEPTO DE LA REMUNERACION</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">Remuneracion <span class="mes_anio_imp"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">DIRECCION:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">SUELDO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="sueldo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">.</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>VACACIONES:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">SALIDA:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">REGRESO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FECHA DE CESE:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>APORTACIONES DEL TRABAJADOR:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">I.P.S.S.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">S.N.P.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">ADELANTO QUINCENA:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">OTROS DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">TOTAL DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="total_dsc_trabajador_boleta" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">NETO A PAGAR:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>APORTACIONES DEL EMPLEADOR:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">I.P.S.S.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">S.N.P.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">TOTAL DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="total_dsc_empleador_boleta" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br><br>

                                                <div class="col">
                                                    <p class="fecha_boleta">__________ de ________ de _________</p>
                                                </div>

                                                <br><br>
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                            <p class="emp_imp" class="emp_imp" style="color: dark;font-weight: 600;font-size: 16px;">EMPLEADOR</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 16px;">TRABAJADOR</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_9">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_9" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 class="emp_imp" style="color: #000;font-weight: 600;font-size: 24px;">COMERCIAL LA CONFIANZA S.A.</h1>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Ficha N°: <span style="color: #FF0000;font-weight: 600;font-size: 16px;">_________</span>, Mes <span class="mes_anio_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">________</span>. </p>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">Servidor: <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">_________</span>. </p>
                                                </div>
                                            </div>
                                            <br>

                                            <div>
                                                <table class="table table-bordered" style="width:100%">
                                                    <tr class="text-center">
                                                        <td>L.S.S.S.P</td>
                                                        <td>Ocupacion</td>
                                                        <td>F. Ingreso</td>
                                                        <td colspan="2">Remuneracion</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td class="cargo_imp">&nbsp;</td>
                                                        <td class="fecha_ingreso_afiliado"></td>
                                                        <td></td>
                                                        <td class="sueldo_afiliado">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-center">VALUACION DE LOS TRABAJOS</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Dias Basico</td>
                                                        <td></td>
                                                        <td ></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Horas Extras Basico</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Bonificaciones</td>
                                                        <td></td>
                                                        <td class="boni_afiliado"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Horas Extra Bonif.</td>
                                                        <td></td>
                                                        <td class="h_extras_afiliado"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">__________</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Comisiones</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Vacaciones</td>
                                                        <td></td>
                                                        <td class="rem_vaca_afiliado"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Otros</td>
                                                        <td></td>
                                                        <td class="otros_afiliado"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-end">Total Remuneración</td>
                                                        <td></td>
                                                        <td class="total_boleta"></td>
                                                    </tr>

                                                </table>

                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr class="text-center">

                                                            <th scope="col">DESCUENTOS</th>
                                                            <th scope="col">EMPLEADOR</th>
                                                            <th scope="col">EMPLEADO</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Adelantos</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>S.S.C</td>
                                                            <td class="dsc_ap_ss_monto">&nbsp;</td>
                                                            <td class="dsc_at_ss_monto">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sis. Nac . Pens</td>
                                                            <td class="dsc_ap_pension_monto">&nbsp;</td>
                                                            <td class="dsc_at_pension_monto">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>C.- No 19838</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Imp. a la Renta</td>
                                                            <td>&nbsp;</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Otros</td>
                                                            <td class="dsc_ap_fonavi_monto">&nbsp;</td>
                                                            <td class="dsc_at_fonavi_monto">&nbsp;</td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                                                <div class="container">
                                                    <div class="row align-items-start">
                                                        <div class="col-3">
                                                            <p>Sub Total</p>
                                                            <p>Cant. Movilidad</p>
                                                            <p>Neto a Pagar</p>
                                                        </div>
                                                        <div class="col-5">
                                                            <p class="total_neto_pagar_boleta">__________</p>
                                                            <p>__________</p>
                                                            <p class="total_neto_pagar_boleta">__________</p>
                                                        </div>

                                                    </div>
                                                </div>

                                                <br><br><br>
                                            </div>

                                            <div style="text-align: right !important;">

                                                <p class="fecha_boleta" style="color: #000;font-weight: 600;font-size: 16px;">__________ de ________ de _________</p>

                                            </div>

                                            <br><br>
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">...........................................</p>
                                                        <p style="color: dark;font-weight: 600;font-size: 16px;">Recibí Conforme</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 16px;">....................................................</p>
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_10">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>

                                        <div id="contenido_boleta_10" class="card-body" style="border: 1px dashed black;">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div style="text-align: right !important;">
                                                    <h1 class="emp_imp style="color: dark;font-weight: 600;font-size: 24px;">COMERCIAL BOXI S.A.</h1>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO: <span class="fecha_ingreso_afiliado">XXXXXXX</span></h1>
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRE: <span class="nombre_imp">XXXXXXX</span></h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h1 style="color: #000;font-weight: 600;font-size: 12px;">BOLETA DE PAGO</h1>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h1 style="color: #000;font-weight: 600;font-size: 12px;">MES: <span class="mes_anio_imp"></span></h1>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h1 style="color: #000;font-weight: 600;font-size: 12px;">SEMANA: <span></span></h1>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <h1 style="color: #000;font-weight: 600;font-size: 12px;">OCUPACION: <span class="cargo_afiliado"></span></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="row">
                                                    <div class="col-8 text-center" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">JORNALES: </h1>
                                                    </div>
                                                    <div class="col-4 text-left" style="border-top: 1px dashed black; border-bottom: 1px solid black;"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">DÍAS TRABAJADOS: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="sueldo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">DOMINICALES: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">TRABAJO EN FERIADO: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">DOMINGO TRABAJADO: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">HORAS EXTRAS: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="h_extras_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIF DE LA EMPRESA: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="boni_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIFICACIÓN PONAVIS: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIF FAMILIAR: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 14px;">VACACIONES - PERÍODO: </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1  class="rem_vaca_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 14px;">.</h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1  style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 14px;">.</h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1  style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 14px;">.</h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1  style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 14px;">.</h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1  style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-8 " style="border-top: 1px dashed black; border-bottom: 1px solid black; border-right: 2px dashed black; text-align: right !important;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 14px;">TOTAL DE REMUNERACIONES S/. </h1>
                                                    </div>
                                                    <div class="col-4 text-left  total_boleta" style="color: #FF0000; font-weight: 600; font-size: 14px; border-top: 1px dashed black; border-bottom: 1px solid black;">XX.XX</div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">DESCUENTOS : </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">REG. PREST. SALUD 3%: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">SIST. NAC. PENSIONES 3%: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 class="dsc_at_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">DESCUENTOS APP. 10%: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">ACC. DE TRABAJO: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1  style="color: #000;font-weight: 600;font-size: 14px;">FONAVI 3%: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 class="dsc_at_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">CONTRIBUCIÓN IPSS. 1%: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 class="dsc_at_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">SEGURO DE VIDA 2.30%: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">COMISIÓN FIJA: </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-8" style="border-top: 1px dashed black; border-bottom: 1px solid black; border-right: 2px dashed black; text-align: right !important;">

                                                </div>
                                                <div class="col-4 text-left" style="color: #FF0000; font-weight: 600; font-size: 14px; border-top: 1px dashed black; border-bottom: 1px solid black;"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8" style="border-bottom: 1px solid black; border-right: 2px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">TOTAL DESCUENTOS S/. </h1>
                                                </div>
                                                <div class="col-4 text-left total_dsc_trabajador_boleta" style="color: #FF0000; font-weight: 600; font-size: 14px; border-bottom: 1px solid black;"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8" style="border-bottom: 1px solid black; border-right: 2px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">SALDO NETO A COBRAR S/. </h1>
                                                </div>
                                                <div class="col-4 text-left" style="color: #FF0000; font-weight: 600; font-size: 14px; border-bottom: 1px solid black;">
                                                    <h1 class="total_neto_boleta_10" style="color: #000;font-weight: 600;font-size: 14px;">XX </h1>
                                                </div>
                                            </div>


                                            <br><br>
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                        <p class="emp_imp" style="color: #000;font-weight: 600;font-size: 12px;">FIRMA DEL EMPLEADOR</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">FIRMA DEL TRABAJADOR</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_11">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>

                                        <div id="contenido_boleta_11" class="card-body" style="border: 1px dashed black;">
                                            <div class="text-center ">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: dark;font-weight: 600;font-size: 24px;">BOLETA DE PAGO DE REMUNERACIONES</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <table class="table table-bordered" style="width:100%">
                                                    <tr class="text-center">
                                                        <td>&nbsp;</td>
                                                        <td class="nombre_imp">&nbsp;</td>
                                                        <td class="fecha_ingreso_afiliado">&nbsp;</td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td class="fw-bold">COD.</td>
                                                        <td class="fw-bold">NOMBRE</td>
                                                        <td class="fw-bold">F. INGRESO</td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td class="cargo_afiliado" colspan="2">&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td colspan="2" class="fw-bold">CARGO</td>
                                                        <td class="fw-bold">CIP</td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td class="mes_anio_imp" colspan="3">&nbsp;</td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td colspan="3" class="fw-bold">PERIODO DE PAGO</td>
                                                    </tr>
                                                </table>
                                            </div>

                                            <div>
                                                <div class="row">
                                                    <div class="col-8 text-center" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;">HABERES: </h1>
                                                    </div>

                                                    <div class="col-4 text-center" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 20px;">IMPORTE: </h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">SUELDO BASICO </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="sueldo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black;">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">HORAS EXTRAS NORMALES </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="h_extras_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">HORAS EXTRAS DOMINGOS - FERIADOS </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIFICACION D.S </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIFICACION COSTO DE VIDA </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIFICACION </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="boni_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">REMUNERACION VACACIONAL </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="rem_vaca_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">OTRAS REMUNERACIONES </h1>
                                                    </div>
                                                    <div class="col-4 text-left">
                                                        <h1 class="otros_afiliado" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-8 " style=" border-bottom: 1px solid black; border-right: 2px dashed black; text-align: right !important;">
                                                        <h1 class="text-right" style="color: #000;font-weight: 600;font-size: 14px;">TOTAL HABERES </h1>
                                                    </div>
                                                    <div class="col-4 text-left total_boleta" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-center" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">DEDUCCIONES </h1>
                                                </div>

                                                <div class="col-4 text-center" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">S. S. P. </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 class="dsc_at_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">S. N. P. </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 class="dsc_at_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">FONAVI </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 class="dsc_at_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">RETENCION 5ta CATEGORIA </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">VALES </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">MERCADERIA </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 14px;">ADELANTOS </h1>
                                                </div>
                                                <div class="col-4 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-8 " style=" border-right: 2px dashed black; text-align: right !important;">
                                                    <h1 class="text-right" style="color: #000;font-weight: 600;font-size: 14px;">TOTAL DEDUCCIONES </h1>
                                                </div>
                                                <div class="col-4 text-left total_dsc_trabajador_boleta" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">XX.XX</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-8 " style=" border-bottom: 1px solid black; border-right: 2px dashed black; text-align: right !important;">
                                                    <h1 class="text-right" style="color: #000;font-weight: 600;font-size: 14px;">NETO PAGADO </h1>
                                                </div>
                                                <div class="col-4 text-left" style="border-top: 1px solid black; border-bottom: 1px dashed black; border-right: 2px dashed black;">
                                                    <h1 class="total_neto_boleta_10" style="color: #000;font-weight: 600;font-size: 14px;"></h1>
                                                </div>
                                            </div>
                                            <table class="table table-bordered" style="width:100%">
                                                <tr class="text-center">
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td class="fw-bold">_____</td>
                                                    <td class="fw-bold">_____</td>
                                                    <td class="fw-bold">_____</td>
                                                    <td class="fw-bold">TOTAL</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="4" class="fw-bold">APORTACIONES </td>
                                                </tr>
                                            </table>
                                            <br><br>
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col">
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">FIRMA DEL TRABAJADOR</p>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_12">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_12" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 20px;">BOLETA DE PAGO DEL TRABAJADOR - EMPLEADOS Y OBREROS</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 18px;">DATOS DE LA EMPRESA</h1>
                                                    </div>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p  style="color: #000;font-weight: 600;font-size: 16px;">RAZON SOCIAL. <span class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;"></span> </p>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">REG. PATRONAL <span style="color: #FF0000;font-weight: 600;font-size: 16px;"></span> LIB. TRIB <span style="color: #FF0000;font-weight: 600;font-size: 16px;"> </span> DIR <span style="color: #FF0000;font-weight: 600;font-size: 16px;"> </span> </p>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 18px;">DATOS DEL TRABAJADOR</h1>
                                                    </div>
                                                </div>
                                                <div style="text-align: justify !important;">
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">NOMBRE <span class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span></p>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">CATEG. Y OCUPACION <span class="cargo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> FECHA DE INGRESO <span class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;"></span></p>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">FECHA DE NACIMIENTO <span class="fecha_nac_afi" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> I.E. <span style="color: #FF0000;font-weight: 600;font-size: 16px;"></span> F. CESE <span style="color: #FF0000;font-weight: 600;font-size: 16px;"></span></p>
                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">N° S. SOCIAL <span style="color: #FF0000;font-weight: 600;font-size: 16px;"></span></p>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <div class="row align-items-start">
                                                    <div class="col">
                                                        <p class="text-center" style="color: #000;font-weight: 600;font-size: 16px;"> REMUNERACIONES </p>
                                                        <table class="table table-bordered" style="width:100%">
                                                            <tr>
                                                                <td colspan="3">
                                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">MES DE <span class="mes_anio_imp style="color: #FF0000;font-weight: 600;font-size: 16px;"></span></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <p style="color: #000;font-weight: 600;font-size: 16px;">SEMANA N° <span style="color: #FF0000;font-weight: 600;font-size: 16px;">______</span>DEL<span style="color: #FF0000;font-weight: 600;font-size: 16px;">______</span>HASTA<span style="color: #FF0000;font-weight: 600;font-size: 16px;">______</span></p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Haber Mensual</td>
                                                                <td class="sueldo_afiliado">XXXXXXX</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jornal</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Hrs. Trab. dias</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Dominical</td>
                                                                <td >&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Horas Extras</td>
                                                                <td class="h_extras_afiliado">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Asig. Familiar</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Participación Utilidades</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Feriados</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bonificaciones</td>
                                                                <td class="boni_afiliado" >&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Reintegros</td>
                                                                <td class="reintegro_afiliado">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Vacaciones</td>
                                                                <td class="rem_vaca_afiliado">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Otros</td>
                                                                <td class="otros_afiliado">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td>TOTALES</td>
                                                                <td class="total_boleta">&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                    <div class="col">
                                                        <p class="text-center" style="color: #000;font-weight: 600;font-size: 16px;"> DESCUENTOS </p>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">Empleador</th>
                                                                    <th scope="col">Trabajador</th>
                                                                    <th scope="col">TOTAL</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Seguro Social</th>
                                                                    <td class="dsc_ap_ss_monto"></td>
                                                                    <td class="dsc_at_ss_monto"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Enf. Maternidad</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Sis. Nac. D Pens</th>
                                                                    <td class="dsc_ap_pension_monto"></td>
                                                                    <td class="dsc_at_pension_monto"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Imp. Unico </th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Acc. de Trabajo</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fonavi</th>
                                                                    <td class="dsc_ap_fonavi_monto"></td>
                                                                    <td class="dsc_at_fonavi_monto"></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ley 19839</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mandato Judicial</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Senati</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Adelanto</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;</th>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="2">&nbsp;</td>
                                                                    <td>&nbsp;</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="total_dsc_empleador_boleta">&nbsp;</td>
                                                                    <td class="total_dsc_trabajador_boleta"></td>
                                                                    <td class="total_descuentos_boleta"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p style="color: #000;font-weight: 600;font-size: 16px;">NETO RECIBIDO S/. <span class="total_neto_pagar_boleta" style="color: #FF0000;font-weight: 600;font-size: 16px;"></span></p>
                                                        <br><br><br>
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <p class="fecha_boleta">Lima, __________ de ________ de _________</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br><br><br>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            ___________________________________
                                                            <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                        </div>
                                                        <div class="col">
                                                            ___________________________________
                                                            <p class="nombre_afiliado" style="color: dark;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_13">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_13" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 16px;">"Año de la Consolidación del Mar de Grau"</h1>
                                                    <h1 style="color: #000;font-weight: 600;font-size: 22px;">GOBIERNO REGIONAL DE LORETO</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div style="border-bottom: solid; margin-bottom: 10px;"></div>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h1 class="mes_anio_imp" style="color: #000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                            
                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">________</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">PROF DE AULA:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                
                                                </div>
                                                <br>

                                                <div style="border-bottom: solid; margin-bottom: 10px;"></div>

                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">D.L.25671 F</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">COSTO DE VI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">__________</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">D.S.28</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">AGUINALDO:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">______</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">REF. MOV </h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">PREP. CLASE:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">CONTRATO </h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">I.G.V.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>

                                                <br><br><br><br><br><br>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">T-COMUN </h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">T-DSCTO</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="total_dsc_trabajador_boleta" style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">T-LIQUIDO</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">........</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_14">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_14" class="card-body m-5 p-5">
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 24px;"><u>BOLETA DE PAGO</u></h1>
                                                </div>
                                            </div>
                                            <div class="text-left">
                                                <div style="text-align: left !important;">
                                                    <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 20px;">EMPRESA AURIFERA GABY EIRLTDA.</p>
                                                </div>
                                            </div>
                                            <br>

                                            <div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">NOMBRES Y APELLIDOS: </h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="nombre_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXX</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FECHA DE INGRESO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">CONCEPTO DE LA REMUNERACION</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;">Remuneracion <span class="mes_anio_imp"></span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">DIRECCION:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">SUELDO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="sueldo_afiliado" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>VACACIONES:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">SALIDA:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">REGRESO:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FECHA DE CESE:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>APORTACIONES DEL TRABAJADOR:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">I.P.S.S.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">S.N.P.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_at_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">ADELANTO QUINCENA:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">OTROS DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">TOTAL DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="total_dsc_trabajador_boleta" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">NETO A PAGAR:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                    <div class="col-6">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>APORTACIONES DEL EMPLEADOR:</u></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">I.P.S.S.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_ss_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">S.N.P.:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_pension_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">FONAVI:</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="dsc_ap_fonavi_monto" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">OTROS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 16px;">TOTAL DESCUENTOS:</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="total_dsc_empleador_boleta" style="color: #FF0000;font-weight: 600;font-size: 16px;"></h1>
                                                    </div>
                                                </div>
                                                <br><br>

                                                <div class="col">
                                                    <p class="fecha_boleta">__________ de ________ de _________</p>
                                                </div>

                                                <br><br>
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                            <p class="emp_imp" class="emp_imp" style="color: dark;font-weight: 600;font-size: 16px;">EMPLEADOR</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 16px;">.........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 16px;">TRABAJADOR</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_15">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_15" class="card-body m-5 p-5">
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>Boleta de Pago</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Obra No</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.........</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">D S No 015-72-TR</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Semana Np</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">.........</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">N°</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">..........</h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Nombre</h1>
                                                    </div>
                                                    <div class="col-8">
                                                        <h1 class="nombre_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Categoria</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">..........</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Ocupacion</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="cargo_imp" style="color: #FF0000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Periodo </h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="mes_anio_imp" style="color: #000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Ingreso </h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>Sueldo u horas de trabajo</u></h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Journal S1</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">....</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Semanal: </h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.....</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">.....</h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Horas Extras: Mensual</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1  style="color: #000;font-weight: 600;font-size: 12px;">.....</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Semanal:</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> .....</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="h_extras_afiliado" style="color: #000;font-weight: 600;font-size: 12px;"> </h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">EMPLEADO</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">OBRERO</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> Dominical</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Bonificacion: </h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="boni_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">xx</h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Otros</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"> </h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="otros_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">xx</h1>
                                                    </div>
                                                </div>

                                            </div>

                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;"><u>Remuneraciones </u></h1>
                                                </div>
                                            </div>
                                            <br>

                                            <div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Descuento Ley</h1>
                                                    </div>
                                                    <div class="col-6">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Aportaciones</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="sueldo_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">149.42</h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Patrono</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Empleado</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Seguro Social</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_ap_ss_monto" style="color: #000;font-weight: 600;font-size: 12px;">XXXXX</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_at_ss_monto" style="color: #000;font-weight: 600;font-size: 12px;">XXXXX</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Jubilacion </h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1  class="dsc_ap_pension_monto" style="color: #000;font-weight: 600;font-size: 12px;">XXXXX</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_at_pension_monto" style="color: #000;font-weight: 600;font-size: 12px;">XXXXX</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Acta trabjo</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FONAVI</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_ap_fonavi_monto" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 class="dsc_at_fonavi_monto" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CONAF</h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-3">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="total_descuentos_boleta" style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-10">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Saldo a Pagar: </h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 class="total_neto_pagar_boleta" style="color: #000;font-weight: 600;font-size: 12px;">136.48</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br><br><br><br>
                                            <div>
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                                            <p style="color: #000;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_16">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_16" class="card-body m-5 p-5">
                                            <br>

                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>Boleta de Pago</u></h1>
                                                </div>
                                            </div>
                                            <br>

                                            <div>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">REG PATR</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">IPSS</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">RUC</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">SPP</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Nombre</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 class="nombre_imp" style="color: #000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Cargo</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 class="cargo_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">Fecha ING</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                    </div>
                                                    <div class="col-2">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">CESE:</h1>
                                                    </div>
                                                    <div class="col-4">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;"></h1>
                                                    </div>

                                                </div>
                                            </div>
                                            <br>
                                            <div class="row align-items-start">
                                                <div class="col">
                                                    <table class="table table-bordered" style="width:100%">
                                                        <tr>
                                                            <th colspan="2" class="text text-center">REMUNERACIONES</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">CONCEPTO</td>
                                                            <td class="text-center">IMPORTE</td>
                                                        </tr>
                                                        <tr>
                                                            <td>H. MENSUAL</td>
                                                            <td class="sueldo_afiliado">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>JORNAL</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dominical</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>JORN. NOCTURNA</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>LEY 26504</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>ASIG. FAMILIAR</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>HORAS EXTRAS</td>
                                                            <td class="h_extras_afiliado">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>TOTAL INGRESOS</td>
                                                            <td class="total_boleta_16">&nbsp;</td>
                                                        </tr>

                                                    </table>
                                                </div>
                                                <div class="col">
                                                    <table class="table table-bordered" style="width:100%">
                                                        <tr>
                                                            <th colspan="3" class="text text-center">DEDUCCIONES Y APORTACIONES</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">CONCEPTO</td>
                                                            <td class="text-center">EMPLEADO</td>
                                                            <td class="text-center">EMPLEADOR</td>
                                                        </tr>
                                                        <tr>
                                                            <td>IPSS</td>
                                                            <td class="dsc_at_ss_monto">&nbsp;</td>
                                                            <td class="dsc_ap_ss_monto">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td>SNP</td>
                                                            <td class="dsc_at_pension_monto"></td>
                                                            <td class="dsc_ap_pension_monto"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>FONAVI</td>
                                                            <td class="dsc_at_fonavi_monto"></td>
                                                            <td class="dsc_ap_fonavi_monto"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>AFP-8</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SEG. SOB.</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>COM. VAR.</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>ADELANTO</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>TOTAL</td>
                                                            <td class="total_dsc_trabajador_boleta"></td>
                                                            <td class="total_dsc_empleador_boleta"></td>
                                                        </tr>

                                                    </table>

                                                    <div class="row">
                                                        <div class="col-8">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">NETO A PAGAR</h1>
                                                        </div>

                                                        <div class="col-4">
                                                            <h1 class="total_neto_boleta_16" style="color: #000;font-weight: 600;font-size: 12px;">XXXXXXXXX</h1>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>

                                            <br><br><br><br><br>
                                            <div class="text-center">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">......................................................</p>
                                                        <p class="emp_imp" style="color: dark;font-weight: 600;font-size: 12px;">EMPLEADOR</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">......................................................</p>
                                                        <p style="color: #000;font-weight: 600;font-size: 12px;">TRABAJADOR</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container prev_boleta" style="max-width: 1020px !important;" id="prev_boleta_17">
                                    <div class="card" style="margin-top: 60px;">
                                        <div class="card-header d-flex justify-content-between">
                                            <h3>PREVISUALIZACIÓN</h3>
                                            <div>
                                                <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                            </div>
                                        </div>
                                        <div id="contenido_boleta_17" class="card-body m-5 p-5">
                                            <br>
                                            <div class="text-center">
                                                <div style="text-align: center !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 16px;"><u>Liquidacion de Pago</u></h1>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="text-center">
                                                <div style="text-align: left !important;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">SIMA-PERU</h1>
                                                </div>
                                            </div>
                                            <br>
                                            <div>
                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="nombre_imp" style="color: #000;font-weight: 600;font-size: 9px;">XXXX</h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Codigo</h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Apellidos y Nombres</h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">_____</h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Taller</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Pago Del</h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Al</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Fecha de Pago</h1>
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center cargo_imp" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Clave de Pago</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Planilla -- </h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">SEM</h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Cargo Especialidad</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Nivel</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">----</h1>
                                                    </div>
                                                </div>

                                                <br>


                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">12 A C</h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Centro De</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Division</h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Departamentos</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">______</h1>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="fecha_ingreso_afiliado" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center boni_afiliado" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center rem_vaca_afiliado" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Fecha de Ingreso</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Fecha de </h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Fecha de </h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Fecha de </h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Fecha de </h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Bonificacion</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Rem Vacacional</h1>
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">------</h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">------</h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">------</h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">------</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">------</h1>
                                                    </div>
                                                    <div class="col-1" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">------</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">------</h1>
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center otros_afiliado" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center sueldo_afiliado" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Otros</h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">SALDO ---</h1>
                                                    </div>
                                                    <div class="col-3" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Adelanto</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Importe --</h1>
                                                    </div>
                                                    <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                        <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Jornal ---</h1>
                                                    </div>
                                                </div>

                                            </div>


                                            <!--  ///////// ///////////////////////////////////////////////////////////////  -->

                                            <br>
                                            <div class="row">
                                                <div class="col-12" style="border: 1px dashed black;">
                                                    <h1 style=" text-align: center; color: #000;font-weight: 600;font-size: 9px;">Ingresos</h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Concepto</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Importe</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Concepto</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Importe</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Concepto</h1>
                                                </div>

                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Importe</h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <br>

                                            <!--  ///////// ///////////////////////////////////////////////////////////////  -->

                                            <div class="row">
                                                <div class="col-12" style="border: 1px dashed black;">
                                                    <h1 style=" text-align: center; color: #000;font-weight: 600;font-size: 9px;">Descuentos</h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Concepto</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Importe</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Concepto</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Importe</h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Concepto</h1>
                                                </div>

                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 class="text-center" style="color: #000;font-weight: 600;font-size: 9px;">Importe</h1>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;">SNP</h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 class="dsc_at_pension_monto" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;">FONAVI</h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 class="dsc_at_fonavi_monto" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;">IPSS</h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 class="dsc_at_ss_monto" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style=" border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>




                                            <div class="row">
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>

                                                <div class="col-2" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black;">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="row">
                                                <div class="col-7">
                                                    <div class="row">
                                                        <div class="col-10" style="border: 1px dashed black;">
                                                            <h1 style=" text-align: center; color: #000;font-weight: 600;font-size: 9px;">Aportaciones Empleador</h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5" style=" border-left: 1px dashed black; border-bottom: 1px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 9px;">Concepto</h1>
                                                        </div>
                                                        <div class="col-5" style="border-left: 1px dashed black; border-right: 1px dashed black; border-bottom: 1px dashed black; ">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 9px;">Importe</h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5" style=" border-left: 1px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 9px;">SNP</h1>
                                                        </div>
                                                        <div class="col-5" style="border-left: 1px dashed black; border-right: 1px dashed black; ">
                                                            <h1 class="dsc_ap_pension_monto" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                        </div>
                                                        <div class="col-5" style=" border-left: 1px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 9px;">FONAVI</h1>
                                                        </div>
                                                        <div class="col-5" style="border-left: 1px dashed black; border-right: 1px dashed black; ">
                                                            <h1 class="dsc_ap_fonavi_monto" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5" style="border-bottom: 1px dashed black; border-left: 1px dashed black;">
                                                            <h1 style="color: #000;font-weight: 600;font-size: 9px;">IPSS</h1>
                                                        </div>

                                                        <div class="col-5" style="border-bottom: 1px dashed black; border-left: 1px dashed black; border-right: 1px dashed black; ">
                                                            <h1 class="dsc_ap_ss_monto" style="color: #000;font-weight: 600;font-size: 9px;"></h1>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-5">
                                                    <div class="row">
                                                        <div class="col-4" style=" border: 1px dashed black;">
                                                            <h1 class=""  style="color: #000;font-weight: 600;font-size: 9px;margin-top : 5px;">TOTAL INGRESOS</h1>
                                                        </div>
                                                        <div class="col-4 " style="border: 1px dashed black;">
                                                            <h1 class="total_boleta" style="color: #000;font-weight: 600;font-size: 9px;margin-top : 5px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4" style=" border: 1px dashed black;">
                                                            <h1 class="" style="color: #000;font-weight: 600;font-size: 9px;margin-top : 5px;">TOTAL DESCUENTOS</h1>
                                                        </div>
                                                        <div class="col-4 " style="border: 1px dashed black;">
                                                            <h1 class="total_dsc_trabajador_boleta " style="color: #000;font-weight: 600;font-size: 9px;margin-top : 5px;"></h1>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 " style=" border: 1px dashed black;">
                                                            <h1 class="" style="color: #000;font-weight: 600;font-size: 9px;margin-top : 5px;">NETO A PAGAR</h1>
                                                        </div>
                                                        <div class="col-4" style="border: 1px dashed black;">
                                                            <h1 class="total_neto_pagar_boleta" style="color: #000;font-weight: 600;font-size: 9px;margin-top : 5px;"></h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>
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
            require_once("./modalboletasdsc.php");
            require_once("./modalboletas.php");
            require_once("../Main/mainjs.php");
            require_once("./modalboleta_info.php");
        ?>
        <script src="pensiones.js" type="text/javascript"></script>
    </body>
</html>
