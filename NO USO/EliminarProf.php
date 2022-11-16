<?php
    session_start();
    include("Funciones.php");
    $conection = bbdd();
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


            <main  class="bgadmin">
                <section>
                    <form action="EliminarProf.php" method="POST">
                        <input type="text" name="buscar" value="" required>
                        <input type="submit" name="enviar" value="Buscar"/>
                    </form>
                </section>


                <table class="tabla">
                    <tr>
                        <td>DNI</td>
                        <td>Nom</td>
                        <td>Cognoms</td>
                        <td>Títol</td>
                        <td>Foto</td>
                        <td>Cursos</td>
                        <td>Estat</td>
                        <td>Eliminar</td>
                    </tr>
                
                <?php

                if ($_POST){
                    $name=$_POST['buscar'];
                    $q="SELECT * FROM professors WHERE nom LIKE '%$name%' && actiu=1";
                    $consulta = mysqli_query($conection, $q);
                    $registros=mysqli_num_rows($consulta);
                    for ($i=0;$i<$registros;$i++){
                        $filas=$consulta->fetch_assoc();
                        echo "<tr>";
                        echo "<td>" .$filas['DNI']. "</td>";
                        //echo "<td>" .$filas['CONTRASENYA']. "</td>";
                        echo "<td>" .$filas['NOM']. "</td>";
                        echo "<td>" .$filas['COGNOMS']. "</td>";
                        echo "<td>" .$filas['TITOL']. "</td>";
                        echo "<td> <img src=imagenesprofe/".$filas['FOTO']." height=50 width=50> </td>";
                        //Desencriptar codigo
                        $co=$filas['DNI'];
                        $codi=desencriptarcursos($co,$conection);
                        echo "<td>".$codi."</td>";
                        estado($filas);

                        ?>
                        <td><a href="EliminarProfe2.php?id=<?php echo $filas['DNI'];?>"><img src="img/papelera.png" style="height:20px;width:20px;"></img></a></td>
                        <?php
                    }
                    echo "</table>";
                    }

                else{
                    //Conectar con la bbdd
                    $query= "SELECT * FROM professors WHERE actiu=1";

                    //Enviar query
                    $consult = mysqli_query($conection, $query);

                    //Numero de registros
                    $numeroregistros=mysqli_num_rows($consult);

                    //Importante hacer un bule con el numero de registros
                    for ($i=0;$i<$numeroregistros;$i++){

                        //CREAR UN ARRAY ASOCIATIVO DE LA SIGUIENTE FORMA
                        $filas=$consult->fetch_assoc();
                        
                    
                        //IMPRIMIR
                        echo "<tr>";
                        echo "<td>" .$filas['DNI']. "</td>";
                        //echo "<td>" .$filas['CONTRASENYA']. "</td>";
                        echo "<td>" .$filas['NOM']. "</td>";
                        echo "<td>" .$filas['COGNOMS']. "</td>";
                        echo "<td>" .$filas['TITOL']. "</td>";
                        echo "<td> <img src=imagenesprofe/".$filas['FOTO']." height=50 width=50> </td>";

                        //Desencriptar codigo
                        $co=$filas['DNI'];
                        $codi=desencriptarcursos($co,$conection);
                        echo "<td>".$codi."</td>";
                        estado($filas);
                        ?>
                        <td><a href="EliminarProfe2.php?id=<?php echo $filas['DNI'];?>"><img src="img/papelera.png" style="height:20px;width:20px;"></img></a></td>
                        <?php
            
                        
                        echo "</tr>";
                    }
                }//end of else
                ?>
                </table>
            </main>
        <?php

        ?>
            <footer>
                <p>infoBDN® 2022</p>
            </footer>

            
            
        <?php 
        } //importante cerrar el } del if
        else{
            ?>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
            <?php
        }
    
    ?>
</body>
</html>