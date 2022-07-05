<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- llamamos a los estilos de la página -->
    <link rel="stylesheet" href="../estilos_comercial/agregarEntrevistas.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="title">Agregar Localidad</div>
        <form action="" method="post">

            <div class="user-details">
                <div class="input-box">
                    <span class="details">Provincia</span>
                    <select name="provincia" required>
                        <?php
                        // Llamamos a la base de datos
                        require("../../database/db_general.php");
                        $tipoContacto = $mysqli->query("SELECT * FROM provincias"); // Seleccionamos las tablas a utilizar 
                        //Mientas que el array tenga contenido itera para imprimir todos los datos que se obtinen de la consulta $tipoContacto
                        while ($metodo = mysqli_fetch_row($tipoContacto)) {
                        ?>
                            <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[1] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="input-box">
                    <span class="details">Localidad</span>
                    <input type="text" name="localidad" required> <!-- Aqui creamos una caja de texto donde podra colocar la localidad -->
                </div>
            </div>

            <div class="botones">
                <!-- Creamos un boton cancelar la cual nos va a permitir cancelar el agregar de un nuevo contacto -->
                <input type="button" onclick="location.href='./agregarDomicilio.php'" value="Cancelar">
                <input type="submit" value="Aceptar" name="aceptar"><!-- Aqui creamos un boton aceptar lo cual nos permitira agregar el nuevo contacto -->
            </div>
        </form>
    </div>
    <?php

    // Si existe una acción en el boton aceptar realiza la siguiente acción
    if (isset($_POST["aceptar"])) {

        // Llamamos a la base de datos 
        require("../../database/db_general.php");

        // Colcamos los valores ingresados en variables
        $provincia = $_POST["provincia"];
        $localidad = $_POST["localidad"];

        // Esta linia de codigos nos permitira insertar el nuevo contacto en la base de datos
        $nuevaLocalidad = "INSERT INTO localidades (ID_provincia_localidad, Nombre_localidad) 
        VALUES ('$provincia','$localidad')";
        $resultado = $mysqli->query($nuevaLocalidad);

        echo "<script type=\"text/javascript\"> window.location='./agregarDomicilio.php';</script>";
    } ?>


</body>

</html>