<?php
    session_start();
    
    if(!isset($_SESSION["user_email"])) {
        header("Location: /caribbean");
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h3>Hola <?= $_SESSION["user_email"]; ?></h3>
    <br/>
    <a href="../../controller/logout.controller.php">Cerrar sesión</a>
</body>
</html>