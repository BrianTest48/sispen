var suma_anios = 0;
var suma_meses = 0;
var suma_dias = 0;

var suma_anios1 = 0;
var suma_meses1 = 0;
var suma_dias1 = 0;

var anios_bono = 0;
var meses_bono = 0;
var dias_bono = 0;

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

    //Ocualtar Campos y divs
    OcultarPrev();
    $("#divresultado").hide();
    $("#form_datos").hide();
    $("#resultado_pdf").hide();
    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev4").hide();
    $("#prev5").hide();
    $("#contemp1").hide();
    $('#temp_servicio').hide();
    $('#tabs-empresas').hide();
    //$("#nav-bono").hide();
    $('#btnguardarpension').hide();
    $('#btnzipear').hide();

    //Select2 a todos los combobox
    $('#tipo_doc').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });



    //Cuando se edita la Lista
    var listaId = getParameterByName('lista');

    if(listaId == ""){
        //console.log("VACIO");
        alerta_uso = 0;
    }else {
        alerta_uso = 1;
        //Metodo Mostrar Lista ID
        $.post("../../controller/listacontrolador.php?op=mostrar_id",{ lista_id : listaId},function(datos){
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
    $("#bono_form").on("submit",function(e){
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
    var formData = new FormData($("#bono_form")[0]);
    let cant_anios = $('#txtcant_anios').val();
    afid = $("#af_id").val();
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
            //console.log(data);
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
            activarcargos();
            crearTabs(cnt);
            $("#divresultado").show();
            $('#btnguardarpension').show();
            $('#btnzipear').show();
            $('#tabs-empresas').show();

            //Ocultar por default el mensaje alerta
            $('.error-label').hide();

            $('.select_mes_boleta').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.select_certificado').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.select_renuncia').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.combo_prev_bono').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.combo_prev_boleta').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.combo_prev_liqui').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.select_anio_boletas').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            $('.select_fondo').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });

            //Ocultar contenedores
            $('.contenedores_emp').hide();

            //Recuperar datos del combo MOTIVO CESE
            $.post("../../controller/motivocontrolador.php?op=combo",{},function(data){
                $('.combo_prev_liqui').html(data);
            });

            //Recuperar datos del combo Fondo
            $.post("../../controller/fondocontrolador.php?op=combo",{},function(data){
                $('.select_fondo').html(data);
            }); 

            /** SETEAR FECHAS A LOS DIV */
            let fnac = $('#txtdate').val();
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
                    let cant = datos.cantidad;
                    for( let i = 1 ; i <= cant ; i++){
                        $("#f_inicio_"+i).val(datos["fech"+i]);
                        $("#f_final_"+i).val(datos["fech_final_"+i]);
                        $("#cbx_tipo_"+i).val(datos["tipo_"+i]).trigger('change');
                        $("#cbx_base_"+ i).val(datos["base_"+i]).trigger('change');
                        $('#cbx_estado_'+ i).val(datos["estado_"+i]).trigger('change');
                        $('#cbx_condicion_'+ i).val(datos["condicion_"+i]).trigger('change');
                        //mostrardetalle(i, 0, 0);
                        //BuscarEmp(i);
                        BuscarEmp_inicio(i, datos["ruc"+i]);

                        setTimeout(function() {
                            //console.log("Despues de 1 segundo");
                            $("#cargoc"+i).val(datos["cargo"+i]).trigger('change');
                            $("#logo"+i).val(datos["logo"+i]).trigger('change');
                            $("#lst_emp_"+i).val(datos["ruc"+i]).trigger('change');
                            $("#firmante"+i).val(datos["firmante"+i]);
                            mostrardetalle(i, datos["ruc"+i], 1);
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
                        //DJ
                        $('#num_auto'+ i).val(dato_empresa.Dj.num_aleatorio);
                        $('#dic_91'+ i).val(dato_empresa.Dj.dic_91);
                        $('#ene_92'+ i).val(dato_empresa.Dj.ene_92);
                        $('#feb_92'+ i).val(dato_empresa.Dj.feb_92);
                        $('#mar_92'+ i).val(dato_empresa.Dj.mar_92);
                        $('#abr_92'+ i).val(dato_empresa.Dj.abr_92);
                        $('#may_92'+ i).val(dato_empresa.Dj.may_92);
                        $('#jun_92'+ i).val(dato_empresa.Dj.jun_92);
                        $('#jul_92'+ i).val(dato_empresa.Dj.jul_92);
                        $('#ago_92'+ i).val(dato_empresa.Dj.ago_92);
                        $('#sep_92'+ i).val(dato_empresa.Dj.sep_92);
                        $('#oct_92'+ i).val(dato_empresa.Dj.oct_92);
                        $('#nov_92'+ i).val(dato_empresa.Dj.nov_92);
                        $('#combo_prev_bono'+ i).val(dato_empresa.Dj.modelo).trigger('change');
                    }

                    $('#prev1').hide();
                    //mostrardetalle(1, datos["ruc1"], 1);
                    //$("#logo1").val(datos["logo1"]).trigger('change');
                    //$(".firmante_nom").html(datos["firmante1"]);
                    //console.log(datos["firmante1"]);
                    //$('#btnmostrarempr_1').click();
                    //sumarfechas();
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
        var tabContent = '<div class="tab-pane fade" id="content' + i + '"><input type="hidden" id="num_emp"><input type="hidden" id="tiempo_imp'+i+'">';
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
        tabContent += '             <button class="nav-link active btn-outline-secondary btn-block mg-b-10 "  id="orcinea-tab'+ i +'"  data-bs-toggle="pill" data-bs-target="#certificado'+ i +'" type="button" role="tab" aria-controls="certificado"  aria-selected="true" >Certificado</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link  btn-outline-secondary btn-block mg-b-10 " id="host-tab'+ i +'"     data-bs-toggle="pill" data-bs-target="#liquidacion'+ i +'"    type="button" role="tab" aria-controls="liquidacion"     aria-selected="false">Liquidacion</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link  btn-outline-secondary btn-block mg-b-10 " id="boleta-tab'+ i +'"  onclick="boleta_tab('+ i +')"  data-bs-toggle="pill" data-bs-target="#boleta'+ i +'"  type="button" role="tab" aria-controls="boleta"   aria-selected="false">Boleta</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link btn-outline-secondary btn-block mg-b-10 " id="renuncia-tab'+ i +'"   data-bs-toggle="pill" data-bs-target="#renuncia'+ i +'"  type="button" role="tab" aria-controls="renuncia"   aria-selected="false" >Renuncia</button>';
        tabContent += '         </li>';
        //Li nav item nav bono
        tabContent += '         <li class="nav-item" role="presentation" id="nav-bono'+ i +'">';
        tabContent += '             <button class="nav-link  btn-outline-secondary btn-block mg-b-10 " id="bono-tab'+ i +'"  onclick="bono_tab('+ i +')"  data-bs-toggle="pill" data-bs-target="#bono'+ i +'"  type="button" role="tab" aria-controls="bono"   aria-selected="false">DJ</button>';
        tabContent += '         </li>';
        //fin nav li
        tabContent += '     </ul>';
        tabContent += '     <div class="tab-content">';
        tabContent += '         <!-- AQUI VA EL CONTENIDO -->';
        tabContent += '         <div id="certificado'+i+'" class="tab-pane fadein show active">';
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
        tabContent += '                                     <input type="date" oninput="ValidarFecha(this)" class="form-control "  id="fecha_certificado'+ i +'"  style="width: 100%"/>';
        tabContent += '                                     <div class="error-msg"></div>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Fondo: </label>';
        tabContent += '                                 <div class="col-lg-6 pd-0">';
        tabContent += '                                     <select class="form-control col-lg-6 select2 select_fondo" data-placeholder="Seleccione" id="select_fondo'+ i +'"  style="width: 100%" >';        
        tabContent += '                                     </select>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                         </div> ';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row justify-content-end">';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="" class="btn btn-info" onclick="imprimir_word('+ i +')" style="width: 100%">Descargar en Word</button>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnprevcer_bono'+ i +'" name="btnprevcer_bono" onclick="PrevCertificado('+ i +')"  class="btn btn-secondary" style="width: 100%">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
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
        tabContent += '                                 <input class="form-control col-lg-6  liqui_bonif'+ i +'" type="number" name="ADELANTO" id="adelanto'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Vacaciones:</label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="VACACIONES" id="vacaciones'+ i +'" value="0" placeholder="" required>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Gratificaciones: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 liqui_bonif'+ i +'" type="number" name="GRATIFICACIONES" id="gratificaciones'+ i +'" value="0" placeholder="" required>';
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
        tabContent += '                             <button type="button" id="btnprevli'+ i +'" name="btnprevli" onclick="PrevLiquidacion('+ i +')"  class="btn btn-secondary" style="width:100%">  Previsualizar  </button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                 </div>';
        tabContent += '             </form>';
        tabContent += '         </div>';
        tabContent += '         <div id="boleta'+ i +'" class="tab-pane fade">';
        tabContent += '             <form id="form_bol'+ i +'" action="" method="post" autocomplete="off">';
        tabContent += '                 <div class="form-layout form-layout-1">';
        tabContent += '                     <div class="row justify-content-around">';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnboletas'+ i +'" name="btnboletas" onclick="CuadroBoletas('+ i +')"  class="btn btn-info" style="width: 100%" >Visualizar Boletas</button>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnboletas_dsc'+ i +'" name="btnboletas_dsc" onclick="boleta_desc('+ i +')"  class="btn btn-info" style="width: 100%" >Visualizar Descuentos</button>';
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
        tabContent += '                             <div class="row mg-b-5" id="anio_bol'+i+'">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Año: </label>';
        tabContent += '                                 <div class="col-lg-6 pd-0">';
        tabContent += '                                     <select class="form-control col-lg-6 select2 select_anio_boletas" data-placeholder="Seleccione" id="select_anio_boletas'+ i +'" name="select_anio_boletas'+ i +'" style="width: 100%">';
        tabContent += '                                     </select>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Mes: </label>';
        tabContent += '                                 <div class="col-lg-6 pd-0">';
        tabContent += '                                     <select class="form-control col-lg-6 select2 select_mes_boleta" data-placeholder="Seleccione" id="select_mes_boleta'+ i +'" name="select_mes_boleta'+ i +'" style="width: 100%" onchange="MostrarBoleta('+ i +')">';
        tabContent += '                                         <option label="Seleccione"></option>';
        tabContent += '                                         <option value="dic">Diciembre  1991</option>';
        tabContent += '                                         <option value="ene">Enero - 1992</option>';
        tabContent += '                                         <option value="feb">Febrero - 1992</option>';
        tabContent += '                                         <option value="mar">Marzo - 1992</option>';
        tabContent += '                                         <option value="abr">Abril - 1992</option>';
        tabContent += '                                         <option value="may">Mayo - 1992</option>';
        tabContent += '                                         <option value="jun">Junio - 1992</option>';
        tabContent += '                                         <option value="jul">Julio - 1992</option>';
        tabContent += '                                         <option value="ago">Agosto - 1992</option>';
        tabContent += '                                         <option value="sep">Septiembre - 1992</option>';
        tabContent += '                                         <option value="oct">Octubre - 1992</option>';
        tabContent += '                                         <option value="nov">Noviembre - 1992</option>';
        tabContent += '                                     </select>';
        tabContent += '                                 </div>';
        tabContent += '                             </div>';
        tabContent += '                         </div> ';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Sueldo: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="sueldo_boleta" id="sueldo_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"   placeholder="" >';
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
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="reintegro_boleta" id="reintegro_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">H. Extras: </label>';
        tabContent += '                                 <input class="form-control col-lg-6 " type="number" name="horaex_boleta" id="horaex_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"  placeholder="" >';
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
        tabContent += '                                 <input class="form-control col-lg-6 bonif'+ i +'" type="number" name="bonificacion_uniforme_boleta" id="bonificacion_uniforme_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
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
        tabContent += '                                 <input class="form-control col-lg-6 bonif" type="number" name="otros_boleta" id="otros_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-12 col-sm-6">';
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
        tabContent += '                         <div class="col-12 col-sm-3">';
        tabContent += '                             <button type="button" id="btnimprimirbol'+ i +'" name="btnimprimirbol" onclick="imprimir_liquidacion_boleta('+ i +')"   class="btn btn-info">Descargar en Word</button>';
        tabContent += '                         </div>';
        tabContent += '                         <div class="col-12 col-sm-3">';
        tabContent += '                             <button type="button" id="btnprevbol'+ i +'" onclick="PrevBoleta('+ i +')"  name="btnprevbol"  class="btn btn-secondary mg-l-10">Previsualizar</button>';
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
       //Tab bono
        tabContent += '         <div id="bono'+ i +'" class="tab-pane fade">';
        tabContent += '             <form id="form_bono'+ i +'" action="" method="post" autocomplete="off">';
        tabContent += '                 <div class="form-layout form-layout-4">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-sm-12 "><span id="label_fechas_'+ i +'"></span></label>';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div>';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-lg-12">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-sm-6 ">Numero Autogenerado: <span class="tx-danger">*</span></label>';
        tabContent += '                                 <input class="form-control col-sm-6" type="text" id="num_auto'+ i +'" name="num_auto"  placeholder="Numero Aleatorio" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div>';
        tabContent += '                     <div class="row pd-t-5">';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-sm-6">Diciembre 91:</label>';
        tabContent += '                                 <input class="form-control col-sm-6" type="number" id="dic_91'+ i +'" name="dic_91" oninput="calcularBono()" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Junio 92: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="jun_92'+ i +'" name="jun_92" oninput="calcularBono()"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Enero 92: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="ene_92'+ i +'" name="ene_92" oninput="calcularBono()" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Julio 92:</label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="jul_92'+ i +'" name="jul_92" oninput="calcularBono()"   placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Febrero 92: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="feb_92'+ i +'" name="feb_92" oninput="calcularBono()" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Agosto 92:</label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="ago_92'+ i +'" name="ago_92"  oninput="calcularBono()"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Marzo 92: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="mar_92'+ i +'" name="mar_92" oninput="calcularBono()" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Septiembre 92:</label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="sep_92'+ i +'" name="sep_92" oninput="calcularBono()"   placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Abril 92:</label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="abr_92'+ i +'" name="abr_92" oninput="calcularBono()" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Octubre 92:</label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="oct_92'+ i +'" name="oct_92"  oninput="calcularBono()"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Mayo 92: </label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="may_92'+ i +'" name="may_92" oninput="calcularBono()"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-lg-6">';
        tabContent += '                             <div class="row mg-b-5">';
        tabContent += '                                 <label class="form-control-label col-lg-6">Noviembre 92:</label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="nov_92'+ i +'" name="nov_92"  oninput="calcularBono()"  placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                     <div class="d-none">';
        tabContent += '                         <div class="col-12 col-sm-8">';
        tabContent += '                             <div class="row mg-b-15">';
        tabContent += '                                 <label class="form-control-label col-lg-6 text-center">Calculo Bono:</label>';
        tabContent += '                                 <input class="form-control col-lg-6" type="number" id="cal_bono'+ i +'" name="cal_bono"    placeholder="Calculo Bono" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                         <div class="col-4 col-sm-4">';
        tabContent += '                             <div class="row justify-content-center mg-l-10">';
        tabContent += '                                 <button type="button" id="btncalculobono'+ i +'" name="btncalculobono"  class="btn btn-info">Ver Calculo</button>';
        tabContent += '                             </div>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-12 col-sm-8">';
        tabContent += '                             <select class="form-control select2 combo_prev_bono" name="combo_prev_bono" id="combo_prev_bono'+ i +'" style="width: 100%;">';
        tabContent += '                                 <option value="1">Fecha de 1992</option>';
        tabContent += '                                 <option value="2">Fecha de 1992 - 1996</option>';
        tabContent += '                                 <option value="4">Fecha de 1992 - 1996</option>';
        tabContent += '                                 <option value="3">Fecha de 1992 - 1996 - 2001</option>';
        tabContent += '                             </select>';
        tabContent += '                         </div>';
        tabContent += '                         <!--<div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnimprimirbono'+ i +'" name="btnimprimirbono" onclick="imprimir_dj('+ i +')"  class="btn btn-info">Imprimir Bono</button>';
        tabContent += '                         </div>-->';
        tabContent += '                         <div class="col-12 col-sm-4">';
        tabContent += '                             <button type="button" id="btnprevbono'+ i +'" name="btnprevbono" onclick="PrevDJ('+ i +')"  class="btn btn-secondary">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                 </div>';
        tabContent += '             </form> ';
        tabContent += '         </div>';
       //Fin Tab Bono
        tabContent += '     </div> ';
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
                                "<div class='row' id='fechas' >"+
                                    "<div class='col-12 col-sm-4'>"+
                                        "<div class='form-group' >"+
                                            "<label class='form-control-label'>Desde</label>"+
                                            "<input class='form-control' oninput='ValidarFecha(this)'  type='date' max='2099-12-31' min='1900-12-31' id='f_inicio_"+i+"'>"+
                                            "<div class='error-msg'></div>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-4'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Hasta</label>"+
                                            "<input class='form-control' oninput='ValidarFecha(this)' type='date' max='2999-12-31' min='1900-12-31' id='f_final_"+i+"' >"+
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
                                    "<div class ='col-12 col-sm-4 d-none'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Base  </label>"+
                                            "<select class='form-control select2 cbx_tipos' id='cbx_base_"+i+"' style='width: 100%'>"+
                                                "<option value='0' selected>AMBAS BASES</option>"+
                                                "<option value='1'>BASE 1</option>"+
                                                "<option value='2'>BASE 2</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='d-none'>"+
                                        "<div class='form-group'  >"+
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
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Condicion </label>"+
                                            "<select class='form-control select2 cbx_tipos' id='cbx_condicion_"+i+"' style='width: 100%'>"+
                                                "<option value='V'>TODOS</option>"+
                                                "<option value='HABIDO'>HABIDO</option>"+
                                                "<option value='NO HABIDO'>NO HABIDO</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-12'>"+
                                        "<div class='row mb-3'>"+
                                            "<div class='col-lg-3 col-sm-6'>"+
                                                "<button class='btn btn-outline-info' onclick='CopiarEmp("+i+")' style='width:100%'>"+
                                                    "<div class='d-flex align-items-center justify-content-center'><i class='fa fa-copy mr-1'></i> Copiar RUC</div>"+
                                                "</button>"+
                                            "</div>"+
                                            "<div class='col-lg-3 col-sm-6'>"+
                                                "<button class='btn btn-outline-info' onclick='CopiarRazSocial("+i+")' style='width:100%'>"+
                                                    "<div class='d-flex align-items-center justify-content-center'><i class='fa fa-copy mr-1'></i> Copiar Nombre</div>"+
                                                "</button>"+
                                            "</div>"+
                                            "<div class='col-lg-3 col-sm-6'>"+
                                                "<button class='btn btn-outline-secondary' onclick='BuscarEmp("+i+")' style='width:100%'>"+
                                                    "<div class='d-flex align-items-center justify-content-center'>"+
                                                        "<i class='fa fa-search mr-1'></i> Buscar"+
                                                    "</div>"+
                                                "</button>"+
                                            "</div>"+
                                            "<div class='col-lg-3 col-sm-6'>"+
                                                "<button class='btn btn-outline-danger' onclick='ActualizarEmp("+i+")' style='width:100%'>"+
                                                    '<div class="d-flex align-items-center justify-content-center">'+
                                                    '<i class="fa fa-edit mr-1"></i> Actualizar'+
                                                    '</div>'+
                                                '</button>'+
                                            "</div>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-12'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label' for='lst_emp_"+i+"'>Empresa</label>"+
                                            "<select class='form-control select2' name='lst_emp_"+i+"' id='lst_emp_"+i+"' data-placeholder='Seleccione' style='width: 100%' required onchange='ListarFirmante("+i+")' disabled></select>"+
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
                                        "<input type='hidden'  id='firmante_sp"+i+"' name='firmante_sp"+i+"'>"+
                                    "</div>"+
                                    "<div class='col-sm-1' style='padding-left: 0'><button type='button' onclick='MostrarFirmante("+i+")'  id='btn_ver"+i+"' class='btn btn-outline-primary btn-icon' style='width:100%;'><div><i class='fa fa-search'></i></div></button></div>"+
                                "</div><!-- row -->"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='direc"+i+"' class='col-sm-3 col-form-label'>Dirección:</label>"+
                                    "<div class='col-sm-8'>"+
                                        "<input type='text' class='form-control' id='direccion"+i+"' name='direccion"+i+"' readonly>"+
                                    "</div>"+
                                    "<div class='col-sm-1' style='padding-left: 0'><button type='button'  id='btn_ver_direccion"+i+"' class='btn btn-outline-primary btn-icon' style='width:100%;'><div><i class='fa fa-search'></i></div></button></div>"+
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
                                "<div class='col-12 col-sm-12'>"+
                                    "<div class='row justify-content-center'>"+
                                        "<div class='col-4 mb-1 text-center'>"+
                                            "<button type='button' id='btnmostrarempr_"+i+"' name='btnmostrarempr_"+i+"' onclick='mostrardetalle("+i+", 0, 0)' class='btn btn-info' >Mostrar Documentos</button>"+
                                        "</div>"+
                                    "</div>"+
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
            //console.log(data);
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
                                //console.log(data);
                                $('#txtnombre').val(data.data.nombres);
                                $('#txtapellido').val(data.data.apellidoPaterno + ' '+data.data.apellidoMaterno);
                                $('#txtdate').val(convertDateFormatDate(data.data.fechaNacimiento));
                            }
                        });
                    } else if (result.isDenied) {
                    }
                    })
            }else {
                data = JSON.parse(data);
                $('#af_id').val(data.id);
                $('#tipo_doc').val(data.tipo_doc);
                $('#num_doc').val(data.num_doc);
                $('#txtnombre').val(data.nombres);
                $('#txtapellido').val(data.ap_pa);
                $('#txtdate').val(data.fech_nac);
                //$('#cant_emp').val(data.cant_emp).trigger('change');
                $("#form_datos").show();
                $('#form_datos').removeClass().addClass('form-layout form-layout-1 ');

                $.post("../../controller/listacontrolador.php?op=mostrar",{num_doc: doc, lista: t_lista},function(datos){
                    if(datos != ""){
                        //console.log(datos);
                        alerta_uso = 1;
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

function convertDateFormatDate(string) {
    var info = string.split('/').reverse().join('-');
    return info;
}
function convertDateFormat(string) {
    var info = string.split('-').reverse().join('-');
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

function CopiarRazSocial(a) {
    // Obtén el contenido del elemento usando jQuery
    let texto = $('select[name="lst_emp_'+a+'"] option:selected').text();
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

function BuscarEmp_inicio(a, ruc){
    $.ajax({
        url: "../../controller/empresacontrolador.php?op=rucempresa",
        type: "POST",
        data: { emp_ruc: ruc },
        dataType: 'JSON',
        success: function(data) {
            //console.log(data);
            let select = `<option value="${ruc}">${data.empleador}</option>`;
            $("#lst_emp_"+ a).html(select);
        
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

var empresasData = [];
var empresasBusqueda = [];

function BuscarEmp(a){

    let fech1 = $('#f_inicio_'+a).val();
    let fech_final_1 =$('#f_final_'+a).val();
    var fnac = $('#txtdate').val();
    let cbx_tipo = $('#cbx_tipo_'+ a).val();
    let cbx_base = $('#cbx_base_'+ a).val();
    let cbx_estado = $('#cbx_estado_'+ a).val();
    let cbx_condicion = $('#cbx_condicion_'+ a).val();
    let manana = moment(fnac).add(16, 'years').format('YYYY-MM-DD');


    if(fech1 != "" || fech_final_1 !=""){
        var fechanac = new Date(manana);
        var fechain = new Date(fech1)
        var fechafi=  new Date(fech_final_1);
        var fechaimod = fechain.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechafmod = fechafi.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechai = new Date(fechaimod);
        var fechaf=  new Date(fechafmod);

        if(fechai >= fechanac){
            if(fechai < fechaf){
                $.ajax({
                    url: "../../controller/pensioncontrolador.php?op=empresas_seleccion",
                    type: "POST",
                    data: {
                        txtdateinicio: fech1,
                        txtdatefin: fech_final_1,
                        tipo: cbx_tipo,
                        base: cbx_base,
                        estado: cbx_estado,
                        condicion: cbx_condicion
                    },
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        if (data.length > 0) {
                            // Almacena los datos de empresas en la variable global
                            empresasData = data;
                            var resultadosPorPagina = 10; // Define el número de resultados por página
                            var paginaActual = 1; // Página inicial
                            mostrarDatos(a, empresasData, paginaActual, resultadosPorPagina);

                            $('#val_number_emp').val(a);
                            //Mostrar Modal
                            $('#modalempresas').modal('show');
                        } else {
                            // Manejar caso donde no hay datos
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        // Maneja errores si es necesario
                    }
                });
            }else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Introduzca las fechas correctas',
                    showConfirmButton: false,
                    timer:1500
                });
            }
        }else {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'La fecha de nacimiento debe ser mayor a la fecha de inicio ',
                showConfirmButton: false,
                timer:1500
            });
        }
    }else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca fechas de inicio y fin ',
            showConfirmButton: false,
            timer:1500
        });
    }



}

// Función para mostrar datos paginados
function mostrarDatos(a, empresas, paginaActual, resultadosPorPagina) {
    // Limpiar contenido existente de la tabla
    $("#div_empresas").empty();

    // Calcular índices de inicio y fin para la página actual
    var inicio = (paginaActual - 1) * resultadosPorPagina;
    var fin = inicio + resultadosPorPagina;
    var empresasPaginadas = empresas.slice(inicio, fin);

    // Construir y mostrar las filas de la tabla para la página actual
    var html = "";
    empresasPaginadas.forEach(function(empresa) {
        html += "<tr>";
        html += "<td style='vertical-align: middle;'><input type='radio' name='empresa_seleccionada' value='" + empresa.ruc + "'></td>";
        html += "<td style='vertical-align: middle;'>" + empresa.ruc + "</td>";
        html += "<td style='vertical-align: middle;'>" + empresa.empleador + "</td>";
        html += "</tr>";
    });
    $("#div_empresas").html(html);

    // Mostrar la información de paginación
    mostrarPaginacion(a, empresas.length, paginaActual, resultadosPorPagina, empresas);
}

// Función para mostrar la paginación
function mostrarPaginacion(a, totalEmpresas, paginaActual, resultadosPorPagina, empresas) {
    var totalPaginas = Math.ceil(totalEmpresas / resultadosPorPagina);
    var paginacionHtml = "";

    // Construir botón "Anterior"
    paginacionHtml += "<button type='button' class='btn btn-sm btn-outline-secondary mr-1' id='btnAnterior'>Anterior</button>";

    // Mostrar número de página actual y total de páginas
    paginacionHtml += "<span class='mr-1'>Página <span id='paginaActual'>" + paginaActual + "</span> de <span id='totalPaginas'>" + totalPaginas + "</span></span>";

    // Construir botón "Siguiente"
    paginacionHtml += "<button type='button' class='btn btn-sm btn-outline-secondary' id='btnSiguiente'>Siguiente</button>";

    // Agregar la paginación al contenedor correspondiente
    $("#paginacion").html(paginacionHtml);

    // Evento al hacer clic en el botón "Anterior"
    $("#btnAnterior").on("click", function() {
        var paginaActual = parseInt($("#paginaActual").text());
        if (paginaActual > 1) {
            paginaActual--;
            mostrarDatos(a, empresas, paginaActual, resultadosPorPagina);
        }
    });

    // Evento al hacer clic en el botón "Siguiente"
    $("#btnSiguiente").on("click", function() {
        var paginaActual = parseInt($("#paginaActual").text());
        var totalPaginas = parseInt($("#totalPaginas").text());
        if (paginaActual < totalPaginas) {
            paginaActual++;
            mostrarDatos(a, empresas, paginaActual, resultadosPorPagina);
        }
    });
}

// Controlador de eventos para el evento keyup en el input de búsqueda
$("#searchInput").on("keyup", function() {
    var value_emp = $('#val_number_emp').val();
    var textoBusqueda = $(this).val().toLowerCase(); // Obtener el valor del input y convertirlo a minúsculas
    var primeraPagina = 1;
    var resultadosPorPagina = 10; 
    if (textoBusqueda === "") {
        // Si el input está vacío, mostrar todas las empresas del primer resultado del API
        //console.log("Texto Vacio");
        mostrarDatos(value_emp, empresasData, primeraPagina, resultadosPorPagina);
    } else {
        // Si hay un valor en el input, realizar la búsqueda en el JSON y mostrar los resultados correspondientes
        var empresasFiltradas = filtrarEmpresas(empresasData, textoBusqueda);
        if (empresasFiltradas.length > 0) {
            mostrarDatos(value_emp, empresasFiltradas, primeraPagina, resultadosPorPagina);
        } else {
            // Manejar el caso en el que no se encuentren resultados
            $("#div_empresas").html("<tr><td colspan='3'>No se encontraron empresas que coincidan con la búsqueda.</td></tr>");
        }
    }
});

// Función para filtrar las empresas basadas en el texto de búsqueda
function filtrarEmpresas(empresas, textoBusqueda) {
    return empresas.filter(function(empresa) {
        // Filtrar las empresas cuyo nombre (empleador) coincida parcialmente con el texto de búsqueda
        return empresa.empleador.toLowerCase().includes(textoBusqueda);
    });
}

function SeleccionarEmpresa(){
    var num = $('#val_number_emp').val();
    var rucSeleccionado = $("input[name='empresa_seleccionada']:checked").val();
    var nombreEmpresa = $("input[name='empresa_seleccionada']:checked").closest("tr").find("td:nth-child(3)").text();

    if (rucSeleccionado && nombreEmpresa) {
        //Setear los valores al input text;
        let texto = `<option value="${rucSeleccionado}">${nombreEmpresa}</option>`;
        
        $('#lst_emp_' + num).html(texto);
        $('#modalempresas').modal('hide');
        $('#ruc_emp_'+num).val(rucSeleccionado);
        ListarFirmante(num);
    } else {
        console.error("No se ha seleccionado ninguna empresa.");
    }
}



function mostrardetalle(a,b,c){
    $('#contenedor_emp'+ a).show();
    //$('#combo_prev_liqui').select2("val", "0");
    OcultarPrev();
    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;

    suma_anios1 = 0;
    suma_meses1 = 0;
    suma_dias1 = 0;



    $('#form_liqui')[0].reset();
    $('#form_bol')[0].reset();
    $('#form_bono')[0].reset();
    var fech1 = $('#f_inicio_'+a).val();
    var fech_final_1 =$('#f_final_'+a).val();
    var cargo = $('#cargoc'+a).val();
    var rucs = $('#ruc_emp_'+a).val();
    let logos = $('#logo'+a).val();
    let cbx_tipo = $('#cbx_tipo_'+a).val();
    let cbx_base = $('#cbx_base_'+ a).val();
    let cbx_estado = $('#cbx_estado_'+ a).val();
    let cbx_condicion = $('#cbx_condicion_'+ a).val();
    let depas ;
    var nom;
    var razsocialruc ;
    let valor_busqueda ;
    var cantidad = $('#txtcant_emp').val();
    let fnac = $('#txtdate').val();
    let manana = moment(fnac).add(16, 'years').format('YYYY-MM-DD');
    var cant = $('#txtcant_emp').val();
    var cbx_cargo = $('#cargoc'+ a).val();

    //Agregar un dia a la siguiente empresa
    if(cant > a){
        var n_emp = a + 1 ;
        var fecha_i_nueva = moment(fech_final_1).add(1, 'days').format('YYYY-MM-DD');
        $('#f_inicio_'+n_emp).val(fecha_i_nueva);
    }

    $('#logo_nombre').val(logos);

    /*Condicional para visibilidad de DJ */
    var fechaSelect= new Date(fech_final_1);
    var fechaLim = new Date('1992-12-31');
    if (fechaSelect > fechaLim) {
        //console.log('La fecha seleccionada es posterior al 31 de diciembre de 1992.');
        $('#nav-bono'+ a).show();
        $('#renuncia-tab'+ a).hide();

    } else {
        //console.log('La fecha seleccionada no es posterior al 31 de diciembre de 1992.');
        $('#nav-bono'+ a).hide();
        $('#renuncia-tab'+ a).show();
    }

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

    var options = { year: 'numeric', month: 'long', day: 'numeric' };

    if(fech1 != "" || fech_final_1 != ""){
        var fechanac = new Date(manana);
        var fechain = new Date(fech1)
        var fechafi=  new Date(fech_final_1);
        var fechaimod = fechain.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechafmod = fechafi.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechai = new Date(fechaimod)
        var fechaf=  new Date(fechafmod);
        if(fechai >= fechanac){
            if(fechai < fechaf){
                if(cbx_cargo !== ''){
                    if(1 == 0){
                        //Ajax para traer la lista
                        /*$.post("../../controller/pensioncontrolador.php?op=combo",{txtdateinicio: fech1 , txtdatefin: fech_final_1, tipo : cbx_tipo, base : cbx_base, estado : cbx_estado, condicion : cbx_condicion}, function(data){
                            if(data == ""){
                                console.log("NO EXISTE DATA");
                            }else {
                                //console.log(data);
                                $("#lst_emp_"+a).html(data);
                            }
                        });*/
                        
                    }else {
                         $.post("../../controller/pensioncontrolador.php?op=buscardpto",{txtdateinicio: fech1 , txtdatefin: fech_final_1, txtrazon : razsocialruc},function(data){
                        //console.log(data);
                            if(data == ""){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'info',
                                    title: 'No existe informacion',
                                    showConfirmButton: false,
                                    timer:1500
                                });
                            }else {
                                console.log("SEGUNDA BUSQUEDA");
                                data = JSON.parse(data);
                                //console.log(data);
                                //$("#lst_emp_"+a).val(data[0]['ruc']).trigger('change');
                                $('#nom_emp_'+a).html(data[0]['ruc']+" - "+data[0]['empleador']);
                                $('#fech_sueldo_'+a).val(data[0]['moneda_sueldo']);
                                $('#cant_sueldo_'+a).val(data[0]['fechsueldo']);
                                $('#nom_emp_lab'+ a).html(data[0]['empleador']);
                                $('#nom_emp_lab'+ a).val(data[0]['empleador']);
                                $('#tiempo_header_'+a).html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses '+data[0]['Dias']+' Dias');
                                $('#anios_emp_'+a).val(data[0]['Anios']);
                                $('#meses_emp_'+a).val(data[0]['Meses']);
                                $('#dias_emp_'+a).val(data[0]['Dias']);
                                $('#ruc_emp_'+a).val(data[0]['ruc']);
                                $('#tipo_emp_'+a).val(data[0]['tipo_emp']);
                                $('#fech_inicio_emp').val(fech1);
                                $('#fech_final_emp').val(fech_final_1);
                                $('#cargo_emp').val(cargo);
                                $('#dpto_emp_'+a).val(data[0]['dpto']);
                                $('#rep_legal_'+a).val(data[0]['rep_legal']);
                                $('#dni_a_'+a).val(data[0]['dni_a']);
                                $('#rango_emp_'+a).val(data[0]['f_inic_act'] +" / "+ data[0]["f_baja_act"]);

                                nom = $('#nom_emp_lab').val();
                                var dpto1= $('#dpto_emp_'+a).val();
                                nombres= $('#txtnombre').val();
                                apelli= $('#txtapellido').val();
                                tmp = parseInt($('#anios_emp_'+a).val(),"10");
                                sldo = Number(data[0]['fechsueldo'])
                                tot = tmp * sldo;
                                rp =  data[0]['rep_legal'];
                                dnia = data[0]['dni_a'];
                                firm = $('#firmante'+a).val();

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
                                 $('#tiempo_imp'+ a).val(tmp +" Años");

                                 $('.emp_imp').html(nom);
                                 $('.nombre_imp').html(nombres+" "+apelli);
                                 $('.cargo_imp').html(cargo);
                                 $('.desde_imp').html(fechai.toLocaleDateString("es-ES", options).toUpperCase());
                                 $('.hasta_imp').html(fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                                 $('.lugardia').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                                 $('.desde_imp_low').html(fechai.toLocaleDateString("es-ES", options));
                                 $('.hasta_imp_low').html(fechaf.toLocaleDateString("es-ES", options));
                                 $('.lugardia_low').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options));
                                 $('.tiempo_imp').html(tmp +" Años");
                                 $('.anios_temp').html(data[0]['Anios']);
                                 $('.tiempo_liqui_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses ');
                                 $('.sueldo_imp').html(sldo);
                                 $('.tot_imp').html(tot);
                                 $('.nom_emp_ap').html(apelli+" "+nombres);
                                 $('.ruc_emp_imp').val(data[0]['ruc']);
                                 $('.nom_emp_ap_rp').html(rp);
                                 $('.dni_imp_rp').html(dnia);
                                 $('.img_logo').attr("src","../../assets/img/"+logos);
                                 $('.firmante_nom').html(firm);
                                 $('.departamento_imp').html(dpto1.toUpperCase());
                                 $('.cargo_imp_low').html(cargo.toLowerCase());
                                     /*NUEVO*/
                                 $('.desde_imp_num').html(convertDateFormat(fech1));
                                 $('.hasta_imp_num').html(convertDateFormat(fech_final_1));
                                 $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech_final_1));

                                 $('#emp_certificado').val(nom);
                                 $('#nombre_certificado').val(nombres+" "+apelli);
                                 $('#f_ini_certificado').val(convertDateFormat(fech1));
                                 $('#f_baj_certificado').val(convertDateFormat(fech_final_1));
                                 $('#cargo_certificado').val(cargo);
                                 $('#firmante_certificado').val(firm);
                                 $('#lugar_certificado').val(dpto1+", "+convertDateFormat(fech_final_1));

                                 /* LIQUIDACION */
                                 $('#dias_liqui' + a).val(data[0]['Dias']);
                                 $('#meses_liqui' + a).val(data[0]['Meses']);
                                 $('#anios_liqui' + a).val(data[0]['Anios']);
                                 $('#ruc_emp'+ a).val(data[0]['ruc']);

                                 $('#sueldo_liquidacion'+ a).val(data[0]['fechsueldo']);


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
                                 sumarbono(a);
                                 MostrarCertificados(data[0]['tipo_emp'], a);
                                 MostrarLiquidacion(fech_final_1, data[0]['tipo_emp'], a);

                                 ListarFirmante(a);
                            }


                        });
                    }

                    //$("#lst_emp_"+a).val(razsocialruc).trigger('change');
                    //$("#contemp1").show();
                    $("#resultado_pdf").show();
                    $("#prev1").show();
                    //$("#prev_certificado_1").show();
                }else {
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Debe seleccionar un cargo',
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

    //$('#orcinea-tab').click();
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
            break;
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
function GuardarLista(){
    //ASignar una valor para validar si se muestra la alerta
    $('#valorguardar').val("1");

    let tipo_lista = $("#tipo_lista").val();
    let id_lista = $("#lista_id").val();
    let af_id = $("#af_id").val();
    let num_doc = $("#num_doc").val();
    let cantidad = $("#txtcant_emp").val();
    let fecha_nac = $("#txtdate").val()

    let fech_inicio1 = $("#f_inicio_1").val();
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
                },
                "Dj":
                {
                    "num_aleatorio":    $('#num_auto1').val() || null,
                    "dic_91" :        $('#dic_911').val() || null,
                    "ene_92" :        $('#ene_921').val() || null,
                    "feb_92" :        $('#feb_921').val() || null,
                    "mar_92" :        $('#mar_921').val() || null,
                    "abr_92" :        $('#abr_921').val() || null,
                    "may_92" :        $('#may_921').val() || null,
                    "jun_92" :        $('#jun_921').val() || null,
                    "jul_92" :        $('#jul_921').val() || null,
                    "ago_92" :        $('#ago_921').val() || null,
                    "sep_92" :        $('#sep_921').val() || null,
                    "oct_92" :        $('#oct_921').val() || null,
                    "nov_92" :        $('#nov_921').val() || null,
                    "modelo" :        $('#combo_prev_bono1').val() || null
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
                },
                "Dj":
                {
                    "num_aleatorio":    $('#num_auto2').val() || null,
                    "dic_91" :        $('#dic_912').val() || null,
                    "ene_92" :        $('#ene_922').val() || null,
                    "feb_92" :        $('#feb_922').val() || null,
                    "mar_92" :        $('#mar_922').val() || null,
                    "abr_92" :        $('#abr_922').val() || null,
                    "may_92" :        $('#may_922').val() || null,
                    "jun_92" :        $('#jun_922').val() || null,
                    "jul_92" :        $('#jul_922').val() || null,
                    "ago_92" :        $('#ago_922').val() || null,
                    "sep_92" :        $('#sep_922').val() || null,
                    "oct_92" :        $('#oct_922').val() || null,
                    "nov_92" :        $('#nov_922').val() || null,
                    "modelo" :        $('#combo_prev_bono2').val() || null
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
                },
                "Dj":
                {
                    "num_aleatorio":    $('#num_auto3').val() || null,
                    "dic_91" :        $('#dic_913').val() || null,
                    "ene_92" :        $('#ene_923').val() || null,
                    "feb_92" :        $('#feb_923').val() || null,
                    "mar_92" :        $('#mar_923').val() || null,
                    "abr_92" :        $('#abr_923').val() || null,
                    "may_92" :        $('#may_923').val() || null,
                    "jun_92" :        $('#jun_923').val() || null,
                    "jul_92" :        $('#jul_923').val() || null,
                    "ago_92" :        $('#ago_923').val() || null,
                    "sep_92" :        $('#sep_923').val() || null,
                    "oct_92" :        $('#oct_923').val() || null,
                    "nov_92" :        $('#nov_923').val() || null,
                    "modelo" :        $('#combo_prev_bono3').val() || null
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
                },
                "Dj":
                {
                    "num_aleatorio":    $('#num_auto4').val() || null,
                    "dic_91" :        $('#dic_914').val() || null,
                    "ene_92" :        $('#ene_924').val() || null,
                    "feb_92" :        $('#feb_924').val() || null,
                    "mar_92" :        $('#mar_924').val() || null,
                    "abr_92" :        $('#abr_924').val() || null,
                    "may_92" :        $('#may_924').val() || null,
                    "jun_92" :        $('#jun_924').val() || null,
                    "jul_92" :        $('#jul_924').val() || null,
                    "ago_92" :        $('#ago_924').val() || null,
                    "sep_92" :        $('#sep_924').val() || null,
                    "oct_92" :        $('#oct_924').val() || null,
                    "nov_92" :        $('#nov_924').val() || null,
                    "modelo" :        $('#combo_prev_bono4').val() || null
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
                },
                "Dj":
                {
                    "num_aleatorio":    $('#num_auto5').val() || null,
                    "dic_91" :        $('#dic_915').val() || null,
                    "ene_92" :        $('#ene_925').val() || null,
                    "feb_92" :        $('#feb_925').val() || null,
                    "mar_92" :        $('#mar_925').val() || null,
                    "abr_92" :        $('#abr_925').val() || null,
                    "may_92" :        $('#may_925').val() || null,
                    "jun_92" :        $('#jun_925').val() || null,
                    "jul_92" :        $('#jul_925').val() || null,
                    "ago_92" :        $('#ago_925').val() || null,
                    "sep_92" :        $('#sep_925').val() || null,
                    "oct_92" :        $('#oct_925').val() || null,
                    "nov_92" :        $('#nov_925').val() || null,
                    "modelo" :        $('#combo_prev_bono5').val() || null
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
            console.log("GUARDO");
            console.log(data);
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

    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;

    numero = $('#txtcant_emp').val();

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

function sumarbono(a){

    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;

    suma_anios1 = 0;
    suma_meses1 = 0;
    suma_dias1 = 0;

    anios_bono = 0;
    meses_bono = 0;
    dias_bono = 0;

    let numero = $('#txtcant_emp').val();
    let fech1 = $('#f_inicio_'+a).val();
    let fech_final_1 =$('#f_final_'+a).val();
    let fech_ini = new Date(fech1);
    let fechaf= new Date(fech_final_1);
    let fechalim = new Date('1992-12-31');

    for(i = 1 ; i<=numero ; i++){
        if($('#f_final_'+i).val()!=""){
            fini = new Date($('#f_inicio_'+i).val());
            ffin = new Date($('#f_final_'+i).val());
            if(fini < fechalim){
                if(ffin < fechalim){
                    suma_anios1 += parseInt($('#anios_emp_'+i).val(), '10');
                    suma_meses1 += parseInt($('#meses_emp_'+i).val(), '10');
                    suma_dias1 += parseInt($('#dias_emp_'+i).val(), '10');
                }else {
                    f_inicio = moment(fini);
                    f_fin = moment('1992-12-31');
                    dife1 = f_fin.diff(f_inicio, 'days');
                    anios_bono = Math.trunc(dife1 / 365);
                    dias_bono = dife1 % 365;
                    if(dias_bono >= 30){
                        mes_orci = Math.trunc(dias_bono / 30);
                        dias_bono = dias_bono % 30;
                        meses_bono = meses_bono + mes_orci;

                    }
                    if(meses_bono >= 12){

                        anio_orci = Math.trunc(meses_bono / 12);
                        meses_bono = meses_bono % 12;
                        anios_bono = anios_bono + anio_orci;
                    }
                    suma_anios1 +=anios_bono;
                    suma_meses1 +=meses_bono;
                    suma_dias1 +=dias_bono;
                }
            }

        }

    }
    if(suma_dias1 >= 30){

        let mes = Math.trunc(suma_dias1 / 30);
        suma_dias1 = suma_dias1 % 30;
        suma_meses1 = suma_meses1 + mes;
    }

    if(suma_meses1 >=12){

        let anio = Math.trunc(suma_meses1 / 12);
        suma_meses1 = suma_meses1 % 12;
        suma_anios1 = suma_anios1 + anio;
    }

    sum_mes = suma_anios1 * 12 + suma_meses1;
    mensaje = suma_anios1+ ' Años '+suma_meses1+' Meses '+ suma_dias1+' Dias'+'( '+sum_mes+ ' Meses )';
   //console.log(mensaje);
    $("#tiempo_bono").html(mensaje);
}

function calcularBono(){

    /*numero = $('#txtcant_emp').val();
    f_inicio = moment($('#f_inicio_'+numero).val());
    f_fin = moment($('#f_final_'+numero).val());

    dife1 = f_fin.diff(f_inicio, 'months');
    const constante = 0.1831;
    const meses = parseInt(dife1, "10");

    mes12 = parseFloat($('#dic_91').val()) | 0
    mes01 = parseFloat($('#ene_92').val()) | 0
    mes02 = parseFloat($('#feb_92').val()) | 0
    mes03 = parseFloat($('#mar_92').val()) | 0
    mes04 = parseFloat($('#abr_92').val()) | 0
    mes05 = parseFloat($('#may_92').val()) | 0
    mes06 = parseFloat($('#jun_92').val()) | 0
    mes07 = parseFloat($('#jul_92').val()) | 0
    mes08 = parseFloat($('#ago_92').val()) | 0
    mes09 = parseFloat($('#sep_92').val()) | 0
    mes10 = parseFloat($('#oct_92').val()) | 0
    mes11 = parseFloat($('#nov_92').val()) | 0

    promedio = (mes12+mes01+mes02+mes03+mes04+mes05+mes06+mes07+mes08+mes09+mes10+mes11)/12
    total = new Intl.NumberFormat('en-EN').format(promedio*constante*meses)

    $('#cal_bono').val(total)*/


    const constante = 0.1831;
    let sum_mes = suma_anios1 * 12 + suma_meses1;
    let total_dic = $('#dic_91').val();
    let total_ene = $('#ene_92').val();
    let total_feb = $('#feb_92').val();
    let total_mar = $('#mar_92').val();
    let total_abr = $('#abr_92').val();
    let total_may = $('#may_92').val();
    let total_jun = $('#jun_92').val();
    let total_jul = $('#jul_92').val();
    let total_ago = $('#ago_92').val();
    let total_sep = $('#sep_92').val();
    let total_oct = $('#oct_92').val();
    let total_nov = $('#nov_92').val();

    let prom_meses = (Number(total_dic) + Number(total_ene) + Number(total_feb) + Number(total_mar) + Number(total_abr) + Number(total_may) + Number(total_jun) + Number(total_jul) + Number(total_ago) + Number(total_sep) + Number(total_oct) + Number(total_nov)) / 12;
    let prom_total = (Number(prom_meses) * Number(sum_mes) * constante ).toFixed(2);
    $('#cal_bono').val(prom_total);

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
    $('#total_monto_boleta'+ e).val(total);
}

function ListarFirmante(a){
    let estado = $('select[name="lst_emp_'+a+'"] option:selected').text();
    let ruc = $("#lst_emp_"+a).val();
    $('#nom_emp_'+a).html(ruc+" - "+estado);
    $("#firmante"+a).val("");

    $.post("../../controller/empresacontrolador.php?op=combovigencia",{numero : ruc}, function(data){
        if(data != ""){
            data = JSON.parse(data);
            //console.log(data);
            $('#rango_emp_'+a).val(data.f_inic_act +" / "+ data.f_baja_act); 
            $('#estado_emp_' + a).val(data.estado_emp);
            $('#condicion_emp_' + a).val(data.habido_emp);

            if(data.estado_emp == 'ACTIVO'){
                $('#estado_emp_' + a).css({'color': '#70e000','font-weight': 'bold'});
            }else {
                $('#estado_emp_' + a).css({'color': '#ef233c','font-weight': 'bold'});
            }

            if(data.habido_emp == 'HABIDO'){
                $('#condicion_emp_' + a).css({'color': '#70e000','font-weight': 'bold'});
            }else {
                $('#condicion_emp_' + a).css({'color': '#ef233c','font-weight': 'bold'});
            }
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
        $("#logo_img_"+a).attr("src","../../assets/img/"+estado);
        //$('#div_logo_'+a).show();
    }
}

function Sumarmonto(mes) {
    let num =  0;
    for( i = 1 ; i <= 6 ; i++ ){
        let numero = $('#'+mes+'_'+i).val();

        //num += Number(desformatearNumero(numero));
        let valorNumerico = Number(desformatearNumero(numero));
        if (!isNaN(valorNumerico)) {
            num += valorNumerico;
        }
    }
    $('#'+mes+'_total').html(formatearNumeroEntero(num));
    //console.log("El mes es: " + num);
}

function MostrarBoleta(e){

    let anio_final = $("#fech_final_emp" + e).val();
    let anio_boleta_final = new Date(anio_final).getFullYear();

    if(anio_boleta_final >= 1991){
        let mes = $('#select_mes_boleta'+ e).val();
        let sueldo = Number($('#'+mes+'_1').val());
        let rm = Number($('#'+mes+'_2').val());
        let reintegro = Number($('#'+mes+'_3').val());
        let hextras = Number($('#'+mes+'_4').val());
        let bonofi = Number($('#'+mes+'_5').val());
        let otros = Number($('#'+mes+'_6').val());

        let total =  desformatearNumero($('#'+mes+'_total').html());

        $('#sueldo_boleta'+ e).val(sueldo);
        $('#rm_vacacional_boleta'+ e).val(rm);
        $('#reintegro_boleta'+ e).val(reintegro);
        $('#horaex_boleta'+ e).val(hextras);
        $('#boni_boleta'+ e).val(bonofi);
        $('#otros_boleta'+ e).val(otros);
        $('#total_monto_boleta'+ e).val(total);
        SumarMeses();

        let mes_completo = "";
        let estado_dsc = $("#select_mes_boleta"+ e).val();
        let estado_anio_dsc ;
        switch (estado_dsc) {
            case 'ene':
                mes_completo = "01";
                estado_anio_dsc = "1992";
                break;
            case 'feb':
                mes_completo = "02";
                estado_anio_dsc = "1992";
                break;
            case 'mar':
                mes_completo = "03";
                estado_anio_dsc = "1992";
                break;
            case 'abr':
                mes_completo = "04";
                estado_anio_dsc = "1992";
                break;
            case 'may':
                mes_completo = "05";
                estado_anio_dsc = "1992";
                break;
            case 'jun':
                mes_completo = "06";
                estado_anio_dsc = "1992";
                break;
            case 'jul':
                mes_completo = "07";
                estado_anio_dsc = "1992";
                break;
            case 'ago':
                mes_completo = "08";
                estado_anio_dsc = "1992";
                break;
            case 'sep':
                mes_completo = "09";
                estado_anio_dsc = "1992";
                break;
            case 'oct':
                mes_completo = "10";
                estado_anio_dsc = "1992";
                break;
            case 'nov':
                mes_completo = "11";
                estado_anio_dsc = "1992";
                break;
            case 'dic':
                mes_completo = "12";
                estado_anio_dsc = "1991";
                break;
        }

        //let estado_anio_dsc = $("#select_anio_boletas"+ e).val();
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
                //$('#sueldo_boleta'+ e).val(data.sueldo_minimo);
                //$('#sueldo_boleta_info').val(data.sueldo_minimo);
                $('#dsc_at_ss').html(data.at_ss +'%');
                $('#dsc_at_fonavi').html(data.at_pro_desocup+'%');
                $('#dsc_at_pension').html(data.at_fondo_juvi+'%');
                $('#dsc_ap_ss').html(data.ap_ss+'%');
                $('#dsc_ap_fonavi').html(data.ap_fonavi+'%');
                $('#dsc_ap_pension').html(data.ap_fondo_juvi+'%');
            }
        });
    }else {
        let estado_dsc = $("#select_mes_boleta"+ e).val();
        let estado_anio_dsc = $("#select_anio_boletas"+ e).val();
        let mes_completo = "";
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
                //$('#sueldo_boleta_info').val(data.sueldo_minimo);
                $('#dsc_at_ss').html(data.at_ss +'%');
                $('#dsc_at_fonavi').html(data.at_pro_desocup+'%');
                $('#dsc_at_pension').html(data.at_fondo_juvi+'%');
                $('#dsc_ap_ss').html(data.ap_ss+'%');
                $('#dsc_ap_fonavi').html(data.ap_fonavi+'%');
                $('#dsc_ap_pension').html(data.ap_fondo_juvi+'%');
            }
        });
    }



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
    $('.prev_bono').hide();
    $('.prev_modelo_liqui').hide();
    $('.prev_renuncia').hide();
}

function imprimir_word(e){

    var tipo = $('#tipo_emp').val();
    let tipoprev = $('#select_certificado' + e).val();
    let nombreruta = 'certificado_'+tipoprev;
    var nombre = $('#txtnombre').val();
    var apellido = $('#txtapellido').val();
    var nombre_emp = $('#nom_emp_lab'+ e).html();
    var nombre_com = nombre + ' ' + apellido;
    var num_doc = $('#num_doc').val();
    var nom_carpeta = "BONOS-"+ num_doc;
    var num_emp = e;
    var fecha_inicio = $('.desde_imp').html();
    var fecha_hasta = $('.hasta_imp').html();
    var fecha_inicio_num = $('.desde_imp_num').html();
    var fecha_hasta_num = $('.hasta_imp_num').html();
    var lugar_dia = $('.lugardia').html();
    var cargo = $('#cargo_emp'+ e).val();
    var logo = $('#logo_nombre'+ e).val();
    var firmante = $('.firmante_nom').html();
    var ruc = $('#ruc_emp'+ e).val();
    var fondo = $('#select_fondo'+ e).val();

    console.log('Fecha Final : '+ fecha_hasta);
    console.log('Fecha Final : '+ fecha_hasta_num);
    console.log('Fecha Expedi: ' + lugar_dia);

    console.log("RUC: " + ruc);

    $.ajax({
        type: "POST",
        //url: "../../controller/docs/certificado_m3.php",
        //url: "../../controller/docs/certificadosword.php",
        url: "../../controller/docs/"+nombreruta+".php",
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
            num_emp: num_emp,
            nombre_fondo: fondo
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
            link.download = resp.archivo+'-'+num_doc + '.docx'; // Nombre del archivo para descargar
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
    var nom_carpeta         = "BONOS-"+ num_doc;
    var num_emp             = e;
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
    formData.append('num_emp', num_emp);

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

function imprimir_certificado(){
    let e = $('#num_emp').val();// se asigna al seleccinar la empresa en el tab

    if(e == ""){
        e = 1;
    }
    let dni = $('#num_doc').val();
    let nombres = $('#txtnombre').val();
    let apellidos = $('#txtapellido').val();
    var nombreArchivo ="Certificado "+ dni + " " + nombres + " " + apellidos;
    let tipoprev = $('#select_certificado'+ e).val();
    var ficha = document.getElementById('contenido_certificado_'+tipoprev);

    let fondo = $('#select_fondo'+ e).val();
    // URL de la imagen de marca de agua (colócala manualmente aquí)
    let imagenURL = `../../assets/img/${fondo}`;

    // Estilos para la marca de agua
    let imgStyles = {
        position: 'fixed', // Posiciona la imagen en relación con la ventana del navegador
        top: '50%', // Posiciona la imagen en el centro verticalmente
        left: '50%', // Posiciona la imagen en el centro horizontalmente
        transform: 'translate(-50%, -50%)', // Centra la imagen completamente
        width: '60%', // Establece el tamaño al 60% del ancho de la ventana del navegador
        height: 'auto', // Altura automática para mantener la proporción de la imagen
        opacity: 0.3 // Opacidad de la marca de agua
    };

    // Crear un elemento <img> con la imagen de marca de agua y aplicar estilos
    let imgElement = $('<img>', {
        src: imagenURL,
        style: Object.entries(imgStyles).map(([key, value]) => `${key}:${value}`).join(';') // Convertir el objeto de estilos en una cadena de estilos CSS
    });

    if(fondo){
        // Adjuntar la imagen al contenedor del certificado
        $(ficha).prepend(imgElement);
    }
    


    var ventimp1 = window.open('', 'Imprimir');
    ventimp1.document.write('<html><head><title>'+nombreArchivo+'</title>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/css/bracket.css"></link>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/lib/bootstrap5/bootstrap.min.css">');
    ventimp1.document.write('<style> .certificado_imp{ padding-left: 200px; padding-right: 200px;}</style>');
    ventimp1.document.write('</head><body >');
    ventimp1.document.write(ficha.innerHTML);
    ventimp1.document.write('</body></html>');
    ventimp1.document.close();
    ventimp1.focus();

    ventimp1.onload = function() {
        ventimp1.print();
        imgElement.remove();
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

function imprimir_bono(){
    let dni = $('#num_doc').val();
    let nombres = $('#txtnombre').val();
    let apellidos = $('#txtapellido').val();
    var nombreArchivo ="DJ "+ dni + " " + nombres + " " + apellidos;
    let tipoprev = $('#combo_prev_bono').val();
    let ficha = document.getElementById('contenido_bono_'+tipoprev);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>'+nombreArchivo+'</title>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/css/bracket.css"></link>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/lib/bootstrap5/bootstrap.min.css">');
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

function imprimir_dj(e){
    var nombreruta          = $('#combo_prev_bono').val();     // Obtener el tipo de DJ
    var nombre              = $('#txtnombre').val();
    var apellido            = $('#txtapellido').val();
    var nombre_emp          = $('#nom_emp_lab'+ e).html();
    var nombre_com          = nombre + ' ' + apellido;
    var num_doc             = $('#num_doc').val();
    var nom_carpeta         = "BONOS-"+ num_doc;
    var ruc                 = $('#ruc_emp'+ e).val();
    var mon_ini             = $('.mon_ini').html();
    var year_ini            = $('.year_ini').html();

    // Serializa el formulario
    var formData = new FormData($('#form_bono')[0]);

    // Agrega los datos adicionales al objeto FormData
    formData.append('empresa', nombre_emp);
    formData.append('afiliado', nombre_com);
    formData.append('nombre_carpeta', nom_carpeta);
    formData.append('ruc', ruc);

    $.ajax({
        type: "POST",
        //url: "../../controller/docs/certificadosword.php",
        url: "../../controller/docs/declaracion_"+nombreruta,
        //url: "../../controller/docs/liquidacion_4.php",
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

function agregarComas(numero) {
    var numeroString = numero.toString().replace(/\,/g,'');
    var partesNumero = numeroString.split('.');
    partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return partesNumero.join('.');
}

function formatearNumero(numero) {
    // Redondea el número a dos decimales y convierte a cadena
    var numeroRedondeado = parseFloat(numero).toFixed(2);
    // Formatea el número con comas como separadores de miles
    var partes = numeroRedondeado.split(".");
    partes[0] = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    // Une las partes y agrega .00 al final si no hay decimales
    var numeroFormateado = partes.join(".");
    return numeroFormateado;
}

function formatearNumeroEntero(numero) {
    // Redondea el número hacia abajo y lo convierte a cadena
    var numeroRedondeado = Math.floor(parseFloat(numero)).toString();
    // Formatea el número con comas como separadores de miles
    var partes = [];
    var longitud = numeroRedondeado.length;
    var contador = 0;
    for (var i = longitud - 1; i >= 0; i--) {
        contador++;
        partes.unshift(numeroRedondeado[i]);
        if (contador === 3 && i !== 0) {
            partes.unshift(",");
            contador = 0;
        }
    }
    // Une las partes en una cadena
    var numeroFormateado = partes.join("");
    return numeroFormateado;
}



/*function desformatearNumero(numeroFormateado) {
    // Elimina las comas del número formateado
    var numeroSinComas = numeroFormateado.replace(/,/g, '');
    // Convierte el número sin comas a punto flotante (float) y redondea a dos decimales
    var numeroFloat = parseFloat(numeroSinComas).toFixed(2);
    // Convierte el número de nuevo a float y devuelve el resultado
    return parseFloat(numeroFloat);
}*/
function desformatearNumero(numeroFormateado) {
    //console.log('Valor inicial:', numeroFormateado);
    // Verificar si numeroFormateado es null o undefined
    if (numeroFormateado === null || numeroFormateado === undefined) {
        //console.log('Número formateado es null o undefined. Retornando 0.'); // O el valor por defecto que prefieras
        return 0;
    }
    // Elimina las comas del número formateado
    var numeroSinComas = numeroFormateado.replace(/,/g, '');
    // Convierte el número sin comas a punto flotante (float) y redondea a dos decimales
    var numeroFloat = parseFloat(numeroSinComas).toFixed(2);
    // Convierte el número de nuevo a float y devuelve el resultado
    var resultado = parseFloat(numeroFloat);
    //console.log('Valor final:', resultado);
    return resultado;
}


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


$(document).on("click","#btnboletas_dsc", function(){

    let monto = Number($('#total_monto_boleta').val());
    let prc1 = Number(monto *0.01).toFixed(2);
    let prc3 = Number(monto *0.03).toFixed(2);
    let prc6 = Number(monto *0.06).toFixed(2);

    let total_empleador = Number(prc6 * 3).toFixed(2);
    let total_trabajador = (Number(prc3) * 2  + Number(prc1)).toFixed(2);

    $('#mdltitulodsc').html('Descuento de Boleta');
    $('#modalboletasdsc').modal('show');
    $('.porcentaje_6').html(prc6);
    $('.porcentaje_3').html(prc3);
    $('.porcentaje_1').html(prc1);

    if(isNaN(monto)){
        $('.monto_mes_total').html('0');
    }else {
        $('.monto_mes_total').html(monto);
    }

    $('#total_dsc_empleador').html(total_empleador);
    $('#total_dsc_trabajador').html(total_trabajador);

});

$(".conceptos").on("input", function() {
    var total = 0;

    // Itera sobre todos los elementos con la clase ".conceptos"
    $(".conceptos").each(function() {

        //var valor = parseFloat($(this).val()) || 0; // Si el valor no es un número, asigna 0

        //var valor = parseFloat($(this).val() || 0);


        /*var valor = Number($(this).val().replace(/[^\d]/g, ''));
        var numeroFormateado = agregarComas(valor);
        $(this).val(numeroFormateado);

        if (valor !== 0) {
            total += valor;
        }  */

        var valor = parseFloat($(this).val().replace(/[^\d.]/g, '')); // Obtiene el valor como número
        var numeroFormateado = agregarComas(valor);

        if (!isNaN(valor) && valor !== 0  && valor !== "") {
            total += valor; // Suma solo si el valor es un número y no es 0
            $(this).val(numeroFormateado);
        }

    });

    // Muestra el total en la consola o donde desees mostrarlo
    //console.log("Total: " + total.toFixed(2));
    //console.log("Total Promedio: " + Number(total/12).toFixed(2));



    let sum_mes = suma_anios1 * 12 + suma_meses1;
    const constante = 0.1831;
    let prom_meses = Number(total) / 12;
    let prom_total = (Number(prom_meses) * Number(sum_mes) * constante ).toFixed(2);
    $('#prom_meses').html(prom_meses.toFixed(2));
    $('#cant_meses_bono').html(sum_mes);
    //$('#prom_total').html(formatearNumero(prom_total));
    //$('#monto_final').html(formatearNumero(prom_total));
    $('#prom_total').html(formatearNumero(prom_total));
    $('#monto_final').html(formatearNumero(prom_total));

});

$("#variable").on("input", function() {
    // Limitar la longitud total del valor a 6 caracteres (2 enteros + 1 punto + 4 decimales)
    if ($(this).val().length > 6) {
        $(this).val($(this).val().slice(0, 6));
    }
    
    // Obtener el valor actual del campo de entrada
    var valor = $(this).val();
    
    // Desformatear el número total
    let total = desformatearNumero($('#prom_total').html());
    
    // Calcular el monto final multiplicando el valor del campo de entrada por el número total
    var montofinal = Number(Number(valor) * Number(total)).toFixed(2);
    
    // Mostrar el monto final formateado en el elemento #monto_final
    $('#monto_final').html(formatearNumero(montofinal));
});


function CuadroBoletas(e){

    //Obtener las fechas al lado del DNI
    let fecha_ini = $('#fech_inicio_emp'+ e).val();
    let fecha_fin = $('#fech_final_emp'+ e).val();

    //Obtener Fecha de Nacimiento
    let fecha_naci = $('#txtdate').val();

    // Convertir la cadena de fecha de nacimiento a un objeto moment
    let fecha_nacimiento = moment(fecha_naci, 'YYYY-MM-DD');

    // Obtener la fecha actual
    let fecha_actual = moment();


    // Calcular la diferencia en años entre la fecha actual y la fecha de nacimiento
    let edad = fecha_actual.diff(fecha_nacimiento, 'years');

    // Mostrar la edad del Afiliado
    $('#edad_actual_afiliado').html(edad + " años")

    let fecha1 = new Date(fecha_ini);
    let fecha2 = new Date(fecha_fin);
    

    let fecha_i= moment(fecha1).format('DD-MM-YYYY');
    let fecha_f = moment(fecha2).format('DD-MM-YYYY');


    //Asignar las fechas
    $('#fecha_inicio_bol').html(fecha_i);
    $('#fecha_final_bol').html(fecha_f);

    $('#mdltitulo').html('Tabla de Boletas');
    $('#modalboletas').modal('show');
    $('#select_mes_boleta'+ e).select2("val", "0");
    SumarMeses();

    var total_neto = 0;
    $(".totalmesboleta").each(function() {
        if ($(this).html() != 0) {
            var valor = desformatearNumero($(this).html()); // Convierte el valor a un número flotante
            console.log(valor);
            total_neto += valor; // Suma el valor al total_neto
        }
    });

    //console.log(total_neto.toFixed(2));


    let sum_mes = suma_anios1 * 12 + suma_meses1;
    const constante = 0.1831;
    let prom_meses = Number(total_neto) / 12;
    let prom_total = (Number(prom_meses) * Number(sum_mes) * constante ).toFixed(2);


    $('#prom_meses').html(formatearNumero(prom_meses.toFixed(2)));

    console.log(prom_meses);
    $('#cant_meses_bono').html(sum_mes);
    //$('#prom_total').html(formatearNumero(prom_total));
    //$('#monto_final').html(formatearNumero(prom_total));


    $('#prom_total').html(formatearNumero(prom_total));
    $('#monto_final').html(formatearNumero(prom_total));
    $('#dni_cal_bono').html($('#num_doc').val());
}

$(document).on("click","#btnboletas", function(){

    //Obtener las fechas al lado del DNI
    let fecha_ini = $('#fech_inicio_emp').val();
    let fecha_fin = $('#fech_final_emp').val();
    //Asignar las fechas
    $('#fecha_inicio_bol').html(convertDateFormat(fecha_ini));
    $('#fecha_final_bol').html(convertDateFormat(fecha_fin));

    $('#mdltitulo').html('Tabla de Boletas');
    $('#modalboletas').modal('show');
    $('#select_mes_boleta').select2("val", "0");
    SumarMeses();

    var total_neto = 0;
    $(".totalmesboleta").each(function() {
        if ($(this).html() != 0) {
            var valor = desformatearNumero($(this).html()); // Convierte el valor a un número flotante
            total_neto += valor; // Suma el valor al total_neto
        }
    });

    //console.log(total_neto.toFixed(2));


    let sum_mes = suma_anios1 * 12 + suma_meses1;
    const constante = 0.1831;
    let prom_meses = Number(total_neto) / 12;
    let prom_total = (Number(prom_meses) * Number(sum_mes) * constante ).toFixed(2);


    $('#prom_meses').html(formatearNumero(prom_meses.toFixed(2)));
    $('#cant_meses_bono').html(sum_mes);
    //$('#prom_total').html(formatearNumero(prom_total));
    //$('#monto_final').html(formatearNumero(prom_total));


    $('#prom_total').html(formatearNumero(prom_total));
    $('#monto_final').html(formatearNumero(prom_total));
    $('#dni_cal_bono').html($('#num_doc').val());
});


$(document).on("click","#btncalculobono", function(){
    $('#mdltitulobono').html('Calculo - Bono');
    $('#modalbono').modal('show');

});

$(document).on("click","#btnclosemodal_bono", function(){
    $("#modalbono").modal('hide');
});



$(document).on("click","#btnclosemodal", function(){

    $("#modalboletas").modal('hide');
});

$(document).on("click","#btnclosemodaldsc", function(){

    $("#modalboletasdsc").modal('hide');
});

$(document).on("click","#btnprevcer_bono", function(){
    OcultarPrev();
    let tipoprev = $('#select_certificado').val();
    /*console.log("DATOS CERTIFICADO");
    console.log($('#emp_certificado').val());
    console.log($('#nombre_certificado').val());
    console.log($('#f_ini_certificado').val());
    console.log($('#f_baj_certificado').val());
    console.log($('#cargo_certificado').val());
    console.log($('#firmante_certificado').val());
    console.log($('#lugar_certificado').val());*/


    $("#prev_certificado_"+tipoprev).show();
});

$(document).on("click","#orcinea-tab", function(){
    $("#prev1").show();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev4").hide();
});

/*Funcion para formatear Fecha */
function formatearFecha(fechaString) {
    // Crear objeto de fecha
    var fecha = new Date(fechaString);

    // Obtener componentes de la fecha
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1; // Sumar 1 porque los meses van de 0 a 11
    var anio = fecha.getFullYear();

    // Formatear la fecha en el formato deseado (DD-MM-YYYY)
    var fechaFormateada = (dia < 10 ? '0' : '') + dia + '-' + (mes < 10 ? '0' : '') + mes + '-' + anio;

    return fechaFormateada;
}

function bono_tab(e){
    SumarMeses();
    let sum_mes = suma_anios1 * 12 + suma_meses1;
    const constante = 0.1831;
    let f_init = $('#fech_inicio_emp' + e).val();
    let f_final = $('#fech_final_emp' + e).val();

    let mensaje_fechas  = 'F.Inicio : ' +formatearFecha(f_init) + ' / F.Fin: ' +  formatearFecha(f_final);
    
    /*Setear mensaje de fechas */
    $('#label_fechas_' + e).html(mensaje_fechas);

    //console.log(formatearFecha(f_init));
    //console.log(formatearFecha(f_final));
    //console.log(sum_mes);

    /*MOSTRAR MONTOS DE CADA MES EN PANEL BONO */
    let total_dic = $('#dic_total').html();
    let total_ene = $('#ene_total').html();
    let total_feb = $('#feb_total').html();
    let total_mar = $('#mar_total').html();
    let total_abr = $('#abr_total').html();
    let total_may = $('#may_total').html();
    let total_jun = $('#jun_total').html();
    let total_jul = $('#jul_total').html();
    let total_ago = $('#ago_total').html();
    let total_sep = $('#sep_total').html();
    let total_oct = $('#oct_total').html();
    let total_nov = $('#nov_total').html();

    $('#dic_91' + e).val(desformatearNumero(total_dic));
    $('#ene_92' + e).val(desformatearNumero(total_ene));
    $('#feb_92' + e).val(desformatearNumero(total_feb));
    $('#mar_92' + e).val(desformatearNumero(total_mar));
    $('#abr_92' + e).val(desformatearNumero(total_abr));
    $('#may_92' + e).val(desformatearNumero(total_may));
    $('#jun_92' + e).val(desformatearNumero(total_jun));
    $('#jul_92' + e).val(desformatearNumero(total_jul));
    $('#ago_92' + e).val(desformatearNumero(total_ago));
    $('#sep_92' + e).val(desformatearNumero(total_sep));
    $('#oct_92' + e).val(desformatearNumero(total_oct));
    $('#nov_92' + e).val(desformatearNumero(total_nov));


    let prom_meses = (Number(total_dic) + Number(total_ene) + Number(total_feb) + Number(total_mar) + Number(total_abr) + Number(total_may) + Number(total_jun) + Number(total_jul) + Number(total_ago) + Number(total_sep) + Number(total_oct) + Number(total_nov)) / 12;
    let prom_total = (Number(prom_meses) * Number(sum_mes) * constante ).toFixed(2);

    $('#prom_meses').html(prom_meses.toFixed(2));
    //$('.cant_meses').html(sum_mes);
    $('#prom_total').html(prom_total);
    $('#cal_bono').val(prom_total);

}

$(document).on("click","#boleta-tab", function(){

    let anio_inicio = $("#fech_inicio_emp").val();
    let anio_final = $("#fech_final_emp").val();
    /**FUNCIONALIDAD PARA CAMBIAR LA VISIBILIDAD DE BONOS*/

    let fecha = new Date(anio_final);

    let fecha_01_65 = new Date("1965-01-01");
    let fecha_07_80 = new Date("1980-07-01");
    let fecha_01_70 = new Date("1970-01-01");

    let fecha_12_82 = new Date("1983-01-01");
    let fecha_07_99 = new Date("1999-08-01");
    let fecha_12_84 = new Date("1985-01-01");


    $('.bonif').attr("disabled", "disabled");

    if(fecha > fecha_01_65 && fecha < fecha_07_99){
        $('#boni_boleta').attr("disabled", false);
        $('#reintegro_boleta').attr("disabled", false);
        $('#bonificacion_pasajes_boleta').attr("disabled", false);
        $('#bonificacion_uniforme_boleta').attr("disabled", false);
        $('#bonificacion_gratificacion_boleta').attr("disabled", false);
    }
    if(fecha > fecha_07_80 && fecha < fecha_07_99){
        $('#bonificacion_metas_boleta').attr("disabled", false);
    }
    if(fecha > fecha_01_65 && fecha < fecha_12_82){
        $('#bonificacion_alimentos_boleta').attr("disabled", false);
    }
    if(fecha > fecha_01_70 && fecha < fecha_07_99){
        $('#bonificacion_logros_boleta').attr("disabled", false);
    }
    if(fecha > fecha_01_65 && fecha < fecha_12_84){
        $('#bonificacion_festivos_boleta').attr("disabled", false);
    }
});


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

function PrevDJ(e){
    OcultarPrev();
    let tipoprev = $('#combo_prev_bono'+ e).val();
    let dni = $('#num_doc').val();
    let numero = $('#txtcant_emp').val();

    let f_inicio = moment($('#f_inicio_'+ e).val());
    let f_fin = moment($('#f_final_'+ e).val());


    let dife1 = f_fin.diff(f_inicio, 'months');


    let mon_ini= moment(f_inicio).format('M');
    let mon_fin= moment(f_fin).format('M');
    let year_ini= moment(f_inicio).format('YYYY');
    let year_fin= moment(f_fin).format('YYYY');


    let mes12 = parseFloat($('#dic_91'+ e).val()) | 0
    let mes01 = parseFloat($('#ene_92'+ e).val()) | 0
    let mes02 = parseFloat($('#feb_92'+ e).val()) | 0
    let mes03 = parseFloat($('#mar_92'+ e).val()) | 0
    let mes04 = parseFloat($('#abr_92'+ e).val()) | 0
    let mes05 = parseFloat($('#may_92'+ e).val()) | 0
    let mes06 = parseFloat($('#jun_92'+ e).val()) | 0
    let mes07 = parseFloat($('#jul_92'+ e).val()) | 0
    let mes08 = parseFloat($('#ago_92'+ e).val()) | 0
    let mes09 = parseFloat($('#sep_92'+ e).val()) | 0
    let mes10 = parseFloat($('#oct_92'+ e).val()) | 0
    let mes11 = parseFloat($('#nov_92'+ e).val()) | 0

    $('.dni_imp').html(dni);
    $('.dic_91_imp').html(formatearNumero(mes12));
    $('.ene_92_imp').html(formatearNumero(mes01));
    $('.feb_92_imp').html(formatearNumero(mes02));
    $('.mar_92_imp').html(formatearNumero(mes03));
    $('.abr_92_imp').html(formatearNumero(mes04));
    $('.may_92_imp').html(formatearNumero(mes05));
    $('.jun_92_imp').html(formatearNumero(mes06));
    $('.jul_92_imp').html(formatearNumero(mes07));
    $('.ago_92_imp').html(formatearNumero(mes08));
    $('.sep_92_imp').html(formatearNumero(mes09));
    $('.oct_92_imp').html(formatearNumero(mes10));
    $('.nov_92_imp').html(formatearNumero(mes11));

    $('.dic_91_imp_rst').html(formatearNumero((mes12*0.03).toFixed(2)));
    $('.ene_92_imp_rst').html(formatearNumero((mes01*0.03).toFixed(2)));
    $('.feb_92_imp_rst').html(formatearNumero((mes02*0.03).toFixed(2)));
    $('.mar_92_imp_rst').html(formatearNumero((mes03*0.03).toFixed(2)));
    $('.abr_92_imp_rst').html(formatearNumero((mes04*0.03).toFixed(2)));
    $('.may_92_imp_rst').html(formatearNumero((mes05*0.03).toFixed(2)));
    $('.jun_92_imp_rst').html(formatearNumero((mes06*0.03).toFixed(2)));
    $('.jul_92_imp_rst').html(formatearNumero((mes07*0.03).toFixed(2)));
    $('.ago_92_imp_rst').html(formatearNumero((mes08*0.03).toFixed(2)));
    $('.sep_92_imp_rst').html(formatearNumero((mes09*0.03).toFixed(2)));
    $('.oct_92_imp_rst').html(formatearNumero((mes10*0.03).toFixed(2)));
    $('.nov_92_imp_rst').html(formatearNumero((mes11*0.03).toFixed(2)));

    $('.cant_meses').html(dife1);
    $('.year_ini').html(year_ini);
    $('.year_fin').html(year_fin);
    $('.mon_ini').html(mon_ini);
    $('.mon_fin').html(mon_fin);

    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev4").show();
    $("#prev_bono_"+tipoprev).show();

}

$(document).on("click","#btnprevbono", function(){
    OcultarPrev();
    let tipoprev = $('#combo_prev_bono').val();
    let dni = $('#num_doc').val();
    let numero = $('#txtcant_emp').val();

    let f_inicio = moment($('#f_inicio_'+numero).val());
    let f_fin = moment($('#f_final_'+numero).val());


    let dife1 = f_fin.diff(f_inicio, 'months');

    let mon_ini= moment(f_inicio).format('M');
    let mon_fin= moment(f_fin).format('M');
    let year_ini= moment(f_inicio).format('YYYY');
    let year_fin= moment(f_fin).format('YYYY');


    let mes12 = parseFloat($('#dic_91').val()) | 0
    let mes01 = parseFloat($('#ene_92').val()) | 0
    let mes02 = parseFloat($('#feb_92').val()) | 0
    let mes03 = parseFloat($('#mar_92').val()) | 0
    let mes04 = parseFloat($('#abr_92').val()) | 0
    let mes05 = parseFloat($('#may_92').val()) | 0
    let mes06 = parseFloat($('#jun_92').val()) | 0
    let mes07 = parseFloat($('#jul_92').val()) | 0
    let mes08 = parseFloat($('#ago_92').val()) | 0
    let mes09 = parseFloat($('#sep_92').val()) | 0
    let mes10 = parseFloat($('#oct_92').val()) | 0
    let mes11 = parseFloat($('#nov_92').val()) | 0

    $('.dni_imp').html(dni);
    $('.dic_91_imp').html(formatearNumero(mes12));
    $('.ene_92_imp').html(formatearNumero(mes01));
    $('.feb_92_imp').html(formatearNumero(mes02));
    $('.mar_92_imp').html(formatearNumero(mes03));
    $('.abr_92_imp').html(formatearNumero(mes04));
    $('.may_92_imp').html(formatearNumero(mes05));
    $('.jun_92_imp').html(formatearNumero(mes06));
    $('.jul_92_imp').html(formatearNumero(mes07));
    $('.ago_92_imp').html(formatearNumero(mes08));
    $('.sep_92_imp').html(formatearNumero(mes09));
    $('.oct_92_imp').html(formatearNumero(mes10));
    $('.nov_92_imp').html(formatearNumero(mes11));

    $('.dic_91_imp_rst').html(formatearNumero((mes12*0.03).toFixed(2)));
    $('.ene_92_imp_rst').html(formatearNumero((mes01*0.03).toFixed(2)));
    $('.feb_92_imp_rst').html(formatearNumero((mes02*0.03).toFixed(2)));
    $('.mar_92_imp_rst').html(formatearNumero((mes03*0.03).toFixed(2)));
    $('.abr_92_imp_rst').html(formatearNumero((mes04*0.03).toFixed(2)));
    $('.may_92_imp_rst').html(formatearNumero((mes05*0.03).toFixed(2)));
    $('.jun_92_imp_rst').html(formatearNumero((mes06*0.03).toFixed(2)));
    $('.jul_92_imp_rst').html(formatearNumero((mes07*0.03).toFixed(2)));
    $('.ago_92_imp_rst').html(formatearNumero((mes08*0.03).toFixed(2)));
    $('.sep_92_imp_rst').html(formatearNumero((mes09*0.03).toFixed(2)));
    $('.oct_92_imp_rst').html(formatearNumero((mes10*0.03).toFixed(2)));
    $('.nov_92_imp_rst').html(formatearNumero((mes11*0.03).toFixed(2)));

    //$('.cant_meses').html(dife1);
    $('.year_ini').html(year_ini);
    $('.year_fin').html(year_fin);
    $('.mon_ini').html(mon_ini);
    $('.mon_fin').html(mon_fin);

    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev4").show();
    $("#prev_bono_"+tipoprev).show();

});



$(document).on("click","#btnprevbol", function(){

    OcultarPrev();
    let estado = $('select[name="select_mes_boletas"] option:selected').text();
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
            fecha_boleta = "31 DE DICIEMBRE DE 1991";
            break;
        case "ene":
            fecha_boleta = "31 DE ENERO DE 1992";
            break;
        case "feb":
            fecha_boleta = "29 DE FEBRERO DE 1992";
            break;
        case "mar":
            fecha_boleta = "31 DE MARZO DE 1992";
            break;
        case "abr":
            fecha_boleta = "30 DE ABRIL DE 1992";
            break;
        case "may":
            fecha_boleta = "30 DE MAYO DE 1992";
            break;
        case "jun":
            fecha_boleta = "30 DE JUNIO DE 1992";
            break;
        case "jul":
            fecha_boleta = "31 DE JULIO DE 1992";
            break;
        case "ago":
            fecha_boleta = "31 DE AGOSTO DE 1992";
            break;
        case "sep":
            fecha_boleta = "30 DE SEPTIEMBRE DE 1992";
            break;
        case "oct":
            fecha_boleta = "31 DE OCTUBRE DE 1992";
            break;
        case "nov":
            fecha_boleta = "31 DE NOVIEMBRE DE 1992";
            break;
    }


    let monto = Number($('#total_monto_boleta').val());
    let prc1 = Number(monto *0.01).toFixed(2);
    let prc3 = Number(monto *0.03).toFixed(2);
    let prc6 = Number(monto *0.06).toFixed(2);
    let total_empleador = Number(prc6 * 3).toFixed(2);
    let total_trabajador = (Number(prc3) * 2  + Number(prc1)).toFixed(2);
    let total_descuentos = (Number(total_empleador) - Number(total_trabajador)).toFixed(2);
    let total_neto = Number(total_boleta) - Number(total_empleador) - Number(total_trabajador);
    let total_bol = boni + horaex ;
    let sum_sdo_bono = Number(sueldo_boleta) + Number(boni_boleta);
    let neto_bol_7 = (Number(sum_sdo_bono) - prc6 - prc1).toFixed(2);
    let neto_bol_10 = (Number(total_boleta) + Number(total_trabajador)).toFixed(2) ;
    let neto_bol_16 = (Number(sueldo_boleta)) + (Number(h_extras_boleta));
    let total_neto_16 =(Number(neto_bol_16) - Number(total_descuentos));

    $('.mes_anio_imp').html(estado.toUpperCase());
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
    $('.porcentaje_6_boleta').html(prc6);
    $('.porcentaje_3_boleta').html(prc3);
    $('.porcentaje_1_boleta').html(prc1);
    $('.total_dsc_empleador_boleta').html(total_empleador);
    $('.total_dsc_trabajador_boleta').html(total_trabajador);
    $('.total_descuentos_boleta').html(total_descuentos);
    $('.total_neto_pagar_boleta').html(total_neto);
    $('.total_sueldo_bono').html(sum_sdo_bono);
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

$(document).on("click","#btnlimpiar", function(){
    $("#divresultado").hide();
    $('#bono_form')[0].reset();
    $('#cargoc').select2("val", "0");
    $('#txtdate').val("");
    $('#cant_emp').select2("val", "0");
    $('#af_id').val("");
    $('#tipo_doc').select2("val", "0");
    $("#contemp1").hide();
    $('#temp_servicio').hide();

    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev4").hide();
    $("#contemp1").hide();
    $('#temp_servicio').hide();
    $("#tiempo_servicio").html("");
    $("#tiempo_bono").html("");

    anios_bono = 0;
    meses_bono = 0;
    dias_bono = 0;

    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;

    suma_anios1 = 0;
    suma_meses1 = 0;
    suma_dias1 = 0;
});

function PrevCertificado(e) {
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
        let tipoprev = $('#select_certificado'+e).val();
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
        let tiempo_anio = $('#tiempo_imp'+ e).val();

        //Certificado
        let certificado = $('#select_certificado' + e).val();
        //Fondo
        let fondo = $('#select_fondo'+ e).val();
        let imagenURL = `../../assets/img/${fondo}`;
        $(`#contenido_certificado_${certificado}`).css({
            'background-image': 'url(' + imagenURL + ')',
            'background-size': '50%', // Establece el tamaño al 50%
            'background-position': 'center', // Centra la imagen
            'background-repeat': 'no-repeat' // Evita que la imagen se repita
        });

        //Asignar datos
        $('.emp_imp').html(nom);
        $('.cargo_imp').html(cargo);

        $('.desde_imp').html(fecha1.toLocaleDateString("es-ES", options).toUpperCase());
        $('.hasta_imp').html(fecha2.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_num').html(fecha1num);
        $('.hasta_imp_num').html(fecha2num);
        $('.ruc_imp').html(ruc);
        $('.lugardia').html(dpto1+", "+fecha_emi.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_low').html(fecha1.toLocaleDateString("es-ES", options));
        $('.hasta_imp_low').html(fecha2.toLocaleDateString("es-ES", options));
        $('.lugardia_low').html(dpto1+", "+fecha2.toLocaleDateString("es-ES", options));
        $('.tiempo_imp').html(tiempo_anio);
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

function PrevLiquidacion(e){
    let fechad = $('#fecha_liquidacion'+ e).val();
    let fechaloc = new Date(fechad);
    var fechaimod = fechaloc.toLocaleString('en-US', {
        timeZone: 'Europe/London'
    });
    var fecha_emi = new Date(fechaimod);
    let fecha_fin = $('#fech_final_emp'+e).val();
    let dpto1 = $('#dpto_emp'+ e).val();
    let fecha_ff = new Date (fecha_fin);


    if(fecha_emi >= fecha_ff && fechad != "" ){
        OcultarPrev();
        $("#prev1").hide();
        $("#prev2").show();
        $("#prev3").hide();

        let tiempo_anio = $('#tiempo_imp'+ e).val();
        $('.tiempo_imp').html(tiempo_anio);

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

function PrevBoleta(e){
    calcularTotalBoleta(e);
    OcultarPrev();

    let nom = $('#nombre_emp'+ e).val();
    let estado = "";
    let anio_final = $('#fech_final_emp'+ e).val();
    let anio_boleta_final = new Date(anio_final).getFullYear();
    if(anio_boleta_final >= 1991){
        estado = $('select[name="select_mes_boleta'+ e +'"] option:selected').text();
    }else {
        let estado_anio2 = $('select[name="select_anio_boletas'+ e +'"] option:selected').text();
        estado = ($('select[name="select_mes_boleta'+ e +'"] option:selected').text()) + " DE "+ estado_anio2;
    }
    let estado_anio = "1992";
    let mes = $('#select_mes_boleta'+ e).val();
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
            fecha_boleta = "31 DE "+ estado.toUpperCase() ;
            break;
        case "ene":
            fecha_boleta = "31 DE "+ estado.toUpperCase() ;
            break;
        case "feb":
            fecha_boleta = "29 DE "+ estado.toUpperCase();
            break;
        case "mar":
            fecha_boleta = "31 DE "+ estado.toUpperCase() ;
            break;
        case "abr":
            fecha_boleta = "30 DE "+ estado.toUpperCase() ;
            break;
        case "may":
            fecha_boleta = "30 DE "+ estado.toUpperCase() ;
            break;
        case "jun":
            fecha_boleta = "30 DE "+ estado.toUpperCase();
            break;
        case "jul":
            fecha_boleta = "30 DE "+ estado.toUpperCase();
            break;
        case "ago":
            fecha_boleta = "31 DE "+ estado.toUpperCase();
            break;
        case "sep":
            fecha_boleta = "30 DE "+ estado.toUpperCase();
            break;
        case "oct":
            fecha_boleta = "31 DE "+ estado.toUpperCase();
            break;
        case "nov":
            fecha_boleta = "31 DE "+ estado.toUpperCase();
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
    let total_neto_4 = Number(Number(sueldo_boleta) - Number(total_descuentos)).toFixed(2);
    let neto_bol_7 = (Number(sum_sdo_bono) - Number(dsc_at_fonavi_monto) - Number(dsc_ap_fonavi_monto)).toFixed(2);
    let neto_bol_10 = (Number(total_boleta) - Number(total_trabajador)).toFixed(2) ;
    let neto_bol_16 = (Number(sueldo_boleta)) + (Number(h_extras_boleta));
    let total_neto_16 = (Number(neto_bol_16) - Number(total_descuentos));
    let total_neto_1 = (Number(total_boleta) - Number(dsc_at_fonavi_monto) - Number(dsc_ap_fonavi_monto));
    /*console.log(neto_bol_16);
    console.log(total_descuentos);
    console.log(total_neto_16);*/
    $('.mes_anio_imp').html(estado.toUpperCase());
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

function boleta_tab(e){
    //let div = "<option label='Seleccione'></option>";
    let anio_inicio = $("#fech_inicio_emp"+ e).val();
    let anio_final = $("#fech_final_emp" + e).val();
    let anio_boleta_inicio = new Date(anio_inicio).getFullYear();
    let anio_boleta_final = new Date(anio_final).getFullYear();
    let incremento = anio_boleta_inicio;

    if(anio_boleta_final >= 1991){

        $('#btnboletas'+ e).attr("disabled", false);
        $('#anio_bol'+ e).hide();
        let tabContent;
        tabContent += '<option label="Seleccione"></option>';
        tabContent += '<option value="dic">Diciembre  1991</option>';
        tabContent += '<option value="ene">Enero - 1992</option>';
        tabContent += '<option value="feb">Febrero - 1992</option>';
        tabContent += '<option value="mar">Marzo - 1992</option>';
        tabContent += '<option value="abr">Abril - 1992</option>';
        tabContent += '<option value="may">Mayo - 1992</option>';
        tabContent += '<option value="jun">Junio - 1992</option>';
        tabContent += '<option value="jul">Julio - 1992</option>';
        tabContent += '<option value="ago">Agosto - 1992</option>';
        tabContent += '<option value="sep">Septiembre - 1992</option>';
        tabContent += '<option value="oct">Octubre - 1992</option>';
        tabContent += '<option value="nov">Noviembre - 1992</option>';
        $('#select_mes_boleta'+ e).html(tabContent);
    }else {

        $('#btnboletas'+ e).attr("disabled", true);
        $('#anio_bol'+ e).show();
        let div;
        for( incremento; incremento <= anio_boleta_final ; incremento++){
            div+= "<option value="+incremento+">"+incremento+"</option>";
        }
        $('#select_anio_boletas'+ e).html(div);
        let tabContent;
        tabContent += '<option label="Seleccione"></option>';
        tabContent += '<option value="all">Año</option>';
        tabContent += '<option value="dic">Diciembre</option>';
        tabContent += '<option value="ene">Enero </option>';
        tabContent += '<option value="feb">Febrero </option>';
        tabContent += '<option value="mar">Marzo </option>';
        tabContent += '<option value="abr">Abril </option>';
        tabContent += '<option value="may">Mayo </option>';
        tabContent += '<option value="jun">Junio </option>';
        tabContent += '<option value="jul">Julio </option>';
        tabContent += '<option value="ago">Agosto </option>';
        tabContent += '<option value="sep">Septiembre </option>';
        tabContent += '<option value="oct">Octubre </option>';
        tabContent += '<option value="nov">Noviembre </option>';
        $('#select_mes_boleta'+ e).html(tabContent);
    }



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


function DescargarZip(){
    //console.log("Descargar ZIP");

    var num_doc             = $('#num_doc').val();
    var nom_carpeta         = "BONOS-"+ num_doc;
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
        console.log(tipoprev);
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
    var nom_carpeta = "BONOS-"+ num_doc;
    var num_emp = e;
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
            dni: num_doc,
            num_emp : num_emp
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
            link.download = resp.archivo+'-'+num_doc + '.docx'; // Nombre del archivo para descargar
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


    var mes_boletas         = $('#select_mes_boleta'+ e).val();
    var anios               = $('#select_anio_boletas'+ e).val();
    var boleta              = $('#combo_prev_boleta'+ e).val();
    var nombreruta          = 'boleta_'+ boleta +'.php';

    //var nombreruta          = 'boleta_1.php';
    var nombre              = $('#txtnombre').val();
    var apellido            = $('#txtapellido').val();
    var nombre_emp          = $('#nom_emp_lab'+ e).html();
    var nombre_com          = nombre + ' ' + apellido;
    var num_doc             = $('#num_doc').val();
    var nom_carpeta         = "BONOS-"+ num_doc;
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
        console.log(mes_boletas);
        // Recorrer el array e imprimir cada mes
        mesesDelAnio.forEach(function(mes, indice) {
            //console.log(`Mes ${indice + 1}: ${mes}`);
            formData.append('mes_anio', mes+ '-'+anios);
            console.log(mes+ '-'+anios);
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

function SeleccionarFirmante(){
    let firmante = $("input[name='firmante']:checked").val();
    let num = $('#num_empresa').val();

    $('#firmante'+ num).val(firmante);

    $('#modalfirmante').modal('hide');
}

function CerrarFirmante() {
    $('#modalfirmante').modal('hide');
}

function CerrarFirmanteActualizar() {
    $('#modalactualizar').modal('hide');
}

function convertirFecha(stringFecha) {
    // Buscar la primera aparición de la fecha en el string usando una expresión regular
    var regex = /(\d{2}\/\d{2}\/\d{4})/;
    var match = stringFecha.match(regex);

    // Verificar si se encontró una fecha
    if (match) {
        // Obtener la fecha coincidente
        var fecha = match[0];

        // Dividir la fecha por el delimitador "/" para obtener día, mes y año
        var partesFecha = fecha.split('/');

        // Construir la fecha en el formato deseado (DD-MM-YYYY)
        var fechaFormateada = partesFecha[0] + '-' + partesFecha[1] + '-' + partesFecha[2];

        // Devolver la fecha formateada
        return fechaFormateada;
    } else {
        return "";
    }
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

        //Segundo AJAX
        $.ajax({
            type: "POST",  // Método de la solicitud
            url: "../../controller/pensioncontrolador.php?op=consulta_api_sunat_fecha_fin",  // Ruta de tu archivo PHP en el servidor
            data: { ruc : ruc_emp},  // Datos que se enviarán al servidor
            dataType: 'json',  // Tipo de datos esperados en la respuesta
            async : false,
            success: function(response) {
                // Manejar la respuesta exitosa del servidor

                if(response.success == true){

                    //console.log(response.data);
                    //console.log(response.data.estado_contribuyente);
                    let fecha_cese = convertirFecha(response.data.estado_contribuyente);
                    //console.log(fecha_cese);
                    if(fecha_cese != 'ACTIVO'){
                        $('#lb_fecha_fin').html(fecha_cese);
                        datos_empresa.fecha_fin = fecha_cese;

                    }else {
                        $('#lb_fecha_fin').html('-');
                        datos_empresa.fecha_fin = '';
                    }

                    // $('#div_firmante_actualizar').html(divs);
                    // $('#modalactualizar').modal('show');
                    // $('#ruc_empresa_firmante').val(ruc_emp);
                }else {
                    //
                    console.log("Error al Segundo AJAX");
                }
            },
            error: function(error) {
            // Manejar errores en la solicitud
                console.error('Error en la solicitud AJAX:', error);
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

$(document).on("click","#btnclosemodal_empresa", function(){

    $("#modalempresas").modal('hide');
});


init();