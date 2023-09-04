var tabla ;

function init(){
    $("#salario_form").on("submit",function(e){
        guardaryeditar(e);	
    });
}

$(document).ready(function(){ 

    $('#sal_moneda').select2({
        placeholder: "Seleccione",
        dropdownParent: $("#modalmantenimientosalario"),
        minimumResultsForSearch: Infinity
    });

    tabla=$('#salario_data').dataTable({
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
            url: '../../controller/salariocontrolador.php?op=listar',
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
    var columna = [5, 6, 7, 8, 9, 10, 11, 12, 13];
    for ( var i=0 ; i<columna.length ; i++ ) {
        tabla.column( columna[i] ).visible(false);
    }
    tabla.columns.adjust().draw( false );

});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#salario_form")[0]);
    $minimo = document.getElementById("sal_minimo").value;
    $ss_ap = document.getElementById("sal_ss_ap_tra").value;
    $ap_tra = document.getElementById("sal_fonavi_ap_tra").value;
    $a_ap_tra = document.getElementById("sal_p_ap_tra").value;
    $ss_ap_pat = document.getElementById("sal_ss_ap_pat").value;
    $p_ap_pat = document.getElementById("sal_p_ap_pat").value;
    $ap_pat = document.getElementById("sal_fonavi_ap_pat").value;
    

    if(!isNaN($minimo) && !isNaN($ss_ap) && !isNaN($ap_tra) && !isNaN($a_ap_tra) && !isNaN($ss_ap_pat) && !isNaN($p_ap_pat) && !isNaN($ap_pat) ) {
        $.ajax({
            url: "../../controller/salariocontrolador.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos){
                console.log(datos);
                $('#salario_form')[0].reset();
                $("#modalmantenimientosalario").modal('hide');
                $('#salario_data').DataTable().ajax.reload();
                $("#btnagregar").show();
                activarcampos();
                swal.fire(
                    'Registro!',
                    'El registro correctamente.',
                    'success'
                )
            }
        });
    }else {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Ingrese solo datos numericos en los campos de seguros',
            showConfirmButton: false,
            timer:2000
        });
    }
    
}

function editar(sal_id){
    $('#mdltitulo').html('Editar Registro');
    $.post("../../controller/salariocontrolador.php?op=mostrar",{sal_id: sal_id},function(data){

        data = JSON.parse(data);
        $('#sal_id').val(data.sal_id);
        $('#sal_f_inicio').val(data.sal_f_inicio);
        $('#sal_f_final').val(data.sal_f_final);
        $('#sal_moneda').val(data.sal_moneda).trigger('change');
        $('#sal_minimo').val(data.sal_minimo);
        $('#sal_ss_ap_tra').val(data.sal_ss_ap_tra);
        $('#sal_fonavi_ap_tra').val(data.sal_fonavi_ap_tra);
        $('#sal_p_ap_tra').val(data.sal_p_ap_tra);
        $('#sal_ss_ap_pat').val(data.sal_ss_ap_pat);
        $('#sal_p_ap_pat').val(data.sal_p_ap_pat);
        $('#sal_fonavi_ap_pat').val(data.sal_fonavi_ap_pat);
        $("#btnagregar").show();
        activarcampos();
        
    });

    $('#modalmantenimientosalario').modal('show');
}

function vista(sal_id){
    $('#mdltitulo').html('Ver Registro');
    $.post("../../controller/salariocontrolador.php?op=mostrar",{sal_id: sal_id},function(data){

        data = JSON.parse(data);
        $('#sal_id').val(data.sal_id);
        $('#sal_f_inicio').val(data.sal_f_inicio);
        $('#sal_f_final').val(data.sal_f_final);
        $('#sal_moneda').val(data.sal_moneda).trigger('change');
        $('#sal_minimo').val(data.sal_minimo);
        $('#sal_ss_ap_tra').val(data.sal_ss_ap_tra);
        $('#sal_fonavi_ap_tra').val(data.sal_fonavi_ap_tra);
        $('#sal_p_ap_tra').val(data.sal_p_ap_tra);
        $('#sal_ss_ap_pat').val(data.sal_ss_ap_pat);
        $('#sal_p_ap_pat').val(data.sal_p_ap_pat);
        $('#sal_fonavi_ap_pat').val(data.sal_fonavi_ap_pat);
        $("#btnagregar").hide();
        ocultarcampos();
    });


    $('#modalmantenimientosalario').modal('show');
}

function eliminar(sal_id){

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

            $.post("../../controller/salariocontrolador.php?op=eliminar",{sal_id :sal_id},function (data) {
                console.log(data);
                $('#salario_data').DataTable().ajax.reload();	
            });

            $('#salario_data').DataTable().ajax.reload();	

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
    })
}


function ocultarcampos(){
    $('#sal_f_inicio').attr("readonly","readonly");
    $('#sal_f_final').attr("readonly","readonly");
    $('#sal_moneda').attr("disabled","disabled");
    $('#sal_minimo').attr("readonly","readonly");
    $('#sal_ss_ap_tra').attr("readonly","readonly");
    $('#sal_fonavi_ap_tra').attr("readonly","readonly");
    $('#sal_p_ap_tra').attr("readonly","readonly");
    $('#sal_ss_ap_pat').attr("readonly","readonly");
    $('#sal_p_ap_pat').attr("readonly","readonly");
    $('#sal_fonavi_ap_pat').attr("readonly","readonly");
}

function activarcampos(){
    $('#sal_f_inicio').attr("readonly",false);
    $('#sal_f_final').attr("readonly",false);
    $('#sal_moneda').attr("disabled",false);
    $('#sal_minimo').attr("readonly",false);
    $('#sal_ss_ap_tra').attr("readonly",false);
    $('#sal_fonavi_ap_tra').attr("readonly",false);
    $('#sal_p_ap_tra').attr("readonly",false);
    $('#sal_ss_ap_pat').attr("readonly",false);
    $('#sal_p_ap_pat').attr("readonly",false);
    $('#sal_fonavi_ap_pat').attr("readonly",false);

}


$(document).on("click","#btnnuevo", function(){

    $('#mdltitulo').html('Nuevo Registro');
    $('#salario_form')[0].reset();
    $('#sal_id').val('');
    $('#sal_moneda').select2("val", "0");
    $('#modalmantenimientosalario').modal('show');
    $("#btnagregar").show();
    activarcampos();
});

$(document).on("click","#btnclosemodal", function(){
    $("#modalmantenimientosalario").modal('hide');
});

init();
