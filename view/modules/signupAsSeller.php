<?php
    session_start();
    require_once "../../model/connection.php";
    require_once "../../model/signupAsSeller.model.php";
    require_once "../../controller/signupAsSeller.controller.php";
    
    if(isset($_SESSION["user_email"])) {
        header("Location: /caribbean/view/modules/welcome.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Regístrate</title>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <?php
        if(!empty($message)):
    ?>
    <p><?= $message  #Interpretamos la variable. ?></p>
    <?php
        endif;
    ?>
    <h2>Regístrate</h2>
    <span>
        Or <a href="login.php">Inicia sesión</a>
    </span>
    <form action="signupAsSeller.php" method="POST">
        <input type="text" name="name" placeholder="Ingresa tu(s) nombre(s)">
        <input type="text" name="last_name" placeholder="Ingresa tu(s) apellido(s)">
        <input type="number" name="identity" placeholder="Ingresa tu cédula" min="1">
        <label for="city">Elija la ciudad en la que labora</label>
        <select name="city" id="city">
            <option value="Santa Marta">Santa Marta</option><
            <option value="Cartagena">Cartagena</option>
        </select>
        <input type="email" name="email" placeholder="Ingresa tu correo">
        <input type="password" name="password" placeholder="Ingresa tu contraseña">

        <input type="submit" value="Regístrarme">
    </form>
</body>
</html>