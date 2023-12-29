<?php
  session_start();
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Pedidos.php";

  $datos = array(
    "fecha" => $_POST['fecha'],
    "nombre" => $_POST['nombre'],
    "apellido" => $_POST['apellido'],
    "dni" => $_POST['dni']
);

// Obtén los detalles del cliente desde la API
$url = 'http://localhost:3000/clientes/';
$clientesData = @file_get_contents($url);

if ($clientesData !== false) {
    $clientes = json_decode($clientesData, true);

    // Verifica si la respuesta contiene el índice "clientes"
    if (isset($clientes)) {
        // Busca el cliente por DNI en los datos de la API
        $clienteEncontrado = array_filter($clientes, function ($cliente) use ($datos) {
            return $cliente['dni'] == $datos['dni'];
        });

        // Verifica si se encontró el cliente
        if (!empty($clienteEncontrado)) {
            // Obtiene el primer cliente encontrado (asumimos que el DNI es único)
            $cliente = current($clienteEncontrado);

            // Agrega los detalles del cliente a los datos del pedido
            $datos['email'] = $cliente['email'];
            $datos['telefono'] = $cliente['telefono'];
            $datos['direccion'] = $cliente['direccion'];
            $datos['estadoCivil'] = $cliente['estadoCivil'];
            $datos['foto'] = $cliente['foto'];

            // Crea una instancia de la clase pedidos
            $obj = new pedidos();

            // Agrega el pedido con los detalles del cliente a la base de datos
            $respuesta = $obj->agregaPedido($datos);

            // Verifica si la respuesta del servidor indica éxito o error
            if ($respuesta === "Pedido agregado con éxito") {
                // Devuelve la respuesta del servidor
                echo $respuesta;
            } else {
                // Muestra un mensaje de error si hay un problema al agregar el pedido
                echo "Error: $respuesta";
            }
        } else {
            // Muestra un mensaje de error si no se encuentra el cliente
            echo "Error: Cliente no encontrado";
        }
    } else {
        // Muestra un mensaje de error si el índice "clientes" no está presente en la respuesta
        echo "Error: Datos inválidos de la API - índice 'clientes' no encontrado";
    }
} else {
    // Muestra un mensaje de error si no se pudo obtener la respuesta de la API
    echo "Error: Fallo al obtener datos de la API";
}

?>