
<?php

    session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Proyecto Caribbean Tour">
    <meta name="keywords" content="Iniciar sesión, Caribbean Tour">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Css 5.1 -->
    <link rel="stylesheet" href="view/assets/css/bootstrap.min.css">
    <!-- Style Css -->
    <link rel="stylesheet" href="view/assets/css/style.css">
    <title>Iniciar sesión</title>
</head>
<body>
    <!-- Barra de navegación -->
    <div class="container-fluid">
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
                        if(!isset($_SESSION["user_email"])):
                    ?>
                        <div class="md-3" class="links-li-su">
                            <a href="view/modules/login.php">
                                <button class="btn btn-none btn-custom">Inicia sesión</button>
                            </a>
                        </div>
                        <div class="md-3" class="links-li-su">              
                            <a href="view/modules/signupAsSeller.php">
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
    <!-- Fin barra de navegación -->

    <!-- Sección inicial del Wave -->
    <section>
        <div class="row wave-login">
            <div class="container-fluid p-0 ">
                <svg xmlns="http://www.w3.org/2000/svg " viewBox="0 0 1440 320 ">
                    <path fill="#6EC5FF " fill-opacity="1 " d="M0,160L34.3,160C68.6,160,137,160,206,186.7C274.3,213,343,267,411,266.7C480,267,549,213,617,186.7C685.7,160,754,160,823,186.7C891.4,213,960,267,1029,277.3C1097.1,288,1166,256,1234,229.3C1302.9,203,1371,181,1406,170.7L1440,160L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z ">
                    </path>
                </svg>
            </div>
        </div>
    </section>
    <!-- Fin inicial del Wave -->
    <section>
        <p>
            Hola!
        </p>
    </section>
    <!-- Js -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <!-- Bootstrap Js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>