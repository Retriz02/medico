<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/estilo_listas.css">
    <title>Tablas</title>
</head>
<?php 
    session_start();
    $datoUsuario = $_SESSION["ID_usuario"];

    require("../database/db_medico.php");
    require("../database/db_general.php");

    //selecciono todos los campos de la tabla medico y atraves del LEFT JOIN se busca los valores de las claves foraneas 
        
    $sql = "SELECT medico.*, especialidades.Especialidad_Descripcion, profesion.Profesion_Descripcion, persona.*
    FROM medico
    LEFT JOIN especialidades on medico.ID_especialidad_medico = especialidades.ID_especialidad
    LEFT JOIN profesion on medico.ID_profesion_medico = profesion.ID_Profesion
    LEFT JOIN general.persona on medico.ID_persona_medico = persona.ID_persona
    WHERE ID_activo_medico = 1 ORDER BY Apellido_persona";
    
    $result = $conexion->query($sql);
?>

<body>
    <div class="container">
        <div class="title">
            <p><b>Lista de los Medicos</b></p>
            <a href="agregar_med.php" target="paginaPrincipal">
                <input type="button" value="Agregar Medico" class="blue">
            </a>

        </div>
        <div class="table-container">
            <table class="table">

                <thead>
                    <tr>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Profesion</th>
                        <th class="stiky">Especialidad</th>
                        <th class="stiky">Matricula</th>
                        <th class="stiky">Nro_Prestador</th>
                        <th class="stiky">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($medico = mysqli_fetch_assoc($result)) { ?>
                    <tr>

                        <?php $medico["ID_medico"] ?>

                        <td><?php echo $medico["Apellido_persona"], " ", $medico["Nombre_persona"] ?></td>

                        <td><?php echo $medico["Profesion_Descripcion"] ?></td>

                        <td><?php echo $medico["Especialidad_Descripcion"] ?></td>

                        <td><?php echo $medico["Nro_Matricula"] , " - ", $medico["Tipo_Matricula"] ?></td>

                        <td><?php echo $medico["Nro_Prestador"] ?></td>
                        <td><?php 
                            if ($_SESSION['area']=="Servicio") { ?>
                                <a href="eliminar_medico.php?id=<?php echo $medico["ID_medico"] ?>" class="botones">Eliminar</a>
                            <?php } ?>
                        <a href="modificar_medico.php?id=<?php echo $medico["ID_medico"] ?>" class="botones">Modificar</a></td>

                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
    
    
</body>

</html>