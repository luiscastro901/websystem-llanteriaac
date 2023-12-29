<?php
  // Importa la clase de conexión si no lo has hecho antes
  require_once "../../classes/Conexion.php";

  // Obtiene el DNI enviado por AJAX
  $dni = $_POST['dni'];

  // Crea una instancia de la conexión a la base de datos
  $obj = new conectar();
  $conexion = $obj->conexion();

  // Realiza la consulta filtrando por DNI usando una consulta preparada
  $sql = "SELECT id_pedido, fecha, nombreCliente, apellidoCliente, dniCliente, emailCliente, telefonoCliente, direccionCliente, estadocivil, foto FROM pedidos WHERE dniCliente LIKE ?";
  
  $stmt = mysqli_prepare($conexion, $sql);
  $dniParam = "%$dni%";
  mysqli_stmt_bind_param($stmt, "s", $dniParam);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  // Construye la tabla con los resultados filtrados
  echo '<table class="table table-hover table-condensed table-bordered" style="text-align: center;">';
  echo '<tr><td>Fecha</td><td>Nombre</td><td>Apellido</td><td>DNI</td><td>Email</td><td>Telefono</td><td>Direccion</td><td>Estado Civil</td><td>Foto</td><td>Editar</td><td>Eliminar</td></tr>';
  
  while ($ver = mysqli_fetch_row($result)) {
    echo '<tr>';
    echo '<td>'.$ver[1].'</td>';
    echo '<td>'.$ver[2].'</td>';
    echo '<td>'.$ver[3].'</td>';
    echo '<td>'.$ver[4].'</td>';
    echo '<td>'.$ver[5].'</td>';
    echo '<td>'.$ver[6].'</td>';
    echo '<td>'.$ver[7].'</td>';
    echo '<td>'.$ver[8].'</td>';
    echo '<td><img src="'.$ver[9].'" alt="Foto" style="max-width: 70px; max-height: 70px;"></td>';
    echo '<td><span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abreModalPedidosClienteUpdate" onclick="agregaDatosPedido(\''.$ver[0].'\')"><span class="glyphicon glyphicon-pencil"></span></span></td>';
    echo '<td><span class="btn btn-danger btn-xs" onclick="eliminarPedido('.$ver[0].')"><span class="glyphicon glyphicon-remove"></span></span></td>';
    echo '</tr>';
  }

  echo '</table>';
?>

