<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Consultorio</title>
    <link rel="stylesheet" href="styles/consultorio.css">

</head>

<body>
<div class="global">
<div class="contenedor">
    <h1>Gestionar Consultorio</h1>
    <form action="consultorio1.php" method="post">
    <fieldset>
        <legend>Datos profesionales</legend>
        <div class="contenedorMedico">
            <div class=cont-persona>
                <div class="cont-dato-persona">
                    <?php 
                        require("general.php");
                        $sql1= "SELECT * FROM domicilio";
                        $result1 = $conexionGeneral->query($sql1);
                       
                    ?>    

                        <p class="cont-dato"><span>Domicilio</span>
                            <select value="" name="domicilio">
                                <option value="0">Domicilio</option>
                                <?php while($dato = mysqli_fetch_assoc($result1)){?>
                                <option value="<?php echo $dato['ID_domicilio'];?>"><?php echo $dato['Calle'].' '.$dato['Numero'];?></option>
                                <?php } ?>
                            </select>
                            <button class="btn-agregar">+</button>
                            <span>Contacto</span>
                            <select value="" name="contacto">
                                <option value="0">Contacto</option>
                                <?php 
                                    $sql2= "SELECT * FROM contactos";
                                    $result2 = $conexionGeneral->query($sql2);
                                    while($dato1 = mysqli_fetch_assoc($result2)){?>
                                <option value="<?php echo $dato1['ID_contacto'];?>"><?php echo $dato1['Valor'];?></option>
                                <?php } ?>
                            </select>
                            <button class="btn-agregar">+</button>
                        </p>
                 
                  
                </div>
                <div>
                    <p><span>Nombre</span>
                        <input type="text" required name="nombre_consultorio">
                    <span>Dias</span>
                        <input type="text" required name="dias">
                    <span>Hora</span>
                        <input type="time" required name="hora">
                    </p>
                </div>
                <div class="botones2">
                    <button class="btn-cancelar" ><a href="agregarMedico.php">Cancelar</a></button>
                    <input type="submit" class="btn-aceptar" value="Confirmar">
                </div>
            </div>
        </div>

    </form>

    <?php
    if (isset($_POST["confirmar"])) {
        require("medicos.php");

        $domicilio = $_POST["domicilio"];
        $contacto = $_POST["contacto"];
        $nombre_consultorio = $_POST["nombre_consultorio"];
        $dias = $_POST["dias"];
        $hora = $_POST["hora"]; 

        $medico = "INSERT INTO consultorio ( ID_domicilio_consultorio, ID_contacto_consultorio, Nombre_Consultorio, Días, Hora) VALUES 
        ('$domicilio','$contacto','$nombre','$dias','$hora')";
        $resultado1 = $conexion->query($medico);
        
        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    } 
    if (isset($_POST["cancelar"])) {
        
        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    } ?>
</body>

</html>