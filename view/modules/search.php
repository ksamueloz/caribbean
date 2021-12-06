
<?php

session_start();
require_once "../../model/connection.php";
require_once "../../model/search.model.php";
require_once "../../controller/search.controller.php";

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Proyecto Caribbean Tour">
        <meta name="keywords" content="Iniciar sesión, Caribbean Tour">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <!-- Bootstrap Css 5.1 -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <!-- Style Css -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Búsqueda de personas y lugares</title>
    </head>
<body>
<!-- Barra de navegación -->
<div class="container">
    <div class="row">
        <div class="col col-lg-12">
            <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom bg-light fixed-top" id="nav-login">
                <div class="md-6 title">
                    <a class="navbar-brand" href="/index.php" data-bs-toggle="tooltip" data-placement="top" title="Página web de turismo en la costa caribe">
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
                        <?php
                            if(!isset($_SESSION["session"])):
                        ?>
                            <div class="md-3" class="links-li-su">
                                <a href="login.php">
                                    <button class="btn btn-none btn-custom">Inicia sesión</button>
                                </a>
                            </div>
                            <div class="md-3" class="links-li-su">              
                                <a href="signupAsSeller.php">
                                    <button class="btn btn-none btn-custom">Regístrate</button>
                                </a>
                            </div>
                        <?php
                            endif;
                        ?>
                    </span>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Fin barra de navegación -->

<!-- Sección inicial del Wave -->

<section>
    <div class="row wave-login" style="margin-top: -10%;">
        <div class="container-fluid p-0 ">
            <svg xmlns="http://www.w3.org/2000/svg " viewBox="0 0 1440 320 ">
                <path fill="#6EC5FF " fill-opacity="1 " d="M0,160L34.3,160C68.6,160,137,160,206,186.7C274.3,213,343,267,411,266.7C480,267,549,213,617,186.7C685.7,160,754,160,823,186.7C891.4,213,960,267,1029,277.3C1097.1,288,1166,256,1234,229.3C1302.9,203,1371,181,1406,170.7L1440,160L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z ">
                </path>
            </svg>
        </div>
    </div>
</section>

<!-- Fin inicial del Wave -->

<!-- Búsqueda -->
<section>
        <div class="container search">
            <div class="col-6 c1">
                <form method="POST">
                    <input type="text" class="form-control" name="search-sites" id="search-sites" placeholder="Busca un sitio por su nombre">
                    <div class="col-6 c2">
                        <input type="button" class="form-control btn btn-primary" value="Buscar" id="btnSearchSites">
                    </div>
                </form>
            </div>
            
        </div>
</section>
<hr class="mb-4">

<!-- Muestra de información de los sitios -->
<section>
        <div class="container dt">
            <div class="col data-1">
                <label for="nameSiteSearch">Nombre del lugar</label>
                <input type="text" class="form-control" name="nameSiteSearch" id="nameSiteSearch" placeholder="Aquí saldrá el nombre del sitio." disabled>
                <label for="descriptionSSiteSearch">Descripción</label>
                <textarea class="form-control" name="descriptionSiteSearch" id="descriptionSiteSearch"  cols="20" rows="4" placeholder="Aquí saldrá la descripción del sitio." disabled></textarea>
            </div>
            <div class="col data-2">
               <img src="../assets/img/site-base.jpg" alt="Foto del sitio turístico." id="photoSiteSearch" name="photoSiteSearch" >
            </div>
        </div>
</section>

<section>
    <div class="container">
        <div id="mapa">
        </div>
    </div>
</section>

<hr class="mb-4">
<!-- Footer -->
<div class="container container-fluid justify-content-center align-items-center text-center footer" class="">
    <hr class="mb-4"/>
        <footer class="text-center text-lg-start">
            <section>
                <div>
                    <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">¿Estás satisfech@?</span>
                        <a href="/index.php">
                            <button type="button" class="btn btn-primary btn-rounded">
                                Regresa a la página principal
                            </button>
                        </a>
                    </p>
                </div>
            </section>
            <!-- Section: Social media -->
            <section class="mb-4 text-center">
                    <!-- Facebook -->
                    <a style="color: #2c2c2c !important;" class="btn btn-outline-light btn-floating m-1" href="#!" role="button">
                        <i class="bi bi-github"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                        </svg>
                    </a>
                    <!-- Facebook -->
                    <a style="color: #2c2c2c !important;" class="btn btn-outline-light btn-floating m-1" href="#!" role="button">
                        <i class="bi bi-facebook"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                    </a>
                </section>
                <!-- Section: Social media -->

                <!-- Copyright -->
                    <div class="text-center p-3">
                        © 2021 Copyright:
                    </div>
                <!-- Copyright -->
        </footer>
    </div>
    <!-- Js -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<!-- Mi JS de búsqueda -->
<script src="../assets/js/search.js"></script>
<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Bootstrap Js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>