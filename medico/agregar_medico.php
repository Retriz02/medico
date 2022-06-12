<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/agregar_entrevista.css">
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
                        <a href="agregarPersona.php" target="rellenarDatos">+</a>
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
                        <span class="details">Matricula</span>

                        <select value="" name="tipoMatricula">
                            <option value="">Tipo Matricula</option>
                            <option value="N">N - Nacional</option>
                            <option value="P">P - Provincial</option>
                        </select>

                    </div>

                    <div class="input-box">
                        <p>
                            <input type="number" class="input-nroMatricula" placeholder="Nro. Matricula" name="matricula"
                                maxlenght=10>
                            <input type="number" class="input-nroPrestador" placeholder="Nro. Prestador" name="prestador"
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
                            require("../database/db_general.php");
                            //vincula todos los contactos con la descripcion del tipo de contacto que tienen
                            $sql4 = $conexionGeneral->query("SELECT contactos.*, tipocontactos.Descripcion_tipoContacto FROM contactos
                                        LEFT JOIN tipocontactos on contactos.ID_tipoContacto_contacto = tipocontactos.ID_tipoContacto");
                            
                            //se convierte en array para asi rellenar el combo con estos contactos
                            while ($metodo4 = mysqli_fetch_assoc($sql4)) {
                        ?>
                        <!--Como valor usamos el ID contacto, luego se concatena los datos del contacto para los combos/select-->
                        <option value="<?php echo $metod4["ID_contacto"] ?>">
                            <?php echo $metodo4["Descripcion_tipoContacto"], " - ", $metodo4["Valor"] ?></option>
                        <?php } ?>
                    </select>
                    <a href="agregarContacto.php" target="rellenarDatos">+</a>
                </div>
            </fieldset>

            <fieldset>
                <legend>Domicilio</legend>

                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Dirección</span>
                        <select name="domicilio" id="" required>
                            <?php
                                require("../database/db_general.php");
                                $domicilio = $conexionGeneral->query("SELECT domicilio.*,localidades.*, tipobarrio.*, tipoedificio.*
                                FROM domicilio 
                                LEFT JOIN localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
                                LEFT JOIN tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
                                LEFT JOIN tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
                                while ($metodo5 = mysqli_fetch_assoc($domicilio)) {
                            ?>

                            <!--Como valor usamos el ID domicilio, luego se concatena los datos del domicilio para los combos/select-->
                            <option value="<?php echo $metodo5['ID_domicilio'] ?>">
                                <?php echo  "Provincia: " . $metodo5['ID_provincia_localidad'] . " | Localidad:  " . $metodo5['Nombre_localidad'] . " | Barrio: " . $metodo5['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo5['Manzana']  . " | Sector/Parcela: " . $metodo5['Sector_Parcela']  . " | Departamento: " . $metodo5['Departamento']  . " | Piso: " . $metodo5['Piso'] . " | Torre " . $metodo5['Torre'] . " | Calle: " . $metodo5['Calle'] . " | Numero: " . $metodo5['Numero']  ?>
                            </option>
                            <?php } ?>
                        </select>
                        <a href="agregarDomicilio.php" target="rellenarDatos">+</a>

                    </div>

                    <div class="input-box">
                        <span class="details">Tipo Domicilio</span>
                        <select name="tipodomicilio" id="" required>
                            <?php
                            require("../database/db_general.php");
                            $tipodomicilio = $conexionGeneral->query("SELECT * FROM tipodomicilio");
                            while ($metodo6 = mysqli_fetch_assoc($tipodomicilio)) {
                            ?>
                                <option value="<?php echo $metodo6['ID_tipoDomicilio'] ?>"><?php echo $metodo6["ID_tipoDomicilio"], " - ", $metodo6["Descripcion_tipoDomicilio"] ?></option>
                            <?php } ?>
                        </select>


                    </div>
                </div>

            </fieldset>
            <fieldset>
                <legend>Información Laboral</legend>
                <div class="user-details">
                    <button><a href="../sanatorio">Sanatorio</a></button>
                    <button><a href="../consultorio">consultorio</a></button>
                    <button><a href="../secretaria">Secretaria</a></button>
                </div>
            </fieldset>
            <div class="botones">
                <a href="lista_medico.php" target="paginaPrincipal">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
    </div>
    </fieldset>

    </form>
    </div>
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