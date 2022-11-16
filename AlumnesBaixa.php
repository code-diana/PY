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
                    <form action="AlumnesBaixa.php" method="POST">
                        <input type="text" name="buscar" value="" placeholder="Búsqueda por nombre..." required>
                        <input type="submit" name="enviar" value="Buscar"/>
                    </form>
                </section>
                
                <h1 style=text-align:center;>Gestionar Cursos</h1>

                <table class="tabla">
                    <tr>
                        <td>Codi</td>
                        <td>Nom</td>
                        <td>Descripcio</td>
                        <td>Professor</td>
                        <td>Hores</td>
                        <td>Inici</td>
                        <td>Fi</td>
                        <td>Donar-se de baixa</td>
                    </tr>
                    
                <?php
                    $fechaActual = date('Y-m-d');
                    if ($_POST){
                        $name=$_POST['buscar'];
                        //FILTRO 1 INFO ALUMNO
                        $dni=filtro1($conexion);

                        //FILTRO 2 
                        $q2="SELECT * FROM matricula WHERE dni_alumne='$dni'";
                        $consulta = mysqli_query($conexion, $q2);

                        if(mysqli_num_rows($consulta)!=0){
                            while($valores = mysqli_fetch_array($consulta)){
                                $nota=$valores['NOTA']; 
                                $codi=$valores['CODI']; 

                                //FILTRO 3 INFO CURSOS
                                $q3="SELECT * FROM cursos WHERE codi='$codi' AND (codi IN (SELECT codi FROM cursos WHERE fi>'$fechaActual')) AND nom LIKE '%$name%'";
                                bajaalum($conexion,$q3);
                            }
                        }

                    }
                    else{
                        //3 Filtros

                        //FILTRO 1 INFO ALUMNO SACAR DNI ALUMNO
                        $dni=filtro1($conexion);

                        //FILTRO 2 INFO NOTA CON EL DNI
                        $fechaActual = date('Y-m-d');
                        //ATENCIÓN A LA SINTAXIS MUESTRA LOS CURSOS QUE AÚN NO HAN FINALIZADO
                        $q2="SELECT * FROM matricula WHERE dni_alumne='$dni' AND (codi IN (SELECT codi FROM cursos WHERE fi>'$fechaActual'))";
                        $consulta = mysqli_query($conexion, $q2);

                        if(mysqli_num_rows($consulta)!=0){
                            while($valores = mysqli_fetch_array($consulta)){
                                $nota=$valores['NOTA']; 
                                $codi=$valores['CODI']; 
                                //FILTRO 3 INFO CURSOS
                                $q3="SELECT * FROM cursos WHERE codi='$codi'";
                                bajaalum($conexion,$q3);
                            }
                        }
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