var tabla ;

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 
    tabla=$('#usuario_data').dataTable({
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
            url: '../../controller/usuariocontrolador.php?op=listar',
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
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuariocontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            console.log(datos);
            $('#usuario_form')[0].reset();
            $("#modalmantenimientousuario").modal('hide');
            $('#usuario_data').DataTable().ajax.reload();
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

function editar(us_id){

    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/usuariocontrolador.php?op=mostrar",{us_id: us_id},function(data){
        data = JSON.parse(data);
        $('#us_id').val(data.us_id);
        $('#us_alias').val(data.us_alias);
        $('#us_nom').val(data.us_nom);
        $('#us_ape').val(data.us_ape);
        $('#us_pass').val(data.us_pass);
        $("#btnagregar").show();
        activarcampos();

    });

    $('#modalmantenimientousuario').modal('show');
}

function vista(us_id){

    $('#mdltitulo').html('Ver Registro');

    $.post("../../controller/usuariocontrolador.php?op=mostrar",{us_id: us_id},function(data){
        data = JSON.parse(data);
        $('#us_id').val(data.us_id);
        $('#us_alias').val(data.us_alias);
        $('#us_nom').val(data.us_nom);
        $('#us_ape').val(data.us_ape);
        $('#us_pass').val(data.us_pass);
        $("#btnagregar").hide();
        ocultarcampos();

    });

    $('#modalmantenimientousuario').modal('show');
}

function eliminar(us_id){
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

            $.post("../../controller/usuariocontrolador.php?op=eliminar",{us_id:us_id},function (data) {

                $('#usuario_data').DataTable().ajax.reload();	
            });

            $('#usuario_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
    $('#us_alias').attr("readonly","readonly");
    $('#us_nom').attr("readonly","readonly");
    $('#us_ape').attr("readonly","readonly");
    $('#us_pass').attr("readonly","readonly");
}

function activarcampos(){
    $('#us_alias').attr("readonly",false);
    $('#us_nom').attr("readonly",false);
    $('#us_ape').attr("readonly",false);
    $('#us_pass').attr("readonly",false);
}

$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#us_id').val('');
    $('#modalmantenimientousuario').modal('show');
    $("#btnagregar").show();
    activarcampos();

});

$(document).on("click","#btnclosemodal", function(){

    $("#modalmantenimientousuario").modal('hide');
});


init();