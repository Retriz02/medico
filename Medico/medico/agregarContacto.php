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
        <div class="title">Agregar Contacto</div>
        <form action="" method="post">
           
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Tipo Contacto</span>
                        <select name="tipoContacto" id="">
                            <?php
                            require("../../database/db_general.php");
                            $tipoContacto = $mysqli->query("SELECT * FROM tipocontactos");
                            while ($metodo = mysqli_fetch_row($tipoContacto)) {
                            ?>
                                <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[1] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">Valor</span>
                        <input type="text" name="valor" required>
                      

                    </div>
                </div>
          
            <div class="botones">
                <a href="rellenar.php">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["aceptar"])) {
        require("../../database/db_general.php");

        $tipocontacto = $_POST["tipoContacto"];
        $valor = $_POST["valor"];

        $nuevocontacto = "INSERT INTO contactos (ID_tipoContacto_contacto, Valor) 
        VALUES ('$tipocontacto','$valor')";
        $resultado = $mysqli->query($nuevocontacto);

        echo "<script type=\"text/javascript\"> window.location='rellenar.php';</script>";

    } ?>


</body>

</html>



