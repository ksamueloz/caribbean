<?php
    session_start();
    require_once "../../model/connection.php";
    require_once "../../model/login.model.php";
    require_once "../../controller/login.controller.php";

    
    if(!isset($_SESSION["session"])){
        header("Location: /caribbean");
    } 
    else if(isset($_SESSION["session"]) && $_SESSION["role"] == "Vendedor") {

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Vendedor</title>
</head>
<body>
    <h3>Hola <?= $_SESSION["name"]; ?></h3>
    
    <br/>
    <a href="../../controller/logout.controller.php">Cerrar sesión</a>
</body>
</html>
<?php } else { header("Location: /caribbean"); } ?>