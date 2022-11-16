<?php
    session_start();
    include("Funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){?>
            <header>
                <h1 class="logo">infoBDN</h1>
                <h6 class="slogan">cursos d'informàtica online</h6>
            </header>

            <nav>
                <a href="IndexAdmin.php">Tornar al menú</a>
            </nav>

            <main>
                <?php
                    $conection = bbdd();
                    $id=$_GET['id'];
                    $query="SELECT * FROM cursos WHERE CODI ='$id'";
                    $consulta = mysqli_query($conection, $query);

                    $valores=mysqli_fetch_assoc($consulta);

                    $dniprofe=$valores['DNIPROFESSOR'];
                    $queryfiltro="SELECT ACTIU from professors WHERE dni='$dniprofe'";
                    $consulta = mysqli_query($conection, $queryfiltro);
                    $values=mysqli_fetch_assoc($consulta);


                        if($valores['ACTIU']==0 && $values['ACTIU']==1){
                            $query= "UPDATE cursos SET ACTIU=1 WHERE CODI ='$id'";
                            $consulta = mysqli_query($conection, $query);
                        }
                        
                        else if($valores['ACTIU']==1 && $values['ACTIU']==1){
                            $query= "UPDATE cursos SET ACTIU=0 WHERE CODI ='$id'";
                            $consulta = mysqli_query($conection, $query);
                        }
                        else{
                            ?>
                            <script>alert("Asigna un professor vàlid")</script>
                            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarCurso.php">
                            <?php
                        }
                        ?>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarCurso.php">
                        <?php

                ?>

            </main>

            <footer>
                <p>infoBDN® 2022</p>
            </footer>
            
        <?php } //importante cerrar el } del if
        else{
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
            <?php
        }
    
    ?>
</body>
</html>