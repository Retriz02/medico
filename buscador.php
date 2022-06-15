<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/estilo_listas.css">
    <title>Document</title>
</head>
<?php
    session_start();
    $datoUsuario = $_SESSION["ID_usuario"];
?>

<body>
    <?php

    require("database/db_medico.php");

    $tipo = $_POST['buscador'];
    $medico = $_POST['medico'];
    $estado = $_POST['estado'];
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_final = $_POST['fecha_final'];
    $sanatorio = $_POST['sanatorio'];
    $consultorio = $_POST['consultorio'];

    if ($tipo == "entrevista") {
    ?>
        <?php
        $sql = "SELECT entrevistas.*, productos.descripcion_producto, estado.Descripcion_estado, persona.Nombre_persona, persona.Apellido_persona
        FROM entrevistas
        left join productos on entrevistas.ID_producto_entrevista = productos.ID_producto
        left join db_general.estado on entrevistas.ID_estado_entrevista = estado.ID_estado
        left JOIN referidos ON entrevistas.ID_referido_entrevista = referidos.ID_referido 
        left JOIN db_general.persona ON referidos.ID_persona_referido = persona.ID_persona
        where ID_usuario_entrevista = '$datoUsuario' or ID_referido_entrevista = '$referido' or ID_estado_entrevista = '$estado' or ID_producto_entrevista = '$producto' or fecha >= '$fecha_inicial' or fecha <= '$fecha_final'";
        $resultado = $mysqli->query($sql);
        ?>
        <div class="container">
            <div class="title">
                <p><b>Lista de las Entrevistas</b></p>
                <a href="./Entrevistas/agregarEntrevistas.php" target="paginaPrincipal">
                    <input type="button" value="Agregar  Entrevista" class="blue">
                </a>
            </div>
            <div class="table-container">
                <table class="table">

                    <thead>
                        <tr>
                            <th class="stiky">Referido</th>
                            <th class="stiky">Fecha</th>
                            <th class="stiky">Horario</th>
                            <th class="stiky">Observación</th>
                            <th class="stiky">Opciones</th>
                            <th class="stiky">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($Entrevistas = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <tr>

                                <td><?php echo $Entrevistas["Nombre_persona"] . " " . $Entrevistas["Apellido_persona"] ?></td>

                                <td><?php echo $Entrevistas["fecha"] ?></td>

                                <td><?php echo $Entrevistas["horario"] ?></td>

                                <td class="datos"><?php echo $Entrevistas["observaciones"] ?></td>

                                <td>
                                    <a href="./Entrevistas/eliminarEntrevista.php?id= <?php echo $Entrevistas["ID_entrevista"] ?>" class="botones">Eliminar</a>
                                    <a href="./Entrevistas/modificarEntrevista.php?id= <?php echo $Entrevistas["ID_entrevista"] ?>" class="botones">Modificar</a>
                                </td>


                                <?php
                                if ($Entrevistas['Descripcion_estado'] == "Abierto") {
                                    echo "<td class='yellow'>";
                                    echo $Entrevistas["Descripcion_estado"], "</td>";
                                }
                                if ($Entrevistas['Descripcion_estado'] == "Cerrado") {
                                    echo "<td class='green'>";
                                    echo $Entrevistas["Descripcion_estado"], "</td>";
                                }
                                if ($Entrevistas['Descripcion_estado'] == "Cancelado") {
                                    echo "<td class='red'>";
                                    echo $Entrevistas["Descripcion_estado"], "</td>";
                                }
                                if ($Entrevistas['Descripcion_estado'] == "Postergado") {
                                    echo "<td class='orange'>";
                                    echo $Entrevistas["Descripcion_estado"], "</td>";
                                }
                                ?>

                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>

    <?php
    if ($tipo == "evento") {
    ?>
        <?php
        $sql = "SELECT eventos.*, estado.Descripcion_estado, persona.Nombre_persona, persona.Apellido_persona, estado.Descripcion_estado
        FROM eventos
        left join db_general.estado on eventos.ID_estado_evento= estado.ID_estado
        left JOIN referidos ON eventos.ID_referido_evento = referidos.ID_referido 
        left JOIN db_general.persona ON referidos.ID_persona_referido = persona.ID_persona
        where ID_usuario_inicio_evento = '$datoUsuario' or ID_usuario_final_evento = '$datoUsuario' or ID_referido_evento = '$referido' or ID_estado_evento = '$estado' or ID_producto_evento = '$producto' or fecha >= '$fecha_inicial' or fecha <= '$fecha_final'";
        $resultado = $mysqli->query($sql);

        ?>
        <div class="container">
            <div class="title">
                <p><b>Lista de los Eventos</b></p>
                <a href="./Eventos/agregarEvento.php" target="paginaPrincipal">
                    <input type="button" value="Agregar Evento" class="blue">
                </a>

            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="stiky">Referido</th>
                            <th class="stiky">Fecha_Evento</th>
                            <th class="stiky">Horario</th>
                            <th class="stiky">Observación</th>
                            <th class="stiky">Opciones</th>
                            <th class="stiky">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($Eventos = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <tr>

                                <td><?php echo $Eventos["Nombre_persona"] . " " . $Eventos["Apellido_persona"] ?></td>

                                <td><?php echo $Eventos["fecha"] ?></td>

                                <td><?php echo $Eventos["horario"] ?></td>

                                <td><?php echo $Eventos["observaciones"] ?></td>

                                <td>
                                    <a href="./Eventos/eliminarEvento.php?id= <?php echo $Eventos["ID_evento"] ?>" class="botones">Eliminar</a>
                                    <a href="./Eventos/modificarEvento.php?id= <?php echo $Eventos["ID_evento"] ?>" class="botones">Modificar</a>
                                </td>

                                <?php
                                if ($Eventos['Descripcion_estado'] == "Abierto") {
                                    echo "<td class='yellow'>";
                                    echo $Eventos["Descripcion_estado"], "</td>";
                                }
                                if ($Eventos['Descripcion_estado'] == "Cerrado") {
                                    echo "<td class='green'>";
                                    echo $Eventos["Descripcion_estado"], "</td>";
                                }
                                if ($Eventos['Descripcion_estado'] == "Cancelado") {
                                    echo "<td class='red'>";
                                    echo $Eventos["Descripcion_estado"], "</td>";
                                }
                                if ($Eventos['Descripcion_estado'] == "Postergado") {
                                    echo "<td class='orange'>";
                                    echo $Eventos["Descripcion_estado"], "</td>";
                                }
                                ?>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>


    <?php
    if ($tipo == "referido") {
    ?>
        <?php

        $sql = "SELECT referidos.*,  persona.Nombre_persona,persona.Apellido_persona, empresas.Nombre_empresa
        FROM referidos
        left join db_general.persona on referidos.ID_persona_referido = persona.ID_persona
        left join empresas on referidos.ID_empresa_referido = empresas.ID_empresa
        where ID_referido = '$referido' or ID_empresa_referido = '$empresa'";
        $resultado = $mysqli->query($sql);

        ?>
        <div class="container">
            <div class="title">
                <p><b>Lista de los Referidos</b></p>
                <a href="./Referidos/agregarReferidos.php" target="paginaPrincipal">
                    <input type="button" value="Agregar Referidos" class="blue">
                </a>

            </div>
            <div class="table-container">
                <table class="table">

                    <thead>
                        <tr>

                            <th class="stiky">Provincia</th>
                            <th class="stiky">Nombre y Apellido</th>
                            <th class="stiky">Empresa</th>
                            <th class="stiky">Domicilio</th>
                            <th class="stiky">Contacto</th>
                            <th class="stiky">Funciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($Referidos = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <tr>

                                <td>
                                    <?php
                                    $ID = $Referidos["ID_persona_referido"];
                                    $sql = "SELECT referidos.*, persona.*, personadomicilio.*, domicilio.*, localidades.*, provincias.*
                                from referidos
                                left join db_general.persona     on referidos.ID_persona_referido = persona.ID_persona
                                left join db_general.personadomicilio on persona.ID_persona = personadomicilio.ID_persona_personaDomicilio
                                left join db_general.domicilio   on db_general.personadomicilio.ID_domicilio_personaDomicilio = domicilio.ID_domicilio
                                left join db_general.localidades on db_general.domicilio.ID_localidad_domicilio = localidades.ID_localidad
                                left join db_general.provincias  on db_general.localidades.ID_provincia_localidad = provincias.ID_provincia                               
                                where ID_persona_referido = '$ID'";
                                    $resultado2 = $mysqli->query($sql);
                                    $ReferidosDomicilio = mysqli_fetch_assoc($resultado2);


                                    echo $ReferidosDomicilio["Nombre_provincia"];
                                    ?>

                                </td>

                                <td><?php echo $Referidos["Nombre_persona"] . " " . $Referidos["Apellido_persona"] ?></td>

                                <td> <?php echo $Referidos["Nombre_empresa"] ?> </td>

                                <td><?php echo $ReferidosDomicilio["Nombre_localidad"] . " " . $ReferidosDomicilio["Calle"] . " " . $ReferidosDomicilio["Numero"] ?></td>

                                <td>
                                    <?php
                                    $ID = $Referidos["ID_persona_referido"];
                                    $sql = "SELECT referidos.*, persona.*, personacontactos.*, contactos.*
                                from referidos
                                left join db_general.persona on referidos.ID_persona_referido = persona.ID_persona
                                left join db_general.personacontactos on persona.ID_persona = personacontactos.ID_persona_persona_contacto
                                left join db_general.contactos on db_general.personacontactos.ID_contacto_persona_contacto = contactos.ID_contacto
                                where ID_persona_referido = '$ID'";
                                    $resultado3 = $mysqli->query($sql);
                                    $ReferidosContacto = mysqli_fetch_assoc($resultado3);


                                    echo $ReferidosContacto["Valor"];
                                    ?>

                                </td>

                                <td><a href="./Referidos/eliminarReferido.php?id= <?php echo $Referidos["ID_referido"] ?>" class="botones">Eliminar</a> <a href="./Referidos/modificarReferido.php?id= <?php echo $Referidos["ID_referido"] ?>" class="botones">Modificar</a></td>


                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>



</body>

</html>