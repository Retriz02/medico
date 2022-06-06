<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=}, initial-scale=1.0">
    <link rel="stylesheet" href="styles/modificarEntrevista.css">
    <title>Document</title>

</head>

<body>
    <?php
    require('medicos.php');

    $ID_Medico = $_GET["id"];

    $sql = "SELECT * FROM entrevista_medicos WHERE ID_entrevistaMedico = $ID_Medico";
    
    $resultado = $conexion->query($sql);
    
    $dato = mysqli_fetch_assoc($resultado);
    
    ?>
    <div class="global">
        <form action="" method="POST">
            <h1 class="title-entrevista">Modificar entrevista</h1>
            <div class="contenedor-entrevista">
                <fieldset>
                    <legend>Personal</legend>
                    <div class="cont-entrevista">
                        <div class="cont-usuario-datos">
                            <div>
                                <p><span>Medico</span>
                                    <select value="" id="" name="medico" value="<?php echo $dato['Id_medico_entrevistaMedico']?>"> 
                                        <option value="1">Acuña Melanie Xiomara</option>
                                        <option value="2">Romero Carlos Ezequiel</option>
                                    </select>
                                </p>
                            </div>
                            <div>
                                <p><span>Usuario</span>
                                    <select value="" id="" name="usuario" value="<?php echo $dato['Id_usuario_entrevistaMedico']?>">
                                        
                                        <option value="1">Acuña Melanie Xiomara</option>
                                        <option value="2">Romero Carlos Ezequiel</option>
                                        <option value="3">Rojas Felix Nolberto</option>
                                        <option value="4">Santa Cruz Rebeca</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                </fieldset>
                <fieldset>
                    <legend>Domicilio</legend>
                    <div class="cont-dato-domicilio">

                        <select class="domicilio" value="Provincias" name="domicilio" value="<?php echo $dato['Id_domicilio_entrevistaMedico']?>">
                            
                            <option value="1">Provincia "Formosa" Localidad "Formosa" Barrio "Eva Perón" Calle "Raul
                                Alfonsín" Numero "4"</option>
                            <option value="2">Provincia "Formosa" Localidad "Formosa" Calle "Corrientes" Numero "3"
                            </option>
                            <option value="3">Provincia "Chaco" Localidad "Charata" Barrio "Villa Berth"</option>

                        </select>
                        <button class="btn-agregar">+</button>
                </fieldset>
                <fieldset>
                    <legend>Horario</legend>

                    <div class="cont-horario">
                        <input type="date" class="fecha-horario" name="fecha" required><input type="time" class="fecha-horario" name="horario" required value="<?php echo $dato['Horario']?>">
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Observaciones</legend>
                    <textarea class="textarea-observacion" placeholder="Escriba sus observaciones..." maxlength="1000" cols="60" rows="8" name="observaciones"></textarea value="<?php echo $dato['Observacion']?>">
            </div>
            </fieldset>
            <div class="botones">
                <a href="entrevista1.php" class="btn-cancelar">Cancelar</a>
                <input type="submit" class="btn-aceptar" value="Aceptar" name="aceptar">
            </div>
        </form>
        <?php
        if (isset($_POST["aceptar"])) {
            require('medicos.php');

            $ID_entrevista = $_GET["id"];
            $medico = $_POST["medico"];
            $domicilio = $_POST["domicilio"];
            $usuario = $_POST["usuario"];
            $fecha = $_POST["fecha"];
            $horario = $_POST["horario"];
            $observacion = $_POST["observaciones"];

            $nuevaEntrevista = "UPDATE entrevista_medicos SET ID_domicilio_entrevistaMedico= '$domicilio', ID_medico_entrevistaMedico= '$medico', ID_usuario_entrevistaMedico='$usuario', Fecha='$fecha', Horario='$horario', Observacion='$observacion' WHERE ID_entrevistaMedico ='$ID_entrevista' ";
            $resultado = $conexion->query($nuevaEntrevista);

            echo "<script type=\"text/javascript\"> window.location='entrevista1.php';</script>";
        } 
       

        ?>

</body>

</html>