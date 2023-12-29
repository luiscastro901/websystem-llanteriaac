<?php 
	require_once "../../classes/Conexion.php";
	require_once "../../classes/Ventas.php";

	$obj= new ventas();

	echo json_encode($obj->obtenDatosProducto($_POST['idproducto']));
?>