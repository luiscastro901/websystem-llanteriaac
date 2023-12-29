<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Categorias.php";

  $id=$_POST['idCategoria'];

  $obj=new categorias();

  echo $obj->eliminaCategoria($id);
?>