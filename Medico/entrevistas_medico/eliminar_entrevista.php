<?php
    require("../database/db_medico.php");
    
    //obtiene el id enviado
    $ID_entrevistaMedico = $_GET["id"];
    
    //cambia el estado de activo del medico que coincide con ese id
    $eliminar = "UPDATE entrevista_medicos SET ID_activo_entrevista_medicos = '0' WHERE ID_entrevista_medicos= $ID_entrevistaMedico;";
    
    $RESULTADO = $conexion->query($eliminar);
    echo "<script type=\"text/javascript\"> window.location='lista_entrevista.php';</script>";
?>
