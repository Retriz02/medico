<?php
    require("general.php");

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    
    $sql = "SELECT usuarios.*, area.*, persona.ApellidoP, persona.NombreP
    FROM usuarios
    LEFT JOIN persona ON usuarios.ID_persona_usuario = persona.ID_persona
    LEFT JOIN area ON usuarios.ID_area_usuario = area.ID_area
    where Contrasenia = '$password' AND nombreUsuario = '$usuario'";
    $resultado = $conexionGeneral->query($sql);
    $dato= mysqli_fetch_assoc($resultado);
    
    $sql1 = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuario' AND Contrasenia = '$password'";
    $resultado1 = $conexionGeneral->query($sql1);

    $filas = mysqli_num_rows($resultado1);
 
    if ($filas) {
        session_start();

        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["nombre"] = $dato["NombreP"];
        $_SESSION["apellido"] = $dato["ApellidoP"];

        $_SESSION["nombreUsuario"] = $dato["nombreUsuario"];
        $_SESSION["area"] = $dato["Descripcion_area"];
        echo "<script type=\"text/javascript\">window.location='frames/index.php';</script>";
    } else {
        echo "<script type=\"text/javascript\">alert('Los datos que se han ingresado no son correctos'); window.location='index.php';</script>";
    }
