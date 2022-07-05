<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos_comercial/agregar_entrevista.css">
    <title>Document</title>
</head>

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
                            require("../database/db_general.php");
                            $persona = $conexionGeneral->query("SELECT * FROM persona order by Apellido_persona");
                            while ($metodo = mysqli_fetch_assoc($persona)) {
                            ?>
                                <option value="<?php echo $metodo['ID_persona'] ?>"><?php echo $metodo['DNI'] . " - " . $metodo['Apellido_persona'] . " " .  $metodo['Nombre_persona'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <a href="../medico/agregarPersona.php" target="rellenarDatos">+</a>

                    </div>

                    <div class="input-box">
                        <span class="details">Empresa</span>
                        <select name="empresa" id="">
                            <?php
                            require("../../database/db_comercial.php");
                            $empresa = $mysqli->query("SELECT * FROM empresas order by Nombre_empresa");
                            while ($metodo = mysqli_fetch_row($empresa)) {
                            ?>
                                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[1] ?></option>
                            <?php } ?>
                        </select>
                        <a href="../Referidos/agregarEmpresa.php" target="rellenarDatos">+</a>

                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <div class="user-details">

                    <span class="details">Selecciona el Contacto</span>

                    <select name="contacto" id="">
                        <?php
                        require("../../database/db_general.php");
                        $sql1 = $mysqli->query("SELECT contactos.*, tipocontactos.Descripcion_tipoContacto FROM contactos
                                        left join tipocontactos on contactos.ID_tipoContacto_contacto = tipocontactos.ID_tipoContacto
                                        ");
                        while ($metodo1 = mysqli_fetch_assoc($sql1)) {
                        ?>
                            <option value="<?php echo $metodo1["ID_contacto"] ?>"><?php echo $metodo1["Descripcion_tipoContacto"], " - ", $metodo1["Valor"] ?></option>
                        <?php } ?>
                    </select>
                    <a href="../Referidos/agregarContacto.php" target="rellenarDatos">+</a>
                </div>
            </fieldset>

            <fieldset>
                <legend>Domicilio</legend>

                <div class="user-details">
                    <div class="input-box">
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
                                <option value="<?php echo $metodo['ID_domicilio'] ?>"><?php echo  "Provincia: " . $metodo['ID_provincia_localidad'] . " | Localidad:  " . $metodo['Nombre_localidad'] . " | Barrio: " . $metodo['ID_barrio_tipoBarrio']  . " | Manzana: " . $metodo['Manzana']  . " | Sector/Parcela: " . $metodo['Sector_Parcela']  . " | Departamento: " . $metodo['Departamento']  . " | Piso: " . $metodo['Piso'] . " | Torre " . $metodo['Torre'] . " | Calle: " . $metodo['Calle'] . " | Numero: " . $metodo['Numero']  ?></option>
                            <?php } ?>
                        </select>
                        <a href="../Referidos/agregarDomicilio.php" target="rellenarDatos">+</a>

                    </div>

                    <div class="input-box">
                        <span class="details">Tipo Domicilio</span>
                        <select name="tipodomicilio" id="" required>
                            <?php
                            require("../../database/db_general.php");
                            $tipodomicilio = $mysqli->query("SELECT * FROM tipodomicilio");
                            while ($metodo = mysqli_fetch_assoc($tipodomicilio)) {
                            ?>
                                <option value="<?php echo $metodo['ID_tipoDomicilio'] ?>"><?php echo $metodo["ID_tipoDomicilio"], " - ", $metodo["Descripcion_tipoDomicilio"] ?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
            </fieldset>
            <div class="botones">
                <a href="agregarEntrevistas.php" target="paginaPrincipal">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
        </form>
        <?php
    if (isset($_POST["aceptar"])) {
        require("../../database/db_comercial.php");

        $referido = $_POST["persona"];
        $empresa = $_POST["empresa"];
        $contacto = $_POST["contacto"];
        $domicilio = $_POST["domicilio"];
        $tipodomicilio = $_POST["tipodomicilio"];
        $activo = 1;
        $carga_referido = 1;

        $nuevoReferido = "INSERT INTO referidos (ID_persona_referido, ID_empresa_referido, ID_usuario_carga_referido,  ID_activo_referido) VALUES 
        ('$referido','$empresa','$carga_referido','$activo')";
        $resultado = $mysqli->query($nuevoReferido);

        require("../../database/db_general.php");

        $Contacto = "INSERT INTO personacontactos (ID_persona_persona_contacto, ID_contacto_persona_contacto)
        VALUES ('$referido', '$contacto')";
        $resultado = $mysqli->query($Contacto);

        $domicilio = "INSERT INTO personadomicilio (ID_persona_personaDomicilio, ID_domicilio_personaDomicilio, ID_tipoDomicilio_personaDomicilio)
        VALUES ('$referido', '$domicilio', '$tipodomicilio')";
        $resultado = $mysqli->query($domicilio);

        echo "Referido Agregado";
    } ?>
    </div>
    




</body>

</html>