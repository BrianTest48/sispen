$(document).ready(function(){ 
    /*$.post("../../controller/edadcontrolador.php?op=mostrar",{edad_id: 1},function(data){
        //console.log(data);
        data = JSON.parse(data);
        $('#txtcant_anios').val(data.edad).trigger('change');
        

    });*/
});

function actualizar(){

    let cant_anios = $('#txtcant_anios').val();
    //console.log(cant_anios);

    if(cant_anios !== ''){
        $.ajax({
            url: '../../controller/empresacontrolador.php?op=update_busqueda_empresa_meses', // URL del script PHP que procesará los datos
            type: 'POST',
            data: { cantidad : cant_anios},
            success: function(response){
                //console.log(response);
                swal.fire(
                    'Se actualizó correctamente.',
                    '',
                    'success'
                );
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText); // Manejo de errores
            }
        });
    }else {
        swal.fire(
            'Seleccione una opcion',
            '',
            'error'
        );
    }

    
}