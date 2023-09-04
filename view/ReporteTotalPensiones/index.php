<?php require_once("../Main/sesion.php");?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <?php require_once("../Main/mainhead.php") ; ?>
        <title>SISPEN - Pensiones</title>
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
                    <span class="breadcrumb-item active">Pensiones</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Pension Automatico</h4>
                <p class="mg-b-0">Realiza las pensiones con los siguientes datos.</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Formulario de Pensiones</h6>
                    <p class="mg-b-30 tx-gray-600"></p>
                    <div class="row">
                        <div class="col-xl-6">
                            <form id="pension_form" method="post">
                                <input type="hidden" id="af_id" name="af_id">
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
                                                <input class="form-control" type="date" name="txtdate" id="txtdate"  placeholder="" required>
                                            </div>
                                        </div><!-- col-4 -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="cant_emp" >Cant. de Empresas: <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="number" name="txtcant_emp" id="txtcant_emp" min="1" max="99" placeholder=""  required>
                                            </div>
                                        </div><!-- col-4 -->
                                    </div><!-- row -->
                                    <div class="form-layout-footer text-center">
                                        <button type="submit" id="btnautogenerar" name="btnautogenerar"  class="btn btn-info">Gestionar</button>
                                        <button type="button" id="btnlimpiar" name="btnautogenerar" class="btn btn-secondary">Limpiar</button>
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
                                        <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="refelx-tab"   data-bs-toggle="pill" data-bs-target="#boleta"  type="button" role="tab" aria-controls="boleta"   aria-selected="false">Boleta</button>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- AQUI VA EL CONTENIDO -->
                                    <div id="certificado" class="tab-pane fadein show active">
                                    </div>
                                    <div id="liquidacion" class="tab-pane fade">
                                        <form id="form_liqui" action="" method="post" autocomplete="off">
                                            <div class="form-layout form-layout-1">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Adelanto: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6 " type="number" name="empresa" value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Vacaciones: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="number" name="empresa"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Gratificaciones: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="number" name="empresa"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Reintegro: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="number" name="empresa"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Incentivo: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="number" name="empresa"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="number" name="empresa"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bon. Graciosa: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="number" name="empresa"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bon. Extraordinaria: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="number" name="empresa"  value="0" placeholder="" required>
                                                        </div>
                                                    </div><!-- col-4 -->
                                                </div><!-- row -->
                                            </div>
                                            <div class="form-layout-footer text-right mg-t-20">
                                                <button type="button" id="btnprevli" name="btnprevli"  class="btn btn-secondary mg-l-10">Previsualizar</button>
                                                <!--<button type="button" id="btnimprimirli" name="btnimprimirli"  class="btn btn-info">Imprimir Liquidacion</button>-->
                                            </div>
                                        </form>
                                    </div>
                                    <div id="boleta" class="tab-pane fade">
                                        <form id="form_bol" action="" method="post" autocomplete="off">
                                            <div class="form-layout form-layout-1">
                                                <div class="row ">
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Fecha: <span class="tx-danger">*</span></label>
                                                            <input class="form-control col-lg-6" type="date" id="fech_inicio_boleta" name="fech_inicio_boleta"  placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">REM. Vacacional: </label>
                                                            <input class="form-control col-lg-6" type="number" name=""    placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Reintegro: </label>
                                                            <input class="form-control col-lg-6" type="number" name=""   placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">H. Extras: </label>
                                                            <input class="form-control col-lg-6" type="number" name="horaex_boleta" id="horaex_boleta"   placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Bonificacion: </label>
                                                            <input class="form-control col-lg-6" type="number" name="boni_boleta" id="boni_boleta"   placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="row mg-b-5">
                                                            <label class="form-control-label col-lg-6">Otros: </label>
                                                            <input class="form-control col-lg-6" type="number" name=""   placeholder="" >
                                                        </div>
                                                    </div><!-- col-4 -->
                                                </div><!-- row -->
                                            </div>
                                            <div class="form-layout-footer text-right mg-t-20">
                                                <button type="button" id="btnprevbol" name="btnprevbol"  class="btn btn-secondary mg-l-10">Previsualizar</button>
                                                <!--<button type="button" id="btnimprimirbol" name="btnimprimirbol"  class="btn btn-info">Imprimir Boleta</button>-->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--<div class="form-layout-footer text-right mg-t-20">
                                    <button type="button" id="btnimprimir" name="btnimprimir"  class="btn btn-info">Imprimir Certificado</button>
                                </div> form-layout-footer -->
                            </div>
                            <br>
                        
                            <div class="container"  id="prev1">
                                <div class="card" style="margin-top: 30px;">
                                    <div class="card-header d-flex justify-content-between">
                                        <h3>PREVISUALIZACIÓN</h3>
                                        <div>
                                            <button class="btn btn-info" onclick="imprimir_certificado()">Imprimir</button>
                                        </div>
                                    </div>
                                    <div id="contenido" class="card-body m-5 p-5 no-print">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div id="div_logo_pdf" style="text-align: right !important;">
                                                <img class="img_logo" src="" alt="LOGO" id="img_logo" width="100px" height="60px">
                                            </div> 
                                            <div  style="text-align: right !important; margin: auto 0 ;">
                                                <h1 class="emp_imp" style="color: #FF0000;font-weight: 600;font-size: 20px;" id="emp_imp"></h1>
                                            </div>
                                        </div>
                                        <br><br><br><br>
                                        <div class="text-center">
                                            <div  style="text-align: center !important;">
                                                <h1 style="color: #000;font-weight: 600;font-size: 20px;"><u>CONSTANCIA DE TRABAJO</u></h1>
                                            </div>
                                        </div>
                                        <br><br><br>
                                        <div class="text-center">
                                            <div  style="text-align: justify !important;">
                                                <p style="color: #000;font-weight: 600;font-size: 16px;">SE DEJA CONSTANCIA QUE EL SEÑOR(A) <span style="color: #FF0000;font-weight: 600;font-size: 16px;" id="nombre_imp"></span> HA LABORADO PARA NUESTRA EMPRESA COMO <span style="color: #FF0000;font-weight: 600;font-size: 16px;" id="cargo_imp"></span> A PARTIR DEL <span style="color: #FF0000;font-weight: 600;font-size: 16px;" id="desde_imp"></span> AL <span style="color: #FF0000;font-weight: 600;font-size: 16px; " id="hasta_imp">.</span></p>
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
                                        <br><br>
                                        <div class="text-right">
                                            <div  style="text-align: right !important;">
                                                <p style="color: #FF0000;font-weight: 600;font-size: 16px;" id="lugardia"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container" style="max-width: 1020px !important;" id="prev2">
                                <div class="card" style="margin-top: 30px;">
                                    <div class="card-header d-flex justify-content-between">
                                        <h3>PREVISUALIZACIÓN</h3>
                                        <div>
                                            <button class="btn btn-info" onclick="imprimir_liquidacion()">Imprimir</button>
                                        </div>
                                    </div>
                                    <div id="contenido_liqui" class="card-body m-5 p-5 no-print">
                                        <div class="d-flex justify-content-between mb-5">
                                            <div  style="text-align: right !important;">
                                                <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;" id="emp_imp_liqui"></h1>
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
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" id="nombre_imp_liqui"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO DESEMPEÑADO</h1>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" id="cargo_imp_liqui"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO</h1>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" id="desde_imp_liqui"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE CESE</h1>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" id="hasta_imp_liqui"></h1>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">TIEMPO DE SERVICIOS</h1>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;" id="tiempo_imp_liqui"></h1>
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
                                                <p style="color: #000;font-weight: 600;font-size: 12px;">Al firmar la presente liquidación dejo constancia expresa que los señores de <span style="color: #FF0000;font-weight: 600;font-size: 12px;" id="senior_imp_liqui"></span> han cumplido con abonarme todos los beneficios sociales conforme a Ley, por tanto, firmo dando por cancelado mi liquidación.</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-right">
                                            <div  style="text-align: right !important;">
                                                <p style="color: #FF0000;font-weight: 600;font-size: 12px;" id="lugardia_liqui"></p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <div>
                                                <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                            </div>
                                            <div>
                                                <p style="color: #FF0000;font-weight: 600;font-size: 12px;" id="firma_imp_liqui"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container" style="max-width: 1020px !important;" id="prev3">
                                <div class="card" style="margin-top: 30px;">
                                    <div class="card-header d-flex justify-content-between">
                                        <h3>PREVISUALIZACIÓN</h3>
                                        <div>
                                            <button class="btn btn-info" onclick="imprimir_boleta()">Imprimir</button>
                                        </div>
                                    </div>

                                    <div id="contenido_boleta" class="no-print" >
                                        <div style="border: 1px dashed black;" class="card-body m-3 p-3">
                                            <div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO: <span id="desde_imp_boleta"></span></h1>
                                                        <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRE: <span id="nombre_imp_boleta"></span></h1>
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
                                                                <h1 style="color: #000;font-weight: 600;font-size: 12px;">OCUPACIÓN: <span id="cargo_imp_boleta"></span></h1>
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
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">TOTAL DE REMUNERACIONES    S/. </h1>
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
                                                        <h1 style="color: #000;font-weight: 600;font-size: 14px;">COMISIÓN FIJA  </h1>
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
        <?php require_once("../Main/mainjs.php") ?>
        <script src="pensiones.js" type="text/javascript"></script>
    </body>
</html>
