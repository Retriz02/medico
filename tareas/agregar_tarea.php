<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/agregar_tarea.css">
    <title>Gestionar Tareas</title>
</head>

<body>
    <?php 
        session_start();
        $datoUsuario = $_SESSION["ID_usuario"];
    ?>
    <div class="container">
        <div class="title">Agregar Tareas</div>
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
                                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">Fecha</span>
                        <input type="date" class="fecha-horario" name="fecha" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Hora</span>
                        <input type="time" class="fecha-horario" name="hora" required>
                    </div>

                    <span class="input-box">Descripción</span>
                    <div class="observacion-box">
                        <textarea class="textarea-observacion" placeholder="Describa la tarea..." maxlength="200" cols="10" rows="5" name="descripcion"></textarea>
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

        $nuevaTarea = "INSERT INTO tareas(ID_usuario_tarea, ID_estado_tarea, Fecha_tarea, Hora_tarea, Descripcion_tarea)  VALUES 
        ('$datoUsuario','$estado','$fecha','$hora', '$descripcion')";
        $resultado = $conexion->query($nuevaTarea);

        echo "<script type=\"text/javascript\">window.location='lista_tarea.php';</script>";

    } ?>


</body>

</html>