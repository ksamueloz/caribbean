<?php
    session_start();
    require_once "../../model/connection.php";

    require_once "../../model/adminTouristSites.model.php";
    require_once "../../controller/adminTouristSites.controller.php";

    
    if(!isset($_SESSION["session"])){
        header("Location: /index.php");
    } 
    else if(isset($_SESSION["session"]) && $_SESSION["role"] == "Administrador") {
        
        
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Gestión de sitios</title>

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
                    <a class="navbar-brand" href="/index.php" data-bs-toggle="tooltip" data-placement="top" title="Logo de página web de turismo en la costa caribe">
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
                            <a class="navbar-brand" href="administrator.php" data-bs-toggle="tooltip" data-placement="top" title="Sesión">
                                Gestión de usuarios
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
        <button type="button" id="newSite" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#siteModal">
            Nuevo sitio turístico
        </button>
        <table id="table_tsite"></table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="siteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="siteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="siteModalLabel">REGISTRO DE SITIO TURISTICO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <form method="POST" id="siteForm">
                        <div class="mb-3">
                            <label class="form-label float-left">Elija el nombre de la ciudad</label>
                            <select id="city2" name="city2" class="form-control">
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Cartagena">Cartagena</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">País de origen de la ciudad</label>
                            <select id="country" name="country" class="form-control">
                                <option value="Colombia">Colombia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Nombre del sitio</label>
                            <input class="form-control" id="name2" name="name2" type="text" placeholder="Ingrese el nombre del sitio turístico">
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">Descripción</label>
                            <textarea class="form-control rounded-0" name="description" id="description" rows="3" placeholder="Ingrese una descripción del sitio turístico"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnRegisterSite">Registrar nuevo sitio</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCloseSM">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de actualización de información -->
    <!-- Modal -->
    <div class="modal fade" id="updateSiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSiteModalLabel">Actualizar información</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <form method="POST" id="siteForm">
                        <div class="mb-3">
                            <label class="form-label float-left">ID</label>
                            <input class="form-control" id="updateId2" name="updateId2" type="text" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">Elija el nombre de la ciudad</label>
                            <select id="updateCity2" name="updateCity2" class="form-control">
                                <option value="Santa Marta">Santa Marta</option>
                                <option value="Cartagena">Cartagena</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">País de origen de la ciudad</label>
                            <select id="updateCountry" name="updateCountry" class="form-control">
                                <option value="Colombia">Colombia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label float-left">Nombre del sitio</label>
                            <input class="form-control" id="updateName2" name="updateName2" type="text" placeholder="Ingrese el nombre del sitio turístico">
                        </div>
                        <div class="mb-3">
                            <label class="form-label float-left">Descripción</label>
                            <textarea class="form-control rounded-0" name="updateDescription2" id="updateDescription2" rows="3" placeholder="Ingrese una descripción del sitio turístico"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnUpdateSite">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCloseUSM">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Eliminar informaci+on; -->
    <!-- Site Modal -->
    <div class="modal fade" id="deleteSiteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSiteModalLabel">¿Está seguro de querer eliminar la información?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <button type="button" class="btn btn-primary" id="btnDeleteSite">Elíminar información</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Cancelar</button>
                </div>
            </div>
        </div>
    </div>  

    <!-- Footer -->
    <div class="container container-fluid justify-content-center align-items-center text-center footer footer-admin" style="margin-top: 12%;">
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