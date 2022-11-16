<?php
    session_start();
    include("Funciones.php");
    $conexion=bbdd();
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
                <a href="LogOut.php">Sortir de la sessió</a>
            </nav>

            <main class="interior">
                <div class="interioralumne">
                    <h1>Benvolgut/da <?php echo nombrealumn($_SESSION['alumne'],$conexion) ?></h1>
                    <p style=color:#000;>A InfoBDN t'oferim els millors cursos d'informàtica, amb més de 10 anys d'experiencia en el sector de l'aprenentatge online. Pots matricularte a qualsevol curs disponible, fer el seguiment de qualificacions i donarte de baixa dels teus cursos seguint els enllaços seguents:</p>
                    <a href="CursosDisponibles.php">Cursos disponibles</a>
                    <a href="NotesAlumne.php">Qualificacions</a>
                    <a href="AlumnesBaixa.php">Els meus cursos</a>
                </div>
                <div class="mapzone">
                    <h3>Contacta amb nosaltres</h3>
                    <img class="mensaje" src="img/email.png">
                    <a href="mailto:diana.martos@inslapineda.cat">infobdn@example.com</a> <br>
                    <img class="mensaje" src="img/llamada.png">
                    <a href="tel:+34111111111">+34 93 555 23 23</a> <br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.3908444624585!2d2.237347615427821!3d41.45243757925815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4bb7236bf4449%3A0xc6b13e5d825a85a7!2sInstitut%20La%20Pineda!5e0!3m2!1sca!2ses!4v1664984824854!5m2!1sca!2ses" class="map" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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