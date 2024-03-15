var suma_anios = 0;
var suma_meses = 0;
var suma_dias = 0;
var firma1 = "";

var fecha_inicial_1;
var fecha_fin_1;
var cbx_tipo_1;
var cbx_base_1;
var cbx_estado_1;
var cbx_condicion_1;
var fecha_inicial_2;
var fecha_fin_2;
var cbx_tipo_2;
var cbx_base_2;
var cbx_estado_2;
var cbx_condicion_2;
var fecha_inicial_3;
var fecha_fin_3;
var cbx_tipo_3;
var cbx_base_3;
var cbx_estado_3;
var cbx_condicion_3;
var fecha_inicial_4;
var fecha_fin_4;
var cbx_tipo_4;
var cbx_base_4;
var cbx_estado_4;
var cbx_condicion_4;
var fecha_inicial_5;
var fecha_fin_5;
var cbx_tipo_5;
var cbx_base_5;
var cbx_estado_5;
var cbx_condicion_5;

var datos_firmantes;
var datos_empresa;

var alerta_uso;


$(document).ready(function(){
    $('.menus').on('click', function(e) {
        e.preventDefault();
        var linkUrl = $(this).attr('href');
        var valor = $('#valorguardar').val();
        console.log(valor);
        if(valor == ""){
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Todos los cambios no guardados se perderán.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, abandonar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, redirige al enlace original
                    window.location.href = linkUrl;
                }
            });
        }else {
            window.location.href = linkUrl;
        }
    });

    OcultarPrev();
    $("#divresultado").hide();
    $("#form_datos").hide();
    $("#resultado_pdf").hide();
    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev5").hide();
    $("#contemp1").hide();
    $('#temp_servicio').hide();
    $('#tabs-empresas').hide();

    $('#tipo_doc').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });
    
    $('#btnguardarpension').hide();
    $('#btnzipear').hide();
    //$('.tables').DataTable();

    //Cuando se edita la Lista
    var listaId = getParameterByName('lista');

    if(listaId == ""){
        //console.log("VACIO");
        alerta_uso = 0;
    }else {
        alerta_uso = 1;
        //Metodo Mostrar Lista ID
        $.post("../../controller/listacontrolador.php?op=mostrar_id",{lista_id : listaId},function(datos){
            if(datos != ""){
                datos = JSON.parse(datos);
                let cnt = datos.cantidad;
                $("#num_doc").val(datos.num_doc);
                $('#tipo_doc').val(datos.tipo_doc).trigger('change');
                $('#btnbuscar').click();
            }
            
        });     
    }

});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function init(){
    $("#pension_form").on("submit",function(e){
        generar(e);	
    });
    
}

function activarcargos(){

    let n = parseInt($('#txtcant_emp').val());
    for (i = 1 ; i <= n ; i++){
        $('#cargoc'+i).select2({
            placeholder: "Seleccione",
        });

        $('#lst_emp_'+i).select2({
            placeholder: "Seleccione"  
        });
        $('#logo'+i).select2({
            placeholder: "Seleccione",
            minimumResultsForSearch: Infinity  
        });
        // $('#firmante'+i).select2({
        //     placeholder: "Seleccione",
        //     minimumResultsForSearch: Infinity  
        // });
    }

    $('.cbx_tipos').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity  
    });
    
}

function generar(e){
    e.preventDefault();
    var formData = new FormData($("#pension_form")[0]);
    let cant_anios = $('#txtcant_anios').val();
    afid = $("#af_id").val();
    //creardivsempresa();
    $('#temp_servicio').show();
    let cnt = $('#txtcant_emp').val();
    let doc = $('#num_doc').val();
    let t_lista = $("#tipo_lista").val();
    fecha_inicial_1 = "1";
    fecha_fin_1 = "1";
    fecha_inicial_2 = "1";
    fecha_fin_2 = "1";
    fecha_inicial_3 = "1";
    fecha_fin_3 = "1";
    fecha_inicial_4 = "1";
    fecha_fin_4 = "1";
    fecha_inicial_5 = "1";
    fecha_fin_5 = "1";

    $.ajax({
        url: "../../controller/pensioncontrolador.php?op=afiliado",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            if(data != ""){
                data = JSON.parse(data);
                $('#af_id').val(data[0]["id"]);
            }

            if(afid == ""){
                swal.fire(
                    'Registro!',
                    'Se registro correctamente.',
                    'success'
                );  
            }
            creardivsempresa();
            $("#divresultado").show();
            $('#btnguardarpension').show();
            $('#btnzipear').show();
            activarcargos();
            crearTabs(cnt);

            //Ocultar por default el mensaje alerta
            $('.error-label').hide();

            //Iniciar select2 en todos los certificados
            $('.select_certificado').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.select_renuncia').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.combo_prev_cuerpo').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.combo_prev_liqui').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.select_mes_boletas').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });
        
            $('.select_anio_boletas').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            
            $('.combo_prev_boleta').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            //Ocultar contenedores
            $('.contenedores_emp').hide();

            //Recuperar datos del combo MOTIVO CESE
            $.post("../../controller/motivocontrolador.php?op=combo",{},function(data){
                $('.combo_prev_liqui').html(data);
            }); 
                        
            /** SETEAR FECHAS A LOS DIV */
            let fnac = $('#txtdate').val();
            //let manana = moment(fnac).add(16, 'years').format('YYYY-MM-DD');
            let manana = moment(fnac).add(cant_anios, 'years').format('YYYY-MM-DD');
            $('#f_inicio_1').val(manana);
            $('#f_inicio_1').attr("min" ,manana); 
            


            
            $.post("../../controller/cargocontrolador.php?op=comborpt",{}, function(data){
                
                for(i = 1 ; i<= cnt ; i++){
                    $("#cargoc"+i).html(data);
                    $("#div_logo_"+i).hide();
                }
            });
        
            $.post("../../controller/logocontrolador.php?op=combo",{}, function(data){
        
                for(i = 1 ; i<= cnt ; i++){
                   $("#logo"+i).html(data);
                }
            });

            $.post("../../controller/listacontrolador.php?op=mostrar",{num_doc: doc, lista : t_lista},function(datos){
                if(datos != ""){
                    //console.log(datos);
                    datos = JSON.parse(datos);
                    //console.log(datos);
                    let cant = datos.cantidad;
                    for( let i = 1 ; i <= cant ; i++){
                        $("#f_inicio_"+i).val(datos["fech"+i]);
                        $("#f_final_"+i).val(datos["fech_final_"+i]);
                        $("#cbx_tipo_"+i).val(datos["tipo_"+i]).trigger('change');
                        $("#cbx_base_"+ i).val(datos["base_"+i]).trigger('change');
                        $('#cbx_estado_'+ i).val(datos["estado_"+i]).trigger('change');
                        $('#cbx_condicion_'+ i).val(datos["condicion_"+i]).trigger('change');

                        mostrardetalle(i, 0, 0);
                        
                        setTimeout(function() {
                            //console.log("Despues de 1 segundo");
                            mostrardetalle(i, datos["ruc"+i], 1);
                            $("#cargoc"+i).val(datos["cargo"+i]).trigger('change');
                            $("#logo"+i).val(datos["logo"+i]).trigger('change');
                            $("#lst_emp_"+i).val(datos["ruc"+i]).trigger('change');
                            $("#firmante"+i).val(datos["firmante"+i]);
                            console.log(datos["ruc"+i]);
                        }, 600); 
                    }
                    var datos_tabs = JSON.parse(datos.datos_derecha)
                    for( let i = 1 ; i<=5 ; i++){
                        let datos_emp = datos_tabs;
                        let dato_empresa = datos_emp.empresas["empresa" + i];
                        //Certificado
                        $('#select_certificado'+ i).val(dato_empresa.Certificado.tipo_certificado).trigger('change');
                        $('#fecha_certificado'+ i).val(dato_empresa.Certificado.fecha_emision);
                        //Liquidacion
                        $('#sueldo_liquidacion'+ i).val(dato_empresa.Liquidacion.sueldo);
                        $('#adelanto'+ i).val(dato_empresa.Liquidacion.adelanto);
                        $('#vacaciones'+ i).val(dato_empresa.Liquidacion.vacaciones);
                        $('#gratificaciones'+ i).val(dato_empresa.Liquidacion.gratificaciones);
                        $('#reintegro'+ i).val(dato_empresa.Liquidacion.reintegro);
                        $('#incentivo'+ i).val(dato_empresa.Liquidacion.incentivo);
                        $('#bonif'+ i).val(dato_empresa.Liquidacion.bonificacion);
                        $('#bonif_extra'+ i).val(dato_empresa.Liquidacion.bonif_extra);
                        $('#bonif_gra'+ i).val(dato_empresa.Liquidacion.bonif_grac);
                        $('#bonif_meta'+ i).val(dato_empresa.Liquidacion.bonif_meta);
                        $('#bonif_dias'+ i).val(dato_empresa.Liquidacion.bonif_festivo);
                        $('#combo_prev_cuerpo'+ i).val(dato_empresa.Liquidacion.tipo).trigger('change');
                        $('#combo_prev_liqui'+ i).val(dato_empresa.Liquidacion.motivo).trigger('change');
                        $('#fecha_liquidacion'+ i).val(dato_empresa.Liquidacion.fecha_emision);
                        //Boleta
                        $('#select_anio_boletas'+ i).val(dato_empresa.Boleta.anio_boleta).trigger('change');
                        $('#select_mes_boletas'+ i).val(dato_empresa.Boleta.mes_boleta).trigger('change');
                        $('#sueldo_boleta'+ i).val(dato_empresa.Boleta.sueldo);
                        $('#rm_vacacional_boleta'+ i).val(dato_empresa.Boleta.rem_vaca);
                        $('#reintegro_boleta'+ i).val(dato_empresa.Boleta.reintegro);
                        $('#horaex_boleta'+ i).val(dato_empresa.Boleta.h_extras);
                        $('#boni_boleta'+ i).val(dato_empresa.Boleta.bonif);
                        $('#bonificacion_alimentos_boleta'+ i).val(dato_empresa.Boleta.bonif_alimentos);
                        $('#bonificacion_metas_boleta'+ i).val(dato_empresa.Boleta.bonif_metas);
                        $('#bonificacion_logros_boleta'+ i).val(dato_empresa.Boleta.bonif_logros);
                        $('#bonificacion_festivos_boleta'+ i).val(dato_empresa.Boleta.bonif_dias);
                        $('#bonificacion_pasajes_boleta'+ i).val(dato_empresa.Boleta.pasajes);
                        $('#bonificacion_uniforme_boleta'+ i).val(dato_empresa.Boleta.uniforme);
                        $('#bonificacion_gratificacion_boleta'+ i).val(dato_empresa.Boleta.gratificacion);
                        $('#otros_boleta'+ i).val(dato_empresa.Boleta.otros);
                        $('#combo_prev_boleta'+ i).val(dato_empresa.Boleta.modelo_boleta).trigger('change');
                        //Renuncia
                        $('#select_renuncia'+ i).val(dato_empresa.Renuncia.tipo_renuncia).trigger('change');
                        $('#fecha_renuncia'+ i).val(dato_empresa.Renuncia.fecha_emision);
                    }

                    
                
                    $('#prev1').hide();
                }else {

                }    
            });

            
            
        }
    }); 

}

function crearTabs(valor) {
    //Activar el div para mostrar el tab
    $('#tabs-empresas').show();
    // Limpiar el contenedor de tabs y el nav
    $("#tabsContainer").empty();
    $("#tabsNav").empty();

    // Crear tabs dinámicamente
    for (var i = 1; i <= valor; i++) {
        var tabContent = '<div class="tab-pane fade" id="content' + i + '"><input type="hidden" id="num_emp">';
        tabContent += '<div class="contenedores_emp" id="contenedor_emp'+ i +'">';
        tabContent += '     <br>';    
        tabContent += '     <input  type="hidden" id="nombre_emp'+ i +'" name="nombre_emp">';
        tabContent += '     <input  type="hidden" id="fech_inicio_emp'+ i +'" name="fech_inicio_emp">';
        tabContent += '     <input  type="hidden" id="fech_final_emp'+ i +'" name="fech_final_emp">';
        tabContent += '     <input  type="hidden" id="sueldo_emp'+ i +'" name="sueldo_emp">';
        tabContent += '     <input  type="hidden" id="moneda_emp'+ i +'" name="moneda_emp">';
        tabContent += '     <input  type="hidden" id="cargo_emp'+ i +'" name="cargo_emp">';
        tabContent += '     <input  type="hidden" id="dpto_emp'+ i +'" name="dpto_emp">';
        tabContent += '     <input  type="hidden" id="tipo_emp'+ i +'" name="tipo_emp">';
        tabContent += '     <input  type="hidden" id="logo_nombre'+ i +'" name="logo_nombre">';
        tabContent += '     <input type="hidden" id="firmante_emp'+ i +'" name="firmante_emp">';
        tabContent += '     <input type="hidden" id="ruc_emp'+ i +'" name="ruc_emp">';
        tabContent += '     <h5 class="text-center" id="nom_emp_lab'+ i +'"></h5>';
        tabContent += '     <br>';
        tabContent += '     <ul class="nav nav-tabs mb-3" id="pills-tab'+ i +'" role="tablist" style="border-bottom : 0px">';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link active btn btn-outline-secondary btn-block mg-b-10 "  id="orcinea-tab'+ i +'"  data-bs-toggle="pill" data-bs-target="#certificado'+ i +'" type="button" role="tab" aria-controls="certificado"  aria-selected="true" >Certificado</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="host-tab'+ i +'"     data-bs-toggle="pill" data-bs-target="#liquidacion'+ i +'"    type="button" role="tab" aria-controls="liquidacion"     aria-selected="false">Liquidacion</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="boleta-tab'+ i +'"   data-bs-toggle="pill" data-bs-target="#boleta'+ i +'"  type="button" role="tab" aria-controls="boleta"   aria-selected="false" onclick="boleta_tab('+ i +')">Boleta</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="renuncia-tab'+ i +'"   data-bs-toggle="pill" data-bs-target="#renuncia'+ i +'"  type="button" role="tab" aria-controls="renuncia"   aria-selected="false" >Renuncia</button>';
        tabContent += '         </li>';
        tabContent += '     </ul>';
        tabContent += '     <div class="tab-content">';
        tabContent += '         <div id="certificado'+ i +'" class="tab-pane fadein show active">';
        tabContent += '             <form id="form_certificado'+ i +'" action="" method="post" autocomplete="off">';
        tabContent += '                 <div class="form-layout form-layout-1">';
        tabContent += '                     <div class="row ">';
        tabContent += '                         <input type="hidden" id="emp_certificado'+ i +'" name="emp_certificado">';
        tabContent += '                         <input type="hidden" id="nombre_certificado'+ i +'" name="nombre_certificado">';
        tabContent += '                         <input type="hidden" id="f_ini_certificado'+ i +'" name="f_ini_certificado">';
        tabContent += '                         <input type="hidden" id="f_baj_certificado'+ i +'" name="f_baj_certificado">';
        tabContent += '                         <input type="hidden" id="cargo_certificado'+ i +'" name="cargo_certificado">';
        tabContent += '                         <input type="hidden" id="firmante_certificado'+ i +'" name="firmante_certificado">';
        tabContent += '                         <input type="hidden" id="lugar_certificado'+ i +'" name="lugar_certificado">';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Certificado: </label>';
        tabContent += '                                 <div class="col-lg-6 pd-0">';
        tabContent += '                                     <select class="form-control col-lg-6 select2 select_certificado" data-placeholder="Seleccione" id="select_certificado'+ i +'"  style="width: 100%" >';        
        tabContent += '                                     </select>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Fecha de Emision: </label>';
        tabContent += '                                 <div class="form-group col-lg-6" style="padding: 0; margin-bottom: 0;">';
        tabContent += '                                     <input type="date" oninput="ValidarFecha(this)" class="form-control"  id="fecha_certificado'+ i +'"  style="width: 100%"/>';        
        tabContent += '                                     <div class="error-msg"></div>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                         </div> ';
        tabContent += '                     </div>';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row justify-content-end">';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="" class="btn btn-info" onclick="imprimir_word('+ i +')" style="width: 100%;">Descargar en Word</button>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnprevcer'+ i +'" name="btnprevcer" onclick="PrevCertificado('+ i +')"  class="btn btn-secondary" style="width: 100%;">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div> ';
        tabContent += '                     <!--<button type="button" id="btnimprimirbol'+ i +'" name="btnimprimirbol"  class="btn btn-info">Imprimir Boleta</button>-->';
        tabContent += '                 </div>';
        tabContent += '             </form>';
        tabContent += '         </div>';
        tabContent += '         <div id="liquidacion'+ i +'" class="tab-pane fade">';
        tabContent += '             <form id="form_liqui'+ i +'" action="" method="post" autocomplete="off">';
        tabContent += '                 <input type="hidden" name="dias_liqui" id="dias_liqui'+ i +'">';
        tabContent += '                 <input type="hidden" name="meses_liqui" id="meses_liqui'+ i +'">';
        tabContent += '                 <input type="hidden" name="anios_liqui" id="anios_liqui'+ i +'">';
        tabContent += '                 <div class="form-layout form-layout-1">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Sueldo: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="SUELDO" id="sueldo_liquidacion'+ i +'" value="0" placeholder="" disabled>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Adelanto: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="ADELANTO" id="adelanto'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Vacaciones:</label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="VACACIONES" id="vacaciones'+ i +'"  value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Gratificaciones: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="GRATIFICACIONES" id="gratificaciones'+ i +'"  value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Reintegro: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="REINTEGRO" id="reintegro'+ i +'"  value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Incentivo: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="INCENTIVO" id="incentivo'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bonificacion: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="BONIFICACION" id="bonif'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bon. Extraordinaria:</label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="BON. EXTRAORDINARIA" id="bonif_extra'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bon. Graciosa: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="BON. GRACIOSA" id="bonif_gra'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bon. Por Cumplimiento de Meta: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="BON. POR CUMPLIENTO DE META" id="bonif_meta'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bon. Por Dias Festivos: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="BON. POR DIAS FESTIVOS" id="bonif_dias'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-12 col-sm-6">';
        tabContent += '                             <div class="form-group">';
        tabContent += '                                 <label class="form-control-label text-left">Tipos de Cuerpo</label>';
        tabContent += '                                 <select class="form-control select2 combo_prev_cuerpo" data-placeholder="Seleccione" name="combo_prev_cuerpo'+ i +'" id="combo_prev_cuerpo'+ i +'" style="width: 100%;">';
        tabContent += '                                     <option value="1">Modelo 1</option>';
        tabContent += '                                     <option value="2">Modelo 2</option>';
        tabContent += '                                     <option value="3">Modelo 3</option>';
        tabContent += '                                 </select>';
        tabContent += '                             </div>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-6">';
        tabContent += '                             <div class="form-group">';
        tabContent += '                                 <label class="form-control-label text-left">Motivo de Retiro</label>';
        tabContent += '                                 <select class="form-control select2 combo_prev_liqui" data-placeholder="Motivo de Retiro" name="combo_prev_liqui'+ i +'" id="combo_prev_liqui'+ i +'" style="width: 100%;">';
        tabContent += '                                 </select>';
        tabContent += '                             </div>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-6"></div>';
        tabContent += '                         <div class="col-12 col-sm-6">';
        tabContent += '                             <div class="form-group">';
        tabContent += '                                 <label class="form-control-label text-left">Fecha de Emision</label>';
        tabContent += '                                 <input type="date" oninput="ValidarFecha(this)" class="form-control"  id="fecha_liquidacion'+ i +'"  style="width: 100%"/>';
        tabContent += '                                 <div class="error-msg text-left"></div>';
        tabContent += '                             </div>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                     <div class="row justify-content-end">';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="" class="btn btn-info" onclick="imprimir_liquidacion_word('+ i +')" style="width:100%">Descargar en Word</button>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnprevli'+ i +'" name="btnprevli" onclick="PrevLiquidacion('+ i +')"  class="btn btn-secondary mg-l-10" style="width:100%">  Previsualizar  </button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                     <!--<button type="button" id="btnimprimirli'+ i +'" name="btnimprimirli"  class="btn btn-info">Imprimir Liquidacion</button>-->';
        tabContent += '                 </div>';
        tabContent += '             </form>';
        tabContent += '         </div>';
        tabContent += '         <div id="boleta'+ i +'" class="tab-pane fade">';
        tabContent += '             <form id="form_bol'+ i +'" action="" method="post" autocomplete="off">';
        tabContent += '                 <div class="form-layout form-layout-1">';
        tabContent += '                     <div class="row justify-content-around">';
        tabContent += '                         <!--<div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnboletas'+ i +'" name="btnboletas"  class="btn btn-info"  style="width:100%; font-size: 12px">Visualizar Boletas</button>';
        tabContent += '                         </div>-->';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <div class="row justify-content-center">';
        tabContent += '                                 <button type="button" id="btnboletas_dsc'+ i +'" name="btnboletas_dsc"  class="btn btn-info"   style="width:100%; font-size: 12px" onclick="boleta_desc('+ i +')">Visualizar Descuentos</button>';
        tabContent += '                             </div>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <div class="row justify-content-center">';
        tabContent += '                                 <button type="button" id="btnboletas_dsc_mes'+ i +'" name="btnboletas_dsc_mes"  class="btn btn-info" style="width:100%; font-size: 12px" onclick="boleta_desc_info('+ i +')">Visualizar Boleta Actual</button>';
        tabContent += '                             </div>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                     <br>';
        tabContent += '                     <div class="row ">';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <input type="hidden" name="total_monto_boleta" id="total_monto_boleta'+ i +'">';
        tabContent += '                             <input type="hidden" id="at_ss'+ i +'">';
        tabContent += '                             <input type="hidden" id="at_fonavi'+ i +'">';
        tabContent += '                             <input type="hidden" id="at_pension'+ i +'">';
        tabContent += '                             <input type="hidden" id="ap_ss'+ i +'">';
        tabContent += '                             <input type="hidden" id="ap_fonavi'+ i +'">';
        tabContent += '                             <input type="hidden" id="ap_pension'+ i +'">';
        tabContent += '                             <input type="hidden" id="sueldo_minimo'+ i +'">';
        tabContent += '                             <input type="hidden" id="unidad_moneda'+ i +'">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Año: </label>';
        tabContent += '                                 <div class="col-lg-6 pd-0">';
        tabContent += '                                     <select class="form-control col-lg-6 select2 select_anio_boletas" data-placeholder="Seleccione" id="select_anio_boletas'+ i +'" name="select_anio_boletas'+ i +'" style="width: 100%">';
        tabContent += '                                     </select>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Mes: </label>';
        tabContent += '                                 <div class="col-lg-6 pd-0">';
        tabContent += '                                     <select class="form-control col-lg-6 select2 select_mes_boletas" data-placeholder="Seleccione" id="select_mes_boletas'+ i +'" name="select_mes_boletas'+ i +'" style="width: 100%" onchange="MostrarBoleta('+ i +')">';
        tabContent += '                                         <option label="Seleccione"></option>';
        tabContent += '                                         <option value="all">Año</option>';
        tabContent += '                                         <option value="ene">Enero</option>';
        tabContent += '                                         <option value="feb">Febrero</option>';
        tabContent += '                                         <option value="mar">Marzo</option>';
        tabContent += '                                         <option value="abr">Abril</option>';
        tabContent += '                                         <option value="may">Mayo</option>';
        tabContent += '                                         <option value="jun">Junio</option>';
        tabContent += '                                         <option value="jul">Julio</option>';
        tabContent += '                                         <option value="ago">Agosto</option>';
        tabContent += '                                         <option value="sep">Septiembre</option>';
        tabContent += '                                         <option value="oct">Octubre</option>';
        tabContent += '                                         <option value="nov">Noviembre</option>';
        tabContent += '                                         <option value="dic">Diciembre</option>';
        tabContent += '                                     </select>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                         </div> ';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Sueldo: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="sueldo_boleta" id="sueldo_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"   placeholder=""  >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">REM. Vacacional: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="rm_vacacional_boleta" id="rm_vacacional_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Reintegro: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="reintegro_boleta" id="reintegro_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"  placeholder=""  >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">H. Extras: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="horaex_boleta" id="horaex_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bonificacion: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="boni_boleta" id="boni_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bonificacion Por Alimentos: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_alimentos_boleta" id="bonificacion_alimentos_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bonificacion Por Metas Cumplidas: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_metas_boleta" id="bonificacion_metas_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bonificacion Por Logros Cumplidas: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_logros_boleta" id="bonificacion_logros_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Bonificacion Por Dias Festivos: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_festivos_boleta" id="bonificacion_festivos_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Pasajes: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_pasajes_boleta" id="bonificacion_pasajes_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Uniforme: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_uniforme_boleta" id="bonificacion_uniforme_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="">';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Gratificacion: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_gratificacion_boleta" id="bonificacion_gratificacion_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Otros: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="otros_boleta" id="otros_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <select class="form-control select2 combo_prev_boleta" name="combo_prev_boleta" id="combo_prev_boleta'+ i +'" style="width: 100%;">';
        tabContent += '                                 <option value="1">Modelo Boleta 1</option>';
        tabContent += '                                 <option value="2">Modelo Boleta 2</option>';
        tabContent += '                                 <option value="3">Modelo Boleta 3</option>';
        tabContent += '                                 <option value="4">Modelo Boleta 4</option>';
        tabContent += '                                 <option value="5">Modelo Boleta 5</option>';
        tabContent += '                                 <option value="6">Modelo Boleta 6</option>';
        tabContent += '                                 <option value="7">Modelo Boleta 7</option>';
        tabContent += '                                 <option value="8">Modelo Boleta 8</option>';
        tabContent += '                                 <option value="9">Modelo Boleta 9</option>';
        tabContent += '                                 <option value="10">Modelo Boleta 10</option>';
        tabContent += '                                 <option value="11">Modelo Boleta 11</option>';
        tabContent += '                                 <option value="12">Modelo Boleta 12</option>';
        tabContent += '                                 <option value="13">Modelo Boleta 13</option>';
        tabContent += '                                 <option value="14">Modelo Boleta 14</option>';
        tabContent += '                                 <option value="15">Modelo Boleta 15</option>';
        tabContent += '                                 <option value="16">Modelo Boleta 16</option>';
        tabContent += '                                 <option value="17">Modelo Boleta 17</option>';
        tabContent += '                             </select>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="" class="btn btn-info" onclick="imprimir_liquidacion_boleta('+ i +')" style="width:100%">Descargar en Word</button>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnprevbol'+ i +'" name="btnprevbol" onclick="PrevBoleta('+ i +')" class="btn btn-secondary" style="width:100%">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                 </div>';
        tabContent += '             </form>';
        tabContent += '         </div>';
        tabContent += '         <div id="renuncia'+ i +'" class="tab-pane fade">';
        tabContent += '             <form id="form_renuncia'+ i +'" action="" method="post" autocomplete="off">';
        tabContent += '                 <div class="form-layout form-layout-1">';
        tabContent += '                     <div class="row ">';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Certificado: </label>';
        tabContent += '                                 <div class="col-lg-6 pd-0">';
        tabContent += '                                     <select class="form-control col-lg-6 select2 select_renuncia" data-placeholder="Seleccione" id="select_renuncia'+ i +'"  style="width: 100%" >';        
        tabContent += '                                         <option value="1">Modelo Renuncia 1</option>';
        tabContent += '                                         <option value="2">Modelo Renuncia 2</option>';
        tabContent += '                                         <option value="3">Modelo Renuncia 3</option>';
        tabContent += '                                         <option value="4">Modelo Renuncia 4</option>';
        tabContent += '                                         <option value="5">Modelo Renuncia 5</option>';
        tabContent += '                                         <option value="6">Modelo Renuncia 6</option>';
        tabContent += '                                         <option value="7">Modelo Renuncia 7</option>';
        tabContent += '                                         <option value="8">Modelo Renuncia 8</option>';
        tabContent += '                                         <option value="9">Modelo Renuncia 9</option>';
        tabContent += '                                         <option value="10">Modelo Renuncia 10</option>';
        tabContent += '                                     </select>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Fecha de Emision: </label>';
        tabContent += '                                 <div class="form-group col-lg-6" style="padding: 0; margin-bottom: 0;">';
        tabContent += '                                     <input type="date" oninput="ValidarFecha(this)" class="form-control"  id="fecha_renuncia'+ i +'"  style="width: 100%"/>';        
        tabContent += '                                     <div class="error-msg"></div>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                         </div> ';
        tabContent += '                     </div>';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row justify-content-end">';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="" class="btn btn-info" onclick="imprimir_word_renuncia('+ i +')" style="width: 100%;">Descargar en Word</button>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnprevrenu'+ i +'" name="btnprevren" onclick="PrevRenuncia('+ i +')"  class="btn btn-secondary" style="width: 100%;">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div> ';
        tabContent += '                 </div>';
        tabContent += '             </form>';
        tabContent += '         </div>';
        tabContent += '     </div>';
        tabContent += '</div>';

        $("#tabsContainer").append(tabContent);

        var tabButton = '<li class="nav-item">';
        tabButton += '<a class="nav-link" id="tab' + i + '" data-bs-toggle="tab" href="#content' + i + '" onclick="SeleccionarEmp('+ i +')">Empresa ' + i + '</a>';
        tabButton += '</li>';

        $("#tabsNav").append(tabButton);
    }

    // Activar el primer tab
    $("#tabsNav .nav-item:first-child a").tab("show");
}

function SeleccionarEmp(e){
    console.log("Empresa selecionada: "+ e);
    $('#num_emp').val(e);// Asignar el numero al hidden
}

function creardivsempresa(){
    numero = $("#txtcant_emp").val();
    var div = "";
    for ( var i = 1; i <= numero; i++){
        //console.log(i);
        div+=   '<div class="accordion-item" id="col_emp_'+i+'">'+
                    "<h2 class='accordion-header'  id='heading"+i+"' >"+
                        "<button class='accordion-button collapsed' style='padding: 0.65rem 1rem' type='button' data-bs-toggle='collapse' data-bs-target='#collapse_"+i+"' aria-expanded='false' aria-controls='collapse_"+i+"'>"+
                            "<div class='row justify-content-between' style='width: 100%'>"+
                                "<div class='col-8'>"+
                                    "<label id='nom_emp_"+i+"'>Empresa "+i+"</label>"+
                                "</div>"+
                                "<div class='col-4'>"+
                                    "<label id='tiempo_header_"+i+"' style='font-size:0.85rem'></label>"+
                                "</div>"+
                            "</div>"+
                        "</button>"+
                    "</h2>"+
                    "<div id='collapse_"+i+"' class='accordion-collapse collapse' aria-labelledby='heading"+i+"' data-bs-parent='#accordionExample'>"+
                        "<div class='accordion-body'>"+
                            "<div class='acer'>"+
                                "<div class='row justify-content-start mb-1' >"+
                                    "<div class='col-2'>"+
                                        "<button class='btn btn-outline-info btn-icon' onclick='CopiarEmp("+i+")'><div><i class='fa fa-copy'></i></div></button>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row' id='fechas' >"+
                                    "<div class='col-12 col-sm-4'>"+
                                        "<div class='form-group' >"+
                                            "<label class='form-control-label'>Desde</label>"+
                                            "<input class='form-control fecha-input' oninput='ValidarFecha(this)'   type='date' max='2099-12-31' min='1900-12-31' id='f_inicio_"+i+"'>"+
                                            "<div class='error-msg'></div>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-4'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Hasta</label>"+
                                            "<input class='form-control fecha-input' oninput='ValidarFecha(this)'  type='date' max='2999-12-31' min='1900-12-31' id='f_final_"+i+"' >"+
                                            "<div class='error-msg'></div>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-4'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Tamaño de Empresa</label>"+
                                            "<select class='form-control select2 cbx_tipos' id='cbx_tipo_"+i+"' style='width: 100%'>"+
                                                "<option value='P'>P</option>"+
                                                "<option value='M'>M</option>"+
                                                "<option value='G'>G</option>"+
                                                "<option value='V'>V</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='d-none'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Base  </label>"+
                                            "<select class='form-control select2 cbx_tipos' id='cbx_base_"+i+"' style='width: 100%'>"+
                                                "<option value='1'>BASE 1</option>"+
                                                "<option value='2'>BASE 2</option>"+
                                                "<option value='0' selected>AMBAS BASES</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='d-none'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Estado </label>"+
                                            "<select class='form-control select2 cbx_tipos' id='cbx_estado_"+i+"' style='width: 100%'>"+
                                                "<option value='V'>TODOS</option>"+
                                                "<option value='ACTIVO'>ACTIVO</option>"+
                                                "<option value='BAJA DE OFICIO'>BAJA DE OFICIO</option>"+
                                                "<option value='BAJA DEFINITIVA'>BAJA DEFINITIVA</option>"+
                                                "<option value='BAJA PROVISIONAL'>BAJA PROVISIONAL</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='d-none'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Condicion </label>"+
                                            "<select class='form-control select2 cbx_tipos' id='cbx_condicion_"+i+"' style='width: 100%'>"+
                                                "<option value='V'>TODOS</option>"+
                                                "<option value='HABIDO'>HABIDO</option>"+
                                                "<option value='NO HABIDO'>NO HABIDO</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-12'>"+
                                        "<div class='row justify-content-center'>"+
                                            "<div class='col-4'></div><div class='col-4 mb-1 text-center'>"+
                                                "<button type='button' id='btnmostrarempr_"+i+"' name='btnmostrarempr_"+i+"' onclick='mostrardetalle("+i+", 0, 0)' class='btn btn-info' >Mostrar Documentos</button>"+
                                            "</div>"+
                                            "<div class='col-4' style='text-align: right'>"+
                                                "<button class='btn btn-outline-danger btn-icon' onclick='ActualizarEmp("+i+")'><div><i class='fa fa-edit'></i></div></button>"+
                                            "</div>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-12'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label' for='lst_emp_"+i+"'>Empresa</label>"+
                                            "<select class='form-control select2' name='lst_emp_"+i+"' id='lst_emp_"+i+"' data-placeholder='Seleccione' style='width: 100%' required onchange='ListarFirmante("+i+")'></select>"+
                                            "<label id='errorLabel_"+i+"' class='error-label' style='color: red;'>Texto predeterminado</label>"+ // Label con texto predeterminado
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-6'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Estado</label>"+
                                            "<input type='text' class='form-control' id='estado_emp_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-6'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Condición</label>"+
                                            "<input type='text' class='form-control' id='condicion_emp_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-6'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Tiempo</label>"+
                                            "<input type='text' class='form-control' id='rango_emp_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-6 '>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Sueldo</label>"+
                                            "<input type='text' class='form-control' id='fech_sueldo_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='d-none'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Tipo Empresa:</label>"+
                                            "<input type='text' class='form-control' id='tipo_emp_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>"+
                                "<input type='hidden' value='"+i+"' id='valor_id_"+i+"' >"+
                                "<input type='hidden'  id='ruc_emp_"+i+"'>"+
                                "<input type='hidden'  id='dpto_emp_"+i+"'>"+
                                "<input type='hidden' value='0' id='anios_emp_"+i+"'>"+
                                "<input type='hidden' value='0' id='meses_emp_"+i+"'>"+
                                "<input type='hidden' value='0' id='dias_emp_"+i+"'>"+
                                "<input type='hidden' value='' id='cant_sueldo_"+i+"'>"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='direc"+i+"' class='col-sm-3 col-form-label'>Dirección:</label>"+
                                    "<div class='col-sm-8'>"+
                                        "<input type='text' class='form-control' id='direccion"+i+"' name='direccion"+i+"' readonly>"+
                                    "</div>"+
                                    "<div class='col-sm-1' style='padding-left: 0'><button type='button' onclick='MostrarDireccion("+i+")'  id='btn_ver_direccion"+i+"' class='btn btn-outline-primary btn-icon' style='width:100%;'><div><i class='fa fa-search'></i></div></button></div>"+
                                "</div><!-- row -->"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='cargoc"+i+"' class='col-sm-3 col-form-label'>Cargo:</label>"+
                                    "<div class='col-sm-9'>"+
                                        "<select required id='cargoc"+i+"' name='cargoc"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%' >"+
                                        "</select>"+
                                    "</div>"+
                                "</div><!-- row -->"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='firmantec"+i+"' class='col-sm-3 col-form-label'>Firmante:</label>"+
                                    "<div class='col-sm-8'>"+
                                        "<!--<select required id='firmante"+i+"' name='firmante"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%'>"+
                                            "<option label='Seleccione'></option>"+
                                            "<option value='SIN'>SIN FIRMANTE</option>"+
                                        "</select>-->"+
                                        "<input type='text' class='form-control' id='firmante"+i+"' name='firmante"+i+"' readonly>"+
                                    "</div>"+
                                    "<div class='col-sm-1' style='padding-left: 0'><button type='button' onclick='MostrarFirmante("+i+")'  id='btn_ver"+i+"' class='btn btn-outline-primary btn-icon' style='width:100%;'><div><i class='fa fa-search'></i></div></button></div>"+
                                "</div><!-- row -->"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='logo"+i+"' class='col-sm-3 col-form-label'>Logo:</label>"+
                                    "<div class='col-sm-9'>"+
                                        "<select required id='logo"+i+"' name='logo"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%' onchange='ListarLogo("+i+")' >"+
                                        "</select>"+
                                    "</div>"+
                                    "<div class='d-none' id='div_logo_"+i+"'>"+
                                        "<img id='logo_img_"+i+"' src='../../assets/img/no-fotos.png' alt='' width='100px' height='60px'>"+
                                    "</div>"+
                                "</div><!-- row -->"+
                                "<div class='form-layout-footer text-end'>"+
                                "</div>"+
                            "</div><!-- form-layout -->"+
                        "</div>"+
                    "</div>"+
                "</div>" ;
                
    }
    $("#acc_resultado").html(div);
}

function validarInputs(){
    if(document.getElementById("tipo_doc").value =="D.N.I")
    {
        document.getElementById("num_doc").maxLength = 8;
        document.getElementById("num_doc").type = "number";
        $('#num_doc').attr("oninput" ,"if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" );
    }
    else{
        if(document.getElementById("tipo_doc").value =="C.E"){
            document.getElementById("num_doc").maxLength = "11";
            document.getElementById("num_doc").type = "text";
            
        }
        else
        {
            if(document.getElementById("tipo_doc").value =="PAS"){
                document.getElementById("num_doc").maxLength = "11";
                document.getElementById("num_doc").type = "text";
            }
        }            
    }   
}

$(document).on("click","#btnbuscar", function(){
    
    tipo = $("#tipo_doc").val();
    doc = $("#num_doc").val();
    docnum = $("#num_doc").val().length;
    t_lista  = $("#tipo_lista").val();
    $('#btnautogenerar').attr('disabled', false);

    /*OBTENER LA CONFG DE EDAD  */
    $.post("../../controller/edadcontrolador.php?op=mostrar",{edad_id: 1},function(data){
        //console.log(data);
        data = JSON.parse(data);
        $('#txtcant_anios').val(data.edad).trigger('change');
        

    });

    if(doc =="" ||  tipo == ""){
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca datos validos',
            showConfirmButton: false,
            timer:1500
        });
    }else {
        
        $.post("../../controller/pensioncontrolador.php?op=buscar",{tipo_doc: tipo , num_doc: doc},function(data){
            
            if(data == ""){
                Swal.fire({
                    title: 'No existe informacion en el sistema, Desea registrar los datos?',
                    showDenyButton: true,
                    confirmButtonText: 'SI',
                    denyButtonText: `NO`,
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form_datos").show();
                        $('#form_datos').removeClass().addClass('form-layout form-layout-1 ');

                        $.post("../../controller/pensioncontrolador.php?op=consulta_dni_nac",{dni: doc},function(data){
                            //console.log(data);
                            if(data != ""){
                                data = JSON.parse(data);
                                $('#txtnombre').val(data.data.nombres);
                                $('#txtapellido').val(data.data.apellidoPaterno + ' '+data.data.apellidoMaterno);
                                $('#txtdate').val(convertDateFormatDate(data.data.fechaNacimiento));
                            }
                        });
                        
                    } else if (result.isDenied) {
                    }
                    })
            }else {
                //Si encuentra un afiliado registrado
                data = JSON.parse(data);
                $('#af_id').val(data.id);
                $('#tipo_doc').val(data.tipo_doc);
                $('#num_doc').val(data.num_doc);
                $('#txtnombre').val(data.nombres);
                $('#txtapellido').val(data.ap_pa);
                $('#txtdate').val(data.fech_nac);
                $("#form_datos").show();
                $('#form_datos').removeClass().addClass('form-layout form-layout-1 ');  

                $.post("../../controller/listacontrolador.php?op=mostrar",{num_doc: doc,  lista : t_lista },function(datos){
                    if(datos != ""){

                        alerta_uso = 1;
                        //console.log(datos);
                        datos = JSON.parse(datos);
                        $("#lista_id").val(datos.id);
                        $("#txtcant_emp").val(datos.cantidad);
                        $("#btnautogenerar").click();

                    }
                    
                }); 
            }
        });
    }

    
});


function convertDateFormat(string) {
    var info = string.split('-').reverse().join('.');
    return info;
}

function convertDateFormatDate(string) {
    var info = string.split('/').reverse().join('-');
    return info;
}


function CopiarEmp(a) {
    // Obtén el contenido del elemento usando jQuery
    let texto = $('#ruc_emp_' + a).val();
    // Crea un elemento de textarea temporal
    var textarea = document.createElement('textarea');
    textarea.value = texto;
    // Agrega el textarea al documento
    document.body.appendChild(textarea);
    // Selecciona el contenido del textarea
    textarea.select();
    // Copia el contenido al portapapeles
    document.execCommand('copy');
    // Elimina el textarea temporal
    document.body.removeChild(textarea);
    // Muestra una alerta de SweetAlert indicando que el texto se ha copiado
    Swal.fire({
        icon: 'success',
        title: 'Texto copiado al portapapeles',
        text: texto,
        showConfirmButton: false, // Oculta el botón de confirmación
        timer: 1500
    });
}

function mostrardetalle(a, b, c){  

    $('#form_liqui')[0].reset();
    $('#form_bol')[0].reset();
    //$('#combo_prev_liqui').select2("val", "0");

    $('#contenedor_emp'+ a).show();

    OcultarPrev();
    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;
    var fnac = $('#txtdate').val();
    let fech1 = $('#f_inicio_'+ a).val();
    let fech_final_1 =$('#f_final_'+ a).val();
    var cargo = $('#cargoc'+ a).val();
    let logos = $('#logo'+ a).val();
    let cbx_tipo = $('#cbx_tipo_'+ a).val();
    let cbx_base = $('#cbx_base_'+ a).val();
    let cbx_estado = $('#cbx_estado_'+ a).val();
    let cbx_condicion = $('#cbx_condicion_'+ a).val();
    let depas ;
    var nom;
    var razsocialruc ;
    let valor_busqueda ;
    let manana = moment(fnac).add(16, 'years').format('YYYY-MM-DD');
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var cant = $('#txtcant_emp').val();

    //Agregar un dia a la siguiente empresa
    if(cant > a){
        var n_emp = a + 1 ;
        var fecha_i_nueva = moment(fech_final_1).add(1, 'days').format('YYYY-MM-DD');
        $('#f_inicio_'+n_emp).val(fecha_i_nueva);
    }


    //setear en hidden el logo
    $('#logo_nombre'+ a).val(logos);
    //let ruc_empresa = $("#lst_emp_"+a).val();
    //console.log(ruc_empresa);

    switch (a) {
        case 1:
            if(fecha_inicial_1 == fech1 && fecha_fin_1 == fech_final_1 && cbx_tipo_1 == cbx_tipo && cbx_base_1 == cbx_base && cbx_estado_1 == cbx_estado && cbx_condicion_1 == cbx_condicion) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_1 = fech1;
                fecha_fin_1 = fech_final_1;
                cbx_tipo_1 = cbx_tipo;
                cbx_base_1 = cbx_base;
                cbx_estado_1 = cbx_estado;
                cbx_condicion_1 = cbx_condicion;
                valor_busqueda = 0;
            }
            break;
        case 2:
            if(fecha_inicial_2 == fech1 && fecha_fin_2 == fech_final_1 && cbx_tipo_2 == cbx_tipo && cbx_base_2 == cbx_base && cbx_estado_2 == cbx_estado && cbx_condicion_2 == cbx_condicion) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_2 = fech1;
                fecha_fin_2 = fech_final_1;
                cbx_tipo_2 = cbx_tipo;
                cbx_base_2 = cbx_base;
                cbx_estado_2 = cbx_estado;
                cbx_condicion_2 = cbx_condicion;
                valor_busqueda = 0;
            }
            break;
        case 3:
            if(fecha_inicial_3 == fech1 && fecha_fin_3 == fech_final_1 && cbx_tipo_3 == cbx_tipo && cbx_base_3 == cbx_base && cbx_estado_3 == cbx_estado && cbx_condicion_3 == cbx_condicion) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_3 = fech1;
                fecha_fin_3 = fech_final_1;
                cbx_tipo_3 = cbx_tipo;
                cbx_base_3 = cbx_base;
                cbx_estado_3 = cbx_estado;
                cbx_condicion_3 = cbx_condicion;
                valor_busqueda = 0;
            }
            break;
        case 4:
            if(fecha_inicial_4 == fech1 && fecha_fin_4 == fech_final_1 && cbx_tipo_4 == cbx_tipo && cbx_base_4 == cbx_base && cbx_estado_4 == cbx_estado && cbx_condicion_4 == cbx_condicion) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_4 = fech1;
                fecha_fin_4 = fech_final_1;
                cbx_tipo_4 = cbx_tipo;
                cbx_base_4 = cbx_base;
                cbx_estado_4 = cbx_estado;
                cbx_condicion_4 = cbx_condicion;
                valor_busqueda = 0;
            }
            break;
        case 5:
            if(fecha_inicial_5 == fech1 && fecha_fin_5 == fech_final_1 && cbx_tipo_5 == cbx_tipo && cbx_base_5 == cbx_base && cbx_estado_5 == cbx_estado && cbx_condicion_5 == cbx_condicion) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_5 = fech1;
                fecha_fin_5 = fech_final_1;
                cbx_tipo_5 = cbx_tipo;
                cbx_base_5 = cbx_base;
                cbx_estado_5 = cbx_estado;
                cbx_condicion_5 = cbx_condicion;
                valor_busqueda = 0;
            }
            break;
    }

    if( b != 0){
        razsocialruc = b;
    }else {
        razsocialruc = $('#lst_emp_'+a).val();
    }

    if( c != 0){
        depas = c;
    }else {
        depas = $('#dpto_emp_'+a).val();
    }

    if(logos == "" || logos == "no-fotos.png"){
        $('.div_logo_pdf').hide();
    }else {
        $('.div_logo_pdf').show();
    }

    if(fech1 != "" || fech_final_1 !=""){
        var fechanac = new Date(manana);
        var fechain = new Date(fech1)
        var fechafi=  new Date(fech_final_1);
        var fecha_limite = new Date('1999-06-30');
        var fechaimod = fechain.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechafmod = fechafi.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechafmodlimite = fecha_limite.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechai = new Date(fechaimod);
        var fechaf=  new Date(fechafmod);
        var fecha_final=  new Date(fechafmodlimite);

        if(fechai >= fechanac){
            if(fechai < fechaf){
                if(fechaf <= fecha_final){
                    if(valor_busqueda == 0){
                        //Ajax para obtener la lista de empresas
                        $.post("../../controller/pensioncontrolador.php?op=combo",{txtdateinicio: fech1 , txtdatefin: fech_final_1, tipo : cbx_tipo, base : cbx_base, estado : cbx_estado, condicion : cbx_condicion}, function(data){
                            if(data == ""){
                                console.log("NO EXISTE DATA");
                            }else {
                                //console.log(data);
                                $("#lst_emp_"+a).html(data);
                            }
                        });
                        

                        //Ajax para el primer valor de la lista.
                        $.post("../../controller/pensioncontrolador.php?op=pensionaleatorioempresa",{txtdateinicio: fech1 , txtdatefin: fech_final_1, tipo : cbx_tipo, base : cbx_base, estado : cbx_estado, condicion : cbx_condicion},function(data){
                            console.log("PRIMERA BUSQUEDA");
    
                            if(data == ""){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'info',
                                    title: 'No existe informacion',
                                    showConfirmButton: false,
                                    timer:1500
                                });
                            }else {
                                //console.log(data);
                                data = JSON.parse(data);
                                //$("#lst_emp_"+a).val(data[0]['ruc']).trigger('change');
                                $('#nom_emp_'+a).html(data[0]['ruc']+" - "+data[0]['empleador']);
                                $('#fech_sueldo_'+a).val(data[0]['moneda_sueldo']);
                                $('#cant_sueldo_'+a).val(data[0]['fechsueldo']);
                                $('#nom_emp_lab'+a).html(data[0]['empleador']);
                                $('#nom_emp_lab'+a).val(data[0]['empleador']);
                                //$('#tiempo_'+a).html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses '+data[0]['Dias']+' Dias');
                                $('#tiempo_header_'+a).html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses '+data[0]['Dias']+' Dias');
                                $('#anios_emp_'+a).val(data[0]['Anios']);
                                $('#meses_emp_'+a).val(data[0]['Meses']);
                                $('#dias_emp_'+a).val(data[0]['Dias']);
                                $('#ruc_emp_'+a).val(data[0]['ruc']);
                                $('#tipo_emp_'+a).val(data[0]['tipo_emp']);
                                $('#emp_tipo').val(data[0]['tipo_emp']).trigger('change');
                                $('#fech_inicio_emp').val(fech1);
                                $('#fech_final_emp').val(fech_final_1);
                                $('#cargo_emp').val(cargo);
                                $('#dpto_emp_'+a).val(data[0]['dpto']);
                                $('#rango_emp_'+a).val(data[0]['f_inic_act'] +" / "+ data[0]["f_baja_act"]);  
    
                               
                                
                                /****DATOS DE DIAS */
                                //$("#lst_emp_"+a).val(data[0]['ruc']).trigger('change');
                                nom = $('#nom_emp_lab').val();
                                var dpto1= $('#dpto_emp_'+a).val();
                                temp = $('#tiempo_header_'+a).html();
                                //sdlo= $('#fech_sueldo_'+a).html();
                                nombres= $('#txtnombre').val();
                                apelli= $('#txtapellido').val();
                                firm = $('#firmante'+a).val();
                                tmp = parseInt($('#anios_emp_'+a).val(),"10");
    
                                tot = tmp * 132;
                                rp = $('#rep_legal_'+a).val();
                                dnia = $('#dni_a_'+a).val();
                                
                                //Asignar valores a TabsEmpresa
                                $('#nombre_emp'+a).val(data[0]['empleador']);
                                $('#cargo_emp'+a).val(cargo);
                                $('#fech_inicio_emp'+a).val(fechai);
                                $('#fech_final_emp'+a).val(fechaf)
                                $('#dpto_emp'+a).val(dpto1);
                                $('#logo_nombre'+a).val(logos);
                                $('#firmante_emp'+a).val(firm)
                                $('#sueldo_emp'+a).val(data[0]['fechsueldo']);
                                $('#moneda_emp'+a).val(data[0]['moneda_rm']);
     
                                
                                //$('.emp_imp').html(nom);
                                $('.nombre_imp').html(nombres+" "+apelli);
                                //$('.cargo_imp').html(cargo);
                                $('.desde_imp').html(fechai.toLocaleDateString("es-ES", options).toUpperCase());
                                $('.hasta_imp').html(fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                                $('.lugardia').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                                $('.desde_imp_low').html(fechai.toLocaleDateString("es-ES", options));
                                $('.hasta_imp_low').html(fechaf.toLocaleDateString("es-ES", options));
                                $('.lugardia_low').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options));
                                $('.tiempo_total_imp').html(temp);
                                $('.img_logo').attr("src","../../assets/img/"+logos);
                                $('.firmante_nom').html(firm);
                                $('.departamento_imp').html(dpto1.toUpperCase());
                                $('.cargo_imp_low').html(cargo.toLowerCase());
    
                                $('.tiempo_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses '+data[0]['Dias']+' Dias');
                                $('.tiempo_liqui_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses ');
                                $('.anios_temp').html(data[0]['Anios']);
                                $('.tot_imp').html(tot);
                                $('.nom_emp_ap').html(apelli+" "+nombres);
                                $('.ruc_emp_imp').val(data[0]['ruc']);
                                $('.nom_emp_ap_rp').html(rp);
                                $('.dni_imp_rp').html(dnia);
                                $('.desde_imp_num').html(convertDateFormat(fech1));
                                $('.hasta_imp_num').html(convertDateFormat(fech_final_1));
                                $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech_final_1));
    
    
                                /* CERTIFICADO */
                                $('#emp_certificado').val(nom);
                                $('#nombre_certificado').val(nombres+" "+apelli);
                                $('#f_ini_certificado').val(convertDateFormat(fech1));
                                $('#f_baj_certificado').val(convertDateFormat(fech_final_1));
                                $('#cargo_certificado').val(cargo);
                                $('#firmante_certificado').val(firm);
                                $('#lugar_certificado').val(dpto1+", "+convertDateFormat(fech_final_1));
                                $('#sueldo_emp').val(data[0]['fechsueldo']);
                                $('#moneda_emp').val(data[0]['moneda_rm']);
    
                                /* LIQUIDACION */
                                $('#dias_liqui'+ a).val(data[0]['Dias']);
                                $('#meses_liqui'+ a).val(data[0]['Meses']);
                                $('#anios_liqui'+ a).val(data[0]['Anios']);
                                $('#ruc_emp'+ a).val(data[0]['ruc']);
                                $('#sueldo_liquidacion'+a).val(data[0]['fechsueldo']);

                                //estado y condicion
                                $('#estado_emp_' + a).val(data[0]['estado_emp']);
                                $('#condicion_emp_' + a).val(data[0]['habido_emp']);
                                if(data[0]['estado_emp'] == 'ACTIVO'){
                                    $('#estado_emp_' + a).css({'color': '#70e000','font-weight': 'bold'});
                                }else {
                                    $('#estado_emp_' + a).css({'color': '#ef233c','font-weight': 'bold'});
                                }

                                if(data[0]['habido_emp'] == 'HABIDO'){
                                    $('#condicion_emp_' + a).css({'color': '#70e000','font-weight': 'bold'});
                                }else {
                                    $('#condicion_emp_' + a).css({'color': '#ef233c','font-weight': 'bold'});
                                }
    
                                sumarfechas();
                                MostrarCertificados(data[0]['tipo_emp'], a);
                                MostrarLiquidacion(fech_final_1, data[0]['tipo_emp'], a);

                                $('#tipo_emp'+a).val(data[0]['tipo_emp']);
                                
                            }
                            
                        });
                    }else {
                        $.post("../../controller/pensioncontrolador.php?op=buscardpto",{txtdateinicio: fech1 , txtdatefin: fech_final_1, txtrazon : razsocialruc},function(data){
                            console.log("SEGUNDA BUSQUEDA");
    
                            if(data == ""){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'info',
                                    title: 'No existe informacion',
                                    showConfirmButton: false,
                                    timer:1500
                                });
                            }else {
                                //console.log(data);
                                data = JSON.parse(data);
                                //$("#lst_emp_"+a).val(data[0]['ruc']).trigger('change');
                                $('#nom_emp_'+a).html(data[0]['ruc']+" - "+data[0]['empleador']);
                                $('#fech_sueldo_'+a).val(data[0]['moneda_sueldo']);
                                $('#cant_sueldo_'+a).val(data[0]['fechsueldo']);
                                $('#nom_emp_lab'+a).html(data[0]['empleador']);
                                $('#nom_emp_lab'+a).val(data[0]['empleador']);
                                //$('#tiempo_'+a).html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses '+data[0]['Dias']+' Dias');
                                $('#tiempo_header_'+a).html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses '+data[0]['Dias']+' Dias');
                                $('#anios_emp_'+a).val(data[0]['Anios']);
                                $('#meses_emp_'+a).val(data[0]['Meses']);
                                $('#dias_emp_'+a).val(data[0]['Dias']);
                                $('#ruc_emp_'+a).val(data[0]['ruc']);
                                $('#tipo_emp_'+a).val(data[0]['tipo_emp']);
                                $('#emp_tipo').val(data[0]['tipo_emp']).trigger('change');
                                $('#fech_inicio_emp').val(fech1);
                                $('#fech_final_emp').val(fech_final_1);
                                $('#cargo_emp').val(cargo);
                                $('#dpto_emp_'+a).val(data[0]['dpto']);
                                $('#rango_emp_'+a).val(data[0]['f_inic_act'] +" / "+ data[0]["f_baja_act"]);  
    
                                
                                
                                /****DATOS DE DIAS */
                                //$("#lst_emp_"+a).val(data[0]['ruc']).trigger('change');
                                nom = $('#nom_emp_lab').val();
                                var dpto1= $('#dpto_emp_'+a).val();
                                temp = $('#tiempo_header_'+a).html();
                                //sdlo= $('#fech_sueldo_'+a).html();
                                nombres= $('#txtnombre').val();
                                apelli= $('#txtapellido').val();
                                firm = $('#firmante'+a).val();
                                tmp = parseInt($('#anios_emp_'+a).val(),"10");
    
                                tot = tmp * 132;
                                rp = $('#rep_legal_'+a).val();
                                dnia = $('#dni_a_'+a).val();
                                
                            
                                //Asignar valores a TabsEmpresa
                                $('#nombre_emp'+a).val(data[0]['empleador']);
                                $('#cargo_emp'+a).val(cargo);
                                $('#fech_inicio_emp'+a).val(fechai);
                                $('#fech_final_emp'+a).val(fechaf)
                                $('#dpto_emp'+a).val(dpto1);
                                $('#logo_nombre'+a).val(logos);
                                $('#firmante_emp'+a).val(firm)
                                
                                //$('.emp_imp').html(nom);
                                $('.nombre_imp').html(nombres+" "+apelli);
                                //$('.cargo_imp').html(cargo);
                                $('.desde_imp').html(fechai.toLocaleDateString("es-ES", options).toUpperCase());
                                $('.hasta_imp').html(fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                                $('.lugardia').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                                $('.desde_imp_low').html(fechai.toLocaleDateString("es-ES", options));
                                $('.hasta_imp_low').html(fechaf.toLocaleDateString("es-ES", options));
                                $('.lugardia_low').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options));
                                $('.tiempo_total_imp').html(temp);
                                $('.img_logo').attr("src","../../assets/img/"+logos);
                                $('.firmante_nom').html(firm);
                                $('.departamento_imp').html(dpto1.toUpperCase());
                                $('.cargo_imp_low').html(cargo.toLowerCase());
    
                                $('.tiempo_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses '+data[0]['Dias']+' Dias');
                                $('.tiempo_liqui_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses ');
                                $('.anios_temp').html(data[0]['Anios']);
                                $('.tot_imp').html(tot);
                                $('.nom_emp_ap').html(apelli+" "+nombres);
                                $('.ruc_emp_imp').val(data[0]['ruc']);
                                $('.nom_emp_ap_rp').html(rp);
                                $('.dni_imp_rp').html(dnia);
                                $('.desde_imp_num').html(convertDateFormat(fech1));
                                $('.hasta_imp_num').html(convertDateFormat(fech_final_1));
                                $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech_final_1));
    
    
                                /* CERTIFICADO */
                                $('#emp_certificado').val(nom);
                                $('#nombre_certificado').val(nombres+" "+apelli);
                                $('#f_ini_certificado').val(convertDateFormat(fech1));
                                $('#f_baj_certificado').val(convertDateFormat(fech_final_1));
                                $('#cargo_certificado').val(cargo);
                                $('#firmante_certificado').val(firm);
                                $('#lugar_certificado').val(dpto1+", "+convertDateFormat(fech_final_1));
                                $('#sueldo_emp').val(data[0]['fechsueldo']);
                                $('#moneda_emp').val(data[0]['moneda_rm']);
    
                                /* LIQUIDACION */
                                $('#dias_liqui'+ a).val(data[0]['Dias']);
                                $('#meses_liqui'+ a).val(data[0]['Meses']);
                                $('#anios_liqui'+ a).val(data[0]['Anios']);
                                $('#ruc_emp'+ a).val(data[0]['ruc']);
                                $('#sueldo_liquidacion'+a).val(data[0]['fechsueldo']);

                                //estado y condicion
                                $('#estado_emp_' + a).val(data[0]['estado_emp']);
                                $('#condicion_emp_' + a).val(data[0]['habido_emp']);

                                if(data[0]['estado_emp'] == 'ACTIVO'){
                                    $('#estado_emp_' + a).css({'color': '#70e000','font-weight': 'bold'});
                                }else {
                                    $('#estado_emp_' + a).css({'color': '#ef233c','font-weight': 'bold'});
                                }

                                if(data[0]['habido_emp'] == 'HABIDO'){
                                    $('#condicion_emp_' + a).css({'color': '#70e000','font-weight': 'bold'});
                                }else {
                                    $('#condicion_emp_' + a).css({'color': '#ef233c','font-weight': 'bold'});
                                }
    
                                sumarfechas();
                                MostrarCertificados(data[0]['tipo_emp'], a);
                                MostrarLiquidacion(fech_final_1, data[0]['tipo_emp'], a);

                                $('#tipo_emp'+a).val(data[0]['tipo_emp']);                  
                            }         
                        });
                    }
                    
                    
                    
                    //$("#contemp1").show();
                    $("#resultado_pdf").show();
                    $("#prev1").show();
                    //$("#prev_certificado_1").show();
                }else {
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'La fecha maxima a ingresar es 30/06/1999',
                        showConfirmButton: false,
                        timer:2500
                    });
                }    
            }else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'La fecha debe ser mayor o igual a la fecha inicio',
                    showConfirmButton: false,
                    timer:2500
                });
            }
        }else {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'La fecha de nacimiento debe ser mayor a la fecha de inicio ',
                showConfirmButton: false,
                timer:2500
            });
        }
    }else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca fechas de inicio y fin ',
            showConfirmButton: false,
            timer:2500
        });
    }
    $('#orcinea-tab').click();
    /*$('#firmante'+a).val(firma1).trigger('change');
    console.log(firma1);*/

}

function MostrarCertificados(valor, emp){

    var div_tipo = "";
    switch (valor) {
        case 'P':
            for ( let i = 1; i <= 8; i++){
                //console.log(i);
                div_tipo+=  '<option value="p'+i+'">Certificado - P'+i+'</option>';
            }
            break;
        case 'M':
            for ( let i = 1; i <= 5; i++){
                //console.log(i);
                div_tipo+=  '<option value="m'+i+'">Certificado - M'+i+'</option>';
            }
            break;
        case 'G':
            for ( let i = 1; i <= 12; i++){
                //console.log(i);
                div_tipo+=  '<option value="g'+i+'">Certificado - G'+i+'</option>';
            }
        case 'V':
            for ( let i = 1; i <= 8; i++){
                //console.log(i);
                div_tipo+=  '<option value="p'+i+'">Certificado - P'+i+'</option>';
            }
            for ( let i = 1; i <= 5; i++){
                //console.log(i);
                div_tipo+=  '<option value="m'+i+'">Certificado - M'+i+'</option>';
            }
            for ( let i = 1; i <= 12; i++){
                //console.log(i);
                div_tipo+=  '<option value="g'+i+'">Certificado - G'+i+'</option>';
            }
            break;
    
    }

    $("#select_certificado"+emp).html(div_tipo);
}
function MostrarLiquidacion(valor, tipo, e){
    let fecha = new Date(valor);
    let anio = fecha.getFullYear();

    switch (tipo) {
        case 'P':
            if(anio >= 1960 && anio <=1970){
                $('#bonif_extra' + e).attr("disabled", "disabled");
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", false);
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }else if(anio >= 1971 && anio <=1980){
                $('#bonif_extra' + e).attr("disabled", false);
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", false);
                $('#bonif_dia' + e).attr("disabled", false);
                $('#bonif' + e).attr("disabled", false);
            }else if(anio >= 1981 && anio <=1999){
                $('#bonif_extra' + e).attr("disabled", false);
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", "disabled");
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }else {
                $('#bonif_extra' + e).attr("disabled","disabled");
                $('#bonif_meta' + e).attr("disabled", "disabled");
                $('#bonif_gra' + e).attr("disabled", "disabled");
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }
            break;
        case 'M':
            if(anio >= 1960 && anio <=1970){
                $('#bonif_extra' + e).attr("disabled", "disabled");
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", false);
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }else if(anio >= 1971 && anio <=1980){
                $('#bonif_extra' + e).attr("disabled", false);
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", false);
                $('#bonif_dias' + e).attr("disabled", false);
                $('#bonif' + e).attr("disabled", false);
            }else if(anio >= 1981 && anio <=1999){
                $('#bonif_extra' + e).attr("disabled", false);
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", "disabled");
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }else {
                $('#bonif_extra' + e).attr("disabled",false);
                $('#bonif_meta' + e).attr("disabled", "disabled");
                $('#bonif_gra' + e).attr("disabled", "disabled");
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }
            break;
        case 'G':
            if(anio >= 1960 && anio <=1970){
                $('#bonif_extra' + e).attr("disabled", "disabled");
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", false);
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }else if(anio >= 1971 && anio <=1980){
                $('#bonif_extra' + e).attr("disabled", false);
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", false);
                $('#bonif_dias' + e).attr("disabled", false);
                $('#bonif' + e).attr("disabled", false);
            }else if(anio >= 1981 && anio <=1999){
                $('#bonif_extra' + e).attr("disabled", false);
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", "disabled");
                $('#bonif_dias' + e).attr("disabled", "disabled");
                $('#bonif' + e).attr("disabled", false);
            }else {
                $('#bonif_extra' + e).attr("disabled",false);
                $('#bonif_meta' + e).attr("disabled", false);
                $('#bonif_gra' + e).attr("disabled", false);
                $('#bonif_dias' + e).attr("disabled", false);
                $('#bonif' + e).attr("disabled", false);
            }
            break;
        
    }
}

function ListarFirmante(a){
    let estado = $('select[name="lst_emp_'+a+'"] option:selected').text();
    let ruc = $("#lst_emp_"+a).val();

    //ruc_empresa = $("#lst_emp_"+a).val();
    $('#nom_emp_'+a).html(ruc+" - "+estado);
    $("#firmante"+a).val("");

    $.post("../../controller/empresacontrolador.php?op=combovigencia",{numero : ruc}, function(data){
        if(data != ""){
            data = JSON.parse(data);
            //console.log(data);
            $('#rango_emp_'+a).val(data.f_inic_act +" / "+ data.f_baja_act);   
        }
    }); 


    if(alerta_uso == 0 ){
         // Realizar la solicitud AJAX POST
        $.ajax({
            type: 'POST',
            url: '../../controller/empresacontrolador.php?op=mostrar_empresa_ruc',
            data: { ruc : ruc},
            dataType : 'JSON',
            success: function(response){
                // Manejar la respuesta del servidor
                //console.log(response);
                if(response.busqueda == 1) {
                    var fechaMoment = moment(response.fecha_busqueda);
                    var fechaNueva = fechaMoment.add(response.cant_mes, 'months');
                    var fechaActualServidor = moment();
                    var diferenciaEnDias = fechaNueva.diff(fechaActualServidor, 'days');

                    $('#errorLabel_' + a).html('La empresa ya ha sido utilizada - Faltan ' + diferenciaEnDias + 'días');
                    $('#errorLabel_' + a).show();
                }else {
                    $('#errorLabel_' + a).hide();
                }
            },
            error: function(xhr, status, error){
                // Manejar errores de la solicitud
                console.error('Error en la solicitud:', error);
            }
        });
    }
}

function ListarLogo(a){
    let estado = $("#logo"+a).val();
    if(estado == 'no-fotos.png'){
        $("#logo_img_"+a).attr("src",""); 
        $('#div_logo_'+a).hide();
    }else {
        //$("#logo_img_"+a).attr("src","../../assets/img/"+estado); 
        //$('#div_logo_'+a).show();
    }
    
}

function GuardarLista(){
    //ASignar una valor para validar si se muestra la alerta
    $('#valorguardar').val("1");

    let tipo_lista = $("#tipo_lista").val();
    let id_lista = $("#lista_id").val();
    let af_id = $("#af_id").val();
    let num_doc = $("#num_doc").val();
    let cantidad = $("#txtcant_emp").val();
    let fecha_nac = $("#txtdate").val()

    let fech_inicio1 = $("#f_inicio_1").val();0
    let fech_final1 = $("#f_final_1").val();
    let tipo1 = $('#cbx_tipo_1').val();
    let base1 = $('#cbx_base_1').val();
    let estado1 = $('#cbx_estado_1').val();
    let condicion1 = $('#cbx_condicion_1').val();
    let cargo1 = $("#cargoc1").val();
    let logo1 = $("#logo1").val();
    let ruc1 = $("#lst_emp_1").val();
    let firmante1 = $("#firmante1").val();

    let fech_inicio2 = $("#f_inicio_2").val();
    let fech_final2 = $("#f_final_2").val();
    let tipo2 = $('#cbx_tipo_2').val();
    let base2 = $('#cbx_base_2').val();
    let estado2 = $('#cbx_estado_2').val();
    let condicion2 = $('#cbx_condicion_2').val();
    let cargo2 = $("#cargoc2").val();
    let logo2 = $("#logo2").val();
    let ruc2 = $("#lst_emp_2").val();
    let firmante2 = $("#firmante2").val();

    let fech_inicio3 = $("#f_inicio_3").val();
    let fech_final3 = $("#f_final_3").val();
    let tipo3 = $('#cbx_tipo_3').val();
    let base3 = $('#cbx_base_3').val();
    let estado3 = $('#cbx_estado_3').val();
    let condicion3 = $('#cbx_condicion_3').val();
    let cargo3 = $("#cargoc3").val();
    let logo3 = $("#logo3").val();
    let ruc3 = $("#lst_emp_3").val();
    let firmante3 = $("#firmante3").val();

    let fech_inicio4 = $("#f_inicio_4").val();
    let fech_final4 = $("#f_final_4").val();
    let tipo4 = $('#cbx_tipo_4').val();
    let base4 = $('#cbx_base_4').val();
    let estado4 = $('#cbx_estado_4').val();
    let condicion4 = $('#cbx_condicion_4').val();
    let cargo4 = $("#cargoc4").val();
    let logo4 = $("#logo4").val();
    let ruc4 = $("#lst_emp_4").val();
    let firmante4 = $("#firmante4").val();

    let fech_inicio5 = $("#f_inicio_5").val();
    let fech_final5 = $("#f_final_5").val();
    let tipo5 = $('#cbx_tipo_5').val();
    let base5 = $('#cbx_base_5').val();
    let estado5 = $('#cbx_estado_5').val();
    let condicion5 = $('#cbx_condicion_5').val();
    let cargo5 = $("#cargoc5").val();
    let logo5 = $("#logo5").val();
    let ruc5 = $("#lst_emp_5").val();
    let firmante5 = $("#firmante5").val();

    /*JSON datos Empresa  */
    var empresas_data = {
        "empresas": 
          {
            "empresa1": 
            {
                "Certificado": 
                {
                    "tipo_certificado": $('#select_certificado1').val() || null,
                    "fecha_emision" :   $('#fecha_certificado1').val() || null
                },
                "Liquidacion": 
                {
                    "sueldo" :          $('#sueldo_liquidacion1').val() || null,
                    "adelanto" :        $('#adelanto1').val() || null,
                    "vacaciones" :      $('#vacaciones1').val() || null,
                    "gratificaciones" : $('#gratificaciones1').val() || null,
                    "reintegro" :       $('#reintegro1').val() || null,
                    "incentivo" :       $('#incentivo1').val() || null,
                    "bonificacion" :    $('#bonif1').val() || null,
                    "bonif_extra" :     $('#bonif_extra1').val() || null,
                    "bonif_grac" :      $('#bonif_gra1').val() || null,
                    "bonif_meta" :      $('#bonif_meta1').val() || null,
                    "bonif_festivo" :   $('#bonif_dias1').val() || null,
                    "tipo" :            $('#combo_prev_cuerpo1').val() || null,
                    "motivo" :          $('#combo_prev_liqui1').val() || null,
                    "fecha_emision" :   $('#fecha_liquidacion1').val() || null
                },
                "Boleta" :
                {
                    "anio_boleta" :     $('#select_anio_boletas1').val() || null,
                    "mes_boleta" :      $('#select_mes_boletas1').val() || null,
                    "sueldo" :          $('#sueldo_boleta1').val() || null,
                    "rem_vaca":         $('#rm_vacacional_boleta1').val() || null,
                    "reintegro":        $('#reintegro_boleta1').val() || null,
                    "h_extras":         $('#horaex_boleta1').val() || null,
                    "bonif":            $('#boni_boleta1').val() || null,
                    "bonif_alimentos":  $('#bonificacion_alimentos_boleta1').val() || null,
                    "bonif_metas" :     $('#bonificacion_metas_boleta1').val() || null,
                    "bonif_logros":     $('#bonificacion_logros_boleta1').val() || null,
                    "bonif_dias" :      $('#bonificacion_festivos_boleta1').val() || null,
                    "pasajes" :         $('#bonificacion_pasajes_boleta1').val() || null,
                    "uniforme" :        $('#bonificacion_uniforme_boleta1').val() || null,
                    "gratificacion" :   $('#bonificacion_gratificacion_boleta1').val() || null,
                    "otros":            $('#otros_boleta1').val() || null,
                    "modelo_boleta":    $('#combo_prev_boleta1').val() || null
                },
                "Renuncia" :
                {
                    "tipo_renuncia":    $('#select_renuncia1').val() || null,
                    "fecha_emision" :   $('#fecha_renuncia1').val() || null
                }
            },
            "empresa2": 
            {
                "Certificado": 
                {
                    "tipo_certificado": $('#select_certificado2').val() || null,
                    "fecha_emision" :   $('#fecha_certificado2').val() || null
                },
                "Liquidacion": 
                {
                    "sueldo" :          $('#sueldo_liquidacion2').val() || null,
                    "adelanto" :        $('#adelanto2').val() || null,
                    "vacaciones" :      $('#vacaciones2').val() || null,
                    "gratificaciones" : $('#gratificaciones2').val() || null,
                    "reintegro" :       $('#reintegro2').val() || null,
                    "incentivo" :       $('#incentivo2').val() || null,
                    "bonificacion" :    $('#bonif2').val() || null,
                    "bonif_extra" :     $('#bonif_extra2').val() || null,
                    "bonif_grac" :      $('#bonif_gra2').val() || null,
                    "bonif_meta" :      $('#bonif_meta2').val() || null,
                    "bonif_festivo" :   $('#bonif_dias2').val() || null,
                    "tipo" :            $('#combo_prev_cuerpo2').val() || null,
                    "motivo" :          $('#combo_prev_liqui2').val() || null,
                    "fecha_emision" :   $('#fecha_liquidacion2').val() || null
                },
                "Boleta" :
                {
                    "anio_boleta" :     $('#select_anio_boletas2').val() || null,
                    "mes_boleta" :      $('#select_mes_boletas2').val() || null,
                    "sueldo" :          $('#sueldo_boleta2').val() || null,
                    "rem_vaca":         $('#rm_vacacional_boleta2').val() || null,
                    "reintegro":        $('#reintegro_boleta2').val() || null,
                    "h_extras":         $('#horaex_boleta2').val() || null,
                    "bonif":            $('#boni_boleta2').val() || null,
                    "bonif_alimentos":  $('#bonificacion_alimentos_boleta2').val() || null,
                    "bonif_metas" :     $('#bonificacion_metas_boleta2').val() || null,
                    "bonif_logros":     $('#bonificacion_logros_boleta2').val() || null,
                    "bonif_dias" :      $('#bonificacion_festivos_boleta2').val() || null,
                    "pasajes" :         $('#bonificacion_pasajes_boleta2').val() || null,
                    "uniforme" :        $('#bonificacion_uniforme_boleta2').val() || null,
                    "gratificacion" :   $('#bonificacion_gratificacion_boleta2').val() || null,
                    "otros":            $('#otros_boleta2').val() || null,
                    "modelo_boleta":    $('#combo_prev_boleta2').val() || null
                },
                "Renuncia" :
                {
                    "tipo_renuncia":    $('#select_renuncia2').val() || null,
                    "fecha_emision" :   $('#fecha_renuncia2').val() || null
                }
            },
            "empresa3": 
            {
                "Certificado": 
                {
                    "tipo_certificado": $('#select_certificado3').val() || null,
                    "fecha_emision" :   $('#fecha_certificado3').val() || null
                },
                "Liquidacion": 
                {
                    "sueldo" :          $('#sueldo_liquidacion3').val() || null,
                    "adelanto" :        $('#adelanto3').val() || null,
                    "vacaciones" :      $('#vacaciones3').val() || null,
                    "gratificaciones" : $('#gratificaciones3').val() || null,
                    "reintegro" :       $('#reintegro3').val() || null ,
                    "incentivo" :       $('#incentivo3').val() || null,
                    "bonificacion" :    $('#bonif3').val() || null,
                    "bonif_extra" :     $('#bonif_extra3').val() || null,
                    "bonif_grac" :      $('#bonif_gra3').val() || null,
                    "bonif_meta" :      $('#bonif_meta3').val() || null,
                    "bonif_festivo" :   $('#bonif_dias3').val() || null,
                    "tipo" :            $('#combo_prev_cuerpo3').val() || null,
                    "motivo" :          $('#combo_prev_liqui3').val() || null,
                    "fecha_emision" :   $('#fecha_liquidacion3').val() || null
                },
                "Boleta" :
                {
                    "anio_boleta" :     $('#select_anio_boletas3').val() || null,
                    "mes_boleta" :      $('#select_mes_boletas3').val() || null,
                    "sueldo" :          $('#sueldo_boleta3').val() || null,
                    "rem_vaca":         $('#rm_vacacional_boleta3').val() || null,
                    "reintegro":        $('#reintegro_boleta3').val() || null,
                    "h_extras":         $('#horaex_boleta3').val() || null,
                    "bonif":            $('#boni_boleta3').val() || null,
                    "bonif_alimentos":  $('#bonificacion_alimentos_boleta3').val() || null,
                    "bonif_metas" :     $('#bonificacion_metas_boleta3').val() || null,
                    "bonif_logros":     $('#bonificacion_logros_boleta3').val() || null,
                    "bonif_dias" :      $('#bonificacion_festivos_boleta3').val() || null,
                    "pasajes" :         $('#bonificacion_pasajes_boleta3').val() || null,
                    "uniforme" :        $('#bonificacion_uniforme_boleta3').val() || null,
                    "gratificacion" :   $('#bonificacion_gratificacion_boleta3').val() || null,
                    "otros":            $('#otros_boleta3').val() || null,
                    "modelo_boleta":    $('#combo_prev_boleta3').val() || null
                },
                "Renuncia" :
                {
                    "tipo_renuncia":    $('#select_renuncia3').val() || null,
                    "fecha_emision" :   $('#fecha_renuncia3').val() || null
                }
            },
            "empresa4": 
            {
                "Certificado": 
                {
                    "tipo_certificado": $('#select_certificado4').val() || null,
                    "fecha_emision" :   $('#fecha_certificado4').val() || null
                },
                "Liquidacion": 
                {
                    "sueldo" :          $('#sueldo_liquidacion4').val() || null,
                    "adelanto" :        $('#adelanto4').val() || null,
                    "vacaciones" :      $('#vacaciones4').val() || null,
                    "gratificaciones" : $('#gratificaciones4').val() || null,
                    "reintegro" :       $('#reintegro4').val() || null,
                    "incentivo" :       $('#incentivo4').val() || null,
                    "bonificacion" :    $('#bonif4').val() || null,
                    "bonif_extra" :     $('#bonif_extra4').val() || null,
                    "bonif_grac" :      $('#bonif_gra4').val() || null,
                    "bonif_meta" :      $('#bonif_meta4').val() || null,
                    "bonif_festivo" :   $('#bonif_dias4').val() || null,
                    "tipo" :            $('#combo_prev_cuerpo4').val() || null,
                    "motivo" :          $('#combo_prev_liqui4').val() || null,
                    "fecha_emision" :   $('#fecha_liquidacion4').val() || null
                },
                "Boleta" :
                {
                    "anio_boleta" :     $('#select_anio_boletas4').val() || null,
                    "mes_boleta" :      $('#select_mes_boletas4').val() || null,
                    "sueldo" :          $('#sueldo_boleta4').val() || null,
                    "rem_vaca":         $('#rm_vacacional_boleta4').val() || null,
                    "reintegro":        $('#reintegro_boleta4').val() || null,
                    "h_extras":         $('#horaex_boleta4').val() || null,
                    "bonif":            $('#boni_boleta4').val() || null,
                    "bonif_alimentos":  $('#bonificacion_alimentos_boleta4').val() || null,
                    "bonif_metas" :     $('#bonificacion_metas_boleta4').val() || null,
                    "bonif_logros":     $('#bonificacion_logros_boleta4').val() || null,
                    "bonif_dias" :      $('#bonificacion_festivos_boleta4').val() || null,
                    "pasajes" :         $('#bonificacion_pasajes_boleta4').val() || null,
                    "uniforme" :        $('#bonificacion_uniforme_boleta4').val() || null,
                    "gratificacion" :   $('#bonificacion_gratificacion_boleta4').val() || null,
                    "otros":            $('#otros_boleta4').val() || null,
                    "modelo_boleta":    $('#combo_prev_boleta4').val() || null
                },
                "Renuncia" :
                {
                    "tipo_renuncia":    $('#select_renuncia4').val() || null,
                    "fecha_emision" :   $('#fecha_renuncia4').val() || null
                }
            },
            "empresa5": 
            {
                "Certificado": 
                {
                    "tipo_certificado": $('#select_certificado5').val() || null,
                    "fecha_emision" :   $('#fecha_certificado5').val() || null
                },
                "Liquidacion": 
                {
                    "sueldo" :          $('#sueldo_liquidacion5').val() || null,
                    "adelanto" :        $('#adelanto5').val() || null,
                    "vacaciones" :      $('#vacaciones5').val() || null,
                    "gratificaciones" : $('#gratificaciones5').val() || null,
                    "reintegro" :       $('#reintegro5').val() || null,
                    "incentivo" :       $('#incentivo5').val() || null,
                    "bonificacion" :    $('#bonif5').val() || null,
                    "bonif_extra" :     $('#bonif_extra5').val() || null,
                    "bonif_grac" :      $('#bonif_gra5').val() || null,
                    "bonif_meta" :      $('#bonif_meta5').val() || null,
                    "bonif_festivo" :   $('#bonif_dias5').val() || null,
                    "tipo" :            $('#combo_prev_cuerpo5').val() || null,
                    "motivo" :          $('#combo_prev_liqui5').val() || null,
                    "fecha_emision" :   $('#fecha_liquidacion5').val() || null
                },
                "Boleta" :
                {
                    "anio_boleta" :     $('#select_anio_boletas5').val() || null,
                    "mes_boleta" :      $('#select_mes_boletas5').val() || null,
                    "sueldo" :          $('#sueldo_boleta5').val() || null,
                    "rem_vaca":         $('#rm_vacacional_boleta5').val() || null,
                    "reintegro":        $('#reintegro_boleta5').val() || null,
                    "h_extras":         $('#horaex_boleta5').val() || null,
                    "bonif":            $('#boni_boleta5').val() || null,
                    "bonif_alimentos":  $('#bonificacion_alimentos_boleta5').val() || null,
                    "bonif_metas" :     $('#bonificacion_metas_boleta5').val() || null,
                    "bonif_logros":     $('#bonificacion_logros_boleta5').val() || null,
                    "bonif_dias" :      $('#bonificacion_festivos_boleta5').val() || null,
                    "pasajes" :         $('#bonificacion_pasajes_boleta5').val() || null,
                    "uniforme" :        $('#bonificacion_uniforme_boleta5').val() || null,
                    "gratificacion" :   $('#bonificacion_gratificacion_boleta5').val() || null,
                    "otros":            $('#otros_boleta5').val() || null,
                    "modelo_boleta":    $('#combo_prev_boleta5').val() || null
                },
                "Renuncia" :
                {
                    "tipo_renuncia":    $('#select_renuncia5').val() || null,
                    "fecha_emision" :   $('#fecha_renuncia5').val() || null
                }
            }
          }
      };

    $.post("../../controller/listacontrolador.php?op=guardaryeditar",{
            af_id : af_id,
            documento : num_doc,
            txtcant_emp : cantidad,
            txtdate : fecha_nac,
            f_inicio_1 : fech_inicio1,
            f_final_1 : fech_final1,
            tipo_1 : tipo1,
            base_1 : base1,
            estado_1 : estado1,
            condicion_1 : condicion1,
            ruc_emp1 : ruc1,
            cargoc1 : cargo1,
            firmante1 : firmante1,
            logo1 : logo1,
            f_inicio_2 : fech_inicio2,
            f_final_2 : fech_final2,
            tipo_2 : tipo2,
            base_2 : base2,
            estado_2 : estado2,
            condicion_2 : condicion2,
            ruc_emp2 : ruc2,
            cargoc2 : cargo2,
            firmante2 : firmante2,
            logo2 : logo2,
            f_inicio_3 : fech_inicio3,
            f_final_3 : fech_final3,
            tipo_3 : tipo3,
            base_3 : base3,
            estado_3 : estado3,
            condicion_3 : condicion3,
            ruc_emp3 : ruc3,
            cargoc3 : cargo3,
            firmante3 : firmante3,
            logo3 : logo3,
            f_inicio_4 : fech_inicio4,
            f_final_4 : fech_final4,
            tipo_4 : tipo4,
            base_4 : base4,
            estado_4 : estado4,
            condicion_4 : condicion4,
            ruc_emp4 : ruc4,
            cargoc4 : cargo4,
            firmante4 : firmante4,
            logo4 : logo4,
            f_inicio_5 : fech_inicio5,
            f_final_5 : fech_final5,
            tipo_5 : tipo5,
            base_5 : base5,
            estado_5 : estado5,
            condicion_5 : condicion5,
            ruc_emp5 : ruc5,
            cargoc5 : cargo5,
            firmante5 : firmante5,
            logo5 : logo5,
            lista : id_lista,
            tipo : tipo_lista,
            datos_der : JSON.stringify(empresas_data)  
        }, function(data){
            //console.log("GUARDO");
            if(data != ""){

                //Se agrega el Id a input hidden.
                $('#lista_id').val(data);

                swal.fire(
                    'Registro!',
                    'Se registro correctamente.',
                    'success'
                );  
            }
    });
}
 
function sumarfechas () {
    numero = $('#txtcant_emp').val();
    //console.log("El Numero de Empresas es: "+ numero);

    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;

    for(i = 1 ; i<=numero ; i++){
        suma_anios += parseInt($('#anios_emp_'+i).val(), '10');
        suma_meses += parseInt($('#meses_emp_'+i).val(), '10');
        suma_dias += parseInt($('#dias_emp_'+i).val(), '10');
    }



    if(suma_dias >= 30){

        let mes = Math.trunc(suma_dias / 30);
        suma_dias = suma_dias % 30;
        suma_meses = suma_meses + mes;
    }

    if(suma_meses >=12){

        let anio = Math.trunc(suma_meses / 12);
        suma_meses = suma_meses % 12;
        suma_anios = suma_anios + anio;
    }

    mensaje = suma_anios+ ' Años '+suma_meses+' Meses '+ suma_dias+' Dias';
    $("#tiempo_servicio").html(mensaje);
}

function Sumarmonto(mes) {
    let num =  0;
    for( i = 1 ; i <= 6 ; i++ ){
        num += Number($('#'+mes+'_'+i).val()); 
    }

    $('#'+mes+'_total').val(num);
    //console.log("El mes es: " + num);
}

function MostrarBoleta(e){

    
    let anio = $('#select_anio_boletas'+ e).val();
    let mes = $('#select_mes_boletas'+ e).val();
    let sueldo = Number($('#'+mes+'_1'+ e).val());
    let rm = Number($('#'+mes+'_2'+ e).val());
    let reintegro = Number($('#'+mes+'_3'+ e).val());
    let hextras = Number($('#'+mes+'_4'+ e).val());
    let bonofi = Number($('#'+mes+'_5'+ e).val());
    let otros = Number($('#'+mes+'_6'+ e).val());
    let total = Number($('#'+mes+'_total'+ e).val());

    if(anio == '1992' || anio == '1991' && mes== 'dic' ) {
        $('#sueldo_boleta'+ e).val(sueldo);
        $('#rm_vacacional_boleta'+ e).val(rm);
        $('#reintegro_boleta'+ e).val(reintegro);
        $('#horaex_boleta'+ e).val(hextras);
        $('#boni_boleta'+ e).val(bonofi);
        $('#otros_boleta'+ e).val(otros);
        $('#total_monto_boleta'+ e).val(total);
        SumarMeses();
    }else {
        $('#sueldo_boleta'+ e).val("");
        $('#rm_vacacional_boleta'+ e).val("");
        $('#reintegro_boleta'+ e).val("");
        $('#horaex_boleta'+ e).val("");
        $('#boni_boleta'+ e).val("");
        $('#otros_boleta'+ e).val("");
        $('#total_monto_boleta'+ e).val("");
        $('#sueldo_bolet_infoa'+ e).val("");
        $('#rm_vacacional_boleta_info'+ e).val("");
        $('#reintegro_boleta_info'+e).val("");
        $('#horaex_boleta_info'+ e).val("");
        $('#boni_boleta_info'+ e).val("");
        $('#otros_boleta_info'+ e).val("");
        
    }

    //AQUII
    let mes_completo = "";
    let estado_dsc = $("#select_mes_boletas"+ e).val();
    switch (estado_dsc) {
        case 'all':
            mes_completo = "01";
            break;
        case 'ene':
            mes_completo = "01";
            break;
        case 'feb':
            mes_completo = "02";
            break;
        case 'mar':
            mes_completo = "03";
            break; 
        case 'abr':
            mes_completo = "04";
            break; 
        case 'may':
            mes_completo = "05";
            break; 
        case 'jun':
            mes_completo = "06";
            break; 
        case 'jul':
            mes_completo = "07";
            break; 
        case 'ago':
            mes_completo = "08";
            break; 
        case 'sep':
            mes_completo = "09";
            break; 
        case 'oct':
            mes_completo = "10";
            break; 
        case 'nov':
            mes_completo = "11";
            break; 
        case 'dic':
            mes_completo = "12";
            break;
    }
    
    let estado_anio_dsc = $("#select_anio_boletas"+ e).val();
    let fecha_consulta = estado_anio_dsc+'-'+mes_completo+'-01';
    //console.log(fecha_consulta);
    //CONSULTA DE MES 
    $.post("../../controller/pensioncontrolador.php?op=buscar_mes",{fecha : fecha_consulta}, function(data){
        //console.log(data);
        if(data != ""){
            data = JSON.parse(data);
            //console.log(data);
            $('#at_ss'+ e).val(data.at_ss);
            $('#at_fonavi'+ e).val(data.at_pro_desocup);
            $('#at_pension'+ e).val(data.at_fondo_juvi);
            $('#ap_ss'+ e).val(data.ap_ss);
            $('#ap_fonavi'+ e).val(data.ap_fonavi);
            $('#ap_pension'+ e).val(data.ap_fondo_juvi);
            $('#sueldo_boleta'+ e).val(data.sueldo_minimo);
            $('#sueldo_boleta_info').val(data.sueldo_minimo);
            $('#dsc_at_ss').html(data.at_ss +'%');
            $('#dsc_at_fonavi').html(data.at_pro_desocup+'%');
            $('#dsc_at_pension').html(data.at_fondo_juvi+'%');
            $('#dsc_ap_ss').html(data.ap_ss+'%');
            $('#dsc_ap_fonavi').html(data.ap_fonavi+'%');
            $('#dsc_ap_pension').html(data.ap_fondo_juvi+'%');
        }
    });
    
}

function SumarMeses(){
    Sumarmonto('ene');
    Sumarmonto('feb');
    Sumarmonto('mar');
    Sumarmonto('abr');
    Sumarmonto('may');
    Sumarmonto('jun');
    Sumarmonto('jul');
    Sumarmonto('ago');
    Sumarmonto('sep');
    Sumarmonto('oct');
    Sumarmonto('nov');
    Sumarmonto('dic');
}

function OcultarPrev(){
    $('.prev_certificado').hide();
    $('.prev_liquidacion').hide();
    $('.prev_boleta').hide();
    $('.prev_modelo_liqui').hide();
    $('.prev_renuncia').hide();
}

function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}

function Export2Doc(){
    let tipoprev = $('#select_certificado').val();
    let nombre = $('#txtnombre').val() ;
    let apellido = $('#txtapellido').val() ;
    let filename = nombre +' '+ apellido + 'CERTIFICADO'; 
    //let element = 'contenido_certificado_'+tipoprev;
    let element = 'contenido_liqui_1';
    
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Documento</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    //filename = filename?filename+'.doc':'document.doc';
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}

function Export2DocBoleta(){
    let tipoprev = $('#combo_prev_boleta').val();
    let nombre = $('#txtnombre').val() ;
    let apellido = $('#txtapellido').val() ;
    let filename = nombre +' '+ apellido + 'BOLETA'; 
    let element = 'contenido_boleta_'+tipoprev;
    
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Documento</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    //filename = filename?filename+'.doc':'document.doc';
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}

function imprimir_word(e){


    var tipo = $('#tipo_emp').val();
    let tipoprev = $('#select_certificado' + e).val();
    let nombreruta = 'certificado_'+tipoprev;
    var nombre = $('#txtnombre').val();
    var apellido = $('#txtapellido').val();
    var nombre_emp = $('#nom_emp_lab' + e).html();
    var nombre_com = nombre + ' ' + apellido;
    var num_doc = $('#num_doc').val();
    var nom_carpeta = "PENSIONES-"+ e +"-"+ num_doc;
    var fecha_inicio = $('.desde_imp').html();
    var fecha_hasta = $('.hasta_imp').html();
    var fecha_inicio_num = $('.desde_imp_num').html();
    var fecha_hasta_num = $('.hasta_imp_num').html();
    var lugar_dia = $('.lugardia').html();
    var cargo = $('#cargo_emp'+ e).val();
    var logo = $('#logo_nombre'+ e).val();
    var firmante = $('.firmante_nom').html();
    var link = '../../controller/docs/certificado_'+tipoprev+'.php';
    var ruc = $('#ruc_emp'+ e).val();


    $.ajax({
        type: "POST",
        //url: "../../controller/docs/certificado_m3.php",
        //url: "../../controller/docs/certificadosword.php",
        //url: "../../controller/docs/"+nombreruta+".php",
        //url: "../../controller/docs/prueba_2.php",
        url: link,
        data : {
            empresa : nombre_emp,
            afiliado: nombre_com,
            nombre_carpeta : nom_carpeta,
            fecha_inicio : fecha_inicio,
            fecha_final: fecha_hasta,
            fecha_inicio_num : fecha_inicio_num,
            fecha_final_num : fecha_hasta_num,
            fecha_footer : lugar_dia,
            cargo : cargo,
            tipo : tipo,
            logo : logo,
            firmante : firmante,
            ruc: ruc
        },
        success: function(response){

            //console.log(response);
            resp = JSON.parse(response);
            if(resp.estado == 1){
                    swal.fire(
                        'Documento generado exitosamente',
                        '',
                        'success'
                    );
            }
            // URL del archivo que deseas descargar
            var url = '../../files/'+nom_carpeta+'/'+resp.archivo+'.docx';

            // Crear un elemento <a> oculto
            var link = document.createElement('a');
            link.href = url;
            link.download = resp.archivo+'-'+num_doc; // Nombre del archivo para descargar
            link.style.display = 'none';

            // Añadir el elemento <a> al DOM
            document.body.appendChild(link);

            // Simular un clic en el enlace para iniciar la descarga
            link.click();

            // Eliminar el elemento <a> del DOM después de la descarga
            document.body.removeChild(link);
        }
    });
}

function imprimir_liquidacion_word(e){

    var nombreruta;          
    var cuerpo              = $('#combo_prev_cuerpo'+ e).val();
    var nombre              = $('#txtnombre').val();
    var apellido            = $('#txtapellido').val();
    var nombre_emp          = $('#nom_emp_lab'+ e).html();
    var nombre_com          = nombre + ' ' + apellido;
    var num_doc             = $('#num_doc').val();
    var nom_carpeta         = "PENSIONES-"+ num_doc;
    var fecha_inicio        = $('.desde_imp').html();
    var fecha_hasta         = $('.hasta_imp').html();
    var fecha_inicio_num    = $('.desde_imp_num').html();
    var fecha_hasta_num     = $('.hasta_imp_num').html();
    var lugar_dia           = $('.lugardia').html();
    var cargo               = $('#cargo_emp'+ e).val();
    var sueldo              = $('#sueldo_emp'+ e).val();
    var moneda              = $('#moneda_emp'+ e).val();
    var motivo              = $('select[name="combo_prev_liqui'+ e +'"] option:selected').text();
    //Agregar los bonos 
    var bonif_ext           = $('#bonif_extra'+ e).val();
    var bonif_gra           = $('#bonif_gra'+ e).val();
    var bonif_met           = $('#bonif_meta'+ e).val();
    var bonif_dias          = $('#bonif_dias'+ e).val();
    //Agregar año para la condicional 
    var fecha_final         = $("#fech_final_emp"+ e).val();
    var fecha               = new Date(fecha_final);
    var anio                = fecha.getFullYear();
    var ruc                 = $('#ruc_emp'+ e).val();

    //Elegir el doc de liquidacion por año
    if(anio >= 1960 && anio <= 1970){
        nombreruta = 'liquidacion_1.php'
    }
    if(anio >= 1971 && anio <= 1985){
        nombreruta = 'liquidacion_2.php'
    }
    if(anio >= 1986 && anio <= 1991){
        nombreruta = 'liquidacion_3.php'
    }
    if(anio >= 1992 && anio <= 1999){
        nombreruta = 'liquidacion_4.php'
    }

    // Serializa el formulario
    var formData = new FormData($('#form_liqui'+ e)[0]);

    // Agrega los datos adicionales al objeto FormData
    formData.append('empresa', nombre_emp); 
    formData.append('afiliado', nombre_com);
    formData.append('nombre_carpeta', nom_carpeta); 
    formData.append('fecha_inicio', fecha_inicio); 
    formData.append('fecha_final', fecha_hasta); 
    formData.append('fecha_inicio_num', fecha_inicio_num);
    formData.append('fecha_final_num', fecha_hasta_num); 
    formData.append('fecha_footer', lugar_dia);   
    formData.append('cargo', cargo);  
    formData.append('sueldo', sueldo);   
    formData.append('moneda', moneda);  
    formData.append('motivo', motivo); 
    formData.append('bonif_ext', bonif_ext);  
    formData.append('bonif_gra', bonif_gra);   
    formData.append('bonif_met', bonif_met);  
    formData.append('bonif_dias', bonif_dias);
    formData.append('anio_final', anio);  
    formData.append('cuerpo', cuerpo);  
    formData.append('ruc', ruc); 

    $.ajax({
        type: "POST",
        //url: "../../controller/docs/certificadosword.php",
        url: "../../controller/docs/"+nombreruta,
        //url: "../../controller/docs/liquidacion_4.php",
        data : formData,
        processData: false, // Evita que jQuery procese los datos (necesario al usar FormData)
        contentType: false, // No establece el tipo de contenido (necesario al usar FormData)
        success: function(response){  
            console.log(response);
            /*if(response == "1"){
                swal.fire(
                    'Documento generado exitosamente',
                    '',
                    'success'
                );
            }*/
            //console.log(response);
            resp = JSON.parse(response);
            if(resp.estado == 1){
                    swal.fire(
                        'Documento generado exitosamente',
                        '',
                        'success'
                    );
            }
            // URL del archivo que deseas descargar
            var url = '../../files/'+nom_carpeta+'/'+resp.archivo+'.docx';
            console.log(url);
            // Crear un elemento <a> oculto
            var link = document.createElement('a');
            link.href = url;
            link.download = resp.archivo+'-'+num_doc; // Nombre del archivo para descargar
            link.style.display = 'none';

            // Añadir el elemento <a> al DOM
            document.body.appendChild(link);

            // Simular un clic en el enlace para iniciar la descarga
            link.click();

            // Eliminar el elemento <a> del DOM después de la descarga
            document.body.removeChild(link);
           
           
        }
    });
}


function imprimir_liquidacion_boleta(e){


    var mes_boletas         = $('#select_mes_boletas'+ e).val();
    var anios               = $('#select_anio_boletas'+ e).val();
    var boleta              = $('#combo_prev_boleta'+ e).val();
    var nombreruta          = 'boleta_'+ boleta +'.php';

    //var nombreruta          = 'boleta_1.php'; 
    var nombre              = $('#txtnombre').val();
    var apellido            = $('#txtapellido').val();
    var nombre_emp          = $('#nom_emp_lab'+ e).html();
    var nombre_com          = nombre + ' ' + apellido;
    var num_doc             = $('#num_doc').val();
    var nom_carpeta         = "PENSIONES-"+ num_doc;
    var fecha_inicio        = $('.desde_imp').html();
    var fecha_hasta         = $('.hasta_imp').html();
    var fecha_inicio_num    = $('.desde_imp_num').html();
    var fecha_hasta_num     = $('.hasta_imp_num').html();
    var lugar_dia           = $('.lugardia').html();
    var cargo               = $('#cargo_emp'+ e).val();
    var sueldo              = $('#sueldo_emp'+ e).val();
    var moneda              = $('#moneda_emp'+ e).val();
    var motivo              = $('select[name="combo_prev_liqui'+ e +'"] option:selected').text();
    //Agregar año para la condicional 
    var fecha_final         = $("#fech_final_emp"+ e).val();
    var fecha               = new Date(fecha_final);
    var anio                = fecha.getFullYear();
    var ruc                 = $('#ruc_emp'+e).val();

    //montos descontados
    var dsc_at_pen          = $('.dsc_at_pension_monto').html();
    var dsc_ap_pen          = $('.dsc_ap_pension_monto').html();
    var dsc_at_ss           = $('.dsc_at_ss_monto').html();
    var dsc_ap_ss           = $('.dsc_ap_ss_monto').html();
    var dsc_at_fon          = $('.dsc_at_fonavi_monto').html();
    var dsc_ap_fon          = $('.dsc_ap_fonavi_monto').html();
    var tot_desc_at         = $('.total_dsc_trabajador_boleta').html();
    var tot_desc_ap         = $('.total_dsc_empleador_boleta').html();


    //datos de la boleta
    var total_boleta = $('.total_boleta').html();
    var total_neto_1 = $('.total_neto_1').html();
    var mes_anio = $('.mes_anio_imp').html();
    var total_neto_boleta = $('.total_neto_pagar_boleta').html();

    // Serializa el formulario
    var formData = new FormData($('#form_bol'+ e)[0]);

    // Agrega los datos adicionales al objeto FormData
    formData.append('nombre', nombre); 
    formData.append('apellido', apellido);
    formData.append('empresa', nombre_emp); 
    formData.append('afiliado', nombre_com);
    formData.append('nombre_carpeta', nom_carpeta); 
    formData.append('fecha_inicio', fecha_inicio); 
    formData.append('fecha_final', fecha_hasta); 
    formData.append('fecha_inicio_num', fecha_inicio_num);
    formData.append('fecha_final_num', fecha_hasta_num); 
    formData.append('fecha_footer', lugar_dia);   
    formData.append('cargo', cargo);  
    formData.append('sueldo', sueldo);   
    formData.append('moneda', moneda);  
    formData.append('motivo', motivo); 
    formData.append('anio_final', anio);  
    formData.append('total_boleta', total_boleta); 
    formData.append('total_neto_1', total_neto_1); 
    formData.append('total_neto_boleta', total_neto_boleta); 
    formData.append('dsc_at_pen', dsc_at_pen); 
    formData.append('dsc_ap_pen', dsc_ap_pen); 
    formData.append('dsc_at_ss', dsc_at_ss); 
    formData.append('dsc_ap_ss', dsc_ap_ss); 
    formData.append('dsc_at_fon', dsc_at_fon); 
    formData.append('dsc_ap_fon', dsc_ap_fon); 
    formData.append('tot_desc_at', tot_desc_at); 
    formData.append('tot_desc_ap', tot_desc_ap); 
    formData.append('ruc', ruc);
    if(mes_boletas == 'all'){
        // Crear un array de los meses del año
        const mesesDelAnio = [
            'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
            'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
        ];

        // Recorrer el array e imprimir cada mes
        mesesDelAnio.forEach(function(mes, indice) {
            //console.log(`Mes ${indice + 1}: ${mes}`);
            formData.append('mes_anio', mes+ '-'+anios);
            //console.log(mes+ '-'+anios);
            $.ajax({
                type: "POST",
                url: "../../controller/docs/"+nombreruta,
                data : formData,
                processData: false, // Evita que jQuery procese los datos (necesario al usar FormData)
                contentType: false, // No establece el tipo de contenido (necesario al usar FormData)
                success: function(response){  
                    console.log(response);
                    //resp = JSON.parse(response);
                }
            });
           
        });

        swal.fire(
            'Documento generado exitosamente',
            '',
            'success'
        );
            
    }else {
        formData.append('mes_anio', mes_anio);
        $.ajax({
            type: "POST",
            url: "../../controller/docs/"+nombreruta,
            data : formData,
            processData: false, // Evita que jQuery procese los datos (necesario al usar FormData)
            contentType: false, // No establece el tipo de contenido (necesario al usar FormData)
            success: function(response){  
                console.log(response);
                resp = JSON.parse(response);
                if(resp.estado == 1){
                        swal.fire(
                            'Documento generado exitosamente',
                            '',
                            'success'
                        );
                }
                // URL del archivo que deseas descargar
                var url = '../../files/'+nom_carpeta+'/'+resp.archivo+'.docx';
    
                // Crear un elemento <a> oculto
                var link = document.createElement('a');
                link.href = url;
                link.download = resp.archivo+'-'+num_doc; // Nombre del archivo para descargar
                link.style.display = 'none';
    
                // Añadir el elemento <a> al DOM
                document.body.appendChild(link);
    
                // Simular un clic en el enlace para iniciar la descarga
                link.click();
    
                // Eliminar el elemento <a> del DOM después de la descarga
                document.body.removeChild(link);
               
            }
        });
    
    }  

}

function imprimir_certificado() {
    let e = $('#num_emp').val();// se asigna al seleccinar la empresa en el tab

    if(e == ""){
        e = 1;
    }
    let dni = $('#num_doc').val();
    let nombres = $('#txtnombre').val();
    let apellidos = $('#txtapellido').val();
    var nombreArchivo ="Certificado "+ dni + " " + nombres + " " + apellidos;
    let tipoprev = $('#select_certificado'+e).val();
    var ficha = document.getElementById('contenido_certificado_'+tipoprev);
    var ventimp1 = window.open('', 'Imprimir');
    ventimp1.document.write('<html><head><title>'+nombreArchivo+'</title>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/css/bracket.css"></link>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/lib/bootstrap5/bootstrap.min.css">');
    ventimp1.document.write('<style> .certificado_imp{ padding-left: 200px; padding-right: 200px;}</style>');
    ventimp1.document.write('<style> .divimagen{ padding: 30px 150px;}</style>');
    ventimp1.document.write('</head><body >');
    ventimp1.document.write(ficha.innerHTML);
    ventimp1.document.write('</body></html>');
    ventimp1.document.close();
    ventimp1.focus();    
    
    ventimp1.onload = function() {
        ventimp1.print();
        ventimp1.close();
    };
}

function imprimir_liquidacion(id){
    let dni = $('#num_doc').val();
    let nombres = $('#txtnombre').val();
    let apellidos = $('#txtapellido').val();
    var nombreArchivo ="Liquidacion "+ dni + " " + nombres + " " + apellidos;
    var contenido = document.getElementById('contenido_liqui_'+id);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>'+nombreArchivo+'</title>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/css/bracket.css"></link>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/lib/bootstrap5/bootstrap.min.css">');
    ventimp1.document.write('</head><body >');
    ventimp1.document.write(contenido.innerHTML);
    ventimp1.document.write('</body></html>');
    ventimp1.document.close();
    ventimp1.focus();    
    
    ventimp1.onload = function() {
        ventimp1.print();
        ventimp1.close();
    };
}

function imprimir_boleta(){
    let e = $('#num_emp').val();
    if( e == '') {
        e = 1;
    }
    let dni = $('#num_doc').val();
    let nombres = $('#txtnombre').val();
    let apellidos = $('#txtapellido').val();
    var nombreArchivo ="Boleta "+ dni + " " + nombres + " " + apellidos;
    let tipoprev = $('#combo_prev_boleta'+ e).val();
    var contenido = document.getElementById('contenido_boleta_'+tipoprev);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>'+nombreArchivo+'</title>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/css/bracket.css"></link>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/lib/bootstrap5/bootstrap.min.css">');
    ventimp1.document.write('</head><body >');
    ventimp1.document.write(contenido.innerHTML);
    ventimp1.document.write('</body></html>');
    ventimp1.document.close();
    ventimp1.focus();    
    
    ventimp1.onload = function() {
        ventimp1.print();
        ventimp1.close();
    };
}

function calcularTotalBoleta(e){
    let sueldo_boleta = $('#sueldo_boleta'+ e).val();
    let h_extras_boleta = $('#horaex_boleta'+ e).val();
    let boni_boleta = $('#boni_boleta'+ e).val();
    let rm_vacacional = $('#rm_vacacional_boleta'+ e).val();
    let reintegro_boleta = $('#reintegro_boleta'+ e).val();
    let otros_boleta = $('#otros_boleta'+ e).val();
    let total ;

    total = Number(sueldo_boleta) + Number(h_extras_boleta) + Number(boni_boleta) + Number(rm_vacacional)+ Number(reintegro_boleta) + Number(otros_boleta) ;
    //console.log(total);
    $('#total_monto_boleta'+e).val(total);
}

function calcularTotalBoletaInfo(){
    let e = $('#num_emp').val();
    let sueldo_boleta = $('#sueldo_boleta_info').val();
    let h_extras_boleta = $('#horaex_boleta_info').val();
    let boni_boleta = $('#boni_boleta_info').val();
    let rm_vacacional = $('#rm_vacacional_boleta_info').val();
    let reintegro_boleta = $('#reintegro_boleta_info').val();
    let otros_boleta = $('#otros_boleta_info').val();
    let total ;

    total = Number(sueldo_boleta) + Number(h_extras_boleta) + Number(boni_boleta) + Number(rm_vacacional)+ Number(reintegro_boleta) + Number(otros_boleta);
    //console.log(total);
    $('#total_monto_boleta'+ e).val(total);
    $('#sueldo_boleta'+ e).val(sueldo_boleta);
    $('#horaex_boleta'+ e).val(h_extras_boleta);
    $('#boni_boleta'+ e).val(boni_boleta);
    $('#rm_vacacional_boleta'+ e).val(rm_vacacional);
    $('#reintegro_boleta'+ e).val(reintegro_boleta);
    $('#otros_boleta'+ e).val(otros_boleta);
}

function PrevLiquidacion(e){

    let fechad = $('#fecha_liquidacion'+ e).val();
    let fechaloc = new Date(fechad);
    var fechaimod = fechaloc.toLocaleString('en-US', {
        timeZone: 'Europe/London'
    });
    var fecha_emi = new Date(fechaimod);
    let fecha_fin = $('#fech_final_emp'+e).val();
    let dpto1 = $('#dpto_emp'+ e).val();
    //console.log(fecha_emi);    
    let fecha_ff = new Date (fecha_fin);


    if(fecha_emi >= fecha_ff && fechad != "" ){

        OcultarPrev();
        $("#prev1").hide();
        $("#prev2").show();
        $("#prev3").hide();
        $("#prev5").hide();

        var options = { year: 'numeric', month: 'long', day: 'numeric' };

        //DATOS  nombre completo, Finicio, Ffinal, Cargo, firmante

        let fechai = $('#fech_inicio_emp'+ e).val();
        let fechaf = $('#fech_final_emp'+ e).val();

        let fecha1 = new Date(fechai);
        let fecha2 = new Date(fechaf);
        


        let nom         = $('#nombre_emp'+ e).val();
        let dias_lq     = $('#dias_liqui'+ e).val();
        let meses_lq    = $('#meses_liqui'+ e).val();
        let anios_lq    = $('#anios_liqui'+ e).val();
        let monto_texto;
        let motivo      = $('select[name="combo_prev_liqui'+e+'"] option:selected').text();
        let cuerpo      = $('#combo_prev_cuerpo'+e).val();
        let fecha_final = $("#fech_final_emp"+e).val();
        let fecha       = new Date(fecha_final);
        let anio        = fecha.getFullYear();
        let cargo       = $('#cargo_emp'+ e).val();
        var tipo3 = 0;

            /*CALCULO DEL CUERPO DE AÑOS POR SUELDO */
        let moneda_rm = $('#moneda_emp'+e).val();
        let sueldo_rm = $('#sueldo_emp'+e).val();
        let monto_sld_anio ;  
        let monto_sld_mes ;
        let monto_sld_dia; 
        let monto_total_lq;
        let meses_sld_lq; 

        console.log("Dias Liqui: " + dias_lq);
        console.log("Meses_liqui: " + meses_lq);
        console.log("Anios Liqui: "+ anios_lq);

        $('.motivo_retiro').html(motivo.toUpperCase());

        if(anio >= 1960 && anio <= 1970){
            $("#liquidacion_1").show();
        }
        if(anio >= 1971 && anio <= 1985){
            $("#liquidacion_2").show();
        }
        if(anio >= 1986 && anio <= 1991){
            $("#liquidacion_3").show();
        }
        if(anio >= 1992 && anio <= 1999){
            $("#liquidacion_4").show();
        }


        if(anio >= 1960 && anio <= 1979){
            if(dias_lq > 0){
                meses_sld_lq = Number(meses_lq) + 1;
            }else {
                meses_sld_lq = meses_lq ;
            }
            monto_sld_anio = Number(Number(sueldo_rm) * Number(anios_lq)).toFixed(2);
            monto_sld_mes = Number((Number(sueldo_rm) / 12) * Number(meses_sld_lq)).toFixed(2);
            monto_total_lq = Number(Number(monto_sld_anio) + Number(monto_sld_mes)).toFixed(2);
            monto_texto = monto_total_lq;

            $('.anios_liqui').html(anios_lq + " Años");
            $('.meses_liqui').html(meses_sld_lq + " Meses");
            $('.tiempo_lq_total').html(anios_lq + " Años " + meses_sld_lq + " Meses");

            //$('.modelo_60_79').show();
            switch (cuerpo) {
                case '1':
                    $('.modelo_60_79_cuerpo_1').show();
                    break;
                case '2':
                    $('.modelo_60_79_cuerpo_2').show();
                    break;
                case '3':
                    $('.modelo_60_79_cuerpo_3').show();
                    break;
            }
            
        }

        if(anio >= 1980 && anio <= 1999){
            meses_sld_lq = meses_lq ;
            monto_sld_anio = Number(Number(sueldo_rm) * Number(anios_lq)).toFixed(2);
            monto_sld_mes = Number((Number(sueldo_rm) / 12) * Number(meses_lq)).toFixed(2);
            monto_sld_dia =Number(Number((Number(sueldo_rm) / 12)/30) * Number(dias_lq)).toFixed(2);
            monto_total_lq = Number(Number(monto_sld_anio) + Number(monto_sld_mes) + Number(monto_sld_dia)).toFixed(2);
            monto_texto = monto_total_lq ;

            $('.anios_liqui').html(anios_lq + " Años");
            $('.meses_liqui').html(meses_sld_lq + " Meses");
            $('.dias_liqui').html(dias_lq + " Dias");
            $('.tiempo_lq_total').html(anios_lq + " Años " + meses_sld_lq + " Meses " + dias_lq + " Dias");

            //$('.modelo_80_99').show();
            switch (cuerpo) {
                case '1':
                    $('.modelo_80_99_cuerpo_1').show();
                    break;
                case '2':
                    $('.modelo_80_99_cuerpo_2').show();
                    
                    break;
                case '3':
                    $('.modelo_80_99_cuerpo_3').show();
                    tipo3 = 1;
                    break;
            }
        }

        $('.tipo_moneda').html(moneda_rm);
        $('.sueldo_rm').html(Number(sueldo_rm).toFixed(2));
        $('.monto_sldo_anio').html(monto_sld_anio);
        $('.monto_sldo_mes').html(monto_sld_mes);
        $('.monto_sldo_dia').html(monto_sld_dia);
        $('.monto_total_lq').html(monto_total_lq);
        $('.monto_prueba').html(monto_texto);


        let divs = "";
        var total_neto = Number(monto_total_lq);
        var total_conceptos = 0.00;

        $(".liqui_bonif"+ e).each(function() {

            if($(this).val() != 0){
                var nombres = $(this).attr('name');
                var valor = Number($(this).val()).toFixed(2);
                total_neto+= Number(valor);
                total_conceptos+= Number(valor);

                divs+='<div class="row">';
                divs+='    <div class="col-4 text-left">';
                divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;">'+nombres+'</h1>';
                divs+='    </div>';

                if(tipo3 == 0){
                    divs+='    <div class="col-4 text-center">';
                    divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>';
                    divs+='    </div>';
                }
        
                divs+='    <div class="col-4" style="text-align: right !important;">';
                divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span>'+moneda_rm+'</span> <span>'+valor+'</span> </h1>';
                divs+='    </div>';
                divs+='</div>';
            }
        });

        $.ajax({
            url: "../../controller/pensioncontrolador.php?op=letras_monto",
            type: "POST",
            data: {valor : total_neto},
            success: function(data){
                //console.log(data);
                $('.letras_monto').html(data);
            },
            error: function(error){
                console.log(error);
            }
        });


        $('.bonif_liquidacion').html(divs);
        $('.monto_total_lq_neto').html(Number(total_neto).toFixed(2));
        $('.monto_conceptos_total').html(Number(total_conceptos).toFixed(2));
        $('.cargo_imp').html(cargo);
        $('.emp_imp').html(nom);
        

        //Asignar datos
        $('.desde_imp').html(fecha1.toLocaleDateString("es-ES", options).toUpperCase());
        $('.hasta_imp').html(fecha2.toLocaleDateString("es-ES", options).toUpperCase());
        
        $('.desde_imp_low').html(fecha1.toLocaleDateString("es-ES", options));
        $('.hasta_imp_low').html(fecha2.toLocaleDateString("es-ES", options));
        $('.cargo_imp_low').html(cargo.toLowerCase());
        $('.lugardia').html(dpto1+", "+fecha_emi.toLocaleDateString("es-ES", options).toUpperCase());
        $('.lugardia_low').html(dpto1+", "+fecha_emi.toLocaleDateString("es-ES", options));


    }else {
        swal.fire(
            'Fecha de emision incorrecta',
            '',
            'error'
        );
    }

    

}

//prevli , ya no se usa
$(document).on("click","#btnprevli", function(){
    OcultarPrev();
    $("#prev1").hide();
    $("#prev2").show();
    $("#prev3").hide();

    let dias_lq     = $('#dias_liqui').val();
    let meses_lq    = $('#meses_liqui').val();
    let anios_lq    = $('#anios_liqui').val();
    let monto_texto;
    let motivo      = $('select[name="combo_prev_liqui"] option:selected').text();
    let cuerpo      = $('#combo_prev_cuerpo').val();
    let fecha_final = $("#fech_final_emp").val();
    let fecha       = new Date(fecha_final);
    let anio        = fecha.getFullYear();
    var tipo3 = 0;

    /*CALCULO DEL CUERPO DE AÑOS POR SUELDO */
    let moneda_rm = $('#moneda_emp').val();
    let sueldo_rm = $('#sueldo_emp').val();
    let monto_sld_anio ;  
    let monto_sld_mes ;
    let monto_sld_dia; 
    let monto_total_lq;
    let meses_sld_lq; 

    $('.motivo_retiro').html(motivo.toUpperCase());
    
    if(anio >= 1960 && anio <= 1970){
        $("#liquidacion_1").show();
    }
    if(anio >= 1971 && anio <= 1985){
        $("#liquidacion_2").show();
    }
    if(anio >= 1986 && anio <= 1991){
        $("#liquidacion_3").show();
    }
    if(anio >= 1992 && anio <= 1999){
        $("#liquidacion_4").show();
    }



    if(anio >= 1960 && anio <= 1979){
        if(dias_lq > 0){
            meses_sld_lq = Number(meses_lq) + 1;
        }else {
            meses_sld_lq = meses_lq ;
        }
        monto_sld_anio = Number(Number(sueldo_rm) * Number(anios_lq)).toFixed(2);
        monto_sld_mes = Number((Number(sueldo_rm) / 12) * Number(meses_sld_lq)).toFixed(2);
        monto_total_lq = Number(Number(monto_sld_anio) + Number(monto_sld_mes)).toFixed(2);
        monto_texto = monto_total_lq;

        $('.anios_liqui').html(anios_lq + " Años");
        $('.meses_liqui').html(meses_sld_lq + " Meses");
        $('.tiempo_lq_total').html(anios_lq + " Años " + meses_sld_lq + " Meses");

        //$('.modelo_60_79').show();
        switch (cuerpo) {
            case '1':
                $('.modelo_60_79_cuerpo_1').show();
                break;
            case '2':
                $('.modelo_60_79_cuerpo_2').show();
                break;
            case '3':
                $('.modelo_60_79_cuerpo_3').show();
                break;
        }
        
    }
    if(anio >= 1980 && anio <= 1999){
        meses_sld_lq = meses_lq ;
        monto_sld_anio = Number(Number(sueldo_rm) * Number(anios_lq)).toFixed(2);
        monto_sld_mes = Number((Number(sueldo_rm) / 12) * Number(meses_lq)).toFixed(2);
        monto_sld_dia =Number(Number((Number(sueldo_rm) / 12)/30) * Number(dias_lq)).toFixed(2);
        monto_total_lq = Number(Number(monto_sld_anio) + Number(monto_sld_mes) + Number(monto_sld_dia)).toFixed(2);
        monto_texto = monto_total_lq ;

        $('.anios_liqui').html(anios_lq + " Años");
        $('.meses_liqui').html(meses_sld_lq + " Meses");
        $('.dias_liqui').html(dias_lq + " Dias");
        $('.tiempo_lq_total').html(anios_lq + " Años " + meses_sld_lq + " Meses " + dias_lq + " Dias");

        //$('.modelo_80_99').show();
        switch (cuerpo) {
            case '1':
                $('.modelo_80_99_cuerpo_1').show();
                break;
            case '2':
                $('.modelo_80_99_cuerpo_2').show();
                
                break;
            case '3':
                $('.modelo_80_99_cuerpo_3').show();
                tipo3 = 1;
                break;
        }
    }

    $('.tipo_moneda').html(moneda_rm);
    $('.sueldo_rm').html(Number(sueldo_rm).toFixed(2));
    $('.monto_sldo_anio').html(monto_sld_anio);
    $('.monto_sldo_mes').html(monto_sld_mes);
    $('.monto_sldo_dia').html(monto_sld_dia);
    $('.monto_total_lq').html(monto_total_lq);
    $('.monto_prueba').html(monto_texto);


    let divs = "";
    var total_neto = Number(monto_total_lq);
    var total_conceptos = 0.00;

    $(".liqui_bonif").each(function() {

        if($(this).val() != 0){
            var nombres = $(this).attr('name');
            var valor = Number($(this).val()).toFixed(2);
            total_neto+= Number(valor);
            total_conceptos+= Number(valor);

            divs+='<div class="row">';
            divs+='    <div class="col-4 text-left">';
            divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;">'+nombres+'</h1>';
            divs+='    </div>';

            if(tipo3 == 0){
                divs+='    <div class="col-4 text-center">';
                divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>';
                divs+='    </div>';
            }
    
            divs+='    <div class="col-4" style="text-align: right !important;">';
            divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;"><span>'+moneda_rm+'</span> <span>'+valor+'</span> </h1>';
            divs+='    </div>';
            divs+='</div>';
        }
	});

    $.ajax({
        url: "../../controller/pensioncontrolador.php?op=letras_monto",
        type: "POST",
        data: {valor : total_neto},
        success: function(data){
            //console.log(data);
            $('.letras_monto').html(data);
        },
        error: function(error){
            console.log(error);
        }
    });


    $('.bonif_liquidacion').html(divs);
    $('.monto_total_lq_neto').html(Number(total_neto).toFixed(2));
    $('.monto_conceptos_total').html(Number(total_conceptos).toFixed(2));

});

function PrevBoleta(e){
    calcularTotalBoleta(e);
    OcultarPrev();

    let nom = $('#nombre_emp'+ e).val();
    let estado = $('select[name="select_mes_boletas'+ e +'"] option:selected').text();
    let estado_anio = $('select[name="select_anio_boletas'+ e +'"] option:selected').text();
    let mes = $('#select_mes_boletas'+ e).val();
    let tipoprev = $('#combo_prev_boleta'+ e).val();
    let nombre_afi = $('#txtnombre').val();
    let apellido_afi= $('#txtapellido').val();
    let doc_afi = $('#num_doc').val();
    let cargo_afi = $('#cargo_emp'+ e).val();
    let sueldo_boleta = $('#sueldo_boleta'+ e).val();
    let h_extras_boleta = $('#horaex_boleta'+ e).val();
    let boni_boleta = $('#boni_boleta'+ e).val();
    let fecha_inicio_afi = $('#fech_inicio_emp'+ e).val();
    let fecha_nac_afi = $('#txtdate').val();
    let rm_vacacional = $('#rm_vacacional_boleta'+ e).val();
    let reintegro_boleta = $('#reintegro_boleta'+ e).val();
    let otros_boleta = $('#otros_boleta'+ e).val();
    let total_boleta = $('#total_monto_boleta'+ e).val();
    let horaex = document.getElementById("horaex_boleta"+ e).valueAsNumber;
    let boni= document.getElementById("boni_boleta"+ e).valueAsNumber
    let fecha_boleta = "";

    let fecha2 = new Date(fecha_inicio_afi);
    let fecha3 = moment(fecha2).format('DD-MM-YYYY');

    switch (mes) {
        case "dic":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "ene": 
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "feb":
            fecha_boleta = "29 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "mar":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "abr":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "may":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "jun":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "jul":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "ago":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "sep":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "oct":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "nov":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
    }

    let dsc_at_ss = $('#at_ss'+ e).val();
    let dsc_at_fonavi = $('#at_fonavi'+ e).val();
    let dsc_at_pension = $('#at_pension'+ e).val();
    let dsc_ap_ss = $('#ap_ss'+ e).val();
    let dsc_ap_fonavi = $('#ap_fonavi'+ e).val();
    let dsc_ap_pension = $('#ap_pension'+ e).val();
    let monto = Number($('#total_monto_boleta'+ e).val());
    let dsc_at_ss_monto = Number(monto *(dsc_at_ss/100)).toFixed(2);
    let dsc_at_fonavi_monto = Number(monto *(dsc_at_fonavi/100)).toFixed(2);
    let dsc_at_pension_monto = Number(monto *(dsc_at_pension/100)).toFixed(2);
    let dsc_ap_ss_monto = Number(monto *(dsc_ap_ss/100)).toFixed(2);
    let dsc_ap_fonavi_monto = Number(monto *(dsc_ap_fonavi/100)).toFixed(2);
    let dsc_ap_pension_monto = Number(monto *(dsc_ap_pension/100)).toFixed(2);

    $('.dsc_at_ss_monto').html(dsc_at_ss_monto);
    $('.dsc_at_fonavi_monto').html(dsc_at_fonavi_monto);
    $('.dsc_at_pension_monto').html(dsc_at_pension_monto);
    $('.dsc_ap_ss_monto').html(dsc_ap_ss_monto);
    $('.dsc_ap_fonavi_monto').html(dsc_ap_fonavi_monto);
    $('.dsc_ap_pension_monto').html(dsc_ap_pension_monto);
    let total_trabajador = (Number(dsc_at_ss_monto) + Number(dsc_at_fonavi_monto) + Number(dsc_at_pension_monto)).toFixed(2);
    let total_empleador  = (Number(dsc_ap_ss_monto) + Number(dsc_ap_fonavi_monto) + Number(dsc_ap_pension_monto)).toFixed(2);

    let total_descuentos = (Number(total_empleador) + Number(total_trabajador)).toFixed(2);
    let total_neto = (Number(total_boleta) - Number(total_empleador) - Number(total_trabajador)).toFixed(2);
    let total_bol = boni + horaex ;
    let sum_sdo_bono = Number(sueldo_boleta) + Number(boni_boleta);
    let total_neto_4 = Number(sueldo_boleta) - Number(total_descuentos);
    let neto_bol_7 = (Number(sum_sdo_bono) - Number(dsc_at_fonavi_monto) - Number(dsc_ap_fonavi_monto)).toFixed(2);
    let neto_bol_10 = (Number(total_boleta) - Number(total_trabajador)).toFixed(2) ;
    let neto_bol_16 = (Number(sueldo_boleta)) + (Number(h_extras_boleta));
    let total_neto_16 = (Number(neto_bol_16) - Number(total_descuentos));
    let total_neto_1 = (Number(total_boleta) - Number(dsc_at_fonavi_monto) - Number(dsc_ap_fonavi_monto));
    /*console.log(neto_bol_16);
    console.log(total_descuentos);
    console.log(total_neto_16);*/
    $('.mes_anio_imp').html(estado.toUpperCase()+'-'+estado_anio.toUpperCase());
    $('.nombre_afiliado').html(nombre_afi);
    $('.doc_afiliado').html(doc_afi);
    $('.apellido_afiliado').html(apellido_afi);
    $('.cargo_afiliado').html(cargo_afi);
    $('.fecha_ingreso_afiliado').html(fecha3);
    $('.sueldo_afiliado').html(sueldo_boleta);
    $('.h_extras_afiliado').html(h_extras_boleta);
    $('.boni_afiliado').html(boni_boleta);
    $('.rem_vaca_afiliado').html(rm_vacacional);
    $('.reintegro_afiliado').html(reintegro_boleta);
    $('.otros_afiliado').html(otros_boleta);
    $('.total_boleta').html(total_boleta);

    /*$('.porcentaje_6_boleta').html(prc6);
    $('.porcentaje_3_boleta').html(prc3);
    $('.porcentaje_1_boleta').html(prc1);*/

    $('.total_dsc_empleador_boleta').html(total_empleador);
    $('.total_dsc_trabajador_boleta').html(total_trabajador);
    $('.total_descuentos_boleta').html(total_descuentos);
    $('.total_neto_pagar_boleta').html(total_neto);
    $('.total_neto_pagar_boleta_4').html(total_neto_4);
    $('.total_sueldo_bono').html(sum_sdo_bono);
    $('.total_neto_1').html(total_neto_1);
    $('.total_neto_boleta_7').html(neto_bol_7);
    $('.total_neto_boleta_10').html(neto_bol_10);
    $('.total_boleta_16').html(neto_bol_16);
    $('.total_neto_boleta_16').html(total_neto_16);
    $('.fecha_boleta').html(fecha_boleta);
    $('.fecha_nac_afi').html(convertDateFormat(fecha_nac_afi));
    //Nombre de la Empresa
    $('.emp_imp').html(nom);
    /* EMPRESA  emp_imp*/ 

    $('#horas_imp_boleta').html(horaex);
    $('#boni_imp_boleta').html(boni);
    $('#total_imp_boleta').html(total_bol);

    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").show();
    $("#prev_boleta_"+tipoprev).show();
}

//metodo ya no se usa
$(document).on("click","#btnprevbol", function(){
    calcularTotalBoleta();
    OcultarPrev();
    let estado = $('select[name="select_mes_boletas"] option:selected').text();
    let estado_anio = $('select[name="select_anio_boletas"] option:selected').text();
    let mes = $('#select_mes_boletas').val();
    let tipoprev = $('#combo_prev_boleta').val();
    let nombre_afi = $('#txtnombre').val();
    let apellido_afi= $('#txtapellido').val();
    let doc_afi = $('#num_doc').val();
    let cargo_afi = $('#cargo_emp').val();
    let sueldo_boleta = $('#sueldo_boleta').val();
    let h_extras_boleta = $('#horaex_boleta').val();
    let boni_boleta = $('#boni_boleta').val();
    let fecha_inicio_afi = $('#fech_inicio_emp').val();
    let fecha_nac_afi = $('#txtdate').val();
    let rm_vacacional = $('#rm_vacacional_boleta').val();
    let reintegro_boleta = $('#reintegro_boleta').val();
    let otros_boleta = $('#otros_boleta').val();
    let total_boleta = $('#total_monto_boleta').val();
    let horaex = document.getElementById("horaex_boleta").valueAsNumber;
    let boni= document.getElementById("boni_boleta").valueAsNumber
    let fecha_boleta = "";


    switch (mes) {
        case "dic":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "ene": 
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "feb":
            fecha_boleta = "29 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "mar":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "abr":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "may":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "jun":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "jul":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "ago":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "sep":
            fecha_boleta = "30 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "oct":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
        case "nov":
            fecha_boleta = "31 DE "+ estado.toUpperCase() +" DE "+estado_anio+"";
            break;
    }

    let dsc_at_ss = $('#at_ss').val();
    let dsc_at_fonavi = $('#at_fonavi').val();
    let dsc_at_pension = $('#at_pension').val();
    let dsc_ap_ss = $('#ap_ss').val();
    let dsc_ap_fonavi = $('#ap_fonavi').val();
    let dsc_ap_pension = $('#ap_pension').val();
    let monto = Number($('#total_monto_boleta').val());
    let dsc_at_ss_monto = Number(monto *(dsc_at_ss/100)).toFixed(2);
    let dsc_at_fonavi_monto = Number(monto *(dsc_at_fonavi/100)).toFixed(2);
    let dsc_at_pension_monto = Number(monto *(dsc_at_pension/100)).toFixed(2);
    let dsc_ap_ss_monto = Number(monto *(dsc_ap_ss/100)).toFixed(2);
    let dsc_ap_fonavi_monto = Number(monto *(dsc_ap_fonavi/100)).toFixed(2);
    let dsc_ap_pension_monto = Number(monto *(dsc_ap_pension/100)).toFixed(2);

    $('.dsc_at_ss_monto').html(dsc_at_ss_monto);
    $('.dsc_at_fonavi_monto').html(dsc_at_fonavi_monto);
    $('.dsc_at_pension_monto').html(dsc_at_pension_monto);
    $('.dsc_ap_ss_monto').html(dsc_ap_ss_monto);
    $('.dsc_ap_fonavi_monto').html(dsc_ap_fonavi_monto);
    $('.dsc_ap_pension_monto').html(dsc_ap_pension_monto);
    let total_trabajador = (Number(dsc_at_ss_monto) + Number(dsc_at_fonavi_monto) + Number(dsc_at_pension_monto)).toFixed(2);
    let total_empleador  = (Number(dsc_ap_ss_monto) + Number(dsc_ap_fonavi_monto) + Number(dsc_ap_pension_monto)).toFixed(2);

    
    let prc1 = Number(monto *0.01).toFixed(2);
    let prc3 = Number(monto *0.03).toFixed(2);
    let prc6 = Number(monto *0.06).toFixed(2);

    let total_descuentos = (Number(total_empleador) + Number(total_trabajador)).toFixed(2);
    let total_neto = (Number(total_boleta) - Number(total_empleador) - Number(total_trabajador)).toFixed(2);
    let total_bol = boni + horaex ;
    let sum_sdo_bono = Number(sueldo_boleta) + Number(boni_boleta);
    let total_neto_4 = Number(sueldo_boleta) - Number(total_descuentos);
    let neto_bol_7 = (Number(sum_sdo_bono) - Number(dsc_at_fonavi_monto) - Number(dsc_ap_fonavi_monto)).toFixed(2);
    let neto_bol_10 = (Number(total_boleta) - Number(total_trabajador)).toFixed(2) ;
    let neto_bol_16 = (Number(sueldo_boleta)) + (Number(h_extras_boleta));
    let total_neto_16 = (Number(neto_bol_16) - Number(total_descuentos));
    let total_neto_1 = (Number(total_boleta) - Number(dsc_at_fonavi_monto) - Number(dsc_ap_fonavi_monto));
    /*console.log(neto_bol_16);
    console.log(total_descuentos);
    console.log(total_neto_16);*/
    $('.mes_anio_imp').html(estado.toUpperCase()+'-'+estado_anio.toUpperCase());
    $('.nombre_afiliado').html(nombre_afi);
    $('.doc_afiliado').html(doc_afi);
    $('.apellido_afiliado').html(apellido_afi);
    $('.cargo_afiliado').html(cargo_afi);
    $('.fecha_ingreso_afiliado').html(convertDateFormat(fecha_inicio_afi));
    $('.sueldo_afiliado').html(sueldo_boleta);
    $('.h_extras_afiliado').html(h_extras_boleta);
    $('.boni_afiliado').html(boni_boleta);
    $('.rem_vaca_afiliado').html(rm_vacacional);
    $('.reintegro_afiliado').html(reintegro_boleta);
    $('.otros_afiliado').html(otros_boleta);
    $('.total_boleta').html(total_boleta);

    /*$('.porcentaje_6_boleta').html(prc6);
    $('.porcentaje_3_boleta').html(prc3);
    $('.porcentaje_1_boleta').html(prc1);*/

    $('.total_dsc_empleador_boleta').html(total_empleador);
    $('.total_dsc_trabajador_boleta').html(total_trabajador);
    $('.total_descuentos_boleta').html(total_descuentos);
    $('.total_neto_pagar_boleta').html(total_neto);
    $('.total_neto_pagar_boleta_4').html(total_neto_4);
    $('.total_sueldo_bono').html(sum_sdo_bono);
    $('.total_neto_1').html(total_neto_1);
    $('.total_neto_boleta_7').html(neto_bol_7);
    $('.total_neto_boleta_10').html(neto_bol_10);
    $('.total_boleta_16').html(neto_bol_16);
    $('.total_neto_boleta_16').html(total_neto_16);
    $('.fecha_boleta').html(fecha_boleta);
    $('.fecha_nac_afi').html(convertDateFormat(fecha_nac_afi));
    /* EMPRESA  emp_imp*/ 

    $('#horas_imp_boleta').html(horaex);
    $('#boni_imp_boleta').html(boni);
    $('#total_imp_boleta').html(total_bol);

    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").show();
    $("#prev_boleta_"+tipoprev).show();
});

$(document).on("click","#orcinea-tab", function(){
    $("#prev1").show();
    $("#prev2").hide();
    $("#prev3").hide();
});

function boleta_tab(e){
    let div = "<option label='Seleccione'></option>";
    let anio_inicio = $("#fech_inicio_emp"+ e).val();
    let anio_final = $("#fech_final_emp" + e).val();
    let anio_boleta_inicio = new Date(anio_inicio).getFullYear();
    let anio_boleta_final = new Date(anio_final).getFullYear();
    let incremento = anio_boleta_inicio;
    
    for( incremento; incremento <= anio_boleta_final ; incremento++){
        div+= "<option value="+incremento+">"+incremento+"</option>";
    }
    $('#select_anio_boletas'+ e).html(div);
    //$('#select_mes_boletas'+ e).select2("val", "0");

    /**FUNCIONALIDAD PARA CAMBIAR LA VISIBILIDAD DE BONOS*/

    let fecha = new Date(anio_final);

    let fecha_01_65 = new Date("1965-01-01");
    let fecha_07_80 = new Date("1980-07-01");
    let fecha_01_70 = new Date("1970-01-01");
    
    let fecha_12_82 = new Date("1983-01-01");
    let fecha_07_99 = new Date("1999-08-01");
    let fecha_12_84 = new Date("1985-01-01");
    

    $('.bonif'+ e).attr("readonly", "readonly");

    if(fecha > fecha_01_65 && fecha < fecha_07_99){
        $('#boni_boleta'+ e).attr("readonly", false);
        $('#reintegro_boleta'+ e).attr("readonly", false);
        $('#bonificacion_pasajes_boleta'+ e).attr("readonly", false);
        $('#bonificacion_uniforme_boleta'+ e).attr("readonly", false);
        $('#bonificacion_gratificacion_boleta'+ e).attr("readonly", false);
    }
    if(fecha > fecha_07_80 && fecha < fecha_07_99){
        $('#bonificacion_metas_boleta'+ e).attr("readonly", false);
    }
    if(fecha > fecha_01_65 && fecha < fecha_12_82){
        $('#bonificacion_alimentos_boleta'+ e).attr("readonly", false);
    }
    if(fecha > fecha_01_70 && fecha < fecha_07_99){
        $('#bonificacion_logros_boleta'+ e).attr("readonly", false);
    }
    if(fecha > fecha_01_65 && fecha < fecha_12_84){
        $('#bonificacion_festivos_boleta'+ e).attr("readonly", false);  
    }  
}

//Metodo Ya no se usa
$(document).on("click","#boleta-tab", function(){
    let div = "<option label='Seleccione'></option>";
    let anio_inicio = $("#fech_inicio_emp").val();
    let anio_final = $("#fech_final_emp").val();
    let anio_boleta_inicio = new Date(anio_inicio).getFullYear();
    let anio_boleta_final = new Date(anio_final).getFullYear();
    let incremento = anio_boleta_inicio;
    
    for( incremento; incremento <= anio_boleta_final ; incremento++){
        div+= "<option value="+incremento+">"+incremento+"</option>";
    }
    $('#select_anio_boletas').html(div);
    $('#select_mes_boletas').select2("val", "0");

    /**FUNCIONALIDAD PARA CAMBIAR LA VISIBILIDAD DE BONOS*/

    let fecha = new Date(anio_final);

    let fecha_01_65 = new Date("1965-01-01");
    let fecha_07_80 = new Date("1980-07-01");
    let fecha_01_70 = new Date("1970-01-01");
    
    let fecha_12_82 = new Date("1983-01-01");
    let fecha_07_99 = new Date("1999-08-01");
    let fecha_12_84 = new Date("1985-01-01");
    

    $('.bonif').attr("readonly", "readonly");

    if(fecha > fecha_01_65 && fecha < fecha_07_99){
        $('#boni_boleta').attr("readonly", false);
        $('#reintegro_boleta').attr("readonly", false);
        $('#bonificacion_pasajes_boleta').attr("readonly", false);
        $('#bonificacion_uniforme_boleta').attr("readonly", false);
        $('#bonificacion_gratificacion_boleta').attr("readonly", false);
    }
    if(fecha > fecha_07_80 && fecha < fecha_07_99){
        $('#bonificacion_metas_boleta').attr("readonly", false);
    }
    if(fecha > fecha_01_65 && fecha < fecha_12_82){
        $('#bonificacion_alimentos_boleta').attr("readonly", false);
    }
    if(fecha > fecha_01_70 && fecha < fecha_07_99){
        $('#bonificacion_logros_boleta').attr("readonly", false);
    }
    if(fecha > fecha_01_65 && fecha < fecha_12_84){
        $('#bonificacion_festivos_boleta').attr("readonly", false);  
    }  
});

function boleta_desc(e){
    calcularTotalBoleta(e);
    let dsc_at_ss = $('#at_ss'+ e).val();
    let dsc_at_fonavi = $('#at_fonavi'+ e).val();
    let dsc_at_pension = $('#at_pension'+ e).val();
    let dsc_ap_ss = $('#ap_ss'+ e).val();
    let dsc_ap_fonavi = $('#ap_fonavi'+ e).val();
    let dsc_ap_pension = $('#ap_pension'+ e).val();
    let monto = Number($('#total_monto_boleta'+ e).val());

    console.log(monto);

    let dsc_at_ss_monto = Number(monto *(dsc_at_ss/100)).toFixed(2);
    let dsc_at_fonavi_monto = Number(monto *(dsc_at_fonavi/100)).toFixed(2);
    let dsc_at_pension_monto = Number(monto *(dsc_at_pension/100)).toFixed(2);
    let dsc_ap_ss_monto = Number(monto *(dsc_ap_ss/100)).toFixed(2);
    let dsc_ap_fonavi_monto = Number(monto *(dsc_ap_fonavi/100)).toFixed(2);
    let dsc_ap_pension_monto = Number(monto *(dsc_ap_pension/100)).toFixed(2);

    let prc1 = Number(monto *0.01).toFixed(2);
    let prc3 = Number(monto *0.03).toFixed(2);
    let prc6 = Number(monto *0.06).toFixed(2);
    //let total_empleador = Number(prc6 * 3).toFixed(2);
    //let total_trabajador = (Number(prc3) * 2  + Number(prc1)).toFixed(2);
    $('.porcentaje_6').html(prc6);
    $('.porcentaje_3').html(prc3);
    $('.porcentaje_1').html(prc1);


    $('.dsc_at_ss_monto').html(dsc_at_ss_monto);
    $('.dsc_at_fonavi_monto').html(dsc_at_fonavi_monto);
    $('.dsc_at_pension_monto').html(dsc_at_pension_monto);
    $('.dsc_ap_ss_monto').html(dsc_ap_ss_monto);
    $('.dsc_ap_fonavi_monto').html(dsc_ap_fonavi_monto);
    $('.dsc_ap_pension_monto').html(dsc_ap_pension_monto);
    let total_trabajador = (Number(dsc_at_ss_monto) + Number(dsc_at_fonavi_monto) + Number(dsc_at_pension_monto)).toFixed(2);
    let total_empleador  = (Number(dsc_ap_ss_monto) + Number(dsc_ap_fonavi_monto) + Number(dsc_ap_pension_monto)).toFixed(2);

    if(isNaN(monto)){
        $('.monto_mes_total').html(0);
    }else {
        $('.monto_mes_total').html(monto);
    }



    $('#total_dsc_empleador').html(total_empleador);
    $('#total_dsc_trabajador').html(total_trabajador);
    $('#mdltitulodsc').html('Descuento de Boleta');
    $('#modalboletasdsc').modal('show');
}

//btnboletas_dsc ya no se usa
$(document).on("click","#btnboletas_dsc", function(){
    calcularTotalBoleta();
    let dsc_at_ss = $('#at_ss').val();
    let dsc_at_fonavi = $('#at_fonavi').val();
    let dsc_at_pension = $('#at_pension').val();
    let dsc_ap_ss = $('#ap_ss').val();
    let dsc_ap_fonavi = $('#ap_fonavi').val();
    let dsc_ap_pension = $('#ap_pension').val();
    let monto = Number($('#total_monto_boleta').val());

    let dsc_at_ss_monto = Number(monto *(dsc_at_ss/100)).toFixed(2);
    let dsc_at_fonavi_monto = Number(monto *(dsc_at_fonavi/100)).toFixed(2);
    let dsc_at_pension_monto = Number(monto *(dsc_at_pension/100)).toFixed(2);
    let dsc_ap_ss_monto = Number(monto *(dsc_ap_ss/100)).toFixed(2);
    let dsc_ap_fonavi_monto = Number(monto *(dsc_ap_fonavi/100)).toFixed(2);
    let dsc_ap_pension_monto = Number(monto *(dsc_ap_pension/100)).toFixed(2);

    let prc1 = Number(monto *0.01).toFixed(2);
    let prc3 = Number(monto *0.03).toFixed(2);
    let prc6 = Number(monto *0.06).toFixed(2);
    //let total_empleador = Number(prc6 * 3).toFixed(2);
    //let total_trabajador = (Number(prc3) * 2  + Number(prc1)).toFixed(2);
    $('.porcentaje_6').html(prc6);
    $('.porcentaje_3').html(prc3);
    $('.porcentaje_1').html(prc1);


    $('.dsc_at_ss_monto').html(dsc_at_ss_monto);
    $('.dsc_at_fonavi_monto').html(dsc_at_fonavi_monto);
    $('.dsc_at_pension_monto').html(dsc_at_pension_monto);
    $('.dsc_ap_ss_monto').html(dsc_ap_ss_monto);
    $('.dsc_ap_fonavi_monto').html(dsc_ap_fonavi_monto);
    $('.dsc_ap_pension_monto').html(dsc_ap_pension_monto);
    let total_trabajador = (Number(dsc_at_ss_monto) + Number(dsc_at_fonavi_monto) + Number(dsc_at_pension_monto)).toFixed(2);
    let total_empleador  = (Number(dsc_ap_ss_monto) + Number(dsc_ap_fonavi_monto) + Number(dsc_ap_pension_monto)).toFixed(2);

    if(isNaN(monto)){
        $('.monto_mes_total').html(0);
    }else {
        $('.monto_mes_total').html(monto);
    }



    $('#total_dsc_empleador').html(total_empleador);
    $('#total_dsc_trabajador').html(total_trabajador);
    $('#mdltitulodsc').html('Descuento de Boleta');
    $('#modalboletasdsc').modal('show');
    
});

function boleta_desc_info(e){
    let estado = $('select[name="select_mes_boletas'+e+'"] option:selected').text();
    let estado_anio = $('select[name="select_anio_boletas'+e+'"] option:selected').text();
    let mes_completo = "";
    let estado_dsc = $("#select_mes_boletas"+ e).val();
    switch (estado_dsc) {
        case 'ene':
            mes_completo = "01";
            break;
        case 'feb':
            mes_completo = "02";
            break;
        case 'mar':
            mes_completo = "03";
            break; 
        case 'abr':
            mes_completo = "04";
            break; 
        case 'may':
            mes_completo = "05";
            break; 
        case 'jun':
            mes_completo = "06";
            break; 
        case 'jul':
            mes_completo = "07";
            break; 
        case 'ago':
            mes_completo = "08";
            break; 
        case 'sep':
            mes_completo = "09";
            break; 
        case 'oct':
            mes_completo = "10";
            break; 
        case 'nov':
            mes_completo = "11";
            break; 
        case 'dic':
            mes_completo = "12";
            break;
    }
    
    let estado_anio_dsc = $("#select_anio_boletas"+ e).val();
    let fecha_consulta = estado_anio_dsc+'-'+mes_completo+'-01';
    //console.log(fecha_consulta);
    //CONSULTA DE MES 
    $.post("../../controller/pensioncontrolador.php?op=buscar_mes",{fecha : fecha_consulta}, function(data){
        //console.log(data);
        if(data != ""){
            data = JSON.parse(data);
            //console.log(data);
            $('#at_ss'+ e).val(data.at_ss);
            $('#at_fonavi'+ e).val(data.at_pro_desocup);
            $('#at_pension'+ e).val(data.at_fondo_juvi);
            $('#ap_ss'+ e).val(data.ap_ss);
            $('#ap_fonavi'+ e).val(data.ap_fonavi);
            $('#ap_pension'+ e).val(data.ap_fondo_juvi);
            $('#sueldo_boleta'+ e).val(data.sueldo_minimo);
            $('#sueldo_boleta_info').val(data.sueldo_minimo);
            $('#dsc_at_ss').html(data.at_ss +'%');
            $('#dsc_at_fonavi').html(data.at_pro_desocup+'%');
            $('#dsc_at_pension').html(data.at_fondo_juvi+'%');
            $('#dsc_ap_ss').html(data.ap_ss+'%');
            $('#dsc_ap_fonavi').html(data.ap_fonavi+'%');
            $('#dsc_ap_pension').html(data.ap_fondo_juvi+'%');
        }
    });

    $('#mdltitulo_info').html('Boleta Actual - '+ estado.toUpperCase()+ ' - '+ estado_anio);
    $('#modalboleta_info').modal('show');

}

//btnboletas dsc mes , ya no se usa
$(document).on("click","#btnboletas_dsc_mes", function(){
    

    let estado = $('select[name="select_mes_boletas"] option:selected').text();
    let estado_anio = $('select[name="select_anio_boletas"] option:selected').text();
    let mes_completo = "";
    let estado_dsc = $("#select_mes_boletas").val();
    switch (estado_dsc) {
        case 'ene':
            mes_completo = "01";
            break;
        case 'feb':
            mes_completo = "02";
            break;
        case 'mar':
            mes_completo = "03";
            break; 
        case 'abr':
            mes_completo = "04";
            break; 
        case 'may':
            mes_completo = "05";
            break; 
        case 'jun':
            mes_completo = "06";
            break; 
        case 'jul':
            mes_completo = "07";
            break; 
        case 'ago':
            mes_completo = "08";
            break; 
        case 'sep':
            mes_completo = "09";
            break; 
        case 'oct':
            mes_completo = "10";
            break; 
        case 'nov':
            mes_completo = "11";
            break; 
        case 'dic':
            mes_completo = "12";
            break;
    }
    
    let estado_anio_dsc = $("#select_anio_boletas").val();
    let fecha_consulta = estado_anio_dsc+'-'+mes_completo+'-01';
    //console.log(fecha_consulta);
    //CONSULTA DE MES 
    $.post("../../controller/pensioncontrolador.php?op=buscar_mes",{fecha : fecha_consulta}, function(data){
        //console.log(data);
        if(data != ""){
            data = JSON.parse(data);
            //console.log(data);
            $('#at_ss'+ e).val(data.at_ss);
            $('#at_fonavi'+ e).val(data.at_pro_desocup);
            $('#at_pension'+ e).val(data.at_fondo_juvi);
            $('#ap_ss'+ e).val(data.ap_ss);
            $('#ap_fonavi'+ e).val(data.ap_fonavi);
            $('#ap_pension'+ e).val(data.ap_fondo_juvi);
            $('#sueldo_boleta').val(data.sueldo_minimo);
            $('#sueldo_boleta_info').val(data.sueldo_minimo);
            $('#dsc_at_ss').html(data.at_ss +'%');
            $('#dsc_at_fonavi').html(data.at_pro_desocup+'%');
            $('#dsc_at_pension').html(data.at_fondo_juvi+'%');
            $('#dsc_ap_ss').html(data.ap_ss+'%');
            $('#dsc_ap_fonavi').html(data.ap_fonavi+'%');
            $('#dsc_ap_pension').html(data.ap_fondo_juvi+'%');
        }
    });

    $('#mdltitulo_info').html('Boleta Actual - '+ estado.toUpperCase()+ ' - '+ estado_anio);
    $('#modalboleta_info').modal('show');
});

$(document).on("click","#btnboletas", function(){
    $('#mdltitulo').html('Tabla de Boletas');
    $('#modalboletas').modal('show');
    $('#select_mes_boletas').select2("val", "0");
    SumarMeses();
});

$(document).on("click","#btnclosemodal", function(){

    $("#modalboletas").modal('hide');
});

$(document).on("click","#btnclosemodaldsc", function(){

    $("#modalboletasdsc").modal('hide');
});

$(document).on("click","#btnclosemodal_info", function(){

    $("#modalboleta_info").modal('hide');
});

function PrevCertificado(e) {

    console.log("PrevCertificado : " + e );


    let fecha = $('#fecha_certificado'+ e).val();
    let fechaloc = new Date(fecha);
    var fechaimod = fechaloc.toLocaleString('en-US', {
        timeZone: 'Europe/London'
    });
    var fecha_emi = new Date(fechaimod);
    let fecha_fin = $('#fech_final_emp'+e).val();
    let fecha_ff = new Date (fecha_fin);


    if(fecha_emi >= fecha_ff && fecha != "" ){
        OcultarPrev();
        let tipoprev = $('#select_certificado'+ e).val();
        $("#prev_certificado_"+tipoprev).show();
       
        $("#prev1").show();
        $("#prev2").hide();
        $("#prev3").hide();
        $("#prev5").hide();
        var options = { year: 'numeric', month: 'long', day: 'numeric' };

        //DATOS  nombre completo, Finicio, Ffinal, Cargo, firmante
        let nom = $('#nombre_emp'+ e).val();
        let cargo = $('#cargo_emp'+ e).val();
        let fechai = $('#fech_inicio_emp'+ e).val();
        let fechaf = $('#fech_final_emp'+ e).val();
        let dpto1 = $('#dpto_emp'+ e).val();
        let logos = $('#logo_nombre'+ e).val();
        let firm = $('#firmante_emp'+ e).val();
        let ruc = $('#ruc_emp'+ e).val();
        let fecha1 = new Date(fechai);
        let fecha2 = new Date(fechaf);
        let fecha1num = moment(fecha1).format('DD-MM-YYYY');
        let fecha2num = moment(fecha2).format('DD-MM-YYYY');
        
        //Asignar datos
        $('.emp_imp').html(nom);
        $('.cargo_imp').html(cargo);
        $('.ruc_imp').html(ruc);
        $('.desde_imp').html(fecha1.toLocaleDateString("es-ES", options).toUpperCase());
        $('.hasta_imp').html(fecha2.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_num').html(fecha1num);
        $('.hasta_imp_num').html(fecha2num);
        $('.lugardia').html(dpto1+", "+fecha_emi.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_low').html(fecha1.toLocaleDateString("es-ES", options));
        $('.hasta_imp_low').html(fecha2.toLocaleDateString("es-ES", options));
        $('.lugardia_low').html(dpto1+", "+fecha_emi.toLocaleDateString("es-ES", options));
        //$('.tiempo_total_imp').html(temp);
        $('.img_logo').attr("src","../../assets/img/"+logos);
        $('.firmante_nom').html(firm);
        $('.departamento_imp').html(dpto1.toUpperCase());
        $('.cargo_imp_low').html(cargo.toLowerCase());
    }else {
        swal.fire(
            'Fecha de emision incorrecta',
            '',
            'error'
        );
    }

    
}

//METODO EN DESUSO
$(document).on("click","#btnprevcer", function(){

    OcultarPrev();
    let tipoprev = $('#select_certificado').val();
    
    $("#prev_certificado_"+tipoprev).show();
});

$(document).on("click","#btnlimpiar", function(){
    $("#divresultado").hide();
    $('#pension_form')[0].reset();
    $('#cargoc').select2("val", "0");
    $('#txtdate').val("");
    $('#cant_emp').select2("val", "0");
    $('#af_id').val('');
    $('#tipo_doc').select2("val", "0");
    //$('#btnautogenerar').attr('disabled', false);
    $("#contemp1").hide();
    $('#temp_servicio').hide();
    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
});

document.addEventListener("DOMContentLoaded", function() {
    var headers = document.querySelectorAll(".acordeon-header");

    headers.forEach(function(header) {
        header.addEventListener("click", function() {
            var texto = this.textContent.trim(); // Obtén el texto del encabezado
            copiarAlPortapapeles(texto);
        });
    });

    function copiarAlPortapapeles(texto) {
        var textarea = document.createElement("textarea");
        textarea.value = texto;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);
        
        // Mostrar una alerta de SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Texto copiado al portapapeles',
            text: texto,
            showConfirmButton: false,
            timer: 1500
        });
    }
});

function DescargarZip(){
    console.log("Descargar ZIP");

    var num_doc             = $('#num_doc').val();
    var nom_carpeta         = "PENSIONES-"+ num_doc;
    var nombre              = $('#txtnombre').val();
    var apellido            = $('#txtapellido').val();
    var nombre_com          = nombre + ' ' + apellido;

    // Realizar la solicitud AJAX
    $.ajax({
        url: "../../controller/docs/certificadosword.php",
        method: "POST", // Método HTTP (GET, POST, PUT, DELETE, etc.)
        data: {
            nombre_carpeta:  nom_carpeta,
            afiliado: nombre_com
        },
        dataType: "json",
        success: function (data) {
            // La función que se ejecutará si la solicitud tiene éxito
            //console.log("Datos recibidos:", data);
            if(data.status == 0){
                //console.log(data.data.file_zip);
                 // URL del archivo que deseas descargar
                var url = '../../files/zips/'+data.data.file_zip;

                // Crear un elemento <a> oculto
                var link = document.createElement('a');
                link.href = url;
                link.download = data.data.file_zip; // Nombre del archivo para descargar
                link.style.display = 'none';

                // Añadir el elemento <a> al DOM
                document.body.appendChild(link);

                // Simular un clic en el enlace para iniciar la descarga
                link.click();

                // Eliminar el elemento <a> del DOM después de la descarga
                document.body.removeChild(link);
            }
        },
        error: function (error) {
            // La función que se ejecutará si hay un error en la solicitud
            console.error("Error en la solicitud:", error);
        }
    });
}

function PrevRenuncia(e) {

    let fecha = $('#fecha_renuncia'+ e).val();
    let fechaloc = new Date(fecha);
    var fechaimod = fechaloc.toLocaleString('en-US', {
        timeZone: 'Europe/London'
    });
    var fecha_emi = new Date(fechaimod);
    let fecha_fin = $('#fech_final_emp'+e).val();
    let fecha_ff = new Date (fecha_fin);


    if(fecha_emi <= fecha_ff && fecha != "" ){

        OcultarPrev();
        $('#prev5').show();
        let tipoprev = $('#select_renuncia'+e).val();
        $("#prev_renuncia_"+tipoprev).show();

        var options = { year: 'numeric', month: 'long', day: 'numeric' };

        //DATOS  nombre completo, Finicio, Ffinal, Cargo, firmante
        let nom = $('#nombre_emp'+ e).val();
        let cargo = $('#cargo_emp'+ e).val();
        let fechai = $('#fech_inicio_emp'+ e).val();
        let fechaf = $('#fech_final_emp'+ e).val();
        let dpto1 = $('#dpto_emp'+ e).val();
        let logos = $('#logo_nombre'+ e).val();
        let firm = $('#firmante_emp'+ e).val();
        var num_doc = $('#num_doc').val();
        let fecha1 = new Date(fechai);
        let fecha2 = new Date(fechaf);
        let fecha1num = moment(fecha1).format('DD-MM-YYYY');
        let fecha2num = moment(fecha2).format('DD-MM-YYYY');
        
        //Asignar datos
        $('.emp_imp').html(nom);
        $('.cargo_imp').html(cargo);
        $('.dni_imp').html(num_doc);

        $('.desde_imp').html(fecha1.toLocaleDateString("es-ES", options).toUpperCase());
        $('.hasta_imp').html(fecha2.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_num').html(fecha1num);
        $('.hasta_imp_num').html(fecha2num);
        $('.lugardia').html(dpto1+", "+ fecha_emi.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_low').html(fecha1.toLocaleDateString("es-ES", options));
        $('.hasta_imp_low').html(fecha2.toLocaleDateString("es-ES", options));
        $('.lugardia_low').html(dpto1+", "+ fecha_emi.toLocaleDateString("es-ES", options));
        //$('.tiempo_total_imp').html(temp);
        $('.img_logo').attr("src","../../assets/img/"+logos);
        $('.firmante_nom').html(firm);
        $('.departamento_imp').html(dpto1.toUpperCase());
        $('.cargo_imp_low').html(cargo.toLowerCase());
    }else {
        swal.fire(
            'Fecha de emision incorrecta',
            '',
            'error'
        );
    }
    
}

function Imprimir_renuncia(){
    //console.log("Imprimir");
    let e = $('#num_emp').val();// se asigna al seleccinar la empresa en el tab

    if(e == ""){
        e = 1;
    }
    let dni = $('#num_doc').val();
    let nombres = $('#txtnombre').val();
    let apellidos = $('#txtapellido').val();
    var nombreArchivo ="Renuncia "+ dni + " " + nombres + " " + apellidos;
    let tipoprev = $('#select_renuncia'+e).val();
    var ficha = document.getElementById('contenido_renuncia_'+tipoprev);
    var ventimp1 = window.open('', 'Imprimir');
    ventimp1.document.write('<html><head><title>'+nombreArchivo+'</title>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/css/bracket.css"></link>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/lib/bootstrap5/bootstrap.min.css">');
    ventimp1.document.write('<style> .certificado_imp{ padding-left: 50px; padding-right: 50px;}</style>');
    ventimp1.document.write('<style> .divimagen{ padding: 30px 150px;}</style>');
    ventimp1.document.write('</head><body >');
    ventimp1.document.write(ficha.innerHTML);
    ventimp1.document.write('</body></html>');
    ventimp1.document.close();
    ventimp1.focus();    
    
    ventimp1.onload = function() {
        ventimp1.print();
        ventimp1.close();
    };
}

function imprimir_word_renuncia(e){
    var tipo = $('#tipo_emp').val();
    let tipoprev = $('#select_renuncia' + e).val();
    let nombreruta = 'renuncia_'+tipoprev;
    var nombre = $('#txtnombre').val();
    var apellido = $('#txtapellido').val();
    var nombre_emp = $('#nom_emp_lab' + e).html();
    var nombre_com = nombre + ' ' + apellido;
    var num_doc = $('#num_doc').val();
    var nom_carpeta = "PENSIONES-"+ e +"-"+ num_doc;
    var fecha_inicio = $('.desde_imp').html();
    var fecha_hasta = $('.hasta_imp').html();
    var fecha_inicio_num = $('.desde_imp_num').html();
    var fecha_hasta_num = $('.hasta_imp_num').html();
    var lugar_dia = $('.lugardia').html();
    var cargo = $('#cargo_emp'+ e).val();
    var logo = $('#logo_nombre'+ e).val();
    var firmante = $('.firmante_nom').html();
    var link = '../../controller/docs/renuncia_'+tipoprev+'.php';
    var ruc = $('#ruc_emp'+ e).val();

    $.ajax({
        type: "POST",
        url: link,
        data : {
            empresa : nombre_emp,
            afiliado: nombre_com,
            nombre_carpeta : nom_carpeta,
            fecha_inicio : fecha_inicio,
            fecha_final: fecha_hasta,
            fecha_inicio_num : fecha_inicio_num,
            fecha_final_num : fecha_hasta_num,
            fecha_footer : lugar_dia,
            cargo : cargo,
            tipo : tipo,
            logo : logo,
            firmante : firmante,
            ruc: ruc,
            dni: num_doc
        },
        success: function(response){

            console.log(response);
            resp = JSON.parse(response);
            if(resp.estado == 1){
                    swal.fire(
                        'Documento generado exitosamente',
                        '',
                        'success'
                    );
            }
            // URL del archivo que deseas descargar
            var url = '../../files/'+nom_carpeta+'/'+resp.archivo+'.docx';

            // Crear un elemento <a> oculto
            var link = document.createElement('a');
            link.href = url;
            link.download = resp.archivo+'-'+num_doc; // Nombre del archivo para descargar
            link.style.display = 'none';

            // Añadir el elemento <a> al DOM
            document.body.appendChild(link);

            // Simular un clic en el enlace para iniciar la descarga
            link.click();

            // Eliminar el elemento <a> del DOM después de la descarga
            document.body.removeChild(link);
        }
    });

}

function MostrarFirmante(e){
    console.log(e);
    let ruc = $('#lst_emp_'+ e).val();
    console.log("El ruc de la empresa es : "+ ruc);
    $('#num_empresa').val(e);
    $('#modalfirmante').modal('show');

    $.ajax({
        type: "POST",
        url: "../../controller/firmacontrolador.php?op=grilla", // Reemplaza con la URL correcta del servidor
        data: {numero : ruc},
        success: function(response) {
            // Manejar la respuesta exitosa del servidor
            //console.log("Respuesta del servidor:", response);
            $('#div_firmante').html(response);
        },
        error: function(error) {
            // Manejar errores en la solicitud
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}

function MostrarDireccion(e){
    console.log(e);
    let ruc = $('#lst_emp_'+ e).val();
    console.log("El ruc de la empresa es : "+ ruc);
    $('#num_empresa').val(e);
    $('#modaldireccion').modal('show');

    $.ajax({
        type: "POST",
        url: "../../controller/direccioncontrolador.php?op=grilla", // Reemplaza con la URL correcta del servidor
        data: {ruc : ruc},
        success: function(response) {
            // Manejar la respuesta exitosa del servidor
            //console.log("Respuesta del servidor:", response);
            $('#div_direccion').html(response);
        },
        error: function(error) {
            // Manejar errores en la solicitud
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}

function SeleccionarFirmante(){
    let firmante = $("input[name='firmante']:checked").val();
    let num = $('#num_empresa').val();
    $('#firmante'+ num).val(firmante);
    $('#modalfirmante').modal('hide');
}

function SeleccionarDireccion(){
    let direccion = $("input[name='direccion_emp']:checked").val();
    let num = $('#num_empresa').val();
    $('#direccion'+ num).val(direccion);
    $('#modaldireccion').modal('hide');
}

function CerrarFirmante() {
    $('#modalfirmante').modal('hide');
}

function CerrarDireccion() {
    $('#modaldireccion').modal('hide');
}

function CerrarFirmanteActualizar() {
    $('#modalactualizar').modal('hide');
}

function ActualizarEmp(e){

    var ruc_emp = $('#lst_emp_'+ e).val();
    $('#num_tab').val(e);
    console.log(ruc_emp);

    if( ruc_emp !== null  && ruc_emp !== '' ){
        // Realizar la solicitud AJAX
        $.ajax({
            type: "POST",  // Método de la solicitud
            url: "../../controller/pensioncontrolador.php?op=consulta_api_sunat",  // Ruta de tu archivo PHP en el servidor
            data: { ruc : ruc_emp},  // Datos que se enviarán al servidor
            dataType: 'json',  // Tipo de datos esperados en la respuesta
            async : false,
            success: function(response) {
                // Manejar la respuesta exitosa del servidor
                //console.log(response);
                if(response.success == true){
                    
                    //Mostrar Datos de Empresa
                    let dat_emp = response.result;
                    $('#lb_razon').html(dat_emp.razon_social);
                    $('#lb_ruc').html(dat_emp.ruc)
                    $('#lb_direccion').html(dat_emp.direccion);
                    $('#lb_depa').html(dat_emp.departamento);
                    $('#lb_prov').html(dat_emp.provincia);
                    $('#lb_dist').html(dat_emp.distrito);
                    $('#lb_estado').html(dat_emp.estado);
                    $('#lb_condicion').html(dat_emp.condicion);
                    $('#lb_fecha_ini').html(dat_emp.inicio_actividades);

                    //Obtener Fecha Fin
                    let fechaFinEmp = generarFechaAleatoria();
                    $('#lb_fecha_fin').html(fechaFinEmp);

                    //Almacenar datos en mi json;
                    datos_empresa = {
                        razon : dat_emp.razon_social,
                        ruc_emp : dat_emp.ruc,
                        direccion: dat_emp.direccion,
                        departamento: dat_emp.departamento,
                        provincia : dat_emp.provincia,
                        distrito : dat_emp.distrito,
                        estado : dat_emp.estado,
                        condicion : dat_emp.condicion,
                        fecha_inicio : dat_emp.inicio_actividades,
                        fecha_fin : fechaFinEmp
                    };

                    //Mostrar Los Representantes Legales
                    let rep_le = response.result.representantes_legales;
                    datos_firmantes = response.result.representantes_legales;
                    let orden = 1;
                    let divs = "";

                    if(rep_le != false){
                        rep_le.forEach(function(rep){
                            divs+= `<tr>
                                        <td style='vertical-align: middle;'>${orden++}</td>
                                        <td style='vertical-align: middle;'>${rep.tipodoc}</td>
                                        <td style='vertical-align: middle;'>${rep.numdoc}</td>
                                        <td style='vertical-align: middle;'>${rep.nombre}</td>
                                        <td style='vertical-align: middle;'>${rep.cargo}</td>
                                        <td style='vertical-align: middle;'>${rep.desde}</td>
                                    </tr>`;
                        });
                        
                    }else {
                        divs = `<tr><td colspan="6">SIN RESULTADOS</td></tr>`;
                    }

                    $('#div_firmante_actualizar').html(divs);
                    $('#modalactualizar').modal('show');
                    $('#ruc_empresa_firmante').val(ruc_emp);
                }else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Sin resultados',
                        text: ''
                    });
                }
            },
            error: function(error) {
            // Manejar errores en la solicitud
                console.error('Error en la solicitud AJAX:', error);
                Swal.fire({
                    icon: 'warning',
                    title: 'Sin Resultados',
                    text: ''
                });
            }
        });
    }else {
        Swal.fire({
            title: 'No se ha seleccionado ninguna empresa',
            text: '',
            icon: 'warning',
            showConfirmButton: false, // Sin botón de confirmación
            timer: 1500, // Tiempo en milisegundos (1 segundo)
          });
    }
    
}

function ActualizarFirmante(){
    //console.log(datos_firmantes);

    // Convertir el JSON a una cadena de texto
    var datosJSONEmp = JSON.stringify(datos_empresa);
    var datosJSON = JSON.stringify(datos_firmantes);
    var ruc_empresa = $('#ruc_empresa_firmante').val();
    var num = $('#num_tab').val();

   
    // Realizar la solicitud AJAX
    $.ajax({
        type: 'POST',
        url: '../../controller/firmacontrolador.php?op=update_firmante',
        data: { datos: datosJSON, ruc :  ruc_empresa, datos_emp : datosJSONEmp},
        //dataType: 'json',
        success: function(response) {
            console.log('Éxito:', response);
            Swal.fire({
                icon: 'success',
                title: 'Datos Actualizados',
                text: ''
            });
            $('#modalactualizar').modal('hide');
            mostrardetalle(num, ruc_empresa, 1);
            
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}

function generarFechaAleatoria() {
    // Establecer la fecha de inicio y fin
    const fechaInicio = moment('1999-01-01', 'YYYY-MM-DD');
    const fechaFin = moment('1999-12-30', 'YYYY-MM-DD');

    // Calcular la diferencia en días entre las dos fechas
    const diferenciaDias = fechaFin.diff(fechaInicio, 'days');

    // Generar un número aleatorio de días entre 0 y la diferencia
    const diasAleatorios = Math.floor(Math.random() * (diferenciaDias + 1));

    // Agregar esos días a la fecha de inicio
    const fechaAleatoria = fechaInicio.add(diasAleatorios, 'days');

    // Formatear la fecha como "DD-MM-YYYY"
    const fechaFormateada = fechaAleatoria.format('DD-MM-YYYY');

    // Devolver la fecha formateada
    return fechaFormateada;
}

function ValidarFecha(input){
    var valorInput = $(input).val();
    var fechaSeleccionada = new Date(valorInput);
    var diaSemana = fechaSeleccionada.getDay();

    // Eliminar los estilos y el mensaje de error antes de hacer la nueva validación
    $(input).removeClass('input-error');
    $(input).next('.error-msg').text('');

    if (diaSemana === 5 || diaSemana === 6) {
        // Agregar clase de estilo y mensaje de error
        $(input).addClass('input-error');
        $(input).next('.error-msg').text('Fecha Invalida');
    }
}

function RegistrarEmpresaUsada(ruc){
    // Realizar la solicitud AJAX
    $.ajax({
        type: 'POST',
        url: '../../controller/empresacontrolador.php?op=update_busqueda_empresa',
        data: { ruc :  ruc},
        success: function(response) {
            console.log('Éxito:', response);
            /*Swal.fire({
                icon: 'success',
                title: 'Datos Actualizados',
                text: ''
            });*/
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}


init();