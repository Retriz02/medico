<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frame_pantallaPrincipal.css">

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
                            <td><b>Fecha: </b><?php echo date("d-m-Y"); ?> </p>
                            </td>
                            <td><b>Hora: </b><?php date_default_timezone_set('America/Argentina/Buenos_Aires');$DateAndTime = date('h:i:s a', time());echo "$DateAndTime."; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Usuario:</b>43444 </td>
                            <td><b>Area: </b>Auditoria Medica</td>
                        </tr>
                    </table>
                </div>
                <button>Cambiar Contraseña</button>
            </fieldset>
        </div>

        <div class="container-qr">
            <span class="title">Código QR</span>
            <div>
                <img src="./img/qr.svg" alt="">
            </div>
            <div class="container-links">
                <a href="#">
                    <input type="submit" class="ir" value="Compartir QR">
                </a>
            </div>
        </div>

        <?php
        require("medicos.php");

        $sql = "SELECT entrevista_medicos.*, domicilio.*, usuario.*, medico.*,persona.*
        FROM entrevista_medicos
        LEFT JOIN general.domicilio on entrevista_medicos.ID_domicilio_entrevistaMedico = domicilio.ID_domicilio
        LEFT JOIN general.usuario on entrevista_medicos.ID_usuario_entrevistaMedico = usuario.ID_usuario
        LEFT JOIN medicos.medico on entrevista_medicos.ID_medico_entrevistaMedico = medico.ID_medico
        LEFT JOIN general.persona on medico.ID_persona_medico = persona.ID_persona
        WHERE fecha = CURDATE()";
        $resultado = $mysqli->query($sql);

        ?>

        <div class="page-container">
            <div class="tittle">
                <p><b>Lista de las Entrevistas</b></p>
                
            </div>
            
            <div class="page-container">
        <div class="table-container">
            <table id="main-container" class="table-cebra">
                <thead>
                    <tr>
                        <th class="stiky">#</th>
                        <th class="stiky">Domicilio</th>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Usuario</th>
                        <th class="stiky">Fecha</th>
                        <th class="stiky">Hora</th>
                        <th class="stiky">Observación</th>
                        <th class="stiky">Eliminar</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($Entrevista = mysqli_fetch_assoc($resultado)) {
                    ?>
                        <tr>

                            <td><?php echo $Entrevista["ID_entrevistaMedico"] ?></td>

                            <td><?php echo $Entrevista["Calle"], " ", $Entrevista["Numero"] ?></td>

                            <td><?php echo $Entrevista["NombreP"], " ", $Entrevista["ApellidoP"] ?></td>

                            <td><?php echo $Entrevista["NombreP"], " ", $Entrevista["ApellidoP"] ?></td>

                            <td><?php echo $Entrevista["Fecha"] ?></td>

                            <td><?php echo $Entrevista["Horario"] ?></td>

                            <td><?php echo $Entrevista["Observacion"] ?></td>

                            <td><a href="eliminar_entrevista.php?id= <?php echo $Entrevista["ID_entrevistaMedico"] ?>"><button> Eliminar </button></a></td>
                            <td><a href="modificar_entrevista.php?id= <?php echo $Entrevista["ID_entrevistaMedico"] ?>"><button> Modificar </button></a></td>
                          

                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
          
    </div>
</body>

</html> 