<?php
    include("Funciones.php");
    session_start();
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
    <header>
        <h1 class="logo">infoBDN</h1>
        <h6 class="slogan">cursos d'informàtica online</h6>
    </header>

    <nav>
        <a href="LogIn.php">Tornar a l'inici</a>
    </nav>

    <div class="validacion">
        <h1>Administrador</h1>
        <form class="formlogin" action="Admin.php" method="POST">
            <p>Usuari:</p>
            <input class="inpt" type="text" name="usuario" value="" required>
            <p>Contrasenya:</p>
            <input class="inpt" type="password" name="cts" value="" required><br>
            <input class="smitad" type="submit" name="enviar" value="Iniciar sessió"/>
        </form>
    </div>

    <footer>
        <p>infoBDN® 2022</p>
    </footer>

    <?php
        if (isset($_POST['enviar'])){

            //Conectar con la bbdd
            $conexion=bbdd();
            

            //Coger usuario y contraseña
            $usuario=$_POST['usuario'];
            $contrasenya=$_POST['cts'];
            

            //query a enviar
            $query= "SELECT * FROM administrador WHERE USUARI='$usuario' and PASSWD=md5('$contrasenya')";

            //Enviar consulta
            $consulta = mysqli_query($conexion, $query);

            //Miramos si hay algun resultado en forma de numero
            $numero= mysqli_num_rows($consulta);

            //Encriptar contraseña para comparar en la bbdd
            if ($numero==1){
                
                //Iniciamos sesion
                $_SESSION['admin']=$usuario;
                ?>
                    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=IndexAdmin.php">
                <?php
            }

            else{
                ?>
                    <script>
                    window.alert("Usuari o contrasenya incorrectes");
                    </script>
                <?php
            }

        }
    ?>
</body>
</html>