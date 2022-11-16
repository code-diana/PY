<?php
    include("Funciones.php");
    $conexion=bbdd();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Professor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <?php
        if(isset($_SESSION['profe'])){?>
            <header>
                <h1 class="logo">infoBDN</h1>
                <h6 class="slogan">cursos d'informàtica online</h6>
            </header>

            <nav>
                <a href="MenuProfe.php">Tornar</a>
            </nav>

            <main class="bgEdit">
                <?php
                $dni=$_GET['id'];
                $_SESSION['dni']=$dni;
                $query= "SELECT * FROM matricula WHERE dni_alumne='$dni'";
                $consult = mysqli_query($conexion, $query);

                $resultados=$consult->fetch_array(MYSQLI_ASSOC);
                ?>
                <h1 style="text-align:center;margin-bottom:-3%;margin-top:3%;">Actualitzar Nota</h1>
                <form class="formfoto" action="ActualizarNotas2.php" method="POST">
                    <p>Nota:</p>
                    <input type="number" name="nota" value="<?php echo $resultados['NOTA']?>" required> <br>
                    <input class="editcurs" type="submit" name="enviar" value="Actualitzar"/>
                </form>

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