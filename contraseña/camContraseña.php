<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/estilo_camContraseña.css">
    <title>Document</title>
</head>

<body>
    <!-- --------Ventana para cambiar contraseña--------- -->

    <div class="container">
        <div class="title">Cambiar Contraseña</div>
        <form action="#" method="post">

            <fieldset>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Contraseña Nueva</span>
                        <input type="text" name="nueva" placeholder="Ingrese su nueva contraseña">
                    </div>
                </div>
            </fieldset>

            <div class="botones">
                <a href="../frames/frame_paginaPrincipal.php" target="paginaPrincipal">Cancelar</button></a>
                <input type="submit" value="Aceptar" name="cambiar">
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST["cambiar"])) {
        session_start();
        $ID_usuario = $_SESSION["ID_usuario"];

        require("../database/db_general.php");

        $nueva = $_POST["nueva"];
        $nuevacontraseña = "UPDATE usuarios SET Contrasenia = '$nueva' WHERE ID_usuario = '$ID_usuario'";
        $resultado = $mysqli->query($nuevacontraseña);

        echo "<script> window.location='../frames/frame_paginaPrincipal.php';</script>";
    } ?>
    </div>
</body>

</html>