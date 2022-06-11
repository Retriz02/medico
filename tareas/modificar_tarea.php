<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agregarTarea.css">
    <title>Document</title>
</head>

<body>
    <?php 
        require("db_general.php");

        $ID_tarea = $_GET['id'];
        
        $sql = $mysqli->query("SELECT * FROM tareas WHERE ID_tarea = $ID_tarea");

        $dato = mysqli_fetch_assoc($sql);
    ?>
    
<div class="container">
    <div class="title">Modificar Tarea</div>
    <form action="#" method="post">

    <fieldset>
                <legend></legend>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Promotor</span>
                        <select name="promotor" id="">
                            <?php
                            require("db_general.php");
                            $promotor = $mysqli->query("SELECT usuarios.*, persona.Nombre_persona, persona.Apellido_persona, persona.DNI
                            FROM usuarios
                            left join persona on usuarios.ID_persona_usuario = persona.ID_persona 
                            where ID_persona_usuario = 7");
                            while ($metodo = mysqli_fetch_assoc($promotor)) {
                            ?>
                                <option value="<?php echo $metodo['ID_usuario'] ?>" <?php if ($metodo['ID_usuario'] == $dato['ID_persona_usuario']) echo 'selected' ?>><?php echo $metodo['DNI'] . " - " . $metodo['Nombre_persona'] . " " . $metodo['Apellido_persona']  ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">Estado Tarea</span>
                        <select name="estado" id="" required>
                            <?php
                            require("db_general.php");
                            $est_tarea = $mysqli->query("SELECT * FROM estado");
                            while ($metodo = mysqli_fetch_row($est_tarea)) {
                            ?>
                                <option value="<?php echo $metodo[0] ?>" <?php if ($metodo[0] == $dato['ID_estado']) echo 'selected' ?>><?php echo $metodo[0] . " - " . $metodo[1]  ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">Fecha</span>
                        <input type="date" class="fecha-horario" name="fecha" required value=<?php echo $dato["fecha"]; ?>>
                    </div>
                    <div class="input-box">
                        <span class="details">Horario</span>
                        <input type="time" class="fecha-horario" name="horario" required value=<?php echo $dato["horario"]; ?>>
                    </div>

                    <span class="input-box">Descripción</span>
                    <div class="observacion-box">
                        <textarea class="textarea-observacion" placeholder="Escriba la Tarea..." maxlength="200" cols="10" rows="5" name="descripcion"><?php echo $dato["observaciones"]; ?></textarea>
                    </div>
                </div>
            </fieldset>

            <div class="botones">
                <a href="listaTarea.php">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["aceptar"])) {

        require("db_general.php");

        $promotor = $_POST["promotor"];
        $estadota = $_POST["estado"];
        $fecha = $_POST["fecha"];
        $horario = $_POST["horario"];
        $descripcion = $_POST["descripcion"];

        
        $modifTarea = "UPDATE tareas SET ID_usuario = '$promotor', ID_estado = '$estadota', 
        fecha = '$fecha', horario = '$horario', observaciones = '$descripcion' WHERE ID_tarea = $ID_tarea";
        $resultado = $mysqli->query($modifTarea);

        echo "<script type=\"text/javascript\">window.location='listaTarea.php';</script>";
    } ?>

</body>

</html>