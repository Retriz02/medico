<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos_comercial/agregarEntrevistas.css">
  <link rel="stylesheet" href="../../chosen/css/chosen.css">

  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="title">Agregar Domicilio</div>
    <form action="#" method="post">
      <fieldset>
        <legend>Localidad</legend>
        <div class="user-details">
        
            <span class="details">Provincia y Localidad</span>
            <select name="localidad" class="SearchSelect" >
              <?php
              // Llamamos a la base de datos 
              require("../../database/db_general.php");
              $localidad = $mysqli->query(
              "SELECT localidades.*, provincias.*
              FROM localidades 
              left join provincias on localidades.ID_provincia_localidad = provincias.ID_provincia ");// Seleccionamos las tablas a utilizar 

              //Mientas que el array tenga contenido itera para imprimir todos los datos que se obtinen de la consulta $localidad
              while ($metodo = mysqli_fetch_assoc($localidad)) {
              ?>
                <option value="<?php echo $metodo['ID_localidad'] ?>"><?php echo "Provincia: " .$metodo['Nombre_provincia'] ." --- Localidad: ". $metodo['Nombre_localidad']?></option> <!-- Esto evalua la posicion de los datos -->
              <?php } ?>
            </select>
            <input type="button" onclick="location.href='./agregarLocalidad.php'" value="+">
         
        </div>
      </fieldset>

      <fieldset>
        <legend>Barrio</legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Barrio</span>
            <select name="barrio" class="SearchSelect" >
              <?php
               // Llamamos a la base de datos 
              require("../../database/db_general.php");
              $barrio = $mysqli->query("SELECT * FROM barrios");  // Seleccionamos las tablas a utilizar 

              //Mientas que el array tenga contenido itera para imprimir todos los datos que se obtinen de la consulta $barrio
              while ($metodo = mysqli_fetch_row($barrio)) {
              ?>
                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[1] ?></option> <!-- Esto evalua la posicion de los datos -->
              <?php } ?>
            </select>
            <a href="agregarBarrio.php">+</a>

          </div>
          <div class="input-box">
            <span class="details">Manzana</span>
            <input type="text" name="manzana" > <!-- Aqui creamos una caja de texto donde podra colocar la mazana de casa -->
          </div>
          <div class="input-box">
            <span class="details">Sector Parcela</span> <!-- Aqui creamos una caja de texto donde podra colocar sector o parcela de donde vivi -->
            <input type="text" name="sectorparcela">
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Edificio</legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Departamento</span> 
            <input type="text" name="departamento" > <!-- Aqui creamos una caja de texto donde podra colocar el departamento donde vivi -->
            </select>
          </div>
          <div class="input-box">
            <span class="details">Piso</span>
            <input type="number" name="piso" > <!-- Creamos una caja de texto donde podra colocar el piso en el que vivi -->
          </div>
          <div class="input-box">
            <span class="details">Torre</span> <!-- Creamos una caja de texto donde podra colocar la torre donde vivi -->
            <input type="text" name="torre" >
          </div>
        </div>
      </fieldset>

      <fieldset>
        <legend>Domicilio</legend>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Calle</span> <!-- Creamos una caja de texto para colocar la calle -->
            <input type="text" name="calle" >
          </div>
          <div class="input-box">
            <span class="details">Numero</span>
            <input type="number" name="numeroCalle" > <!-- Creamos una caja de tipo numerico para que pueda introducir el número de la calle -->
          </div>
        </div>
      </fieldset>

      <div class="botones">
        <input type="button" onclick="location.href='./rellenar.php'" value="Cancelar"> <!-- Creamos un boton cancelar la cual nos va a permitir cancelar el agregar de un nuevo domiciio -->
        <input type="submit" value="Aceptar" name="crearDomicilio"> <!-- Aqui creamos un boton aceptar lo cual nos permitira agregar un nuevo domicilio -->
      </div>
    </form>
  </div>

  <!--Estos script hacen que es select con buscador funcione-->
  <script src="../../chosen/js/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="../../chosen/js/chosen.jquery.js" type="text/javascript"></script>
  <script> $(".SearchSelect").chosen(); // SearchSelect es el nombre del class del elemento al cual se le integra la funcion</script>

  <?php
  // Si existe una acción en el boton aceptar realiza la siguiente acción
  if (isset($_POST["crearDomicilio"])) {

    // Llamamos a la base de datos 
    require("../../database/db_general.php");

    // Traemos todos los datos ingresados y los guardamos en variables
    $localidad = $_POST["localidad"];

    $barrio = $_POST["barrio"];
    $manzana = $_POST["manzana"];
    $sectorparcela = $_POST["sectorparcela"];

    $departamento = $_POST["departamento"];
    $piso = $_POST["piso"];
    $torre = $_POST["torre"];

    $calle = $_POST["calle"];
    $numeroCalle = $_POST["numeroCalle"];
 
    // Con esta linia de codigos lo que se hace es insertar los datos del barrio
    $nuevoBarrio = "INSERT INTO tipobarrio (ID_barrio_tipoBarrio, Manzana, Sector_Parcela) VALUES 
        ('$barrio', '$manzana', '$sectorparcela')";
    $resultado = $mysqli->query($nuevoBarrio);

    /// Permite hallar el último ID insertado en la tabla de tipobarrio
    $consultaBarrio = $mysqli->query("SELECT MAX(ID_tipoBarrio) AS id FROM tipobarrio");
    if ($row = mysqli_fetch_row($consultaBarrio)) {
      $idTipoBarrio = trim($row[0]);
    }

    // Con esta linia de codigos lo que se hace es insertar los datos del edificio
    $nuevoDepartamento = "INSERT INTO tipoedificio (Departamento, Piso, Torre) VALUES 
        ('$departamento', '$piso', '$torre')";
    $resultado = $mysqli->query($nuevoDepartamento);

    // Permite hallar el último ID insertado en la tabla de tipoEdificio
    $consultaEdificio = $mysqli->query("SELECT MAX(ID_tipoEdificio) AS id FROM tipoedificio");
    if ($row = mysqli_fetch_row($consultaEdificio)) {
      $idTipoEdificio = trim($row[0]);
    }

    // Con esta linia de codigos lo que se hace es insertar todos los datos anteriores en una sola variable para poder mostrarla 
    $nuevoDomicilio = "INSERT INTO domicilio (ID_localidad_domicilio, ID_tipoBarrio_domicilio, ID_tipoEdificio_domicilio, Calle, Numero) VALUES 
        ('$localidad','$idTipoBarrio','$idTipoEdificio','$calle','$numeroCalle')";
    $resultado = $mysqli->query($nuevoDomicilio);

    echo "<script> window.location='./rellenar.php';</script>"; // Se nos redireccionara a rellenar.php
  } ?>
</body>

</html>