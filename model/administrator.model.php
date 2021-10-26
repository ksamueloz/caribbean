<?php
    require_once "connection.php";

    class crudAdministrator extends Connection {

        public function registerNewUserAsAdministrator($name, $last_name, $identity, $email, $password) {
            $sql = "INSERT INTO user (name, last_name, email, password, role) VALUES (:name, :last_name, :email, :password, 3);";
            $sql .= "INSERT INTO administrator (user_iduser, identity) VALUES ((SELECT iduser FROM user where iduser = (select MAX(iduser) from user)), :identity);";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":last_name", $last_name);
            $stament -> bindParam(":identity", $identity);
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

        public function getAllUsers() {
            
            $usuarios = array(); //Devolverá todo
            try {
                $sql = "SELECT * FROM user INNER JOIN seller ON user.iduser = seller.user_iduser";
                $stament = $this -> connect() -> prepare($sql);
                $stament -> execute();
                return $stament;
            } catch (PDOException $ex) {
                print "ERROR: " . $ex->getMessage();
            }
        }

        public function deleteSeller($id) {
            $sql = "DELETE user, seller FROM seller JOIN user ON user.iduser = seller.user_iduser WHERE seller.user_iduser = :id";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id", $id);
            $stament -> execute();
            $results = $stament -> rowCount();

            if($results > 0) {
                return true;
            }
            return false;
        }
    }