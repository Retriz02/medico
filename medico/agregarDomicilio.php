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
                require("../../database/db_general.php");
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
                require("../../database/db_general.php");
                $localidad = $mysqli->query("SELECT * FROM localidades ");
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
                    require("../../database/db_general.php");
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
              <input type="text" name="numeroCalle" required>
            </div>
          </div>
        </fieldset>

        <div class="botones">
         <a href="rellenar.php">Cancelar</a>
          <input type="submit" value="Aceptar" name="crearDomicilio">
        </div>
      </form>
    </div>

    <?php
    if (isset($_POST["crearDomicilio"])) {

      require("../../database/db_general.php");
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
      $resultado = $mysqli->query($nuevoBarrio);

      $consultaBarrio = $mysqli->query("SELECT MAX(ID_tipoBarrio) AS id FROM tipobarrio");
      if ($row = mysqli_fetch_row($consultaBarrio)) {
        $idTipoBarrio = trim($row[0]);
      }

      $nuevoDepartamento = "INSERT INTO tipoedificio (Departamento, Piso, Torre) VALUES 
        ('$departamento', '$piso', '$torre')";
      $resultado = $mysqli->query($nuevoDepartamento);

      $consultaEdificio = $mysqli->query("SELECT MAX(ID_tipoEdificio) AS id FROM tipoedificio");
      if ($row = mysqli_fetch_row($consultaEdificio)) {
        $idTipoEdificio = trim($row[0]);
      }


      $nuevoDomicilio = "INSERT INTO domicilio (ID_localidad_domicilio, ID_tipoBarrio_domicilio, ID_tipoEdificio_domicilio, Calle, Numero) VALUES 
        ('$localidad','$idTipoBarrio','$idTipoEdificio','$calle','$numeroCalle')";
      $resultado = $mysqli->query($nuevoDomicilio);

      echo "<script type=\"text/javascript\"> window.location='rellenar.php';</script>";
    } ?>
</body>

</html>
