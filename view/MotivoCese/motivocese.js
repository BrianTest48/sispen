var tabla ;

function init(){
    $("#motivo_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 
    tabla=$('#motivo_data').dataTable({
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
            url: '../../controller/motivocontrolador.php?op=listar',
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
    var formData = new FormData($("#motivo_form")[0]);
    $.ajax({
        url: "../../controller/motivocontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            //console.log(datos);
            $('#motivo_form')[0].reset();
            $("#modalmotivo").modal('hide');
            $('#motivo_data').DataTable().ajax.reload();
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

function editar(motivo_id){

    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/motivocontrolador.php?op=mostrar",{motivo_id: motivo_id},function(data){
        
        data = JSON.parse(data);
        $('#motivo_id').val(data.motivo_id);
        $('#motivo_desc').val(data.motivo_desc);
        $("#btnagregar").show();
        activarcampos();

    });

    $('#modalmotivo').modal('show');
}

function vista(motivo_id){

    $('#mdltitulo').html('Ver Registro');

    $.post("../../controller/motivocontrolador.php?op=mostrar",{motivo_id: motivo_id},function(data){
        data = JSON.parse(data);
        $('#motivo_id').val(data.motivo_id);
        $('#motivo_desc').val(data.motivo_desc);
        $("#btnagregar").hide();
        ocultarcampos();

    });

    $('#modalmotivo').modal('show');
}

function eliminar(motivo_id){
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

            $.post("../../controller/motivocontrolador.php?op=eliminar",{motivo_id:motivo_id},function (data) {

                $('#motivo_data').DataTable().ajax.reload();	
            });

            $('#motivo_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
   // $('#cargo_nom').attr("readonly","readonly");
    $('#motivo_desc').attr("readonly","readonly");
}

function activarcampos(){
    //$('#cargo_nom').attr("readonly",false);
    $('#motivo_desc').attr("readonly",false);
}

$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro');
    $('#motivo_form')[0].reset();
    $('#motivo_id').val('');
    $('#modalmotivo').modal('show');
    $("#btnagregar").show();
    activarcampos();

});

$(document).on("click","#btnclosemodal", function(){

    $("#modalmotivo").modal('hide');
});


init();