<?php
require("medicos.php");

$ID_agenda = $_GET["id"];
$eliminar = "DELETE FROM agenda WHERE ID_agenda = $ID_agenda";

$RESULTADO = $conexion->query($eliminar);

echo "<script type=\"text/javascript\"> window.location='listaAgenda1.php';</script>";
?>
