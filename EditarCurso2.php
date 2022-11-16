<?php
    session_start();
    include("Funciones.php");
    //conexion
    $conection=bbdd();
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

            <main class="bgEdit">
                <?php
                    $conection = bbdd();
                    $id=$_GET['id'];
                    $query= "SELECT * FROM cursos WHERE codi='$id'";
                    $consult = mysqli_query($conection, $query);

                    $resultados=$consult->fetch_array(MYSQLI_ASSOC);

                    //GUARDAR EN VARIABLE DE SESION EL DNI PARA LUEGO
                    $_SESSION['CODI']=$resultados['CODI'];
                    ?>

                    <form class="editCurso" action="EditarCurso3.php" method="POST" enctype="multipart/form-data"><!--form-data ¬¬-->
                    <div>
                        <p>Codi:</p>
                        <input type="number" name="CODI" value="<?php echo $resultados['CODI']?>" readonly="readonly" required>

                        <p>Nom:</p>
                        <input type="text" name="NOM" value="<?php echo $resultados['NOM']?>" required><br>

                        <p>Descripcio:</p>
                        <input type="text" name="DESCRIPCIO" value="<?php echo $resultados['DESCRIPCIO']?>" ><br>

                        <p>Hores:</p>
                        <input type="number" name="HORES" value="<?php echo $resultados['HORES']?>" required><br>
                    </div>
                    <div>
                        <p>Inci:</p>
                        <input type="date" name="INICI" value="<?php echo $resultados['INICI']?>" required><br>

                        <p>Fi:</p>
                        <input type="date" name="FI" value="<?php echo $resultados['FI']?>" required><br>

                        <p>DNI Professor:</p>
                        <select name="DNI">
                            <option value=<?php echo $resultados['DNIPROFESSOR'] ?>><?php echo $resultados['DNIPROFESSOR']?></option>
                                <?php  
                                    DNIProfe($conection);
                                ?>
                        </select>
                        <input class="editcurs" href="EditarCurso3.php" type="submit" name="enviar" value="Editar"/>
                        
                    </div>
                </form>
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