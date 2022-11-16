<?php
    session_start();
    include("Funciones.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Infobdn - LogOut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <?php
        if (isset($_SESSION)){
            //si hay una sesion iniciada destruirla
            session_destroy();
            //redirigir
            header('Location: LogIn.php');
          
          }
          //en caso de que no exista esa sesion mostrar mensaje y ir al validador
          if (empty($_SESSION)){
              ?>
              <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=LogIn.php">
              <?php
          }
    ?>
</body>
</html>