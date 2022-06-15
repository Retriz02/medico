<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
session_start();
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:../index.php");
}
?>
<FRAMESET ROWS=9%,* noresize>
    <FRAME SRC="frames/frame_superior.php"></FRAME>
    <FRAMESET COLS=14%,66%,20% FRAMEBORDER=0>
        <FRAME SRC="frames/frame_navegador_AM.php" name="navegador"></FRAME>
        <FRAME SRC="frames/frame_paginaPrincipal.php" name="paginaPrincipal"></FRAME>
        <FRAME SRC="frames/googleCalendar.php"></FRAME>
    </FRAMESET>
</FRAMESET>
</html>