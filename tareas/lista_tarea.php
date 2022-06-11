<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tablas</title>
    <link rel="stylesheet" href="estiloLista.css">
</head>

<body>
    <?php

    require("db_general.php");

    $sql = "SELECT tareas.*, estado.Descripcion_estado
    FROM tareas
    left join estado on tareas.ID_estado = estado.ID_estado";

    $resultado = $mysqli->query($sql);
    ?>
    <form action="" method="POST">
        <div class="container">
            <div class="title">
                <p><b>Lista de las tareas</b></p>
                <a href="agregarTarea.php" target="paginaPrincipal">
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
                            <th class="stiky">Eliminar</th>
                            <th class="stiky">Modificar</th>
                            <th class="stiky">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($Tareas = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <tr>

                                <td><?php echo $Tareas["fecha"] ?></td>

                                <td><?php echo $Tareas["horario"] ?></td>

                                <td><?php echo $Tareas["observaciones"] ?></td>

                                <td><a href="eliminarTarea.php?id= <?php echo $Tareas["ID_tarea"] ?>" class="botones">Eliminar</a></td>

                                <td><a href="modificarTarea.php?id= <?php echo $Tareas["ID_tarea"] ?>" class="botones">Modificar</a></td>

                                <?php
                                if ($Tareas['Descripcion_estado'] == "Abierto") {
                                    echo "<td class='yellow'>";
                                    echo $Tareas["Descripcion_estado"], "</td>";
                                }
                                if ($Tareas['Descripcion_estado'] == "Cerrado") {
                                    echo "<td class='green'>";
                                    echo $Tareas["Descripcion_estado"], "</td>";
                                }
                                if ($Tareas['Descripcion_estado'] == "Cancelado") {
                                    echo "<td class='red'>";
                                    echo $Tareas["Descripcion_estado"], "</td>";
                                }
                                if ($Tareas['Descripcion_estado'] == "Postergado") {
                                    echo "<td class='orange'>";
                                    echo $Tareas["Descripcion_estado"], "</td>";
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