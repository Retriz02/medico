<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/agregar_tarea.css">
  <link rel="stylesheet" href="../../chosen/css/chosen.css">

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

      $datoUsuario = $_SESSION["ID_usuario"]; //guardamos la sesion del usuario en una variable
    ?>
  <div class="container">
    <div class="title">Agregar Agenda</div>
    <form action="" method="POST">
      <fieldset>
        <div class="user-details">

          <!-- Usuario -->
          <div class="input-box">
            <span class="details">Usuario</span>
            <!--Se imprime el apellido y nombre del usuario que tiene iniciada la sesion, esto esta declarado en el archivo comprobarLogin.php-->
            <input type="text" readonly value="<?php echo $_SESSION['apellido']." ".$_SESSION['nombre']; ?>">
          </div>

          <!-- Medico -->
          <div class="input-box">
            <span class="details">Medico</span>
            <select class="SearchSelect" name="medico">
              <?php
                require("../database/db_medico.php"); //Se requiere de la base de dato para continuar
                // seleccionamos las tablas que necesitamos
                // De la tabla medico comparamos su ID_persona_medico con el ID_persona que se encuetra registrado en la tabla personas y lo ordenamos por el apellido 
                $medico = $conexion->query("SELECT medico.*, persona.* 
                FROM medico 
                LEFT JOIN db_general.persona on medico.ID_persona_medico = persona.ID_persona order by Apellido_persona");
                //Se iterara mientras la variable $metodo (array) tenga contenido
                while ($metodo = mysqli_fetch_assoc($medico)) {
              ?>
              <!--Del array $metodo tomamos el ID_medico para utilizarlo como el valor de la opcion y luego se imprimen sus datos personales-->
              <option value="<?php echo $metodo['ID_medico']?>"><?php echo $metodo['DNI'] . " - " . $metodo['Apellido_persona'] . " " . $metodo['Nombre_persona']?></option>
              <?php } ?> <!--Se cierra la iteracion-->
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

                $est_tarea = $conexionGeneral->query("SELECT * FROM estado"); // seleccionamos todo de la tabla estado
                //Se iterara mientras la variable $metodo1 (array) tenga contenido
                while ($metodo1 = mysqli_fetch_row($est_tarea)) {
              ?>
              <!--Del array $metodo1 tomamos el ID_estado para utilizarlo como el valor de la opcion y luego se imprimen sus descripciones-->
              <option value="<?php echo $metodo1[0] ?>"><?php echo $metodo1[0] . " - " . $metodo1[1]  ?></option>
              <?php } ?>   <!--Se cierra la iteracion-->
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
        <input type="button" onclick="location.href='lista_agenda.php'" value="Cancelar">
        <input type="submit" value="Aceptar" name="aceptar">
      </div>
    </form>
  </div>

  <!--Estos script hacen que es select con buscador funcione-->
  <script src="../../chosen/js/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="../../chosen/js/chosen.jquery.js" type="text/javascript"></script>
  <script> $(".SearchSelect").chosen(); // SearchSelect es el nombre del class del elemento al cual se le integra la funcion</script>

  <?php 

  if (isset($_POST["aceptar"])) {
    
    require("../database/db_medico.php"); 

    $medico = $_POST["medico"]; //toma del formulario el dato del elemento que tenga como name "medico"
    $usuario = $datoUsuario;  //Declara $usuario a la variable $datoUsuario que guarda la session con el ID_usuario
    $fecha = $_POST["fecha"]; //toma del formulario el dato del elemento que tenga como name "fecha"
    $hora = $_POST["hora"]; //toma del formulario el dato del elemento que tenga como name "hora"
    $descripcion = $_POST["descripcion"]; //toma del formulario el dato del elemento que tenga como name "descripcion"
    $estado = $_POST['estado'];   //toma del formulario el dato del elemento que tenga como name "estado"

    $nuevaAgenda = "INSERT INTO agenda(ID_medico_agenda, ID_usuario_agenda, Fecha_agenda, Hora_agenda, Descripcion_agenda, ID_estado_agenda) VALUES 
    ('$medico','$usuario','$fecha','$hora','$descripcion','$estado')";
    $resultado = $conexion->query($nuevaAgenda);

    //Redirecciona a la lista luego de hacer la insercion
    echo "<script type=\"text/javascript\"> window.location='lista_agenda.php';</script>";
  } ?>


</body>

</html>