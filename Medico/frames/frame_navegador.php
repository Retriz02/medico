<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/frame_navegador.css">
    <title>OSDE</title>

</head>
<!-- Frames para todas las areas, excluyendo Auditoria medica
Este frame es el izquierdo superior donde se encuentran los botones para navegar entre pantallas--->

<body>

    <div class="contenedor">
        <div class="container">
            <fieldset class="container-navegador">
                <legend class="titulos" align="center"><b>Navegador</b></legend>
                <div class="container-links">
                    <a href="../tareas/lista_tarea.php" target="paginaPrincipal">
                        <input type="button" value="Tareas">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../medico/lista_medico.php" target="paginaPrincipal">
                        <input type="button" value="Medicos">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../consultorio/lista_consultorio.php" target="paginaPrincipal">
                        <input type="button" value="Consultorios">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../sanatorio/lista_sanatorio.php" target="paginaPrincipal">
                        <input type="button" value="Sanatorios">
                    </a>
                </div>
            </fieldset>
        </div>

        <div class="container">
            <form action="../buscador.php" target="paginaPrincipal" method="post">
                <fieldset class="container-buscador">
                    <legend class="titulos" align="center"><b>Buscador</b></legend>
                    <label for="nav" class="container-inputs-label">Tipo</label>
                    <div class="container-inputs">
                        <select name="buscador" id="navegador">
                            <option value="entrevista">Sanatorios</option>
                            <option value="medico">Medicos</option>
                            <option value="entrevista">Consultorios</option>
                        </select>
                    </div>

                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Medicos</label>
                        <select name="medico" id="navegador">
                            <option value=""></option>
                            <?php

                            require("../database/db_medico.php");
                            $medico = $conexion->query("SELECT medico.*,  persona.*
                            FROM medico
                            left join db_general.persona on medico.ID_persona_medico = persona.ID_persona");

                            while ($metodo = mysqli_fetch_assoc($medico)) {
                            ?>

                            <option value="<?php echo $metodo['ID_medico'] ?>">
                                <?php echo $metodo['Apellido_persona'] . " " . $metodo['Nombre_persona'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Estado</label>
                        <select name="estado" id="navegador">
                            <option value=""></option>
                            <?php
                            require("../database/db_general.php");
                            $est_entrevista = $conexionGeneral->query("SELECT * FROM estado");
                            while ($metodo1 = mysqli_fetch_row($est_entrevista)) {
                            ?>
                            <option value="<?php echo $metodo1[0] ?>"><?php echo $metodo1[0] . " - " . $metodo1[1]  ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Fecha Inicial</label>
                        <input type="date" name="fecha_inicial">
                    </div>

                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Fecha Final</label>
                        <input type="date" name="fecha_final">
                    </div>

                    <br>
                    <div class="container-inputs">
                        <input type="submit" value="Buscar">
                    </div>
                </fieldset>
            </form>
        </div>
</body>

</html