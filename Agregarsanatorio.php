<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sanatorio.css">
    <title>Document</title>
</head>

<body>
<div class="global">
<div class="contenedor">
    <h1>Gestionar Sanatorio</h1>
    <form action="sanatorio1.php" method="post">
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
                            <select value="" name="referido">
                                <option value="">melaniexiomara485@gmail.com</option>
                                <option value="">3704697102</option>
                            </select>
                            <button class="btn-agregar">+</button>
                        </p>
                 
                  
                </div>
                <div>
                    <p><span>Nombre</span>
                        <input type="text" required name="referido">
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
    if (isset($_POST["Confirmar"])) {
        require("medicos.php");

        $domicilio = $_POST["domicilio"];
        $referido = $_POST["referido"];
        $nombre = $_POST["nombre"];
        $dias = $_POST["dias"];
        $hora = $_POST["hora"];

        $medico = "INSERT INTO sanatorio ( ID_domicilio_sanatorio, ID_contactos_sanatorio, Nombre, Días, Hora) VALUES ('$domicilio','$referido','$nombre', $dias, $hora)";
        $resultado1 = $conexion->query($medico);
        
        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    } 
    if (isset($_POST["cancelar"])) {
        
        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    } ?>
</body>

</html>