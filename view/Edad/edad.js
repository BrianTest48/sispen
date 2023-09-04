$(document).ready(function(){ 
    $.post("../../controller/edadcontrolador.php?op=mostrar",{edad_id: 1},function(data){
        //console.log(data);
        data = JSON.parse(data);
        $('#txtcant_anios').val(data.edad).trigger('change');
        

    });
});

function actualizar(){

    let cant_anios = $('#txtcant_anios').val();

    $.post("../../controller/edadcontrolador.php?op=guardaryeditar",{edad_id: 1 , edad: cant_anios},function(data){
        //console.log(data);
        if(data == 1){
            swal.fire(
                'Se actualizó correctamente.',
                '',
                'success'
            );
        }
    });
}