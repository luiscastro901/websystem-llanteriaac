<?php
  session_start();
  if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorias</title>
  <?php require_once "menu.php"; ?>
</head>
<body>
  <div class="container">
    <h1>Gestionar Categorias</h1>
    <div class="row">
      <div class="col-sm-4">
        <form id="frmCategorias">
          <label for="">Categoria</label>
          <input type="text" class="form-control input-sm" id="categoria" name="categoria">
          <br>
          <span id="btnAgregaCategoria" class="btn btn-primary">Agregar</span>
        </form>
      </div>
      <div class="col-sm-8">
        <div id="tablaCategoriasLoad"></div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualiza Categorias</h4>
      </div>
      <div class="modal-body">
        <form id="frmCategoriaU">
          <input type="text" hidden="" id="idCategoria" name="idCategoria">
          <label for="">Categoria</label>
          <input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");

    $('#btnAgregaCategoria').click(function(){

      vacios=validarFormVacio('frmCategorias');
      if(vacios > 0){
        alertify.alert("Debes llenar todos los campos de texto!!");
        return false;
      }

      datos=$('#frmCategorias').serialize();
				$.ajax({
					type: "post",
					data: datos,
          url: "../procesos/categorias/agregaCategoria.php",

					success:function(r){
						if(r == 1){
              /* esta linea nos permite limpiar el formulario al insertar un registro */
              $('#frmCategorias')[0].reset();
              $('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");
							alertify.success("Categoria agregada con éxito");
						}else{
							alertify.error("No se pudo agregar categoria");
						}
					}
				});
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#btnActualizaCategoria').click(function(){

		datos=$('#frmCategoriaU').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/categorias/actualizaCategoria.php",
			success:function(r){
        if(r==1){
          $('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");
          alertify.success("Actualizado con éxito");
        }else{
          alertify.error("No se pudo actualizar");
        }
			}
		});
	});
  });
</script>

<!-- actualizar -->
<script type="text/javascript">
  function agregaDato(idCategoria, categoria) {
    $('#idCategoria').val(idCategoria);
    $('#categoriaU').val(categoria);
  }

  function eliminaCategoria(idCategoria) {
    alertify.confirm('¿Desea eliminar esta categoría?', function(){
      $.ajax({
      type:"POST",
			data:"idCategoria=" + idCategoria,
			url:"../procesos/categorias/eliminarCategoria.php",
			success:function(r){
				if(r==1){
					$('#tablaCategoriasLoad').load("categorias/tablaCategorias.php");
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

<?php
  }else{
    header("location:../index.php");
  }
?>