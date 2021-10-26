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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ADMIN</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>  
   <header><h1>AQUI VA EL HEADER</h1></header>
    <section id="specials" class="specials">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
             <li class="nav-item">
               <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">AGREGAR USUARIO</a>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      REGISTRAR VENDEDOR
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">REGISTRO VENDEDOR</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
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
                                      <option value="Santa Marta">Santa Marta</option>
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
                                  <button type="submit" class="btn btn-primary" id="singup-btn">
                                      Registrar
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
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
                                  <label for="email" class="form-label float-left">Correo</label>
                                  <input class="form-control" name="email" type="email" id="email" placeholder="Ingrese su correo">
                              </div>
                              <div class="mb-3">
                                  <label for="password" class="form-label float-label">Contraseña</label>
                                  <input class="form-control" name="password" type="password" id="password" placeholder="Ingrese su contraseña">
                              </div>
                              <div class="mb-3 justify-content-center align-items-center text-center">
                                  <button type="submit" class="btn btn-primary" id="singup-btn">
                                      Registrar
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
                      <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>ID</th>
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th></th>
                          </tr>
                        </tfoot>
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
   </section><!-- End Specials Section -->
 
     
  <footer id="footer">
    <h1>AQUI VA EL FOTER</h1>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
