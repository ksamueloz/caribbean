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
    
     <!-- Boxicon -->
     <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <title>Bienvenido Adminitrador</title>
      <!-- Barra de navegación -->     
</head>
<body>      
        <div class="container mt-5">
        <div class="row justify-content-center">
        <div class=" col-md-7">
        <div class="card">
        <div class="card-header">
         Lista administradores
        </div>
        
        <div class="p-4">
        <table class="table aling-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">email</th>
                <th scope="col">otro campo</th>
                <th scope="col" colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <td scope="row">1</td>
            <td>Juan</td>
            <td>Juan@gmail</td>
            <td>Jusdsan</td>
            <td>Editar</td>
            <td>Eliminar</td>           
        </tbody>
        </table>
        </div>
    
    </div>
 </div>
        <div class=" col-md-4">
        <div class="card">
            <div class="card-header">
                Ingresar usuario
            </div>
            <form action="" class="p-4" method="POST" action="">
            <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="txtNombre" autofocus>
            </div>
            <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="txtNombre" autofocus>
            </div>
            <div class="mb-3">
            <label class="form-label">otro campo</label>
            <input type="text" class="form-control" name="txtNombre" autofocus>
            </div>
            <div class="d-grid"></div>
                <input type="hidden" name="oculto" value="1">
                <input type="subimit" class="btn btn-primary" value="Registrar">
            </form>
       </div>
      </div> 
  </div>
</div>    
</body>
</html>
<?php } else { header("Location: /caribbean"); } ?>