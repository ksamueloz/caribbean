<?php

$nameProduct = (isset($_POST["nameProduct"])) ? $_POST["nameProduct"]: "";
$descProduct = (isset($_POST["descProduct"])) ? $_POST["descProduct"]: "";
$priceProduct = (isset($_POST["priceProduct"])) ? $_POST["priceProduct"]: "";
$option = (isset($_POST["option"])) ? $_POST["option"]: "";


switch($option) {
        case "registerProduct":
                $photo_name = $_FILES['photoProduct']['name'];
                $tmp_dir = $_FILES["photoProduct"]["tmp_name"];
                $photo_size = $_FILES["photoProduct"]["size"];
                
                $random = rand(100, 1000);
                $photo_dir = "../assets/product-img/" . $random . $photo_name;
                $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
                $extensions = array("jpeg", "jpg", "png");

                if (in_array($photo_ext, $extensions)) {
                        if ($photo_size < 2000000) {
                                $status = True;
                        } else {
                                echo json_encode(array("status" => "Foto grande"));
                                exit();
                        }
                } else {
                        echo json_encode(array("status" => "Imagen no permitida"));
                        exit();
                }

                // Si la foto cumple todas las condiciones seguirá el proceso. 
                if($status) {
                        $newProduct = new seller();
                        if($newProduct -> registerProduct($_SESSION["iduser"], $nameProduct, $descProduct, $photo_dir, $priceProduct)){
                                move_uploaded_file($tmp_dir, $photo_dir);
                                echo json_encode(array("status" => "Producto agregado"));
                                exit();
                        } else {
                                echo json_encode(array("status" => "Producto no agregado"));
                                exit();
                        }
                    }
                break;

}

?>