<?php

$nameSite = (isset($_POST["nameSites"])) ? $_POST["nameSites"]: "";
$option = (isset($_POST["option"])) ? $_POST["option"]: "";


switch($option) {
    case "searchSites":
        $sites = new search();
        $sites = $sites -> getSites($nameSite);
        
        if($sites) {
            echo json_encode(array("site" => $sites));
            exit();
            break;
        } else {
            echo json_encode(array("status" => "Hubo un problema"));
            exit();
        }
        break;
}
?>