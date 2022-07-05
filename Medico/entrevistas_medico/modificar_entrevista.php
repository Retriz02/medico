<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos_comercial/agregarEntrevistas.css">
    <title>Document</title>
</head>

<body>
    <?php 
        $varsesion = $_SESSION['usuario'];
        if ($varsesion == null || $varsesion = '') {
            header("location:../index.php");
        }else{
          //si la sesion es diferente al area con ID_area 2, lo manda a la pantalla principal (2 = Auditoria Medica)
          if($_SESSION['ID_area'] !=2){
              header('location: ../frames/frame_paginaPrincipal.php');
          }
        }
        require("../../database/db_comercial.php");

        $ID_entrevista = $_GET['id'];
        
        $sql = $mysqli->query("SELECT * FROM entrevistas WHERE ID_entrevista = $ID_entrevista");
    ?>
    
<div class="container">
    <div class="title">Modificar Entrevista</div>
    <form action="#" method="post">

      <fieldset>
        <legend>Promotor y Referido</legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Promotor</span>
            <select name="promotor" id="">
              <?php
              require("../../database/db_general.php");
              $promotor = $mysqli->query("SELECT usuarios.*, persona.Nombre_persona, persona.Apellido_persona, persona.DNI
              FROM usuarios
              left join persona on usuarios.ID_persona_usuario = persona.ID_persona order by Nombre_persona");
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
              require("../../database/db_comercial.php");
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
              require("../../database/db_comercial.php");
              $productos = $mysqli->query("SELECT * FROM productos ");
              while ($metodo = mysqli_fetch_row($productos)) {
              ?>
                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Estado Entrevista</span>
            <select name="estadoent" id="" required>
              <?php
              require("../../database/db_general.php");
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
            require("../../database/db_general.php");
            $domicilio = $mysqli->query("SELECT domicilio.*,localidades.*, tipobarrio.*, tipoedificio.*
              FROM domicilio 
              left join localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
              left join tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
              left join tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
            while ($metodo = mysqli_fetch_assoc($domicilio)) {
            ?>
              <option value="<?php echo $metodo['ID_domicilio'] ?>"><?php echo  "Provincia: " . $metodo['ID_provincia_localidad'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector/Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?></option>
            <?php } ?>
          </select><button id="open">+</button>
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

        require("../../database/db_comercial.php");

        $promotor = $_POST["promotor"];
        $referido = $_POST["referido"];
        $domicilio = $_POST["domicilio"];
        $producto = $_POST["producto"];
        $estado = $_POST["estadoent"];
        $fecha = $_POST["fecha"];
        $horario = $_POST["horario"];
        $observacion = $_POST["observaciones"];

        $modificarEntrevista = "UPDATE entrevistas SET ID_usuario_entrevista = '$promotor', ID_referido_entrevista = '$referido', ID_domicilio_entrevista = '$domicilio', ID_producto_entrevista = '$producto', ID_estado_entrevista = '$estado', Fecha = '$fecha', Horario = '$horario', Observaciones = '$observacion' WHERE ID_entrevista = '$ID_entrevista'";
        $resultado = $mysqli->query($modificarEntrevista);

        echo "<script type=\"text/javascript\"> window.location='listaEntrevistas.php';</script>";
    } ?>
</body>

</html>



