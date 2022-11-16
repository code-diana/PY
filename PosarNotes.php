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
                <a href="MenuProfe.php">Tornar al menú</a>
            </nav>

            <main class="bgprof">
                <section>
                    <form action="PosarNotes.php" method="POST">
                        <input type="text" name="buscar" value="" placeholder="Búsqueda por nombre..." required>
                        <input type="submit" name="enviar" value="Buscar"/>
                    </form>
                </section>
                <h1 style="text-align:center;">Cursos ja finalitzats</h1>

                <?php
                $fechaActual = date('Y-m-d');
                

                //TITULO CURSOS
                if ($_POST){
                    $name=$_POST['buscar'];
                    echo "<h3 style=text-align:center;>".$_SESSION['nomcurs']."</h3>";
                    $query="SELECT * FROM cursos WHERE nom='".$_SESSION['nomcurs']."' AND dniprofessor='".$_SESSION['profe']."' AND fi<='$fechaActual'";
                    $consulta = mysqli_query($conexion, $query);
                    $registros=mysqli_num_rows($consulta);
                    for ($i=0;$i<$registros;$i++){
                        $filas=$consulta->fetch_assoc();
                        ?> <table class="tabla"> <?php
                        echo "<tr>";
                        echo "<td> DNI </td>";
                        echo "<td> Nom </td>";
                        echo "<td> Cognoms </td>";
                        echo "<td> Foto </td>";
                        echo "<td> Nota </td>";
                        echo "<td> Cambiar Nota </td>";
                        echo "</tr>";

                        //CONSEGUIR CODIGO
                        $query2="SELECT * FROM matricula WHERE codi='".$filas['CODI']."'";
                        $consulta2 = mysqli_query($conexion, $query2);
                        $registros2=mysqli_num_rows($consulta2);
                        for ($j=0;$j<$registros2;$j++){
                            $filas2=$consulta2->fetch_assoc();

                            //DATOS ALUMNOS
                            $query3="SELECT * FROM alumnes WHERE dni='".$filas2['DNI_ALUMNE']."' AND nom LIKE '%$name%'";
                            $consulta3 = mysqli_query($conexion, $query3);
                            $registros3=mysqli_num_rows($consulta3);

                            for ($h=0;$h<$registros3;$h++){
                                $filas3=$consulta3->fetch_assoc();
                                echo "<tr>";
                                echo "<td>".$filas3['DNI']."</td>";
                                echo "<td>".$filas3['NOM']."</td>";
                                echo "<td>".$filas3['COGNOMS']."</td>";
                                echo "<td><img src=imagenesalumno/".$filas3['FOTO']." height=50 width=50></td>";
                                echo "<td>".$filas2['NOTA']."</td>";
                                
                                $_SESSION['codi']=$filas['CODI'];

                                ?> <td><a href="ActualizarNotas.php?id=<?php echo $filas3['DNI'];?>"><img src="img/lapiz.png" style="height:20px;width:20px;"></img></a></td> <?php
                                
                                echo "</tr>";
                                

                            }
                        }
                        echo "</table>";
                    }
                    
                
                }
                else{
                    $nomcurs=$_GET['id'];
                    $_SESSION['nomcurs']=$nomcurs;
                    echo "<h3 style=text-align:center;>".$nomcurs."</h3>";
                    $query="SELECT * FROM cursos WHERE nom='$nomcurs' AND dniprofessor='".$_SESSION['profe']."' AND fi<='$fechaActual'";
                    $consulta = mysqli_query($conexion, $query);
                    $registros=mysqli_num_rows($consulta);
                    if($registros==0){
                        echo "<p style=text-align:center;> El curs encara no ha finalitzat </p>";
                    }
                    else{
                        for ($i=0;$i<$registros;$i++){
                            $filas=$consulta->fetch_assoc();
                            ?> <table class="tabla"> <?php
                            echo "<tr>";
                            echo "<td> DNI </td>";
                            echo "<td> Nom </td>";
                            echo "<td> Cognoms </td>";
                            echo "<td> Foto </td>";
                            echo "<td> Nota </td>";
                            echo "<td> Cambiar Nota </td>";
                            echo "</tr>";
    
                            //CONSEGUIR CODIGO
                            $query2="SELECT * FROM matricula WHERE codi='".$filas['CODI']."'";
                            $consulta2 = mysqli_query($conexion, $query2);
                            $registros2=mysqli_num_rows($consulta2);
                            for ($j=0;$j<$registros2;$j++){
                                $filas2=$consulta2->fetch_assoc();
    
                                //DATOS ALUMNOS
                                $query3="SELECT * FROM alumnes WHERE dni='".$filas2['DNI_ALUMNE']."'";
                                $consulta3 = mysqli_query($conexion, $query3);
                                $registros3=mysqli_num_rows($consulta3);
    
                                for ($h=0;$h<$registros3;$h++){
                                    $filas3=$consulta3->fetch_assoc();
                                    echo "<tr>";
                                    echo "<td>".$filas3['DNI']."</td>";
                                    echo "<td>".$filas3['NOM']."</td>";
                                    echo "<td>".$filas3['COGNOMS']."</td>";
                                    echo "<td><img src=imagenesalumno/".$filas3['FOTO']." height=50 width=50></td>";
                                    echo "<td>".$filas2['NOTA']."</td>";
    
                                    $_SESSION['codi']=$filas['CODI'];
                                    ?> <td><a href="ActualizarNotas.php?id=<?php echo $filas3['DNI'];?>"><img src="img/lapiz.png" style="height:20px;width:20px;"></img></a></td> <?php
                                    
                                    echo "</tr>";
                                    
    
                                }
                            }
                            echo "</table>";
                        }
                    }

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