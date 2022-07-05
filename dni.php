<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form name='miFormulario' id='miFormulario'>

        Obserrv
        <input type="text" placeholder="helao" oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/,'')">
        <br>

        sacsa
        <input type="input" name="ESP"
            onKeypress="if (event.keyCode < 48 || event.keyCode > 55) event.returnValue = false;">

    </form>

</body>

</html>