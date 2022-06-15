<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/agregar_entrevista.css">
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

        require("../database/db_medico.php");
        $datoUsuario = $_SESSION["ID_usuario"];

        $ID_agenda = $_GET['id'];
        $sql = $conexion->query("SELECT * FROM agenda WHERE ID_agenda = $ID_agenda");
        $dato = mysqli_fetch_assoc($sql);
    ?>

  <div class="container">
    <div class="title">Modificar Agenda</div>
    <form action="#" method="post">

      <fieldset>
        <legend></legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Usuario</span>
            <input type="text" readonly value="<?php echo $_SESSION['apellido']." ".$_SESSION['nombre']; ?>">
          </div>
          <div class="input-box">
            <span class="details">Medico</span>
            <select name="medico" id="">
              <?php
                require("../database/db_medico.php");

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

          <div class="input-box">
            <span class="details">Estado Tarea</span>
            <select name="estado" id="" required>
              <?php
                require("../database/db_general.php");
                $est_tarea = $conexionGeneral->query("SELECT * FROM estado");
                while ($metodo = mysqli_fetch_row($est_tarea)) {
              ?>
              <option value="<?php echo $metodo[0] ?>"
                <?php if ($metodo[0] == $dato['ID_estado_agenda']) echo 'selected' ?>>
                <?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="input-box">
            <span class="details">Fecha</span>
            <input type="date" class="fecha-horario" name="fecha" required value=<?php echo $dato["Fecha_agenda"]; ?>>
          </div>
          <div class="input-box">
            <span class="details">Horario</span>
            <input type="time" class="fecha-horario" name="hora" required value=<?php echo $dato["Hora_agenda"]; ?>>
          </div>

          <div class="observacion-box">
            <span class="details">Descripción</span>
            <textarea class="textarea-observacion" placeholder="Describa la Agenda..." maxlength="200" cols="10"
              rows="5" name="descripcion"><?php echo $dato["Descripcion_tarea"]; ?></textarea>
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
        $decripcion = $_POST["descripcion"];
        $estado = $_POST["estado"];

        $modificarAgenda= "UPDATE agenda SET  
        ID_medico_agenda = '$medico',
        ID_usuario_agenda = '$usuario',  
        Fecha_agenda = '$fecha', 
        Hora_agenda = '$hora', 
        Descripcion_agenda = '$decripcion'
        ID_estado_agenda = '$estado' WHERE ID_agenda = '$ID_agenda'";
        $resultado = $conexion->query($modificarAgenda);

        
    } ?>
</body>

</html>