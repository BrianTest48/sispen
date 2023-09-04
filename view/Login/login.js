$(document).ready(function(){ 
    //var sonido = new Audio("../../dbz.mp3");
    //sonido.play();
    var audio = document.getElementById("audio");
    audio.play();
});


function login(){

    $user = document.getElementById("alias").value;
    $pass = document.getElementById("clave").value;

    //console.log($user);
    //console.log($pass);

    if($user == "" || $pass == ""){
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Ingrese todos los campos',
            showConfirmButton: false,
            timer:1500
        });  
    }else {
        $.post("../../controller/usuariocontrolador.php?op=ingresar",{alias : $user, clave : $pass},function (data){
            if(data == 1){
                //console.log("Datos Incorrectos");
                window.location.href="../view/Inicio/index.php";
            }else{
                //console.log("Datos Correctos");
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Las credenciales no coinciden',
                    showConfirmButton: false,
                    timer:1500
                }); 
            }

            /*
            if(data != ""){
                data = JSON.parse(data);
                //console.log(data[0]['alias']);
    
                if(data[0]['alias'] === $user){
                    window.location.href="./view/Inicio/index.php";
                }else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Las credenciales no coinciden',
                        showConfirmButton: false,
                        timer:1500
                    });  
                }
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Las credenciales no coinciden',
                    showConfirmButton: false,
                    timer:1500
                });  
            }*/
        });
    } 
}


$(document).on("click", "#btningresar", function (){
    var usu_alias = $('#alias').val();
    var usu_pass = $('#clave').val();

    if(usu_alias == '' || usu_pass == ''){
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Ingrese todos los campos',
            showConfirmButton: false,
            timer:1500
        });  
    }else {
        $.post("../../controller/usuariocontrolador.php?op=ingresar",{alias : usu_alias, clave : usu_pass},function (data) {
            if(data == 0){
                /*Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Las credenciales no coinciden',
                    showConfirmButton: false,
                    timer:1500
                });*/
                Swal.fire({
                    title: 'Las credenciales no coinciden',
                    text: '',
                    imageUrl: '../../public/img/bola.png',
                    imageWidth: 200,
                    imageHeight: 200,
                    imageAlt: 'Logo',
                    showConfirmButton: false,
                    timer:1500
                  })

            }else{
                //window.open('http://localhost/SISPEN_CRUD/view/Inicio/','_self');
                window.location.href="../Inicio/index.php";
            }
        
        });
    }

});

