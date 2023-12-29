<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Usuarios.php";

  $obj=new usuarios();

  echo $obj->eliminaUsuario($_POST['idusuario']);
?>