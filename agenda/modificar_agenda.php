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
  <div class="container">
    <div class="title">Modificar Agenda</div>
    <form action="#" method="post">
      <fieldset>
        <legend>Medico y Usuario</legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Medico</span>
            <select name="medico" id="">
              <?php
                require("medicos.php");
                $medico = $conexion->query("SELECT medico.*, persona.*
                FROM medico
                LEFT JOIN general.persona on medico.ID_persona_medico = persona.ID_persona order by NombreP");
                
                while ($metodo = mysqli_fetch_assoc($medico)) {
              ?>

              <option value="<?php echo $metodo['ID_medico'] ?>">
                <?php echo $metodo['DNI'] . " - " . $metodo['NombreP'] . " " . $metodo['ApellidoP']  ?></option>
              <?php } ?>
              
            </select>
          </div>

          <div class="input-box">
            <span class="details">Usuario</span>
            <select name="usuario" id="">
              <?php
              require("general.php");
              $usuario = $conexionGeneral->query("SELECT usuario.*, persona.NombreP, persona.ApellidoP, persona.DNI
              FROM usuario
              LEFT JOIN persona on usuario.ID_persona_usuario = persona.ID_persona order by NombreP");
              while ($metodo1 = mysqli_fetch_assoc($usuario)) {
              ?>
              <option value="<?php echo $metodo1['ID_usuario'] ?>">
                <?php echo $metodo1['DNI'] . " - " . $metodo1['NombreP'] . " " . $metodo1['ApellidoP']  ?></option>
              <?php } ?>
            </select>
          </div>

          <fieldset>
            <legend>Domicilio</legend>

            <div class="input-box-domicilio">
              <span class="details">Dirección</span>
              <select name="domicilio" id="" required>
                <?php
            require("general.php");
            $domicilio = $conexionGeneral->query("SELECT domicilio.*,localidades.*, tipobarrio.*, tipoedificio.*
              FROM domicilio 
              LEFT JOIN localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
              LEFT JOIN tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
              LEFT JOIN tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
            while ($metodo = mysqli_fetch_assoc($domicilio)) {
            ?>
                <option value="<?php echo $metodo['ID_domicilio'] ?>">
                  <?php echo  "Provincias: " . $metodo['ID_provincia_localidad'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector/Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?>
                </option>
                <?php } ?>
              </select>
              <button id="">Ver</button>
              <button id="open">+</button>
            </div>
          </fieldset>

          <fieldset>
            <legend>Fecha y Hora</legend>
            <div class="user-details">
              <div class="input-box">
                <span class="details">Fecha</span>
                <input type="date" class="fecha-horario" name="fecha" required>
              </div>
              <div class="input-box">
                <span class="details">Horario</span>
                <input type="time" class="fecha-horario" name="horario" required>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Observación</legend>
            <div class="user-details">
              <div class="observacion-box">
                <textarea class="textarea-observacion" placeholder="Escriba sus observaciones..." maxlength="1000"
                  cols="10" rows="5" name="observaciones"></textarea>
              </div>

            </div>
          </fieldset>

          <div class="botones">
            <a href="listaAgenda1.php">Cancelar</a>
            <input type="submit" value="Aceptar" name="aceptar">
          </div>
    </form>
  </div>
  <?php
  if (isset($_POST["aceptar"])) {
 
        require("medicos.php");
        
        $ID_agenda = $_GET["id"];
        $medico = $_POST["medico"];
        $usuario = $_POST["usuario"];
        $domicilio = $_POST["domicilio"];
        $fecha = $_POST["fecha"];
        $horario = $_POST["horario"];
        $observacion = $_POST["observaciones"];

        $modificarAgenda= "UPDATE agenda SET  
        ID_medico_agenda = '$medico',
        ID_usuario_agenda = '$usuario',  
        ID_domicilio_agenda = '$domicilio',  
        fecha = '$fecha', Horario = '$horario', 
        observacion = '$observacion' WHERE ID_agenda = '$ID_agenda'";
        $resultado = $conexion->query($modificarAgenda);

        echo "<script type=\"text/javascript\"> window.location='listaAgenda1.php';</script>";
        
  
  } ?>


</body>

</html>