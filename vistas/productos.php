<?php
  session_start();
  if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos</title>
  <?php require_once "menu.php"; ?>
  <?php require_once "../classes/Conexion.php";
    $c=new conectar();
    $conexion=$c->conexion();
    $sql="SELECT id_categoria, nombreCategoria FROM categorias";
    $result=mysqli_query($conexion, $sql);
  ?>
</head>
<body>
  <div class="container">
    <h1>Productos</h1>
    <div class="row">
      <div class="col-sm-4">
        <form id="frmProductos" enctype="multipart/form-data">
          <label for="">Categoria</label>
          <select class="form-control input-sm" name="categoriaSelect" id="categoriaSelect">
            <option value="A">Selecciona Categoria</option>
            <?php while($ver=mysqli_fetch_row($result)): ?>
            <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
            <?php endwhile; ?>
          </select>
          <label for="">Nombre</label>
          <input type="text" class="form-control input-sm" id="nombre" name="nombre">
          <label for="">Descripción</label>
          <input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
          <label for="">Cantidad</label>
          <input type="text" class="form-control input-sm" id="cantidad" name="cantidad">
          <label for="">Precio</label>
          <input type="text" class="form-control input-sm" id="precio" name="precio">
          <label for="">Imagen</label>
          <input type="file" name="imagen" id="imagen">
          <br>
          <span id="btnAgregarProducto" class="btn btn-primary">Agregar</span>
        </form>
      </div>
      <div class="col-sm-8">
        <div id="tablaProductosLoad"></div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="abreModalUpdateProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualiza Producto</h4>
      </div>
      <div class="modal-body">
        <form id="frmProductosU" enctype="multipart/form-data">
          <input type="text" id="idProducto" name="idProducto" hidden="">
          <label for="">Categoria</label>
          <select class="form-control input-sm" name="categoriaSelectU" id="categoriaSelectU">
            <option value="A">Selecciona Categoria</option>
            <?php
              $sql="SELECT id_categoria, nombreCategoria FROM categorias";
              $result=mysqli_query($conexion, $sql);
            ?>
            <?php while($ver=mysqli_fetch_row($result)): ?>
            <option value="<?php echo $ver[0] ?>"><?php echo $ver[1] ?></option>
            <?php endwhile; ?>
          </select>
          <label for="">Nombre</label>
          <input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
          <label for="">Descripción</label>
          <input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
          <label for="">Cantidad</label>
          <input type="text" class="form-control input-sm" id="cantidadU" name="cantidadU">
          <label for="">Precio</label>
          <input type="text" class="form-control input-sm" id="precioU" name="precioU">
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnActualizaProducto" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
  function agregaDatosProducto(idarticulo) {
    $.ajax({
			type:"POST",
			data:"idprod=" + idarticulo,
			url:"../procesos/productos/obtenDatosProducto.php",
			success:function(r){
        dato=jQuery.parseJSON(r);
        $('#idProducto').val(dato['id_producto']);
        $('#categoriaSelectU').val(dato['id_categoria']);
        $('#nombreU').val(dato['nombre']);
        $('#descripcionU').val(dato['descripcion']);
        $('#cantidadU').val(dato['cantidad']);
        $('#precioU').val(dato['precio']);
			}
		});
  }

  function eliminaProducto(idProducto) {
    alertify.confirm('¿Desea eliminar este producto?', function(){
      $.ajax({
      type:"POST",
			data:"idproducto=" + idProducto,
			url:"../procesos/productos/eliminarProducto.php",
			success:function(r){
				if(r==1){
					$('#tablaProductosLoad').load("productos/tablaProductos.php");
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
    $('#btnActualizaProducto').click(function(){

		datos=$('#frmProductosU').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/productos/actualizaProductos.php",
			success:function(r){
        if(r==1){
          $('#tablaProductosLoad').load("productos/tablaProductos.php");
          alertify.success("Actualizado con éxito");
        }else{
          alertify.error("Error al actualizar");
        }
			}
		});
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tablaProductosLoad').load("productos/tablaProductos.php");

    $('#btnAgregarProducto').click(function(){

      vacios=validarFormVacio('frmProductos');
      
      if(vacios > 0){
        alertify.alert("Debes llenar todos los campos de texto!!");
        return false;
      }

      var formData = new FormData(document.getElementById("frmProductos"));

				$.ajax({
					url: "../procesos/productos/agregaProductos.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success:function(r){
						/* alert(r); */

						if(r == 1){
							$('#frmProductos')[0].reset();
							$('#tablaProductosLoad').load("productos/tablaProductos.php");
							alertify.success("Agregado con éxito");
						}else{
							alertify.error("Fallo al subir el archivo");
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