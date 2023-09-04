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
                    <div class="container" style="max-width: 1020px !important;">
                        <div class="card" style="margin-top: 60px;">
                            <div class="card-header d-flex justify-content-between">
                                <h3>PREVISUALIZACIÓN</h3>
                                <div>
                                    <button class="btn btn-primary" onclick="print_canvas()">Imprimir</button>
                                </div>
                            </div>
                            <div id="contenido" class="card-body m-5 p-5">
                                <div class="d-flex justify-content-between mb-5">
                                    <div  style="text-align: right !important;">
                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
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
                                        <p style="color: #000;font-weight: 600;font-size: 16px;">SE DEJA CONSTANCIA QUE EL SEÑOR(A) <span style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXX</span> HA LABORADO PARA NUESTRA EMPRESA COMO A PARTIR DEL <span style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXXXX</span> AL <span style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXXXX.</span></p>
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
                                        <p style="color: #FF0000;font-weight: 600;font-size: 16px;">XXXXXXXXXXX</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container" style="max-width: 1020px !important;">
                        <div class="card" style="margin-top: 60px;">
                            <div class="card-header d-flex justify-content-between">
                                <h3>PREVISUALIZACIÓN</h3>
                                <div>
                                    <button class="btn btn-primary" onclick="imprimir_boleta()">Imprimir</button>
                                </div>
                            </div>
                            <div id="contenido_boleta" class="card-body" style="border: 1px dashed black;">
                                <div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO: <span>11.04.1998</span></h1>
                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">NOMBRE: <span>RAFAEL</span></h1>
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
                                                    <h1 style="color: #000;font-weight: 600;font-size: 12px;">OCUPACIÓN: <span></span></h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black;">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">DOMINICALES: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">TRABAJO EN FERIADO: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">DOMINGO TRABAJADO: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">HORAS EXTRAS: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIF DE LA EMPRESA: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIFICACIÓN PONAVIS: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">BONIF FAMILIAR: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">VACACIONES-PERÍODO: </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 text-left" style="border-right: 2px dashed black; ">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">SUELDO </h1>
                                        </div>
                                        <div class="col-4 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8" style="border-top: 1px dashed black; border-bottom: 1px solid black; border-right: 2px dashed black; text-align: right !important;">
                                            <h1 style="color: #000;font-weight: 600;font-size: 14px;">TOTAL DE REMUNERACIONES    S/. </h1>
                                        </div>
                                        <div class="col-4 text-left" style="color: #FF0000; font-weight: 600; font-size: 14px; border-top: 1px dashed black; border-bottom: 1px solid black;">XX.XX</div>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 14px;">XX.XX </h1>
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
                                        <div class="col-4 text-left" style="color: #FF0000; font-weight: 600; font-size: 14px; border-bottom: 1px solid black;">XX.XX</div>
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

                    <div class="container" style="max-width: 1020px !important;">
                        <div class="card" style="margin-top: 60px;">
                            <div class="card-header d-flex justify-content-between">
                                <h3>PREVISUALIZACIÓN</h3>
                                <div>
                                    <button class="btn btn-primary" onclick="imprimir_liquidacion()">Imprimir</button>
                                </div>
                            </div>
                            <div id="contenido_liqui" class="card-body m-5 p-5">
                                <div class="d-flex justify-content-between mb-5">
                                    <div  style="text-align: right !important;">
                                        <h1 style="color: #FF0000;font-weight: 600;font-size: 20px;">XXXXXX</h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">CARGO DESEMPEÑADO</h1>
                                        </div>
                                        <div class="col-6 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE INGRESO</h1>
                                        </div>
                                        <div class="col-6 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">FECHA DE CESE</h1>
                                        </div>
                                        <div class="col-6 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">TIEMPO DE SERVICIOS</h1>
                                        </div>
                                        <div class="col-6 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX</h1>
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
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX</h1>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <h1 style="color: #000;font-weight: 600;font-size: 12px;">PAGO TOTAL</h1>
                                        </div>
                                        <div class="col-6 text-left">
                                            <h1 style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXXX</h1>
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
                                        <p style="color: #000;font-weight: 600;font-size: 12px;">Al firmar la presente liquidación dejo constancia expresa que los señores de <span style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXX</span> han cumplido con abonarme todos los beneficios sociales conforme a Ley, por tanto, firmo dando por cancelado mi liquidación.</p>
                                    </div>
                                </div>
                                <br>
                                <div class="text-right">
                                    <div  style="text-align: right !important;">
                                        <p style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXXX</p>
                                    </div>
                                </div>
                                <br>
                                <div class="text-center">
                                    <div>
                                        <p style="color: #000;font-weight: 600;font-size: 12px;">.........................................................</p>
                                    </div>
                                    <div>
                                        <p style="color: #FF0000;font-weight: 600;font-size: 12px;">XXXXXXXXXX</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="pdf.js" type="text/javascript"></script>
    </body>
</html>
