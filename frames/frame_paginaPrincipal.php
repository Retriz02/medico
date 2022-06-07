<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="frame_pantallaPrincipal.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Open+Sans" rel="stylesheet"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <div class="container-datos">
            <fieldset class="fieldset">
                <legend>Datos Personales</legend>
                <div class="usuario-area">
                    <table>
                        <tr>
                            <td>
                                <b>Fecha:</b><?php echo date("d-m-Y"); ?>
                            </td>
                            <td><b>Hora: </b><?php date_default_timezone_set('America/Argentina/Buenos_Aires');
                                                $DateAndTime = date('h:i:s a', time());
                                                echo "$DateAndTime."; ?>
                            </td>

                            <td>
                                <img src="../img/qr.svg" alt="">
                                <br>
                                <a href=""><button>Compartir</button></a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Usuario: </b><?php session_start();
                                                echo $_SESSION["nombreUsuario"] ?>
                            </td>

                            <td>
                                <b>Área: </b><?php echo $_SESSION["area"] ?>
                            </td>
                        </tr>

                    </table>
                </div>
            </fieldset>
        </div>
    </div>

</body>

</html>