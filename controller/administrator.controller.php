<?php

require_once "../../model/connection.php";
$conexion = new Connection();
    


$name = (isset($_POST["name"])) ? $_POST["name"]: "";
$last_name = (isset($_POST["last_name"])) ? $_POST["last_name"]: "";
$identity = (isset($_POST["identity"])) ? $_POST["identity"]: "";
$city = (isset($_POST["city"])) ? $_POST["city"]: "";
$email = (isset($_POST["email"])) ? $_POST["email"]: "";
$password = (isset($_POST["password"])) ? $_POST["password"]: "";
$status = (isset($_POST["status"])) ? $_POST["status"]: "";


$option = (isset($_POST["option"])) ? $_POST["option"]: "";
$id = (isset($_POST["id"])) ? $_POST["id"]: "";
$role = (isset($_POST["role"])) ? $_POST["role"]: "";

switch($option) {

    case 1:
        
        $photo_name = $_FILES['photo']['name'];
        $tmp_dir = $_FILES["photo"]["tmp_name"];
        $photo_size = $_FILES["photo"]["size"];
        
        $random = rand(100, 1000);
        $photo_dir = "../assets/seller-img/" . $random . $photo_name;
        $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($photo_ext, $extensions)) {
            if ($photo_size < 2000000) {
                $statusF = True;
            } else {
                echo json_encode(array("status" => 4));
                exit();
            }
        } else {
            echo json_encode(array("status" => 5));
            exit();
        }
    

        if($statusF) {
            $newSeller = new crudAdministrator();

            // Generación de código de 4 digitos.
            
            // $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $code = substr(str_shuffle($characters), 0, 4);
            

            if($newSeller -> checkIfSellerExist($email)) {
                echo json_encode(array("status" => 3));
                exit();
            } else {
                if($newSeller -> registerNewSeller($name, $last_name, $identity, $status, $city, $email, $password, $photo_dir, $code)) {
                    move_uploaded_file($tmp_dir, $photo_dir);
                    echo json_encode(array("status" => 1));
                    exit();
                } else {
                    echo json_encode(array("status" => 2));
                    exit();
                }
            }
        }
        break;

    case 2:

        $user =  new crudAdministrator();
        $user = $user -> getAllUsers();
        $sellerData = array();
        while ($result = $user -> fetch(PDO::FETCH_ASSOC)) {
 
            $sellerRows = array();
            $sellerRows["iduser"] = $result["iduser"];
            $sellerRows["identity"] = $result["identity"];
            $sellerRows["name"] = $result["name"];
            $sellerRows["last_name"] = $result["last_name"];
            $sellerRows["photo"] = '<img src="'.$result["picture"].'" style="width:50px; height:50px;">';
            $sellerRows["email"] = $result["email"];
            $sellerRows["role"] = $result["role"];
            $sellerRows["city"] = $result["city"];
            $sellerRows["status"] = $result["status"];
            $sellerRows["edit"] = '<button type="button" id="btnEdit" data-id="'.$result["iduser"].'" class="btn btn-warning btn-xs update">Actualizar</button>';
            $sellerRows["delete"] = '<button type="button" id="btnDelete" data-id2="'.$result["iduser"].'" class="btn btn-danger btn-xs delete">Eliminar</button>';
            $sellerData[] = $sellerRows;
        }

        echo json_encode($sellerData);
        exit();
        break;
    case 3:
        
        $getSeller = new crudAdministrator();
        $getSeller = $getSeller -> getSeller($id);
        if($getSeller) {
            while($result = $getSeller -> fetch(PDO::FETCH_ASSOC)) {
                $userData = array();
                $userData[] = $result["iduser"];
                $userData[] = $result["identity"];
                $userData[] = $result["name"];
                $userData[] = $result["last_name"];
                $userData[] = $result["email"];
                $userData[] = $result["password"];
                $userData[] = $result["role"];
                $userData[] = $result["city"];
                $userData[] = $result["status"];
            }
            echo json_encode($userData);
            exit();
        } else {
            echo json_encode("No se pudo encontrar.");
            exit();
        } 
        break;
    case 4:
        $update = new crudAdministrator();
        
        if($update -> updateSeller($id, $name, $last_name, $identity, $status, $city, $email)) {
            echo json_encode(array("status" => 4));
            exit();
        } else {
            echo json_encode(array("status" => 5));
            exit();
        }
        break;
    case 5:
        $deleteSeller = new crudAdministrator();
        $getSeller = $deleteSeller -> getSeller($id);
        if($getSeller) {
            $userPhoto = array();
            while($result = $getSeller -> fetch(PDO::FETCH_ASSOC)) {
                $userPhoto["picture"] = $result["picture"];
            }
            if($deleteSeller -> deleteSeller($id)) {
                    
                    echo json_encode(array("status" => 6));
                    exit();
                } else {
                    echo json_encode(array("status" => 7));
                    exit();
                }
            if($userPhoto){
                unlink($userPhoto["picture"]);
                
            } else {
                echo json_encode(array("status" => 8));
                exit();
            }
        }
        
        break;
}