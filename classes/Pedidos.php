<?php 
  date_default_timezone_set('America/Lima');
	class pedidos{

    public function agregaPedido($datos)
{
    $c = new conectar();
    $conexion = $c->conexion();

    $idusuario = $_SESSION['iduser'];
    $nombre = $datos['nombre'];
    $apellido = $datos['apellido'];
    $dniCliente = $datos['dni'];
    $emailCliente = $datos['email'];
    $telefonoCliente = $datos['telefono'];
    $direccionCliente = $datos['direccion'];
    $estadoCivil = $datos['estadoCivil'];
    $foto = $datos['foto'];

    $sql = "INSERT INTO pedidos (id_usuario, fecha, nombreCliente, apellidoCliente, dniCliente, emailCliente, telefonoCliente, direccionCliente, estadocivil, foto)
          VALUES ('$idusuario', NOW(), '$nombre', '$apellido', '$dniCliente', '$emailCliente', '$telefonoCliente', '$direccionCliente', '$estadoCivil', '$foto')";

    return mysqli_query($conexion, $sql);
}


    public function obtenDatosPedido($idpedido){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_pedido, fecha, nombreCliente, apellidoCliente, dniCliente, emailCliente, telefonoCliente FROM pedidos WHERE id_pedido = '$idpedido'";
      $result=mysqli_query($conexion, $sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_pedido' => $ver[0], 
          'fecha' => $ver[1],
					'nombreCliente' => $ver[2],
					'apellidoCliente' => $ver[3],
					'dniCliente' => $ver[4],
					'emailCliente' => $ver[5],
					'telefonoCliente' => $ver[6]
						);
			return $datos;
		}

    public function actualizaPedido($datos){
    $c= new conectar();
    $conexion=$c->conexion();

    $sql="UPDATE pedidos 
          SET 
            nombreCliente='$datos[1]',
            apellidoCliente='$datos[2]',
            dniCliente='$datos[3]',
            emailCliente='$datos[4]',
            telefonoCliente='$datos[5]',
            direccionCliente='$datos[6]',
            estadocivil='$datos[7]',
            foto='$datos[8]'
          WHERE id_pedido='$datos[0]'";
          
    return mysqli_query($conexion, $sql);
}


		public function eliminaPedido($idpedido){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE FROM pedidos WHERE id_pedido='$idpedido'";

			return mysqli_query($conexion, $sql);
		}

    function obtenerFechaActual() {
  $fecha = new DateTime();
  $dia = $fecha->format('d');
  $mes = $fecha->format('m');
  $año = $fecha->format('Y');

  // Formatea la fecha como necesites (por ejemplo, DD/MM/YYYY)
  $fechaFormateada = $dia . '/' . $mes . '/' . $año;

  return $fechaFormateada;
}


	}

?>