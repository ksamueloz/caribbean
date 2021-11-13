<?php
    session_start();
    require_once "../../model/connection.php";
    require_once "../../model/seller.model.php";
    require_once "../../controller/seller.controller.php";

    
    if(!isset($_SESSION["session"])){
        header("Location: /caribbean");
    } 
    else if(isset($_SESSION["session"]) && $_SESSION["role"] == "Vendedor") {

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Vendedor</title>
    <link rel="stylesheet" href="..//assets/css/style.css">
    <link rel="stylesheet" href="..//assets/css/bootstrap.min.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
</head>
<body>
<header>
        <!-- Barra de navegación -->
      <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom bg-light fixed-top" id="nav-login">
                <div class="md-6 title">
                    <a class="navbar-brand" href="/caribbean" data-bs-toggle="tooltip" data-placement="top" title="Logo de página web de turismo en la costa caribe">
                        <p>
                            Caribbean Tour
                        </p>
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse md-6" id="navbarContent">
                    <span class="navbar-text ms-5 container-fluid justify-content-center align-items-center text-center space-between">
                        <div class="md-3" class="links-li-su">   
                            <a class="navbar-brand" href="" data-bs-toggle="tooltip" data-placement="top" title="Sesión">
                                Bienvenido  
                            </a>
                        </div>
                        <div class="md-3" class="links-li-su">   
                            <a class="navbar-brand" href="#" data-bs-toggle="tooltip" data-placement="top" title="Nombre">
                                <?php echo ($_SESSION["name"] ." ". $_SESSION["last_name"]); ?>
                            </a>
                        </div>
                    </span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Sidebard -->

    <div class="container" style="margin-top: 5%; position: fixed;"></div>
        <div class="d-flex" >
            <div id="sidebar-container" >
                <div class="menu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="d-block text-light p-3 nav-link active show" data-bs-toggle="tab" href="#tab-1" ><i class="icon ion-md-cart mr-4 lead"></i> Gestionar Productos</a>
                        </li>
                        <li class="nav-item">
                          <a class="d-block text-light p-3 nav-link" data-bs-toggle="tab" href="#tab-2" ><i class="icon ion-md-person mr-4 lead"></i> Editar Perfil</a>

                        </li>
                    </ul>
                    <a href="../../controller/logout.controller.php" class="d-block text-light p-3" ><i class="icon ion-md-backspace mr-4 lead" ></i> Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Fin del Sidebard -->
    
    <!-- Operaciones sobre productos -->

    <div class="container">
        <div class="tab-content">
            <div class="tab-pane active show" id="tab-1">
                <div class="row options">
                    <div class="col-6">
                        <button class="btn btn-primary form-control" id="btnpro" type="button" data-bs-toggle="modal" data-bs-target="#productModal">Agregar Productos</button>
                    </div>
                    <div class="buscar col-6">
                        <input type="search" name="busquedaproduc" placeholder="Busque un producto" class="form-control">
                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>-->
                        <input class="btn-primary form-control"type="submit" value="Buscar">
                    </div>
                </div>
                <div class="justify-content-center">
                    <h5>
                        <h4 class="p-2">
                            &nbsp; Los productos que agregues estarán aquí:
                        </h4>
                    </h5>
                </div>
                <div class="row cards-products">
                    
                <!--
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-block">
                                <div>
                                    <img class="card-img-top" src="..//assets/img/empanadas.jpg" alt="Imagen de producto">
                                </div>
                                <h4 class="card-title text-center justify-content-center">Nombre del producto</h4>
                                <h6 class="card-subtitle text-muted text-center justify-content-center">
                                    Un sabor sin igual
                                </h6>
                                <br/>
                                <p class="card-text p-y-1">Breve descripción del producto.</p>
                                <p class="card-text p-y-1">$Precio del producto.</p>
                                <div class="card-footer">
                                    <a href="#" class="card-link btn btn-success">Editar</a>
                                    <a href="#" class="card-link btn btn-warning">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                -->
                </div>
            </div>
            <div class="tab-pane" id="tab-2">
                <div class="row p-3">
                    <div class="modal-header data">
                        <h5 class="modal-title" id="sellerProductModalLabel">Datos Personales</h5>
                    </div>
                    <form action="">
                        <div class="mb-3">
                            <img src="../assets/img/avatar1.jpg" alt="Foto de perfil" class="photo-profile">
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">N. Identidad</label>
                            <input class="form-control" id="identityPerfil" name="identityPerfil" type="number" placeholder="Número de identidad">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Nombre</label>
                            <input class="form-control" id="namePerfil" name="namePerfil" type="text" placeholder="Nombre (s) del usuario.">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Apellido</label>
                            <input class="form-control" id="lastNamePerfil" name="lastNamePerfil" type="text" placeholder="Apellido (s) del usuario.">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Cambiar foto de perfil</label>
                            <input class="form-control" id="photoPerfil" name="photoPerfil" type="file" accept="image/*" placeholder="Foto de perfil">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Correo</label>
                            <input class="form-control" id="emailPerfil" name="emailPerfil" type="email" placeholder="Correo electrónico.">
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">Elija la ciudad en la que labora</label>
                            <select id="city" name="city" class="form-control">
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Cartagena">Cartagena</option>
                            </select>
                        </div>
                        <div class="mb-3 modal-footer">
                            <input type="submit" class="btn-primary" id="btnUpdateSellerPerfil" value="Actualizar información">
                            <button type="button" class="btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                        </div>
                </form>
            </div>  
        </div>
    </div>

    <!-- Modal de productos -->
    <div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Nuevo producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <form method="POST" id="sellerForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label  class="form-label float-left">Nombre del producto</label>
                            <input class="form-control" id="nameProduct" name="nameProduct" type="text" placeholder="Ingrese el nombre del producto">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Descripción</label>
                            <input class="form-control" id="descProduct" name="descProduct" type="text" placeholder="Breve descripción del producto.">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Precio del producto</label>
                            <input class="form-control" id="priceProduct" name="priceProduct" type="number" placeholder="Ingrese el precio unitario en pesos colombianos.">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Foto</label>
                            <input class="form-control" id="photoProduct" name="photoProduct" type="file" accept="image/*">
                        </div>
                        <input type="hidden" name="sellerId"seller">
                    </form>
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnRegisterProduct">Agregar producto</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Seller JS -->
<script src="../assets/js/seller.js" language="JavaScript" type="text/javascript"></script>
</html>
<?php } else { header("Location: /caribbean"); } ?>