<?php

    require_once "connection.php";

    class crudTouristSites extends Connection {

        public function registerNewTS($city, $country, $name, $description, $longitude, $latitude) {
            $sql = "INSERT INTO city (name_city, country_of_origin) VALUES (:name_city, :country_of_origin);";
            $sql .= "INSERT INTO tourist_site (name, description, latitude, longitude, city_idcity) VALUES (:name, :description, :latitude, :longitude, (SELECT idcity FROM city where idcity = (select MAX(idcity) from city)));";

            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":name_city", $city);
            $stament -> bindParam(":country_of_origin", $country);
            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":description", $description);
            $stament -> bindParam(":latitude", $latitude);
            $stament -> bindParam(":longitude", $longitude);
            
            
            $stament -> execute();
            $results = $stament -> rowCount();
                
            if($results > 0) {
                return true;
            }
            return false;
        }
        public function getAllTouristSites() {
            
            $usuarios = array(); //Devolverá todo
            try {
                $sql = "SELECT * FROM tourist_site INNER JOIN city ON tourist_site.city_idcity = city.idcity";
                $stament = $this -> connect() -> prepare($sql);
                $stament -> execute();
                return $stament;
            } catch (PDOException $ex) {
                print "ERROR: " . $ex->getMessage();
            }
        }

        public function getParticularSite($id) {
            $sql = "SELECT * FROM city INNER JOIN tourist_site ON city.idcity = tourist_site.city_idcity WHERE tourist_site.city_idcity = :id";
            $stament = $this -> connect() -> prepare($sql);
            $stament -> bindParam(":id", $id);
            $stament -> execute();
            $result = $stament -> rowCount();
                
            if($result > 0) {
                while($result = $stament -> fetch(PDO::FETCH_ASSOC)) {
                    $userData = array();
                    $userData[] = $result["idcity"];
                    $userData[] = $result["country_of_origin"];
                    $userData[] = $result["name_city"];
                    $userData[] = $result["name"];
                    $userData[] = $result["description"];
                    $userData[] = $result["latitude"];
                    $userData[] = $result["longitude"];
                }
                return $userData;
            } 
            return false;
        }

        public function updateSite($id, $city, $country, $name, $description, $longitude, $latitude){
            $sql = "UPDATE tourist_site INNER JOIN city ON city.idcity = tourist_site.city_idcity SET city.name_city = :name_city, city.country_of_origin = :country_of_origin, tourist_site.name =:name, tourist_site.description = :description, tourist_site.latitude =:latitude, tourist_site.longitude =:longitude WHERE city.idcity = :id";
            $stament = $this -> connect() -> prepare($sql);

            $stament -> bindParam(":id", $id);
            $stament -> bindParam(":name_city", $city);
            $stament -> bindParam(":country_of_origin", $country);
            $stament -> bindParam(":name", $name);
            $stament -> bindParam(":description", $description);
            $stament -> bindParam(":latitude", $latitude);
            $stament -> bindParam(":longitude", $longitude);
            
            $stament -> execute();
            $results = $stament -> rowCount();
                
            if($results > 0) {
                return true;
            }
            return false;
        }
        
        public function deleteSite($id) {
            $sql = "DELETE city, tourist_site FROM tourist_site JOIN city ON city.idcity = tourist_site.city_idcity WHERE tourist_site.city_idcity  = :id";
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
?>