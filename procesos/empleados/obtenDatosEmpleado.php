<?php 
	require_once "../../classes/Conexion.php";
	require_once "../../classes/Empleados.php";

	$obj= new empleados();

	echo json_encode($obj->obtenDatosEmpleado($_POST['idempleado']));
?>