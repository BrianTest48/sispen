var tabla;



$(document).ready(function(){ 
    tabla=$('#lista_data').dataTable({
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
                    /*$('c[r=G1] t', sheet).text( '' );
                    $('c[r=H1] t', sheet).text( '' );
                    $('c[r=I1] t', sheet).text( '' );*/
                }

            }
        ],
        "ajax":{
            url: '../../controller/listareportecontrolador.php?op=listar',
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

    var columna = [0, 8, 9, 10, 11, 12 ,13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37,
                    38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50];
    for ( var i=0 ; i<columna.length ; i++ ) {
        tabla.column( columna[i] ).visible(false);
    }
    tabla.columns.adjust().draw( false );

    $('.cargos_empresa').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalmantenimientolistas"),
        minimumResultsForSearch: Infinity  
    });

    $('.logos_empresa').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalmantenimientolistas"),
        minimumResultsForSearch: Infinity  
    });

    $.post("../../controller/cargocontrolador.php?op=comborpt",{}, function(data){
        $(".cargos_empresa").html(data);

    });

    $.post("../../controller/logocontrolador.php?op=combo",{}, function(data){
        $(".logos_empresa").html(data);
    });

});


function init(){
    $("#lista_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#lista_form")[0]);

    $.ajax({
        url: "../../controller/listareportecontrolador.php?op=guardaryeditar",
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

function editar(lista_id){
    let tipo ;
    $.post("../../controller/listareportecontrolador.php?op=mostrar_id",{ lista_id : lista_id},function(datos){
        if(datos != ""){
            //console.log(datos);
            datos = JSON.parse(datos);

            switch (datos.tipo) {
                case "REPORTE PENSIONES":
                        tipo = "Rptpension";
                    break;
                case "REPORTE BONO":
                    tipo = "Rptbono";
                break;

            }
            window.open("../"+tipo+"/index.php?lista="+datos.id, "_self");
        }
        
    }); 
}


function eliminar(lista_id){
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

            $.post("../../controller/listareportecontrolador.php?op=eliminar",{lista_id:lista_id},function (data) {

                $('#lista_data').DataTable().ajax.reload();	
            });

            $('#lista_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}

$(document).on("click","#btnclosemodal", function(){
    $("#modalmantenimientolistas").modal('hide');
});

init();