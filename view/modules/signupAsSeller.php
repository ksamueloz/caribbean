<?php

    session_start();
    require_once "../../model/connection.php";
    require_once "../../model/signupAsSeller.model.php";
    require_once "../../controller/signupAsSeller.controller.php";

    if(isset($_SESSION["session"])) {
        header("Location: /index.php");
    }
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
        <title>Registrate</title>
    </head>
    <body>
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
                            <a class="navbar-brand" href="login.php" data-bs-toggle="tooltip" data-placement="top" title="Inicia sesión">
                                <button class="btn btn-none btn-custom">Inicia sesión</button>
                            </a>
                        </div>
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

        <!-- Sección del formulario del registro -->
        <section>
            <div class="container container-fluid" id="container-form-login">
                <div class="row">
                    <div class="col-md-6 justify-content-center align-items-center text-center">
                        <img src="../assets/img/ice-cream-seller.jpg" alt="Imagen de vendedor" id="img-login">
                    </div>
                    <div class="col-md-6">
                        <div class="row d-flex">
                            <div class="justify-content-center align-items-center text-center">
                                <h2>Bienvenido!</h2>
                                <h4>Registrate como Vendedor</h4>
                                    <?php
                                        if(!empty($message)):
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            <p>
                                                <?= $message  #Interpretamos la variable. ?>
                                            </p>
                                        </div>
                                    <?php
                                        endif;
                                    ?>
                            </div>
                        </div>
                        <form action="signupAsSeller.php" method="POST" id="signup-form">
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
                                <label for="city" class="form-label float-left" >Elija la ciudad en la que labora</label>
                                <select name="city" id="city" class="form-control">
                                    <option value="Santa Marta">Santa Marta</option><
                                    <option value="Cartagena">Cartagena</option>
                                </select>
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
                                <button type="submit" class="form-control btn btn-primary" name="singup-btn" id="singup-btn">
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Final del formulario de registro -->

        <!-- Sección final del wave -->
        <section>
            <div class="row wave-login">  <!-- style="box-shadow: -3px 5px 16px 3px rgb(110 217 255);" -->
                <div class="container-fluid p-0 svg-div">
                    <svg xmlns="http://www.w3.org/2000/svg " viewBox="0 0 1440 320 ">
                        <path fill="#6EC5FF " fill-opacity="1 " d="M0,192L40,176C80,160,160,128,240,112C320,96,400,96,480,128C560,160,640,224,720,208C800,192,880,96,960,90.7C1040,85,1120,171,1200,208C1280,245,1360,235,1400,229.3L1440,224L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z ">
                        </path>
                    </svg>
                </div>
            </div>
        </section>
        <!-- Seccón wave finalizada -->

        <!-- Footer -->
        <div class="container container-fluid justify-content-center align-items-center text-center" class="footer">
        <hr class="mb-4"/>
            <footer class="text-center text-lg-start">
                <section>
                    <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">¿Quieres iniciar sesión?</span>
                        <a href="login.php">
                            <button type="button" class="btn btn-primary btn-rounded">
                                Hazlo aquí
                            </button>
                        </a>
                    </p>
                </section>
            <?php
                require_once "footer.php";
            ?>