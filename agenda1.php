<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda</title>

    <link rel="stylesheet" href="estiloTablas.css">

</head>

<body>
<?php

require("medicos.php");
$sql = "SELECT agenda.*, estado.Descripcion_estado
FROM agenda
LEFT JOIN general.estado on agenda.ID_estado_agenda = estado.ID_estado";
$resultado = $conexion->query($sql);

?>
    <div class="container">
        <div class="tittle">
            <p>Lista de las Entrevistas
                <a href="agregarAgenda.php" target="paginaPrincipal">
                    <input type="button" value="Agregar" class="blue">
                </a>
            </p>
            
            
        </div>
        <div class="table-container">
            <table id="main-container" class="table-cebra">
                <thead>
                    <tr>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Usuario</th>
                        <th class="stiky">Estado</th>
                        <th class="stiky">Fecha</th>
                        <th class="stiky">Horario</th>
                        <th class="stiky">Observación</th>
                        <th class="stiky">Eliminar</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($agenda = mysqli_fetch_assoc($resultado)) {

                        require("general.php");
                          
                        $sql1= "SELECT * FROM persona where ID_persona =".$agenda['ID_medico_agenda'];
                        $result= $conexionGeneral->query($sql1);
                        $medico = mysqli_fetch_assoc($result);

                        $sql2= "SELECT * FROM persona where ID_persona = ".$agenda['ID_usuario_agenda'];
                        $result1= $conexionGeneral->query($sql2);
                        $usuario = mysqli_fetch_assoc($result1);

                    ?>
                        <tr>
                            
                            <td><?php echo $medico["Nombre_persona"], " ", $medico["Apellido_persona"] ?></td>
                            <td><?php echo $usuario["Nombre_persona"], " ", $usuario["Apellido_persona"] ?></td>
                            <td><?php echo $agenda["Descripcion_estado"] ?></td>
                            <td><?php echo $agenda["fecha"] ?></td>
                            <td><?php echo $agenda["horario"] ?></td>
                            <td><?php echo $agenda["observacion"] ?></td>


                           
                            <td><a href="eliminarEvento.php?id=<?php echo $agenda["ID_agenda"] ?>"><button type="button" class="red"> Eliminar </button></a></td>
                            <td><a href="modificarEvento.php?id=<?php echo $agenda["ID_agenda"] ?>"><button type="button" class="green"> Modificar </button></a></td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

