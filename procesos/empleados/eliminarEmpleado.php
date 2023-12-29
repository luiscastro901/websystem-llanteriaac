<?php
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Empleados.php";

	$obj= new empleados();

	echo $obj->eliminaEmpleado($_POST['idempleado']);
?>