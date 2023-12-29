<?php
  session_start();
  if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <?php require_once "menu.php"; ?>
</head>
<body>
  <div class="container">
    <h1>Gestionar Usuarios</h1>
    <div class="row">
      <div class="col-sm-4">
        <form id="frmRegistro">
          <label for="">Nombre</label>
          <input type="text" class="form-control input-sm" name="nombre" id="nombre">
          <label for="">Apellido</label>
          <input type="text" class="form-control input-sm" name="apellido" id="apellido">
          <label for="">Usuario</label>
          <input type="text" class="form-control input-sm" name="usuario" id="usuario" readonly="">
          <label for="">Password</label>
          <input type="password" class="form-control input-sm" name="password" id="password">
          <br>
          <span class="btn btn-primary" id="registro">Registrar</span>
        </form>
      </div>
      <div class="col-sm-7">
        <div id="tablaUsuariosLoad"></div>
      </div>
    </div>
  </div>

  <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualiza Usuario</h4>
      </div>
      <div class="modal-body">
        <form id="frmRegistroU">
          <input type="text" hidden="" id="idUsuario" name="idUsuario">
          <label for="">Nombre</label>
          <input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
          <label for="">Apellido</label>
          <input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
          <label for="">Usuario</label>
          <input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU" readonly="">
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualiza Usuario</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
  function agregaDatosUsuario(idusuario){

    $.ajax({
			type:"POST",
			data:"idusuario=" + idusuario,
			url:"../procesos/usuarios/obtenDatosUsuario.php",
			success:function(r){
        dato=jQuery.parseJSON(r);

        $('#idUsuario').val(dato['id_usuario']);
        $('#nombreU').val(dato['nombre']);
        $('#apellidoU').val(dato['apellido']);
        $('#usuarioU').val(dato['username']);
			}
		});
  }

  function eliminarUsuario(idusuario) {
    alertify.confirm('¿Desea eliminar este usuario?', function(){
      $.ajax({
      type:"POST",
			data:"idusuario=" + idusuario,
			url:"../procesos/usuarios/eliminarUsuario.php",
			success:function(r){
				if(r==1){
					$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
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
  $(document).ready(function(){
    $('#btnActualizaUsuario').click(function(){

		datos=$('#frmRegistroU').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"../procesos/usuarios/actualizaUsuario.php",
			success:function(r){

        if(r==1){
          $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
          alertify.success("Actualizado con éxito");
        }else{
          alertify.error("No se pudo actualizar");
        }
			}
		});
	});
  });
  
</script>

<script type="text/javascript">
  $(document).ready(function(){
    
    $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
    
    $('#registro').click(function(){

      vacios=validarFormVacio('frmRegistro');
      
      if(vacios > 0) {
        alertify.alert("Debes llenar todos los campos!!");
        return false;
      }

      datos=$('#frmRegistro').serialize();
      $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/regLogin/registrarUsuario.php",
        success:function(r){
          //alert(r);
          if(r==1) {
            $('#frmRegistro')[0].reset();
            $('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
            alertify.success("Agregado con éxito");
          }else {
            alertify.error("Fallo al agregar");
          }
        }
      });
    });
  });
</script>

<!-- *** -->
<script>
  $(document).ready(function(){
    // Función para generar el nombre de usuario
    function generarUsuario() {
      // Obtener valores de Nombre y Apellido
      var nombre = $('#nombre').val().trim();
      var apellido = $('#apellido').val().trim();

      // Verificar que ambos campos tengan datos
      if(nombre !== '' && apellido !== '') {
        // Generar nombre de usuario
        var usuario = apellido.toLowerCase() + nombre.substring(0, 2).toLowerCase() + Math.floor(Math.random() * 100);

        // Asignar el usuario al campo correspondiente
        $('#usuario').val(usuario);
      }
    }

    // Llamar a la función al cambiar los valores de Nombre o Apellido
    $('#nombre, #apellido').on('input', generarUsuario);

    // También puedes llamar a la función al cargar la página para manejar casos de autocompletar
    generarUsuario();
  });
</script>


<?php
  }else{
    header("location:../index.php");
  }
?>