<?php
    session_start();
    require_once "../../model/connection.php";
    require_once "../../model/login.model.php";
    require_once "../../controller/login.controller.php";

    
    if(!isset($_SESSION["session"])){
        header("Location: /caribbean");
    } 
    else if(isset($_SESSION["session"]) && $_SESSION["role"] == "Administrador") {

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Css 5.1 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Style Css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Bienvenido Adminitrador</title>
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
                            <a class="navbar-brand" href="signupAsSeller.php" data-bs-toggle="tooltip" data-placement="top" title="Regístrate">
                            
                                <a href="../../controller/logout.controller.php">Cerrar sesión</a>
                            </a>
                        </div>
                    </span>
                </div>
            </nav>
        </div>
   
</head>



<body>
    <h3>Hola <?= $_SESSION["name"]; ?></h3>
  
<br/>
<br>
<br>
    <h5>Opciones de Administrador</h5>
    <br>
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <a href="../modules/userManager.php" class="btn btn-primary">Usuarios</a>
          </div>
        </div>
  </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>  
          <a href="#" class="btn btn-primary">Sitios turisticos</a>
        </div>
      </div>
    </div>
  </div>


</body>
</html>
<?php } else { header("Location: /caribbean"); } ?>