<?php 
	session_start();
	require_once "../../classes/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idcliente=$_POST['clienteVenta'];
	$idproducto=$_POST['productoVenta'];
	$descripcion=$_POST['descripcionV'];
	$cantidad=$_POST['cantidadV'];
	$precio=$_POST['precioV'];

	$sql="SELECT nombreCliente, apellidoCliente 
    FROM pedidos 
    WHERE id_pedido='$idcliente'";
	$result=mysqli_query($conexion, $sql);

	$c=mysqli_fetch_row($result);

	$ncliente=$c[1]." ".$c[0];

	$sql="SELECT nombre 
    FROM productos 
    WHERE id_producto='$idproducto'";
	$result=mysqli_query($conexion, $sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$producto=$idproducto."||".
				$nombreproducto."||".
				$descripcion."||".
				$precio."||".
				$ncliente."||".
				$idcliente;

	$_SESSION['tablaComprasTemp'][]=$producto;
?>