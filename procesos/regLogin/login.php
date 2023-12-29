<?php
session_start();
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Usuarios.php";

  $obj=new usuarios();

  $datos=array(
    $_POST['usuario'],
    $_POST['password']
  );
  
  echo $obj->loginUser($datos);
?>