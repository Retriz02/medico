<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/estilo_navegador.css">
    <title>OSDE</title>

</head>
<!--Este frame es el izquierdo superior donde se encuentran los botones para navegar entre pantallas--->
<body>

    <div class="contenedor">
        <div class="container">
            <fieldset class="container-navegador">
                <legend class="titulos" align="center"><b>Navegador</b></legend>
                <div class="container-links">
                    <a href="../entrevistas_medico/lista_entrevista.php" target="paginaPrincipal">
                        <input type="button" value="Entrevistas">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../tareas/lista_tarea.php" target="paginaPrincipal">
                        <input type="button" value="Tareas">
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
                <div class="container-links">
                    <a href="../medico/lista_medico.php" target="paginaPrincipal">
                        <input type="button" value="Medicos">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../agenda/lista_agenda.php" target="paginaPrincipal">
                        <input type="button" value="Agenda">
                    </a>
                </div>
            </fieldset>
        </div>

        <div class="container">
            <form action="buscador_medicos.php" method="post">
                <fieldset class="container-buscador">
                    <legend class="titulos" align="center"><b>Buscador</b></legend>
                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Navegador</label>
                        <select name="navegador" id="navegador">
                            <option value="entrevista">Entrevistas</option>
                            <option value="medicos">Medicos</option>
                            <option value="evento">Agenda</option>
                        </select>
                    </div>
                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Medicos</label>
                        <select name="medicos" id="">
                            <?php
                            require("../database/db_medico.php");
                            $medico = $conexion->query("SELECT * FROM medico");
                            while ($metodo = mysqli_fetch_row($medico)) {
                            ?>
                                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[5] . " - " . $metodo[4] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="container-inputs">
                        <input type="submit" value="Buscar">
                    </div>
                </fieldset>
            </form>
        </div>
</body>

</html