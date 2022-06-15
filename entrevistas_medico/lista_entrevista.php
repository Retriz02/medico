<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tablas</title>
    <link rel="stylesheet" href="../styles/estilo_listas.css">
</head>
<?php 
    session_start();
    $datoUsuario = $_SESSION["ID_usuario"];

    require("../database/db_medico.php");
    require("../database/db_general.php");
?>

<body>
    <?php
        $sql = "SELECT entrevista_medicos.*, domicilio.*, usuarios.*, medico.*, estado.*
        FROM entrevista_medicos
        LEFT JOIN db_general.estado on entrevista_medicos.ID_estado_entrevistaMedico = estado.ID_estado
        LEFT JOIN db_general.domicilio on entrevista_medicos.ID_domicilio_entrevistaMedico = domicilio.ID_domicilio
        LEFT JOIN db_general.usuarios on entrevista_medicos.ID_usuario_entrevistaMedico = usuarios.ID_usuario
        LEFT JOIN medico on entrevista_medicos.ID_medico_entrevistaMedico = medico.ID_medico
        where ID_usuario_entrevistaMedico = $datoUsuario and ID_activo_entrevistaMedico = 1";
        
        $resultado = $conexion->query($sql) or die ($conexion->error);
    ?>
    <div class="container">
        <div class="title">
            <p><b>Lista de las Entrevistas</b></p>
            <a href="agregar_entrevista.php" target="paginaPrincipal">
                <input type="button" value="Agregar Entrevista" class="blue">
            </a>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Fecha</th>
                        <th class="stiky">Hora</th>
                        <th class="stiky">Observación</th>
                        <th class="stiky">Opciones</th>
                        <th class="stiky">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($Entrevista = mysqli_fetch_assoc($resultado)) {
                            $sql1= "SELECT * FROM persona where ID_persona =".$Entrevista['ID_persona_medico'];
                            $result= $conexionGeneral->query($sql1);
                            $medico = mysqli_fetch_assoc($result);
                    ?>
                    <tr>

                        <?php $Entrevista["ID_entrevistaMedico"] ?>

                        <td><?php echo $medico["Nombre_persona"], " ", $medico["Apellido_persona"] ?></td>

                        <td><?php echo $Entrevista["Fecha_entrevistaMedico"] ?></td>

                        <td><?php echo $Entrevista["Hora_entrevistaMedico"] ?></td>

                        <td><?php echo $Entrevista["Observacion_entrevistaMedico"] ?></td>

                        <?php 
                            if($Entrevista['Descripcion_estado'] == "Abierto"){
                                echo "<td class='yellow'>".$Entrevista["Descripcion_estado"]. "</td>";
                            }
                            if($Entrevista['Descripcion_estado'] == "Cerrado"){
                                echo "<td class='green'>". $Entrevista["Descripcion_estado"]. "</td>" ;
                            }
                            if($Entrevista['Descripcion_estado'] == "Cancelado"){
                                echo "<td class='red'>".$Entrevista["Descripcion_estado"]. "</td>" ;
                            }
                            if($Entrevista['Descripcion_estado'] == "Postergado"){
                                echo "<td class='orange'>". $Entrevista["Descripcion_estado"]."</td>" ;
                            }
                        ?>

                        <td>
                            <a href="eliminar_entrevista.php?id=<?php echo $Entrevista["ID_entrevistaMedico"] ?>" class="botones">Eliminar</a>
                            <a href="modificar_entrevista.php?id=<?php echo $Entrevista["ID_entrevistaMedico"] ?>" class="botones">Modificar</a>
                        </td>

                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>