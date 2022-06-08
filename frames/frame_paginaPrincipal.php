<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frame_pantallaPrincipal.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="container-datos">
            <fieldset class="fieldset">
                <legend>Datos Personales</legend>
                <div class="usuario-area">
                    <table>
                        <tr>
                            <td>
                                <b>Fecha:</b><?php echo date("d-m-Y"); ?>
                            </td>
                            <td><b>Hora: </b><?php date_default_timezone_set('America/Argentina/Buenos_Aires');
                                                $DateAndTime = date('h:i:s a', time());
                                                echo "$DateAndTime."; ?>
                            </td>

                            <td>
                                <img src="../img/qr.svg" alt="">
                                <br>
                                <a href=""><button>Compartir</button></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Usuario: </b><?php session_start();
                                                echo $_SESSION["nombreUsuario"] ?>
                            </td>

                            <td>
                                <b>Área: </b><?php echo $_SESSION["area"] ?>
                            </td>
                        </tr>

                    </table>
                </div>
            </fieldset>
        </div>
    </div>
    <?php

    $ID_usuario = $_SESSION["ID_usuario"];

    require("medicos.php");
   

    require("general.php");
    $sql = "SELECT tareas.*, estado.Descripcion_estado
    FROM tareas
    left join estado on tareas.ID_estado = estado.ID_estado
    where fecha = CURDATE() or ID_usuario = '$ID_usuario' order by fecha";
    $resultado2 = $mysqli->query($sql);
    ?>

    <div class="container">
        <div class="title">
            <p><b>Actividades del Día</b></p>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="stiky">Fecha</th>
                        <th class="stiky">Horario</th>
                        <th class="stiky">Observación</th>
                        <th class="stiky">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                  

                    <?php
                    while ($Tareas = mysqli_fetch_assoc($resultado2)) {
                    ?>
                        <tr>
                            <td><?php echo $Tareas["fecha"] ?></td>

                            <td><?php echo $Tareas["hora"] ?></td>

                            <td class="observacion" align="left"><?php echo $Tareas["Tarea_Descripcion"] ?></td>

                            <td class="red">Tareas</td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>