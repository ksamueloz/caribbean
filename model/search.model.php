<?php

    require_once "connection.php";

    class search extends Connection {


        public function getSites($name) {
            $sql = "SELECT * FROM tourist_site WHERE name LIKE :name";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":name", $name);
            $stament -> execute();
            
            $result = $stament -> rowCount();

            if($result > 0) {
                $siteData = array();
                while($result = $stament -> fetch(PDO::FETCH_ASSOC)) {  
                    $siteData["idtourist_site"] = $result["idtourist_site"];
                    $siteData["name"] = $result["name"];
                    $siteData["description"] = $result["description"];
                    $siteData["picture"] = $result["picture"];
                    $siteData["latitude"] = $result["latitude"];
                    $siteData["longitude"] = $result["longitude"];
                }
                return $siteData;
            }
            return false;
        }

        public function searchSeller($code) {
            $sql = "SELECT * FROM seller INNER JOIN user ON seller.user_iduser = user.iduser WHERE code LIKE :code";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":code", $code);
            $stament -> execute();
            
            $result = $stament -> rowCount();

            if($result > 0) {
                $sellerData = array();
                while($result = $stament -> fetch(PDO::FETCH_ASSOC)) {  
                    $sellerData["iduser"] = $result["iduser"];
                    $sellerData["name"] = $result["name"];
                    $sellerData["last_name"] = $result["last_name"];
                    $sellerData["email"] = $result["email"];
                    $sellerData["picture"] = $result["picture"];
                    $sellerData["role"] = $result["role"];
                    $sellerData["status"] = $result["status"];
                    $sellerData["code"] = $result["code"];
                }
                return $sellerData;
            }
            return false;
        }
    }
?>