<?php
    if (isset($_POST["confirmar"])) {
        require("medicos.php");
         

        $domicilio = $_POST["domicilio"];
        $referido = $_POST["referido"];
        $nombre = $_POST["nombre"];

        $medico = "UPDATE sanatorio SET ID_domicilio_sanatorio='$domicilio', ID_referido_sanatorio='$referido', Nombre='$nombre') WHERE ID_sanatorio='$ID_sanatorio' ";
        $resultado1 = $conexion->query($medico);
        
        echo $resultado1;
    } 
?>