var tabla ;

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



init();