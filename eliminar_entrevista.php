<?php
require("medicos.php");

$ID_entrevistaMedico = $_GET["id"];
$eliminar = "DELETE FROM entrevista_medicos WHERE ID_entrevistaMedico = $ID_entrevistaMedico";

$RESULTADO = $conexion->query($eliminar);

echo "<script type=\"text/javascript\"> window.location='entrevista1.php';</script>";
?>
