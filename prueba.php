<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formatear Números con Comas para Miles y Millones</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <label for="miInput">Ingresa un número:</label>
  <input type="text" id="miInput">

  <script>
    function agregarComas(numero) {
      var numeroString = numero.toString().replace(/\,/g,'');
      var partesNumero = numeroString.split('.');
      partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      return partesNumero.join('.');
    }

    $(document).ready(function () {
      $("#miInput").on("input", function (event) {
        // Obtiene el valor actual del input y quita cualquier formato existente
        var valor = $(this).val().replace(/[^\d]/g, '');

        // Llama a la función agregarComas para formatear el número
        var numeroFormateado = agregarComas(valor);

        // Establece el valor formateado en el campo de entrada
        $(this).val(numeroFormateado);
      });
    });
  </script>

</body>

</html>
