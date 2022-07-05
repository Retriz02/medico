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

    require("../database/db_general.php");
    require("../database/db_medico.php");

    $ID_medico = $_POST['id']; //recibo el id que manda el boton modificar de lista_medico para tomar los datos del medico
   
    $sq = $conexion->query("SELECT * FROM medico WHERE ID_medico = $ID_medico");
    $datoMedico = mysqli_fetch_assoc($sq);

    $ID_persona = $dato['ID_persona_medico'];

    $persona = $conexionGeneral->query("SELECT * FROM persona WHERE ID_persona = $ID_persona");
    $arrayPersona = mysqli_fetch_assoc($persona);

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
                            <!--Trae la variable de la linea 21 y lo convierte en array para asi mpstrar todas las profesiones que se encuentran en la tabla-->
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
                            <!--Trae la variable de la linea 24 y lo convierte en array para asi mostrar todas las especialidades que se encuentran en la tabla-->
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
                            <input type="text" class="input-nroMatricula" placeholder="Nro. Matricula" name="matricula"
                                maxlenght=10 value="<?php echo $datoMedico["Nro_Matricula"]; ?>">
                            <input type="text" class="input-nroPrestador" placeholder="Nro. Prestador" name="prestador"
                                maxlenght=10 value="<?php echo $datoMedico["Nro_Prestador"]; ?>">
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
                        $sql1 = $conexionGeneral->query("SELECT contactos.*, tipocontactos.Descripcion_tipoContacto FROM contactos
                                        left join tipocontactos on contactos.ID_tipoContacto_contacto = tipocontactos.ID_tipoContacto");
                        while ($metodo1 = mysqli_fetch_assoc($sql1)) {
                        ?>
                            <option value="<?php echo $metodo1["ID_contacto"] ?>"><?php echo $metodo1["Descripcion_tipoContacto"], " - ", $metodo1["Valor"] ?></option>
                        <?php } ?>
                    </select>
                    <a href="agregarContacto.php" target="rellenarDatos">+</a><input type="submit" value="Igualar Contacto" name="igualarContacto">
                </div>


                <div class="user-details">
                    <div class="table-container">
                        <?php
                        require("../database/db_general.php");
                        $sql = "SELECT personacontactos.*,persona.ID_persona,contactos.Valor, tipocontactos.Descripcion_tipoContacto
                        FROM personacontactos
                        left join persona on personacontactos.ID_persona_persona_contacto = persona.ID_persona
                        left join contactos on personacontactos.ID_contacto_persona_contacto = contactos.ID_contacto
                        left join tipocontactos on contactos.ID_tipoContacto_contacto = tipocontactos.ID_tipoContacto
                        where ID_persona =  $ID_persona";
                        $resultado = $conexionGeneral->query($sql);
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="stiky">Tipo Contacto</th>
                                    <th class="stiky">Valor</th>
                                    <th class="stiky">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($metMedico = mysqli_fetch_assoc($resultado)) {
                                ?>
                                    <tr>
                                        <td><?php echo $metMedico["Descripcion_tipoContacto"] ?></td>
                                        <td><?php echo $metMedico["Valor"] ?></td>
                                        <td><a href="modificarContacto.php">Modificar</a></td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
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
                            left join localidades on domicilio.ID_localidad_domicilio= localidades.ID_localidad
                            left join tipobarrio on domicilio.ID_tipoBarrio_domicilio = tipobarrio.ID_tipoBarrio
                            left join tipoedificio on domicilio.ID_tipoEdificio_domicilio = tipoedificio.ID_tipoEdificio");
                            while ($metodo = mysqli_fetch_assoc($domicilio)) {
                            ?>
                                <option value="<?php echo $metodo['ID_domicilio'] ?>"><?php echo  "Provincia: " . $metodo['ID_provincia_localidad'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector_Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?></option>
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

        $editMedico = "UPDATE medico SET ID_profesion_medico='$profesion',
        ID_especialidad_medico= $especialidad,
        tipoMedico= $tipoMedico,
        Nro_Matricula= $nro_matricula,
        Tipo_Matricula= $tipoMatricula,
        Nro_Prestador= $nro_prestador,
        ID_activo_medico= $activo WHERE ID_medico = $ID_medico";
        
        
        $nuevoMedico = "INSERT INTO medico(ID_medico, ID_persona_medico, ID_profesion_medico, ID_especialidad_medico, tipoMedico, Nro_Matricula, Tipo_Matricula, Nro_Prestador, ID_activo_medico) VALUES 
        (NULL,$persona,$profesion,$especialidad,$tipoMedico,$nro_matricula,$tipoMatricula,$nro_prestador,$activo)";
        $resultado1 = $conexion->query($nuevoMedico);

        require("../database/db_general.php");

        $carga_contacto = "INSERT INTO personacontactos (ID_persona_persona_contacto, ID_contacto_persona_contacto)
        VALUES ('$persona', '$contacto')";
        $resultado2 = $conexionGeneral->query($Contacto);

        $carga_domicilio = "INSERT INTO personadomicilio (ID_persona_personaDomicilio, ID_domicilio_personaDomicilio, ID_tipoDomicilio_personaDomicilio)
        VALUES ('$persona', '$domicilio', '$tipodomicilio')";
        $resultado3 = $conexionGeneral->query($domicilio);

        echo "<script> window.location='lista_medico.php' target='paginaPrincipal';</script>";
    } ?>




</body>

</html>