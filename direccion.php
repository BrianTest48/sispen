<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enviar Archivo con AJAX</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<form id="formulario" enctype="multipart/form-data">
    <input type="file" name="archivo" id="archivo">
    <button type="button" id="enviar">Enviar</button>
</form>

<script>
$(document).ready(function(){
    $("#enviar").on("click", function(){
        var formData = new FormData($("#formulario")[0]);
        
        $.ajax({
            //url: "./controller/procesar_csv_direccion.php",
            url: "./controller/procesar_csv_empresa_excel.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                // Maneja la respuesta del servidor aquí
                console.log(response);
            },
            error: function(xhr, status, error){
                // Maneja errores aquí
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

</body>
</html>
