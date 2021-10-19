<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['status']) && $_POST["status"] == "seller") {
            if(empty($_POST["name"]) || empty($_POST["last_name"]) || empty($_POST["identity"]) || empty($_POST["city"]) || empty($_POST["email"]) || empty($_POST["password"])) {
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
                    echo json_encode(array('status' => 1));
                    exit();

                } else {
                    $user -> registerNewUserAsSeller($name, $last_name, $identity, $city, $email, $password);
                    echo json_encode(array('status' => 3));
                    exit();
                }
            }
        }
        if (isset($_POST['status']) && $_POST["status"] == "administrator") {
            if(empty($_POST["name"]) || empty($_POST["last_name"]) || empty($_POST["identity"]) || empty($_POST["email"]) || empty($_POST["password"])) {

                echo json_encode(array('status' => 0));
                exit();
            } else {

                $name = $_POST["name"];
                $last_name = $_POST["last_name"];
                $identity = $_POST["identity"];
                $email = $_POST["email"];
                $password = $_POST["password"];
    
                $user = new userRegisterAsSeller();

                if($user -> checkIfUserExist($email)){
                    echo json_encode(array('status' => 1));
                    exit();

                } else {
                    $user = new crudAdministrator();

                    $user -> registerNewUserAsAdministrator($name, $last_name, $identity, $email, $password);
                    echo json_encode(array('status' => 3));
                    exit();
                }
            }
        }
    }
    if (!empty($_GET["id"]) && !empty($_GET["selection"]) == "delete") {
        $id = $_GET["id"];
        $user = new crudAdministrator();
        
        if($user -> deleteSeller($id)) {
            echo "sirve";
        } else {
            echo "No sirve";
        }
    }