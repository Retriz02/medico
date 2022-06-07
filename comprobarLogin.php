<?php
    require("./database/db_general.php");

    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
    
    $sql = "SELECT usuarios.*,  persona.Apellido_persona, persona.Nombre_persona
    FROM usuarios
    left JOIN persona ON usuarios.ID_persona_usuario = persona.ID_persona
    where Contrasenia = '$contraseña' AND nombreUsuario = '$usuario'";
    $resultado1 = $mysqli->query($sql);
    $dato= mysqli_fetch_assoc($resultado1);

   
    
    $sql = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuario' AND Contrasenia = '$contraseña'";
    $resultado = $mysqli->query($sql);

    $filas = mysqli_num_rows($resultado);
 
    if ($filas) {
        session_start();

        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["nombre"] = $dato["Nombre_persona"];
        $_SESSION["apellido"] = $dato["Apellido_persona"];
        echo "<script type=\"text/javascript\">window.location='./COMERCIAL/index.php';</script>";
    } else {
        echo "<script type=\"text/javascript\">alert('¡Ingreso mal algun dato!'); window.location='index.php';</script>";
    }
