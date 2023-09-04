var tabla ;

function init(){
    $("#liquidacion_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 

   

    tabla=$('#liqui_data').dataTable({
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
                    $('c[r=P1] t', sheet).text( '' );
                    $('c[r=Q1] t', sheet).text( '' );
                    $('c[r=R1] t', sheet).text( '' );
                }

            }
        ],
        "ajax":{
            url: '../../controller/pliquidacioncontrolador.php?op=listar',
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
    
});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#liquidacion_form")[0]);
    $.ajax({
        url: "../../controller/pliquidacioncontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            console.log(datos);
            $('#liquidacion_form')[0].reset();
            $("#modalliqui").modal('hide');
            $('#liqui_data').DataTable().ajax.reload();
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

function editar(liqui_id){
    $('#mdltitulo').html('Editar Registro');
    $.post("../../controller/pliquidacioncontrolador.php?op=mostrar",{liqui_id: liqui_id},function(data){

        data = JSON.parse(data);
        $('#liqui_id').val(data.liqui_id);
        $('#liqui_nom').val(data.liqui_nom);
        $('#liqui_desc').val(data.liqui_desc);
        $("#btnagregar").show();
        activarcampos();
        
    });

    $('#modalliqui').modal('show');
}

function vista(liqui_id){
    $('#mdltitulo').html('Ver Registro');
    $.post("../../controller/pliquidacioncontrolador.php?op=mostrar",{liqui_id: liqui_id},function(data){

        data = JSON.parse(data);
        $('#liqui_id').val(data.liqui_id);
        $('#liqui_nom').val(data.liqui_nom);
        $('#liqui_desc').val(data.liqui_desc);
        $("#btnagregar").hide();
        ocultarcampos();
    });


    $('#modalliqui').modal('show');
}

function eliminar(liqui_id){

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

            $.post("../../controller/pliquidacioncontrolador.php?op=eliminar",{liqui_id :liqui_id},function (data) {
                console.log(data);
                $('#liqui_data').DataTable().ajax.reload();	
            });

            $('#liqui_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
    $('#liqui_nom').attr("readonly","readonly");
    $('#liqui_desc').attr("readonly","readonly");
}

function activarcampos(){
    $('#liqui_nom').attr("readonly",false);
    $('#liqui_desc').attr("readonly",false);
}


$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro');
    $('#liquidacion_form')[0].reset();
    $('#sal_id').val('');
    $('#sal_moneda').select2("val", "0");
    $('#modalliqui').modal('show');
    $("#btnagregar").show();
    activarcampos();
});

$(document).on("click","#btnclosemodal", function(){
    $("#modalliqui").modal('hide');
});

init();
