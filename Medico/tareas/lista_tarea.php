<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tareas</title>
    <link rel="stylesheet" href="../styles/estilo_listas.css">
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

        /*seleciono todas las tareas donde el usuario de la tarea coincida con el que tiene iniciado la sesion
        y mediante el LEFT JOIN consultamos el valor de la clave foranea de estado */
        $sql = "SELECT tareas.*, estado.*
        FROM tareas
        LEFT JOIN db_general.estado on tareas.ID_estado_tarea = estado.ID_estado
        WHERE ID_usuario_tarea = $datoUsuario";

        $resultado = $conexion->query($sql);
    ?>
    <form action="" method="POST">
        <div class="container">
            <div class="title">
                <p><b>Lista de las tareas</b></p>
                <a href="agregar_tarea.php" target="paginaPrincipal">
                    <input type="button" value="Agregar Tarea" class="blue">
                </a>
            </div>
            <div class="table-container">
                <table class="table">

                    <thead>
                        <tr>
                            <th class="stiky">Fecha</th>
                            <th class="stiky">Hora</th>
                            <th class="stiky">Descripción</th>
                            <th class="stiky">Opciones</th>
                            <th class="stiky">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($tarea = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <tr>

                                <td><?php echo $tarea["Fecha_tarea"] ?></td>

                                <td><?php echo $tarea["Hora_tarea"] ?></td>

                                <td><?php echo $tarea["Descripcion_tarea"] ?></td>

                                <td><a href="eliminar_tarea.php?id=<?php echo $tarea["ID_tarea"] ?>" class="botones">Eliminar</a>
                                <a href="modificar_tarea.php?id=<?php echo $tarea["ID_tarea"] ?>" class="botones">Modificar</a></td>

                                <?php
                                if ($tarea['Descripcion_estado'] == "Abierto") {
                                    echo "<td class='yellow'>";
                                    echo $tarea["Descripcion_estado"], "</td>";
                                }
                                if ($tarea['Descripcion_estado'] == "Cerrado") {
                                    echo "<td class='green'>";
                                    echo $tarea["Descripcion_estado"], "</td>";
                                }
                                if ($tarea['Descripcion_estado'] == "Cancelado") {
                                    echo "<td class='red'>";
                                    echo $tarea["Descripcion_estado"], "</td>";
                                }
                                if ($tarea['Descripcion_estado'] == "Postergado") {
                                    echo "<td class='orange'>";
                                    echo $tarea["Descripcion_estado"], "</td>";
                                }
                                ?>

                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>

</body>

</html>