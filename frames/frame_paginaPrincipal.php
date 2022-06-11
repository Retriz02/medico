<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/frame_pantallaPrincipal.css">
  <link rel="stylesheet" href="../styles/estilo_ventanaEmergente.css">
  <title>OSDE</title>
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
              <td><b>Hora:</b>
                <span id="tiempo"><?php 
                  //Imprime la hora, es estatica y no se actualiza a menos que recargue la pagina manualmente, es solo para inicializar
                  date_default_timezone_set('America/Argentina/Buenos_Aires');
                    $DateAndTime = date('h:i:s a', time());
                    echo "$DateAndTime"; ?>
                </span>

                <!--y luego con este script hacemos que el tiempo se actualice constantemente-->
                <script>
                  setInterval(function () {
                    var currentTime = new Date();
                    var currentHours = currentTime.getHours();
                    var currentMinutes = currentTime.getMinutes();
                    var currentSeconds = currentTime.getSeconds();
                    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
                    var timeOfDay = (currentHours < 12) ? "am" : "pm";
                    currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
                    currentHours = (currentHours == 0) ? 12 : currentHours;
                    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay; //concatena los datos para establecer la hora actual
                    document.getElementById("tiempo").innerHTML =
                    currentTimeString; //esta linea actualiza el <span> que contiene la hora
                  }, 1000);
                </script>

              </td>

              <td>
                <img src="../img/qr.svg" alt=""><br>
                <a href=""><button>Compartir</button></a>
              </td>
            </tr>
            <tr>
              <td>
                <b>Usuario: </b>
                <!--Toma el usuario de la sesion-->
                <?php session_start();echo $_SESSION["nombreUsuario"]?>
              </td>

              <td>
                <!--Toma el area al que pertenece el usuario de la sesion-->
                <b>Área: </b><?php echo $_SESSION["area"] ?>
              </td>
            </tr>

          </table>
        </div>
        <button id="open">Cambiar Contraseña</button>
      </fieldset>
    </div>
  </div>


  <?php
  /*
  $ID_usuario = $_SESSION["ID_usuario"];

  require("../database/db_medico.php");
  $sql = "SELECT entrevistas.*, productos.descripcion_producto, estado.Descripcion_estado, persona.Nombre_persona, persona.Apellido_persona
        FROM entrevistas
        left join productos on entrevistas.ID_producto_entrevista = productos.ID_producto
        left join db_general.estado on entrevistas.ID_estado_entrevista = estado.ID_estado
        left JOIN referidos ON entrevistas.ID_referido_entrevista = referidos.ID_referido 
        left JOIN db_general.persona ON referidos.ID_persona_referido = persona.ID_persona
        where ID_usuario_entrevista = '$ID_usuario' and fecha = CURDATE() order by fecha";
  $resultado = $mysqli->query($sql);

  $sql = "SELECT eventos.*, estado.Descripcion_estado, persona.Nombre_persona, persona.Apellido_persona
    FROM eventos
    left join db_general.estado on eventos.ID_estado_evento= estado.ID_estado
    left JOIN referidos ON eventos.ID_referido_evento = referidos.ID_referido 
    left JOIN db_general.persona ON referidos.ID_persona_referido = persona.ID_persona
    where fecha = CURDATE() or ID_usuario_inicio_evento = '$ID_usuario' or ID_usuario_final_evento = '$ID_usuario' order by fecha";
  $resultado1 = $mysqli->query($sql);

  require("../../database/db_general.php");
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
          while ($Entrevistas = mysqli_fetch_assoc($resultado)) {
          ?>
          <tr>
            <td><?php echo $Entrevistas["fecha"] ?></td>

            <td><?php echo $Entrevistas["horario"] ?></td>

            <td class="datos"><?php echo $Entrevistas["observaciones"] ?></td>

            <td class="green">Entrevista</td>
          </tr>
          <?php  } ?>
          <?php
          while ($Eventos = mysqli_fetch_assoc($resultado1)) {
          ?>
          <tr>
            <td><?php echo $Eventos["fecha"] ?></td>

            <td><?php echo $Eventos["horario"] ?></td>

            <td class="observacion" align="left"><?php echo $Eventos["observaciones"] ?></td>

            <td class="blue">Eventos</td>
          </tr>
          <?php  } ?>

          <?php
          while ($Tareas = mysqli_fetch_assoc($resultado2)) {
          ?>
          <tr>
            <td><?php echo $Tareas["fecha"] ?></td>

            <td><?php echo $Tareas["horario"] ?></td>

            <td class="observacion" align="left"><?php echo $Tareas["observaciones"] ?></td>

            <td class="red">Tareas</td>
          </tr>
          <?php  } */?>
        </tbody>
      </table>
    </div>
  </div>


</body>

</html>