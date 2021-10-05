<?php
    require_once "connection.php";

    class userRegisterAsSeller extends Connection {

        public function checkIfUserExist($email) {
            $sql = "SELECT email FROM user WHERE email = :email";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":email", $email, PDO::PARAM_STR);
            $stament -> execute();
            $results = $stament -> rowCount();
            
            if($results > 0) {
                return true;
            }
            return false;
        }
        public function registerNewUserAsSeller($name, $last_name, $identity, $city, $email, $password) {
            $sql = "INSERT INTO user (name, last_name, email, password, role) VALUES (:name, :last_name, :email, :password, 2);";
            $sql .= "INSERT INTO seller (user_iduser, identity, status, city) VALUES ((SELECT iduser FROM user where iduser = (select MAX(iduser) from user)), :identity, 1, :city);";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":last_name", $last_name);
            $stament -> bindParam(":identity", $identity);
            $stament -> bindParam(":city", $city);
            $stament -> bindParam(":email", $email);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $stament -> bindParam(":password", $password);
            
            $stament -> execute();
            $results = $stament -> rowCount();
            
            if($results > 0) {
                return true;
            }
            return false;
        }
    }