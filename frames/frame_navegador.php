<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navegador.css">
    <title>Document</title>

</head>

<body>

    <div class="contenedor">
        <div class="container">
            <fieldset class="container-navegador">
                <legend class="titulos" align="center"><b>Navegador</b></legend>
                <div class="container-links">
                    <a href="../entrevista1.php" target="paginaPrincipal">
                        <input type="button" value="Entrevistas">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../consultorio1.php" target="paginaPrincipal">
                        <input type="button" value="Consultorio">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../sanatorio1.php" target="paginaPrincipal">
                        <input type="button" value="Sanatorio">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../medico1.php" target="paginaPrincipal">
                        <input type="button" value="Medicos">
                    </a>
                </div>
                <div class="container-links">
                    <a href="../agenda1.php" target="paginaPrincipal">
                        <input type="button" value="Agenda">
                    </a>
                </div>
            </fieldset>
        </div>
        <div class="container">
            <form action="buscadorReferidos.php" method="post">
                <fieldset class="container-buscador">
                    <legend class="titulos" align="center"><b>Buscador</b></legend>
                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Navegador</label>
                        <select name="navegador" id="navegador">
                            <option value="entrevista">Entrevistas</option>
                            <option value="referido">Medicos</option>
                            <option value="evento">Agenda</option>
                        </select>
                    </div>
                    <div class="container-inputs">
                        <label for="nav" class="container-inputs-label">Medicos</label>
                        <select name="referido" id="">
                            <?php
                            require("../medicos.php");
                            $referido = $conexion->query("SELECT * FROM medico");
                            while ($metodo = mysqli_fetch_row($referido)) {
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