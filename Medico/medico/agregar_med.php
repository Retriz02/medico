<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/agregar_entrevista.css">
  <link rel="stylesheet" href="../../chosen/css/chosen.css">

    <title>Document</title>
</head>

<?php 
    session_start();
    $datoUsuario = $_SESSION["ID_usuario"];
    require("../database/db_medico.php");
    require("../database/db_general.php");

    //tomo los campos de ambas tablas para utilizarlos luego en los combos/select
    $sql = "SELECT * FROM profesion";
    $result = $conexion->query($sql);
                
    $sql1 = "SELECT * FROM especialidades";
    $result1 = $conexion->query($sql1);

    $sql2= "SELECT * FROM persona";
    $result2 = $conexionGeneral->query($sql2);
?>

<body>
    <div class="container">
        <div class="title">Gestionar Medicos</div>
        <form action="" method="post">
            <fieldset>
                <legend>Datos del Medico</legend>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Persona</span>
                        <select name="persona" class="SearchSelect">
                            <?php
                                //selecciona todos los campos de personas y los ordena por el apellido
                                $persona = $conexionGeneral->query("SELECT * FROM persona order by Apellido_persona");
                                while ($metodo1 = mysqli_fetch_assoc($persona)) {
                            ?>
                            <!--Como valor usamos el ID persona, luego se concatena los datos de la persona para los combos/select-->
                            <option value="<?php echo $metodo1['ID_persona'] ?>">
                                <?php echo $metodo1['DNI'] . " - " . $metodo1['Apellido_persona'] . " " .  $metodo1['Nombre_persona'] ?>
                            </option>
                            <?php } ?>
                        </select>
                        <a href="../agregarDatos/agregarPersona.php" target="rellenar">+</a>
                    </div>
                    <div class="input-box">
                        <span class="details">Tipo Medico</span>
                        <select value="" name="tipoMedico">
                            <option value="1">Directo</option>
                            <option value="2">Asociado</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Profesion</span>
                        <select name="profesion" id="">
                            <?php while($datMedico = mysqli_fetch_assoc($result)){?>
                            <!--Trae la variable de la linea 21 y lo convierte en array para asi implir todas las profesiones que se encuentran en la tabla-->
                            <option value="<?php echo $datMedico['ID_Profesion'];?>">
                                <?php echo $datMedico['Profesion_Descripcion'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">Especialidad</span>

                        <select value="" name="especialidad">
                            <option value="0">Especialidad</option>
                            <?php while($datMedico2 = mysqli_fetch_assoc($result1)){?>
                            <!--Trae la variable de la linea 24 y lo convierte en array para asi implir todas las especialidades que se encuentran en la tabla-->
                            <option value="<?php echo $datMedico2['ID_especialidad'];?>">
                                <?php echo $datMedico2['Especialidad_Descripcion'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="details">Nro. Prestador</span>
                           
                        <input type="number" placeholder="Nro. Prestador" name="prestador"
                                maxlenght=10>
                    </div>
               
                </div> 
            </fieldset><fieldset><legend>Matricula</legend>
                <div class="user-details">
                <div class="input-box">

                <a href="../agregarDatos/agregarContacto.php" target="rellenar">Agregar matriculas</a>
                </div>
            </div>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <div class="user-details">

                    <span class="details">Selecciona el Contacto</span>

                    <select name="contacto" class="SearchSelect">
                        <?php
                        require("../database/db_general.php");
                        $sql1 = $conexionGeneral->query("SELECT contactos.*, tipocontactos.Descripcion_tipoContacto FROM contactos
                                        left join tipocontactos on contactos.ID_tipoContacto_contacto = tipocontactos.ID_tipoContacto
                                        ");
                        while ($metodo1 = mysqli_fetch_assoc($sql1)) {
                        ?>
                            <option value="<?php echo $metodo1["ID_contacto"] ?>"><?php echo $metodo1["Descripcion_tipoContacto"], " - ", $metodo1["Valor"] ?></option>
                        <?php } ?>
                    </select>
                    <a href="../agregarDatos/agregarContacto.php" target="rellenar">+</a>
                </div>
            </fieldset>

            <fieldset>
                <legend>Domicilio</legend>

                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Dirección</span>
                        <select name="domicilio" class="SearchSelect" required>
                            <?php
                            require("../database/db_general.php");
                            $domicilio = $conexionGeneral->query("SELECT domicilio.*,localidades.*, tipobarrio.*, tipoedificio.*,provincias.*
                            FROM domicilio 
                            left join localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
                            left join provincias on localidades.ID_provincia_localidad= provincias.ID_provincia
                            left join tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
                            left join tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
                            while ($metodo = mysqli_fetch_assoc($domicilio)) {
                            ?>
                                <option value="<?php echo $metodo['ID_domicilio'] ?>"><?php echo  "Provincia: " . $metodo['Nombre_provincia'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector_Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?></option>
                            <?php } ?>
                        </select>
                        <a href="../agregarDatos/agregarDomicilio.php" target="rellenar">+</a>

                    </div>

                    <div class="input-box">
                        <span class="details">Tipo Domicilio</span>
                        <select name="tipodomicilio" id="" required>
                            <?php
                            require("../database/db_general.php");
                            $tipodomicilio = $conexionGeneral->query("SELECT * FROM tipodomicilio");
                            while ($metodo = mysqli_fetch_assoc($tipodomicilio)) {
                            ?>
                                <option value="<?php echo $metodo['ID_tipoDomicilio'] ?>"><?php echo $metodo["ID_tipoDomicilio"], " - ", $metodo["Descripcion_tipoDomicilio"] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Información Laboral</legend>
                <div class="user-details">
                    <button><a href="sanatorio_medico/lista_sanatorio_medico?id=<?php echo $medico["ID_medico"] ?>">Sanatorio</a></button>
                    <button><a href="consultorio_medico/lista_consultorio_medico?id=<?php echo $medico["ID_medico"] ?>">consultorio</a></button>
                    <button><a href="secretaria_medico/lista_secretaria_medico?id=<?php echo $medico["ID_medico"] ?>">Secretaria</a></button>
                </div>
            </fieldset>
            <div class="botones">
                <input type="submit" value="Actualizar" name="actualizar">
                <input type="button" onclick="location.href='lista_medico.php'" target="paginaPrincipal" value="Cancelar">
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

        $persona = $_POST["persona"];
        $profesion = $_POST["profesion"];
        $especialidad = $_POST['especialidad'];
        $tipoMedico = $_POST['tipoMedico'];
        $tipoMatricula =$_POST['tipoMatricula']; 
        $nro_prestador= $_POST['matricula'];
        $nro_matricula =$_POST['prestador']; 
        $contacto = $_POST["contacto"];
        $domicilio = $_POST["domicilio"];
        $tipodomicilio = $_POST["tipodomicilio"];
        $activo = 1;

        $nuevoMedico = "INSERT INTO medico(ID_medico, ID_persona_medico, ID_profesion_medico, ID_especialidad_medico, tipoMedico, Nro_Matricula, Tipo_Matricula, Nro_Prestador, ID_activo_medico) VALUES 
        (NULL,$persona,$profesion,$especialidad,$tipoMedico,$nro_matricula,$tipoMatricula,$nro_prestador,$activo)";
        $resultado1 = $conexion->query($nuevoMedico);

        require("../database/db_general.php");

        $carga_contacto = "INSERT INTO personacontactos (ID_persona_persona_contacto, ID_contacto_persona_contacto)
        VALUES ('$persona', '$contacto')";
        $resultado2 = $conexionGeneral->query($carga_contacto);

        $carga_domicilio = "INSERT INTO personadomicilio (ID_persona_personaDomicilio, ID_domicilio_personaDomicilio, ID_tipoDomicilio_personaDomicilio)
        VALUES ('$persona', '$domicilio', '$tipodomicilio')";
        $resultado3 = $conexionGeneral->query($carga_domicilio);

        echo "<script> window.location='lista_medico.php' target='paginaPrincipal';</script>";
    } ?>



</body>

</html>