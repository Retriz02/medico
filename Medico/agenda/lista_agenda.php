<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/estilo_listas.css">
    <title>Tablas</title>
</head>

<body>
    <?php
        session_start();
        $datoUsuario = $_SESSION["ID_usuario"];

        $varsesion = $_SESSION['usuario'];
        if ($varsesion == null || $varsesion = '') {
            header("location:../index.php");
        }else{
          //si la sesion es diferente al area con ID_area 2, lo manda a la pantalla principal (2 = Auditoria Medica)
          if($_SESSION['ID_area'] !=2){
              header('location: ../frames/frame_paginaPrincipal.php');
          }
        }

        //Llamamos a las conexiones de nuestras base de dato
        require("../database/db_medico.php");

        $sq1 = "SELECT agenda.*, usuarios.*, medico.*,estado.* 
        FROM agenda
        LEFT JOIN db_general.estado on agenda.ID_estado_agenda = estado.ID_estado 
        LEFT JOIN db_general.usuarios on agenda.ID_usuario_agenda = usuarios.ID_usuario
        LEFT JOIN db_medico.medico on agenda.ID_medico_agenda = medico.ID_medico 
        WHERE ID_usuario_agenda = $datoUsuario"; //donde el id del usuario sea igual al del usuario que inicio sesion
        $resultao1 = $conexion->query($sq1) or die ($conexion->error);
    ?>

    <div class="container">
        
        <div class="title">
            <p><b>Lista de la Agenda</b></p>
            <a href="agregar_agenda.php" target="paginaPrincipal">
                <input type="button" value="Agregar agenda" class="blue">
            </a>

        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="stiky">Medico</th>
                        <th class="stiky">Fecha</th>
                        <th class="stiky">Horario</th>
                        <th class="stiky">Observación</th>
                        <th class="stiky">Opciones</th>
                        <th class="stiky">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($agenda = mysqli_fetch_assoc($resultao1)) {

                        require("../database/db_general.php");

                        $sql1= "SELECT * FROM persona where ID_persona =".$agenda['ID_persona_medico'];
                        $result= $conexionGeneral->query($sql1);
                        $medico = mysqli_fetch_assoc($result);

                    ?>
                    <tr>

                        <td><?php echo $medico["Apellido_persona"], " ", $medico["Nombre_persona"] ?></td>

                        <td><?php echo $agenda["Fecha_agenda"] ?></td>

                        <td><?php echo $agenda["Hora_agenda"] ?></td>

                        <td class="observacion" align="left"><?php echo $agenda["Descripcion_agenda"] ?></td>
                        <td>
                            <a href="eliminar_agenda.php?id=<?php echo $agenda["ID_agenda"] ?>" class="botones">Eliminar</a>
                            <a href="modificar_agenda.php?id=<?php echo $agenda["ID_agenda"] ?>" class="botones">Modificar</a>
                        </td>
                        <?php 
                            if($agenda['Descripcion_estado'] == "Abierto"){
                                echo "<td class='yellow'>".$agenda["Descripcion_estado"]. "</td>";
                            }
                            if($agenda['Descripcion_estado'] == "Cerrado"){
                                echo "<td class='green'>". $agenda["Descripcion_estado"]. "</td>" ;
                            }
                            if($agenda['Descripcion_estado'] == "Cancelado"){
                                echo "<td class='red'>".$agenda["Descripcion_estado"]. "</td>" ;
                            }
                            if($agenda['Descripcion_estado'] == "Postergado"){
                                echo "<td class='orange'>". $agenda["Descripcion_estado"]."</td>" ;
                            }
                        ?>

                        
                    </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>