<?php
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
    <?php
        if(isset($_SESSION['admin'])){?>
            <header>
                <h1 class="logo">infoBDN</h1>
                <h6 class="slogan">cursos d'informàtica online</h6>
            </header>

            <nav>
                <a href="LogOut.php">Sortir de la sessió</a>
            </nav>

            <main class="mainadmin">
                <div class="content">
                    <div class="izq">
                        <h1>CURSOS</h1>
                        <a href="CrearCurso.php"> Crear </a>
                        <a href="EditarCurso.php"> Gestionar </a>
                        
                    </div>

                    <div class="der">
                        <h1>PROFESSORS</h1>
                        <a href="CrearProfesor.php"> Crear </a>
                        <a href="EditarProfe.php"> Gestionar </a>
                        
                    </div>

                </div>   
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