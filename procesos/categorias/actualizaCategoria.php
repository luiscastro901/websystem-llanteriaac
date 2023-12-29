<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Categorias.php";

  $datos=array($_POST['idCategoria'], $_POST['categoriaU']);

  $obj=new categorias();

  echo $obj->actualizaCategoria($datos);
?>