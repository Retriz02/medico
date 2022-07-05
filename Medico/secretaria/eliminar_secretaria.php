<?php
require("secretaria.php"); // Llamamos a la base de datos

$ID_secretaria = $_GET["id"]; // Aqui llamamos al id de la secretaria que se desea eliminar
$eliminar = "DELETE FROM Secretaria WHERE ID_secretaria = $ID_secretaria"; // Con esta linea de codigo lo que hacemos es que elimine los datos en la Base de Datos
$RESULTADO = $conexion->query($eliminar); // El resultado seria la eliminación de la secretaria de la lista

echo "<script type=\"text/javascript\"> window.location='secretaria1.php';</script>"; // Una vez eliminada la secretaria nos redireccionara a la lista de secretaria
?>