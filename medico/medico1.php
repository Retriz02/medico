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
    <p>Lista de los Medicos
        <a href="agregarMedico.php" target="paginaPrincipal">
            <input type="button" value="Agregar un nuevo Medico">
        </a>
    </p>
    <?php

        require("medicos.php");

        $sql = "SELECT medico.*, especialidades.Especialidad_Descripcion, profesion.Profesion_Descripcion, persona.*
        FROM medico
        LEFT JOIN especialidades on medico.ID_especialidad_medico = especialidades.ID_especialidad
        LEFT JOIN profesion on medico.ID_profesion_medico = profesion.ID_Profesion
        LEFT JOIN general.persona on medico.ID_persona_medico = persona.ID_persona";
        
        $result = $conexion->query($sql);
    ?>

    <div class="page-container">
        <div class="table-container">
            <table id="main-container" class="table-cebra">
                <thead>
                    <tr>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Profesion</th>
                        <th class="stiky">Especialidad</th>
                        <th class="stiky">Matricula</th>
                        <th class="stiky">Nro_Prestador</th>
                        <th class="stiky">Eliminar</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($medico = mysqli_fetch_assoc($result)) {
                        
                    ?>
                        <tr>

                            <?php $medico["ID_medico"] ?>

                            <td><?php echo $medico["NombreP"], " ", $medico["ApellidoP"] ?></td>

                            <td><?php echo $medico["Profesion_Descripcion"] ?></td>

                            <td><?php echo $medico["Especialidad_Descripcion"] ?></td>

                            <td><?php echo $medico["Nro_Matricula"] , " - ", $medico["Tipo_Matricula"] ?></td>

                            <td><?php echo $medico["Nro_Prestador"] ?></td>

                            <td><a href="eliminar_medico.php?id=<?php echo $medico["ID_medico"] ?>"><button> Eliminar </button></a></td>
                            <td><a href="modificar_medico.php?id=<?php echo $medico["ID_medico"] ?>"><button> Modificar </button></a></td>
                            
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>