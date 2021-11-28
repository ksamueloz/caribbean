<?php

$nameSite = (isset($_POST["nameSites"])) ? $_POST["nameSites"]: "";
$option = (isset($_POST["option"])) ? $_POST["option"]: "";
$code = (isset($_POST["code"])) ? $_POST["code"]: "";


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

    case "searchSeller":
        // Toda la información asociada a un determinado vendedor.

        $infoSeller = new search();
        if($infoSeller = $infoSeller -> searchSeller($code)){
            $products = new seller();
            $products = $products -> getProducts($infoSeller["iduser"]);
            
            $cards = '';
            while ($result = $products -> fetch(PDO::FETCH_ASSOC)) {
                $cards .= '<div class="col">';
                $cards .= '<div class="card" style="width: 20rem; height: 30rem;">';
                $cards .= '<img src="'.$result["picture"].'" class="card-img-top" alt="Foto del producto">';
                $cards .= '<div class="card-body">';
                $cards .= '<h4 class="card-title text-center justify-content-center">';
                $cards .= $result["name"];
                $cards .= '</h4>';
                $cards .= '<br/>';
                $cards .= '<h5 class="card-text">';
                $cards .= $result["description"];
                $cards .= '</h5>';
                $cards .= '</div>';
                $cards .= '<br/>';
                $cards .= '<div class="card-block">';
                $cards .= '<h5 class="card-text">Precio (COP): '.$result["price"].'</h5>';
                $cards .= '</div>';
                $cards .= '</div>';
                $cards .= '</div>';
            }

            echo json_encode(array("seller" => $infoSeller, "cards" => $cards));
            exit();
        }   
        else {
            echo json_encode(array("seller" => "No encontrado"));
            exit();
        }     
        
        break;
}
?>