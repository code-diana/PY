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

                    //GUARDAR LA CONTRASEÑA PARA LUEGO COMPROBARLA [NO SE USA]
                    //$_SESSION['ctr']=$resultados['CONTRASENYA'];
                    ?>

                    <form class="edit" action="EditarProfe3.php" method="POST" enctype="multipart/form-data"><!--form-data ¬¬-->
                    <p>DNI:</p>
                    <input type="text" name="dni" value="<?php echo $resultados['DNI']?>" readonly="readonly" required>

                    <p>Actualitzar contrasenya:</p>
                    <input type="text" name="passwd" value="<?php //echo $resultados['CONTRASENYA']?>">

                    <p>Nom:</p>
                    <input type="text" name="nom" value="<?php echo $resultados['NOM']?>" required><br>

                    <p>Cognoms:</p>
                    <input type="text" name="cognoms" value="<?php echo $resultados['COGNOMS']?>" required ><br>

                    <p>Títol:</p>
                    <input type="text" name="titol" value="<?php echo $resultados['TITOL']?>" required><br>

                    <input class="smitedit" href="EditarProfe3.php" type="submit" name="enviar" value="Editar"/>
                </form>

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