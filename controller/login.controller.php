<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["email"]) || empty($_POST["password"])) {
            // $message = "Campos vacíos";
            echo json_encode(array('status' => 0));
            exit();
        } else {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = new userLogin();
            if($user -> getUser($email, $password) == 0) { //El usuario está aprobado para iniciar sesión.

                // session_start();
                $_SESSION["user_email"] = $email;
                
                //header("refresh:1;http://localhost/caribbean/view/modules/welcome.php"); 
                
                echo json_encode(array('status' => 4));
                exit();
            } else if($user -> getUser($email, $password) == 1) { //Usuario pendiente de aprobación.
                // $message = "Tu solicitud de registro está pendiente por aprobarse";
                echo json_encode(array('status' => 1));
                exit();
            } else if($user -> getUser($email, $password) == 2) { //Usuario rechazado.
                // $message = "Tu solicitud de registro está rechazada";
                echo json_encode(array('status' => 2));
                exit();
            } else {
                // $message = "Credenciales incorrectas";
                echo json_encode(array('status' => 3));
                exit();
            }
        }
    }