<?php
require("medicos.php");

$ID_Medico = $_GET["id"];
$eliminar = "DELETE FROM medicos WHERE ID_medico = $ID_Medico";

$RESULTADO = $conexion->query($eliminar);
echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";

?>