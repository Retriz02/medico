<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/agregar_entrevista.css">
    <link rel="stylesheet" href="../../node_modules/chosen-js/chosen.min.css">
    <title>Document</title>

</head>
<body>
<?php 
    session_start();

    $varsesion = $_SESSION['usuario'];
    if ($varsesion == null || $varsesion = '') {
        header("location:../index.php");
    }else{
      //si la sesion es diferente al area con ID_area 2, lo manda a la pantalla principal (2 = Auditoria Medica)
      if($_SESSION['ID_area'] !=2){
          header('location: ../frames/frame_paginaPrincipal.php');
      }
    }
    $datoUsuario = $_SESSION["ID_usuario"];
?>
  <div class="container">
    <div class="title">Agregar Entrevista</div>
    <form action="#" method="post">
      <fieldset>
        <legend>Medico</legend>
        <div class="user-details">
            <div class="input-box">
                <span class="details">Medico</span>
                <select name="medico" id="" required>
                  <?php
                    require("../database/db_medico.php");
                    $medico = $conexion->query("SELECT medico.*, persona.*
                    FROM medico
                    left join db_general.persona on medico.ID_persona_medico = persona.ID_persona");
                    while ($metodo = mysqli_fetch_assoc($medico)) {
                  ?>
                    <option value="<?php echo $metodo['ID_medico'] ?>"><?php echo $metodo['DNI'] . " - " . $metodo['Apellido_persona'] . " " . $metodo['Nombre_persona'] ?></option>
                  <?php } ?>
                </select>
                <a href="frame_agregarMedico.php" target="paginaPrincipal">
                  +
                </a>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Otros Datos</legend>
        <div class="user-details">
         
          <div class="input-box">
            <span class="details">Estado Entrevista</span>
            <select name="estadoent" id="" required>
              <?php
                require("../database/db_general.php");
                $est_entrevista = $conexionGeneral->query("SELECT * FROM estado");
                while ($metodo = mysqli_fetch_row($est_entrevista)) {
              ?>
                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Domicilio</legend>
        <div class="input-box-domicilio">
          <span class="details">Dirección</span>
          <select name="domicilio" id="" required>
            <?php
            require("../database/db_general.php");
            $domicilio = $conexionGeneral->query("SELECT domicilio.*,localidades.*, tipobarrio.*, tipoedificio.*
              FROM domicilio 
              left join localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
              left join tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
              left join tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
            while ($metodo = mysqli_fetch_assoc($domicilio)) {
            ?>
              <option value="<?php echo $metodo['ID_domicilio'] ?>"><?php echo  "Provincia: " . $metodo['ID_provincia_localidad'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector_Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?></option>
            <?php } ?>
          </select>
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
            <span class="details">Hora</span>
            <input type="time" class="fecha-horario" name="hora" required>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Observación</legend>
        <div class="user-details">
          <div class="observacion-box">
            <textarea class="textarea-observacion" placeholder="Describa sus observaciones..." maxlength="200" cols="10" rows="5" name="observaciones"></textarea>
          </div>
        </div>
      </fieldset>

      <div class="botones">
        <a href="lista_entrevista.php">Cancelar</a>
        <input type="submit" value="Aceptar" name="aceptar">
      </div>
    </form>
  </div>
  <?php
  if (isset($_POST["aceptar"])) {

    require("../database/db_medico.php");

    $medico = $_POST["medico"];
    $domicilio = $_POST["domicilio"];
    $estadoent = $_POST["estadoent"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $observacion = $_POST["observaciones"];
    $activo = 1;
    $nuevaEntrevista = "INSERT INTO entrevista_medicos(ID_domicilio_entrevistaMedico, ID_medico_entrevistaMedico, ID_usuario_entrevistaMedico, Fecha_entrevistaMedico, Hora_entrevistaMedico, Observacion_entrevistaMedico, ID_activo_entrevistaMedico, ID_estado_entrevistaMedico) VALUES 
        ('$domicilio','$medico','$datoUsuario','$fecha','$fecha','$hora','$observacion','$activo', '$estadoent')";
    $resultado = $conexion->query($nuevaEntrevista);

    echo "<script type=\"text/javascript\"> window.location='lista_ntrevista.php';</script>";
  } ?>

  <div id="modal_container" class="modal-container">
    <div class="container">
      <div class="title">Agregar Domicilio</div>
      <form action="#" method="post">

        <fieldset>
          <legend>Localidad</legend>
          <div class="user-details">
            <div class="input-box">
              <span class="details">Provincia</span>
              <select name="provincia" id="">
                <?php
                require("../database/db_general.php");
                $provincia = $conexionGeneral->query("SELECT * FROM provincias");
                while ($metodo = mysqli_fetch_row($provincia)) {
                ?>
                  <option value="<?php echo $metodo['0'] ?>"><?php echo $metodo['1'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="input-box">
              <span class="details">Localidad</span>
              <select name="localidad" id="">
                <?php
                require("../database/db_general.php");
                $localidad = $conexionGeneral->query("SELECT * FROM localidades ");
                while ($metodo = mysqli_fetch_row($localidad)) {
                ?>
                  <option value="<?php echo $metodo['0'] ?>"><?php echo $metodo['2'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>Barrio</legend>
          <div class="user-details">
            <table>
              <tr>
                <td class="details">Barrio</td>
                <td class="input-box">
                  <select name="barrio" id="" required>
                    <?php
                    require("../database/db_general.php");
                    $barrio = $conexionGeneral->query("SELECT * FROM barrios");
                    while ($metodo = mysqli_fetch_row($barrio)) {
                    ?>
                      <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[1] ?></option>
                    <?php } ?>
                  </select>
                </td>
                <td class="details">Manzana</td>
                <td class="input-box"><input type="text" name="manzana" required></td>
                <td class="details">Sector/Parcela</td>
                <td class="input-box"><input type="text" name="sectorparcela" required></td>
              </tr>
            </table>
          </div>
        </fieldset> 

        <fieldset>
          <legend>Edificio</legend>
          <div class="user-details">
            <table>
              <tr>
                <td class="details">Departamento</td>
                <td class="input-box"><input type="text" name="departamento" required></td>

                <td class="details">Piso</td>
                <td class="input-box"><input type="text" name="piso" required></td>

                <td class="details">Torre</td>
                <td class="input-box"><input type="text" name="torre" required></td>
              </tr>
            </table>
          </div>

        </fieldset>

        <fieldset>
          <legend>Domicilio</legend>
          <div class="user-details">
            <div class="input-box">
              <span class="details">Calle</span>
              <input type="text" name="calle" required>
            </div>
            <div class="input-box">
              <span class="details">Numero</span>
              <input type="text" name="numeroCalle" required>
            </div>
          </div>
        </fieldset>

        <div class="botones">
          <button id="close">Cerrar</button>
          <input type="submit" value="Aceptar" name="crearDomicilio">
        </div>
      </form>
      

    </div>

    <?php
    if (isset($_POST["crearDomicilio"])) {

      require("../database/db_general.php");
      $localidad = $_POST["localidad"];

      $barrio = $_POST["barrio"];
      $manzana = $_POST["manzana"];
      $sectorparcela = $_POST["sectorparcela"];

      $departamento = $_POST["departamento"];
      $piso = $_POST["piso"];
      $torre = $_POST["torre"];

      $calle = $_POST["calle"];
      $numeroCalle = $_POST["numeroCalle"];

      $nuevoBarrio = "INSERT INTO tipobarrio (ID_barrio_tipoBarrio, Manzana, Sector_Parcela) VALUES 
        ('$barrio', '$manzana', '$sectorparcela')";
      $resultado = $conexionGeneral->query($nuevoBarrio);

      $consultaBarrio = $conexionGeneral->query("SELECT MAX(ID_tipoBarrio) AS id FROM tipobarrio");
      if ($row = mysqli_fetch_row($consultaBarrio)) {
        $idTipoBarrio = trim($row[0]);
      }

      $nuevoDepartamento = "INSERT INTO tipoedificio (Departamento, Piso, Torre) VALUES 
        ('$departamento', '$piso', '$torre')";
      $resultado = $conexionGeneral->query($nuevoDepartamento);

      $consultaEdificio = $conexionGeneral->query("SELECT MAX(ID_tipoEdificio) AS id FROM tipoedificio");
      if ($row = mysqli_fetch_row($consultaEdificio)) {
        $idTipoEdificio = trim($row[0]);
      }

      $nuevoDomicilio = "INSERT INTO domicilio (ID_localidad_domicilio, ID_tipoBarrio_domicilio, ID_tipoEdificio_domicilio, Calle, Numero) VALUES 
        ('$localidad','$idTipoBarrio','1','$calle','$numeroCalle')";
      $resultado = $conexionGeneral->query($nuevoDomicilio);
    } ?>
  </div>

  <script src="../ventanasEmergentes.js"></script>

</body>

</html>