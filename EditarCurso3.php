<?php
    session_start();
    include("Funciones.php");
    $conection=bbdd();
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
                        $inici=$_POST['INICI'];
                        $fi=$_POST['FI'];

                        $inicidate=new DateTime($inici);
                        $fidate=new DateTime($fi);

                        
                        if($inicidate<$fidate){
                            if($_SESSION['CODI']==$_POST['CODI']) $sesion=false;
                            else $sesion=true;
                            editarCurso($conection,$sesion);
                            ?>
                            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarCurso.php">
                            <?php
                        }
                        else if($inicidate>$fidate) { ?>
                        <script>alert('La fecha de fin no puede ser más antigua \nIntroduzca de nuevo los datos');</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarCurso.php">
                        <?php 
                        }

                    

                }
                ?>
            </main>
            
        <?php }//importante cerrar el } del if
        else{
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
            <?php
        }
    
    ?>
</body>
</html>