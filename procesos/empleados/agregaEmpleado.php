<?php
  session_start();
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Empleados.php";

	$obj= new empleados();

	$datos=array(
			$_POST['nombre'],
			$_POST['apellido'],
			$_POST['dni'],
      $_POST['ocupacionSelect'],
			$_POST['email'],
			$_POST['telefono'],
				);

	echo $obj->agregaEmpleado($datos);
?>