<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        jQuery('.soloNumeros').keypress(function (tecla) {
            if (tecla.charCode < 48 || tecla.charCode > 57) return false;
        });

        miFormulario = document.querySelector('#miFormulario');
        miFormulario.codigo.addEventListener('keypress', function (e) {
            if (!soloNumeros(event)) {
                e.preventDefault();
            }
        })

        //Solo permite introducir numeros.
        function soloNumeros(e) {
            var key = e.charCode;
            console.log(key);
            return key >= 48 && key <= 57;
        }
    </script>
</head>

<body>
    <div class="input-group">
        <label class="control-label">Precio:</label>
        <input type="number" id="precio" class="soloNumeros" min="1" />
    </div>
    <input type="text" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">

    <form name='miFormulario' id='miFormulario'>
        <input type="text" name="codigo" id="idcodigo" maxlength="13">
        <input type="submit" value="Enci">
        
        <input type="number" name="dni" placeholder="Su dni"
           required pattern="[a-z0-9]{5,40}"
           title="Letras y números. Tamaño mínimo: 5. Tamaño máximo: 40" />
    </form>
    <h1>SOLO NUMEROS SIMPLE</h1>
  <div>
    <input type="input" name="ESP" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
  </div>

</body>

</html>