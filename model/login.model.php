<?php 
    require_once "connection.php";

    class userLogin extends Connection {

        public function getUser($email, $password) {
            //$sql = "SELECT * FROM user u JOIN seller s ON u.iduser = s.user_iduser AND u.email = :email";
            $sql = "SELECT * FROM user WHERE email = :email";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":email", $email);
            $stament -> execute();
            $user = $stament -> fetch(PDO::FETCH_ASSOC);
            $results = $stament -> rowCount();
            
            if($results > 0 && password_verify($password, $user["password"]) && $user["role"] == "Administrador") {
                return 0; //Iniciará sesión
            }
            else if($results > 0 && password_verify($password, $user["password"]) && $user["role"] == "Vendedor") {
                $userStatus = userLogin::getSellerUserStatus($user["iduser"]);
                if($userStatus == "Aprobado") { return 0; }
                else if($userStatus == "Pendiente") { return 1; }
                else if($userStatus == "Rechazado") { return 2; }
            }
            return 3;
        }

        public function getSellerUserStatus($id) {
            $sql = "SELECT * FROM seller WHERE user_iduser = :id";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id", $id);
            $stament -> execute();
            $user = $stament -> fetch(PDO::FETCH_ASSOC);
            $results = $stament -> rowCount();
            $status = "";
            if($results > 0 && $user["status"] == "Pendiente") {
                $status = "Pendiente";
            } else if($results > 0 && $user["status"] == "Aprobado") {
                $status = "Aprobado";
            } else if($results > 0 && $user["status"] == "Rechazado") {
                $status = "Rechazado";
            }
            return $status;
        }
    }