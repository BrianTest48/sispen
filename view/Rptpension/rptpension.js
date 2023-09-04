var anios_reflex = 0;
var meses_reflex = 0;
var dias_reflex = 0;

var anios_host = 0;
var meses_host = 0;
var dias_host = 0;

var anios_orcinea = 0;
var meses_orcinea = 0;
var dias_orcinea = 0;

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
    // Ocultar Campos al iniciar
    OcultarPrev();
    $('#txtnombre').attr('disabled', true);
    $('#txtapellido').attr('disabled', true);
    $('#txtdate').attr('disabled', true);
    $("#divresultado").hide();
    $("#divresultado_emp").hide();
    $("#prev1").hide();
    $("#prev2").hide();
    $("#prev3").hide();
    $("#contemp1").hide();
    //$("#div_logo_orcinea").hide();
    //$("#div_logo_host").hide();
    $('#btnguardarlistareporte').hide();

    //Agregar Select2 A comboBox

    $('#select_mes_boleta_1').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });
    
    $('#select_mes_boleta_certificado').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });

    $('#combo_prev_boleta').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });

    $('#select_certificado').select2({
        placeholder: "Seleccione",
        minimumResultsForSearch: Infinity
    });

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


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function init(){
    $("#rpt_pension_form").on("submit",function(e){
        generar(e);	
    });
}


function activarcargos(){

    let n = parseInt($('#txtcant_emp').val());
    let a = parseInt($('#txtcant_orcinea').val());
    let h = parseInt($('#txtcant_host').val());
    //console.log(n);
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

}



$(document).on("click","#btncargarreflex", function(){

    var mes = $("#cant_meses").val();

    anios_reflex= Math.trunc(mes / 12) ;
    meses_reflex  = mes % 12;

    mensaje = anios_reflex+ ' Años'+' '+ meses_reflex+' meses'+ ' '+dias_reflex+ ' días'; 
    $("#cant_reflex").val(mensaje);
    sumartiempo();
});


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

    anios_orcinea = 0;
    meses_orcinea = 0;
    dias_orcinea = 0;

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

function sumartiempo(){

    //console.log("SUMAR TIEMPO");
    /*var total_anios = anios_reflex + anios_host + anios_orcinea ;
    var total_meses = meses_host + meses_orcinea + meses_reflex;
    var total_dias = dias_host+ dias_orcinea +dias_reflex;*/
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

    //console.log(anios_orc_final+' Años'+' '+meses_orc_final+' meses'+' '+dias_orc_final+' dias');
    //console.log(dias_host_final+' ' + meses_host_final + ' '+ anios_host_final);

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

    //console.log(dias_host_final+' ' + meses_host_final + ' '+ anios_host_final);

    //console.log(total_dias);
    mensaje = Number(total_anios)+ ' Años '+Number(total_meses)+' Meses '+ Number(total_dias)+' Dias';
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

    //ValidarEmpresa();
    let tipo = $("#tipo_doc").val();
    let doc = $("#num_doc").val();
    let docnum = $("#num_doc").val().length;
    let t_lista  = $("#tipo_lista").val();


    
    
    //$('#btnautogenerar').attr('disabled', false);

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

                $.post("../../controller/listareportecontrolador.php?op=mostrar",{num_doc: doc, lista : t_lista},function(datos){
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
            
            creardivsempresa();
            creardivsorcinea();
            creardivshost();
            activarcargos();
            mostrarDatosEmpresasDerecha();
            $('#btnguardarlistareporte').show();
            $("#divresultado_emp").show();
            $("#divresultado").show();
            $('#divresultado').removeClass().addClass('form-layout form-layout-4');  

            let fnac = $('#txtdate').val();
            let manana = moment(fnac).add(cant_anios, 'years').format('YYYY-MM-DD');
            $('#orcinea_inicio_1').val(manana);
            $('#orcinea_inicio_1').attr("min" ,manana); 
            $('#host_inicio_1').val(manana);
            $('#host_incio_1').attr("min" ,manana);
            
            $('#f_inicio_1').val(manana);
            $('#f_inicio_1').attr("min" ,manana); 

            
            $.post("../../controller/cargocontrolador.php?op=comborpt",{}, function(data){
                //console.log(data);
        
                for(i = 1 ; i<= cnt ; i++){
                    $("#cargoc"+i).html(data);
                    $("#div_logo_"+i).hide();
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
                //$("#logo_host").html(data);
            });

           
            
        
            //RECUPERAR LA CONFIGURACION DEL USUARIO
            $.post("../../controller/listareportecontrolador.php?op=mostrar",{num_doc: doc, lista : t_lista},function(datos){
                if(datos != ""){
                    //console.log(datos);
                    datos = JSON.parse(datos);
                    let cant = datos.cantidad;
                    let cant_orc = datos.cantidad_orcinea;
                    let cant_ht = datos.cantidad_host;

                    // FOR PARA CARGAR DATOS DE ORCINEA
                    for (let i = 1 ; i <= cant_orc ; i++){
                        $('#empresa_orcinea_'+i).val(datos["ruc_orcinea_"+i]);
                        $('#orcinea_inicio_'+i).val(datos["fech_orcinea_"+i]);
                        $('#orcinea_fin_'+i).val(datos["fech_final_orcinea_"+i]);
                        $('#cargo_orcinea_'+i).val(datos["cargo_orcinea_"+i]).trigger('change');
                        $('#firmante_orcinea_'+i).val(datos["firmante_orcinea_"+i]);
                        $('#logo_orcinea_'+i).val(datos["logo_orcinea_"+i]).trigger('change');
                        CargarOrcinea(i);
                    }
                    //DATOS DE ORCINEA
                    /*if(datos.ruc_orcinea != ""){ 
                        $('#empresa_orcinea').val(datos["ruc_orcinea"]);
                        $('#orcinea_inicio').val(datos["fech_orcinea"]);
                        $('#orcinea_fin').val(datos["fech_final_orcinea"]);
                        $('#cargo_orcinea').val(datos["cargo_orcinea"]).trigger('change');
                        $('#firmante_orcinea').val(datos["firmante_orcinea"]).trigger('change');
                        $('#logo_orcinea').val(datos["logo_orcinea"]).trigger('change');
                        $('#btncargarorcinea').click();
                    }*/

                    //FOR PARA CARGAR DATOS DE HOST 1-4
                    for(let i = 1; i<= cant_ht ; i++){
                        $('#empresa_host_'+i).val(datos["ruc_host_"+i]);
                        $('#host_inicio_'+i).val(datos["fech_host_"+i]);
                        $('#host_fin_'+i).val(datos["fech_final_host_"+i]);
                        $('#cargo_host_'+i).val(datos["cargo_host_"+i]).trigger('change');
                        $('#firmante_host_'+i).val(datos["firmante_host_"+i]);
                        $('#logo_host_'+i).val(datos["logo_host_"+i]).trigger('change');
                        CargarHost(i);
                    }
                    //DATOS HOST
                    /*if(datos.ruc_host != ""){
                        $('#empresa_host').val(datos.ruc_host);
                        $('#host_inicio').val(datos.fech_host);
                        $('#host_fin').val(datos.fech_final_host);
                        $('#cargo_host').val(datos.cargo_host).trigger('change');
                        $('#firmante_host').val(datos.firmante_host).trigger('change');
                        $('#logo_host').val(datos.logo_host).trigger('change');
                        $('#btncargarhost').click();
                    }*/
                    
                    //DATO REFLEX
                    if(datos.meses_reflex != ""){
                        $('#cant_meses').val(datos.meses_reflex);
                        $('#btncargarreflex').click();
                    }
                    

                    // FOR PARA DATOS DE LAS 5 EMPRESAS
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
                    }
                    
                    /*mostrardetalle(1, datos["ruc1"], 1);
                    $("#logo1").val(datos["logo1"]).trigger('change');
                    $(".firmante_nom").html(datos["firmante1"]);*/
                    $('#prev1').hide();
                   
                }else {

                }    
            });

            
                   
            
        }
    }); 

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
                                            '<div class="col-lg-12">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Empresa: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control" type="text" name="empresa_orcinea_'+i+'" id="empresa_orcinea_'+i+'" placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
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
                                            '<div class="col-lg-5">'+
                                                '<select required id="logo_orcinea_'+i+'"  class="form-control select2 logo_orcinea" data-placeholder="Seleccione" style="width: 100% , height : 50px" onchange="LogoOrcinea('+i+')">'+
                                                '</select>'+                        
                                            '</div>'+
                                            '<div class="col mg-r-15 bd" id="div_logo_orcinea_'+i+'">'+
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
                                            '<div class="col-lg-12">'+
                                                '<div class="form-group">'+
                                                    '<label class="form-control-label">Empresa: <span class="tx-danger">*</span></label>'+
                                                    '<input class="form-control" type="text"  id="empresa_host_'+i+'" placeholder="" required>'+
                                                '</div>'+
                                            '</div>'+
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
                                            '<div class="col-lg-5">'+
                                                '<select required id="logo_host_'+i+'"  class="form-control select2" data-placeholder="Seleccione" style="width: 100% , height : 50px"  onchange="LogoHost('+i+')">'+
                                                '</select>'+                        
                                            '</div>'+
                                            '<div class="col mg-r-15 bd" id="div_logo_host_'+i+'">'+
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
                                "<div class='row' id='fechas' >"+
                                    "<div class='col-12 col-sm-5'>"+
                                        "<div class='form-group' >"+
                                            "<label class='form-control-label'>Desde</label>"+
                                            "<input class='form-control fecha_inicio' type='date' max='2999-12-31' id='f_inicio_"+i+"'>"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-5'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label'>Hasta</label>"+
                                            "<input class='form-control'  type='date' max='2999-12-31' id='f_final_"+i+"' >"+
                                        "</div>"+
                                    "</div>"+
                                    "<div class ='col-12 col-sm-2'>"+
                                        "<div class='form-group'  >"+
                                            "<label class='form-control-label' style='color:white;'>.</label>"+
                                            "<button class='btn btn-info' id='buscarEmp_"+i+"'onclick='BuscarEmp("+i+")'>Buscar</button>"+
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
                                    "<div class='col-12 col-sm-4'>"+
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
                                "<div class=' text-center fw-lighter fst-italic pb-2 border-bottom border-info ' style='font-size: 13px;' >Último sueldo: <label id='fech_sueldo_"+i+"' ></label></div>"+
                                "<div class='row mb-3 mt-2 '>"+
                                    "<label for='cargoc"+i+"' class='col-sm-3 col-form-label'>Cargo:</label>"+
                                    "<div class='col-sm-9'>"+
                                        "<select required id='cargoc"+i+"' name='cargoc"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%' >"+
                                        "</select>"+
                                    "</div>"+
                               "</div><!-- row -->"+
                               "<div class='row mb-3 mt-2 '>"+
                                    "<label for='firmante"+i+"' class='col-sm-3 col-form-label'>Firmante:</label>"+
                                    "<div class='col-sm-9'>"+
                                        "<select required id='firmante"+i+"' name='firmante"+i+"' class='form-control select2' data-placeholder='Seleccione' style='width: 100%' >"+
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
    OcultarPrev();
    suma_anios = 0;
    suma_meses = 0;
    suma_dias = 0;
    $('#form_liqui')[0].reset();
    $('#form_bol')[0].reset();
    var fnac = $('#txtdate').val();
    var fech1 = $('#f_inicio_'+a).val();
    var fech_final_1 =$('#f_final_'+a).val();
    var cargo = $('#cargoc'+a).val();
    let logos = $('#logo'+a).val();
    let rucrs= $('#ruc_emp_'+a).val();
    var nom;
    var razsocialruc;
    var depas;
    let valor_busqueda;
    var cantidad = $('#txtcant_emp').val();
    let manana = moment(fnac).add(16, 'years').format('YYYY-MM-DD');

    /*switch (a) {
        case 1:
            if(fecha_inicial_1 == fech1 && fecha_fin_1 == fech_final_1) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_1 = fech1;
                fecha_fin_1 = fech_final_1;
                valor_busqueda = 0;
            }
            break;
        case 2:
            if(fecha_inicial_2 == fech1 && fecha_fin_2 == fech_final_1) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_2 = fech1;
                fecha_fin_2 = fech_final_1;
                valor_busqueda = 0;
            }
            break;
        case 3:
            if(fecha_inicial_3 == fech1 && fecha_fin_3 == fech_final_1) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_3 = fech1;
                fecha_fin_3 = fech_final_1;
                valor_busqueda = 0;
            }
            break;
        case 4:
            if(fecha_inicial_4 == fech1 && fecha_fin_4 == fech_final_1) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_4 = fech1;
                fecha_fin_4 = fech_final_1;
                valor_busqueda = 0;
            }
            break;
        case 5:
            if(fecha_inicial_5 == fech1 && fecha_fin_5 == fech_final_1) {
                valor_busqueda = 1;
            }else {
                fecha_inicial_5 = fech1;
                fecha_fin_5 = fech_final_1;
                valor_busqueda = 0;
            }
            break;
    
     
    }*/

    /*if(fecha_inicial == fech1 && fecha_fin == fech_final_1) {
        valor_busqueda = 1;
    }else {
        fecha_inicial = fech1;
        fecha_fin = fech_final_1;
        valor_busqueda = 0;
    }*/

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

                
                $.post("../../controller/pensioncontrolador.php?op=buscardpto",{txtdateinicio: fech1 , txtdatefin: fech_final_1, txtrazon : razsocialruc},function(data){
                    if(data == ""){
                        Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'No existe informacion',
                            showConfirmButton: false,
                            timer:1500
                        });
                    }else {
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
                        $('#fech_inicio_emp').val(fech1);
                        $('#fech_final_emp').val(fech_final_1);
                        $('#cargo_emp').val(cargo);
                        $('#dpto_emp_'+a).val(data[0]['dpto']);
                        $('#rango_emp_'+a).val(data[0]['f_inic_act'] +" / "+ data[0]["f_baja_act"]);  
        
        
        
                        nom = $('#nom_emp_lab').val();
                        var dpto1= $('#dpto_emp_'+a).val();
                        nombres= $('#txtnombre').val();
                        apelli= $('#txtapellido').val();
                        tmp = parseInt($('#anios_emp_'+a).val(),"10");
                        tot = tmp * 132;
                        firm = $('#firmante'+a).val();
                
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

                        $('.img_logo').attr("src","../../assets/img/"+logos);
                        $('.firmante_nom').html(firm);
                        $('.departamento_imp').html(dpto1.toUpperCase());
                        $('.cargo_imp_low').html(cargo.toLowerCase());
                        $('.desde_imp_num').html(convertDateFormat(fech1));
                        $('.hasta_imp_num').html(convertDateFormat(fech_final_1));
                        $('.lugardia_num').html(dpto1 +", "+convertDateFormat(fech_final_1));
                        //sumarfechas();


                        /* LIQUIDACION */
                        $('#dias_liqui').val(data[0]['Dias']);
                        $('#meses_liqui').val(data[0]['Meses']);
                        $('#anios_liqui').val(data[0]['Anios']);

                        SumarAniosEmpresas(a);
                        MostrarCertificados(data[0]['tipo_emp']);
                        MostrarLiquidacion(fech_final_1, data[0]['tipo_emp']);

                        /*OBETNER COMBO FIRMANTE */
                        /*$.post("../../controller/firmacontrolador.php?op=combo",{numero : data[0]['ruc']}, function(data){
                            //console.log(data);
                            $("#firmante"+a).html(data);  
                        });*/
                    }                      
                });
                
                //$("#lst_emp_"+a).val(razsocialruc).trigger('change');
                $("#contemp1").show();
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

}

function MostrarCertificados(valor){
    console.log("SE UITLIZO");
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
    
    anios_orcinea = 0;
    meses_orcinea = 0;
    dias_orcinea = 0;

    let fech1 = $('#orcinea_inicio_'+a).val();
    let fech1f = $('#orcinea_fin_'+a).val();
    let fechna =$('#txtdate').val();
    let mananaf = moment(fechna).add(16, 'years').format('YYYY-MM-DD');

    if(fech1 != "" || fech1f != ""){
        let fechai = new  Date(fech1);
        let fechafi = new  Date(fech1f);
        let fechan= new Date(mananaf);
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
    //console.log(a);

    anios_host = 0;
    meses_host = 0;
    dias_host = 0;
    let fech1 = $('#host_inicio_'+a).val();
    let fech1f = $('#host_fin_'+a).val();
    let fechnc =$('#txtdate').val();
    let mananaf = moment(fechnc).add(16, 'years').format('YYYY-MM-DD');

    if(fech1 != "" || fech1f != ""){
        let fechai = new  Date(fech1);
        let fechafi = new  Date(fech1f);
        let fechanc= new Date(mananaf);

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
	$filas+='<div class="row mg-t-15">'
	$filas+='	<label class="col-sm-4 form-control-label">Reflex:</label>'
	$filas+='	<div class="col-sm-8 mg-t-10 mg-sm-t-0">'
	$filas+='		<input readonly type="text" class="form-control" id="cant_reflex"  name="cant_reflex" placeholder="">'
	$filas+='	</div>'
	$filas+='</div>'
	
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
    $("#lst_emp_"+valor).html("");
    $('#lst_emp_'+valor).select2("val", "0");
    $('#f_inicio_'+valor).val("");
    $('#f_final_'+valor).val("");
    $('#dpto_emp_'+valor).val("");
    $('#tiempo_'+valor).html("");
    $('#tiempo_header_'+valor).html("");
    $('#rango_emp_'+valor).val("");
    $('#fech_sueldo_'+valor).html("");
    $('#cargoc'+valor).select2("val", "0");
    $('#nom_emp_'+valor).html("Empresa "+ valor);
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


function ListarFirmante(a){
    let estado = $('select[name="lst_emp_'+a+'"] option:selected').text();
    let ruc = $("#lst_emp_"+a).val();
    $('#nom_emp_'+a).html(estado);
 
    $.post("../../controller/firmacontrolador.php?op=combo",{numero : ruc}, function(data){
        //console.log(data);
        $("#firmante"+a).html(data);  
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
    let cantidad_orc = $("#txtcant_orcinea").val();
    let cantidad_ht = $("#txtcant_host").val();
    let fecha_nac = $("#txtdate").val()
    let fech_orc1 = $('#orcinea_inicio_1').val();
    let fech_final_orc1 = $('#orcinea_fin_1').val();
    let ruc_orc1 = $('#empresa_orcinea_1').val();
    let cargo_orc1 = $('#cargo_orcinea_1').val();
    let firmante_orc1 = $('#firmante_orcinea_1').val();
    let logo_orc1 = $('#logo_orcinea_1').val();
    let fech_orc2 = $('#orcinea_inicio_2').val();
    let fech_final_orc2 = $('#orcinea_fin_2').val();
    let ruc_orc2 = $('#empresa_orcinea_2').val();
    let cargo_orc2 = $('#cargo_orcinea_2').val();
    let firmante_orc2 = $('#firmante_orcinea_2').val();
    let logo_orc2 = $('#logo_orcinea_2').val();
    let fech_orc3 = $('#orcinea_inicio_3').val();
    let fech_final_orc3 = $('#orcinea_fin_3').val();
    let ruc_orc3 = $('#empresa_orcinea_3').val();
    let cargo_orc3 = $('#cargo_orcinea_3').val();
    let firmante_orc3 = $('#firmante_orcinea_3').val();
    let logo_orc3 = $('#logo_orcinea_3').val();
    let fech_orc4 = $('#orcinea_inicio_4').val();
    let fech_final_orc4 = $('#orcinea_fin_4').val();
    let ruc_orc4 = $('#empresa_orcinea_4').val();
    let cargo_orc4 = $('#cargo_orcinea_4').val();
    let firmante_orc4 = $('#firmante_orcinea_4').val();
    let logo_orc4 = $('#logo_orcinea_4').val();
    let fech_ht1 = $('#host_inicio_1').val();
    let fech_final_ht1 = $('#host_fin_1').val();
    let ruc_ht1 = $('#empresa_host_1').val();
    let cargo_ht1 = $('#cargo_host_1').val();
    let firmante_ht1 = $('#firmante_host_1').val();
    let logo_ht1 = $('#logo_host_1').val();
    let fech_ht2 = $('#host_inicio_2').val();
    let fech_final_ht2 = $('#host_fin_2').val();
    let ruc_ht2 = $('#empresa_host_2').val();
    let cargo_ht2 = $('#cargo_host_2').val();
    let firmante_ht2 = $('#firmante_host_2').val();
    let logo_ht2 = $('#logo_host_2').val();
    let fech_ht3 = $('#host_inicio_3').val();
    let fech_final_ht3 = $('#host_fin_3').val();
    let ruc_ht3 = $('#empresa_host_3').val();
    let cargo_ht3 = $('#cargo_host_3').val();
    let firmante_ht3 = $('#firmante_host_3').val();
    let logo_ht3 = $('#logo_host_3').val();
    let fech_ht4 = $('#host_inicio_4').val();
    let fech_final_ht4 = $('#host_fin_4').val();
    let ruc_ht4 = $('#empresa_host_4').val();
    let cargo_ht4 = $('#cargo_host_4').val();
    let firmante_ht4 = $('#firmante_host_4').val();
    let logo_ht4 = $('#logo_host_4').val();
    let mes_rfx = $('#cant_meses').val();
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
            ruc_orc_1 : ruc_orc1,
            cargo_orc_1 : cargo_orc1,
            firmante_orc_1 : firmante_orc1,
            logo_orc_1 : logo_orc1,
            f_inicio_orc_2 : fech_orc2,
            f_final_orc_2 : fech_final_orc2,
            ruc_orc_2 : ruc_orc2,
            cargo_orc_2 : cargo_orc2,
            firmante_orc_2 : firmante_orc2,
            logo_orc_2 : logo_orc2,
            f_inicio_orc_3 : fech_orc3,
            f_final_orc_3 : fech_final_orc3,
            ruc_orc_3 : ruc_orc3,
            cargo_orc_3 : cargo_orc3,
            firmante_orc_3 : firmante_orc3,
            logo_orc_3 : logo_orc3,
            f_inicio_orc_4 : fech_orc4,
            f_final_orc_4 : fech_final_orc4,
            ruc_orc_4 : ruc_orc4,
            cargo_orc_4 : cargo_orc4,
            firmante_orc_4 : firmante_orc4,
            logo_orc_4 : logo_orc4,
            f_inicio_ht_1 : fech_ht1,
            f_final_ht_1 : fech_final_ht1,
            ruc_ht_1 : ruc_ht1,
            cargo_ht_1 : cargo_ht1,
            firmante_ht_1 : firmante_ht1,
            logo_ht_1 : logo_ht1,
            f_inicio_ht_2 : fech_ht2,
            f_final_ht_2 : fech_final_ht2,
            ruc_ht_2 : ruc_ht2,
            cargo_ht_2 : cargo_ht2,
            firmante_ht_2 : firmante_ht2,
            logo_ht_2 : logo_ht2,
            f_inicio_ht_3 : fech_ht3,
            f_final_ht_3 : fech_final_ht3,
            ruc_ht_3 : ruc_ht3,
            cargo_ht_3 : cargo_ht3,
            firmante_ht_3 : firmante_ht3,
            logo_ht_3 : logo_ht3,
            f_inicio_ht_4 : fech_ht4,
            f_final_ht_4 : fech_final_ht4,
            ruc_ht_4 : ruc_ht4,
            cargo_ht_4 : cargo_ht4,
            firmante_ht_4 : firmante_ht4,
            logo_ht_4 : logo_ht4,
            meses_rfx : mes_rfx,
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

function Sumarmonto(mes) {
    let num =  0;
    for( i = 1 ; i <= 6 ; i++ ){
        num += Number($('#'+mes+'_'+i).val()); 
    }

    $('#'+mes+'_total').val(num);
    //console.log("El mes es: " + num);
}

function MostrarBoleta(){
    let mes = $('#select_mes_boleta_1').val();
    let sueldo = Number($('#'+mes+'_1').val());
    let rm = Number($('#'+mes+'_2').val());
    let reintegro = Number($('#'+mes+'_3').val());
    let hextras = Number($('#'+mes+'_4').val());
    let bonofi = Number($('#'+mes+'_5').val());
    let otros = Number($('#'+mes+'_6').val());
    let total = Number($('#'+mes+'_total').val());

    $('#sueldo_boleta').val(sueldo);
    $('#rm_vacacional_boleta').val(rm);
    $('#reintegro_boleta').val(reintegro);
    $('#horaex_boleta').val(hextras);
    $('#boni_boleta').val(bonofi);
    $('#otros_boleta').val(otros);
    $('#total_monto_boleta').val(total);
    SumarMeses();
    
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
    $('.prev_boleta').hide();
    $('.prev_liquidacion').hide();
    $('.prev_modelo_liqui').hide();
}

function imprimir_certificado(){

    let tipoprev = $('#select_certificado').val();
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

    let tipoprev = $('#combo_prev_boleta').val();
    var ficha = document.getElementById('contenido_boleta_'+tipoprev);

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

function convertDateFormat(string) {
    var info = string.split('-').reverse().join('.');
    return info;
}

$(document).on("click","#btnprevli", function(){
    OcultarPrev();
    $("#prev1").hide();
    $("#prev2").show();
    $("#prev3").hide();

    let dias_lq     = $('#dias_liqui').val();
    let meses_lq    = $('#meses_liqui').val();
    let anios_lq    = $('#anios_liqui').val();
    let monto_prueba= 1500;
    let motivo      = $('select[name="combo_prev_liqui"] option:selected').text();
    let fecha_final = $("#fech_final_emp").val();
    let fecha       = new Date(fecha_final);
    let anio        = fecha.getFullYear();
    //console.log(anio);

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
        $('.modelo_60_79').show();
    }
    if(anio >= 1980 && anio <= 1999){
        $('.modelo_80_99').show();
    }

    $('.anios_liqui').html(anios_lq + " Años");
    $('.meses_liqui').html(meses_lq + " Meses");
    $('.dias_liqui').html(dias_lq + " dias");
    $('.monto_prueba').html(monto_prueba);

    $.ajax({
        url: "../../controller/pensioncontrolador.php?op=letras_monto",
        type: "POST",
        data: {valor : monto_prueba},
        success: function(data){
            //console.log(data);
            $('.letras_monto').html(data);
        },
        error: function(error){
            console.log(error);
        }
    });
   

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

$(document).on("click","#orcinea-tab", function(){
    $("#prev1").show();
    $("#prev2").hide();
    $("#prev3").hide();
});

$(document).on("click","#btnboletas_dsc", function(){
    
    let monto = Number($('#total_monto_boleta').val());
    let prc1 = Number(monto *0.01).toFixed(2);
    let prc3 = Number(monto *0.03).toFixed(2);
    let prc6 = Number(monto *0.06).toFixed(2);

    let total_empleador = Number(prc6 * 3).toFixed(2);
    let total_trabajador = (Number(prc3) * 2  + Number(prc1)).toFixed(2);

    $('#mdltitulodsc').html('Descuento de Boleta');
    $('#modalboletasdsc_rpt').modal('show');
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
    $('#mdltitulo').html('Tabla de Boletas');
    $('#modalboletas_rpt').modal('show');
    $('#select_mes_boleta_1').select2("val", "0");
    SumarMeses();
});

$(document).on("click","#btnprevcer", function(){
    OcultarPrev();
    let tipoprev = $('#select_certificado').val();
    $("#prev_certificado_"+tipoprev).show();

});


$(document).on("click","#btnclosemodal", function(){

    $("#modalboletas_rpt").modal('hide');
});

$(document).on("click","#btnclosemodaldsc", function(){

    $("#modalboletasdsc_rpt").modal('hide');
});

init();