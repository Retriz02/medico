<?php
require("secretaria.php");

$ID_secretaria = $_GET["id"];
$eliminar = "DELETE FROM Secretaria WHERE ID_secretaria = $ID_secretaria";

$RESULTADO = $conexion->query($eliminar);
echo "<script type=\"text/javascript\"> window.location='secretaria1.php';</script>";

?>