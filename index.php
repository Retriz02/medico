<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilosIndex.css">
    <title>login</title>
</head>

<body>

    <form action="comprobarLogin.php" method="POST" class="form">
        <h1 class="title">Inicia Sesión</h1>

        <input type="text" name="usuario" placeholder="Ingrese su usuario">

        <input type="password" name="contraseña" placeholder="Ingrese su contraseña">

        <input type="submit" name="iniciar" value="Iniciar Sesión">
    </form>

</body>

</html>