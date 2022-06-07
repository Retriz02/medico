<!DOCTYPE html>
<html lang="en">

<?php
    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // destroy the session 
        session_destroy(); 
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilosIndex.css">
    <title>login</title>
</head>

<body>

<div class="contenedor-login">
    <form action="comprobarLogin.php" method="POST" class="form">
        
        <img src="img/logo.svg" alt="Osde Logo" class="logo" srcset="">
                   
            <div class="datosUsuario">
                <span class="forgetPass"><a href="">Olvide mis datos</a></span>
                    <div class="dato-sesion">

                           <input name="usuario" class="usuario" type="text" placeholder="Usuario" >
                           <input name="password" class="password"  type="password" placeholder="Contraseña">
                           <input class="btn-login" name="iniciar" type="submit" value="Iniciar Sesion">
                </div>
            </div>

    </form>
</div>


</body>

</html>