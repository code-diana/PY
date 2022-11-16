<?php
    include("Funciones.php");
    $conexion=bbdd();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Alumne</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <?php
        if(isset($_SESSION['alumne'])){?>
            <header>
                <h1 class="logo">infoBDN</h1>
                <h6 class="slogan">cursos d'informàtica online</h6>
            </header>

            <nav>
                <a href="InteriorAlumne.php">Anar al menú</a>
            </nav>

            <main class="bgcursos">
                <section>
                    <form action="CursosDisponibles.php" method="POST">
                        <input type="text" name="buscar" value="" placeholder="Búsqueda por nombre..." required>
                        <input type="submit" name="enviar" value="Buscar"/>
                    </form>
                </section>
                
                <h1 style=text-align:center;>Cursos Disponibles</h1>

                <table class="tabla">
                    <tr>
                        <td>Codi</td>
                        <td>Nom</td>
                        <td>Descripcio</td>
                        <td>Professor</td>
                        <td>Hores</td>
                        <td>Inici</td>
                        <td>Fi</td>
                        <td>Inscripció</td>
                    </tr>
                    
                <?php
                    $fechaActual = date('Y-m-d');
                    //DNI ALUMNO
                    $qq="SELECT * FROM alumnes WHERE email='".$_SESSION['alumne']."'";
                    $consult=mysqli_query($conexion,$qq);
                    while($valores = mysqli_fetch_array($consult)){
                        $dni=$valores['DNI'];  
                    }

                    if ($_POST){
                        $name=$_POST['buscar'];
                        $q="SELECT * FROM cursos WHERE nom LIKE '%$name%' AND actiu=1 AND inici>'$fechaActual'";
                        cursosdisponibles($conexion,$q,$dni);
                    }
                    else{
                        $q="SELECT * FROM cursos WHERE actiu=1 AND inici>'$fechaActual'";
                        cursosdisponibles($conexion,$q,$dni);  
                    }
                    ?>
                </table>
                
                
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