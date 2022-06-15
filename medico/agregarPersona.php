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

<?php
 require("../../database/db_general.php")
?>
    <div class="container">
        <div class="title">Agregar Persona</div>
        <form action="#" method="post">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Nombre</span>
                    <input type="text" name="nombre">
                </div>

                <div class="input-box">
                    <span class="details">Apellido</span>
                    <input type="text" name="apellido" required>
                </div>
            </div>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Estado Laboral</span>
                    <select name="estadolaboral" id="" class="selectEstado">
                        <?php
                        $sql1 = $mysqli->query("SELECT * FROM estadolaboral");
                        while ($metodo1 = mysqli_fetch_row($sql1)) {
                        ?>
                            <option value="<?php echo $metodo1[0] ?>"><?php echo $metodo1[0], " - ", $metodo1[1] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="input-box">
                    <span class="details">Estado Civil</span>
                    <select name="estadocivil" id="" class="selectEstado">
                        <?php
                        $sql = $mysqli->query("SELECT * FROM estadocivil");
                        while ($metodo = mysqli_fetch_row($sql)) {
                        ?>
                            <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[0], " - ", $metodo[1] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Fecha de Nacimiento</span>
                    <input type="date" name="fecha_nac">
                </div>
                <div class="input-box">
                    <span class="details">D.N.I</span>
                    <input type="text" name="DNI">
                </div>
            </div>

            <div class="botones">
                <a href="">Cancelar</a>
                <input type="submit" value="Aceptar" name="aceptar">
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["aceptar"])) {

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $estadolaboral = $_POST["estadolaboral"];
        $estadocivil = $_POST["estadocivil"];
        $fechanac = $_POST["fecha_nac"];
        $dni = $_POST["DNI"];

        $nuevaPersona = "INSERT INTO persona(ID_estadoLaboral_persona, ID_estadoCivil_persona, Apellido_persona, Nombre_persona, DNI, Fec_nac) 
        VALUES ('$estadolaboral','$estadocivil','$apellido','$nombre','$dni','$fechanac')";
        $resultado = $mysqli->query($nuevaPersona);

        echo "<script type=\"text/javascript\"> window.location='rellenar.php';</script>";
    } ?>

</body>

</html>
