<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Pedidos.php";

	$obj= new pedidos();

	echo $obj->eliminaPedido($_POST['idpedido']);
?>