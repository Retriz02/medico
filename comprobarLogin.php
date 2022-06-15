<?php
    require("database/db_general.php");

    //ACLARACION: Formulario = index.php | Es el login donde nos identificamos
    
    $usuario = $_POST["usuario"]; //se toma del formulario el usuario
    $password = $_POST["password"]; //se toma del formulario la contrasenia
    
    //Seleciona al usuario ingresado y consulta a que persona esta indexada y al area que pertenece 
    $sql = "SELECT usuarios.*, area.*, persona.*
    FROM usuarios
    LEFT JOIN persona ON usuarios.ID_persona_usuario = persona.ID_persona
    LEFT JOIN area ON usuarios.ID_area_usuario = area.ID_area
    WHERE Contrasenia = '$password' AND nombreUsuario = '$usuario'";

    $resultado = $conexionGeneral->query($sql);
    $dato= mysqli_fetch_assoc($resultado);
    
    //selecciona todos los campos de usuario donde el nombre de usuario y su contrasenia coincidan con los ingresados en el formulario
    $sql1 = "SELECT * FROM usuarios WHERE nombreUsuario = '$usuario' AND Contrasenia = '$password'";
    $resultado1 = $conexionGeneral->query($sql1);

    $filas = mysqli_num_rows($resultado1); //crea un array con esos datos
 
    if ($filas) {
        /*si el array tiene datos quiere decir que el usuario si existe e ingreso los 
        datos correctamente, por lo tanto se inicia una sesion*/
        session_start();

        //definimos sesiones diferentes para guardar los datos del usuario que seran utiles en otras pantallas
        $_SESSION["ID_persona"] = $dato["ID_persona"];
        $_SESSION["ID_area"] = $dato["ID_area"];
        $_SESSION["ID_usuario"] = $dato["ID_usuario"];
        
        $_SESSION["usuario"] = $_POST["usuario"]; //usuario ingresado en el formulario
        $_SESSION["apellido"] = $dato["Apellido_persona"];   
        $_SESSION["nombre"] = $dato["Nombre_persona"];
        $_SESSION["nombreUsuario"] = $dato["nombreUsuario"];
        $_SESSION["area"] = $dato["Descripcion_area"];

        //redirigimos al usuario a la pantalla principal porque su sesion ya se encuentra iniciada
        if ($_SESSION["area"] == "Comercial"){
            echo "es comercial";
        }elseif($_SESSION["area"] == "Auditoria Medica"){
            echo "<script type=\"text/javascript\">window.location='index_auditoria.php';</script>";
        }else{
            echo "<script type=\"text/javascript\">window.location='index_general.php';</script>";
        }

    } else {
        //si los datos que ingreso en el formulario no son correctos le llevara nuevamente hacia alli
        echo "<script type=\"text/javascript\">alert('Los datos que se han ingresado no son correctos'); window.location='index.php';</script>";
    }
