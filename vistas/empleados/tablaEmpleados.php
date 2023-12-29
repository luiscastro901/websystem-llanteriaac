<?php
  require_once "../../classes/Conexion.php";
  $obj=new conectar();
  $conexion=$obj->conexion();

  $sql="SELECT id_empleado, nombre, apellido, dni, ocupacion, email, telefono, fechaContrato FROM empleados";
  $result=mysqli_query($conexion, $sql);
?>

<div class="table-responsive">
  <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
    <caption><label for="">Empleados</label></caption>
    <tr>
      <td>Nombre</td>
      <td>Apellido</td>
      <td>DNI</td>
      <td>Ocupacion</td>
      <td>Email</td>
      <td>Telefono</td>
      <td>Fecha de Contrato</td>
      <td>Editar</td>
      <td>Eliminar</td>
    </tr>

    <?php while ($ver=mysqli_fetch_row($result)): ?>

    <tr>
      <td><?php echo $ver[1]; ?></td>
      <td><?php echo $ver[2]; ?></td>
      <td><?php echo $ver[3]; ?></td>
      <td><?php echo $ver[4]; ?></td>
      <td><?php echo $ver[5]; ?></td>
      <td><?php echo $ver[6]; ?></td>
      <td><?php echo $ver[7]; ?></td>
      <td>
        <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abreModalEmpleadosUpdate" onclick="agregaDatosEmpleado('<?php echo $ver[0]; ?>')">
          <span class="glyphicon glyphicon-pencil"></span>
        </span>
      </td>
      <td>
        <span class="btn btn-danger btn-xs" onclick="eliminarEmpleado('<?php echo $ver[0]; ?>')">
          <span class="glyphicon glyphicon-remove"></span>
        </span>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>