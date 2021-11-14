<?php

$nameProduct = (isset($_POST["nameProduct"])) ? $_POST["nameProduct"]: "";
$descProduct = (isset($_POST["descProduct"])) ? $_POST["descProduct"]: "";
$priceProduct = (isset($_POST["priceProduct"])) ? $_POST["priceProduct"]: "";

$option = (isset($_POST["option"])) ? $_POST["option"]: "";
$idProduct = (isset($_POST["idProduct"])) ? $_POST["idProduct"]: "";


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
        case "viewProducts";
                
                $products = new seller();
                $products = $products -> getProducts($_SESSION["iduser"]);
                // $productsData = array();
                $cards = '';
                while ($result = $products -> fetch(PDO::FETCH_ASSOC)) {
                        $cards .= '<div class="col-12 col-md-6 col-lg-4 mb-4">';
                        $cards .= '<div class="card">';
                        $cards .= '<div class="card-block">';
                        $cards .= '<div>';
                        $cards .= '<img class="card-img-top img-p" src="'.$result["picture"].'" alt="Imagen de producto">';
                        $cards .= '</div>';
                        $cards .= '<h4 class="card-title text-center justify-content-center">';
                        $cards .= $result["name"];
                        $cards .= '</h4>';
                        $cards .= '<h6 class="card-subtitle text-muted text-center justify-content-center">';
                        $cards .= 'Un sabor sin igual';
                        $cards .= '</h6><br/>';
                        $cards .= '<p class="card-text p-y-1"> <br/>';
                        $cards .= $result["description"];
                        $cards .= '</p>';
                        $cards .= '<p class="card-text p-y-1">';
                        $cards .= $result["price"];
                        $cards .= '</p>';
                        $cards .= '<div class="card-footer">';
                        $cards .= '<a href="#" class="card-link btn btn-success" id="btnProdEdit" data-ProEdit="'.$result["idproduct"].'">Editar</a>';
                        $cards .= '<a href="#" class="card-link btn btn-warning" id="btnProdDel" data-ProDel="'.$result["idproduct"].'">Eliminar</a>';
                        $cards .= '</div>';
                        $cards .= '</div>';
                        $cards .= '</div>';
                        $cards .= '</div>';
                        
                }

                //echo json_encode(array('status' => "success", $productsData));
                echo json_encode(array('status' => "success", 'cards' => $cards));
                exit();
                break;
        
        case "getParticularProduct":
                $getProduct = new seller();
                $result = $getProduct ->  getParticularProduct($idProduct);
                if($result) {
                    echo json_encode($result);
                    exit();
                    break;
                } else {
                    echo json_encode(array("status" => "Hubo un problema"));
                    exit();
                }
                break;
        case "updateProduct":
                $nameProduct = $_POST["productNameUpdate"];
                $descProduct = $_POST["productDescUpdate"];
                $priceProduct = $_POST["productPriceUpdate"];
                $idProduct = $_POST["idProduct"];

                $updateProduct = new seller();
                if(isset($_FILES['productPhotoUpdate']['name'])) {

                        $productPhotoName = $_FILES['productPhotoUpdate']['name'];
                        $tmp_dir = $_FILES["productPhotoUpdate"]["tmp_name"];
                        $photo_size = $_FILES["productPhotoUpdate"]["size"];
                        
                        $random = rand(100, 1000);
                        $photo_dir = "../assets/product-img/" . $random . $productPhotoName;
                        $photo_ext = strtolower(pathinfo($productPhotoName, PATHINFO_EXTENSION));
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

                        if ($status) {
                                $getPhoto = new seller();
                                $getPhoto = $getPhoto -> getParticularProduct($idProduct);
                                if($updateProduct -> updateProductWithPhoto($idProduct, $nameProduct, $descProduct, $photo_dir, $priceProduct)) {
                                        unlink($getPhoto[2]);
                                        move_uploaded_file($tmp_dir, $photo_dir);
                                        echo json_encode(array("status" => "Producto actualizado"));
                                        exit();
                                }
                                else {
                                        echo json_encode(array("status" => "Producto no actualizado"));
                                        exit();
                                }
                        }
                } else {
                        if($updateProduct -> updateProductWithoutPhoto($idProduct, $nameProduct, $descProduct, $priceProduct)) {
                                echo json_encode(array("status" => "Producto actualizado"));
                                exit();
                        }
                        else {
                                echo json_encode(array("status" => "Producto no actualizado"));
                                exit();
                        }
                }
                
                break;
        
        case "deleteProduct":

                $deleteProduct = new seller();
                $getPhoto = new seller();
                $getPhoto = $getPhoto -> getParticularProduct($idProduct);

                if($deleteProduct -> deleteProduct($idProduct)) {
                        unlink($getPhoto[2]);
                        echo json_encode(array("status" => "Eliminado"));
                        exit();

                } else {

                        echo json_encode(array("status" => "Sin eliminar"));
                        exit();
                }
                break; 
}

?>