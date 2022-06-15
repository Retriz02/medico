<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/agregar_tarea.css">
 
  <title>Document</title>
</head>
<body>
  <?php 
      session_start();      
      //si no existe una sesion lo lleva al login
      $varsesion = $_SESSION['usuario'];
      if ($varsesion == null || $varsesion = '') {
          header("location:../index.php");
      }
      
      $datoUsuario = $_SESSION["ID_usuario"];
    ?>
  <div class="container">
    <div class="title">Agregar Agenda</div>
    <form action="#" method="post">
      <fieldset>
        <div class="user-details">

          <!-- Usuario -->
          <div class="input-box">
            <span class="details">Usuario</span>
            <input type="text" readonly value="<?php echo $_SESSION['apellido']." ".$_SESSION['nombre']; ?>">
          </div>

          <!-- Medico -->
          <div class="input-box">
            <span class="details">Medico</span>
            <select name="medico">
              <?php
                require("../database/db_medico.php"); //

                $medico = $conexion->query("SELECT medico.*, persona.*
                FROM medico
                LEFT JOIN db_general.persona on medico.ID_persona_medico = persona.ID_persona order by Apellido_persona");
                while ($metodo = mysqli_fetch_assoc($medico)) {
              ?>
              <option value="<?php echo $metodo['ID_medico'] ?>">
                <?php echo $metodo['DNI'] . " - " . $metodo['Apellido_persona'] . " " . $metodo['Nombre_persona']  ?>
              </option>
              <?php } ?>
            </select>
          </div>

          <!-- Fecha -->
          <div class="input-box">
            <span class="details">Fecha</span>
            <input type="date" class="fecha-horario" name="fecha" required>
          </div>

          <!-- Hora -->
          <div class="input-box">
            <span class="details">Hora</span>
            <input type="time" class="fecha-horario" name="hora" required>
          </div>

          <!-- Estado -->
          <div class="input-box">
            <span class="details">Estado Agenda</span>
            <select name="estado" id="" required>
              <?php
                require("../database/db_general.php");
                $est_tarea = $conexionGeneral->query("SELECT * FROM estado");
                while ($metodo = mysqli_fetch_row($est_tarea)) {
              ?>
              <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
              <?php } ?>
            </select>
          </div>

          <!-- Descripcion -->
          <div class="observacion-box">
            <span class="details">Descripción</span>
            <textarea class="textarea-observacion" placeholder="Describa su agenda..." maxlength="200" cols="10" rows="5"
              name="descripcion"></textarea>
          </div>

        </div>
      </fieldset>

      <div class="botones">
        <a href="lista_agenda.php">Cancelar</a>
        <input type="submit" value="Aceptar" name="aceptar">
      </div>
    </form>
  </div>
  <?php
  if (isset($_POST["aceptar"])) {
    
    require("../database/db_medico.php");

    $medico = $_POST["medico"];
    $usuario = $datoUsuario;
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST['estado'];

    $nuevaAgenda = "INSERT INTO agenda(ID_medico_agenda, ID_usuario_agenda, Fecha_agenda, Hora_agenda, Descripcion_agenda, ID_estado_agenda) VALUES 
    ('$medico','$usuario','$fecha','$hora','$descripcion','$estado')";
    $resultado = $conexion->query($nuevaAgenda);

    echo "<script type=\"text/javascript\"> window.location='lista_agenda.php';</script>";
  } ?>


</body>

</html>