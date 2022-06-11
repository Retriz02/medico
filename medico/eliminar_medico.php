<?php
require("../database/db_medico.php");

//obtiene el id enviado
$ID_Medico = $_GET["id"];
//cambia el estado de activo del medico que coincide con ese id
$eliminar = "UPDATE medico SET ID_activo_medico = '0' WHERE medico.ID_medico = $ID_Medico;
";

$RESULTADO = $conexion->query($eliminar);
echo "<script type=\"text/javascript\"> window.location='lista_medico.php';</script>";

?>