<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./estilos_comercial/agregarEntrevistas.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="title">Agregar Eventos</div>
    <form action="#" method="post">

      <fieldset>
        <legend>Promotor y Referido</legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Promotor Inicial</span>
            <select name="promotor_inicial" id="">
              <?php
              require("./database/db_general.php");
              $promotor = $mysqli->query("SELECT usuarios.*, persona.Nombre_persona, persona.Apellido_persona, persona.DNI
              FROM usuarios
              left join persona on usuarios.ID_persona_usuario = persona.ID_persona 
              where ID_persona_usuario = 7");
              while ($metodo = mysqli_fetch_assoc($promotor)) {
              ?>
                <option value="<?php echo $metodo['ID_usuario'] ?>"><?php echo $metodo['DNI'] . " - " . $metodo['Nombre_persona'] . " " . $metodo['Apellido_persona']  ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="input-box">
            <span class="details">Promotor Final</span>
            <select name="promotor_final" id="">
              <?php
              require("./database/db_general.php");
              $promotor = $mysqli->query("SELECT usuarios.*, persona.Nombre_persona, persona.Apellido_persona, persona.DNI
              FROM usuarios
              left join persona on usuarios.ID_persona_usuario = persona.ID_persona 
             ");
              while ($metodo = mysqli_fetch_assoc($promotor)) {
              ?>
                <option value="<?php echo $metodo['ID_usuario'] ?>"><?php echo $metodo['DNI'] . " - " . $metodo['Nombre_persona'] . " " . $metodo['Apellido_persona']  ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="input-box">
            <span class="details">Referido</span>
            <select name="referido" id="" required>
              <?php
              require("./database/db_comercial.php");
              $referido = $mysqli->query("SELECT referidos.*, persona.Nombre_persona, persona.Apellido_persona, persona.DNI
              FROM referidos
              left join db_general.persona on referidos.ID_persona_referido = persona.ID_persona");
              while ($metodo = mysqli_fetch_assoc($referido)) {
              ?>
                <option value="<?php echo $metodo['ID_referido'] ?>"><?php echo $metodo['DNI'] . " - " . $metodo['Apellido_persona'] . " " . $metodo['Nombre_persona'] ?></option>
              <?php } ?>
            </select>
            <a href="frame_referidoContactoDomicilio.php" target="paginaPrincipal">
              +
            </a>
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Otros Datos</legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Producto</span>
            <select name="producto" id="" required>
              <?php
              require("./database/db_comercial.php");
              $productos = $mysqli->query("SELECT * FROM productos ");
              while ($metodo = mysqli_fetch_row($productos)) {
              ?>
                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Estado Evento</span>
            <select name="estadoEvento" id="" required>
              <?php
              require("./database/db_general.php");
              $est_entrevista = $mysqli->query("SELECT * FROM estado");
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
            require("./database/db_general.php");
            $domicilio = $mysqli->query("SELECT domicilio.*,localidades.*, tipobarrio.*, tipoedificio.*
              FROM domicilio 
              left join localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
              left join tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
              left join tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
            while ($metodo = mysqli_fetch_assoc($domicilio)) {
            ?>
              <option value="<?php echo $metodo['ID_domicilio'] ?>"><?php echo  "Provincia: " . $metodo['ID_provincia_localidad'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector/Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?></option>
            <?php } ?>
          </select>
          <input type="submit" value="Ver" name="aceptar" id="">
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
            <textarea class="textarea-observacion" placeholder="Escriba sus observaciones..." maxlength="1000" cols="10" rows="5" name="observaciones"></textarea>
          </div>

        </div>
      </fieldset>

      <div class="botones">
        <a href="listaEntrevistas.php">Cancelar</a>
        <input type="submit" value="Aceptar" name="aceptar">
      </div>
    </form>
  </div>
  <?php
  if (isset($_POST["aceptar"])) {
    
    require("./database/db_comercial.php");

    $promotor_inicial = $_POST["promotor_inicial"];
    $promotor_final = $_POST["promotor_final"];
    $referido = $_POST["referido"];
    $domicilio = $_POST["domicilio"];
    $producto = $_POST["producto"];
    $estadoEvento = $_POST["estadoEvento"];
    $fecha = $_POST["fecha"];
    $horario = $_POST["horario"];
    $observacion = $_POST["observaciones"];

    $nuevoEvento = "INSERT INTO eventos (ID_usuario_inicio_evento,ID_usuario_final_evento, ID_referido_evento, ID_domicilio_Evento, ID_estado_evento, fecha, horario, observacion) VALUES 
    ('$promotor_inicial','$promotor_final','$referido','$domicilio','$estadoEvento','$fecha','$horario','$observacion')";
    $resultado = $mysqli->query($nuevoEvento);

    echo "<script type=\"text/javascript\"> window.location='listaEventos.php';</script>";
  } ?>

  <!-- VENTANAS EMERGENTES -->

  <div class="cont" id="cont">
    <div class="emer">
      <div class="title">Agregar Domicilio</div>
      <form action="#" method="post">
        <fieldset>
          <legend>Localidad</legend>
          <div class="user-details">
            <div class="input-box">
              <span class="details">Provincia</span>
              <select name="provincia" id="">
                <?php
                require("./database/db_general.php");
                $provincia = $mysqli->query("SELECT * FROM provincias");
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
                require("./database/db_general.php");
                $localidad = $mysqli->query("SELECT * FROM localidades");
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
                  <select name="producto" id="" required>
                    <?php
                    require("./database/db_general.php");
                    $barrio = $mysqli->query("SELECT * FROM barrios");
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
              <input type="text" name="numero" required>
            </div>
          </div>
        </fieldset>

        <div class="botones">
          <button id="close">Cerrar</button>
          <input type="submit" value="Aceptar" name="aceptar">
        </div>
      </form>
    </div>
  </div>
  


  <div class="cont" id="cont2">
    <div class="emer">
      <h1>Ventana Emergente</h1>
      Nombre <br>
      <input type="text" name=""><br>
      Apellido <br>
      <input type="text" name=""><br>
      <button id="close2">Cerrar</button>
    </div>
  </div>
  <script src="ventanasEmergentes.js"></script>
</body>

</html>