<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Usuarios.php";

  $obj=new usuarios;

  echo json_encode($obj->obtenDatosUsuario($_POST['idusuario']));
?>