<?php
    session_start();
    require_once "../../model/connection.php";
    require_once "../../model/signupAsSeller.model.php";
    require_once "../../model/administrator.model.php";
    require_once "../../controller/administrator.controller.php";

    
    if(!isset($_SESSION["session"])){
        header("Location: /caribbean");
    } 
    else if(isset($_SESSION["session"]) && $_SESSION["role"] == "Administrador") {
        
        
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Bienvenido administrador</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap Css 5.1 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- Style Css -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

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
                            <a class="navbar-brand" href="manageTouristSites.php" data-bs-toggle="tooltip" data-placement="top" title="Sesión">
                                Gestión de sitios
                            </a>
                        </div>
                        <div class="md-3" class="links-li-su">   
                            <a class="navbar-brand" href="../../controller/logout.controller.php" data-bs-toggle="tooltip" data-placement="top" title="Sesión">
                                Cerrar sesión
                            </a>
                        </div>
                    </span>
                </div>
            </nav>
        </div>
    </header>
    <div class="container" style="margin-top: 10%;">
        <button type="button" id="newSeller" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sellerModal">
            Nuevo vendedor
        </button>
        <table id="table_seller" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cédula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>      
                </tr>
            </thead>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="sellerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sellerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sellerModalLabel">REGISTRO DE VENDEDOR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <form method="POST" id="sellerForm" enctype="multipart/form-data">
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
                        <div class="mb-3">
                            <label  class="form-label float-left">Elija el estado</label>
                            <select id="status" name="status" class="form-control">
                                <option value="Pendiente">Pendiente</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnRegisterSeller">Registrar nuevo vendedor</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Seller Modal -->
    <div class="modal fade" id="updateSellerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateSellerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSellerModalLabel">ACTUALIZACIÓN DE INFORMACIÓN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <form method="POST" id="updateSellerForm">
                        <div class="mb-3">
                            <label class="form-label float-left">N. Identidad</label>
                            <input class="form-control" id="updateIdentity" name="identity" type="number" placeholder="Ingrese su numero de cedula">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Nombre</label>
                            <input class="form-control" id="updateName" name="name" type="text" placeholder="Ingrese su nombre">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Apellido</label>
                            <input class="form-control" id="updateLast_name" name="last_name" type="text" placeholder="Ingrese su apellido">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Correo</label>
                            <input class="form-control" id="updateEmail" name="email" type="email" placeholder="Ingrese su correo" disabled>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-label">Contraseña</label>
                            <input class="form-control" id="updatePassword" name="password" type="password" placeholder="Ingrese su contraseña" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">Elija la ciudad en la que labora</label>
                            <select id="updateCity" name="city" class="form-control">
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Cartagena">Cartagena</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Elija el estado</label>
                            <select id="updateStatus" name="status" class="form-control">
                                <option value="Pendiente">Pendiente</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>
                        <input type="hidden" name="updateId" id="updateId">
                        <input type="hidden" name="updateRole" id="updateRole">
                        
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="btnUpdateSeller" value="Actualizar información">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Actualizar información; -->
    <!-- Seller Modal -->
    <div class="modal fade" id="confirmSellerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmSellerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmSellerModalLabel">¿Está seguro de querer actualizar los datos?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <button type="submit" class="btn btn-primary" id="btnConfirmSeller">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                </div>
            </div>
        </div>
    </div>  
    
    <!-- Eliminar información; -->
    <!-- Seller Modal -->
    <div class="modal fade" id="deleteSellerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteSellerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSellerModalLabel">¿Está seguro de querer eliminar la información?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <button type="button" class="btn btn-primary" id="btnDeleteSeller">Elíminar información</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                </div>
            </div>
        </div>
    </div>  

    <!-- Footer -->
    <div class="container container-fluid justify-content-center align-items-center text-center footer footer-admin" style="margin-top: 12%;>
        <hr class="mb-4"/>
            <footer class="text-center text-lg-start">
                <section>
                    <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">&nbsp;</span>
                        <a href="#">
                            <!-- <button type="button" class="btn btn-primary btn-rounded">
                                $nbsp;
                            </button> -->
                        </a>
                    </p>
                </section>
            <?php
                require_once "footer.php";
            ?>
    <?php } else { header("Location: /caribbean"); } ?>