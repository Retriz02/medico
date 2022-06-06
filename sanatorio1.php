<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloTablas.css">
    <script src="confirmacion/confirmacion.js"></script>
    
    <title>Sanatorios</title>
</head>

<body>
<p>Lista de los Sanatorios</p>
    <?php

        require("medicos.php"); 

        $sql = "SELECT sanatorio.*, domicilio.*, contactos.*,persona.*,medico.*
        FROM sanatorio
        LEFT JOIN general.domicilio on sanatorio.ID_domicilio_sanatorio = domicilio.ID_domicilio
        LEFT JOIN general.contactos on sanatorio.ID_contacto_sanatorio = contactos.ID_contacto
        LEFT JOIN  medicos.medico  on sanatorio.ID_medico_sanatorio = medico.ID_medico
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
                        <th class="stiky">Hora de Apertura</th>
                        <th class="stiky">Hora de Cierre</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($sanatorio = mysqli_fetch_assoc($resultado)){
                    ?>
                        <tr>


                            <td><?php echo $sanatorio["Calle"], " ", $sanatorio["Numero"] ?></td>

                            <td><?php echo $sanatorio["Valor"] ?></td>

                            <td><?php echo $sanatorio["ApellidoP"], " ", $sanatorio["NombreP"] ?></td>


                            <td><?php echo $sanatorio["Nombre_Sanatorio"] ?></td>

                            <td><?php echo $sanatorio["Dias"] ?></td>

                            <td><?php echo $sanatorio["horaApertura"] ?></td>

                            <td><?php echo $sanatorio["horaCierre"] ?></td>

                            <td><a href="modificar_sanatorio.php?id=<?php echo $sanatorio["ID_sanatorio"] ?>"><button> Modificar </button></a></td>
                          

                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</body>

</html>