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
    }
?>