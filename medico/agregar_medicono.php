<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medico</title>
    <link rel="stylesheet" href="./styles/agregarMedicos.css">
</head>

<body>
    <div class="global">
        <div class="contenedor">
            <h1 class="title-medico">Añadir Medico</h1>

            <?php
                require("general.php");
                require("medicos.php");

                $sql = "SELECT * FROM profesion";
                $result = $conexion->query($sql);
                
                $sql1 = "SELECT * FROM especialidades";
                $result1 = $conexion->query($sql1);

                $sql2= "SELECT * FROM persona";
                $result2 = $conexionGeneral->query($sql2);

            ?>
            <form action="" method="post">
                <fieldset>
                    <legend>Datos profesionales</legend>
                    <div class="contenedorMedico">
                        <div class=cont-persona>
                            <div class="cont-dato-persona">

                                <select value="" class="selectPersona" name="persona">
                                    <option value="0">Persona</option>
                                    <?php while($persona = mysqli_fetch_assoc($result2)){?>
                                    <option value="<?php echo $persona['ID_persona'];?>"><?php echo $persona['DNI']." - ".$persona['NombreP']." ".$persona['ApellidoP'];?></option>
                                    <?php } ?>
                                </select>

                                <button class="btn-agregar">+</button>

                                <div class="selectProfesional">
                                    <select value="" class="selectT" name="profesion">
                                        <option value="0">Profesion</option>
                                        <?php while($datMedico = mysqli_fetch_assoc($result)){?> 
                                        <option value="<?php echo $datMedico['ID_Profesion'];?>"><?php echo $datMedico['Profesion_Descripcion'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="profesional">

                            <div class="selectProfesional">
                                <select value="" class="selectTP" name="especialidad">
                                    <option value="0">Especialidad</option>
                                    <?php while($datMedico2 = mysqli_fetch_assoc($result1)){?> 
                                    <option value="<?php echo $datMedico2['ID_especialidad'];?>"><?php echo $datMedico2['Especialidad_Descripcion'];?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="selectProfesional">
                                <select value="" class="selectTPM" name="tipo">
                                    <option value="SinValor">Tipo Matricula</option>
                                    <option value="N">N - Nacional</option>
                                    <option value="P">P - Provincial</option>
                                </select>
                            </div>
                        </div>


                        <div class="cont-matricula">
                            <p>
                                <input type="text" class="input-nroMatricula" placeholder="Nro. Matricula" name="matricula" maxlenght=10>
                                <input type="text" class="input-nroPrestador" placeholder="Nro. Prestador" name="prestador" maxlenght=10>
                            </p>
                        </div>
                    </div>
                </fieldset>
                <div class="botones">
                    <input type="submit" class="btn-cancelar" name="cancelar" value="Cancelar">
                    <input type="submit" class="btn-aceptar" name="aceptar-agregar" value="Aceptar">
                </div>

                <div class="botones2">
                    <input type="submit" class="btn-sanatorio" name="cancelar" value="Sanatorio">
                    <input type="submit" class="btn-consultorio" name="aceptar" value="Colsultorio">
                    <input type="submit" class="btn-secretaria" name="aceptar" value="Secretaria">
                </div>
            </form>
        </div>
    </div>


    <?php
    if (isset($_POST["aceptar"])) {
        require("medicos.php");

        $persona = $_POST["persona"];
        $profesion = $_POST["profesion"];
        $especialidad = $_POST["especialidad"];
        $matricula = $_POST["matricula"];
        $tipo = $_POST["tipo"];
        $prestador = $_POST["prestador"];



        $medico = "INSERT INTO medico ( ID_persona_medico, ID_profesion_medico, ID_especialidad_medico, Nro_Matricula, Tipo_Matricula, Nro_Prestador) VALUES 
        ('$persona','$profesion','$especialidad','$matricula','$tipo','$prestador')";
        $resultado1 = $conexion->query($medico);

        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    }
    if (isset($_POST["cancelar"])) {

        echo "<script type=\"text/javascript\"> window.location='medico1.php';</script>";
    } ?>


</body>

</html>