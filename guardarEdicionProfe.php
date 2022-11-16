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
            <main>
                <?php
                if (isset($_POST['enviar'])){
                    $conection=bbdd();
                    if($_SESSION['DNI']==$_POST['dni']) $sesion=false;
                    else $sesion=true;
                    editarProfe($conection,$sesion);
                    ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
                    <?php
                }
                ?>
            </main>
            
        <?php } //importante cerrar el } del if
        else{
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
            <?php
        }
    
    ?>
</body>
</html>