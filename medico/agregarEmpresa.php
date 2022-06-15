<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos_comercial/agregarEntrevistas.css">
    <title>Document</title>
   
</head>
<body>
<div class="container">
        <div class="title">Agregar Empresa</div>
        <form action="" method="post">
        <span class="details">Nombre de la Empresa</span>
                    <div class="input-box" align="center">
                        <input type="text" name="nombre" required>

                    </div>
           
            <div class="botones">
                <a href="rellenar.php">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["aceptar"])) {
        require("../../database/db_comercial.php");

        $nom_empresa = $_POST["nombre"];
       
        $nuevaEmpresa = "INSERT INTO empresas (Nombre_empresa) VALUES 
        ('$nom_empresa')";
        $resultado = $mysqli->query($nuevaEmpresa);

        echo "<script type=\"text/javascript\"> window.location='../Referidos/modificarReferido.php';</script>";

      
    } ?>
</body>
</html>