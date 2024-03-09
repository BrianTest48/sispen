var tabla ;
var datos_firmantes;

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

    $('#div_response').hide();
    $('#div_response_sunat').hide();
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

$(document).on("click","#btnconsulta", function(){
    $('#int_ruc').val("");
    $('#modalconsulta').modal('show');
    $('#div_response').hide();
    $('#div_response_sunat').hide();
});

$(document).on("click","#btnclosemodalconsulta", function(){

    $("#modalconsulta").modal('hide');
});

$(document).on("click","#btnclosemodal", function(){

    $("#modalfirma").modal('hide');
});

$(document).on("click","#btnclosemodal_carga", function(){

    $("#modalcargamasiva").modal('hide');
});

function CargaMasiva(){
    console.log("Prueba");
    $('#mdltitulo_carga').html('Subir Carga Masiva');
    $('#modalcargamasiva').modal('show');
}

function CargarCSV(){
    var formData = new FormData($('#carga_form')[0]);

    // Realiza la petición Ajax
    $.ajax({
        url: '../../controller/procesar_csv_firmante.php',
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
            $('#firma_data').DataTable().ajax.reload();
            $("#modalcargamasiva").modal('hide');
        },
        error: function(xhr, status, error) {
            // Muestra un mensaje de error en el contenedor
            //$('#resultado').html("Error al procesar el archivo CSV. Por favor, intenta nuevamente.");
            console.error(xhr.responseText);
        }
    });
}

function BuscarRuc(){
    let texto = $('#int_ruc').val();
    let ruc_emp = texto.trim();

    if(ruc_emp != ""){
        //Ajax para mostrar Datos de Firmantes de la BD Actual
        $.ajax({
            url: "../../controller/firmacontrolador.php?op=tabla_firmante_ruc",
            type: "POST",
            data: { numero : ruc_emp },
            success: function(datos){
                //console.log(datos);
                $('#div_firmantes').html(datos);
                $('#div_response').show();
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
                        //Mostrar Los Representantes Legales
                        let rep_le = response.result.representantes_legales;
                        datos_firmantes = response.result.representantes_legales;
                        let orden = 1;
                        let divs = "";
        
                        if(rep_le != false){
                            rep_le.forEach(function(rep){
                                divs+= `<tr>
                                            <td style='vertical-align: middle;'>${orden++}</td>
                                            <td style='vertical-align: middle;'>${rep.tipodoc}</td>
                                            <td style='vertical-align: middle;'>${rep.numdoc}</td>
                                            <td style='vertical-align: middle;'>${rep.nombre}</td>
                                            <td style='vertical-align: middle;'>${rep.cargo}</td>
                                            <td style='vertical-align: middle;'>${rep.desde}</td>
                                        </tr>`;
                            });
                            
                        }else {
                            divs = `<tr><td colspan="6">SIN RESULTADOS</td></tr>`;
                        }
        
                        $('#div_firmante_sunat').html(divs);
                        $('#div_response_sunat').show();

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

function ActualizarFirmante(){
    var datosJSON = JSON.stringify(datos_firmantes);
    var ruc_empresa = $('#int_ruc').val();
    // Realizar la solicitud AJAX
    $.ajax({
        type: 'POST',
        url: '../../controller/firmacontrolador.php?op=update_firmante_sunat',
        data: { datos: datosJSON, ruc :  ruc_empresa},
        //dataType: 'json',
        success: function(response) {
            console.log('Éxito:', response);
            Swal.fire({
                icon: 'success',
                title: 'Datos Actualizados',
                text: ''
            });
            $("#modalconsulta").modal('hide');
            $('#firma_data').DataTable().ajax.reload();
            
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
}


init();