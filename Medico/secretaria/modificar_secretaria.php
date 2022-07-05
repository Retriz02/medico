<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Secretaria</title>
        <link rel="stylesheet" href="./styles/modificar_medico.css">
    </head>

    <body>
        <?php

        // Llamamos a la base de datos
        require 'secretaria.php';

        $ID_secretaria = $_GET["id"]; // Esto nos permite tomar el id de la secretaria

        // Con esto lo que hacemos es poder modificar a la secretaria seleccionada 
        $modificar = "SELECT * FROM Secretaria WHERE ID_secretaria = $ID_secretaria"; 

        $resultado = $conexion->query($modificar);

        $dato = mysqli_fetch_assoc($resultado);
    ?>
        <div class="Global">
            <div class="contenedor">
                <h1 class="title-secretaria">Modificar Secretaria</h1>
                <form action="" method="POST">
                    <fieldset>
                        <legend>Datos Profesionales De Secretaria</legend>
                        <div class="contenedorsecretaria">
                            <div class=cont-secretaria>
                                <div class="cont-dato-secretaria">

                                    <input value="<?php echo $dato["ID_secretaria"]?>" readonly class="selectSecretaria"
                                        name="secretaria"> <!-- Seleccionamos a la secretaria que deseamos modificar -->


                                    <!-- <button class="btn-agregar">+</button> -->

                                    <div class="selectTipodomicilio">
                                        <select value="" class="selectTipodomicilio" name="tipodomicilio"> <!-- Realizamos una lista para seleccionar los distintos tipos de domicilios -->
                                            <option value="<?php echo $dato["ID_tipodomicilio"]?>"> <!-- Esto nos muestra el tipo de domicilio que tiene la secretaria -->
                                                <?php echo $dato["ID_tipodomicilio"]?></option> <!-- Esto nos permite seleccionar un nuevo domicilio para modificar el anterior -->
                                            <option value="0">Domicilio Laboral</option>
                                            <option value="1">Consultorio</option>
                                            <option value="2">Sanatorio</option>
                                        </select>
                                    </div>

                                    <div class="cont-nombredomicilio">
                                        <p>
                                            <input type="text" class="input-Nombredomicilio" value="<?php echo $dato["nombredomicilio"] ?>" placeholder="Nombre Domicilio"
                                                name="nombredomicilio" maxlenght=10> <!-- Creamos una caja de texto que nos permitira modicar el nombre del domicilio de la secretaria -->
                                        </p>
                                    </div>

                                    <div class="cont-fechalaboral">
                                        <p>
                                            <!-- Esto nos permitira modificar la fecha laboral de la secretaria -->
                                            <input type="text" value="<?php echo $dato["fechalaboral"]?>" 
                                                class="input-Fechalaboral" placeholder="Fechas Laborales"
                                                name="fechalaboral" maxlenght=10>

                                        </p>
                                    </div>
                                    <div class="selectHorariolaboral">
                                        <p>
                                            <!-- Esto nos permitira modificar el  horario laboral de la secretaria -->
                                            <input type="text" value="<?php echo $dato["horariolaboral"]?>"
                                                class="input-horariolaboral" placeholder="Horario Laboral"
                                                name="horariolaboral" maxlenght=10>
                                        </p>
                                    </div>
                                    <div class="selectTurnolaboral">
                                        <!-- Esto nos permitira modificar turno laboral de la secretaria -->
                                        <select value="" class="selectTurnolaboral" name="turnolaboral">
                                            <option value="<?php echo $dato["turnolaboral"] ?>"><?php echo $dato["turnolaboral"] ?></option>
                                            <option value="0">Turno Laboral Asignado</option>
                                            <option value="1">Turno Mañana 1</option>
                                            <option value="2">Turno Tarde 2</option>
                                            <option value="3">Turno Nocturno 3</option>
                                        </select>
                                    </div>
                                    <div class="cont-contactosecretaria">
                                        <p>
                                            <!-- Esto nos permitira modificar los contactos de la secretaria -->
                                            <input type="text" class="input-Contactosecretaria"
                                                placeholder="Contacto De La Secretaria" value="<?php echo $dato["contactosecretaria"] ?>"
                                                name="contactosecretaria" maxlenght=15>
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                    <div class="botones">
                        <!-- Creamos un boton que nos permitira cancelar la modificación -->
                        <input type="submit" class="btn-cancelar" name="cancelar" value="Cancelar">

                        <!-- Creamos un boton que nos permitira aceptar la modificación -->
                        <input type="submit" class="btn-aceptar" name="aceptar" value="Aceptar">
                    </div>
                </form>
    <?php
        // Si existe una acción en el boton aceptar realiza la siguiente acción
        if (isset($_POST["aceptar"])) {
            require("secretaria.php"); // Llamamos a la base de datos 

            $secretaria = $_POST["secretaria"];
            $tipodomicilio = $_POST["tipodomicilio"];
            $nombredomicilio = $_POST["nombredomicilio"];
            $fechalaboral = $_POST["fechalaboral"];
            $horariolaboral = $_POST["horariolaboral"];
            $turnolaboral = $_POST["turnolaboral"];
            $contactosecretaria = $_POST["contactosecretaria"];


            $secretaria = "UPDATE `Secretaria` SET `ID_tipodomicilio`='$tipodomicilio', `nombredomicilio`='$nombredomicilio', `fechalaboral`='$fechalaboral', `horariolaboral`= '$horariolaboral', `turnolaboral`='$turnolaboral', `contactosecretaria`='$contactosecretaria' where ID_secretaria =  $secretaria "; // Con esta linea de codigos modificamos los datos de la secretaria
            $resultado1 = $conexion->query($secretaria); // Aqui nos muestra el resultado actualizado de la Entrevista
        
            echo "<script type=\"text/javascript\"> window.location='secretaria1.php';</script>"; // Con esto se hace un direccionamiento a la Lista de secretaria
        } 
        // Si existe una acción en el boton cancelar realiza la siguiente acción
        if (isset($_POST["cancelar"])) {
        
        echo "<script type=\"text/javascript\"> window.location='secretaria1.php';</script>"; // Con esto se hace un direccionamiento a la Lista de secretaria
        } 
    ?>

    </body>

</html>