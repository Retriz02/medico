<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/Consultorio.css">
    <title>Document</title>
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
                    
                        <p class="cont-dato"><span>Domicilio</span>
                            <select value="" name="domicilio">
                                <option value="1">AV. 25 de mayo</option>
                                <option value="2">Calle Belgrano</option>
                            </select>
                            <button class="btn-agregar">+</button>
                            <span>Contacto</span>
                            <select value="" name="contacto">
                                <option value="1">3704697102</option>
                                <option value="2">melaniexiomara485@gmail.com</option>
                            </select>
                            <button class="btn-agregar">+</button>
                        </p>
                 
                  
                </div>
                <div>
                    <p><span>Nombre</span>
                        <input type="text" required name="nombre-consultorio">
                    <span>Dias</span>
                        <input type="text" required name="dias">
                    <span>Hora</span>
                        <input type="time" required name="hora">
                    </p>
                </div>
                <div class="botones2">
                    <input type="submit" class="btn-aceptar" value="Confirmar" required>
                    <input type="submit" class="btn-cancelar" value="Cancelar" required>
                </div>
            </div>
        </div>

    </form>
    <?php
    if (isset($_POST["confirmar"])) {
        require("medicos.php");

        $domicilio = $_POST["domicilio"];
        $nombreConsultorio = $_POST["nombre-consultorio"];
        $contacto = $_POST["contacto"];
        $dias = $_POST["dias"];
        $horas = $_POST["hora"]; 

        $medico = "INSERT INTO consultorio ( ID_domicilio_consultorio, ID_contacto_consultorio, ID_medico_consultorio, Nombre, Días, Hora) VALUES 
        ('$domicilio','$referido','$nombre','$apertura','$cierre')";
        $resultado1 = $conexion->query($medico);
        
        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    } 
    if (isset($_POST["cancelar"])) {
        
        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    } ?>
</body>

</html>