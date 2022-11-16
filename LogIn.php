<?php
include('Funciones.php');
$conexion=bbdd();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Inicia la sessió</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <header>
        <h1 class="logo">infoBDN</h1>
        <h6 class="slogan">cursos d'informàtica online</h6>
    </header>

    <nav>
        <a href="Admin.php">Zona admin</a>
    </nav>

    <div class="validacion">
        <h1>Benvingut/da</h1>
        <form class="formlogin" action="LogIn.php" method="POST">
            <p>Usuari:</p>
            <input class="inpt" type="text" name="email" value="" required>
            <p>Contrasenya:</p>
            <input class="inpt" type="password" name="passwd" value="" required><br>
            <p class="tipo" id="al">Alumne:</p>
            <input class="tipo" type="radio" name="tipo" value="Alumne" checked>
            <p class="tipo" id="profe">Professor:</p>
            <input class="tipo" type="radio" name="tipo" value="Professor">
            <input class="smit" type="submit" name="aceptar" value="Iniciar sessió"/>
            <a href="AltaAlum.php" class="alta">Vull donar-me d'alta</a>
        </form>
    </div>

    <footer>
        <p>infoBDN® 2022</p>
    </footer>

    <?php
        if(isset($_POST['aceptar'])){
            if(($_POST['tipo'])=="Alumne"){
                $query="SELECT * FROM alumnes WHERE email='".$_POST['email']."' AND password=md5('".$_POST['passwd']."')";
                $consult=mysqli_query($conexion, $query);
                $registros=mysqli_num_rows($consult);
                if ($registros==1){
                    $_SESSION['alumne']=$_POST['email'];
                   ?> <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=InteriorAlumne.php"> <?php
                }
                else{
                    ?> <script>alert('Corrreu o contrasenya incorrectes');</script> <?php
                }
                
            }
            else if(($_POST['tipo'])=="Professor"){
                $query="SELECT * FROM professors WHERE dni='".$_POST['email']."' AND contrasenya=md5('".$_POST['passwd']."') AND actiu=1";
                $consult=mysqli_query($conexion, $query);
                $registros=mysqli_num_rows($consult);
                if ($registros==1){
                    $_SESSION['profe']=$_POST['email'];
                    ?><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=MenuProfe.php"> <?php
                }
                else{
                    ?> <script>alert('DNI o contrasenya incorrectes');</script> <?php
                }
            }
        }
    ?>
</body>
</html>