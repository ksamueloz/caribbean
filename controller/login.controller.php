<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["email"]) || empty($_POST["password"])) {
            // $message = "Campos vacíos";
            echo json_encode(array('status' => 5));
            exit();
        } else {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = new userLogin();
            $results = $user -> getUser($email, $password);

            if ($results != null) { 
                
                if ($results["role"] == "Administrador") {

                    $_SESSION["session"] = "session_started";
                    $_SESSION["name"] = $results["name"];
                    $_SESSION["last_name"] = $results["last_name"];
                    $_SESSION["email"] = $results["email"];
                    $_SESSION["picture"] = $results["picture"];
                    $_SESSION["role"] = $results["role"];

                    echo json_encode(array('status' => 0));
                    exit();
                } else if ($results["role"] == "Vendedor") {

                    if ($results["status"] == "Pendiente") { 
                        echo json_encode(array('status' => 1));
                        exit();
                    } else if ($results["status"] == "Aprobado") {
                        
                        $_SESSION["session"] = "session_started";
                        $_SESSION["iduser"] = $results["iduser"];
                        $_SESSION["name"] = $results["name"];
                        $_SESSION["last_name"] = $results["last_name"];
                        $_SESSION["email"] = $results["email"];
                        $_SESSION["picture"] = $results["picture"];
                        $_SESSION["role"] = $results["role"];
                        $_SESSION["identity"] = $results["identity"];
                        $_SESSION["city"] = $results["city"];

                        echo json_encode(array('status' => 2));
                        exit();
                    } else if ($results["status"] == "Rechazado") { 
                        echo json_encode(array('status' => 3));
                        exit();
                    }
                }
            } else {
                echo json_encode(array('status' => 4));
                exit();
            }
        }
    }