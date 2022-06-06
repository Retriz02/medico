<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <link rel="stylesheet" href="styles/crearEntrevista.css">
    <title>Document</title>

</head>

<body>

<?php

require("medicos.php");

$sql = "SELECT * FROM entrevista_medicos";

$resultado = $conexion->query($sql);

?>
    <div class="global">
        <form action="" method="POST">
            <h1 class="title-entrevista">Crear nueva entrevista</h1>
            <div class="contenedor-entrevista">
                <fieldset>
                    <legend>Personal</legend>
                    <div class="cont-entrevista">
                        <div class="cont-usuario-datos">

                            <div>
                                <p><span>Medico</span>
                                    <select value="" id="" name="medico">
                                        <option value="0">Medico</option>
                                        <option value="1">Acuña Melanie Xiomara</option>
                                        <option value="2">Romero Carlos Ezequiel</option>
                                    </select>
                                </p>
                                <button class="btn-agregar">+</button>

                            </div>
                            <div>
                                <p><span>Usuario</span>
                                    <select value="" id="" name="usuario">
                                        <option value="0">Persona</option>
                                        <option value="1">Acuña Melanie Xiomara</option>
                                        <option value="2">Romero Carlos Ezequiel</option>
                                        <option value="3">Rojas Felix Norberto</option>
                                        <option value="4">Santa Cruz Rebeca</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                </fieldset>
                <fieldset>
                    <legend>Domicilio</legend>
                    <div class="cont-dato-domicilio">

                        <select class="domicilio" value="Provincias" name="domicilio">
                            <option value="0">Domicilio</option>
                            <option value="1">Provincia "Formosa" Localidad "Formosa" Barrio "Eva Perón" Calle "Raul
                                Alfonsín" Numero "4"</option>
                            <option value="2">Provincia "Formosa" Localidad "Formosa" Calle "Corrientes" Numero "3"
                            </option>
                            <option value="3">Provincia "Chaco" Localidad "Charata" Barrio "Villa Berth"</option>

                        </select>
                        <button class="btn-agregar">+</button>
                </fieldset>
                <fieldset>
                    <legend>Horario</legend>

                    <div class="cont-horario">
                        <input type="date" class="fecha-horario" name="fecha" required><input type="time"
                            class="fecha-horario" name="horario" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Observaciones</legend>
                    <textarea class="textarea-observacion" placeholder="Escriba sus observaciones..." maxlength="1000"
                        cols="60" rows="8" name="observaciones" required></textarea>
            </div>
            </fieldset>
            <div class="botones">
                <a href="entrevista1.php" class="btn-aceptar">Cancelar</a>
                <input type="submit" class="btn-aceptar" value="Aceptar" name="aceptar">
            </div>
        </form>
        <?php
    if (isset($_POST["aceptar"])) {
        require("medicos.php");

        $domicilio = $_POST["domicilio"];
        $medico = $_POST["medico"];
        $usuario = $_POST["usuario"];
        $fecha = $_POST["fecha"];
        $horario = $_POST["horario"];
        $observacion = $_POST["observaciones"];
      

        $nuevaEntrevista = "INSERT INTO entrevista_medicos ( ID_domicilio, ID_medico, ID_usuario, Fecha, Horario, Observacion) VALUES 
        ('$domicilio','$medico','$usuario','$fecha','$horario','$observacion')";
        $resultado = $conexion->query($nuevaEntrevista);

        echo "<script type=\"text/javascript\"> window.location='entrevista1.php';</script>";
    } ?>

</body>

</html>