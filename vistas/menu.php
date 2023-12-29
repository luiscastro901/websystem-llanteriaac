<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas y facturación</title>
  <?php require_once "dependencias.php"; ?>
  <link rel="stylesheet" href="../css/menu_copy.css">
  <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  <style>
    header {
      display: flex;
      justify-content: space-between;
      background: #4755a8;
    }

    body {
      background-image: linear-gradient(90deg, #d4d3cf, #d8cfc6, #e2d8d1);
    }


    .dropdown {
      margin-right: 300px;
      font-size: 15px;
      z-index: 1000;
    }

    @media screen and (max-width: 758px) {
      .dropdown {
        margin-right: 100px;
      }
    }
  </style>
</head>
<body id="body">
  <header>
        <div class="icon__menu">
            <i class="fas fa-bars" id="btn_open"></i>
        </div>

        <div class="dropdown">
            <a href="#" style="color: #0c1330;"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['usuario']; ?>  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a class="exit" style="color: red" href="../procesos/salir.php"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
              
            </ul>
          </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <i class="fa-solid fa-shop"></i>
            <h4>Llantería AC</h4>
        </div>

        <div class="options__menu">	

            <a href="inicio.php" class="selected">
                <div class="option">
                    <i class="fas fa-home" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            

            <a href="usuarios.php">
                <div class="option">
                    <i class="far fa-solid fa-users" title="Usuarios"></i>
                    <h4>Usuarios</h4>
                </div>
            </a>

            

            <a href="pedidos.php">
                <div class="option">
                    <!-- <i class="far fa-file" title="Pedidos"></i> -->
                    <i class="far fa-solid fa-file-pen" title="Pedidos"></i>
                    <h4>Pedidos</h4>
                </div>
            </a>

            <a href="categorias.php">
                <div class="option">
                    <i class="fa-solid fa-list"></i>
                    <h4>Categorias</h4>
                </div>
            </a>

            <a href="productos.php">
                <div class="option">
                    <i class="far fa-solid fa-boxes-stacked" title="Gestionar Productos"></i>
                    <h4>Productos</h4>
                </div>
            </a>

            <a href="empleados.php">
                <div class="option">
                    <i class="fa-solid fa-users-rectangle" title="Empleados"></i>
                    <h4>Empleados</h4>
                </div>
            </a>

            <a href="ventas.php">
                <div class="option">
                    <i class="far fa-solid fa-cart-arrow-down" title="Vender Producto"></i>
                    <h4>Vender Producto</h4>
                </div>
            </a>

            <a href="datosCliente.php">
                <div class="option">
                    <i class="far fa-duotone fa-address-book"></i>
                    <h4>Consultar Datos Cliente</h4>
                </div>
            </a>

            <a href="../procesos/salir.php" class="exit">
                <div class="option">
                    <i class="far fa-solid fa-right-from-bracket" title="Salir"></i>
                    <h4>Salir</h4>
                </div>
            </a>

        </div>

    </div>
    
    <script src="../js/menu.js"></script>
    <script type="text/javascript">
      
    </script>
</body>
</html>