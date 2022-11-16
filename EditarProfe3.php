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
                    
                    $code=$_POST['dni'];
                    
                    if($_SESSION['DNI']!=$code){
                    //CONTROL CLAVES PRIMARIAS
                    $q="SELECT dni FROM professors WHERE dni ='$code'";
                    $consult = mysqli_query($conection, $q);
                    $registros=mysqli_num_rows($consult);
                    if($registros>0){
                        ?><script>alert("Este DNI ya consta en la base de datos \nEdición sin éxito")</script>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
                        <?php
                    }
                }
                    
                else{
                        if($_SESSION['DNI']==$_POST['dni']) $sesion=false;
                        else $sesion=true;

                        //HE MOSTRADO LA CTR VACÍA POR SEGURIDAD, SI NO SE MODIFICA QUEDARÁ IGUAL
                        if ($_POST['passwd']=="") $cambiar=false;
                        else $cambiar=true;
                        editarProfe($conection,$sesion,$cambiar);
                        ?>
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
                        <?php
                    }
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