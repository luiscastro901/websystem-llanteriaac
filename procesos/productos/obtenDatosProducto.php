<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Productos.php";

  $obj=new productos();

  $idprod=$_POST['idprod'];

  echo json_encode($obj->obtenDatosProducto($idprod));
?>