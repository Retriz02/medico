<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/agregar_tarea.css">
    <title>Tareas</title>
</head>

<body>
    <?php 
        session_start();
        //si no existe una sesion lo lleva al login
        $varsesion = $_SESSION['usuario'];
        if ($varsesion == null || $varsesion = '') {
            header("location:../index.php");
        }

        require("../database/db_medico.php");
        $datoUsuario = $_SESSION["ID_usuario"];

        $ID_tarea = $_GET['id'];
        $sql = $conexion->query("SELECT * FROM tareas WHERE ID_tarea = $ID_tarea");
        $dato = mysqli_fetch_assoc($sql);
    ?>
    
<div class="container">
    <div class="title">Modificar Tarea</div>
    <form action="#" method="post">

    <fieldset>
                <legend></legend>
                <div class="user-details">
                <div class="input-box">
                        <span class="details">Usuario</span>
                        <input type="text" readonly value="<?php echo $_SESSION['apellido']." ".$_SESSION['nombre']; ?>">
                    </div>

                    <div class="input-box">
                        <span class="details">Estado Tarea</span>
                        <select name="estado" id="" required>
                            <?php
                            require("../database/db_general.php");
                            $est_tarea = $conexionGeneral->query("SELECT * FROM estado");
                            while ($metodo = mysqli_fetch_row($est_tarea)) {
                            ?>
                                <option value="<?php echo $metodo[0] ?>" <?php if ($metodo[0] == $dato['ID_estado_tarea']) echo 'selected' ?>><?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">Fecha</span>
                        <input type="date" class="fecha-horario" name="fecha" required value=<?php echo $dato["Fecha_tarea"]; ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Horario</span>
                        <input type="time" class="fecha-horario" name="hora" required value=<?php echo $dato["Hora_tarea"]; ?>>
                    </div>

                    <div class="observacion-box">
                        <span class="details">Descripción</span>
                        <textarea class="textarea-observacion" placeholder="Describa la Tarea..." maxlength="200" cols="10" rows="5" name="descripcion"><?php echo $dato["Descripcion_tarea"]; ?></textarea>
                    </div>
                </div>
            </fieldset>

            <div class="botones">
                <a href="lista_tarea.php">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["aceptar"])) {

        require("../database/db_medico.php");

        $estado = $_POST["estado"];
        $fecha = $_POST["fecha"];
        $hora = $_POST["hora"];
        $descripcion = $_POST["descripcion"];

        
        $modifTarea = "UPDATE tareas SET ID_estado_tarea = '$estado', Fecha_tarea = '$fecha', Hora_tarea = '$hora', Descripcion_tarea = '$descripcion' WHERE ID_tarea = $ID_tarea";
        $resultado = $conexion->query($modifTarea);

        echo "<script type=\"text/javascript\">window.location='lista_tarea.php';</script>";
    } ?>

</body>

</html>