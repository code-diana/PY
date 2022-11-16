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

            <main>
                <?php
                if(isset($_POST['enviar'])){
                    if($_POST['nota']>=0 && $_POST['nota']<=10){
                        $dni=$_SESSION['dni'];
                        $query="UPDATE matricula SET NOTA='".$_POST['nota']."' WHERE dni_alumne='$dni' AND  codi='".$_SESSION['codi']."'";
                        $consult = mysqli_query($conexion, $query);
                        header("location:PosarNotes.php?id=".$_SESSION["nomcurs"]."");
                        ?>
                        <!--<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=MenuProfe.php">!-->
                        <?php
                    }
                    else{
                        ?>
                        <script>alert("Introdueix una nota valida")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=MenuProfe.php">
                        <?php
                    }
                }
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