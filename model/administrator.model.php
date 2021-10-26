<?php
    require_once "connection.php";

    class crudAdministrator extends Connection {

        public function registerNewSeller($name, $last_name, $identity, $status, $city, $email, $password) {
            $sql = "INSERT INTO user (name, last_name, email, password, role) VALUES (:name, :last_name, :email, :password, 2);";
            $sql .= "INSERT INTO seller (user_iduser, identity, status, city) VALUES ((SELECT iduser FROM user where iduser = (select MAX(iduser) from user)), :identity, :status, :city);";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":last_name", $last_name);
            $stament -> bindParam(":identity", $identity);
            $stament -> bindParam(":status", $status);
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
            } else {
                return false;
            }
        }
    }