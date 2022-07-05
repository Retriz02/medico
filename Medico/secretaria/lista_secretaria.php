<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloTablas.css">
    <script src="confirmacion/confirmacion.js"></script>
    
    <title>Document</title>
</head>

<body>
    <p>Lista de las Secretarias
        <a href="agregarSecretaria.php" target="paginaPrincipalSecretaria"> <!-- Con esto creamos un etiqueta para agregar una nueva lista  en el Frama Principal -->
            <input type="button" value="Agregar una nueva Secretaria"> <!-- Esto nos permitira redireccionar a una pagina que nos permitira agregar una nueva secretaria a la lista -->
        </a> 
    </p>
    <?php
        
        // Llamamos a la base de datos
        require("secretaria.php");

        $sql = "SELECT * FROM Secretaria"; // Seleccionamos la tabla a utilizar 

        $resultado = $conexion->query($sql); 
    ?>

    <div class="page-container">
        <div class="table-container">
            <table id="main-container" class="table-cebra"> <!-- Aqui creamos una tabla donde se van a mostrar cada campos para colocar los datos de la nueva secretaria -->
                <thead>
                    <tr>
                        <!-- <th class="stiky">#</th> -->
                        <th class="stiky">ID Secretaria</th>
                        <th class="stiky">Persona</th>
                        <th class="stiky">Tipo De Domicilio Laboral</th>
                        <th class="stiky">Nombre De Domicilio</th>
                        <th class="stiky">Fecha Laboral</th>
                        <th class="stiky">Horario Laboral</th>
                        <th class="stiky">Turno Laboral</th>
                        <th class="stiky">Contacto Secretaria</th>
                        <th class="stiky">Eliminar</th>
                        <th class="stiky">Modificar</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Mientas que el array tenga  todo los contenidos nuevos nos va a inprimir en $resultado
                    while ($secretaria = mysqli_fetch_assoc($resultado)) {

                        require('secretaria.php');
                        
                    ?>
                        <tr>
                            <!-- Con esto imprimimos por pantalla el id de la secretaria -->
                            <td><?php echo $secretaria["ID_secretaria"] ?></td>

                            <!-- Con esto imprimimos por pantalla el nombre de la persona -->
                            <td><?php echo $secretaria["ID_persona_secretaria"] ?></td>
                            
                            <!-- Con esto imprimimos por pantalla el tipo domicilio que tiene la secretaria -->
                            <td><?php echo $secretaria["ID_tipodomicilio"] ?></td>

                            <!-- Con esto imprimimos por pantalla el nombre del domicilio de la secretaria -->
                            <td><?php echo $secretaria["nombredomicilio"] ?></td>

                            <!-- Con esto imprimimos por pantalla la fecha laboral de la secretaria -->
                            <td><?php echo $secretaria["fechalaboral"] ?></td>

                            <!-- Con esto imprimimos por pantalla el horario laboral de la secretaria -->
                            <td><?php echo $secretaria["horariolaboral"] ?></td>

                            <!-- Con esto imprimimos por pantalla el turno laboral en la que la secretaria trabaja-->
                            <td><?php echo $secretaria["turnolaboral"] ?></td>

                            <!-- Con esto imprimimos por pantalla los contactos de la secretaria -->
                            <td><?php echo $secretaria["contactosecretaria"] ?></td>

                            <!-- Creamos un boton que nos permitira eliminar a la secretaria -->
                            <td><a href="eliminar_secretaria.php?id=<?php echo $secretaria["ID_secretaria"] ?>"><button> Eliminar </button></a></td>

                            <!-- Creamos un boton que nos permitira modificar a la secretaria -->
                            <td><a href="modificar_secretaria.php?id=<?php echo $secretaria["ID_secretaria"] ?>"><button> Modificar </button></a></td>
                          

                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</body>

</html>