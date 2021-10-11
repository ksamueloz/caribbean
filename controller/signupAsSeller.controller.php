<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["name"])  || empty($_POST["last_name"]) || empty($_POST["identity"]) || empty($_POST["city"]) || empty($_POST["email"]) || empty($_POST["password"])) {
            #$message = "Algunos campos vacíos";

            #$dato['success'] = 0;
            #echo json_encode($dato);
            echo json_encode(array('status' => 0));
            exit();
        } else {
            $name = $_POST["name"];
            $last_name = $_POST["last_name"];
            $identity = $_POST["identity"];
            $city = $_POST["city"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $user = new userRegisterAsSeller();
            if($user -> checkIfUserExist($email)){
                //$message = "Existe en nuestra base de datos";
                echo json_encode(array('status' => 1));
                exit();
            } else {
                $user -> registerNewUserAsSeller($name, $last_name, $identity, $city, $email, $password);
                //$message = "Registro exitoso";
                echo json_encode(array('status' => 2));
                exit();
            }
        }
    }