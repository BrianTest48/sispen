var suma_anios = 0;
var suma_meses = 0;
var suma_dias = 0;
var firma1 = "";

var fecha_inicial_1;
var fecha_fin_1;
var fecha_inicial_2;
var fecha_fin_2;
var fecha_inicial_3;
var fecha_fin_3;
var fecha_inicial_4;
var fecha_fin_4;
var fecha_inicial_5;
var fecha_fin_5;


$(document).ready(function(){ 
    OcultarPrev();
    $("#divresultado").hide();
    $("#form_datos").hide();
    $("#resultado_pdf").hide();
    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#contemp1").hide();
    $('#temp_servicio').hide();

    $('#tipo_doc').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });

    $('#select_mes_boletas').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });

    $('#select_anio_boletas').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });
    
    $('#select_certificado').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });

    $('#combo_prev_boleta').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });
    $('#combo_prev_liqui').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });
    
    $('#btnguardarpension').hide();
    //$('.tables').DataTable();

    //Recuperar datos del combo MOTIVO CESE
    $.post("../../controller/motivocontrolador.php?op=combo",{},function(data){
        $('#combo_prev_liqui').html(data);
    }); 

    //Cuando se edita la Lista
    var listaId = getParameterByName('lista');

    if(listaId == ""){
        //console.log("VACIO");
    }else {
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
    console.log(n);
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
        $('#firmante'+i).select2({
            placeholder: "Seleccione",
            minimumResultsForSearch: Infinity  
        });
    }
    
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
            activarcargos();
                
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
                    let cant = datos.cantidad;
                    for( let i = 1 ; i <= cant ; i++){
                        $("#f_inicio_"+i).val(datos["fech"+i]);
                        $("#f_final_"+i).val(datos["fech_final_"+i]);
                        $("#cargoc"+i).val(datos["cargo"+i]).trigger('change');
                        $("#logo"+i).val(datos["logo"+i]).trigger('change');
                        //mostrardetalle(i, 0, 0);
                        BuscarEmp(i);
                        mostrardetalle(i, datos["ruc"+i], 1);
                        $("#firmante"+i).val(datos["firmante"+i]).trigger('change');
                        //ListarFirmante(i);
                        
                        //console.log("EMPRESA_"+i);
                    }
                
                    $('#prev1').hide();
                    //mostrardetalle(1, datos["ruc1"], 1);
                    //$("#logo1").val(datos["logo1"]).trigger('change');
                    //$(".firmante_nom").html(datos["firmante1"]);
                    //console.log(datos["firmante1"]);
                    //$('#btnmostrarempr_1').click();   
                    //sumarfechas();   
                }else {

                }    
            });

            
            
        }
    }); 

}

function creardivsempresa(){
    numero = $("#txtcant_emp").val();
    var div = "";
    for ( var i = 1; i <= numero; i++){
        //console.log(i);
        div+=  '<div class="accordion-item" id="col_emp_'+i+'">'+
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
                                    "<div class='col-12 col-sm-5'>"+
                                        "<div class='form-group' >"+
                                            "<label class='form-control-label'>Desde</label>"+
                                            "<input class='form-control'   type='date' max='2099-12-31' min='1900-12-31' id='f_inicio_"+i+"'>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-5'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Hasta</label>"+
                                            "<input class='form-control'  type='date' max='2999-12-31' min='1900-12-31' id='f_final_"+i+"' >"+
                                        "</div>"+
                                    "</div>"+
                                     "<div class ='col-12 col-sm-2'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label' style='color:white;'>.</label>"+
                                            "<button class='btn btn-info' id='buscarEmp_"+i+"'onclick='BuscarEmp("+i+")' style='width: 100%'>Buscar</button>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-12'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label' for='lst_emp_"+i+"'>Empresa</label>"+
                                            "<select class='form-control select2' name='lst_emp_"+i+"' id='lst_emp_"+i+"' data-placeholder='Seleccione' style='width: 100%' required onchange='ListarFirmante("+i+")'></select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-4'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Tiempo</label>"+
                                            "<input type='text' class='form-control' id='rango_emp_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-4 '>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Sueldo</label>"+
                                            "<input type='text' class='form-control' id='fech_sueldo_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-4'>"+
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
                                //"<div class='pd-b-10 text-center fw-lighter fst-italic pb-2 border-bottom border-top border-info ' style='font-size: 13px;' >Tiempo de servicio: <label id='tiempo_"+i+"' ></label></div>"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='cargoc"+i+"' class='col-sm-3 col-form-label'>Cargo:</label>"+
                                    "<div class='col-sm-9'>"+
                                        "<select required id='cargoc"+i+"' name='cargoc"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%' >"+
                                        "</select>"+
                                    "</div>"+
                                "</div><!-- row -->"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='firmantec"+i+"' class='col-sm-3 col-form-label'>Firmante:</label>"+
                                    "<div class='col-sm-9'>"+
                                        "<select required id='firmante"+i+"' name='firmante"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%'>"+
                                            "<option label='Seleccione'></option>"+
                                            "<option value='0'>SIN FIRMANTE</option>"+
                                        "</select>"+
                                    "</div>"+
                                "</div><!-- row -->"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='logo"+i+"' class='col-sm-3 col-form-label'>Logo:</label>"+
                                    "<div class='col-sm-5'>"+
                                        "<select required id='logo"+i+"' name='logo"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%' onchange='ListarLogo("+i+")' >"+
                                        "</select>"+
                                    "</div>"+
                                    "<div class='col mg-r-15 bd' id='div_logo_"+i+"'>"+
                                        "<img id='logo_img_"+i+"' src='../../assets/img/no-fotos.png' alt='' width='100px' height='60px'>"+
                                    "</div>"+
                                "</div><!-- row -->"+
                                "<div class='text-right mg-t-10'>"+
                                    "<button type='button' id='btnmostrarempr_"+i+"' name='btnmostrarempr_"+i+"' onclick='mostrardetalle("+i+", 0, 0)' class='btn btn-info' >Mostrar Documentos</button>"+
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
                        /*$.post("../../controller/pensioncontrolador.php?op=consulta_dni",{dni: doc},function(data){
                            if(data != ""){
                                data = JSON.parse(data);
                                $('#txtnombre').val(data.nombres);
                                $('#txtapellido').val(data.apellidoPaterno + ' '+data.apellidoMaterno);
                            }
                        }); */

                        $.post("../../controller/pensioncontrolador.php?op=consulta_dni_nac",{dni: doc},function(data){
                            //console.log(data);
                            if(data != ""){
                                data = JSON.parse(data);
                                $('#txtnombre').val(data.data.nombres);
                                $('#txtapellido').val(data.data.apellidoMaterno + ' '+data.data.apellidoPaterno);
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
                $("#form_datos").show();
                $('#form_datos').removeClass().addClass('form-layout form-layout-1 ');  

                $.post("../../controller/listacontrolador.php?op=mostrar",{num_doc: doc,  lista : t_lista },function(datos){
                    if(datos != ""){
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


function BuscarEmp(a){

    let fech1 = $('#f_inicio_'+a).val();
    let fech_final_1 =$('#f_final_'+a).val();
    var fnac = $('#txtdate').val();
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

                $.post("../../controller/pensioncontrolador.php?op=combo",{txtdateinicio: fech1 , txtdatefin: fech_final_1}, function(data){
                    if(data == ""){
                        console.log("NO EXISTE DATA");
                    }else {
                        $("#lst_emp_"+a).html(data);
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

function mostrardetalle(a, b, c){  

    $('#combo_prev_liqui').select2("val", "0");
    OcultarPrev();
    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;
    $('#form_liqui')[0].reset();
    $('#form_bol')[0].reset();
    var fnac = $('#txtdate').val();
    let fech1 = $('#f_inicio_'+a).val();
    let fech_final_1 =$('#f_final_'+a).val();
    var cargo = $('#cargoc'+a).val();
    let logos = $('#logo'+a).val();
    let depas ;
    var nom;
    var razsocialruc ;
    let valor_busqueda ;
    let manana = moment(fnac).add(16, 'years').format('YYYY-MM-DD');
    var options = { year: 'numeric', month: 'long', day: 'numeric' };

    
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

               
                $.post("../../controller/pensioncontrolador.php?op=buscardpto",{txtdateinicio: fech1 , txtdatefin: fech_final_1, txtrazon : razsocialruc},function(data){
                    //console.log("SEGUNDA BUSQUEDA");

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
                        $('#nom_emp_'+a).html(data[0]['empleador']);
                        $('#fech_sueldo_'+a).val(data[0]['moneda_sueldo']);
                        $('#cant_sueldo_'+a).val(data[0]['fechsueldo']);
                        $('#nom_emp_lab').html(data[0]['empleador']);
                        $('#nom_emp_lab').val(data[0]['empleador']);
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

                        //console.log($('#firmante'+a).val());
                        /*OBETNER COMBO FIRMANTE */
                        /*$.post("../../controller/firmacontrolador.php?op=combo",{numero : data[0]['ruc']}, function(data){
                            //console.log(data);
                            $("#firmante"+a).html(data);  
                        });*/
                        
                        
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
                        
                        //console.log(firm);
                        //$('#firmante'+a).val(firm).trigger('change');
                        
                        $('.emp_imp').html(nom);
                        $('.nombre_imp').html(nombres+" "+apelli);
                        $('.cargo_imp').html(cargo);
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
                        $('#dias_liqui').val(data[0]['Dias']);
                        $('#meses_liqui').val(data[0]['Meses']);
                        $('#anios_liqui').val(data[0]['Anios']);

                        sumarfechas();
                        MostrarCertificados(data[0]['tipo_emp']);
                        MostrarLiquidacion(fech_final_1, data[0]['tipo_emp']);
                        
                    }
                    
                });
                

                //$("#lst_emp_"+a).val(razsocialruc).trigger('change');
                $("#contemp1").show();
                $("#resultado_pdf").show();
                $("#prev1").show();
                //$("#prev_certificado_1").show();
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
    $('#orcinea-tab').click();
    /*$('#firmante'+a).val(firma1).trigger('change');
    console.log(firma1);*/

}

function MostrarCertificados(valor){

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
    
    }

    $("#select_certificado").html(div_tipo);
}
function MostrarLiquidacion(valor, tipo){
    let fecha = new Date(valor);
    let anio = fecha.getFullYear();

    switch (tipo) {
        case 'P':
            if(anio >= 1960 && anio <=1970){
                $('#bonif_extra').attr("disabled", "disabled");
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", false);
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }else if(anio >= 1971 && anio <=1980){
                $('#bonif_extra').attr("disabled", false);
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", false);
                $('#bonif_dia').attr("disabled", false);
                $('#bonif').attr("disabled", false);
            }else if(anio >= 1981 && anio <=1999){
                $('#bonif_extra').attr("disabled", false);
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", "disabled");
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }else {
                $('#bonif_extra').attr("disabled","disabled");
                $('#bonif_meta').attr("disabled", "disabled");
                $('#bonif_gra').attr("disabled", "disabled");
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }
            break;
        case 'M':
            if(anio >= 1960 && anio <=1970){
                $('#bonif_extra').attr("disabled", "disabled");
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", false);
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }else if(anio >= 1971 && anio <=1980){
                $('#bonif_extra').attr("disabled", false);
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", false);
                $('#bonif_dias').attr("disabled", false);
                $('#bonif').attr("disabled", false);
            }else if(anio >= 1981 && anio <=1999){
                $('#bonif_extra').attr("disabled", false);
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", "disabled");
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }else {
                $('#bonif_extra').attr("disabled",false);
                $('#bonif_meta').attr("disabled", "disabled");
                $('#bonif_gra').attr("disabled", "disabled");
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }
            break;
        case 'G':
            if(anio >= 1960 && anio <=1970){
                $('#bonif_extra').attr("disabled", "disabled");
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", false);
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }else if(anio >= 1971 && anio <=1980){
                $('#bonif_extra').attr("disabled", false);
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", false);
                $('#bonif_dias').attr("disabled", false);
                $('#bonif').attr("disabled", false);
            }else if(anio >= 1981 && anio <=1999){
                $('#bonif_extra').attr("disabled", false);
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", "disabled");
                $('#bonif_dias').attr("disabled", "disabled");
                $('#bonif').attr("disabled", false);
            }else {
                $('#bonif_extra').attr("disabled",false);
                $('#bonif_meta').attr("disabled", false);
                $('#bonif_gra').attr("disabled", false);
                $('#bonif_dias').attr("disabled", false);
                $('#bonif').attr("disabled", false);
            }
            break;
        
    }
}

function ListarFirmante(a){
    let estado = $('select[name="lst_emp_'+a+'"] option:selected').text();
    let ruc = $("#lst_emp_"+a).val();

    //ruc_empresa = $("#lst_emp_"+a).val();
    $('#nom_emp_'+a).html(estado);
 
    $.post("../../controller/firmacontrolador.php?op=combo",{numero : ruc}, function(data){
        //console.log(data);
        $("#firmante"+a).html(data);  
    });
    
    $.post("../../controller/empresacontrolador.php?op=combovigencia",{numero : ruc}, function(data){
        if(data != ""){
            data = JSON.parse(data);
            //console.log(data);
            $('#rango_emp_'+a).val(data.f_inic_act +" / "+ data.f_baja_act);   
        }
    }); 
}

function ListarLogo(a){
    let estado = $("#logo"+a).val();
    if(estado == 'no-fotos.png'){
        $("#logo_img_"+a).attr("src",""); 
        $('#div_logo_'+a).hide();
    }else {
        $("#logo_img_"+a).attr("src","../../assets/img/"+estado); 
        $('#div_logo_'+a).show();
    }
    
}

function GuardarLista(){
    //console.log("PRUEBA");
    let tipo_lista = $("#tipo_lista").val();
    let id_lista = $("#lista_id").val();
    let af_id = $("#af_id").val();
    let num_doc = $("#num_doc").val();
    let cantidad = $("#txtcant_emp").val();
    let fecha_nac = $("#txtdate").val()
    let fech_inicio1 = $("#f_inicio_1").val();
    let fech_final1 = $("#f_final_1").val();
    let cargo1 = $("#cargoc1").val();
    let logo1 = $("#logo1").val();
    let ruc1 = $("#lst_emp_1").val();
    let firmante1 = $("#firmante1").val();
    let fech_inicio2 = $("#f_inicio_2").val();
    let fech_final2 = $("#f_final_2").val();
    let cargo2 = $("#cargoc2").val();
    let logo2 = $("#logo2").val();
    let ruc2 = $("#lst_emp_2").val();
    let firmante2 = $("#firmante2").val();
    let fech_inicio3 = $("#f_inicio_3").val();
    let fech_final3 = $("#f_final_3").val();
    let cargo3 = $("#cargoc3").val();
    let logo3 = $("#logo3").val();
    let ruc3 = $("#lst_emp_3").val();
    let firmante3 = $("#firmante3").val();
    let fech_inicio4 = $("#f_inicio_4").val();
    let fech_final4 = $("#f_final_4").val();
    let cargo4 = $("#cargoc4").val();
    let logo4 = $("#logo4").val();
    let ruc4 = $("#lst_emp_4").val();
    let firmante4 = $("#firmante4").val();
    let fech_inicio5 = $("#f_inicio_5").val();
    let fech_final5 = $("#f_final_5").val();
    let cargo5 = $("#cargoc5").val();
    let logo5 = $("#logo5").val();
    let ruc5 = $("#lst_emp_5").val();
    let firmante5 = $("#firmante5").val();
    console.log(ruc1 + " "+ firmante1);
    //console.log(ruc_empresa);
    $.post("../../controller/listacontrolador.php?op=guardaryeditar",{
            af_id : af_id,
            documento : num_doc,
            txtcant_emp : cantidad,
            txtdate : fecha_nac,
            f_inicio_1 : fech_inicio1,
            f_final_1 : fech_final1,
            ruc_emp1 : ruc1,
            cargoc1 : cargo1,
            firmante1 : firmante1,
            logo1 : logo1,
            f_inicio_2 : fech_inicio2,
            f_final_2 : fech_final2,
            ruc_emp2 : ruc2,
            cargoc2 : cargo2,
            firmante2 : firmante2,
            logo2 : logo2,
            f_inicio_3 : fech_inicio3,
            f_final_3 : fech_final3,
            ruc_emp3 : ruc3,
            cargoc3 : cargo3,
            firmante3 : firmante3,
            logo3 : logo3,
            f_inicio_4 : fech_inicio4,
            f_final_4 : fech_final4,
            ruc_emp4 : ruc4,
            cargoc4 : cargo4,
            firmante4 : firmante4,
            logo4 : logo4,
            f_inicio_5 : fech_inicio5,
            f_final_5 : fech_final5,
            ruc_emp5 : ruc5,
            cargoc5 : cargo5,
            firmante5 : firmante5,
            logo5 : logo5,
            lista : id_lista,
            tipo : tipo_lista
        }, function(data){
            console.log("GUARDO");
            //console.log(data);
            if(data != ""){
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

function MostrarBoleta(){

    
    let anio = $('#select_anio_boletas').val();
    let mes = $('#select_mes_boletas').val();
    let sueldo = Number($('#'+mes+'_1').val());
    let rm = Number($('#'+mes+'_2').val());
    let reintegro = Number($('#'+mes+'_3').val());
    let hextras = Number($('#'+mes+'_4').val());
    let bonofi = Number($('#'+mes+'_5').val());
    let otros = Number($('#'+mes+'_6').val());
    let total = Number($('#'+mes+'_total').val());

    if(anio == '1992' || anio == '1991' && mes== 'dic' ) {
        $('#sueldo_boleta').val(sueldo);
        $('#rm_vacacional_boleta').val(rm);
        $('#reintegro_boleta').val(reintegro);
        $('#horaex_boleta').val(hextras);
        $('#boni_boleta').val(bonofi);
        $('#otros_boleta').val(otros);
        $('#total_monto_boleta').val(total);
        SumarMeses();
    }else {
        $('#sueldo_boleta').val("");
        $('#rm_vacacional_boleta').val("");
        $('#reintegro_boleta').val("");
        $('#horaex_boleta').val("");
        $('#boni_boleta').val("");
        $('#otros_boleta').val("");
        $('#total_monto_boleta').val("");
        $('#sueldo_bolet_infoa').val("");
        $('#rm_vacacional_boleta_info').val("");
        $('#reintegro_boleta_info').val("");
        $('#horaex_boleta_info').val("");
        $('#boni_boleta_info').val("");
        $('#otros_boleta_info').val("");
        
    }

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
            $('#at_ss').val(data.at_ss);
            $('#at_fonavi').val(data.at_pro_desocup);
            $('#at_pension').val(data.at_fondo_juvi);
            $('#ap_ss').val(data.ap_ss);
            $('#ap_fonavi').val(data.ap_fonavi);
            $('#ap_pension').val(data.ap_fondo_juvi);
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
    let element = 'contenido_certificado_'+tipoprev;
    
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

function imprimir_certificado(){
    let tipoprev = $('#select_certificado').val();
    var contenido = document.getElementById('contenido_certificado_'+tipoprev);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>Certificado</title>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/css/bracket.css"></link>');
    ventimp1.document.write('<link rel="stylesheet" href="../../public/lib/bootstrap5/bootstrap.min.css">');
    ventimp1.document.write('<style> .certificado_imp{ padding-left: 200px; padding-right: 200px;}</style>');
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

function imprimir_liquidacion(id){

    var contenido = document.getElementById('contenido_liqui_'+id);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>Liquidacion</title>');
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


    let tipoprev = $('#combo_prev_boleta').val();
    var contenido = document.getElementById('contenido_boleta_'+tipoprev);
    var ventimp1 = window.open(' ', 'Imprimir');

    ventimp1.document.write('<html><head><title>Boleta</title>');
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

function calcularTotalBoleta(){
    let sueldo_boleta = $('#sueldo_boleta').val();
    let h_extras_boleta = $('#horaex_boleta').val();
    let boni_boleta = $('#boni_boleta').val();
    let rm_vacacional = $('#rm_vacacional_boleta').val();
    let reintegro_boleta = $('#reintegro_boleta').val();
    let otros_boleta = $('#otros_boleta').val();
    
    let total ;

    total = Number(sueldo_boleta) + Number(h_extras_boleta) + Number(boni_boleta) + Number(rm_vacacional)+ Number(reintegro_boleta) + Number(otros_boleta) ;
    console.log(total);
    $('#total_monto_boleta').val(total);
}

function calcularTotalBoletaInfo(){
    let sueldo_boleta = $('#sueldo_boleta_info').val();
    let h_extras_boleta = $('#horaex_boleta_info').val();
    let boni_boleta = $('#boni_boleta_info').val();
    let rm_vacacional = $('#rm_vacacional_boleta_info').val();
    let reintegro_boleta = $('#reintegro_boleta_info').val();
    let otros_boleta = $('#otros_boleta_info').val();
    let total ;

    total = Number(sueldo_boleta) + Number(h_extras_boleta) + Number(boni_boleta) + Number(rm_vacacional)+ Number(reintegro_boleta) + Number(otros_boleta);
    //console.log(total);
    $('#total_monto_boleta').val(total);
    $('#sueldo_boleta').val(sueldo_boleta);
    $('#horaex_boleta').val(h_extras_boleta);
    $('#boni_boleta').val(boni_boleta);
    $('#rm_vacacional_boleta').val(rm_vacacional);
    $('#reintegro_boleta').val(reintegro_boleta);
    $('#otros_boleta').val(otros_boleta);
}



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
    let fecha_final = $("#fech_final_emp").val();
    let fecha       = new Date(fecha_final);
    let anio        = fecha.getFullYear();

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



   
    if(anio >= 60 && anio <= 1979){
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

        $('.modelo_60_79').show();
        
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

        $('.modelo_80_99').show();
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

    $(".liqui_bonif").each(function() {

        if($(this).val() != 0){
            var nombres = $(this).attr('name');
            var valor = Number($(this).val()).toFixed(2);
            total_neto+= Number(valor);


            divs+='<div class="row">';
            divs+='    <div class="col-4 text-left">';
            divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;">'+nombres+'</h1>';
            divs+='    </div>';
            divs+='    <div class="col-4 text-center">';
            divs+='        <h1 style="color: #000;font-weight: 600;font-size: 12px;">=</h1>';
            divs+='    </div>';
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

});

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
            $('#at_ss').val(data.at_ss);
            $('#at_fonavi').val(data.at_pro_desocup);
            $('#at_pension').val(data.at_fondo_juvi);
            $('#ap_ss').val(data.ap_ss);
            $('#ap_fonavi').val(data.ap_fonavi);
            $('#ap_pension').val(data.ap_fondo_juvi);
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





init();