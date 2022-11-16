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

            <main>
                <?php
                    $conection = bbdd();
                    $id=$_GET['id'];
                    $query="SELECT ACTIU FROM professors WHERE DNI ='$id'";
                    $consulta = mysqli_query($conection, $query);

                    $valores=mysqli_fetch_assoc($consulta);


                        if($valores['ACTIU']==0){
                            $query= "UPDATE professors SET ACTIU=1 WHERE DNI ='$id'";
                            $consulta = mysqli_query($conection, $query);

                            estadoactivar($conection,$id);
                        }
                        else{
                            $query= "UPDATE professors SET ACTIU=0 WHERE DNI ='$id'";
                            $consulta = mysqli_query($conection, $query);
                            
                            estadodesactivar($conection,$id);
                            

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