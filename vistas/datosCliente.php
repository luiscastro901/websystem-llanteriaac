<?php
  session_start();
  if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultar Datos Cliente</title>
  <?php require_once "menu.php"; ?>
</head>
<body>
  <div class="container">
    <h1>Consultar Datos Cliente</h1>
    <input type="search" class="form-control input-sm" id="inputDNI" placeholder="Buscar por DNI">
<div id="tablaPedidosClienteFiltrada"></div>

    <div class="row">
      <div class="col-sm-12">
        <div id="tablaPedidosClienteLoad"></div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="abreModalPedidosClienteUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualiza Pedido</h4>
      </div>
      <div class="modal-body">
        <form id="frmPedidosClienteU">
          <label for="">DNI</label>
          <input type="text" class="form-control input-sm" id="dniU" name="dniU">
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
  function agregaDatosPedido(idpedido){

    $.ajax({
			type:"POST",
			data:"idpedido=" + idpedido,
			url:"../procesos/pedidos/obtenDatosPedido.php",
			success:function(r){
        dato=jQuery.parseJSON(r);
        $('#idpedidoU').val(dato['id_pedido']);
        $('#nombreU').val(dato['nombreCliente']);
        $('#apellidoU').val(dato['apellidoCliente']);
        $('#dniU').val(dato['dniCliente']);
        $('#emailU').val(dato['emailCliente']);
        $('#telefonoU').val(dato['telefonoCliente']);
			}
		});
  }

  function eliminarPedido(idpedido) {
    alertify.confirm('¿Desea eliminar este pedido?', function(){
      $.ajax({
      type:"POST",
			data:"idpedido=" + idpedido,
			url:"../procesos/pedidos/eliminarPedido.php",
			success:function(r){
				if(r==1){
					$('#tablaPedidosLoad').load('pedidos/tablaPedidosCliente.php');
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
    $('#tablaPedidosClienteLoad').load("pedidos/tablaPedidosCliente.php");

    $('#btnAgregarPedido').click(function(){
      vacios=validarFormVacio('frmPedidosCliente');
      if(vacios > 0){
        alertify.alert("Debes llenar todos los campos de texto!!");
        return false;
      }

      datos=$('#frmPedidosCliente').serialize();
      $.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/pedidos/agregaPedido.php",
			success:function(r){
        
        if(r==1) {
          $('#frmPedidosCliente')[0].reset();
          $('#tablaPedidosClienteLoad').load("pedidos/tablaPedidosCliente.php");
          alertify.success("Agregado con éxito");
        }else{
          alertify.error("No se pudo agregar pedido");
        }
			}
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnAgregarPedidoU').click(function(){
      datos=$('#frmPedidosClienteU').serialize();
      $.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/pedidos/actualizaPedido.php",
			success:function(r){
        
        if(r==1) {
          $('#frmPedidosCliente')[0].reset();
          $('#tablaPedidosClienteLoad').load("pedidos/tablaPedidosCliente.php");
          alertify.success("Pedido actualizado con éxito");
        }else{
          alertify.error("No se pudo actualizar pedido");
        }
			}
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tablaPedidosClienteLoad').load("pedidos/tablaPedidosCliente.php");

    $('#inputDNI').on('input', function() {
      var dni = $(this).val().toLowerCase();
      $('#tablaPedidosClienteLoad tr').each(function() {
        var rowDNI = $(this).find('td:eq(3)').text().toLowerCase(); // Considera la columna del DNI (cambiar si es necesario)
        if (rowDNI.includes(dni)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

    // Resto de tu código...
  });
</script>


<script type="text/javascript">
  $(document).ready(function() {
    // ...

    $('#inputDNI').on('input', function() {
      var dni = $(this).val();
      if (dni !== "") {
        $.ajax({
          type: "POST",
          data: { dni: dni },
          url: "../procesos/pedidos/filtrarPedidosPorDNI.php",
          success: function(result) {
            $('#tablaPedidosClienteFiltrada').html(result);
          }
        });
      } else {
        $('#tablaPedidosClienteFiltrada').html("");
      }
    });
  });
</script>


<?php
  }else{
    header("location:../index.php");
  }
?>