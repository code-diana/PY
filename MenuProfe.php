<?php
    include("Funciones.php");
    $conexion=bbdd();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - Professor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <?php
        if(isset($_SESSION['profe'])){?>
            <header>
                <h1 class="logo">infoBDN</h1>
                <h6 class="slogan">cursos d'informàtica online</h6>
            </header>

            <nav>
                <a href="LogOut.php">Sortir de la sessió</a>
            </nav>

            <main class="superprof">
                <h1>Benvolgut/da <?php echo nombreprofe($_SESSION['profe'],$conexion)?></h1>
                <h2 style=text-align:center;>Els meus cursos</h2>
                <div class="sp">
                <?php 
                    $query="SELECT * FROM cursos WHERE dniprofessor='".$_SESSION['profe']."'";
                    $consulta = mysqli_query($conexion, $query);
                    $registros=mysqli_num_rows($consulta);
                    for ($i=0;$i<$registros;$i++){
                        $filas=$consulta->fetch_assoc();
                        ?> <div class="prof"> <?php
                        echo "<h3>".$filas['NOM']."</h3>";

                        ?> 
                        <div>
                            <?php 
                                echo "<p> Codi: </p>";
                                echo "<p>".$filas['CODI']."</p>";
                                echo "<p> Descripció: </p>";
                                echo "<p>".$filas['DESCRIPCIO']."</p>";
                            ?>
                            
                        </div>

                        <div>
                            <?php 
                                echo "<p> Hores: </p>";
                                echo "<p>".$filas['HORES']."</p>";
                                echo "<p> Data d'inici: </p>";
                                $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
                                echo "<p>" .$filas['INICI']. "</p>";
                                echo "<p> Data de fi: </p>";
                                $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
                                echo "<p>" .$filas['FI']. "</p>";
                            ?> 
                            <a href="LlistarAlumnes.php?id=<?php echo $filas['NOM'];?>">Pasar Llista</a>
                            <a href="PosarNotes.php?id=<?php echo $filas['NOM'];?>">Posar Notes</a> 
                            <p> </p>
                        </div>
                        <?php
                        echo "</div>";
                                
                    }
                
                ?>
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