<?php
  require_once "../../classes/Conexion.php";
  $obj=new conectar();
  $conexion=$obj->conexion();

  /* $sql="SELECT id_pedido, fecha, nombreCliente, apellidoCliente, dniCliente, emailCliente, telefonoCliente FROM pedidos"; */
  $sql="SELECT id_pedido, fecha, nombreCliente, apellidoCliente, dniCliente FROM pedidos";
  $result=mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
  <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <caption><label for="">Pedidos</label></caption>
    <tr>
      <td>Fecha</td>
      <td>Nombre</td>
      <td>Apellido</td>
      <td>DNI</td>
      <!-- <td>Email</td>
      <td>Telefono</td> -->
      <td>Editar</td>
      <td>Eliminar</td>
    </tr>

    <?php while ($ver=mysqli_fetch_row($result)): ?>

    <tr>
      <td><?php echo $ver[1]; ?></td>
      <td><?php echo $ver[2]; ?></td>
      <td><?php echo $ver[3]; ?></td>
      <td><?php echo $ver[4]; ?></td>
      <td>
        <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abreModalPedidosUpdate" onclick="agregaDatosPedido('<?php echo $ver[0]; ?>')">
          <span class="glyphicon glyphicon-pencil"></span>
        </span>
      </td>
      <td>
        <span class="btn btn-danger btn-xs" onclick="eliminarPedido(<?php echo $ver[0]; ?>)">
          <span class="glyphicon glyphicon-remove"></span>
        </span>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>