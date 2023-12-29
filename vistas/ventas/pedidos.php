<?php
  session_start();
  if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedidos</title>
  <?php require_once "menu.php"; ?>
</head>
<body>
  <div class="container">
    <h1>Pedidos</h1>
    <div class="row">
      <div class="col-sm-4">
        <form id="frmPedidos" enctype="multipart/form-data">
          <label for="">DNI</label>
          <input type="text" class="form-control input-sm" id="dni" name="dni">
          <br>
          <span id="btnAgregarPedido" class="btn btn-primary">Agregar</span>
        </form>
      </div>
      <div class="col-sm-8">
        <div id="tablaPedidosLoad"></div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="abreModalPedidosUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualiza Pedido</h4>
      </div>
      <div class="modal-body">
        <form id="frmPedidosU">
  <input type="text" hidden="" name="idpedidoU" id="idpedidoU">
  <label for="">DNI</label>
  <input type="text" class="form-control input-sm" id="dniU" name="dniU" onchange="obtenerDatosCliente()">
</form>


      </div>
      <div class="modal-footer">
        <button id="btnAgregarPedidoU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
      function obtenerFechaActual() {
        var fecha = new Date();
        var dia = fecha.getDate();
        var mes = fecha.getMonth() + 1; // ¡Ojo! Los meses comienzan desde 0
        var año = fecha.getFullYear();

        // Formatea la fecha como necesites (por ejemplo, DD/MM/YYYY)
        var fechaFormateada = dia + '/' + mes + '/' + año;

        return fechaFormateada;
      }

      // Tu script JavaScript actual aquí...
      $(document).ready(function() {
        // ... (código JavaScript existente)
      });
    </script>

<script type="text/javascript">
  function agregaDatosPedido(idpedido) {
    $.ajax({
        type: "POST",
        data: "idpedido=" + idpedido,
        url: "../procesos/pedidos/obtenDatosPedido.php",
        success: function(r) {
            try {
                var dato = JSON.parse(r);

                // Verifica si la respuesta es un JSON válido y tiene datos
                if (Array.isArray(dato) && dato.length > 0) {
                    // Actualiza los campos en el formulario con los datos del cliente
                    $('#idpedidoU').val(dato[0].id_pedido);
                    $('#dniU').val(dato[0].dniCliente);
                    // Resto de las asignaciones
                } else {
                    console.log('No se encontraron datos del pedido o la respuesta no es válida.');
                    alertify.error('No se encontraron datos del pedido o la respuesta no es válida.');
                }
            } catch (error) {
                console.error('Error al parsear JSON:', error);
                console.log('Respuesta del servidor:', r);
                alertify.error('Error al obtener datos del pedido. Verifica la consola para más detalles.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', error);
            console.log('Detalles completos del error:', xhr);
            alertify.error('Error al obtener datos del pedido. Verifica la consola para más detalles.');
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
					$('#tablaPedidosLoad').load('pedidos/tablaPedidos.php');
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
    $('#tablaPedidosLoad').load("pedidos/tablaPedidos.php");

    $('#btnAgregarPedido').click(function() {
  var dniCliente = $('#dni').val();
  console.log('DNI del cliente a buscar:', dniCliente);

  $.ajax({
    url: 'http://localhost:3000/clientes/',
    type: 'GET',
    success: function(data) {
      console.log('Datos de todos los clientes:', data); // Agrega este log

      if (Array.isArray(data) && data.length > 0) {
        // Encuentra el cliente con el DNI específico
        var cliente = data.find(function(c) {
          return c.dni == dniCliente;
        });

        console.log('Cliente encontrado:', cliente); // Agrega este log

        if (cliente) {
          // Resto del código...
        } else {
          console.error('Cliente no encontrado con DNI:', dniCliente);
          alertify.error('Fallo al agregar pedido. DNI no encontrado.');
        }
      } else {
        console.error('Datos inválidos de la API:', data);
        alertify.error('Fallo al obtener datos de la API. Verifica la consola para más detalles.');
      }
    },
    error: function(xhr, status, error) {
      console.error('Error al obtener datos de todos los clientes:', error);
      console.log('Detalles completos del error:', xhr);
      alertify.error('Error al obtener datos de todos los clientes. Verifica la consola para más detalles.');
    }
  });
});

  });
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#btnAgregarPedidoU').click(function () {
        datos = $('#frmPedidosU').serialize();
        $.ajax({
            type: "POST",
            data: datos,
            url: "../procesos/pedidos/actualizaPedido.php",
            dataType: 'json', // Indica que esperas una respuesta JSON
            success: function (response) {
                if (response.success) {
                    $('#frmPedidos')[0].reset();
                    $('#tablaPedidosLoad').load("pedidos/tablaPedidos.php");
                    alertify.success("Pedido actualizado con éxito");
                } else {
                    alertify.error(response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                console.log('Detalles completos del error:', xhr);
                alertify.error('Error al actualizar el pedido. Verifica la consola para más detalles.');
            }
        });
    });
});

</script>

<script type="text/javascript">
  function obtenerDatosCliente() {
  var dniCliente = $('#dniU').val();

  $.ajax({
    url: 'http://localhost:3000/clientes/',
    type: 'GET',
    success: function(data) {
      if (Array.isArray(data) && data.length > 0) {
        var cliente = data.find(function(c) {
          return c.dni == dniCliente;
        });

        if (cliente) {
          // Rellena automáticamente los demás campos con los datos del cliente
          $('#nombreU').val(cliente.nombre);
          $('#apellidoU').val(cliente.apellido);
          $('#emailU').val(cliente.email);
          $('#telefonoU').val(cliente.telefono);
          $('#direccionU').val(cliente.direccion);
          $('#estadocivilU').val(cliente.estadoCivil);
          $('#fotoU').val(cliente.foto);
        } else {
          console.error('Cliente no encontrado con DNI:', dniCliente);
        }
      } else {
        console.error('Datos inválidos de la API:', data);
      }
    },
    error: function(xhr, status, error) {
      console.error('Error al obtener datos de todos los clientes:', error);
    }
  });
}

</script>


<?php
  }else{
    header("location:../index.php");
  }
?>