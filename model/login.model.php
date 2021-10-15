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
            
            if($results > 0 && password_verify($password, $user["password"]) && $user["role"] == "Administrador") {
                return array('name' => $user["name"],
                             'last_name' => $user["last_name"],
                             'email' => $user["email"],
                             'picture' => $user["picture"],
                             'role' => $user["role"]
                            );
            }
            else if($results > 0 && password_verify($password, $user["password"]) && $user["role"] == "Vendedor") {
                //Buscará la información del vendedor en la tabla "Seller".
                $userStatus = userLogin::getSellerUserStatus($user["iduser"]);

                if($userStatus != null) {
                    if ($userStatus["status"] == "Pendiente") {
                        return array('role' => $user["role"], 'status' => $userStatus["status"]);
                    }
                    else if ($userStatus["status"] == "Aprobado") {
                        return array('name' => $user["name"],
                             'last_name' => $user["last_name"],
                             'email' => $user["email"],
                             'picture' => $user["picture"],
                             'role' => $user["role"],
                             'identity' => $userStatus["identity"],
                             'city' => $userStatus["city"],
                             'status' => $userStatus["status"]
                            );
                    } else if($userStatus["status"] == "Rechazado") { 
                        return array('role' => $user["role"], 'status' => $userStatus["status"]);
                    }
                }
            }
            return null;
        }

        public function getSellerUserStatus($id) {
            $sql = "SELECT identity, status, city FROM seller WHERE user_iduser = :id";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id", $id);
            $stament -> execute();
            $user = $stament -> fetch(PDO::FETCH_ASSOC);
            $results = $stament -> rowCount();

            if($results > 0) {
                if($user["status"] == "Pendiente") { return array('status' => $user["status"]); }
                else if($user["status"] == "Aprobado") 
                        {
                        return array('identity' => $user["identity"],
                                     'city' => $user["city"],
                                     'status' => $user["status"]);  
                        }
                else if($user["status"] == "Rechazado") { return array('status' => $user["status"]); }
                
            }
            return null;
        }
    }