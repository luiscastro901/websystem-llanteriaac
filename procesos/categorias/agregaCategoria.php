<?php
  session_start();
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Categorias.php";
  $fecha=date("Y-m-d");

  $idusuario=$_SESSION['iduser'];
  $categoria=$_POST['categoria'];

  $datos=array(
    $idusuario,
    $categoria,
    $fecha
  );

  $obj=new categorias();

  echo $obj->agregaCategoria($datos);
  
?>