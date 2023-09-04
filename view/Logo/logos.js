var tabla ;

let arrayImages = [];

let myDropzone = new Dropzone('.dropzone', {
    url: '../../assets/img',
    maxFilesize: 20,
    maxFile: 20,
    acceptedFiles: 'image/jpeg, image/png',
    addRemoveLinks: true,
    dictRemoveFile: 'Quitar'
});

myDropzone.on('addedfile', file => {
    arrayImages.push(file);
    //console.log(arrayImages);
});

myDropzone.on('removedfile', file => {
    let i = arrayImages.indexOf(file);
    arrayImages.splice(i,1);
    console.log(arrayImages);
});



function init(){
    $("#logo_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 
    tabla=$('#logo_data').dataTable({
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
            url: '../../controller/logocontrolador.php?op=listar',
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
    var formData = new FormData($("#logo_form")[0]);

    var totalfiles = arrayImages.length;
    for(var i = 0; i < totalfiles; i++){
        formData.append("file[]", arrayImages[i]);
    }

    $.ajax({
        url: "../../controller/logocontrolador.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            console.log(datos);
            $('#logo_form')[0].reset();
            $("#modallogo").modal('hide');
            $('#logo_data').DataTable().ajax.reload();
            $("#btnagregar").show();
            activarcampos();
            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            );
            Dropzone.forElement('.dropzone').removeAllFiles(true);

        }
    });
}

function editar(logo_id){

    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/logocontrolador.php?op=mostrar",{logo_id: logo_id},function(data){
        data = JSON.parse(data);
        $('#logo_id').val(data.logo_id);
        $('#logo_nom').val(data.logo_nom);
        $('#dropzone').val(data.imagen);
        $('#logo_estado').val(data.logo_estado);
        $("#btnagregar").show();
        activarcampos();

    });

    $('#modallogo').modal('show');
}

function vista(logo_id){

    $('#mdltitulo').html('Ver Registro');

    $.post("../../controller/logocontrolador.php?op=mostrar",{logo_id: logo_id},function(data){
        data = JSON.parse(data);
        $('#logo_id').val(data.logo_id);
        $('#logo_nom').val(data.logo_nom);
        $('#logo_estado').val(data.logo_estado);
        $("#btnagregar").hide();
        ocultarcampos();

    });

    $('#modallogo').modal('show');
}

function eliminar(logo_id){
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

            $.post("../../controller/logocontrolador.php?op=eliminar",{logo_id:logo_id},function (data) {

                $('#logo_data').DataTable().ajax.reload();	
            });

            $('#logo_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
    $('#logo_nom').attr("readonly","readonly");
    //$('#logo_desc').attr("readonly","readonly");
}

function activarcampos(){
    $('#logo_nom').attr("readonly",false);
    //$('#logo_desc').attr("readonly",false);
}

$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro');
    $('#logo_form')[0].reset();
    $('#logo_id').val('');
    $('#modallogo').modal('show');
    $("#btnagregar").show();
    Dropzone.forElement('.dropzone').removeAllFiles(true);
    activarcampos();

});

$(document).on("click","#btnclosemodal", function(){

    $("#modallogo").modal('hide');
});


init();