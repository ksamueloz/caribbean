<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["email"]) || empty($_POST["password"])) {
            $message = "Campos vacíos";
        } else {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = new userLogin();
            if($user -> getUser($email, $password)) {
                session_start();
                $_SESSION["user_email"] = $email;
                header("Location: /caribbean/view/modules/welcome.php"); 
            } else {
                $message = "Algo malo salió";
            }
        }
    }