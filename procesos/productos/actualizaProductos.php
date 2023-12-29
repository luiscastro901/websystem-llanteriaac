<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Productos.php";

  $obj=new productos();

  $datos=array(
    $_POST['idProducto'],
    $_POST['categoriaSelectU'],
    $_POST['nombreU'],
    $_POST['descripcionU'],
    $_POST['cantidadU'],
    $_POST['precioU']
  );

  echo $obj->actualizaProducto($datos);
?>