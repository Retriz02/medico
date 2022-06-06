<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Secretaria</title>
    <link rel="stylesheet" href="./styles/agregarMedicos.css">
</head>

<body>
    <div class="Global">
      <div class="contenedor">
          <h1 class="title-secretaria">Agregar Secretaria</h1>
          <form  action="" method="post">
              <fieldset><legend>Datos Profesionales De Secretaria</legend>
              
              <div class="contenedorsecretaria">
                  <div class=cont-secretaria>
                     <div class="cont-dato-secretaria">

                        <select value="" class="selectSecretaria" name="secretaria">
                            <option value="0">Seleccione la Secretaria</option>                            
                            <option value="1">Acuña Melani</option>
                            <option value="2">Gonzalez Ariadna Elizabeth</option>
                        </select>

                      <button class="btn-agregar">+</button>

                       <div class="selectTipodomicilio">
                            <select value="" class="selectTipodomicilio" name="tipodomicilio">
                                <option value="0">Domicilio Laboral</option>
                                <option value="1">Consultorio</option>
                                <option value="2">Sanatorio</option>
                            </select>
                       </div>

                       <div class="cont-nombredomicilio">
                            <p>
                                <input type="text" class="input-Nombredomicilio" placeholder="Nombre Domicilio"
                                    name="nombredomicilio" maxlenght=10 >
                            </p>
                        </div>

                       <div class="cont-fechalaboral">
                                  <p>
                                      <input type="text" class="input-Fechalaboral" placeholder="Fechas Laborales"
                                      name="fechalaboral" maxlenght=10>
                                      
                                  </p>
                       </div>
                       <div class="selectHorariolaboral">
                             <p>
                                <input type="text" class="input-horariolaboral" placeholder="Horario Laboral"
                                    name="horariolaboral" maxlenght=10 >
                            </p>
                       </div>
                       <div class="selectTurnolaboral">
                                    <select value="" class="selectTurnolaboral" name="turnolaboral">
                                        <option value="0">Turno Laboral Asignado</option>
                                        <option value="1">Turno Mañana 1</option>
                                        <option value="2">Turno Tarde 2</option>
                                        <option value="3">Turno Nocturno 3</option>
                                    </select>
                       </div>
                       <div class="cont-contactosecretaria">
                            <p>
                                <input type="text" class="input-Contactosecretaria" placeholder="Contacto De La Secretaria"
                                    name="contactosecretaria" maxlenght=15 >
                            </p>
                        </div>
                  </div>
              </div>
              </fieldset>
              <div class="botones">
                   <input type="submit" class="btn-cancelar" name="cancelar" value="Cancelar">
                    <input type="submit" class="btn-aceptar" name="aceptar" value="Aceptar">
                </div>
          </form>

    <?php
    if (isset($_POST["aceptar"])) {
        require("secretaria.php");

        $secretaria = $_POST["secretaria"];
        $tipodomicilio = $_POST["tipodomicilio"];
        $nombredomicilio = $_POST["nombredomicilio"];
        $fechalaboral = $_POST["fechalaboral"];
        $horariolaboral = $_POST["horariolaboral"];
        $turnolaboral = $_POST["turnolaboral"];
        $contactosecretaria = $_POST["contactosecretaria"];
    

        $secretaria = "INSERT INTO Secretaria (ID_persona_secretaria, ID_tipodomicilio, nombredomicilio, fechalaboral, horariolaboral, turnolaboral, contactosecretaria) VALUES 
        ('$secretaria','$tipodomicilio', '$nombredomicilio','$fechalaboral','$horariolaboral',' $turnolaboral','$contactosecretaria')";
        $resultado1 = $conexion->query($secretaria);
        
        echo "<script type=\"text/javascript\"> window.location='secretaria1.php';</script>";
    } 
    if (isset($_POST["cancelar"])) {
        
        echo "<script type=\"text/javascript\"> window.location='secretaria1.php';</script>";
    } ?>
    

      </div>
    </div>
</body>
   
