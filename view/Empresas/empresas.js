var tabla ;
var datos_empresa;

function init(){
    $("#empresa_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 
    
    tabla=$('#empresa_data').dataTable({
        responsive : true,
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Descargar en Excel',
                customize: function( xlsx ) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('c[r=V1] t', sheet).text( '' );
                    $('c[r=W1] t', sheet).text( '' );
                    $('c[r=X1] t', sheet).text( '' );
                }

            }
        ],
        "ajax":{
            url: '../../controller/empresacontrolador.php?op=listar',
            type : "get",
            dataType : "json",
            error: function(e){
                	
            }
        },
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 5 registros hace una paginación
	    "order": [[ 0, "asc" ]],//Ordenar (columna,orden)
	    "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
		}
	}).DataTable();
   

    var columna = [1, 5, 7, 8, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];
    for ( var i=0 ; i<columna.length ; i++ ) {
        tabla.column( columna[i] ).visible(false);
    }
    tabla.columns.adjust().draw( false );

    $('#emp_tipo').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalmantenimientoempresas"),
        minimumResultsForSearch: Infinity  
    });

    $('#emp_estado').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalmantenimientoempresas"),
        minimumResultsForSearch: Infinity  
    });

    $('#emp_condicion').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalmantenimientoempresas"),
        minimumResultsForSearch: Infinity  
    });

    $('.div_empresa').hide();
    $('.div_empresa_sunat').hide();
    $('#loader').hide();
});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#empresa_form")[0]);
    $.ajax({
        url: "../../controller/empresacontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            console.log(datos);
            $('#empresa_form')[0].reset();
            $("#modalmantenimientoempresas").modal('hide');
            $('#empresa_data').DataTable().ajax.reload();
            $("#btnagregar").show();
            activarcampos();
            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

function editar(emp_id){
    console.log(emp_id);
    
    $('#mdltitulo').html('Editar Registro');
    

    $.post("../../controller/empresacontrolador.php?op=mostrar",{emp_id: emp_id},function(data){

        data = JSON.parse(data);
        $('#emp_id').val(data.id);
        $('#emp_tipo').val(data.tipo_emp).trigger('change');
        $('#emp_razonsocial').val(data.empleador);
        $('#emp_ruc').val(data.ruc);
        $('#emp_direccion').val(data.direccion);
        $('#emp_dpto').val(data.dpto);
        $('#emp_prov').val(data.prov);
        $('#emp_dist').val(data.dist);
        $('#emp_ini_act').val(data.f_inic_act);
        $('#emp_fin_act').val(data.f_baja_act);
        $('#emp_dni').val(data.dni_a);
        $('#emp_rep_legal').val(data.rep_legal);
        $('#emp_fech_rep_legal').val(data.f_inicio_a);
        $('#emp_seg_rep').val(data.otro_representante);
        $('#emp_dni_seg_rep').val(data.dni_b);
        $('#emp_fech_seg_rep_legal').val(data.f_inicio_b);
        $('#emp_estado').val(data.estado_emp).trigger('change');
        $('#emp_condicion').val(data.habido_emp).trigger('change');
        $("#btnagregar").show();
        activarcampos();
        
    });

    $('#modalmantenimientoempresas').modal('show');
}

function vista(emp_id){
    console.log(emp_id);
    
    $('#mdltitulo').html('Ver Registro');

    $.post("../../controller/empresacontrolador.php?op=mostrar",{emp_id: emp_id},function(data){

        data = JSON.parse(data);
        $('#emp_id').val(data.id);
        $('#emp_tipo').val(data.tipo_emp).trigger('change');
        $('#emp_razonsocial').val(data.empleador);
        $('#emp_ruc').val(data.ruc);
        $('#emp_direccion').val(data.direccion);
        $('#emp_dpto').val(data.dpto);
        $('#emp_prov').val(data.prov);
        $('#emp_dist').val(data.dist);
        $('#emp_dni').val(data.dni_a);
        $('#emp_rep_legal').val(data.rep_legal);
        $('#emp_ini_act').val(data.f_inic_act);
        $('#emp_fin_act').val(data.f_baja_act);
        $('#emp_seg_rep').val(data.otro_representante);
        $('#emp_dni_seg_rep').val(data.dni_b);
        $('#emp_fech_rep_legal').val(data.f_inicio_a);
        $('#emp_fech_seg_rep_legal').val(data.f_inicio_b);
        $('#emp_estado').val(data.estado_emp).trigger('change');
        $('#emp_condicion').val(data.habido_emp).trigger('change');
        $("#btnagregar").hide();
        ocultarcampos();
    });

    $('#modalmantenimientoempresas').modal('show');
}

function eliminar(emp_id){
    console.log(emp_id);
    swal.fire({
        title: 'Desea Eliminar el Registro?',
        text: "",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/empresacontrolador.php?op=eliminar",{emp_id:emp_id},function (data) {
                console.log(data);
                $('#empresa_data').DataTable().ajax.reload();	
            });

            $('#empresa_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
    $('#emp_razonsocial').attr("readonly","readonly");
    $('#emp_ruc').attr("readonly","readonly");
    $('#emp_tipo').attr("disabled","disabled");
    $('#emp_direccion').attr("readonly","readonly");
    $('#emp_dpto').attr("readonly","readonly");
    $('#emp_prov').attr("readonly","readonly");
    $('#emp_dist').attr("readonly","readonly");
    $('#emp_dni').attr("readonly","readonly");
    $('#emp_rep_legal').attr("readonly","readonly");
    $('#emp_ini_act').attr("readonly","readonly");
    $('#emp_fin_act').attr("readonly","readonly");
    $('#emp_seg_rep').attr("readonly","readonly");
    $('#emp_dni_seg_rep').attr("readonly","readonly");
    $('#emp_fech_rep_legal').attr("readonly","readonly");
    $('#emp_fech_seg_rep_legal').attr("readonly","readonly");

    $('#emp_estado').attr("disabled","disabled");
    $('#emp_condicion').attr("disabled","disabled");
}

function activarcampos(){
    $('#emp_razonsocial').attr("readonly",false);
    $('#emp_ruc').attr("readonly",false);
    $('#emp_tipo').attr("disabled",false);
    $('#emp_direccion').attr("readonly",false);
    $('#emp_dpto').attr("readonly",false);
    $('#emp_prov').attr("readonly",false);
    $('#emp_dist').attr("readonly",false);
    $('#emp_dni').attr("readonly",false);
    $('#emp_rep_legal').attr("readonly",false);
    $('#emp_ini_act').attr("readonly",false);
    $('#emp_fin_act').attr("readonly",false);
    $('#emp_seg_rep').attr("readonly",false);
    $('#emp_dni_seg_rep').attr("readonly",false);
    $('#emp_fech_rep_legal').attr("readonly",false);
    $('#emp_fech_seg_rep_legal').attr("readonly",false);

    $('#emp_estado').attr("disabled",false);
    $('#emp_condicion').attr("disabled",false);
}

function CargaMasiva(){

    $('#mdltitulo_carga').html('Subir Carga Masiva');
    $('#modalcargamasiva').modal('show');
   
}
function CargarCSV(){
    var formData = new FormData($('#carga_form')[0]);

    // Realiza la petición Ajax
    $.ajax({
        url: '../../controller/procesar_csv.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            // Muestra el resultado en el contenedor
            console.log(response);
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Datos insertados correctamente',
            });

            $("#modalcargamasiva").modal('hide');
            $('#empresa_data').DataTable().ajax.reload();
        },
        error: function(xhr, status, error) {
            // Muestra un mensaje de error en el contenedor
            //$('#resultado').html("Error al procesar el archivo CSV. Por favor, intenta nuevamente.");
            console.error(xhr.responseText);
        }
    });
}

function BuscarRuc(){
    $('#loader').show();
    let ruc_emp = $('#int_ruc').val();

    if(ruc_emp != ""){
        //Ajax para mostrar Datos de Firmantes de la BD Actual
        $.ajax({
            url: "../../controller/empresacontrolador.php?op=mostrar_empresa_ruc",
            type: "POST",
            data: { ruc : ruc_emp },
            dataType : 'JSON',
            success: function(datos){
                //console.log(datos);
                //$('#div_firmantes').html(datos);
                $('#lb_razon').html(datos.empleador);
                $('#lb_ruc').html(datos.ruc);
                $('#lb_depa').html(datos.dpto);
                $('#lb_prov').html(datos.prov);
                $('#lb_dist').html(datos.dist);
                $('#lb_direccion').html(datos.direccion);
                $('#lb_estado').html(datos.estado_emp);
                $('#lb_condicion').html(datos.habido_emp);
                $('#lb_fecha_ini').html(moment(datos.f_inic_act).format("DD-MM-YYYY"));
                $('#lb_fecha_fin').html(moment(datos.f_baja_act).format("DD-MM-YYYY"));
                $('#lb_fecha_fin_st').html(moment(datos.f_baja_act).format("DD-MM-YYYY"));//Fecha Fin Sunat
                $('.div_empresa').show();
            },
            error : function(error){
                console.log(error);
            }
        });

        //Ajax para mostrar datos del WebService SUNAT.
        $.ajax({
            url: "../../controller/pensioncontrolador.php?op=consulta_api_sunat",
            type: "POST",
            data: { ruc : ruc_emp },
            async : false,
            success: function(datos){
                //console.log(datos);
                if (datos != ""){
                    response = JSON.parse(datos);
                    if(response.success == true){
                        //Mostrar Datos de Empresa
                        let dat_emp = response.result;
                        $('#lb_razon_st').html(dat_emp.razon_social);
                        $('#lb_ruc_st').html(dat_emp.ruc)
                        $('#lb_direccion_st').html(dat_emp.direccion);
                        $('#lb_depa_st').html(dat_emp.departamento);
                        $('#lb_prov_st').html(dat_emp.provincia);
                        $('#lb_dist_st').html(dat_emp.distrito);
                        $('#lb_estado_st').html(dat_emp.estado);
                        $('#lb_condicion_st').html(dat_emp.condicion);
                        $('#lb_fecha_ini_st').html(dat_emp.inicio_actividades);

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
                            fecha_fin : $('#lb_fecha_fin').html()
                        };

                        $('.div_empresa_sunat').show();
                        $('#loader').hide();
                    }else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Sin resultados',
                            text: ''
                        });
                    }
                }
               
            },
            error : function(error){
                console.log(error);
            }
        });
    }else {
        swal.fire(
            'Ingrese un numero de ruc válido',
            '',
            'warning'
        );
    }

    
}


function ActualizarEmpresa(){

    // Convertir el JSON a una cadena de texto
    var datosJSONEmp = JSON.stringify(datos_empresa);
    let ruc_emp = $('#int_ruc').val();


    // Realizar la solicitud AJAX
    $.ajax({
        type: 'POST',
        url: '../../controller/empresacontrolador.php?op=update_empresa',
        data: {ruc :  ruc_emp, datos_emp : datosJSONEmp},
        //dataType: 'json',
        success: function(response) {
            console.log('Éxito:', response);
            Swal.fire({
                icon: 'success',
                title: 'Datos Actualizados',
                text: ''
            });

            $("#modalconsulta").modal('hide');
            $('#empresa_data').DataTable().ajax.reload();
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });

    
}


$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro de Empresa');
    $('#empresa_form')[0].reset();
    $('#emp_id').val('');
    $('#modalmantenimientoempresas').modal('show');
    $("#btnagregar").show();
    activarcampos();

});

$(document).on("click","#btnclosemodal", function(){
    $("#modalmantenimientoempresas").modal('hide');
});

$(document).on("click","#btnclosemodal_carga", function(){
    $("#modalcargamasiva").modal('hide');
});

$(document).on("click","#btnconsulta", function(){
    $('#int_ruc').val("");
    $('#modalconsulta').modal('show');
    $('.div_empresa').hide();
    $('.div_empresa_sunat').hide();
});

$(document).on("click","#btnclosemodalconsulta", function(){

    $("#modalconsulta").modal('hide');
});



init();