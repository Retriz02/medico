<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tablas</title>

    <link rel="stylesheet" href="../styles/estilo_listas.css">
</head>

<body>
    <?php
        session_start();

        if(!isset($_SESSION['area'])){
            header('location: login.php');
        }else{
            if($_SESSION['area'] !=2){
                header('location: login.php');
            }
        }
        require("medicos.php");
        require("general.php");

        $sq1 = "SELECT agenda.*, usuario.*, medico.*
        FROM agenda
        LEFT JOIN general.usuario on agenda.ID_usuario_agenda = usuario.ID_usuario
        LEFT JOIN medicos.medico on agenda.ID_medico_agenda = medico.ID_medico";
        $resultao1 = $conexion->query($sq1) or die ($conexion->error);
    ?>

    <div class="container">
        <div class="tittle">
            <p><b>Lista de la Agenda</b></p>
            <a href="agregar_agenda.php" target="paginaPrincipal">
                <input type="button" value="Agregar agenda" class="blue">
            </a>

        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Usuario</th>
                        <th class="stiky">Fecha</th>
                        <th class="stiky">Horario</th>
                        <th class="stiky">Observación</th>
                        <th class="stiky">Eliminar</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($agenda = mysqli_fetch_assoc($resultao1)) {

                        require("general.php");

                        $sql1= "SELECT * FROM persona where ID_persona =".$agenda['ID_persona_medico'];
                        $result= $conexionGeneral->query($sql1);
                        $medico = mysqli_fetch_assoc($result);

                        $sql2= "SELECT * FROM persona where ID_persona = ".$agenda['ID_persona_usuario'];
                        $result1= $conexionGeneral->query($sql2);
                        $usuario = mysqli_fetch_assoc($result1);
                    ?>
                    <tr>

                        <td><?php echo $medico["Apellido_persona"], " ", $medico["Nombre_persona"] ?></td>

                        <td><?php echo $usuario["Apellido_persona"], " ", $usuario["Nombre_persona"] ?></td>

                        <td><?php echo $agenda["Fecha"] ?></td>

                        <td><?php echo $agenda["Horario"] ?></td>

                        <td class="observacion" align="left"><?php echo $agenda["Observacion"] ?></td>

                        <td><a href="eliminarAgenda.php?id= <?php echo $agenda["ID_agenda"] ?>"><button type="button" class="red"> Eliminar </button></a></td>
                        <td><a href="modificarAgenda.php?id= <?php echo $agenda["ID_agenda"] ?>"><button type="button" class="green"> Modificar </button></a></td>
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>