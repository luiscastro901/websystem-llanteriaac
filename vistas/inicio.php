<?php
  session_start();
  if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <?php require_once "menu.php"; ?>

  <style>
    .thumbnail {
      margin-bottom: 20px;
      height: 400px;
      overflow: hidden;
      position: relative;
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .caption {
      position: absolute;
      bottom: 0;
      background: rgba(255, 255, 255, 0.8);
      width: 100%;
      padding: 10px;
      text-align: center;
    }

    .container {
      width: 80%;
    }

    @media (max-width: 768px) {
      .container {
        width: auto;
      }
      .thumbnail {
        width: 100%;
        margin-right: 0;
      }
    }

    .dropdown {
      display: none;
    }
  </style>
</head>
<body>
  <!-- cards -->
  <div class="container">
    <h1 class="text-center">Bienvenido</h1>
    <br>
    <div class="row">
      
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="../img/usuarios.png" alt="Usuarios">
          <div class="caption">
            <h3>Usuarios</h3>
            <p>Gestión de usuarios del sistema.</p>
            <p><a href="usuarios.php" class="btn btn-primary" role="button">Ir a Usuarios</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="../img/pedidos.png" alt="Pedidos">
          <div class="caption">
            <h3>Pedidos</h3>
            <p>Gestión de pedidos realizados.</p>
            <p><a href="pedidos.php" class="btn btn-primary" role="button">Ir a Pedidos</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="../img/empleados.jpg" alt="Empleados">
          <div class="caption">
            <h3>Empleados</h3>
            <p>Gestión de empleados del negocio.</p>
            <p><a href="empleados.php" class="btn btn-primary" role="button">Ir a Empleados</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="../img/productos.jpg" alt="Productos">
          <div class="caption">
            <h3>Productos</h3>
            <p>Gestión de productos del negocio.</p>
            <p><a href="productos.php" class="btn btn-primary" role="button">Ir a Productos</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="../img/categorias.jpg" alt="Categorias">
          <div class="caption">
            <h3>Categorías</h3>
            <p>Gestión de categorías de los productos.</p>
            <p><a href="categorias.php" class="btn btn-primary" role="button">Ir a Categorías</a></p>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="../img/ventas.jpg" alt="Ventas">
          <div class="caption">
            <h3>Ventas</h3>
            <p>Gestión de ventas del sistema.</p>
            <p><a href="ventas.php" class="btn btn-primary" role="button">Ir a Ventas</a></p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
<?php
  }else{
    header("location:../index.php");
  }
?>