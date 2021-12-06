<?php

session_start();
require_once "../../model/connection.php";
require_once "../../model/search.model.php";
require_once "../../model/seller.model.php";
require_once "../../controller/search.controller.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Proyecto Caribbean Tour">
    <meta name="keywords" content="Iniciar sesión, Caribbean Tour">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Css 5.1 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Style Css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Búsqueda de vendedores</title>
</head>
<body>
    <!-- Barra de navegación -->
    <div class="container">
        <div class="row">
            <div class="col col-lg-12">
                <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom bg-light fixed-top" id="nav-login">
                    <div class="md-6 title">
                        <a class="navbar-brand" href="#" data-bs-toggle="tooltip" data-placement="top" title="Página web de turismo en la costa caribe">
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
    
    <!-- Búsqueda -->
    <section>
            <div class="container search">
                <div class="col-6 c1">
                    <form method="POST">
                        <input type="text" class="form-control" name="search-seller" id="search-seller" placeholder="Busca a la persona ingresando su código.">
                        <div class="col-6 c2">
                            <input type="button" class="form-control btn btn-info" value="¿Cómo funciona?" id="btnInfo">
                            &nbsp;
                            <input type="button" class="form-control btn btn-primary" value="Buscar" id="btnSearchSeller">
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <hr class="mb-4">

    <!-- Variedad de vendedores. -->
    <section>
        <div class="card container justifiy-content-center text-center card-food">
            <div class="card-body">
                <h4>
                    Aquí saldrá toda la información del vendedor que busques.
                </h4>
            </div>
        </div>
    </section>

    <!-- Muestra la información de los productos ofrecidos por x vendedor. -->
    <section>
            <div class="container dt">
                <div class="col data-1">
                    <label for="nameSellerSearch">Nombre de la persona</label>
                    <input type="text" class="form-control data-inp" name="nameSellerSearch" id="nameSellerSearch" placeholder="Aquí saldrá el nombre de la persona." disabled>

                    <label for="lastNameSellerSearch">Apellido de la persona</label>
                    <input type="text" class="form-control data-inp" name="lastNameSellerSearch" id="lastNameSellerSearch" placeholder="Aquí saldrá el apellido de la persona." disabled>

                    <label for="roleSellerSearch">Rol</label>
                    <input type="text" class="form-control data-inp" name="roleSellerSearch" id="roleSellerSearch" placeholder="Aquí saldrá el role de la persona." disabled>
                    
                    <label for="codeSellerSearch">Código del vendedor</label>
                    <input type="text" class="form-control data-inp" name="codeSellerSearch" id="codeSellerSearch" placeholder="Aquí saldrá el código de la persona." disabled>
                </div>
                <div class="col data-2" style="width: 500px; height: 500px;">
                    <img src="../assets/img/ice-c.jpg" alt="Foto de la persona." id="photoSellerSearch" name="photoSellerSearch" >
                </div>
            </div>
    </section>

    <!-- Variedad de productos del vendedor. -->
    <section>
        <div class="card container justifiy-content-center text-center card-food">
            <div class="card-body">
                <h4>
                    Los productos asociados a este vendedor son los siguientes:
                </h4>
            </div>
        </div>
    </section>
    <!-- Sección de tarjetas principales -->
    <div class="container cards-principals">
        <!-- <div class="row"> -->
            <div class="row cards-search">
                <!-- <div class="col">
                    <div class="card" style="width: 20rem;">
                        <img src="../assets/img/rice.jpeg" class="card-img-top" alt="...">
                        
                        <div class="card-body">
                            <h4 class="card-title text-center justify-content-center">Nombre del producto</h4>
                            <br/>
                            <h5 class="card-text">Acompaña tus comidas con este arroz mixto.</h5>
                        </div>
                        <br/>
                        <div class="card-block">
                            <h5 class="card-text">Precio (COP): $2.000</h5>
                        </div>
                    </div>
                </div> -->
            <!-- </div> -->
        </div>
    </div>


    <!-- Carousel de playas -->

    <hr class="mb-4">
    <!-- Footer -->
    <div class="container container-fluid justify-content-center align-items-center text-center footer" class="">
        <hr class="mb-4"/>
            <footer class="text-center text-lg-start">
                <section>
                    <div>
                        <p class="d-flex justify-content-center align-items-center">
                            <span class="me-3">¿Terminaste de ver todo?</span>
                            <a href="/index.php">
                                <button type="button" class="btn btn-primary btn-rounded">
                                    Vuelve al inicio
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