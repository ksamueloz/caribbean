<?php

    require_once "connection.php";

    class seller extends Connection {
        
        public function registerProduct($idseller, $name, $description, $picture, $price) {
            $sql = "INSERT INTO product (seller_iduser, name, description, picture, price) VALUES (:idseller, :name, :description, :picture, :price)";
            
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":idseller", $idseller);
            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":description", $description);
            $stament -> bindParam(":picture", $picture);
            $stament -> bindParam(":price", $price);

            $stament -> execute();
            $result = $stament -> rowCount();

            if ($result > 0) {
                return true;
            }
            return false;
        }

        public function getProducts($id_seller) {
            $sql = "SELECT * FROM product WHERE seller_iduser = :id_seller";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id_seller", $id_seller);
            $stament -> execute();
            
            return $stament;
        }

        public function getParticularProduct($id_product) {
            $sql = "SELECT * FROM product WHERE idproduct = :id_product";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id_product", $id_product);
            $stament -> execute();

            $result = $stament -> rowCount();

            if($result > 0) {
                while($result = $stament -> fetch(PDO::FETCH_ASSOC)) {
                    $productData = array();
                    $productData[] = $result["name"];
                    $productData[] = $result["description"];
                    $productData[] = $result["picture"];
                    $productData[] = $result["price"];
                }
                return $productData;
            }
            return false;
        }

        public function updateProductWithPhoto($id_product, $name, $description, $picture, $price) {
            $sql = "UPDATE product SET name = :name, description = :description, picture = :picture, price = :price WHERE idproduct = :id_product";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":id_product", $id_product);
            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":description", $description);
            $stament -> bindParam(":picture", $picture);
            $stament -> bindParam(":price", $price);

            $stament -> execute();
            $results = $stament -> rowCount();
                
            if($results > 0) {
                return true;
            }
            return false;
        }

        public function updateProductWithoutPhoto($id_product, $name, $description, $price) {
            $sql = "UPDATE product SET name = :name, description = :description, price = :price WHERE idproduct = :id_product";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":id_product", $id_product);
            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":description", $description);
            $stament -> bindParam(":price", $price);

            $stament -> execute();
            $results = $stament -> rowCount();
                
            if($results > 0) {
                return true;
            }
            return false;
        }

        public function deleteProduct($id_product) {
            $sql = "DELETE FROM product WHERE idproduct = :id_product";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id_product", $id_product);
            $stament -> execute();
            $results = $stament -> rowCount();

            if($results > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function getProfile($id_seller) {
            $sql = "SELECT * FROM seller INNER JOIN user ON seller.user_iduser = user.iduser WHERE user.iduser = :id_seller";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id_seller", $id_seller);
            $stament -> execute();

            $result = $stament -> rowCount();

            if($result > 0) {
                $userData = array();
                while($result = $stament -> fetch(PDO::FETCH_ASSOC)) {
                    
                    $userData[] = $result["identity"];
                    $userData[] = $result["name"];
                    $userData[] = $result["last_name"];
                    $userData[] = $result["picture"];
                    $userData[] = $result["email"];
                    $userData[] = $result["city"];
                    $userData[] = $result["code"];
                }
                return $userData;
            }
            return false;
        }

        public function updateProfileWithoutPhoto($id_seller, $name, $last_name, $identity, $city, $email) {
            
            $sql = "UPDATE seller INNER JOIN user ON user.iduser = seller.user_iduser SET user.name = :name, user.last_name = :last_name, user.email = :email, seller.identity = :identity, seller.city = :city
            WHERE user.iduser = :id_seller";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":id_seller", $id_seller);
            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":last_name", $last_name);
            $stament -> bindParam(":identity", $identity);
            $stament -> bindParam(":city", $city);
            $stament -> bindParam(":email", $email);
            
            $stament -> execute();
            $results = $stament -> rowCount();
                
            if($results > 0) {
                return true;
            } 
            return false;
        }

        public function updateProfileWithPhoto($id_seller, $name, $last_name, $identity, $city, $email, $picture) {
            
            $sql = "UPDATE seller INNER JOIN user ON user.iduser = seller.user_iduser SET user.name = :name, user.last_name = :last_name, user.email = :email, user.picture = :picture, seller.identity = :identity, seller.city = :city
            WHERE user.iduser = :id_seller";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":id_seller", $id_seller);
            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":last_name", $last_name);
            $stament -> bindParam(":identity", $identity);
            $stament -> bindParam(":city", $city);
            $stament -> bindParam(":email", $email);
            $stament -> bindParam(":picture", $picture);
            
            $stament -> execute();
            $results = $stament -> rowCount();
                
            if($results > 0) {
                return true;
            } 
            return false;
        }
    }
?>