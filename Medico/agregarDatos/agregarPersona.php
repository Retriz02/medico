<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/agregar_entrevista.css"> <!-- Esto nos permitira llamar al style para nuestra pantalla-->
    <title>Document</title>
</head>

<body>

<?php
 require("../database/db_general.php")
?>
    <div class="container">
        <div class="title">Agregar Persona</div>
        <form action="#" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Nombre</span>
                    <input type="text" name="nombre" required> <!-- Creamos una caja de texto para que pueda introducir el nombre de la nueva persona -->
                </div>

                <div class="input-box">
                    <span class="details">Apellido</span>
                    <input type="text" name="apellido" required> <!-- Creamos una caja de texto para que pueda introducir el apellido de la nueva persona -->
                </div>
            </div>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Estado Laboral</span>

                    <!-- Esta linia de codigos nos va a permitir seleccionar el estado laboral de la persona -->
                    <select name="estadolaboral" class="selectEstado" required>
                        <?php
                        $sql1 = $mysqli->query("SELECT * FROM estadolaboral");
                        while ($metodo1 = mysqli_fetch_row($sql1)) {
                        ?>
                            <option value="<?php echo $metodo1[0] ?>"><?php echo $metodo1[0], " - ", $metodo1[1] ?></option> <!-- Esto evalua la posision de los datos -->
                        <?php } ?>
                    </select>
                </div>

                <div class="input-box">
                    <span class="details">Estado Civil</span>

                    <!-- Esta linia de codigos nos va a permitir seleccionar el estado civil de la persona -->
                    <select name="estadocivil" id="" class="selectEstado" required>
                        <?php
                        $sql = $mysqli->query("SELECT * FROM estadocivil");
                        while ($metodo = mysqli_fetch_row($sql)) {
                        ?>
                            <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[0], " - ", $metodo[1] ?></option> <!-- Esto evalua la posision de los datos -->
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Fecha de Nacimiento</span>
                    <input type="date" name="fecha_nac"> <!-- Este input nos permite seleccionar la fecha de nacimiento de la persona --> 
                </div>
                <div class="input-box">
                    <span class="details">D.N.I</span>
                    <input type="number" name="DNI" min="1000000" max="100000000"> <!-- Aqui creamos un campo que permitira introducir el DNI -->
                </div>
            </div>
            
            <div class="botones"> <!-- Creamos un boton cancelar la cual nos va a permitir cancelar el agregar de una nueva persona -->
                <a href="./rellenar.php">Cancelar</a> <!-- Con esto nos va a redireccionar a rellenar.php -->
                <input type="submit" value="Aceptar" name="aceptar"> <!-- Aqui creamos un boton aceptar lo cual nos permitira agregar a la nueva persona -->
            </div>
            
        </form>
    </div>
    <?php

    // Si existe una acción en el boton aceptar realiza la siguiente acción
    if (isset($_POST["aceptar"])) {

        // Traemos todos los datos ingresados 
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $estadolaboral = $_POST["estadolaboral"];
        $estadocivil = $_POST["estadocivil"];
        $fechanac = $_POST["fecha_nac"];
        $dni = $_POST["DNI"];

        // Con esta linia de codigos lo que se hace es insertar los datos de la nueva persona 
        $nuevaPersona = "INSERT INTO persona(ID_estadoLaboral_persona, ID_estadoCivil_persona, Apellido_persona, Nombre_persona, DNI, Fec_nac) 
        VALUES ('$estadolaboral','$estadocivil','$apellido','$nombre','$dni','$fechanac')";
        $resultado = $mysqli->query($nuevaPersona);

        echo "<script type=\"text/javascript\"> window.location='./rellenar.php';</script>"; // Se nos redireccionara a rellenar.php
    } ?>

</body>

</html>
