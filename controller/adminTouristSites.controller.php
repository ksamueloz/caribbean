
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $option = (isset($_POST["option"])) ? $_POST["option"]: "";
        $id = (isset($_POST["id"])) ? $_POST["id"]: "";

        $city = (isset($_POST["city"])) ? $_POST["city"]: "";
        $country = (isset($_POST["country"])) ? $_POST["country"]: "";
        $name = (isset($_POST["name"])) ? $_POST["name"]: "";
        $description = (isset($_POST["description"])) ? $_POST["description"]: "";
        $longitude = "";
        $latitude = "";

        switch($option) {

            case 6:
                if($city == "Santa Marta") { $longitude = "-74.2 11° 13′ 59″ Norte, 74° 12′ 0″ Oeste"; $latitude = "11.233"; }
                if($city == "Cartagena") { $longitude = "-75.5 10° 24′ 0″ Norte, 75° 30′ 0″ Oeste"; $latitude = " 10.4"; }

                $newSite = new crudTouristSites();
                if($newSite -> registerNewTS($city, $country, $name, $description, $longitude, $latitude)) {
                    echo json_encode(array("status" => 1));
                    exit();
                } else {
                    echo json_encode(array("status" => 2));
                    exit();
                 }
                break;
            case 7:
                $value = "";
                $value .= '
                            <tr>
                                <th scope="col">ID de la ciudad</th>
                                <th scope="col">Nombre de la ciudad</th>
                                <th scope="col">País de origen</th>
                                <th scope="col">Nombre del sitio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Latitude</th>
                                <th scope="col">Longitude</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>      
                            </tr>';
                $sites =  new crudTouristSites();
                $sites = $sites -> getAllTouristSites();
                while ($result = $sites -> fetch(PDO::FETCH_ASSOC)) {
                    $value .= '<tr>
                                <th scope="col">'.$result["idcity"].'</th>
                                <th scope="col">'.$result["name_city"].'</th>
                                <th scope="col">'.$result["country_of_origin"].'</th>
                                <th scope="col">'.$result["name"].'</th>
                                <th scope="col">'.$result["description"].'</th>
                                <th scope="col">'.$result["latitude"].'</th>
                                <th scope="col">'.$result["longitude"].'</th>
                                <th scope="col">
                                    <button class="btn btn-success" id="btnEdit" data-id='.$result["idcity"].'>Editar</button>
                                </th>
                                <th scope="col">
                                    <button class="btn btn-warning" id="btnDelete" data-id2='.$result["idcity"].'>Eliminar</button>
                                </th>      
                            </tr>';
                }
                $value .= '';
                echo json_encode(array("status" => "success", "html" => $value));
                exit();
                break;
            case 8:
                $getSite = new crudTouristSites();
                $result = $getSite ->  getParticularSite($id);
                if($result) {
                    echo json_encode($result);
                    exit();
                } else {
                    echo json_encode(array("status" => 2));
                    exit();
                 }
                break;
            case 9:
                if($city == "Santa Marta") { $longitude = "-74.2 11° 13′ 59″ Norte, 74° 12′ 0″ Oeste"; $latitude = "11.233"; }
                if($city == "Cartagena") { $longitude = "-75.5 10° 24′ 0″ Norte, 75° 30′ 0″ Oeste"; $latitude = " 10.4"; }

                $updateSite = new crudTouristSites();
                if($updateSite -> updateSite($id, $city, $country, $name, $description, $longitude, $latitude)) {
                    echo json_encode(array("status" => 1));
                    exit();
                } else {
                    echo json_encode(array("status" => 2));
                    exit();
                 }
                break;
            case 10:
                $deleteSite = new crudTouristSites();
                if($deleteSite -> deleteSite($id)) {
                    echo "Eliminado!";
                    exit();
                } else {
                    echo "No se pudo eliminar";
                    exit();
                }
                break;
        }
    }
?>