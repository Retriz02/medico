<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloTablas.css">
    <script src="confirmacion/confirmacion.js"></script>
    
    <title>Document</title>
</head>

<body>
<p>Lista de los Consultorios</p>
    <?php

        require("medicos.php");

        $sql = "SELECT consultorio.*, domicilio.*, contactos.*, medico.*,persona.*
        FROM consultorio
        LEFT JOIN  general.domicilio on consultorio.ID_domicilio_consultorio = domicilio.ID_domicilio
        LEFT JOIN  general.contactos on consultorio.ID_contacto_consultorio = contactos.ID_contacto
        LEFT JOIN  medicos.medico  on consultorio.ID_medico_consultorio = medico.ID_medico
        LEFT JOIN  general.persona  on medico.ID_persona_medico = persona.ID_persona";

        $resultado = $conexion->query($sql) or die ($conexion->error);
    ?>
    <div class="page-container">
        <div class="table-container">
            <table id="main-container" class="table-cebra">
                <thead>
                    <tr>
                        <th class="stiky">Domicilio</th>
                        <th class="stiky">Contacto</th>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Nombre</th>
                        <th class="stiky">Días</th>
                        <th class="stiky">Hora Apertura</th>
                        <th class="stiky">Hora Cierre</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($consultorio = mysqli_fetch_assoc($resultado)) {
                    ?>
                        <tr>

                            <td><?php echo $consultorio["Calle"], " ", $consultorio["Numero"] ?></td>
                            <td><?php echo $consultorio["Valor"] ?></td>
                            <td><?php echo $consultorio["ApellidoP"], " ", $consultorio["NombreP"] ?></td>
                            <td><?php echo $consultorio["Nombre_Consultorio"] ?></td>
                            <td><?php echo $consultorio["Dias"] ?></td>
                            <td><?php echo $consultorio["horaApertura"] ?></td>
                            <td><?php echo $consultorio["horaCierre"] ?></td>

                            <td><a href="modificar_consultorio.php?id=<?php echo $consultorio["ID_consultorio"] ?>"><button> Modificar </button></a></td>

                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>