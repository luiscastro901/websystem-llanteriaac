<?php
  session_start();
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Empleados.php";

	$obj= new empleados();

	$datos=array(
      $_POST['idempleadoU'],
			$_POST['nombreU'],
			$_POST['apellidoU'],
			$_POST['dniU'],
      $_POST['ocupacionSelectU'],
			$_POST['emailU'],
			$_POST['telefonoU'],
				);

	echo $obj->actualizaEmpleado($datos);
?>