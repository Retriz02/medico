<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/framePantalla_Principal.css">


  <title>Document</title>
</head>

<body>
  <?php
  session_start();
  $ID_usuario = $_SESSION["ID_usuario"];

  require("../database/db_general.php");
  $sql = "SELECT * FROM usuarios WHERE ID_usuario = $ID_usuario";
  $resultado = $conexionGeneral->query($sql);
  $dato = $resultado->fetch_assoc();
  ?>

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
        <a href="../contraseña/camContraseña.php"><button>Cambiar Contraseña</button></a>
        <a href="../verQR.php"><button>Ver QR</button></a>
      </fieldset>
    </div>
  </div>


  <?php
  /*

  require("../database/db_medico.php");
  $sql = "SELECT entrevista_medicos*, estado.Descripcion_estado, persona.*
        FROM entrevista_medicos
        left join db_general.estado on entrevista_medico.ID_estado_entrevista = estado.ID_estado
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
  */
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
       
      </table>
    </div>
  </div>
</body>

</html>