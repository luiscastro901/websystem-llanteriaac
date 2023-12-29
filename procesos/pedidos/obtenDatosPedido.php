<?php 
	require_once "../../classes/Conexion.php";
	require_once "../../classes/Pedidos.php";

$obj = new pedidos();
$pedidoId = $_POST['idpedido'];
$pedidoData = $obj->obtenDatosPedido($pedidoId);

// Verifica si se obtuvieron datos del pedido
if ($pedidoData) {
    // Obtén el DNI del pedido
    $dniCliente = $pedidoData['dniCliente'];

    // Consulta la API para obtener los datos del cliente por DNI
    $apiUrl = 'http://localhost:3000/clientes/';
    $apiData = file_get_contents($apiUrl);

    // Decodifica el JSON y devuelve los datos del cliente en formato JSON
    echo $apiData ? $apiData : json_encode([]);
} else {
    // Si no se obtuvieron datos del pedido, devuelve un JSON vacío
    echo json_encode([]);
}
?>