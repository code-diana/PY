<?php
    session_start();
    include("Funciones.php");
    $conexion=bbdd();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Alumne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <?php
        if(isset($_SESSION['alumne'])){?>
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
                    $query="DELETE FROM matricula WHERE codi='$id'";
                    $consulta = mysqli_query($conexion, $query);
                    ?>
                    <script> alert("Baixa del curs amb éxit") </script>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=AlumnesBaixa.php">
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