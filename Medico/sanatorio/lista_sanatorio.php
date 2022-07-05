<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/estilo_listas.css">

    <title>Sanatorios</title>
</head>
<body>
    <div class="container">

        <div class="title">
            <p><b>Lista de Sanatorios</b></p> <!-- En esta línea se encuentra el título de la interfaz -->
            <a href="agregar_sanatorio.php" target="paginaPrincipal"> <!-- nos enviará al formulario en donde podremos agregar un nuevo sanatorio -->
                <input type="button" value="Agregar sanatorio" class="blue"> 
            </a>
        </div>

        <div class="table-container">
            <table class="table">  <!-- Creamos una tabla donde nos mostraran los datos de los consultorios -->
                <thead>
                    <tr>
                        <th class="stiky">Domicilio</th>
                        <th class="stiky">Contacto</th>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Nombre</th>
                        <th class="stiky">Días</th>
                        <th class="stiky">Hora de Apertura</th>
                        <th class="stiky">Hora de Cierre</th>
                        <th class="stiky">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Llamamos a la base de datos 
                        require("../database/db_medico.php"); 

                        /*
                        linea 49: Seleccionamos las tablas a utilizar 
                        linea 50: La tabla de la cual traeremos los datos
                        linea 51: De la tabla domicilio traemos los datos del domicilio que coincida con el consultorio (ID_domicilio_consultorio)
                        linea 52: De la tabla contactos traemos los datos del contacto que coincida con el consultorio (ID_persona_referido)
                        linea 53: De la tabla persona traemos los datos del medico que coincida con el consultorio (ID_persona_medico)
                        */
                        
                        $sql = "SELECT sanatorio.*, domicilio.*, contactos.*,persona.*,medico.*
                        FROM sanatorio
                        LEFT JOIN db_general.domicilio on sanatorio.ID_domicilio_sanatorio = domicilio.ID_domicilio
                        LEFT JOIN db_general.contactos on sanatorio.ID_contacto_sanatorio = contactos.ID_contacto
                        LEFT JOIN  db_medico.medico  on sanatorio.ID_medico_sanatorio = medico.ID_medico
                        LEFT JOIN  db_general.persona  on medico.ID_persona_medico = persona.ID_persona";
                        $resultado = $conexion->query($sql) or die ($conexion->error);

                        while ($sanatorio = mysqli_fetch_assoc($resultado)){
                    ?>
                    <tr>

                        <!-- Esto nos permitira mostrar todos los datos en la lista del consutorio -->

                        <td><?php echo $sanatorio["Calle"], " ", $sanatorio["Numero"] ?></td>

                        <td><?php echo $sanatorio["Valor"] ?></td>

                        <td><?php echo $sanatorio["Apellido_persona"], " ", $sanatorio["Nombre_persona"] ?></td>

                        <td><?php echo $sanatorio["Nombre_Sanatorio"] ?></td>

                        <td><?php echo $sanatorio["Dias_sanatorio"] ?></td>

                        <td><?php echo $sanatorio["horaApertura_sanatorio"] ?></td>

                        <td><?php echo $sanatorio["horaCierre_sanatorio"] ?></td>

                        <!-- Al hacer clic el botón modificar, enviara el ID_sanatorio a la pantalla modificar para poder realizar cambios -->
                        <td><a href="modificar_sanatorio.php?id=<?php echo $sanatorio["ID_sanatorio"] ?>" class="botones">Modificar</a></td>


                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>