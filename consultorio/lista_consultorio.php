<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/estilo_listas.css">

    <title>Document</title>
</head>
<body>
    <div class="container">

        <div class="title">
            <p><b>Lista de Consultorios</b></p>
            <a href="agregar_consultorio.php" target="paginaPrincipal">
                <input type="button" value="Agregar sanatorio" class="blue">
            </a>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="stiky">Domicilio</th>
                        <th class="stiky">Contacto</th>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Nombre</th>
                        <th class="stiky">Días</th>
                        <th class="stiky">Hora de Apertura</th>
                        <th class="stiky">Hora de Cierre</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                 
                        require("../database/db_medico.php"); 

                        $sql = "SELECT consultorio.*, domicilio.*, contactos.*,persona.*,medico.*
                        FROM consultorio
                        LEFT JOIN db_general.domicilio on consultorio.ID_domicilio_consultorio = domicilio.ID_domicilio
                        LEFT JOIN db_general.contactos on consultorio.ID_contacto_consultorio = contactos.ID_contacto
                        LEFT JOIN  db_medico.medico  on consultorio.ID_medico_consultorio = medico.ID_medico
                        LEFT JOIN  db_general.persona  on medico.ID_persona_medico = persona.ID_persona";
                        $resultado = $conexion->query($sql) or die ($conexion->error);

                        while ($consultorio = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <tr>

                        <td><?php echo $consultorio["Calle"], " ", $consultorio["Numero"] ?></td>

                        <td><?php echo $consultorio["Valor"] ?></td>

                        <td><?php echo $consultorio["Apellido_persona"], " ", $consultorio["Nombre_persona"] ?></td>

                        <td><?php echo $consultorio["Nombre_Consultorio"] ?></td>

                        <td><?php echo $consultorio["Dias_consultorio"] ?></td>

                        <td><?php echo $consultorio["horaApertura_consultorio"] ?></td>

                        <td><?php echo $consultorio["horaCierre_consultorio"] ?></td>

                        <td><a href="modificar_consultorio.php?id=<?php echo $consultorio["ID_consultorio"] ?>" class="botones">Modificar</a></td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
</body>
</html>