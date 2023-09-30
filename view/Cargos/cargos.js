var tabla ;

function init(){
    $("#cargo_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 
    tabla=$('#cargo_data').dataTable({
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
            url: '../../controller/cargocontrolador.php?op=listar',
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
    var formData = new FormData($("#cargo_form")[0]);
    $.ajax({
        url: "../../controller/cargocontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            console.log(datos);
            $('#cargo_form')[0].reset();
            $("#modalcargos").modal('hide');
            $('#cargo_data').DataTable().ajax.reload();
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

function editar(cargo_id){

    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/cargocontrolador.php?op=mostrar",{cargo_id: cargo_id},function(data){
        data = JSON.parse(data);
        $('#cargo_id').val(data.cargo_id);
        $('#cargo_nom').val(data.cargo_nom);
        $('#cargo_desc').val(data.cargo_desc);
        $("#btnagregar").show();
        activarcampos();

    });

    $('#modalcargos').modal('show');
}

function vista(cargo_id){

    $('#mdltitulo').html('Ver Registro');

    $.post("../../controller/cargocontrolador.php?op=mostrar",{cargo_id: cargo_id},function(data){
        data = JSON.parse(data);
        $('#cargo_id').val(data.cargo_id);
        $('#cargo_nom').val(data.cargo_nom);
        $('#cargo_desc').val(data.cargo_desc);
        $("#btnagregar").hide();
        ocultarcampos();

    });

    $('#modalcargos').modal('show');
}

function eliminar(cargo_id){
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

            $.post("../../controller/cargocontrolador.php?op=eliminar",{cargo_id:cargo_id},function (data) {

                $('#cargo_data').DataTable().ajax.reload();	
            });

            $('#cargo_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
    $('#cargo_nom').attr("readonly","readonly");
    $('#cargo_desc').attr("readonly","readonly");
}

function activarcampos(){
    $('#cargo_nom').attr("readonly",false);
    $('#cargo_desc').attr("readonly",false);
}

$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro');
    $('#cargo_form')[0].reset();
    $('#cargo_id').val('');
    $('#modalcargos').modal('show');
    $("#btnagregar").show();
    activarcampos();

});

$(document).on("click","#btnclosemodal", function(){

    $("#modalcargos").modal('hide');
});


init();