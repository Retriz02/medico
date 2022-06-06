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
                <div class="fecha"><b>Fecha: </b> 18/04/2022</div>
                <div class="usuario-area">
                    <p><b>Usuario:</b>43434 </p>
                    <p><b>Area: </b> Auditoría Médica</p>
                </div>
                <button id="btn-abrir-popup" class="btn-abrir-popup">Cambiar Contraseña</button>
            </fieldset>
        </div>
        <div class="container-qr">
            <span class="title">Código QR</span>
            <div>
                <img src="../img/qr.svg" alt="">
            </div>
            <div class="container-links">
                <a href="#">
                <input type="image" src="../img/imprimir.jpg" class="image_buscar">
                </a>
            </div>
            <div class="container-links">
                <a href="#">
                <input type="image" src="../img/compartirQR.png" class="image_buscar">
                </a>
            </div>
        </div>
    </div>



    <div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>Cambiar Contraseña</h3>
				<form action="">
					<div class="contenedor-inputs">
						<input type="text" placeholder="Contraseña Actual">
						<input type="email" placeholder="Nueva Contraseña">
                        <input type="email" placeholder="Confirmar Contraseña">
					</div>
					<input type="submit" class="btn-submit" value="Confirmar">
                    <input type="submit" class="btn-submit" value="Cancelar">
                
				</form>
			</div>
		</div>
	</div>
	<script src="popup.js"></script>
   
</body>

</html>