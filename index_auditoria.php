<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    session_start(); //abre el gestor de sesiones 
    $varsesion = $_SESSION['usuario']; //guarda la sesion llamada usuario en una variable
   
    //si la variable que guarda al usuario esta vacio es porque ningun usuario inicio sesion y por eso lo direcciona a index (formulario para iniciar sesion)
    if ($varsesion == null || $varsesion = '') {
        header("location:index.php");
    }else{
        if($_SESSION["area"] != "Auditoria Medica"){
            //si la sesion llamada area correspone a Auditoria medica lo redirecciona al index de su area
            echo "<script type=\"text/javascript\">window.location='Medico/frames/frame_paginaPrincipal.php';</script>";
        }
    }
   
?>
<FRAMESET ROWS=9%,* noresize>
    <!-- Los Frames que se mostraran -->
    <FRAME SRC="Medico/frames/frame_superior.php"></FRAME>
    <!-- Dimensiones de los frames -->
    <FRAMESET COLS=14%,66%,20% FRAMEBORDER=0>
        <FRAME SRC="Medico/frames/frame_navegador_AM.php" name="navegador"></FRAME> <!-- Frame izquierdo para mostrar el navegador -->
        <FRAME SRC="Medico/frames/frame_paginaPrincipal.php" name="paginaPrincipal"></FRAME> <!-- Frame centrar, muestra la pagina principal-->
        <FRAME SRC="Medico/frames/googleCalendar.php"></FRAME> <!-- Frame derecho para mostrar el calendario de google -->
    </FRAMESET>
</FRAMESET>
</html>