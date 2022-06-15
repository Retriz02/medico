<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/eliminarRegistros.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="image">
                <img src="../img/alerta.webp" alt="">
            </div>
            <div class="title">
                <div class="title-tit">
                    <label><b>¿Estás seguro?</b></label>
                </div>
                <div class="title-subtit">
                    <label>Esta tarea se eliminará de su lista</label>
                </div>

            </div> 
            <div class="opciones">
                <input type="submit" value="Si, Eliminar" class="btn-green" name="si" >
            </div>
            <div class="opciones">
                <a href="lista_tarea.php" target="paginaPrincipal">
                    <input type="button" value="Cancelar" class="btn-red">
                </a>
            </div>
           
        </form>
    </div>
    <?php
    if (isset($_POST["si"])) {
        require("../database/db_medico.php");

        $ID_tarea = $_GET["id"];
        $eliminar = "DELETE FROM tareas WHERE ID_tarea = $ID_tarea";
        $RESULTADO = $conexion->query($eliminar);

        echo "<script type=\"text/javascript\">window.location='lista_tarea.php';</script>";
    }
    ?>


</body>

</html>