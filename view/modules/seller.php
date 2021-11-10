<?php
    session_start();
    require_once "../../model/connection.php";
    require_once "../../model/login.model.php";
    require_once "../../controller/login.controller.php";

    
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
                            <a class="navbar-brand" href="#" data-bs-toggle="tooltip" data-placement="top" title="Nombre">
                                <?php echo ($_SESSION["name"] ." ". $_SESSION["last_name"]); ?>
                            </a>
                        </div>
                        <div class="md-3" class="links-li-su">   
                            <a class="navbar-brand" href="" data-bs-toggle="tooltip" data-placement="top" title="Sesión">
                                Bienvenido  
                            </a>
                        </div>
                    </span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Sidebard -->

    <div class="container" style="margin-top: 5%;"></div>
        <div class="d-flex" >
            <div id="sidebar-container" >
                <div class="menu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="d-block text-light p-3 nav-link active show" data-bs-toggle="tab" href="#tab-1" ><i class="icon ion-md-cart mr-4 lead"></i> Gestionar Productos</a>
                        </li>
                        <li class="nav-item">
                          <a class="d-block text-light p-3 nav-link" data-bs-toggle="tab" href="#tab-2" ><i class="icon ion-md-person mr-4 lead"></i> Editar</a>

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
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary form-control" id="btnpro" type="button" data-bs-toggle="modal" data-bs-target="#productModal">Agregar Productos</button>
                    </div>
                    <div class="buscar col-6">
                        <input type="search" name="busquedaproduc" placeholder="Busque un producto" class="form-control">
                        <input class="btn-primary form-control"type="submit" value="Buscar">
                    </div>
                </div>
                <div class="justify-content-center">
                    <h5>
                        <p class="form-control p-2">
                            Los productos que agregues estarán aquí:
                        </p>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
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
                </div>
            </div>
            <div class="tab-pane" id="tab-2">
                <div class="row p-3">
                    <form action="">
                        <div class="mb-3">
                        <label class="form-label float-left">N. Identidad</label>
                            <input class="form-control" id="identity" name="identity" type="number" placeholder="Ingrese el número de cédula">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Nombre</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Ingrese el nombre">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Apellido</label>
                            <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Ingrese el apellido">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Foto</label>
                            <input class="form-control" id="photo" name="photo" type="file" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Correo</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Ingrese el correo">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-label">Contraseña</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Ingrese su contraseña">
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">Elija la ciudad en la que labora</label>
                            <select id="city" name="city" class="form-control">
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Cartagena">Cartagena</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class=" btn-primary" id="btnUpdateSeller" value="Actualizar información">
                            <button type="button" class=" btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                        </div>
                </form>
            </div>  
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
<?php } else { header("Location: /caribbean"); } ?>