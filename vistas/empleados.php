<?php
  session_start();
  if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Empleados</title>
  <?php require_once "menu.php"; ?>
</head>
<body>
  <div class="container">
    <h1>Empleados</h1>
    <div class="row">
      <div class="col-sm-4">
        <form id="frmEmpleados" enctype="multipart/form-data">
          <label for="">Nombre</label>
          <input type="text" class="form-control input-sm" id="nombre" name="nombre">
          <label for="">Apellido</label>
          <input type="text" class="form-control input-sm" id="apellido" name="apellido">
          <label for="">DNI</label>
          <input type="text" class="form-control input-sm" id="dni" name="dni">
          <label for="">Ocupación</label>
          <select class="form-control input-sm" name="ocupacionSelect" id="ocupacionSelect">
            <option value="A">Selecciona Ocupación</option>
            <option value="Administrador">Administrador</option>
            <option value="Mecanico">Mecánico</option>
            <option value="Gerente">Gerente</option>
            <option value="Vendedor">Vendedor</option>
            <option value="Recepcionista">Recepcionista</option>
          </select>
          <label for="">Email</label>
          <input type="text" class="form-control input-sm" id="email" name="email">
          <label for="">Teléfono</label>
          <input type="text" class="form-control input-sm" id="telefono" name="telefono">
          <br>
          <span id="btnAgregarEmpleado" class="btn btn-primary">Agregar</span>
        </form>
      </div>
      <div class="col-sm-8">
        <div id="tablaEmpleadosLoad"></div>
      </div>
    </div>
  </div>

    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="abreModalEmpleadosUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualiza Empleado</h4>
      </div>
      <div class="modal-body">
        <form id="frmEmpleadosU">
          <input type="text" hidden="" name="idempleadoU" id="idempleadoU">
          <label for="">Nombre</label>
          <input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
          <label for="">Apellido</label>
          <input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
          <label for="">DNI</label>
          <input type="text" class="form-control input-sm" id="dniU" name="dniU">
          <label for="">Ocupación</label>
          <select class="form-control input-sm" name="ocupacionSelectU" id="ocupacionSelectU">
            <option value="A">Selecciona Ocupación</option>
            <option value="Administrador">Administrador</option>
            <option value="Mecanico">Mecánico</option>
            <option value="Gerente">Gerente</option>
            <option value="Vendedor">Vendedor</option>
            <option value="Recepcionista">Recepcionista</option>
          </select>
          <label for="">Email</label>
          <input type="text" class="form-control input-sm" id="emailU" name="emailU">
          <label for="">Teléfono</label>
          <input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnAgregarEmpleadoU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
  function agregaDatosEmpleado(idempleado){

    $.ajax({
			type:"POST",
			data:"idempleado=" + idempleado,
			url:"../procesos/empleados/obtenDatosEmpleado.php",
			success:function(r){
        dato=jQuery.parseJSON(r);
        $('#idempleadoU').val(dato['id_empleado']);
        $('#nombreU').val(dato['nombre']);
        $('#apellidoU').val(dato['apellido']);
        $('#dniU').val(dato['dni']);
        $('#ocupacionSelectU').val(dato['ocupacion']);
        $('#emailU').val(dato['email']);
        $('#telefonoU').val(dato['telefono']);
			}
		});
  }

  function eliminarEmpleado(idempleado) {
    alertify.confirm('¿Desea eliminar este empleado?', function(){
      $.ajax({
      type:"POST",
			data:"idempleado=" + idempleado,
			url:"../procesos/empleados/eliminarEmpleado.php",
			success:function(r){
				if(r==1){
					$('#tablaEmpleadosLoad').load('empleados/tablaEmpleados.php');
					alertify.success("Eliminado con éxito!");
				}else{
					alertify.error("No se pudo eliminar");
				}
			}
      });
		}, function(){
        alertify.error('Operación Cancelada');
    });
  }

</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tablaEmpleadosLoad').load("empleados/tablaEmpleados.php");

    $('#btnAgregarEmpleado').click(function(){

      vacios=validarFormVacio('frmEmpleados');
      if(vacios > 0){
        alertify.alert("Debes llenar todos los campos de texto!!");
        return false;
      }

      datos=$('#frmEmpleados').serialize();
      $.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/empleados/agregaEmpleado.php",
			success:function(r){
        if(r==1) {
          $('#frmEmpleados')[0].reset();
          $('#tablaEmpleadosLoad').load("empleados/tablaEmpleados.php");
          alertify.success("Agregado con éxito");
        }else{
          alertify.error("No se puedo agregar empleado");
        }
			}
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnAgregarEmpleadoU').click(function(){
      datos=$('#frmEmpleadosU').serialize();
      $.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/empleados/actualizaEmpleado.php",
			success:function(r){
        
        if(r==1) {
          $('#frmEmpleados')[0].reset();
          $('#tablaEmpleadosLoad').load("empleados/tablaEmpleados.php");
          alertify.success("Empleado actualizado con éxito");
        }else{
          alertify.error("No se pudo actualizar empleado");
        }
			}
      });
    });
  });
</script>

<?php
  }else{
    header("location:../index.php");
  }
?>