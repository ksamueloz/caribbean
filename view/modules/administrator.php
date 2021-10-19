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
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/icon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Bootstrap Css 5.1 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- Style Css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>
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
                                <?php echo $_SESSION["name"], $_SESSION["last_name"] ?>
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
    <section id="specials" class="specials">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-1">AGREGAR USUARIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">LISTA DE USUARIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">SITIOS TURISTICOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-4">LISTA DE SITIOS TURISTICOS</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1">
                            <div class="row">
                                <div class="col-lg-4 details order-2 order-lg-1">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-admins" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        REGISTRAR VENDEDOR
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">REGISTRO DE VENDEDOR</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="administrator.php" method="POST" id="signup-form-1">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label float-left">Nombre</label>
                                                            <input class="form-control" name="name" type="text" placeholder="Ingrese su nombre">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="last_name" class="form-label float-left">Apellido</label>
                                                            <input class="form-control" name="last_name" type="text" placeholder="Ingrese su apellido">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="identity" class="form-label float-left">N. Identidad</label>
                                                            <input class="form-control" name="identity" type="number" placeholder="Ingrese su numero de cedula">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="city" class="form-label float-left">Elija la ciudad en la que labora</label>
                                                            <select name="city" class="form-control">
                                                                <option value="Santa Marta">Santa Marta</option>
                                                                <option value="Cartagena">Cartagena</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label float-left">Correo</label>
                                                            <input class="form-control" name="email" type="email" placeholder="Ingrese su correo">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label float-label">Contraseña</label>
                                                            <input class="form-control" name="password" type="password" placeholder="Ingrese su contraseña">
                                                        </div>
                                                        <div class="mb-3">
                                                            <input class="form-control" name="status" type="text" value="seller" hidden>
                                                        </div>
                                                        <div class="mb-3 justify-content-center align-items-center text-center">
                                                            <button type="submit" class="btn btn-primary" name="seller_btn" value="1">
                                                                Registrar nuevo vendedor
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 order-1 order-lg-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-admins" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                        REGISTRAR ADMINISTRADOR
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">REGISTRO ADMINISTRADOR</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="administrator.php" method="POST" id="signup-form-2">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label float-left">Nombre</label>
                                                            <input class="form-control" name="name" type="text" id="name" placeholder="Ingrese su nombre">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="last_name" class="form-label float-left">Apellido</label>
                                                            <input class="form-control" name="last_name" type="text" id="last_name" placeholder="Ingrese su apellido">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="identity" class="form-label float-left">N. Identidad</label>
                                                            <input class="form-control" name="identity" type="number" id="identity" placeholder="Ingrese su numero de cedula">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label float-left">Correo</label>
                                                            <input class="form-control" name="email" type="email" id="email" placeholder="Ingrese su correo">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label float-label">Contraseña</label>
                                                            <input class="form-control" name="password" type="password" id="password" placeholder="Ingrese su contraseña">
                                                        </div>
                                                        <div class="mb-3 justify-content-center align-items-center text-center">
                                                        <input class="form-control" name="administrador" type="text" value="2" hidden>
                                                        </div>
                                                        <div class="mb-3">
                                                            <input class="form-control" name="status" type="text" value="administrator" hidden>
                                                        </div>
                                                        <div class="mb-3 justify-content-center align-items-center text-center">
                                                            <button type="submit" class="btn btn-primary" name="admin_btn" value="2">
                                                                Registrar nuevo administrador
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <div class="row">
                                <div class="col-lg-12 details order-2 order-lg-1">
                                    <div class="table-resposive">
                                        <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Cedula</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Correo</th>
                                                    <th>Rol</th>
                                                    <th>Ciudad</th>
                                                    <th>Estado</th>
                                                    <th>Editar</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $user =  new crudAdministrator();
                                                $user = $user -> getAllUsers();
                                                while ($result = $user -> fetch(PDO::FETCH_ASSOC)) { ?>
                                                <tr>
                                                    <td><?php echo $result['iduser']; ?></td>
                                                    <td><?php echo $result['identity']; ?></td>
                                                    <td><?php echo $result['name']; ?></td>
                                                    <td><?php echo $result['last_name']; ?></td>
                                                    <td><?php echo $result['email']; ?></td>
                                                    <td><?php echo $result['role']; ?></td>
                                                    <td>
                                                        <?php 
                                                        if(isset($result['city'])) { 
                                                            echo $result['city']; } 
                                                        else echo "Sin dato"; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        if(isset($result['status'])) { 
                                                            echo $result['status']; } 
                                                        else echo "Sin dato"; ?>
                                                    </td>
                                                    <td>
                                                        <a class="nav-link btn btn-edit" href="administrator.php?id=<?php echo $result['iduser']; ?>">
                                                        <i class="bi bi-pencil"></i>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                        </svg>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="nav-link btn btn-delete" href="administrator.php?id=<?php echo $result['iduser']; ?>&selection=delete">
                                                        <i class="bi bi-trash"></i>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-3">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>Formulario de sitio turistico</h3>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h1>TABLA DE SITIOS TURISTICOS</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Footer -->
    <div class="container container-fluid justify-content-center align-items-center text-center footer footer-admin">
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