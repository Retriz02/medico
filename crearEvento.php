<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos_comercial/crearEntrevistas.css">
    <title>Document</title>
</head>

<body>
    <div class="global">
        <h1 class="title-entrevista">CREAR UN EVENTO</h1>
        <div class="global-content">
            <form action="#" method="post">
                <div class="container">
                    <fieldset>
                        <legend>Promotor y Referido</legend>
                        <div class="container-prom-ref">
                            <div class="cont-usuario-datos">
                                <label for="">Promotor Inicial</label>
                                <select name="promotor_inicial" id="">
                                    <?php
                                    require("./database/bd_general.php");
                                    $promotor = $bd_general->query("SELECT * FROM persona order by Nombre");
                                    while ($metodo = mysqli_fetch_row($promotor)) {
                                    ?>
                                        <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[9] . " - " . $metodo[7] . " " . $metodo[6] ?></option>
                                    <?php } ?>
                                </select>
                                <button class="btn-agregar" id="btn-abrir-popup" class="btn-abrir-poput">+</button>
                            </div>
                            <div class="cont-usuario-datos">
                                <label for="">Promotor Final</label>
                                <select name="promotor_final" id="">
                                    <?php
                                    require("./database/bd_general.php");
                                    $promotor = $bd_general->query("SELECT * FROM persona order by Nombre");
                                    while ($metodo = mysqli_fetch_row($promotor)) {
                                    ?>
                                        <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[9] . " - " . $metodo[7] . " " . $metodo[6] ?></option>
                                    <?php } ?>
                                </select>
                                <button class="btn-agregar" id="btn-abrir-popup" class="btn-abrir-poput">+</button>
                            </div>
                            <div class="cont-usuario-datos">
                                <label for="">Referido</label>
                                <select name="referido" id="">
                                    <?php
                                    require("./database/bd_general.php");
                                    $promotor = $bd_general->query("SELECT * FROM persona order by Nombre");
                                    while ($metodo = mysqli_fetch_row($promotor)) {
                                    ?>
                                        <option value="<?php echo $metodo[0] ?>"><?php echo $metodo[9] . " - " . $metodo[7] . " " . $metodo[6] ?></option>
                                    <?php } ?>
                                </select>
                                <button class="btn-agregar" id="btn-abrir-popup" class="btn-abrir-poput">+</button>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="container">
                    <fieldset class="domicilio">
                        <legend align="left">Domicilio</legend>
                        <select value="Provincias" name="domicilio">
                            <option value="1">Provincia "Formosa" Localidad "Formosa" Barrio "Eva Perón" Calle "Raul Alfonsín" Numero "4"</option>
                            <option value="2">Provincia "Formosa" Localidad "Formosa" Calle "Corrientes" Numero "3"</option>
                            <option value="3">Provincia "Chaco" Localidad "Charata" Barrio "Villa Berth"</option>

                        </select>
                        <button class="btn-agregar" id="btn-abrir-popup" class="btn-abrir-poput">+</button>
                    </fieldset>
                </div>

                <div class="container">
                    <fieldset>
                        <legend>Otros Datos</legend>
                        <div class="container-prom-ref">
                            <div class="cont-usuario-datos">
                                <label for="">Estado Evento</label>
                                <select name="estado_evento" id="">
                                    <?php
                                    require("./database/bd_general.php");
                                    $estado_entrevista = $bd_general->query("SELECT * FROM estado");
                                    while ($metodo = mysqli_fetch_row($estado_entrevista)) {
                                    ?>
                                        <option value="<?php echo $metodo[1] ?>"><?php echo $metodo[0] . " - " . $metodo[1] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="container">
                    <fieldset>
                        <legend>Horario</legend>

                        <div class="cont-horario">
                            <input type="date" class="fecha-horario" name="fecha" required><input type="time" class="fecha-horario" name="horario" required>
                        </div>
                    </fieldset>
                </div>
                <div class="container">
                    <fieldset>
                        <legend>Observaciones</legend>
                        <textarea class="textarea-observacion" placeholder="Escriba sus observaciones..." maxlength="1000" cols="60" rows="8" name="observaciones"></textarea>
                    </fieldset>
                </div>
                <div class="botones" class="container">
                    <button onclick="location.href='listaEntrevistas.php'">Cancelar</button>
                    <input type="submit" name="aceptar" value="Aceptar">
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST["aceptar"])) {
        require("./database/bd_comercial.php");

        $promotor_inicial = $_POST["promotor_inicial"];
        $promotor_final = $_POST["promotor_final"];
        $referido = $_POST["referido"];
        $domicilio = $_POST["domicilio"];
        $estado_evento = $_POST["estado_evento"];
        $fecha = $_POST["fecha"];
        $horario = $_POST["horario"];
        $observacion = $_POST["observaciones"];

        $nuevoEvento = "INSERT INTO evento (ID_usuario_inicio_evento,ID_usuario_final_evento, ID_referido_evento, ID_domicilio_Evento, ID_estado_evento, Fecha, Horario, Observacion) VALUES 
        ('$promotor_inicial','$promotor_inicial','$referido','$domicilio','$estado_evento','$fecha','$horario','$observacion')";
        $resultado = $mysqli->query($nuevoEvento);

        echo "<script type=\"text/javascript\"> window.location='listaEventos.php';</script>";
    } ?>

</body>
</html>