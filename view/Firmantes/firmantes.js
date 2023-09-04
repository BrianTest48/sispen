var tabla ;




function init(){
    $("#firma_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 

    $('#id_cargo').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalfirma")
    });

    $('#firma_estado').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalfirma"),
        minimumResultsForSearch: Infinity  
    });
    
    //COMBOBOX
    $.post("../../controller/cargocontrolador.php?op=combo", function(data){
        $("#id_cargo").html(data);
        //console.log(data);
    });

    tabla=$('#firma_data').dataTable({
        responsive: true,
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Descargar en Excel',
                customize: function( xlsx ) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('c[r=F1] t', sheet).text( '' );
                    $('c[r=G1] t', sheet).text( '' );
                    $('c[r=H1] t', sheet).text( '' );
                }

            }
        ],
        "ajax":{
            url: '../../controller/firmacontrolador.php?op=listar',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e);
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


});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#firma_form")[0]);

    $.ajax({
        url: "../../controller/firmacontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            //console.log(datos);
            $('#firma_form')[0].reset();
            $("#modalfirma").modal('hide');
            $('#firma_data').DataTable().ajax.reload();
            $("#btnagregar").show();
            activarcampos();
            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            );
            

        }
    });
}

function editar(firma_id){

    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/firmacontrolador.php?op=mostrar",{firma_id: firma_id},function(data){
       
        data = JSON.parse(data);
        console.log(data.firma_id);
        $('#firma_id').val(data.firma_id);
        $('#firma_ruc').val(data.firma_ruc);
        $('#firma_nom').val(data.firma_nom);
        $('#firma_dni').val(data.firma_dni);
        $('#id_cargo').val(data.id_cargo).trigger('change');
        $('#firma_f_inicio').val(data.fech_inicio);
        $('#firma_f_fin').val(data.fech_fin);
        $('#firma_estado').val(data.estado).trigger('change');
        $('#firma_f_falle').val(data.fecha_falle);
        $("#btnagregar").show();
        activarcampos();

    });

    $('#modalfirma').modal('show');
}

function vista(firma_id){

    $('#mdltitulo').html('Ver Registro');

    $.post("../../controller/firmacontrolador.php?op=mostrar",{firma_id: firma_id},function(data){
        //console.log(data);
        data = JSON.parse(data);
        $('#firma_id').val(data.firma_id);
        $('#firma_ruc').val(data.firma_ruc);
        $('#firma_nom').val(data.firma_nom);
        $('#firma_dni').val(data.firma_dni);
        $('#id_cargo').val(data.id_cargo).trigger('change');
        $('#firma_f_inicio').val(data.fech_inicio);
        $('#firma_f_fin').val(data.fech_fin);
        $('#firma_estado').val(data.estado).trigger('change');
        $('#firma_f_falle').val(data.fecha_falle);
        $("#btnagregar").hide();
        ocultarcampos();

    });

    $('#modalfirma').modal('show');
}

function eliminar(firma_id){
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

            $.post("../../controller/firmacontrolador.php?op=eliminar",{firma_id:firma_id},function (data) {

                $('#firma_data').DataTable().ajax.reload();	
            });

            $('#firma_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
    
    $('#firma_nom').attr("readonly","readonly");
    $('#firma_ruc').attr("readonly","readonly");
    $('#firma_dni').attr("readonly","readonly");
    $('#id_cargo').attr("disabled","disabled");
    $('#firma_f_inicio').attr("readonly","readonly");
    $('#firma_f_fin').attr("readonly","readonly");
    $('#firma_estado').attr("disabled","disabled");
    $('#firma_f_falle').attr("readonly","readonly");

}

function activarcampos(){
    $('#firma_nom').attr("readonly",false);
    $('#firma_ruc').attr("readonly",false);
    $('#firma_dni').attr("readonly",false);
    $('#id_cargo').attr("disabled",false);
    $('#firma_f_inicio').attr("readonly",false);
    $('#firma_f_fin').attr("readonly",false);
    $('#firma_estado').attr("disabled",false);
    $('#firma_f_falle').attr("readonly",false);
}

$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro');
    $('#firma_form')[0].reset();
    $('#firma_id').val('');
    $('#id_cargo').select2("val", "0");
    $('#firma_estado').select2("val", "0");
    $('#modalfirma').modal('show');
    $("#btnagregar").show();
    
    activarcampos();

});

$(document).on("click","#btnclosemodal", function(){

    $("#modalfirma").modal('hide');
});


init();