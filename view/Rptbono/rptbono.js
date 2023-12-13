var anios_reflex = 0;
var meses_reflex = 0;
var dias_reflex = 0;

var anios_host = 0;
var meses_host = 0;
var dias_host = 0;

var anios_orcinea = 0;
var meses_orcinea = 0;
var dias_orcinea = 0;

var suma_anios1 = 0;
var suma_meses1 = 0;
var suma_dias1 = 0;

var fecha_inicial_1;
var fecha_fin_1;
var cbx_tipo_1;
var fecha_inicial_2;
var fecha_fin_2;
var cbx_tipo_2;
var fecha_inicial_3;
var fecha_fin_3;
var cbx_tipo_3;
var fecha_inicial_4;
var fecha_fin_4;
var cbx_tipo_4;
var fecha_inicial_5;
var fecha_fin_5;
var cbx_tipo_5;


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
    $('#txtnombre').attr('disabled', true);
    $('#txtapellido').attr('disabled', true);
    $('#txtdate').attr('disabled', true);
    $("#divresultado").hide();
    $("#divresultado_emp").hide();
    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev4").hide();
    $("#prev5").hide();
    $("#contemp1").hide();
    $("#nav-bono").hide();
    //$("#div_logo_orcinea").hide();
   // $("#div_logo_host").hide();
    $('#btnguardarlistareporte').hide();
    $('#btnzipear').hide();
    $('#tabs-empresas').hide();

    //Select2 a todos los combobox
    $('#tipo_doc').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });
    

    //Cuando se edita la Lista
    var listaId = getParameterByName('lista');

    if(listaId == ""){
        //console.log("VACIO");
    }else {
        //Metodo Mostrar Lista ID
        $.post("../../controller/listareportecontrolador.php?op=mostrar_id",{ lista_id : listaId},function(datos){
            if(datos != ""){
                datos = JSON.parse(datos);
                $("#num_doc").val(datos.num_doc);
                $('#tipo_doc').val(datos.tipo_doc).trigger('change');
                $('#btnbuscar').click();
            }
            
        }); 
       
    }

    /*OBTENER LA CONFG DE EDAD  */
    $.post("../../controller/edadcontrolador.php?op=mostrar",{edad_id: 1},function(data){
        //console.log(data);
        data = JSON.parse(data);
        $('#txtcant_anios').val(data.edad).trigger('change');
    });
});

function init(){
    $("#rpt_pension_form").on("submit",function(e){
        generar(e);	
    });
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function activarcargos(){

    let n = parseInt($('#txtcant_emp').val());
    let a = parseInt($('#txtcant_orcinea').val());
    let h = parseInt($('#txtcant_host').val());
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
    for (b = 1 ; b <= a ; b++){
        $('#logo_orcinea_'+b).select2({
            placeholder: "Seleccione",
            minimumResultsForSearch: Infinity
        });
    
        $('#cargo_orcinea_'+b).select2({
            placeholder: "Seleccione"
        });
        
    }
    for (c = 1 ; c <= h ; c++){
        $('#logo_host_'+c).select2({
            placeholder: "Seleccione",
            minimumResultsForSearch: Infinity
        });
    
        $('#cargo_host_'+c).select2({
            placeholder: "Seleccione"
        });

    }

    $('.cbx_tipos').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity  
    });
    
}

$(document).on("click","#btncargarhost", function(){

    let fech1 = $('#host_inicio').val();
    let fech1f = $('#host_fin').val();
    let fechnc =$('#txtdate').val();
    let mananaf = moment(fechnc).add(16, 'years').format('YYYY-MM-DD');

    if(fech1 != "" || fech1f != ""){
        let fechai = new  Date(fech1);
        let fechafi = new  Date(fech1f);
        let fechanc= new Date(mananaf);

        if(fechai >= fechanc){

            if(fechai < fechafi){
                let host_inicio = moment($("#host_inicio").val());
                let host_fin = moment($("#host_fin").val());
        
                dife1 = host_fin.diff(host_inicio, 'days');
                anios_host = Math.trunc(dife1 / 365);
                dias_host = dife1 % 365;
        
        
                if(dias_host >= 30){ 
                    mes_ht = Math.trunc(dias_host / 30);
                    dias_host = dias_host % 30;
                    meses_host = meses_host + mes_ht;
        
                }
                if(meses_host >= 12){
        
                    anio_ht = Math.trunc(meses_host / 12);
                    meses_host = meses_host % 12;
                    anios_host = anios_host + anio_ht;
                }
        
                mensaje = anios_host+' Años'+' '+meses_host+' meses'+' '+dias_host+' dias'; 
                $("#cant_host").val(mensaje);
                sumartiempo();
            }else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Introduzca una fecha mayor a la fecha de inicio',
                    showConfirmButton: false,
                    timer:1500
                });
            }
            
        }else {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Introduzca una fecha mayor a la fecha de nacimiento',
                showConfirmButton: false,
                timer:1500
            });
        }
    
    }else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca la fecha inicio y fin ',
            showConfirmButton: false,
            timer:1500
        });
    }

    

    

   
    
});

$(document).on("click","#btncargarorcinea", function(){

    let fech1 = $('#orcinea_inicio').val();
    let fech1f = $('#orcinea_fin').val();
    let fechna =$('#txtdate').val();
    let mananaf = moment(fechna).add(16, 'years').format('YYYY-MM-DD');

    if(fech1 != "" || fech1f != ""){
        let fechai = new  Date(fech1);
        let fechafi = new  Date(fech1f);
        let fechan= new Date(mananaf);
        if(fechai >= fechan){
            if(fechai < fechafi){
                var orcinea_inicio = moment($("#orcinea_inicio").val());
                var orcinea_fin = moment($("#orcinea_fin").val());
            
                dife1 = orcinea_fin.diff(orcinea_inicio, 'days');
                //console.log(dife1);
                anios_orcinea = Math.trunc(dife1 / 365);
                dias_orcinea = dife1 % 365;
            
                if(dias_orcinea >= 30){ 
                    mes_orci = Math.trunc(dias_orcinea / 30);
                    dias_orcinea = dias_orcinea % 30;
                    meses_orcinea = meses_orcinea + mes_orci;
        
                }
                if(meses_orcinea >= 12){
        
                    anio_orci = Math.trunc(meses_orcinea / 12);
                    meses_orcinea = meses_orcinea % 12;
                    anios_orcinea = anios_orcinea + anio_orci;
                }
        
        
                mensaje = anios_orcinea+' Años'+' '+meses_orcinea+' meses'+' '+dias_orcinea+' dias'; 
                $("#cant_orcinea").val(mensaje);
                sumartiempo();
                
            }else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Introduzca una fecha mayor a la fecha de inicio',
                    showConfirmButton: false,
                    timer:1500
                });
            }
            
        }else {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Introduzca una fecha mayor a la fecha de nacimiento',
                showConfirmButton: false,
                timer:1500
            });
        }
    }else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca la fecha inicio y fin ',
            showConfirmButton: false,
            timer:1500
        });
    }

   

    

   
});

function SumarAniosEmpresas(valor) {
	var mensaje = "";
	var anios_final=0;
	var meses_final=0;
	var dias_final=0;
			
    anios_final = parseInt($('#anios_emp_'+valor).val(), '10');
    meses_final = parseInt($('#meses_emp_'+valor).val(), '10');
    dias_final = parseInt($('#dias_emp_'+valor).val(), '10');

    if(dias_final >= 30){

        let mes = Math.trunc(dias_final / 30);
        dias_final = dias_final % 30;
        meses_final = meses_final + mes;
    }

    if(meses_final >=12){

        let anio = Math.trunc(meses_final / 12);
        meses_final = meses_final % 12;
        anios_final = anios_final + anio;
    }

	mensaje = anios_final+' Años'+' '+meses_final+' meses'+' '+dias_final+' dias'; 

	
	$('#tiempo_Empresa_'+valor).val(mensaje);
	sumartiempo();
}

function sumarbono(a){

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
    //$("#tiempo_bono").html(mensaje); 
}

function sumartiempo(){

    var total_anios = anios_reflex ;
    var total_meses = meses_reflex;
    var total_dias = 0 ;

	var anios_final=0;
	var meses_final=0;
	var dias_final=0;
			
	var anios_orc_final=0;
	var meses_orc_final=0;
	var dias_orc_final=0;

    var anios_host_final=0;
	var meses_host_final=0;
	var dias_host_final=0;

    $(".fecha_inicio").each(function() {
		if ($(this).val() !== ""){
			var fec_inicio = moment($(this).val());
			var fec_inicio_id = $(this).attr('id');

			var fec_fin = moment($("#f_final_" + fec_inicio_id.slice(9)).val());

            anios = parseInt($('#anios_emp_'+fec_inicio_id.slice(9)).val(), '10');
            meses = parseInt($('#meses_emp_'+fec_inicio_id.slice(9)).val(), '10');
            dias = parseInt($('#dias_emp_'+fec_inicio_id.slice(9)).val(), '10');

            if(dias >= 30){

                let mes = Math.trunc(dias / 30);
                dias = dias % 30;
                meses = meses + mes;
            }
        
            if(meses >=12){
        
                let anio = Math.trunc(meses / 12);
                meses = meses % 12;
                anios = anios + anio;
            }
			

			anios_final+=anios;
			meses_final+=meses;
			dias_final+=dias;
		}
	});

    $(".fecha_inicio_orcinea").each(function(){
        if($(this).val() !== ""){
            let meses_orc = 0;
            let anios_orc = 0;
            let dias_orc = 0;
            var f_inicio_orc = moment($(this).val());
            var f_inicio_orc_id = $(this).attr('id');
            var f_final_orc = $("#orcinea_fin_"+f_inicio_orc_id.slice(15)).val();
            if(f_final_orc != ""){
                var f_fin_orc = moment($("#orcinea_fin_"+f_inicio_orc_id.slice(15)).val());
                dife1 = f_fin_orc.diff(f_inicio_orc, 'days');
                anios_orc = Math.trunc(dife1 / 365);
                dias_orc = dife1 % 365;
                
                if(dias_orc >= 30){ 
                    let mes_orci = Math.trunc(dias_orc / 30);
                    dias_orc = dias_orc % 30;
                    meses_orc = meses_orc + mes_orci;
        
                }
                if(meses_orc >= 12){
        
                    let anio_orci = Math.trunc(meses_orc / 12);
                    meses_orc = meses_orc % 12;
                    anios_orc = anios_orc + anio_orci;
                }
    
                dias_orc_final+= dias_orc;
                meses_orc_final+= meses_orc;
                anios_orc_final+= anios_orc;
            }
            
        }
    });

    $(".fecha_inicio_host").each(function(){
        if($(this).val() !== ""){
            let meses_ht = 0;
            let anios_ht = 0;
            let dias_ht = 0;
            var f_inicio_ht = moment($(this).val());
            var f_inicio_ht_id = $(this).attr('id');
            var f_final_ht =$("#host_fin_"+f_inicio_ht_id.slice(12)).val();
            if(f_final_ht != ""){
                var f_fin_ht = moment($("#host_fin_"+f_inicio_ht_id.slice(12)).val());
                dife1 = f_fin_ht.diff(f_inicio_ht, 'days');
                //console.log(dife1);
                //console.log(f_fin_ht);
                anios_ht = Math.trunc(dife1 / 365);
                dias_ht = dife1 % 365;
                
                if(dias_ht >= 30){ 
                    let mes_ht = Math.trunc(dias_ht / 30);
                    dias_ht = dias_ht % 30;
                    meses_ht = meses_ht + mes_ht;
        
                }
                if(meses_ht >= 12){
        
                    let anio_ht = Math.trunc(meses_ht / 12);
                    meses_ht = meses_ht % 12;
                    anios_ht = anios_ht + anio_ht;
                }
    
                
                dias_host_final+= dias_ht;
                meses_host_final+= meses_ht;
                anios_host_final+= anios_ht;
            }
            //console.log(dias_host_final+' ' + meses_host_final + ' '+ anios_host_final);
        }
    });

	total_dias+= Number(dias_host_final);
	total_meses+= Number(meses_host_final);
	total_anios+= Number(anios_host_final);

    total_dias+= Number(dias_orc_final);
	total_meses+= Number(meses_orc_final);
	total_anios+= Number(anios_orc_final);

	total_dias+= Number(dias_final);
	total_meses+= Number(meses_final);
	total_anios+= Number(anios_final);

    if(total_dias >= 30){


        let mes_emp = Math.trunc(total_dias / 30);
        total_dias = total_dias % 30;
        total_meses = total_meses + mes_emp;
        
    }
    if(total_meses >= 12){

        let anio_emp = Math.trunc(total_meses / 12);
        total_meses = total_meses % 12;
        total_anios = total_anios +  anio_emp;
    }

    mensaje = total_anios+ ' Años '+total_meses+' Meses '+ total_dias+' Dias';
	if ( total_dias == 0 && total_meses == 0 && total_anios == 0){
		$("#total_tiempo").val("");
	}else{
		$("#total_tiempo").val(mensaje);
	}

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

    let tipo = $("#tipo_doc").val();
    let doc = $("#num_doc").val();
    let docnum = $("#num_doc").val().length;
    let t_lista  = $("#tipo_lista").val();
    
    

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
                        $('#txtnombre').attr('disabled', false);
                        $('#txtapellido').attr('disabled', false);
                        $('#txtdate').attr('disabled', false);
                        //$("#divresultado").show();
                        //$('#divresultado').removeClass().addClass('form-layout form-layout-4');

                        $.post("../../controller/pensioncontrolador.php?op=consulta_dni_nac",{dni: doc},function(data){
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

                //$("#divresultado").show();
                //$('#divresultado').removeClass().addClass('form-layout form-layout-4');  

                $.post("../../controller/listareportecontrolador.php?op=mostrar",{num_doc: doc,  lista : t_lista },function(datos){
                    if(datos != ""){
                        //console.log(datos);
                        datos = JSON.parse(datos);
                        $("#lista_id").val(datos.id);
                        $("#txtcant_emp").val(datos.cantidad);
                        $("#txtcant_orcinea").val(datos.cantidad_orcinea);
                        $("#txtcant_host").val(datos.cantidad_host);
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
    var info = string.split('-').reverse().join('.');
    return info;
}

function convertDateFormatSimple(string) {
    var info = string.split('-').reverse().join('-');
    return info;
}

function generar(e){
    e.preventDefault();
   
    var formData = new FormData($("#rpt_pension_form")[0]);
    let cant_anios = $('#txtcant_anios').val();
    afid = $("#af_id").val();
    let cnt = $('#txtcant_emp').val();
    let cnt_orci = $('#txtcant_orcinea').val();
    let cnt_host = $('#txtcant_host').val();
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
            if(cnt == ""){
                $("#divresultado_emp").hide();
            }else {
                $("#divresultado_emp").show();
            }

            creardivsempresa();
            creardivsorcinea();
            creardivshost();
            activarcargos();
            mostrarDatosEmpresasDerecha();
            crearTabs(cnt, cnt_orci, cnt_host);
            
            $('#tabs-empresas').show();
            $('#btnguardarlistareporte').show();
            $('#btnzipear').show();
            $("#divresultado").show();
            $('#divresultado').removeClass().addClass('form-layout form-layout-4');  

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
            
        
            $('#combo_prev_bono').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });
        
            $('.combo_prev_boleta').select2({
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

            $('.select_anio_boletas').select2({
                placeholder: "Seleccione",
                minimumResultsForSearch: Infinity
            });
        
            //Ocultar contenedores
            $('.contenedores_emp').hide();

            //Recuperar datos del combo MOTIVO CESE
            $.post("../../controller/motivocontrolador.php?op=combo",{},function(data){
                $('.combo_prev_liqui').html(data);
            }); 
            
            let fnac = $('#txtdate').val();
            let manana = moment(fnac).add(cant_anios, 'years').format('YYYY-MM-DD');
            $('#orcinea_inicio_1').val(manana);
            $('#orcinea_inicio_1').attr("min" ,manana); 
            $('#host_inicio_1').val(manana);
            $('#host_incio_1').attr("min" ,manana); 

            $('#f_inicio_1').val(manana);
            $('#f_inicio_1').attr("min" ,manana); 

            
            $.post("../../controller/cargocontrolador.php?op=comborpt",{}, function(data){
        
                for(i = 1 ; i<= cnt ; i++){
                    $("#cargoc"+i).html(data);
                }
                for(i = 1 ; i<= cnt_orci ; i++){
                    $("#cargo_orcinea_"+i).html(data);
                    $("#div_logo_orcinea_"+i).hide();
                }

                for(i = 1 ; i<= cnt_host ; i++){
                    $("#cargo_host_"+i).html(data);
                    $("#div_logo_host_"+i).hide();
                }
            });
        
            $.post("../../controller/logocontrolador.php?op=combo",{}, function(data){
        
                for(i = 1 ; i<= cnt ; i++){
                   $("#logo"+i).html(data);
                }
               for(i = 1 ; i<= cnt_orci ; i++){
                    $("#logo_orcinea_"+i).html(data);
                }
                for(i = 1 ; i<= cnt_host ; i++){
                    $("#logo_host_"+i).html(data);
                }
            });
        
            $.post("../../controller/firmacontrolador.php?op=combo",{}, function(data){
        
                for(i = 1 ; i<= cnt ; i++){
                   $("#firmante"+i).html(data);
                   $("#div_logo_"+i).hide();
                }
            });
        
            

            //RECUPERAR LA CONFIGURACION DEL USUARIO
            $.post("../../controller/listareportecontrolador.php?op=mostrar",{num_doc: doc, lista : t_lista},function(datos){
                if(datos != ""){
                    //console.log(datos);
                    datos = JSON.parse(datos);
                    let cant = datos.cantidad;
                    let cant_orc = datos.cantidad_orcinea;
                    let cant_ht = datos.cantidad_host;
                    //DATOS DE ORCINEA
                    for (let i = 1 ; i <= cant_orc ; i++){
                        $('#empresa_orcinea_'+i).val(datos["ruc_orcinea_"+i]);
                        $('#orcinea_inicio_'+i).val(datos["fech_orcinea_"+i]);
                        $('#orcinea_fin_'+i).val(datos["fech_final_orcinea_"+i]);
                        $('#cargo_orcinea_'+i).val(datos["cargo_orcinea_"+i]).trigger('change');
                        $('#firmante_orcinea_'+i).val(datos["firmante_orcinea_"+i]);
                        $('#logo_orcinea_'+i).val(datos["logo_orcinea_"+i]).trigger('change');
                        CargarOrcinea(i);
                    }

                    //DATOS HOST
                    for(let i = 1; i<= cant_ht ; i++){
                        $('#empresa_host_'+i).val(datos["ruc_host_"+i]);
                        $('#host_inicio_'+i).val(datos["fech_host_"+i]);
                        $('#host_fin_'+i).val(datos["fech_final_host_"+i]);
                        $('#cargo_host_'+i).val(datos["cargo_host_"+i]).trigger('change');
                        $('#firmante_host_'+i).val(datos["firmante_host_"+i]);
                        $('#logo_host_'+i).val(datos["logo_host_"+i]).trigger('change');
                        CargarHost(i);
                    }
                    

                    // FOR PARA DATOS DE LAS 5 EMPRESAS
                    for( let i = 1 ; i <= cant ; i++){
                        $("#f_inicio_"+i).val(datos["fech"+i]);
                        $("#f_final_"+i).val(datos["fech_final_"+i]);
                        $("#cbx_tipo_"+i).val(datos["tipo_"+i]).trigger('change');
                        //mostrardetalle(i, 0, 0);
                        //BuscarEmp(i);
                        mostrardetalle(i, 0, 0);
                        setTimeout(function() {
                            //console.log("Despues de 1 segundo");
                            mostrardetalle(i, datos["ruc"+i], 1);
                            $("#cargoc"+i).val(datos["cargo"+i]).trigger('change');
                            $("#logo"+i).val(datos["logo"+i]).trigger('change');
                            $("#firmante"+i).val(datos["firmante"+i]).trigger('change');

                            $("#lst_emp_"+i).val(datos["ruc"+i]).trigger('change');
                            //console.log(datos["ruc"+i]);
                        }, 500);
                    }
                    
                    
                    $('#prev1').hide();
                    
                }else {

                }    
            });
        }
    });  
}

function crearTabs(valor, orc, host) {
    //Activar el div para mostrar el tab
    $('#tabs-empresas').show();
    // Limpiar el contenedor de tabs y el nav
    $("#tabsContainer").empty();
    $("#tabsNav").empty();

    let ht = Number(host) + 4;
    let emp = Number(valor) + 8;
    // Crear tabs dinámicamente
    for (var i = 1; i <= orc; i++) {
        var tabContent = '<div class="tab-pane fade" id="content' + i + '"><input type="hidden" id="tiempo_imp'+i+'">';
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
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="boleta-tab'+ i +'"  onclick="boleta_tab('+ i +')"  data-bs-toggle="pill" data-bs-target="#boleta'+ i +'"  type="button" role="tab" aria-controls="boleta"   aria-selected="false">Boleta</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="renuncia-tab'+ i +'"   data-bs-toggle="pill" data-bs-target="#renuncia'+ i +'"  type="button" role="tab" aria-controls="renuncia"   aria-selected="false" >Renuncia</button>';
        tabContent += '         </li>';
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
        tabContent += '                                 <input type="date" class="form-control col-lg-6"  id="fecha_certificado'+ i +'"  style="width: 100%"/>';        
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
        tabContent += '                                 <input type="date" class="form-control"  id="fecha_liquidacion'+ i +'"  style="width: 100%"/>';
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
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="otros_boleta" id="otros_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-12 col-sm-8">';
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
        tabContent += '                             <button type="button" id="btnprevbol'+ i +'" onclick="PrevBoleta('+ i +')"  name="btnprevbol"  class="btn btn-secondary mg-l-10">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                     <!--<button type="button" id="btnimprimirbol'+ i +'" name="btnimprimirbol" onclick="imprimir_liquidacion_boleta('+ i +')"   class="btn btn-info">Imprimir Boleta</button>-->';
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
        tabContent += '                                 <input type="date" class="form-control col-lg-6"  id="fecha_renuncia'+ i +'"  style="width: 100%"/>';        
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
        tabContent += '     </div> '; 
        tabContent += '     </div>';
        tabContent += '</div>';

        $("#tabsContainer").append(tabContent);

        var tabButton = '<li class="nav-item">';
        tabButton += '<a class="nav-link" id="tab' + i + '" data-bs-toggle="tab" href="#content' + i + '" onclick="SeleccionarEmp('+ i +')">Orcinea '+ i +'</a>';
        tabButton += '</li>';

        $("#tabsNav").append(tabButton);
    }
    // Crear tabs dinámicamente
    for (var i = 5; i <= ht; i++) {
        var tabContent = '<div class="tab-pane fade" id="content' + i + '"><input type="hidden" id="tiempo_imp'+i+'">';
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
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="boleta-tab'+ i +'"  onclick="boleta_tab('+ i +')"  data-bs-toggle="pill" data-bs-target="#boleta'+ i +'"  type="button" role="tab" aria-controls="boleta"   aria-selected="false">Boleta</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="renuncia-tab'+ i +'"   data-bs-toggle="pill" data-bs-target="#renuncia'+ i +'"  type="button" role="tab" aria-controls="renuncia"   aria-selected="false" >Renuncia</button>';
        tabContent += '         </li>';
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
        tabContent += '                                 <input type="date" class="form-control col-lg-6"  id="fecha_certificado'+ i +'"  style="width: 100%"/>';        
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
        tabContent += '                                 <input type="date" class="form-control"  id="fecha_liquidacion'+ i +'"  style="width: 100%"/>';
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
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="otros_boleta" id="otros_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-12 col-sm-8">';
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
        tabContent += '                             <button type="button" id="btnprevbol'+ i +'" onclick="PrevBoleta('+ i +')"  name="btnprevbol"  class="btn btn-secondary mg-l-10">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                     <!--<button type="button" id="btnimprimirbol'+ i +'" name="btnimprimirbol" onclick="imprimir_liquidacion_boleta('+ i +')"   class="btn btn-info">Imprimir Boleta</button>-->';
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
        tabContent += '                                 <input type="date" class="form-control col-lg-6"  id="fecha_renuncia'+ i +'"  style="width: 100%"/>';        
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
        tabContent += '     </div> '; 
        tabContent += '     </div>';
        tabContent += '</div>';
        $("#tabsContainer").append(tabContent);

        var tabButton = '<li class="nav-item">';
        tabButton += '<a class="nav-link" id="tab' + i + '" data-bs-toggle="tab" href="#content' + i + '" onclick="SeleccionarEmp('+ i +')">Host '+Number(i-4)+'</a>';
        tabButton += '</li>';

        $("#tabsNav").append(tabButton);
    }
    // Crear tabs dinámicamente
    for (var i = 9; i <= emp; i++) {
        var tabContent = '<div class="tab-pane fade" id="content' + i + '"><input type="hidden" id="tiempo_imp'+i+'">';
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
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="boleta-tab'+ i +'"  onclick="boleta_tab('+ i +')"  data-bs-toggle="pill" data-bs-target="#boleta'+ i +'"  type="button" role="tab" aria-controls="boleta"   aria-selected="false">Boleta</button>';
        tabContent += '         </li>';
        tabContent += '         <li class="nav-item" role="presentation">';
        tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="renuncia-tab'+ i +'"   data-bs-toggle="pill" data-bs-target="#renuncia'+ i +'"  type="button" role="tab" aria-controls="renuncia"   aria-selected="false" >Renuncia</button>';
        tabContent += '         </li>';
        if(i == emp){
            tabContent += '         <li class="nav-item" role="presentation" id="nav-bono">';
            tabContent += '             <button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="bono-tab"   data-bs-toggle="pill" data-bs-target="#bono"  type="button" role="tab" aria-controls="bono"   aria-selected="false">DJ</button>';
            tabContent += '         </li>';
        }
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
        tabContent += '                                 <input type="date" class="form-control col-lg-6"  id="fecha_certificado'+ i +'"  style="width: 100%"/>';        
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
        tabContent += '                                 <input type="date" class="form-control"  id="fecha_liquidacion'+ i +'"  style="width: 100%"/>';
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
        tabContent += '                                 <input class="form-control col-lg-6 bonif" type="number" name="reintegro_boleta" id="reintegro_boleta'+ i +'" oninput="calcularTotalBoleta('+ i +')"  placeholder="" >';
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
        tabContent += '                                 <input class="form-control col-lg-6" type="number" name="otros_boleta" id="otros_boleta'+ i +'"  oninput="calcularTotalBoleta('+ i +')" placeholder="" >';
        tabContent += '                             </div>';
        tabContent += '                         </div><!-- col-4 -->';
        tabContent += '                     </div><!-- row -->';
        tabContent += '                 </div>';
        tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
        tabContent += '                     <div class="row">';
        tabContent += '                         <div class="col-12 col-sm-8">';
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
        tabContent += '                             <button type="button" id="btnprevbol'+ i +'" onclick="PrevBoleta('+ i +')"  name="btnprevbol"  class="btn btn-secondary mg-l-10">Previsualizar</button>';
        tabContent += '                         </div>';
        tabContent += '                     </div>';
        tabContent += '                     <!--<button type="button" id="btnimprimirbol'+ i +'" name="btnimprimirbol" onclick="imprimir_liquidacion_boleta('+ i +')"   class="btn btn-info">Imprimir Boleta</button>-->';
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
        tabContent += '                                 <input type="date" class="form-control col-lg-6"  id="fecha_renuncia'+ i +'"  style="width: 100%"/>';        
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

        if( i == emp){
            tabContent += '         <div id="bono" class="tab-pane fade">';
            tabContent += '             <form id="form_bono" action="" method="post" autocomplete="off">';
            tabContent += '                 <div class="form-layout form-layout-4">';
            tabContent += '                     <div class="row">';
            tabContent += '                         <div class="col-lg-12">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-sm-6 ">Numero Autogenerado: <span class="tx-danger">*</span></label>';
            tabContent += '                                 <input class="form-control col-sm-6" type="text" id="num_auto" name="num_auto"  placeholder="Numero Aleatorio" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                     </div>';
            tabContent += '                     <div class="row pd-t-5">';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-sm-6">Diciembre 91:</label>';
            tabContent += '                                 <input class="form-control col-sm-6" type="number" id="dic_91" name="dic_91" oninput="calcularBono()" placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Junio 92: </label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="jun_92" name="jun_92" oninput="calcularBono()"  placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Enero 92: </label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="ene_92" name="ene_92" oninput="calcularBono()" placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Julio 92:</label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="jul_92" name="jul_92" oninput="calcularBono()"   placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Febrero 92: </label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="feb_92" name="feb_92" oninput="calcularBono()" placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Agosto 92:</label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="ago_92" name="ago_92"  oninput="calcularBono()"  placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Marzo 92: </label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="mar_92" name="mar_92" oninput="calcularBono()" placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Septiembre 92:</label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="sep_92" name="sep_92" oninput="calcularBono()"   placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Abril 92:</label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="abr_92" name="abr_92" oninput="calcularBono()" placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Octubre 92:</label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="oct_92" name="oct_92"  oninput="calcularBono()"  placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Mayo 92: </label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="may_92" name="may_92" oninput="calcularBono()"  placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-lg-6">';
            tabContent += '                             <div class="row mg-b-5">';
            tabContent += '                                 <label class="form-control-label col-lg-6">Noviembre 92:</label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="nov_92" name="nov_92"  oninput="calcularBono()"  placeholder="" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                     </div><!-- row -->';
            tabContent += '                     <div class="d-none">';
            tabContent += '                         <div class="col-12 col-sm-8">';
            tabContent += '                             <div class="row mg-b-15">';
            tabContent += '                                 <label class="form-control-label col-lg-6 text-center">Calculo Bono:</label>';
            tabContent += '                                 <input class="form-control col-lg-6" type="number" id="cal_bono" name="cal_bono"    placeholder="Calculo Bono" >';
            tabContent += '                             </div>';
            tabContent += '                         </div><!-- col-4 -->';
            tabContent += '                         <div class="col-4 col-sm-4">';
            tabContent += '                             <div class="row justify-content-center mg-l-10">';
            tabContent += '                                 <button type="button" id="btncalculobono" name="btncalculobono"  class="btn btn-info">Ver Calculo</button>';
            tabContent += '                             </div>';
            tabContent += '                         </div>';
            tabContent += '                     </div>';
            tabContent += '                 </div>';
            tabContent += '                 <div class="form-layout-footer text-right mg-t-20">';
            tabContent += '                     <div class="row">';
            tabContent += '                         <div class="col-12 col-sm-8">';
            tabContent += '                             <select class="form-control select2" name="combo_prev_bono" id="combo_prev_bono" style="width: 100%;">';
            tabContent += '                                 <option value="1">Fecha de 1992</option>';
            tabContent += '                                 <option value="2">Fecha de 1992 - 1996</option>';
            tabContent += '                                 <option value="4">Fecha de 1992 - 1996</option>';
            tabContent += '                                 <option value="3">Fecha de 1992 - 1996 - 2001</option>';
            tabContent += '                             </select>';
            tabContent += '                         </div>';
            tabContent += '                         <div class="col-12 col-sm-4">';
            tabContent += '                             <button type="button" id="btnprevbono" name="btnprevbono"  class="btn btn-secondary">Previsualizar</button>';
            tabContent += '                         </div>';
            tabContent += '                     </div>';
            tabContent += '                     <!--<button type="button" id="btnimprimirbono" name="btnimprimirbono"  class="btn btn-info">Imprimir Bono</button>-->';
            tabContent += '                 </div>';
            tabContent += '             </form> ';
            tabContent += '         </div>';
        }
       
        tabContent += '     </div> '; 
        tabContent += '     </div>';
        tabContent += '</div>';

        $("#tabsContainer").append(tabContent);

        var tabButton = '<li class="nav-item">';
        tabButton += '<a class="nav-link" id="tab' + i + '" data-bs-toggle="tab" href="#content' + i + '" onclick="SeleccionarEmp('+ i +')">Empresa '+Number(i - 8)+'</a>';
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


function creardivsorcinea(){
    let numero = $("#txtcant_orcinea").val();
    let divs = "";
    for( var i = 1 ; i <= numero; i++){
        divs+=  '<div class="accordion-item" id="acc_aorcinea_'+i+'">'+
                    '<h2 class="accordion-header" id="headingOne_'+i+'">'+
                        '<button class="accordion-button collapsed" style="padding: 0.65rem 1rem" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_'+i+'" aria-expanded="false" aria-controls="collapseOne_'+i+'">ORCINEA '+i+'</button>'+
                    '</h2>'+
                    '<div id="collapseOne_'+i+'" class="accordion-collapse collapse " aria-labelledby="headingOne_'+i+'" data-bs-parent="#accordionExample">'+
                        '<div class="accordion-body">'+
                            '<div id="orcinea" class="">'+
                                '<form id="form_orci_'+i+'" action="" method="post" autocomplete="off">'+
                                    '<div class="pd-15">'+
                                        '<div class="row mg-b-25">'+
                                            '<div class="col-lg-8">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Empresa: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control" type="text" name="empresa_orcinea_'+i+'" id="empresa_orcinea_'+i+'" placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
                                            "<div class ='col-12 col-sm-4'>"+
                                                "<div class='form-group'  >"+
                                                    "<label class='form-control-label'>Tamaño de Empresa</label>"+
                                                    "<select class='form-control select2 cbx_tipos' id='cbx_tipo_orc_"+i+"' style='width: 100%'>"+
                                                        "<option value='P'>P</option>"+
                                                        "<option value='M'>M</option>"+
                                                        "<option value='G'>G</option>"+
                                                    "</select>"+
                                                "</div>"+
                                            "</div>"+
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Inicio: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control fecha_inicio_orcinea" type="date" max="2999-12-31" name="orcinea_inicio_'+i+'" id="orcinea_inicio_'+i+'"  placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Fin: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control" type="date" max="2999-12-31" name="orcinea_fin_'+i+'" id="orcinea_fin_'+i+'"  placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row mb-3 mt-2">'+
                                            '<label for="cargo_orcinea" class="col-lg-3 col-form-label">Cargo:</label>'+
                                            '<div class="col-lg-9">'+
                                                '<select required  id="cargo_orcinea_'+i+'" class="form-control select2" data-placeholder="Seleccione" style="width: 100%" >'+
                                                '</select>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row mb-3 mt-2">'+
                                            '<label for="firmante_orcinea" class="col-lg-3 col-form-label">Firmante :</label>'+
                                            '<div class="col-lg-9">'+
                                                '<input  type="text" id="firmante_orcinea_'+i+'" class="form-control firmante_orcinea"  required>'+
                                                '</input>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row mb-3 mt-2">'+
                                            '<label for="logo_orcinea" class="col-lg-3 col-form-label">Logo:</label>'+
                                            '<div class="col-lg-9">'+
                                                '<select required id="logo_orcinea_'+i+'"  class="form-control select2 logo_orcinea" data-placeholder="Seleccione" style="width: 100% , height : 50px" onchange="LogoOrcinea('+i+')">'+
                                                '</select>'+                        
                                            '</div>'+
                                            '<div class="d-none" id="div_logo_orcinea_'+i+'">'+
                                                '<img id="logo_img_orcinea_'+i+'" src="../../assets/img/no-fotos.png" alt="" width="100px" height="60px">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row d-flex justify-content-center">'+
                                            '<div class="col-lg-4 text-center">'+
                                                '<br>'+
                                                '<button class="btn btn-secondary btn-block mg-b-10" type="button"  onclick="LimpiarCamposOrcinea('+i+')">Limpiar</button>'+
                                            '</div>'+

                                            '<div class="col-lg-4 text-center">'+
                                                '<br>'+
                                                '<button class="btn btn-info btn-block mg-b-10" type="button" id="btncargarorcinea_'+i+'" onclick="CargarOrcinea('+i+')" >Registrar</button>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</form>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
    }
    $("#acc_orcinea").html(divs);
    
}

function creardivshost(){
    let numero = $("#txtcant_host").val();
    let divs = "";
    for( var i = 1 ; i <= numero; i++){
        divs+=  '<div class="accordion-item" id="acc_host_'+i+'">'+
                    '<h2 class="accordion-header" id="headingTwo_'+i+'">'+
                        '<button class="accordion-button collapsed" style="padding: 0.65rem 1rem" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo_'+i+'" aria-expanded="false" aria-controls="collapseTwo_'+i+'">HOST '+i+'</button>'+
                    '</h2>'+
                    '<div id="collapseTwo_'+i+'" class="accordion-collapse collapse" aria-labelledby="headingTwo_'+i+'" data-bs-parent="#accordionExample">'+
                        '<div class="accordion-body">'+
                            '<div id="host_'+i+'" class="">'+
                                '<form id="form_host_'+i+'" action="" method="post" autocomplete="off">'+
                                    '<div class="pd-15">'+
                                        '<div class="row mg-b-25">'+
                                            '<div class="col-lg-8">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Empresa: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control" type="text"  id="empresa_host_'+i+'" placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
                                            "<div class ='col-12 col-sm-4'>"+
                                                "<div class='form-group'  >"+
                                                    "<label class='form-control-label'>Tamaño de Empresa</label>"+
                                                    "<select class='form-control select2 cbx_tipos' id='cbx_tipo_host_"+i+"' style='width: 100%'>"+
                                                        "<option value='P'>P</option>"+
                                                        "<option value='M'>M</option>"+
                                                        "<option value='G'>G</option>"+
                                                    "</select>"+
                                                "</div>"+
                                            "</div>"+
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Inicio: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control fecha_inicio_host" type="date" max="2999-12-31" id="host_inicio_'+i+'" placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-lg-6">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Fin: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control" type="date" max="2999-12-31"  id="host_fin_'+i+'" placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row mb-3 mt-2">'+
                                            '<label for="cargo_host" class="col-lg-3 col-form-label">Cargo:</label>'+
                                            '<div class="col-lg-9">'+
                                                '<select required id="cargo_host_'+i+'"  class="form-control select2" data-placeholder="Seleccione" style="width: 100%" >'+
                                                '</select>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row mb-3 mt-2">'+
                                            '<label for="firmante_host" class="col-lg-3 col-form-label">Firmante :</label>'+
                                            '<div class="col-lg-9">'+
                                                '<input type="text" id="firmante_host_'+i+'"  class="form-control"  >'+
                                                '</input>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row mb-3 mt-2">'+
                                            '<label for="logo_host" class="col-lg-3 col-form-label">Logo:</label>'+
                                            '<div class="col-lg-9">'+
                                                '<select required id="logo_host_'+i+'"  class="form-control select2" data-placeholder="Seleccione" style="width: 100% , height : 50px"  onchange="LogoHost('+i+')">'+
                                                '</select>'+                        
                                            '</div>'+
                                            '<div class="d-none" id="div_logo_host_'+i+'">'+
                                                '<img id="logo_img_host_'+i+'" src="../../assets/img/no-fotos.png" alt="" width="100px" height="60px">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row d-flex justify-content-center">'+
                                            '<div class="col-lg-4 text-center">'+
                                                '<br>'+
                                                '<button class="btn btn-secondary btn-block mg-b-10" type="button" id="btnLimpiarhost_'+i+'" name="btnLimpiarhost" onclick="LimpiarCamposHost('+i+')">Limpiar</button>'+
                                            '</div>'+
                                            '<div class="col-lg-4 text-center">'+
                                                '<br>'+
                                                '<button class="btn btn-info btn-block mg-b-10" type="button" id="btncargarhost_'+i+'" name="btncargarhost" onclick="CargarHost('+i+')">Registrar</button>'+
                                            '</div>'+
                                        '</div>'+  
                                    '</div>'+
                                '</form>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
    } 
    //$("#acc_host").html(divs);
    $("#acc_orcinea").append(divs);
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
                                "<div class='row mb-1' >"+
                                    "<div class='col-3'>"+
                                        "<button class='btn btn-outline-info btn-icon' onclick='CopiarEmp("+i+")'><div><i class='fa fa-copy'></i></div></button>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row' id='fechas' >"+
                                    "<div class='col-12 col-sm-4'>"+
                                        "<div class='form-group' >"+
                                            "<label class='form-control-label'>Desde</label>"+
                                            "<input class='form-control fecha_inicio' type='date' max='2999-12-31' id='f_inicio_"+i+"'>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-4'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Hasta</label>"+
                                            "<input class='form-control'  type='date' max='2999-12-31' id='f_final_"+i+"' >"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-4'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Tamaño de Empresa</label>"+
                                            "<select class='form-control select2 cbx_tipos' id='cbx_tipo_"+i+"' style='width: 100%'>"+
                                                "<option value='P'>P</option>"+
                                                "<option value='M'>M</option>"+
                                                "<option value='G'>G</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-12'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label' for='lst_emp_"+i+"'>Empresa</label>"+
                                            "<select class='form-control select2' name='lst_emp_"+i+"' id='lst_emp_"+i+"' data-placeholder='Seleccione' style='width: 100%' required onchange='ListarFirmante("+i+")'></select>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-6'>"+
                                        "<div class='form-group'>"+
                                            "<label class='form-control-label'>Estado</label>"+
                                            "<input type='text' class='form-control' id='estado_emp_"+i+"' disabled>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class='col-12 col-sm-6 '>"+
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
                                    "<div class='col-12 col-sm-6'>"+
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
                                "<input type='hidden'  id='rep_legal_"+i+"'>"+
                                "<input type='hidden'  id='dni_a_"+i+"'>"+
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
                               "<div class='row d-flex justify-content-center'>"+
                                    "<div class='col-lg-4 text-center'>"+
                                        "<button  type='button' id='' name='' class='btn btn-secondary btn-block mg-b-10' onclick='LimpiarCamposEmpresas("+i+")' >Limpiar</button>"+
                                    "</div>"+
                                    "<div class='col-lg-4 text-center'>"+
                                        "<button  type='button' name='btnmostrarempr_"+i+"' name='btnmostrarempr_"+i+"' onclick='mostrardetalle("+i+", 0, 0)' class='btn btn-info btn-block mg-b-10' >Registrar</button>"+
                                    "</div>"+
                               "</div>"+
                            "</div><!-- form-layout -->"+
                        "</div>"+
                    "</div>"+
                "</div>" ;
                
    }
    //console.log(div);
    $("#acc_resultado").html(div);
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
    let num = Number(a + 8);
    $('#contenedor_emp'+ num).show();
    $('#num_emp').val(num);

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
    var fnac = $('#txtdate').val();
    var fech1 = $('#f_inicio_'+a).val();
    var fech_final_1 =$('#f_final_'+a).val();
    var cargo = $('#cargoc'+a).val();
    let logos = $('#logo'+a).val();
    let cbx_tipo = $('#cbx_tipo_'+a).val();
    var nom;
    var razsocialruc;
    var depas;
    let valor_busqueda;
    var cantidad = $('#txtcant_emp').val();
    let manana = moment(fnac).add(16, 'years').format('YYYY-MM-DD');

    //Agregar un dia a la siguiente empresa
    if(cantidad > a){
        var n_emp = a + 1 ;
        var fecha_i_nueva = moment(fech_final_1).add(1, 'days').format('YYYY-MM-DD');
        $('#f_inicio_'+n_emp).val(fecha_i_nueva);
    }

    //setear en hidden el logo
    $('#logo_nombre'+ num).val(logos);

    switch (a) {
        case 1:
            if(fecha_inicial_1 == fech1 && fecha_fin_1 == fech_final_1 && cbx_tipo_1 == cbx_tipo) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_1 = fech1;
                fecha_fin_1 = fech_final_1;
                cbx_tipo_1 = cbx_tipo;
                valor_busqueda = 0;
            }
            break;
        case 2:
            if(fecha_inicial_2 == fech1 && fecha_fin_2 == fech_final_1 && cbx_tipo_2 == cbx_tipo) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_2 = fech1;
                fecha_fin_2 = fech_final_1;
                cbx_tipo_2 = cbx_tipo;
                valor_busqueda = 0;
            }
            break;
        case 3:
            if(fecha_inicial_3 == fech1 && fecha_fin_3 == fech_final_1 && cbx_tipo_3 == cbx_tipo) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_3 = fech1;
                fecha_fin_3 = fech_final_1;
                cbx_tipo_3 = cbx_tipo;
                valor_busqueda = 0;
            }
            break;
        case 4:
            if(fecha_inicial_4 == fech1 && fecha_fin_4 == fech_final_1 && cbx_tipo_4 == cbx_tipo) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_4 = fech1;
                fecha_fin_4 = fech_final_1;
                cbx_tipo_4 = cbx_tipo;
                valor_busqueda = 0;
            }
            break;
        case 5:
            if(fecha_inicial_5 == fech1 && fecha_fin_5 == fech_final_1 && cbx_tipo_5 == cbx_tipo) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_5 = fech1;
                fecha_fin_5 = fech_final_1;
                cbx_tipo_5 = cbx_tipo;
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

    if(cantidad == a){
        $("#nav-bono").show();
        
    }else {
        $("#nav-bono").hide(); 
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
            if( fechai < fechaf){
                if(valor_busqueda == 0){
                     //AJAX para mostrar la lista de empresas
                     $.post("../../controller/pensioncontrolador.php?op=combo",{txtdateinicio: fech1 , txtdatefin: fech_final_1, tipo : cbx_tipo}, function(data){
                        if(data == ""){
                            console.log("NO EXISTE DATA");
                        }else {
                            $("#lst_emp_"+a).html(data);
                        }
                    });

                    //AJAX muestra la primera empresa de la lista
                    $.post("../../controller/pensioncontrolador.php?op=pensionaleatorioempresa",{txtdateinicio: fech1 , txtdatefin: fech_final_1, tipo : cbx_tipo},function(data){
                    
                        if(data == ""){
                            Swal.fire({
                                position: 'center',
                                icon: 'info',
                                title: 'No existe informacion',
                                showConfirmButton: false,
                                timer:1500
                            });
                        } else {
                            data = JSON.parse(data);
                            //$("#lst_emp_"+a).val(data[0]['ruc']).trigger('change');
                            $('#nom_emp_'+a).html(data[0]['ruc']+" - "+data[0]['empleador']);
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
                            $('#fech_inicio_emp').val(fech1);
                            $('#fech_final_emp').val(fech_final_1);
                            $('#cargo_emp').val(cargo);
                            $('#dpto_emp_'+a).val(data[0]['dpto']); 
                            $('#rep_legal_'+a).val(data[0]['rep_legal']); 
                            $('#dni_a_'+a).val(data[0]['dni_a']);
                            $('#rango_emp_'+a).val(data[0]['f_inic_act'] +" / "+ data[0]["f_baja_act"]);   
            
            
                            nom_em = data[0]['empleador'];    
                            nom = $('#nom_emp_lab'+ num).val();
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
                            $('#nom_emp_lab'+ num).html(data[0]['empleador']);
                            $('#nombre_emp'+num).val(data[0]['empleador']);
                            $('#cargo_emp'+num).val(cargo);
                            $('#fech_inicio_emp'+num).val(fechai);
                            $('#fech_final_emp'+num).val(fechaf)
                            $('#dpto_emp'+num).val(dpto1);
                            $('#logo_nombre'+num).val(logos);
                            $('#firmante_emp'+num).val(firm)
                            $('#sueldo_emp'+num).val(data[0]['fechsueldo']);
                            $('#moneda_emp'+num).val(data[0]['moneda_rm']);
                            $('#tiempo_imp'+ num).val(tmp +" Años");
                    
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
                            $('.tiempo_liqui_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses ');
                            $('.anios_temp').html(data[0]['Anios']);
                            $('.tot_imp').html(tot);
                            $('.sueldo_imp').html(sldo);
                            $('.nom_emp_ap_rp').html(rp);
                            $('.dni_imp_rp').html(dnia);
                            
    
                            $('.img_logo').attr("src","../../assets/img/"+logos);
                            $('.firmante_nom').html(firm);
                            $('.departamento_imp').html(dpto1.toUpperCase());
                            $('.cargo_imp_low').html(cargo.toLowerCase());
                            $('.desde_imp_num').html(convertDateFormat(fech1));
                            $('.hasta_imp_num').html(convertDateFormat(fech_final_1));
                            $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech_final_1));
                            $('#sueldo_emp'+ num).val(data[0]['fechsueldo']);
                            $('#moneda_emp'+ num).val(data[0]['moneda_rm']);
    
                            /* LIQUIDACION */
                            $('#dias_liqui'+ num).val(data[0]['Dias']);
                            $('#meses_liqui'+ num).val(data[0]['Meses']);
                            $('#anios_liqui'+ num).val(data[0]['Anios']);
                            $('#ruc_emp'+num).val(data[0]['ruc']);
    
                            $('#sueldo_liquidacion'+ num).val(data[0]['fechsueldo']);

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

                            SumarAniosEmpresas(a);
                            sumarbono(a);
                            MostrarCertificados(data[0]['tipo_emp'], num);
                            MostrarLiquidacion(fech_final_1, data[0]['tipo_emp'], num);
                            /*OBETNER COMBO FIRMANTE */
                            /*$.post("../../controller/firmacontrolador.php?op=combo",{numero : data[0]['ruc']}, function(data){
                                // console.log(data);
                                $("#firmante"+a).html(data);  
                            });*/
                        }   
                    });
                }else {
                    $.post("../../controller/pensioncontrolador.php?op=buscardpto",{txtdateinicio: fech1 , txtdatefin: fech_final_1, txtrazon : razsocialruc},function(data){
                    
                        if(data == ""){
                            Swal.fire({
                                position: 'center',
                                icon: 'info',
                                title: 'No existe informacion',
                                showConfirmButton: false,
                                timer:1500
                            });
                        } else {
                            data = JSON.parse(data);
                            //$("#lst_emp_"+a).val(data[0]['ruc']).trigger('change');
                            $('#nom_emp_'+a).html(data[0]['ruc']+" - "+data[0]['empleador']);
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
                            $('#fech_inicio_emp').val(fech1);
                            $('#fech_final_emp').val(fech_final_1);
                            $('#cargo_emp').val(cargo);
                            $('#dpto_emp_'+a).val(data[0]['dpto']); 
                            $('#rep_legal_'+a).val(data[0]['rep_legal']); 
                            $('#dni_a_'+a).val(data[0]['dni_a']);
                            $('#rango_emp_'+a).val(data[0]['f_inic_act'] +" / "+ data[0]["f_baja_act"]);   
            
            
                            nom_em = data[0]['empleador'];    
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
                            $('#nom_emp_lab'+ num).html(data[0]['empleador']);
                            $('#nombre_emp'+num).val(data[0]['empleador']);
                            $('#cargo_emp'+num).val(cargo);
                            $('#fech_inicio_emp'+num).val(fechai);
                            $('#fech_final_emp'+num).val(fechaf)
                            $('#dpto_emp'+num).val(dpto1);
                            $('#logo_nombre'+num).val(logos);
                            $('#firmante_emp'+num).val(firm)
                            $('#sueldo_emp'+num).val(data[0]['fechsueldo']);
                            $('#moneda_emp'+num).val(data[0]['moneda_rm']);
                            $('#tiempo_imp'+ num).val(tmp +" Años");
                    
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
                            $('.tiempo_liqui_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses ');
                            $('.anios_temp').html(data[0]['Anios']);
                            $('.tot_imp').html(tot);
                            $('.sueldo_imp').html(sldo);
                            $('.nom_emp_ap_rp').html(rp);
                            $('.dni_imp_rp').html(dnia);
                            
    
                            $('.img_logo').attr("src","../../assets/img/"+logos);
                            $('.firmante_nom').html(firm);
                            $('.departamento_imp').html(dpto1.toUpperCase());
                            $('.cargo_imp_low').html(cargo.toLowerCase());
                            $('.desde_imp_num').html(convertDateFormat(fech1));
                            $('.hasta_imp_num').html(convertDateFormat(fech_final_1));
                            $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech_final_1));
                            $('#sueldo_emp'+ num).val(data[0]['fechsueldo']);
                            $('#moneda_emp'+ num).val(data[0]['moneda_rm']);

                            /* LIQUIDACION */
                            $('#dias_liqui'+ num).val(data[0]['Dias']);
                            $('#meses_liqui'+ num).val(data[0]['Meses']);
                            $('#anios_liqui'+ num).val(data[0]['Anios']);
                            $('#sueldo_liquidacion'+ num).val(data[0]['fechsueldo']);
                            $('#ruc_emp'+num).val(data[0]['ruc']);
    
                            $('#sueldo_liquidacion').val(data[0]['fechsueldo']);

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
                            SumarAniosEmpresas(a);
                            sumarbono(a);
                            MostrarCertificados(data[0]['tipo_emp'], num);
                            MostrarLiquidacion(fech_final_1, data[0]['tipo_emp'], num);
                            /*OBETNER COMBO FIRMANTE */
                            /*$.post("../../controller/firmacontrolador.php?op=combo",{numero : data[0]['ruc']}, function(data){
                                // console.log(data);
                                $("#firmante"+a).html(data);  
                            });*/
                        }   
                    });
                }
                
                //$("#lst_emp_"+a).val(razsocialruc).trigger('change');
                //$("#contemp1").show();
                $("#prev1").show();
                //$("#prev_certificado_1").show();
    
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
function LogoHost(a){
    
    $('#div_logo_host_'+a).show();
    let estado = $("#logo_host_"+a).val();
    $("#logo_img_host_"+a).attr("src","../../assets/img/"+estado);
    
}
function LogoOrcinea(a){
    //console.log(a);
    $('#div_logo_orcinea_'+a).show();
    let estado = $("#logo_orcinea_"+a).val();
    $("#logo_img_orcinea_"+a).attr("src","../../assets/img/"+estado);  

}
function CargarOrcinea(a){

    $('#contenedor_emp'+ a).show();


    anios_orcinea = 0;
    meses_orcinea = 0;
    dias_orcinea = 0;
    let nombre_emp = $('#empresa_orcinea_'+a).val();
    let fech1 = $('#orcinea_inicio_'+a).val();
    let fech1f = $('#orcinea_fin_'+a).val();
    let fechna =$('#txtdate').val();
    var cargo = $('#cargo_orcinea_'+a).val();
    let tipo_orc = $('#cbx_tipo_orc_'+a).val();
    let mananaf = moment(fechna).add(16, 'years').format('YYYY-MM-DD');
    let nombres= $('#txtnombre').val();
    let apelli= $('#txtapellido').val();
    let logos = $('#logo_orcinea_'+a).val();
    $('#logo_nombre'+ a).val(logos);
    let dpto1 = "LIMA";
    let firmante = $('#firmante_orcinea_'+a).val();
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var cant = $('#txtcant_orcinea').val();
    //Agregar un dia a la siguiente empresa
    if(cant > a){
        var n_emp = a + 1 ;
        var fecha_i_nueva = moment(fech1f).add(1, 'days').format('YYYY-MM-DD');
        $('#orcinea_inicio_'+n_emp).val(fecha_i_nueva);
    }

    if(logos == "" || logos == "no-fotos.png"){
        $('.div_logo_pdf').hide();
    }else {
        $('.div_logo_pdf').show();
    }
    if(fech1 != "" || fech1f != ""){
        let fechain = new  Date(fech1);
        let fechafi = new  Date(fech1f);
        let fechan= new Date(mananaf);

        var fechaimod = fechain.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechafmod = fechafi.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechai = new Date(fechaimod);
        var fechaf=  new Date(fechafmod);
        console.log(fechai);
        console.log(fechaf);
        if(fechai >= fechan){
            if(fechai < fechafi){
                var orcinea_inicio = moment($("#orcinea_inicio_"+a).val());
                var orcinea_fin = moment($("#orcinea_fin_"+a).val());
            
                dife1 = orcinea_fin.diff(orcinea_inicio, 'days');
                //console.log(dife1);
                anios_orcinea = Math.trunc(dife1 / 365);
                dias_orcinea = dife1 % 365;
            
                if(dias_orcinea >= 30){ 
                    mes_orci = Math.trunc(dias_orcinea / 30);
                    dias_orcinea = dias_orcinea % 30;
                    meses_orcinea = meses_orcinea + mes_orci;
        
                }
                if(meses_orcinea >= 12){
        
                    anio_orci = Math.trunc(meses_orcinea / 12);
                    meses_orcinea = meses_orcinea % 12;
                    anios_orcinea = anios_orcinea + anio_orci;
                }
        
        
                mensaje = anios_orcinea+' Años'+' '+meses_orcinea+' meses'+' '+dias_orcinea+' dias'; 
                $("#cant_orcinea_"+a).val(mensaje);
                sumartiempo();

                //Asignar valores a TabsEmpresa
                $('#nom_emp_lab'+ a).html(nombre_emp);
                $('#nombre_emp'+ a).val(nombre_emp);
                $('#cargo_emp'+ a).val(cargo);
                $('#fech_inicio_emp'+ a).val(fechai);
                $('#fech_final_emp'+ a).val(fechaf)
                $('#dpto_emp'+ a).val(dpto1);
                $('#logo_nombre'+ a).val(logos);
                $('#firmante_emp'+ a).val(firmante);
                $('#tiempo_imp'+ a).val(anios_orcinea +" Años");



                
                $('.emp_imp').html(nombre_emp);
                $('.nombre_imp').html(nombres+" "+apelli);
                $('.cargo_imp').html(cargo);
                $('.desde_imp').html(fechai.toLocaleDateString("es-ES", options).toUpperCase());
                $('.hasta_imp').html(fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                $('.lugardia').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                $('.desde_imp_low').html(fechai.toLocaleDateString("es-ES", options));
                $('.hasta_imp_low').html(fechaf.toLocaleDateString("es-ES", options));
                $('.lugardia_low').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options));
                $('.firmante_nom').html(firmante);
                $('.img_logo').attr("src","../../assets/img/"+logos);
                $('.tiempo_imp').html(anios_orcinea +" Años");
                //$('.tiempo_liqui_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses ');
                //$('.anios_temp').html(data[0]['Anios']);
                //$('.tot_imp').html(tot);
                //$('.firmante_nom').html(firm);
                $('.departamento_imp').html(dpto1.toUpperCase());
                $('.cargo_imp_low').html(cargo.toLowerCase());
                $('.desde_imp_num').html(convertDateFormat(fech1));
                $('.hasta_imp_num').html(convertDateFormat(fech1f));
                $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech1f));
                console.log(fech1);
                console.log(fech1f);

                
                $('#dias_liqui'+ a).val(dias_orcinea);
                $('#meses_liqui'+ a).val(meses_orcinea);
                $('#anios_liqui'+ a).val(anios_orcinea);

                $.post("../../controller/pensioncontrolador.php?op=buscar_mes",{fecha : fech1f}, function(data){
                    if(data != ""){
                        data = JSON.parse(data);
                        $('#sueldo_liquidacion'+ a).val(data.sueldo_minimo);
                        $('#sueldo_emp'+ a).val(data.sueldo_minimo);
                        $('#moneda_emp'+ a).val(data.unidad_moneda);
                        //console.log(data);
                        /*$('#at_ss').val(data.at_ss);
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
                        $('#dsc_ap_pension').html(data.ap_fondo_juvi+'%');*/
                    }
                });


                MostrarCertificados(tipo_orc, a);
                MostrarLiquidacion(fech1f, tipo_orc, a);
                //$("#contemp1").show();
                $("#prev1").show();

            }else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Introduzca una fecha mayor a la fecha de inicio',
                    showConfirmButton: false,
                    timer:1500
                });
            }
            
        }else {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Introduzca una fecha mayor a la fecha de nacimiento',
                showConfirmButton: false,
                timer:1500
            });
        }
    }else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca la fecha inicio y fin ',
            showConfirmButton: false,
            timer:1500
        });
    }
}
function CargarHost(a){
    let e = Number(a + 4);
    //console.log(a);
    //$('#form_liqui')[0].reset();
    //$('#form_bol')[0].reset();
    $('#contenedor_emp'+ e).show();
    anios_host = 0;
    meses_host = 0;
    dias_host = 0;
    let nombre_emp = $('#empresa_host_'+a).val();
    var cargo = $('#cargo_host_'+a).val();
    let tipo_orc = $('#cbx_tipo_host_'+a).val();
    let nombres= $('#txtnombre').val();
    let apelli= $('#txtapellido').val();
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    let fech1 = $('#host_inicio_'+a).val();
    let fech1f = $('#host_fin_'+a).val();
    let fechnc =$('#txtdate').val();
    let firmante = $('#firmante_host_'+a).val();
    let logos = $('#logo_host_'+a).val();
    $('#logo_nombre'+ e).val(logos);
    let dpto1 = "LIMA";
    let mananaf = moment(fechnc).add(16, 'years').format('YYYY-MM-DD');
    var cant = $('#txtcant_host').val();
    //Agregar un dia a la siguiente empresa
    if(cant > a){
        var n_emp = a + 1 ;
        var fecha_i_nueva = moment(fech1f).add(1, 'days').format('YYYY-MM-DD');
        $('#host_inicio_'+n_emp).val(fecha_i_nueva);
    }

    if(logos == "" || logos == "no-fotos.png"){
        $('.div_logo_pdf').hide();
    }else {
        $('.div_logo_pdf').show();
    }
    if(fech1 != "" || fech1f != ""){
        let fechain = new  Date(fech1);
        let fechafi = new  Date(fech1f);
        let fechanc= new Date(mananaf);
        var fechaimod = fechain.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechafmod = fechafi.toLocaleString('en-US', {
            timeZone: 'Europe/London'
        });
        var fechai = new Date(fechaimod)
        var fechaf=  new Date(fechafmod);


        if(fechai >= fechanc){

            if(fechai < fechafi){
                let host_inicio = moment($("#host_inicio_"+a).val());
                let host_fin = moment($("#host_fin_"+a).val());
        
                dife1 = host_fin.diff(host_inicio, 'days');
                anios_host = Math.trunc(dife1 / 365);
                dias_host = dife1 % 365;
        
        
                if(dias_host >= 30){ 
                    mes_ht = Math.trunc(dias_host / 30);
                    dias_host = dias_host % 30;
                    meses_host = meses_host + mes_ht;
        
                }
                if(meses_host >= 12){
        
                    anio_ht = Math.trunc(meses_host / 12);
                    meses_host = meses_host % 12;
                    anios_host = anios_host + anio_ht;
                }
        
                mensaje = anios_host+' Años'+' '+meses_host+' meses'+' '+dias_host+' dias'; 
                
                $("#cant_host_"+a).val(mensaje);
                sumartiempo();

                //Asignar valores a TabsEmpresa
                $('#nom_emp_lab'+ e).html(nombre_emp);
                $('#nombre_emp'+ e).val(nombre_emp);
                $('#cargo_emp'+ e).val(cargo);
                $('#fech_inicio_emp'+ e).val(fechai);
                $('#fech_final_emp'+ e).val(fechaf)
                $('#dpto_emp'+ e).val(dpto1);
                $('#logo_nombre'+ e).val(logos);
                $('#firmante_emp'+ e).val(firmante);
                $('#tiempo_imp'+ e).val(anios_host +" Años");
                
                $('.emp_imp').html(nombre_emp);
                $('.nombre_imp').html(nombres+" "+apelli);
                $('.cargo_imp').html(cargo);
                $('.desde_imp').html(fechai.toLocaleDateString("es-ES", options).toUpperCase());
                $('.hasta_imp').html(fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                $('.lugardia').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options).toUpperCase());
                $('.desde_imp_low').html(fechai.toLocaleDateString("es-ES", options));
                $('.hasta_imp_low').html(fechaf.toLocaleDateString("es-ES", options));
                $('.lugardia_low').html(dpto1+", "+fechaf.toLocaleDateString("es-ES", options));
                $('.firmante_nom').html(firmante);
                $('.img_logo').attr("src","../../assets/img/"+logos);
                $('.tiempo_imp').html(anios_host +" Años");
                //$('.tiempo_liqui_imp').html(data[0]['Anios']+' Años '+ data[0]['Meses']+' Meses ');
                //$('.anios_temp').html(data[0]['Anios']);
                //$('.tot_imp').html(tot);
                //$('.firmante_nom').html(firm);
                $('.departamento_imp').html(dpto1.toUpperCase());
                $('.cargo_imp_low').html(cargo.toLowerCase());
                $('.desde_imp_num').html(convertDateFormat(fech1));
                $('.hasta_imp_num').html(convertDateFormat(fech1f));
                $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech1f));

                 /* LIQUIDACION */
                 $('#dias_liqui' + e).val(dias_orcinea);
                 $('#meses_liqui' + e).val(meses_orcinea);
                 $('#anios_liqui' + e).val(anios_orcinea);

                $.post("../../controller/pensioncontrolador.php?op=buscar_mes",{fecha : fech1f}, function(data){
                    if(data != ""){
                        data = JSON.parse(data);
                        $('#sueldo_liquidacion'+ e).val(data.sueldo_minimo);
                        $('#sueldo_emp'+ e).val(data.sueldo_minimo);
                        $('#moneda_emp'+ e).val(data.unidad_moneda);
                        //console.log(data);
                        /*$('#at_ss').val(data.at_ss);
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
                        $('#dsc_ap_pension').html(data.ap_fondo_juvi+'%');*/
                    }
                });


                MostrarCertificados(tipo_orc, e);
                MostrarLiquidacion(fech1f, tipo_orc, e);
                //$("#contemp1").show();
                $("#prev1").show();
            }else {
                Swal.fire({
                    position: 'center',
                    icon: 'info',
                    title: 'Introduzca una fecha mayor a la fecha de inicio',
                    showConfirmButton: false,
                    timer:1500
                });
            }
            
        }else {
            Swal.fire({
                position: 'center',
                icon: 'info',
                title: 'Introduzca una fecha mayor a la fecha de nacimiento',
                showConfirmButton: false,
                timer:1500
            });
        }
    
    }else {
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca la fecha inicio y fin ',
            showConfirmButton: false,
            timer:1500
        });
    }

    
}

$(document).on("click","#btnbuscarEmpresas", function(){

    tipo = $("#tipo_doc").val();
    doc = $("#num_doc").val();
	NroEmp = $("#txtNroEmpresa").val();
	FechaNac = $("#txtdate").val();
    //console.log(doc);

    if(doc =="" ||  tipo == ""){
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: 'Introduzca datos validos',
            showConfirmButton: false,
            timer:1500
        });
    }else {
        //console.log("BUSCAR");
        $.post("../../controller/pensioncontrolador.php?op=buscarEmpresas",{nroEmpresas: NroEmp , Fec_Nac: FechaNac},function(data){
            //console.log(data);
            if(data == ""){
				$("#divresultadoEmpresa").hide();
				$('#divresultadoEmpresa').removeClass().addClass('form-layout form-layout-4');  
            }else {
                
                //data = JSON.parse(data);
				var $filas='';
				var nCntFila = 0;
				$.each(JSON.parse(data), function (i, Detalle) {
					if ( nCntFila == 0 ){
						pintarTab(Detalle.ruc,"'"+Detalle.empleador+"'");
					}
					
					$filas+='<div class="accordion-item" onclick="pintarTab('+Detalle.ruc+',$'+Detalle.empleador +'$)" >';
					$filas = $filas.replace("$","'").replace("$","'");
					$filas+='	<h2 class="accordion-header" id="heading_' + Detalle.ruc +'">';
					$filas+='	<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_'+Detalle.ruc+'" aria-expanded="true" aria-controls="collapse_'+Detalle.ruc+'">';
					$filas+='		' + Detalle.empleador + '';
					$filas+='	</button>';
					$filas+='	</h2>';
					$filas+='	<div id="collapse_'+Detalle.ruc+'" class="accordion-collapse collapse" aria-labelledby="heading_'+Detalle.ruc+'" data-bs-parent="#accordionEmpresa">';
					$filas+='		<div class="accordion-body">';
					$filas+='			<div id="orcinea" class="">';
					$filas+='				<form id="form_orci" action="" method="post" autocomplete="off">';
					$filas+='					<div class="pd-15">';
					$filas+='						<div class="row mg-b-25">';
					$filas+='							<div class="col-lg-12">';
					$filas+='								<div class="form-group">';
					$filas+='									<label class="form-control-label">Empresa: <span class="tx-danger">*</span></label>';
					$filas+='									<input class="form-control" type="text" name="empresa_'+Detalle.ruc+'" value="'+Detalle.empleador+'" disabled>';
					$filas+='								</div>';
					$filas+='							</div><!-- col-4 -->';
					$filas+='							<div class="col-lg-6">';
					$filas+='								<div class="form-group">';
					$filas+='									<label class="form-control-label">Inicio: <span class="tx-danger">*</span></label>';
					$filas+='									<input class="form-control fecha_inicio" type="date" name="inicio_'+Detalle.ruc+'" id="inicio_'+Detalle.ruc+'"  placeholder="" required>';
					$filas+='								</div>';
					$filas+='							</div><!-- col-4 -->';
					$filas+='							<div class="col-lg-6">';
					$filas+='								<div class="form-group">';
					$filas+='									<label class="form-control-label">Fin: <span class="tx-danger">*</span></label>';
					$filas+='									<input class="form-control fecha_fin" type="date" name="fin_'+Detalle.ruc+'" id="fin_'+Detalle.ruc+'"  placeholder="" required>';
					$filas+='								</div>';
					$filas+='							</div><!-- col-4 -->';
					$filas+='							<div class="col-lg-8">';
					$filas+='								<div class="form-group mg-b-10-force">';
					$filas+='									<label class="form-control-label">Cargo: <span class="tx-danger">*</span></label>';
					$filas+='									<input class="form-control" type="text" name="cargo_'+Detalle.ruc+'" id="cargo_'+Detalle.ruc+'"  placeholder="" required>';
					$filas+='								</div>';
					$filas+='							</div><!-- col-8 -->';
					$filas+='							<div class="row d-flex justify-content-center">';
					$filas+='							<div class="col-lg-4 text-center">';
					$filas+='								<br>';
					$filas+='								<button class="btn btn-secondary btn-block mg-b-10" type="button" id="btnLimpiar_'+Detalle.ruc+'" name="btnLimpiar_'+Detalle.ruc+'" onclick="LimpiarCamposEmpresas('+Detalle.ruc+')">Limpiar</button>';
					$filas+='							</div><!-- col-4 -->';
					$filas+='							<div class="col-lg-4 text-center">';
					$filas+='								<br>';
					$filas+='								<button class="btn btn-info btn-block mg-b-10" type="button" id="btncargar_'+Detalle.ruc+'" name="btncargar_" onclick="SumarAniosEmpresas('+Detalle.ruc+')">Registrar</button>';
					$filas+='							</div><!-- col-4 -->';
					$filas+='							</div>';
					$filas+='						</div><!-- row -->';
					$filas+='					</div>';
					$filas+='				</form>';
					$filas+='			</div>';
					$filas+='		</div>';
					$filas+='	</div>';
					$filas+='</div>';
					
					nCntFila++;
				});
				$("#divresultadoEmpresa > .accordion").html("");
				$("#divresultadoEmpresa > .accordion").append($filas);
				$("#divresultadoEmpresa").show();
                $('#divresultadoEmpresa').removeClass().addClass('form-layout form-layout-4');
				mostrarDatosEmpresasDerecha(JSON.parse(data));
				$("#divMostrarTab").show();
            }
        });
    }
});


function pintarTab(valor, nombre){
	var $filas='';
	$("#divMostrarTab").html("");

	$filas+='<div id="contemp1_'+valor+'" name="contemp1" class="form-layout form-layout-1">'
	$filas+='	<h6 class="text-center" id="nom_emp_lab">'+nombre+'</h6>'
	$filas+='	<br>'
	$filas+='	<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist" style="border-bottom : 0px">'
	$filas+='		<li class="nav-item" role="presentation">'
	$filas+='			<button class="nav-link active btn btn-outline-secondary btn-block mg-b-10 "  id="orcinea-tab"  data-bs-toggle="pill" data-bs-target="#certificado" type="button" role="tab" aria-controls="certificado"  aria-selected="true" >Certificado</button>'
	$filas+='		</li>'
	$filas+='		<li class="nav-item" role="presentation">'
	$filas+='			<button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="host-tab"     data-bs-toggle="pill" data-bs-target="#liquidacion"    type="button" role="tab" aria-controls="liquidacion"     aria-selected="false">Liquidacion</button>'
	$filas+='		</li>'
	$filas+='		<li class="nav-item" role="presentation">'
	$filas+='			<button class="nav-link btn btn-outline-secondary btn-block mg-b-10 " id="refelx-tab"   data-bs-toggle="pill" data-bs-target="#boleta"  type="button" role="tab" aria-controls="boleta"   aria-selected="false">Boleta</button>'
	$filas+='		</li>'
	$filas+='	</ul>'
	$filas+='	<div class="tab-content">'
	$filas+='		<!-- AQUI VA EL CONTENIDO -->'
	$filas+='		<div id="certificado" class="tab-pane fadein show active">'
	$filas+='		</div>'
	$filas+='		<div id="liquidacion" class="tab-pane fade">'
	$filas+='			<form id="form_orci" action="" method="post" autocomplete="off">'
	$filas+='				<div class="form-layout form-layout-1">'
	$filas+='					<div class="row">'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Adelanto: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'" value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Vacaciones: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Gratificaciones: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Reintegro: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Incentivo: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Bonificacion: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Bon. Graciosa: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Bon. Extraordinaria: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='					</div><!-- row -->'
	$filas+='				</div>'
	$filas+='			</form>'
	$filas+='		</div>'
	$filas+='		<div id="boleta" class="tab-pane fade">'
	$filas+='			<form id="form_orci" action="" method="post" autocomplete="off">'
	$filas+='				<div class="form-layout form-layout-1">'
	$filas+='					<div class="row ">'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Fecha: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="date" name="empresa_'+valor+'"  placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">REM. Vacacional: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0"  placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Reintegro: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">H. Extras: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Bonificacion: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='						<div class="col-lg-12">'
	$filas+='							<div class="row mg-b-5">'
	$filas+='								<label class="form-control-label col-lg-6">Otros: <span class="tx-danger">*</span></label>'
	$filas+='								<input class="form-control col-lg-6 empresa_tab" type="text" name="empresa_'+valor+'"  value="0" placeholder="" required>'
	$filas+='							</div>'
	$filas+='						</div><!-- col-4 -->'
	$filas+='					</div><!-- row -->'
	$filas+='				</div>'
	$filas+='			</form>'
	$filas+='		</div>'
	$filas+='	</div>'
	$filas+='	<div class="form-layout-footer text-right mg-t-20">'
	$filas+='		<button type="button" id="btnimprimir" name="btnimprimir"  class="btn btn-info">Imprimir Certificado</button>'
	$filas+='	</div><!-- form-layout-footer -->'
	$filas+='</div>'

	$("#divMostrarTab").append($filas);
}

//function mostrarDatosEmpresasDerecha(aListaEmpresas){
function mostrarDatosEmpresasDerecha(){
    cnt = $('#txtcant_emp').val();
    cnt_orcinea = $('#txtcant_orcinea').val();
    cnt_host = $('#txtcant_host').val();
	var $filas='';
	$("#datosEmpresas").html("");
	
	$filas+='<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Datos de la Empresa</h6>'
	$filas+='<p class="mg-b-30 tx-gray-600">Se visualizan los datos de la empresa</p>'
	for(a = 1; a <= cnt_orcinea ; a++){
        $filas+='<div class="row mg-t-15">'
        $filas+='	<label class="col-sm-4 form-control-label">Orcinea '+a+' :</label>'
        $filas+='	<div class="col-sm-8 mg-t-10 mg-sm-t-0">'
        $filas+='		<input readonly type="text" class="form-control" id="cant_orcinea_'+a+'"  placeholder="">'
        $filas+='	</div>'
        $filas+='</div><!-- row -->'
    }
	for(b = 1; b<=cnt_host; b++){
        $filas+='<div class="row mg-t-15">'
        $filas+='	<label class="col-sm-4 form-control-label">Host: '+b+' :</label>'
        $filas+='	<div class="col-sm-8 mg-t-10 mg-sm-t-0">'
        $filas+='		<input readonly type="text" class="form-control" id="cant_host_'+b+'"   placeholder="">'
        $filas+='	</div>'
        $filas+='</div>'
    }
    for(i = 1 ; i <= cnt ; i++){
        $filas+='<div class="row mg-t-15">'
		$filas+='	<label class="col-sm-4 form-control-label">Empresa '+i+' :</label>'
		$filas+='	<div class="col-sm-8 mg-t-10 mg-sm-t-0">'
		$filas+='		<input readonly type="text" class="form-control tiempo_Empresa" id="tiempo_Empresa_'+i+'" placeholder="">'
		$filas+='	</div>'
		$filas+='</div>'
    }
	
	$filas+='<div class="row mg-t-15">'
	$filas+='	<label class="col-sm-4 form-control-label">Total:</label>'
	$filas+='	<div class="col-sm-8 mg-t-10 mg-sm-t-0">'
	$filas+='		<input readonly type="text" class="form-control" id="total_tiempo" name="total_tiempo" placeholder="">'
	$filas+='	</div>'
	$filas+='</div><!-- row -->'
	
	$("#datosEmpresas").append($filas);
}

function LimpiarCamposEmpresas(valor){
	

    $("#contemp1").hide();
    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#prev4").hide();
    $("#lst_emp_"+valor).html("");
    $('#lst_emp_'+valor).select2("val", "0");
    $("#tiempo_"+valor).html("");
    $("#fech_sueldo_"+valor).html("");
    $('#lst_emp_'+valor).select2("val", "0");
    $('#f_inicio_'+valor).val("");
    $('#f_final_'+valor).val("");
    $('#dpto_emp_'+valor).val("");
    $('#nom_emp_'+valor).html("Empresa "+ valor);
    $('#cargoc'+valor).select2("val", "0");
    $('#tiempo_Empresa_'+valor).val("");
    $(".empresa_tab").each(function() {
		$(this).val(0);
	});
    $('#logo'+valor).select2("val", "0");
    $('#firmante'+valor).select2("val", "0");
    $("#div_logo_"+valor).hide();
	sumartiempo();
}


function LimpiarCamposOrcinea(a){
	anios_orcinea = 0;
	meses_orcinea = 0;
	dias_orcinea = 0;

	$('#orcinea_inicio_'+a).val("");
	$('#orcinea_fin_'+a).val("");
	$('#cant_orcinea_'+a).val("");	
	$('#cargo_orcinea_'+a).select2("val", "0");
    $('#logo_orcinea_'+a).select2("val", "0");
    //$('#firmante_orcinea_'+a).select2("val", "0");
    //$('#logo_img_orcinea_'+a).attr("src","../../assets/img/no-fotos.png");
    $('#form_orci_'+a)[0].reset();
    $("#div_logo_orcinea_"+a).hide();
	
	sumartiempo();
}

function LimpiarCamposHost(a){
	anios_host = 0;
	meses_host = 0;
	dias_host = 0;
	
	$('#host_inicio_'+a).val("");
	$('#host_fin_'+a).val("");
	$('#cant_host_'+a).val("");	
	$('#host_cargo_'+a).val("");
    $('#logo_host_'+a).select2("val", "0");
    //$('#firmante_host_'+a).select2("val", "0");
    $('#logo_img_host_'+a).attr("src","../../assets/img/no-fotos.png");
    $('#form_host_'+a)[0].reset();
    $("#div_logo_host_"+a).hide();
    
	sumartiempo();
}

function LimpiarCamposReflex(){
	anios_reflex = 0;
	meses_reflex = 0;
	dias_reflex = 0;

	$('#cant_reflex').val("");
	$('#cant_meses').val("");
	
	sumartiempo();
}

function imprimir_word(e){  


    var tipo = $('#tipo_emp'+ e).val();
    let tipoprev = $('#select_certificado'+ e).val();
    let nombreruta = 'certificado_'+tipoprev;
    var nombre = $('#txtnombre').val();
    var apellido = $('#txtapellido').val();
    var nombre_emp = $('#nom_emp_lab'+ e).html();
    var nombre_com = nombre + ' ' + apellido;
    var num_doc = $('#num_doc').val();
    var nom_carpeta = "REPORTE-BONO-"+ num_doc;
    var fecha_inicio = $('.desde_imp').html();
    var fecha_hasta = $('.hasta_imp').html();
    var fecha_inicio_num = $('.desde_imp_num').html();
    var fecha_hasta_num = $('.hasta_imp_num').html();
    var lugar_dia = $('.lugardia').html();
    var cargo = $('#cargo_emp'+ e).val();
    var logo = $('#logo_nombre'+ e).val();
    var firmante = $('.firmante_nom').html();
    var ruc = $('#ruc_emp'+ e).val();

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
            /*if( response != "" )
            {
                let data_return = JSON.parse(response);
                if( data_return['status'] == 0 )
                {
                    //alert(data_return['message'] + ": "  + data_return['data']['file_zip'] + " - Archivos creados en el zip: " + data_return['data']['numFiles'] );
                    swal.close();    
                    var enlace = document.createElement('a');
                    enlace.href = '../../files/' + nom_carpeta+"/"+nom_carpeta+".zip";
                    enlace.download = nom_carpeta+".zip";
                    enlace.style.display = 'none';
                    document.body.appendChild(enlace);
                    enlace.click();
                    document.body.removeChild(enlace);
                }
                else
                {
                    console.log("Sucedio un error en el servidor");
                }
            }
            else
            {
                console.log("Sucedio un error en el servidor");
            }*/
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
    var nom_carpeta         = "REPORTE-BONO-"+ num_doc;
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
            //console.log(response);
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
    let tipoprev = $('#select_certificado'+ e).val();
    var ficha = document.getElementById('contenido_certificado_'+tipoprev);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>Certificado</title>');
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

    let e = $('#num_emp').val();
    if( e == '') {
        e = 1;
    }
    let tipoprev1 = $('#combo_prev_boleta'+ e).val();
    let ficha = document.getElementById('contenido_boleta_'+tipoprev1);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>Boleta</title>');
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

function imprimir_bono(){
    /*var contenido = document.getElementById('contenido_bono').innerHTML;
    var contenidoOriginal = document.body.innerHTML;
    document.body.innerHTML = contenido;
    window.print();
    document.body.innerHTML = contenidoOriginal;*/

    let tipoprev = $('#combo_prev_bono').val();
    let ficha = document.getElementById('contenido_bono_'+tipoprev);
    var ventimp1 = window.open(' ', 'Imprimir');
    ventimp1.document.write('<html><head><title>Bono</title>');
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

function OcultarPrev(){
    $('.prev_certificado').hide();
    $('.prev_liquidacion').hide();
    $('.prev_boleta').hide();
    $('.prev_bono').hide();
    $('.prev_modelo_liqui').hide();
    $('.prev_renuncia').hide();
}

function GuardarLista(){
    //console.log("PRUEBA");
    $('#valorguardar').val("1");
    let tipo_lista = $("#tipo_lista").val();
    let id_lista = $("#lista_id").val();
    let af_id = $("#af_id").val();
    let num_doc = $("#num_doc").val();
    let cantidad = $("#txtcant_emp").val();
    let cantidad_orc = $("#txtcant_orcinea").val();
    let cantidad_ht = $("#txtcant_host").val();
    let fecha_nac = $("#txtdate").val()
    let fech_orc1 = $('#orcinea_inicio_1').val();
    let fech_final_orc1 = $('#orcinea_fin_1').val();
    let tipo_orc_1 = $('#cbx_tipo_orc_1').val();
    let ruc_orc1 = $('#empresa_orcinea_1').val();
    let cargo_orc1 = $('#cargo_orcinea_1').val();
    let firmante_orc1 = $('#firmante_orcinea_1').val();
    let logo_orc1 = $('#logo_orcinea_1').val();
    let fech_orc2 = $('#orcinea_inicio_2').val();
    let fech_final_orc2 = $('#orcinea_fin_2').val();
    let tipo_orc_2 = $('#cbx_tipo_orc_2').val();
    let ruc_orc2 = $('#empresa_orcinea_2').val();
    let cargo_orc2 = $('#cargo_orcinea_2').val();
    let firmante_orc2 = $('#firmante_orcinea_2').val();
    let logo_orc2 = $('#logo_orcinea_2').val();
    let fech_orc3 = $('#orcinea_inicio_3').val();
    let fech_final_orc3 = $('#orcinea_fin_3').val();
    let tipo_orc_3 = $('#cbx_tipo_orc_3').val();
    let ruc_orc3 = $('#empresa_orcinea_3').val();
    let cargo_orc3 = $('#cargo_orcinea_3').val();
    let firmante_orc3 = $('#firmante_orcinea_3').val();
    let logo_orc3 = $('#logo_orcinea_3').val();
    let fech_orc4 = $('#orcinea_inicio_4').val();
    let fech_final_orc4 = $('#orcinea_fin_4').val();
    let tipo_orc_4 = $('#cbx_tipo_orc_4').val();
    let ruc_orc4 = $('#empresa_orcinea_4').val();
    let cargo_orc4 = $('#cargo_orcinea_4').val();
    let firmante_orc4 = $('#firmante_orcinea_4').val();
    let logo_orc4 = $('#logo_orcinea_4').val();
    let fech_ht1 = $('#host_inicio_1').val();
    let fech_final_ht1 = $('#host_fin_1').val();
    let tipo_host_1 = $('#cbx_tipo_host_1').val();
    let ruc_ht1 = $('#empresa_host_1').val();
    let cargo_ht1 = $('#cargo_host_1').val();
    let firmante_ht1 = $('#firmante_host_1').val();
    let logo_ht1 = $('#logo_host_1').val();
    let fech_ht2 = $('#host_inicio_2').val();
    let fech_final_ht2 = $('#host_fin_2').val();
    let tipo_host_2 = $('#cbx_tipo_host_2').val();
    let ruc_ht2 = $('#empresa_host_2').val();
    let cargo_ht2 = $('#cargo_host_2').val();
    let firmante_ht2 = $('#firmante_host_2').val();
    let logo_ht2 = $('#logo_host_2').val();
    let fech_ht3 = $('#host_inicio_3').val();
    let fech_final_ht3 = $('#host_fin_3').val();
    let tipo_host_3 = $('#cbx_tipo_host_3').val();
    let ruc_ht3 = $('#empresa_host_3').val();
    let cargo_ht3 = $('#cargo_host_3').val();
    let firmante_ht3 = $('#firmante_host_3').val();
    let logo_ht3 = $('#logo_host_3').val();
    let fech_ht4 = $('#host_inicio_4').val();
    let fech_final_ht4 = $('#host_fin_4').val();
    let tipo_host_4 = $('#cbx_tipo_host_4').val();
    let ruc_ht4 = $('#empresa_host_4').val();
    let cargo_ht4 = $('#cargo_host_4').val();
    let firmante_ht4 = $('#firmante_host_4').val();
    let logo_ht4 = $('#logo_host_4').val();
    let mes_rfx = "";
    let fech_inicio1 = $("#f_inicio_1").val();
    let fech_final1 = $("#f_final_1").val();
    let tipo1 = $('#cbx_tipo_1').val();
    let cargo1 = $("#cargoc1").val();
    let logo1 = $("#logo1").val();
    let ruc1 = $("#lst_emp_1").val();
    let firmante1 = $("#firmante1").val();
    let fech_inicio2 = $("#f_inicio_2").val();
    let fech_final2 = $("#f_final_2").val();
    let tipo2 = $('#cbx_tipo_2').val();
    let cargo2 = $("#cargoc2").val();
    let logo2 = $("#logo2").val();
    let ruc2 = $("#lst_emp_2").val();
    let firmante2 = $("#firmante2").val();
    let fech_inicio3 = $("#f_inicio_3").val();
    let fech_final3 = $("#f_final_3").val();
    let tipo3 = $('#cbx_tipo_3').val();
    let cargo3 = $("#cargoc3").val();
    let logo3 = $("#logo3").val();
    let ruc3 = $("#lst_emp_3").val();
    let firmante3 = $("#firmante3").val();
    let fech_inicio4 = $("#f_inicio_4").val();
    let fech_final4 = $("#f_final_4").val();
    let tipo4 = $('#cbx_tipo_4').val();
    let cargo4 = $("#cargoc4").val();
    let logo4 = $("#logo4").val();
    let ruc4 = $("#lst_emp_4").val();
    let firmante4 = $("#firmante4").val();
    let fech_inicio5 = $("#f_inicio_5").val();
    let fech_final5 = $("#f_final_5").val();
    let tipo5 = $('#cbx_tipo_5').val();
    let cargo5 = $("#cargoc5").val();
    let logo5 = $("#logo5").val();
    let ruc5 = $("#lst_emp_5").val();
    let firmante5 = $("#firmante5").val();
    //console.log(ruc1 + " "+ firmante1);
    //console.log(ruc_empresa);
    $.post("../../controller/listareportecontrolador.php?op=guardaryeditar",{
            af_id : af_id,
            documento : num_doc,
            txtcant_emp : cantidad,
            txtcant_orcinea : cantidad_orc,
            txtcant_host : cantidad_ht,
            txtdate : fecha_nac,
            f_inicio_orc_1 : fech_orc1,
            f_final_orc_1 : fech_final_orc1,
            tipo_orc_1 : tipo_orc_1,
            ruc_orc_1 : ruc_orc1,
            cargo_orc_1 : cargo_orc1,
            firmante_orc_1 : firmante_orc1,
            logo_orc_1 : logo_orc1,
            f_inicio_orc_2 : fech_orc2,
            f_final_orc_2 : fech_final_orc2,
            tipo_orc_2 : tipo_orc_2,
            ruc_orc_2 : ruc_orc2,
            cargo_orc_2 : cargo_orc2,
            firmante_orc_2 : firmante_orc2,
            logo_orc_2 : logo_orc2,
            f_inicio_orc_3 : fech_orc3,
            f_final_orc_3 : fech_final_orc3,
            tipo_orc_3 : tipo_orc_3,
            ruc_orc_3 : ruc_orc3,
            cargo_orc_3 : cargo_orc3,
            firmante_orc_3 : firmante_orc3,
            logo_orc_3 : logo_orc3,
            f_inicio_orc_4 : fech_orc4,
            f_final_orc_4 : fech_final_orc4,
            tipo_orc_4 : tipo_orc_4,
            ruc_orc_4 : ruc_orc4,
            cargo_orc_4 : cargo_orc4,
            firmante_orc_4 : firmante_orc4,
            logo_orc_4 : logo_orc4,
            f_inicio_ht_1 : fech_ht1,
            f_final_ht_1 : fech_final_ht1,
            tipo_host_1 : tipo_host_1,
            ruc_ht_1 : ruc_ht1,
            cargo_ht_1 : cargo_ht1,
            firmante_ht_1 : firmante_ht1,
            logo_ht_1 : logo_ht1,
            f_inicio_ht_2 : fech_ht2,
            f_final_ht_2 : fech_final_ht2,
            tipo_host_2 : tipo_host_2,
            ruc_ht_2 : ruc_ht2,
            cargo_ht_2 : cargo_ht2,
            firmante_ht_2 : firmante_ht2,
            logo_ht_2 : logo_ht2,
            f_inicio_ht_3 : fech_ht3,
            f_final_ht_3 : fech_final_ht3,
            tipo_host_3 : tipo_host_3,
            ruc_ht_3 : ruc_ht3,
            cargo_ht_3 : cargo_ht3,
            firmante_ht_3 : firmante_ht3,
            logo_ht_3 : logo_ht3,
            f_inicio_ht_4 : fech_ht4,
            f_final_ht_4 : fech_final_ht4,
            tipo_host_4 : tipo_host_4,
            ruc_ht_4 : ruc_ht4,
            cargo_ht_4 : cargo_ht4,
            firmante_ht_4 : firmante_ht4,
            logo_ht_4 : logo_ht4,
            meses_rfx : mes_rfx,
            f_inicio_1 : fech_inicio1,
            f_final_1 : fech_final1,
            tipo_1 : tipo1,
            ruc_emp1 : ruc1,
            cargoc1 : cargo1,
            firmante1 : firmante1,
            logo1 : logo1,
            f_inicio_2 : fech_inicio2,
            f_final_2 : fech_final2,
            tipo_2 : tipo2,
            ruc_emp2 : ruc2,
            cargoc2 : cargo2,
            firmante2 : firmante2,
            logo2 : logo2,
            f_inicio_3 : fech_inicio3,
            f_final_3 : fech_final3,
            tipo_3 : tipo3,
            ruc_emp3 : ruc3,
            cargoc3 : cargo3,
            firmante3 : firmante3,
            logo3 : logo3,
            f_inicio_4 : fech_inicio4,
            f_final_4 : fech_final4,
            tipo_4 : tipo4,
            ruc_emp4 : ruc4,
            cargoc4 : cargo4,
            firmante4 : firmante4,
            logo4 : logo4,
            f_inicio_5 : fech_inicio5,
            f_final_5 : fech_final5,
            tipo_5 : tipo5,
            ruc_emp5 : ruc5,
            cargoc5 : cargo5,
            firmante5 : firmante5,
            logo5 : logo5,
            lista : id_lista,
            tipo : tipo_lista
        }, function(data){
            //console.log("GUARDO");
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

$(document).on("click","#bono-tab", function(){

    SumarMeses();
    let sum_mes = suma_anios1 * 12 + suma_meses1;
    const constante = 0.1831;

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
    
    $('#dic_91').val(desformatearNumero(total_dic));
    $('#ene_92').val(desformatearNumero(total_ene));
    $('#feb_92').val(desformatearNumero(total_feb));
    $('#mar_92').val(desformatearNumero(total_mar));
    $('#abr_92').val(desformatearNumero(total_abr));
    $('#may_92').val(desformatearNumero(total_may));
    $('#jun_92').val(desformatearNumero(total_jun));
    $('#jul_92').val(desformatearNumero(total_jul));
    $('#ago_92').val(desformatearNumero(total_ago));
    $('#sep_92').val(desformatearNumero(total_sep));
    $('#oct_92').val(desformatearNumero(total_oct));
    $('#nov_92').val(desformatearNumero(total_nov));


    let prom_meses = (Number(total_dic) + Number(total_ene) + Number(total_feb) + Number(total_mar) + Number(total_abr) + Number(total_may) + Number(total_jun) + Number(total_jul) + Number(total_ago) + Number(total_sep) + Number(total_oct) + Number(total_nov)) / 12;
    let prom_total = (Number(prom_meses) * Number(sum_mes) * constante ).toFixed(2);
    $('#prom_meses').html(prom_meses.toFixed(2));
    //$('#cant_meses_bono').html(sum_mes);
    $('.cant_meses').html(sum_mes);
    $('#prom_total').html(prom_total);
    $('#cal_bono_1').val(prom_total);

});


$(document).on("click","#orcinea-tab", function(){
    $("#prev1").show();
    $("#prev2").hide();
    $("#prev3").hide();
});


function calcularBono(){


    /*numero = $('#txtcant_emp').val();
    
    f_inicio = moment($('#f_inicio_'+numero).val());
    f_fin = moment($('#f_final_'+numero).val());

    dife1 = f_fin.diff(f_inicio, 'months');
    //console.log(dife1);

    const constante = 0.1831
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

    $('#cal_bono_1').val(total)

    console.info("Promedio: ", promedio )
    console.info("Meses: ", meses )
    console.info("Total: ", total )*/

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
    $('#cal_bono_1').val(prom_total);
}

function ListarFirmante(a){
    let estado = $('select[name="lst_emp_'+a+'"] option:selected').text();
    let ruc = $("#lst_emp_"+a).val();

    //ruc_empresa = $("#lst_emp_"+a).val();
    $('#nom_emp_'+a).html(ruc+" - "+estado);
    $("#firmante"+a).val("");  
    /*$.post("../../controller/firmacontrolador.php?op=combo",{numero : ruc}, function(data){
        //console.log(data);
        $("#firmante"+a).html(data);  
    });*/
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

function Sumarmonto(mes) {
    let num =  0;
    for( i = 1 ; i <= 6 ; i++ ){
        num += Number($('#'+mes+'_'+i).val()); 
    }

    $('#'+mes+'_total').html(formatearNumero(num));
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

$(".conceptos").on("input", function() {
    var total = 0;
    
    // Itera sobre todos los elementos con la clase ".conceptos"
    $(".conceptos").each(function() {
        // Obtiene el valor del campo como un número flotante
        var valor = parseFloat($(this).val()) || 0; // Si el valor no es un número, asigna 0
        // Suma el valor al total si es diferente de 0
        if (valor !== 0) {
            total += valor;
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

    if ($(this).val().length > 2) {
        $(this).val($(this).val().slice(0, 2));
    }
    var valor = $(this).val();
    // Realiza acciones con el valor, por ejemplo, mostrarlo en la consola
   // console.log("Valor del campo de entrada: " + valor);
    let total = desformatearNumero($('#prom_total').html());
    //var total = parseFloat($('#prom_total').html());
    var montofinal = Number(Number(valor) * Number(total)).toFixed(2);
    //$('#monto_final').html(formatearNumero(montofinal));
    $('#monto_final').html(formatearNumero(montofinal));
});


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

$(document).on("click","#btnboletas_dsc", function(){
 
    let monto = Number($('#total_monto_boleta').val());
    let prc1 = Number(monto *0.01).toFixed(2);
    let prc3 = Number(monto *0.03).toFixed(2);
    let prc6 = Number(monto *0.06).toFixed(2);

    let total_empleador = Number(prc6 * 3).toFixed(2);
    let total_trabajador = (Number(prc3) * 2  + Number(prc1)).toFixed(2);

    $('#mdltitulodsc').html('Descuento de Boleta');
    $('#modalboletasdsc_rpt_bono').modal('show');
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

$(document).on("click","#btnboletas", function(){

    //Obtener las fechas al lado del DNI
    let fecha_ini = $('#fech_inicio_emp').val();
    let fecha_fin = $('#fech_final_emp').val();
    //Asignar las fechas
    $('#fecha_inicio_bol').html(convertDateFormatSimple(fecha_ini));
    $('#fecha_final_bol').html(convertDateFormatSimple(fecha_fin));

    $('#mdltitulo').html('Tabla de Boletas');
    $('#modalboletas_rpt_bono').modal('show');
    $('#select_mes_boletas_rpt_bono').select2("val", "0");
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

    $("#modalboletas_rpt_bono").modal('hide');
});

$(document).on("click","#btnclosemodaldsc", function(){

    $("#modalboletasdsc_rpt_bono").modal('hide');
});

$(document).on("click","#btnprevcer", function(){

    OcultarPrev();
    let tipoprev = $('#select_certificado').val();

    $("#prev_certificado_"+tipoprev).show();
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

        var options = { year: 'numeric', month: 'long', day: 'numeric' };

        let nom;
        let cargo;
        let fechai;
        let fechaf;
        let dpto1;
        let logos;
        let firm;
        let tiempo_anio;
        
        //datos para orcinea
        if(e > 0 && e < 5){
            //DATOS  nombre completo, Finicio, Ffinal, Cargo, firmante

            nom = $('#empresa_orcinea_'+e).val();
            fechai = $('#fech_inicio_emp'+ e).val();
            fechaf = $('#fech_final_emp'+ e).val();
            cargo = $('#cargo_orcinea_'+e).val();
            //let tipo_orc = $('#cbx_tipo_orc_'+a).val();
            firm = $('#firmante_orcinea_'+e).val();
            logos = $('#logo_orcinea_'+e).val();
            $('#logo_nombre'+e).val(logos);
            dpto1 = "LIMA";
            tiempo_anio = $('#tiempo_imp'+ e).val();
        }
    
        //Datos para empresa
        if(e > 4 && e < 15){
            //DATOS  nombre completo, Finicio, Ffinal, Cargo, firmante
            nom = $('#nombre_emp'+ e).val();
            cargo = $('#cargo_emp'+ e).val();
            fechai = $('#fech_inicio_emp'+ e).val();
            fechaf = $('#fech_final_emp'+ e).val();
            dpto1 = $('#dpto_emp'+ e).val();
            logos = $('#logo_nombre'+ e).val();
            firm = $('#firmante_emp'+ e).val();
            tiempo_anio = $('#tiempo_imp'+ e).val();
        }
        
        let fecha1 = new Date(fechai);
        let fecha2 = new Date(fechaf);
        let fecha1num = moment(fecha1).format('DD-MM-YYYY');
        let fecha2num = moment(fecha2).format('DD-MM-YYYY');
        console.log(fecha1);
        console.log(fecha2);

        //console.log("Nombre de Empresa:" + nom);
        //console.log("Fecha1: " + fecha1);
        //console.log("Fecha2 : "+ fecha2);
        
        //Asignar datos
        $('.emp_imp').html(nom);
        $('.cargo_imp').html(cargo);

        $('.desde_imp').html(fecha1.toLocaleDateString("es-ES", options).toUpperCase());
        $('.hasta_imp').html(fecha2.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_num').html(fecha1num);
        $('.hasta_imp_num').html(fecha2num);
        $('.lugardia').html(dpto1+", "+fecha_emi.toLocaleDateString("es-ES", options).toUpperCase());
        $('.desde_imp_low').html(fecha1.toLocaleDateString("es-ES", options));
        $('.hasta_imp_low').html(fecha2.toLocaleDateString("es-ES", options));
        $('.lugardia_low').html(dpto1+", "+fecha_emi.toLocaleDateString("es-ES", options));
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
        let tiempo_anio = $('#tiempo_imp'+ e).val();
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
        console.log("Años" + tiempo_anio);

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
        $('.tiempo_imp').html(tiempo_anio);
        

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


function CuadroBoletas(e){

    //Obtener las fechas al lado del DNI
    let fecha_ini = $('#fech_inicio_emp'+ e).val();
    let fecha_fin = $('#fech_final_emp'+ e).val();

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
    //let estado_anio = $('select[name="select_anio_boletas'+ e +'"] option:selected').text();
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

function DescargarZip(){
    console.log("Descargar ZIP");

    var num_doc             = $('#num_doc').val();
    var nom_carpeta         = "REPORTE-BONO-"+ num_doc;
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


    if(fecha_emi >= fecha_ff && fecha != "" ){
        
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

function SeleccionarFirmante(){
    let firmante = $("input[name='firmante']:checked").val();
    let num = $('#num_empresa').val();

    $('#firmante'+ num).val(firmante);

    $('#modalfirmante').modal('hide');
}

function CerrarFirmante() {
    $('#modalfirmante').modal('hide');
}

init();