<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultorio</title>
    <link rel="stylesheet" href="./styles/modificar_medico.css">
</head>

<body>
<?php
    require("general.php");
    require("medicos.php");

    $ID_sanatorio = $_GET['id'];
    $sql0 = "SELECT * FROM sanatorio WHERE ID_sanatorio= $ID_sanatorio";
    $resultado = $conexion->query($sql0);
    $dato = mysqli_fetch_assoc($resultado); //lista de la tabla del consultorio
    
    $sql = "SELECT * FROM domicilio";
    $result = $conexionGeneral->query($sql);
                
    $sql1 = "SELECT * FROM contacto";
    $result1 = $conexionGeneral->query($sql1);
    

$sqlef = "SELECT sanatorio.*, medico.*,persona.*
FROM sanatorio
LEFT JOIN  medicos.medico  on sanatorio.ID_medico_sanatorio = medico.ID_medico
LEFT JOIN  general.persona  on medico.ID_persona_medico = persona.ID_persona";

$res = $conexion->query($sqlef) or die ($conexion->error);
$perso = mysqli_fetch_assoc($res);
    

?>

    <h1>Consultorio</h1>
    
    <form action="" method="POST">
        <div>
            <p><span>Domicilio</span>
                <select value="" name="domicilio" value="<?php echo $dato['ID_domicilio_sanatorio']?>">
                    <option value="0">Domicilio</option>
                    <?php while($domicilio = mysqli_fetch_assoc($result)){?>
                        <option value="<?php echo $domicilio['ID_domicilio'];?>"><?php echo $domicilio['Calle']."  ".$domicilio['Numero'];?></option>
                        <?php } ?>
                </select>
            </p>
        </div>
        <div>
            <p><span>Contacto</span>
                <select value="" name="contacto" value="<?php echo $dato['ID_contacto_sanatorio']?>">
                    <option value="0">Contacto</option>
                    <?php while($contacto = mysqli_fetch_assoc($result1)){?>
                        <option value="<?php echo $contacto['ID_contacto'];?>"><?php echo $contacto['Valor'];?></option>
                        <?php } ?>
                </select>
            </p>
        </div>
        <div>
            <p><span>Medico</span>
                
                <input type="text" name="medico1" readonly value="<?php echo $perso['ApellidoP']."  ".$perso['NombreP']?>">
            </p>
        </div>
        <div>
            <p><span>Nombre</span>
                <input type="text" name="nombre" required value="<?php echo $dato['Nombre']?>">
            </p>
        </div>
        
        <div>
            <p><span>Dias</span>
                <input type="text" name="dias" required value="<?php echo $dato['Dias']?>">
            </p>
            <p><span>Hora de Apertura</span>
                <input type="time" name="apertura" required value="<?php echo $dato['horaApertura']?>">
            </p>
        </div>
        <div>
            <p><span>Hora de Cierre</span>
                <input type="time" name="cierre" required value="<?php echo $dato['horaCierre']?>">
            </p>
        </div>
        <button><a href="sanatorio1.php">Cancelar</a></button>
        <input type="submit" name="aceptar" value="Aceptar" required>
    </form>
    <?php

if (isset($_POST["aceptar"])) {
    require("medicos.php");

    $domicilio = $_POST["domicilio"];
    $contacto = $_POST["contacto"];
    $medico =  $perso['ID_medico'];
    $nombre = $_POST["nombre"];
    $dias = $_POST["dias"];
    $apertura = $_POST["apertura"];
    $cierre = $_POST["cierre"];


    $sanatorio = "UPDATE sanatorio SET ID_domicilio_sanatorio= '$domicilio', ID_contacto_sanatorio= '$contacto', ID_medico_sanatorio='$medico', Nombre='$nombre', Dias='$dias', horaApertura='$apertura', horaCierre='$cierre' WHERE ID_sanatorio='$ID_sanatorio' ";
    $resultado = $conexion->query($sanatorio);
  
    echo "<script type=\"text/javascript\"> window.location='sanatorio1.php';</script>";


    } 
    ?>

</body>
</html>