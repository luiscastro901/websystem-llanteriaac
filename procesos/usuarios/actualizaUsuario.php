<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Usuarios.php";

  $obj=new usuarios();

  $datos=array($_POST['idUsuario'], $_POST['nombreU'], $_POST['apellidoU'], $_POST['usuarioU']);

  echo $obj->actualizaUsuario($datos);
?>