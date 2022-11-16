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

            <main class="bgEdit">
                <?php
                    $conection = bbdd();
                    $id=$_GET['id'];
                    $query= "SELECT * FROM professors WHERE dni='$id'";
                    $consult = mysqli_query($conection, $query);

                    $resultados=$consult->fetch_array(MYSQLI_ASSOC);

                    //GUARDAR EN VARIABLE DE SESION EL DNI PARA LUEGO
                    $_SESSION['DNI']=$resultados['DNI'];
                    ?>

                    <form class="formfoto" action="ModFoto2.php" method="POST" enctype="multipart/form-data"><!--form-data ¬¬-->
                    <h3>Editar Foto:</h3>
                    <input type="file" name="imagen" value="" accept=".jpg" required><br>
                    <input href="ModFoto2.php" class="editcurs" type="submit" name="edit" value="Editar"/>
                    </form>

            </main>

            <footer>
                <p>infoBDN® 2022</p>
            </footer>
            
        <?php
        
    } //importante cerrar el } del if
        else{
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
            <?php
        }
    
    ?>
</body>
</html>