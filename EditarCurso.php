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


            <main class="bgadmin">
                <section>
                    <form action="EditarCurso.php" method="POST">
                        <input type="text" name="buscar" value="" placeholder="Búsqueda por nombre..." required>
                        <input type="submit" name="enviar" value="Buscar"/>
                    </form>
                </section>
                <h1 style=text-align:center;>Gestió de Cursos</h1>
                <table class="tabla">
                    <tr>
                        <td>Codi</td>
                        <td>Nom</td>
                        <td>Descripcio</td>
                        <td>Hores</td>
                        <td>Inici</td>
                        <td>Fi</td>
                        <td>DNI Professor</td>
                        <td>Estat</td>
                        <td>Editar</td>
                    </tr>
                
                <?php
                    if ($_POST){
                        $name=$_POST['buscar'];
                        $q="SELECT * FROM cursos WHERE nom LIKE '%$name%'";
                        $consulta = mysqli_query($conection, $q);
                        $registros=mysqli_num_rows($consulta);
                        for ($i=0;$i<$registros;$i++){
                            $filas=$consulta->fetch_assoc();
                            echo "<tr>";
                            echo "<td>" .$filas['CODI']. "</td>";
                            echo "<td>" .$filas['NOM']. "</td>";
                            echo "<td>" .$filas['DESCRIPCIO']. "</td>";
                            echo "<td>" .$filas['HORES']. "</td>";
                            $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
                            echo "<td>" .$filas['INICI']. "</td>";

                            $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
                            echo "<td>" .$filas['FI']. "</td>";
                            echo "<td>" .$filas['DNIPROFESSOR']. "</td>";
                            estadoeditarcurso($filas);
                            ?>
                            <td><a href="EditarCurso2.php?id=<?php echo $filas['CODI'];?>"><img src="img/lapiz.png" style="height:20px;width:20px;"></a></td>

                            <?php
                        }
                        echo "</table>";
                    }
                    else{

                        mostrarCursos($conection);
                    }
                ?>
                </table>
            </main>

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