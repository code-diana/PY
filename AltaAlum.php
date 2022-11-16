<?php
include("Funciones.php");
$conexion=bbdd();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Registre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <header>
        <h1 class="logo">infoBDN</h1>
        <h6 class="slogan">cursos d'informàtica online</h6>
    </header>

    <nav>
        <a href="LogIn.php">Tornar al Login</a>
    </nav>


    <main class="bgAlta">
        <h1>Alta d'alumnes</h1>
        <form action="AltaAlum.php" class="crear" method="POST" enctype="multipart/form-data">
            <div> 
                <p>E-mail:</p>
                <input type="email" name="email" value="" required><br>

                <p>DNI:</p>
                <input type="text" name="dni" value="" required><br>

                <p>Contrasenya:</p>
                <input type="password" name="passwd" value="" required><br>
            </div>
            <div>
                <p>Nom:</p>
                <input type="text" name="nom" value="" required><br>

                <p>Cognoms:</p>
                <input type="text" name="cognoms" value="" required><br>

                <p>Edat:</p>
                <input type="number" name="edat" value="" required><br>

                <p>Foto:</p>
                <input type="file" name="imagen" accept=".jpg" style="color:transparent;" required><br>
            </div>

            <div class="crearsub"><input type="submit"  name="alta" value="Dona'm d'alta"/></div>
        </form>
                
    </main>

    <footer>
        <p>infoBDN® 2022</p>
    </footer>

    <?php
        if(isset($_POST['alta'])){
            $query="SELECT * FROM alumnes WHERE dni='".$_POST['dni']."' OR email='".$_POST['email']."'";
            $consult = mysqli_query($conexion, $query);
            $registros=mysqli_num_rows($consult);

            //Si hay más de un registro es que email o dni ya estan en la bbdd
            if($registros>0){
                ?>
                    <script>alert('Email o DNI ya registrados');</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AltaAlum.php">
                <?php
            }
            else{

                imagenalumno();

                subiralumno($conexion);
                ?>
                    <script>alert('Alumno dado de alta');</script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
                <?php
            }
        }
    ?>
</body>
</html>