<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Productos.php";

  $idprod=$_POST['idproducto'];

  $obj=new productos();

  echo $obj->eliminaProducto($idprod);
?>