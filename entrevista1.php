<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloTablas.css">
    
    <title>Entrevista</title>
</head>
<script src="confirmacion.js"></script>

<body>
    <p>Lista de las Entrevistas
        <a href="crearEntrevista.php" target="paginaPrincipal">
            <input type="button" value="Agregar una Nueva Entrevista">
        </a>
    </p>
    
    <?php

    require("medicos.php");
    require("general.php");
 

    $sql = "SELECT entrevista_medicos.*, domicilio.*, usuarios.*, medico.*
    FROM entrevista_medicos
    LEFT JOIN general.domicilio on entrevista_medicos.ID_domicilio_entrevistaMedico = domicilio.ID_domicilio
    LEFT JOIN general.usuarios on entrevista_medicos.ID_usuario_entrevistaMedico = usuarios.ID_usuario
    LEFT JOIN db_medico.medico on entrevista_medicos.ID_medico_entrevistaMedico = medico.ID_medico";

    $resultado = $conexion->query($sql) or die ($conexion->error);






    ?>

    <div class="page-container">
        <div class="table-container">
            <table id="main-container" class="table-cebra">
                <thead>
                    <tr>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Usuario</th>
                        <th class="stiky">Domicilio</th>
                        <th class="stiky">Fecha</th>
                        <th class="stiky">Hora</th>
                        <th class="stiky">Observación</th>
                        <th class="stiky">Eliminar</th>
                        <th class="stiky">Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($Entrevista = mysqli_fetch_assoc($resultado)) {

                        
                        $sql1= "SELECT * FROM persona where ID_persona =".$Entrevista['ID_medico_entrevistaMedico'];
                        $result= $conexionGeneral->query($sql1);
                        $medico = mysqli_fetch_assoc($result);

                        $sql2= "SELECT * FROM persona where ID_persona = ".$Entrevista['ID_usuario_entrevistaMedico'];
                        $result1= $conexionGeneral->query($sql2);
                        $usuario = mysqli_fetch_assoc($result1);

                    ?>
                        <tr>

                            <?php $Entrevista["ID_entrevistaMedico"] ?>

                            <td><?php echo $medico["Nombre_persona"], " ", $medico["Apellido_persona"] ?></td>
                            
                            <td><?php echo $usuario["Nombre_persona"], " ", $usuario["Apellido_persona"] ?></td>
                            
                            <td><?php echo $Entrevista["Calle"], " ", $Entrevista["Numero"] ?></td>

                            <td><?php echo $Entrevista["Fecha"] ?></td>

                            <td><?php echo $Entrevista["Horario"] ?></td>

                            <td><?php echo $Entrevista["Observacion"] ?></td>

                            <td><a href="eliminar_entrevista.php?id= <?php echo $Entrevista["ID_entrevistaMedico"] ?>"><button> Eliminar </button></a></td>
                            <td><a href="modificar_entrevista.php?id= <?php echo $Entrevista["ID_entrevistaMedico"] ?>"><button> Modificar </button></a></td>
                          

                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
          
    </div>
</body>

</html> 