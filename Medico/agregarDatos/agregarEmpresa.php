<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos_comercial/agregarEntrevistas.css"> <!-- Esto nos permitira llamar al style para nuestra pantalla-->
    <title>Document</title>

</head>

<body>
    <div class="container">
        <div class="title">Agregar Empresa</div>
        <form action="" method="post">
            <span class="details">Nombre de la Empresa</span>
            <div class="input-box" align="center">
                <input type="text" name="nombre" required> <!-- Creamos una caja de texto para que pueda introducir el nombre de la empreza -->
            </div>

            <div class="botones"> <!-- Creamos un boton cancelar la cual nos va a permitir cancelar el agregar de un nuevo domiciio -->
                <a href="./rellenar.php">Cancelar</a> <!-- Esto nos permite redireccionarnos -->
                <input type="submit" value="Aceptar" name="aceptar"> <!-- Aqui creamos un boton aceptar lo cual nos permitira agregar un nuevo domicilio -->
            </div>
        </form>
    </div>
    <?php

    // Si existe una acción en el boton aceptar realiza la siguiente acción
    if (isset($_POST["aceptar"])) {

        // Llamamos a la base de datos
        require("../../database/db_comercial.php");

        // Traemos todos los datos ingresados 
        $nom_empresa = $_POST["nombre"];

        // Con esta linia de codigos lo que se hace es insertar los datos de la nueva empreza
        $nuevaEmpresa = "INSERT INTO empresas (Nombre_empresa) VALUES 
        ('$nom_empresa')";
        $resultado = $mysqli->query($nuevaEmpresa);

        echo "<script type=\"text/javascript\"> window.location='./rellenar.php';</script>";  // Se nos redireccionara a rellenar.php
    } ?>
</body>

</html>