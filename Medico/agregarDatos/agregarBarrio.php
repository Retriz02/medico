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
        <div class="title">Agregar Barrio</div>
        <form action="" method="post">
            <span class="details">Nombre del Barrio</span>
            <div class="input-box" align="center">
                <input type="text" name="nombre" required> <!-- Creamos una caja de texto para que pueda introducir el nombre del barrio -->
            </div>

            <div class="botones"> <!-- Creamos un boton cancelar la cual nos va a permitir cancelar  -->
                <a href="./agregarDomicilio.php">Cancelar</a> <!-- Esto nos permite redireccionarnos -->
                <input type="submit" value="Aceptar" name="aceptar"> <!-- Aqui creamos un boton aceptar lo cual nos permitira agregar un nuevo barrio -->
            </div>
        </form>
    </div>
    <?php

    // Si existe una acción en el boton aceptar realiza la siguiente acción
    if (isset($_POST["aceptar"])) {

        // Llamamos a la base de datos
        require("../../database/db_general.php");

        // Traemos todos los datos ingresados 
        $nom_barrio = $_POST["nombre"];

        // Con esta linia de codigos lo que se hace es insertar los datos del nuevo barrio
        $nuevaBarrio = "INSERT INTO barrios (Nombre_barrio) VALUES 
        ('$nom_barrio')";
        $resultado = $mysqli->query($nuevaBarrio);

        echo "<script type=\"text/javascript\"> window.location='./agregarDomicilio.php';</script>";  // Se nos redireccionara a rellenar.php
    } ?>
</body>

</html>