<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/agregarEntrevistas.css">
    <title>Document</title>
</head>
<?php 
    session_start();
    $datoUsuario = $_SESSION["ID_usuario"];
    
    require("medicos.php");

    $sql = "SELECT * FROM profesion";
    $result = $conexion->query($sql);
    
    $sql1 = "SELECT * FROM especialidades";
    $result1 = $conexion->query($sql1);

    $sql2= "SELECT * FROM persona ORDER BY ApellidoP";
    $result2 = $conexionGeneral->query($sql2);
?>

<body>
    <div class="container">
        <div class="title">Gestionar Medico</div>
        <form action="" method="post">
            <fieldset>
                <legend>Datos del Medico</legend>
                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Persona</span>
                        <select name="persona" id="">
                            <?php
                            require("general.php");
                            while ($persona = mysqli_fetch_assoc($result2)) {
                            ?>
                            <option value="<?php echo $persona['ID_persona'] ?>">
                                <?php echo $persona['DNI'] . " - " . $persona['NombreP'] . " " .  $persona['ApellidoP'] ?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                        <a href="agregarPersona.php" target="rellenarDatos">+</a>
                    </div>

                    <div class="">
                        <span class="details">Profesion</span>
                        <select value="" class="selectT" name="profesion">
                            <option value="0">Profesion</option>
                            <?php while($datMedico = mysqli_fetch_assoc($result)){?>
                            <option value="<?php echo $datMedico['ID_Profesion'];?>">
                                <?php echo $datMedico['Profesion_Descripcion'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="">
                        <select value="" class="selectTP" name="especialidad">
                            <option value="0">Especialidad</option>
                            <?php while($datMedico2 = mysqli_fetch_assoc($result1)){?>
                            <option value="<?php echo $datMedico2['ID_especialidad'];?>">
                                <?php echo $datMedico2['Especialidad_Descripcion'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="">
                        <select value="" class="selectTPM" name="tipoMatricula">
                            <option value="SinValor">Tipo Matricula</option>
                            <option value="N">N - Nacional</option>
                            <option value="P">P - Provincial</option>
                        </select>
                    </div>
                    <div class="cont-matricula">
                        <p>
                            <input type="text" class="input-nroMatricula" placeholder="Nro. Matricula" name="matricula"
                                maxlenght=10>
                            <input type="text" class="input-nroPrestador" placeholder="Nro. Prestador" name="prestador"
                                maxlenght=10>
                        </p>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <div class="user-details">

                    <span class="details">Selecciona el Contacto</span>

                    <select name="contacto" id="">
                        <?php
                        require("general.php");
                        $sqlcont = $conexionGeneral->query("SELECT contactos.*, tipocontactos.Descripcion_tipoContacto FROM contactos
                                        left join tipocontactos on contactos.ID_tipoContacto_contacto = tipocontactos.ID_tipoContacto
                                        ");
                        while ($contacto = mysqli_fetch_assoc($sqlcont)) {
                        ?>
                        <option value="<?php echo $contacto["ID_contacto"] ?>">
                            <?php echo $contacto["Descripcion_tipoContacto"], " - ", $contacto["Valor"] ?></option>
                        <?php } ?>
                    </select>
                    <a href="agregarContacto.php" target="rellenarDatos">+</a>
                </div>
            </fieldset>

            <fieldset>
                <legend>Domicilio</legend>

                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Direcci??n</span>
                        <select name="domicilio" id="" required>
                            <?php
                            require("general.php");
                            $domicilio = $conexionGeneral->query("SELECT domicilio.*,localidades.*, tipobarrio.*, tipoedificio.*
                            FROM domicilio 
                            left join localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
                            left join tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
                            left join tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
                            while ($metodo = mysqli_fetch_assoc($domicilio)) {
                            ?>
                            <option value="<?php echo $metodo['ID_domicilio'] ?>">
                                <?php echo  "Provincia: " . $metodo['ID_provincia_localidad'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector_Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?>
                            </option>
                            <?php } ?>
                        </select>
                        <a href="agregarDomicilio.php" target="rellenarDatos">+</a>

                    </div>

                    <div class="input-box">
                        <span class="details">Tipo Domicilio</span>
                        <select name="tipodomicilio" id="" required>
                            <?php
                            require("general.php");
                            $tipodomicilio = $conexionGeneral->query("SELECT * FROM tipodomicilio");
                            while ($metodo1 = mysqli_fetch_assoc($tipodomicilio)) {
                            ?>
                            <option value="<?php echo $metodo['ID_tipoDomicilio'] ?>">
                                <?php echo $metodo1["ID_tipoDomicilio"], " - ", $metodo1["Descripcion_tipoDomicilio"] ?>
                            </option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
            </fieldset>
            <div class="botones">
                <a href="medicos1.php">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
        </form>
    </div>
    <?php

    if (isset($_POST["aceptar"])) {
        require("medicos.php");
        require("general.php");

        $persona = $_POST["persona"];
        $profesion = $_POST["profesion"];
        $especialidad = $_POST["especialidad"];
        $matricula = $_POST["matricula"];
        $tipo = $_POST["tipoMatricula"];
        $prestador = $_POST["prestador"];

        $activo = 1; 

        $contacto = $_POST["contacto"];
        $domicilio = $_POST["domicilio"];
        $tipodomicilio = $_POST["tipodomicilio"];


        $medico = "INSERT INTO medico ( ID_persona_medico, ID_profesion_medico, ID_especialidad_medico, Nro_Matricula, Tipo_Matricula, Nro_Prestador) VALUES 
        ('$persona','$profesion','$especialidad','$matricula','$tipo','$prestador')";
        $resulta3 = $conexion->query($medico);

        $Contacto = "INSERT INTO personacontactos (ID_persona_persona_contacto, ID_contacto_persona_contacto)
        VALUES ('$persona', '$contacto')";
        $resulta4 = $conexionGeneral->query($Contacto);

        $domicilio = "INSERT INTO personadomicilio (ID_persona_personaDomicilio, ID_domicilio_personaDomicilio, ID_tipoDomicilio_personaDomicilio)
        VALUES ('$persona', '$domicilio', '$tipodomicilio')";
        $resulta4 = $conexionGeneral->query($domicilio);


        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    }
?>

</body>

</html>