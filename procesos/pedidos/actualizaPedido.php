<?php
  session_start();
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Pedidos.php";

  $obj = new pedidos();
$idpedido = $_POST['idpedidoU'];

// Obtén otros datos del formulario si es necesario
$dniCliente = $_POST['dniU'];
// ... otras asignaciones

// Llama a tu función de actualización del pedido
$resultado = $obj->actualizaPedido($idpedido, $dniCliente, /* otras variables */);

if ($resultado) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No se pudo actualizar el pedido']);
}
?>