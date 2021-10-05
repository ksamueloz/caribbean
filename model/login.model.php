<?php 
    require_once "connection.php";

    class userLogin extends Connection {

        public function getUser($email, $password) {
            $sql = "SELECT * FROM user WHERE email = :email";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":email", $email);
            $stament -> execute();
            $user = $stament -> fetch(PDO::FETCH_ASSOC);
            $results = $stament -> rowCount();
            
            if($results > 0 && password_verify($password, $user["password"])) {
                return true;
            }
            return false;
        }
    }