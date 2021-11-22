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
    }
?>