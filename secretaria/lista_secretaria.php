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
        <a href="agregarSecretaria.php" target="paginaPrincipalSecretaria">
            <input type="button" value="Agregar una nueva Secretaria">
        </a>
    </p>
    <?php

        require("secretaria.php");

        $sql = "SELECT * FROM Secretaria";

        $resultado = $conexion->query($sql);
    ?>

    <div class="page-container">
        <div class="table-container">
            <table id="main-container" class="table-cebra">
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
                    while ($secretaria = mysqli_fetch_assoc($resultado)) {

                        require('secretaria.php');
                        
                    ?>
                        <tr>
                            <td><?php echo $secretaria["ID_secretaria"] ?></td>

                            <td><?php echo $secretaria["ID_persona_secretaria"] ?></td>

                            <td><?php echo $secretaria["ID_tipodomicilio"] ?></td>

                            <td><?php echo $secretaria["nombredomicilio"] ?></td>

                            <td><?php echo $secretaria["fechalaboral"] ?></td>

                            <td><?php echo $secretaria["horariolaboral"] ?></td>

                            <td><?php echo $secretaria["turnolaboral"] ?></td>

                            <td><?php echo $secretaria["contactosecretaria"] ?></td>

                            <td><a href="eliminar_secretaria.php?id=<?php echo $secretaria["ID_secretaria"] ?>"><button> Eliminar </button></a></td>
                            <td><a href="modificar_secretaria.php?id=<?php echo $secretaria["ID_secretaria"] ?>"><button> Modificar </button></a></td>
                          

                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        
    </div>
</body>

</html>