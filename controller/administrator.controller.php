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
                $status = True;
            } else {
                echo json_encode(array("status" => 4));
                exit();
            }
        } else {
            echo json_encode(array("status" => 5));
            exit();
        }
    

        if($status) {
            $newSeller = new crudAdministrator();
            if($newSeller -> checkIfSellerExist($email)) {
                echo json_encode(array("status" => 3));
                exit();
            } else {
                if($newSeller -> registerNewSeller($name, $last_name, $identity, $status, $city, $email, $password, $photo_dir)) {
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
        /* if($update -> checkIfSellerExist($email)) {
            echo json_encode(array("status" => 6));
            exit();
        } else { */
            if($update -> updateSeller($id, $name, $last_name, $identity, $status, $city, $email)) {
                echo json_encode(array("status" => 4));
                return exit();
            } else {
                echo json_encode(array("status" => 5));
                return exit();
            }
        /* }*/
        break;
    case 5:
        $deleteSeller = new crudAdministrator();
        $getSeller = $deleteSeller -> getSeller($id);
        if($getSeller) {
            $userPhoto = array();
            while($result = $getSeller -> fetch(PDO::FETCH_ASSOC)) {
                $userPhoto["picture"] = $result["picture"];
            }
            if($userPhoto){

                if($deleteSeller -> deleteSeller($id)) {
                    unlink($userPhoto["picture"]);
                    echo json_encode(array("status" => 6));
                    exit();
                } else {
                    echo json_encode(array("status" => 7));
                    exit();
                }
            } else {
                echo json_encode(array("status" => 8));
                exit();
            }
        }
        
        break;
}
// echo json_encode(array('id' => $result["iduser"], 'identity' => $result["identity"], 'name' => $result["name"], 'last_name' => $result["last_name"], 'city' => $result["city"], 'email' => $result["email"], 'status' => $result["status"]));


    /*
    if(!empty($_POST["action"]) && $_POST["action"] == "listSeller") {
        $user =  new crudAdministrator();
        $user = $user -> getAllUsers();
        $sellerData = array();
        while ($result = $user -> fetch(PDO::FETCH_ASSOC)){
            $sellerRows = array();
            $sellerRows[] = $result["iduser"];
            $sellerRows[] = $result["identity"];
            $sellerRows[] = $result["name"];
            $sellerRows[] = $result["last_name"];
            $sellerRows[] = $result["email"];
            $sellerRows[] = $result["role"];
            $sellerRows[] = $result["city"];
            $sellerRows[] = $result["status"];
            $sellerRows[] = '<button type="button" name="update" id="'.$result["iduser"].'" class="btn btn-warning btn-xs update">Actualizar</button>';
            $sellerRows[] = '<button type="button" name="delete" id="'.$result["iduser"].'" class="btn btn-danger btn-xs delete">Eliminar</button>';
            $sellerData[] = $sellerRows;
            
            // $id = $result["iduser"];
            // $identity = $result["identity"];
            // $name = $result["name"];
            // $last_name = $result["last_name"];
            // $email = $result["email"];
            // $role = $result["role"];
            // $city = $result["city"];
            // $status = $result["status"];
            // $update = '<button type="button" name="update" id="'.$result["iduser"].'" class="btn btn-warning btn-xs update">Actualizar</button>';
            // $delete = '<button type="button" name="delete" id="'.$result["iduser"].'" class="btn btn-danger btn-xs delete">Eliminar</button>';
            // $sellerData = array("id" => $id, "name" => $name, "last_name" => $last_name, "email" => $email, "role" => $role, "city" => $city, "status" => $status, "update" => $update, "delete" => $delete);
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "data" => $sellerData
        );
        // header('Content-type: application/json; charset=utf-8');
        echo json_encode($output);
        exit();
    }

    */
    /*
    error_reporting(0);
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

    switch($option) {
        case 1:
            $sql = "INSERT INTO user (name, last_name, email, password, role) VALUES (:name, :last_name, :email, :password, 2);";
            $sql .= "INSERT INTO seller (user_iduser, identity, status, city) VALUES ((SELECT iduser FROM user where iduser = (select MAX(iduser) from user)), :identity, :status, :city);";
            $stament = $conexion -> connect() -> prepare($sql);

            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":last_name", $last_name);
            $stament -> bindParam(":identity", $identity);
            $stament -> bindParam(":status", $status);
            $stament -> bindParam(":city", $city);
            $stament -> bindParam(":email", $email);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $stament -> bindParam(":password", $password);
            
            $stament -> execute();
            $sql = "SELECT * FROM user INNER JOIN seller ON user.iduser = seller.user_iduser";
            $stament = $conexion -> connect() -> prepare($sql);
            $stament -> execute();
            $result = $stament -> fetchALL(PDO::FETCH_ASSOC);
            // $result = array('id' => $result["iduser"], 'identity' => $result["identity"], 'name' => $result["name"], 'last_name' => $result["last_name"], 'city' => $result["city"], 'email' => $result["email"], 'status' => $result["status"]);
            break;
    }
    echo json_encode(array('id' => $result["iduser"], 'identity' => $result["identity"], 'name' => $result["name"], 'last_name' => $result["last_name"], 'city' => $result["city"], 'email' => $result["email"], 'status' => $result["status"]));
    */
    
    /*
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
    */