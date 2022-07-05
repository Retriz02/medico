<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/verQR.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php
        session_start();
        $ID_usuario = $_SESSION["ID_usuario"];

        require("database/db_general.php");
        $sql = "SELECT * FROM usuarios WHERE ID_usuario = $ID_usuario";
        $resultado = $conexionGeneral->query($sql);
        $dato = $resultado->fetch_assoc();
        ?>

        <center>
            <div class="logo">
                <a href="javascript:void(0)" class="closebtn" onclick="location.href='frames/frame_paginaPrincipal.php'">&times;</a>
            </div>

            <img width="200" height="200" src="data:image/png;base64,<?php echo  base64_encode($dato['Cod_QR']); ?>">
        </center>
        <div class="container-inputs">
            <center>
                <a href="../Documentacion_comercial/<?php echo $dato['pdf_Datos_Personales'] ;?>">Compartir</a>
            </center>
        </div>
    </div>
</body>

</html>