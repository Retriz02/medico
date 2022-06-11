<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="../styles/frame_superior.css">
    <title>OSDE</title>
</head>

<body>
<header>
        <div class="container">
            <nav class="main-nav">
                <div class="logo">
                    <span><a href="frame_paginaPrincipal.php" target="paginaPrincipal"><img src="../img/logo-OSDE.jpg.jpeg" alt=""></a></span>
                </div>
                    <ul><!--Toma el nombre y apellido del usuario de la sesion-->
                        <li><a href="#"><?php session_start(); echo $_SESSION["nombre"] ." ". $_SESSION["apellido"]?></a></li>
                        <li><a href="../cerrar_sesion.php" target="_top">Cerrar Sesion</a></li>
                    </ul>
            </nav>
        </div>
    </header>
</body>

</html>