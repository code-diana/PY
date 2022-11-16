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

            <main>
                <?php
                $id=$_GET['id'];
                $query="SELECT dni FROM alumnes WHERE email='".$_SESSION['alumne']."'";
                $registros=mysqli_query($conexion,$query);
                while($valores = mysqli_fetch_assoc($registros)){
                    $code=$valores['dni'];  //en minusculas si no peta :( 

                    $comprobacion="SELECT codi FROM matricula WHERE dni_alumne='$code' AND codi='$id'";
                    $envio=mysqli_query($conexion,$comprobacion);
                    $coincidencias=mysqli_num_rows($envio);

                    if($coincidencias==0){
                        $q="INSERT INTO matricula (codi,dni_alumne,nota) VALUES ('$id','$code',NULL)"; 
                        $envio=mysqli_query($conexion,$q);
                        ?> 
                        <script> alert("Inscripció satisfractoria")</script> 
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CursosDisponibles.php">
                        <?php
                    }
                    else if($coincidencias==1){
                        ?> 
                        <script> alert("Ja estàs registrat en aquest curs")</script> 
                        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CursosDisponibles.php">
                        <?php
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