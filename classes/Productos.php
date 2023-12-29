<?php
  class productos{
    public function agregaImagen($datos){
      $c=new conectar();
      $conexion=$c->conexion();

      $fecha=date("Y-m-d");

      $sql="INSERT INTO imagenes (id_categoria, nombre, ubicacion, fechaSubida) VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$fecha')";

      $result=mysqli_query($conexion, $sql);

      return mysqli_insert_id($conexion);
    }

    public function agregaProducto($datos){
      $c=new conectar();
      $conexion=$c->conexion();

      $fecha=date('Y-m-d');

      $sql="INSERT INTO productos (id_categoria, id_imagen, id_usuario, nombre, descripcion, cantidad, precio, fechaCaptura) VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$fecha')";

      return mysqli_query($conexion, $sql);
    }

    public function obtenDatosProducto($idprod) {
      $c=new conectar();
      $conexion=$c->conexion();

      $sql="SELECT id_producto, id_categoria, nombre, descripcion, cantidad, precio FROM productos WHERE id_producto='$idprod'";
      $result=mysqli_query($conexion, $sql);

      $ver=mysqli_fetch_row($result);

      $datos=array(
        "id_producto" => $ver[0],
        "id_categoria" => $ver[1],
        "nombre" => $ver[2],
        "descripcion" => $ver[3],
        "cantidad" => $ver[4],
        "precio" => $ver[5],
      );

      return $datos;
    }

    public function actualizaProducto($datos){
      $c=new conectar();
      $conexion=$c->conexion();

      $sql="UPDATE productos SET id_categoria='$datos[1]', nombre='$datos[2]', descripcion='$datos[3]', cantidad='$datos[4]', precio='$datos[5]' WHERE id_producto='$datos[0]'";

      return mysqli_query($conexion, $sql);
    }

    public function eliminaProducto($idproducto){
      $c=new conectar();
      $conexion=$c->conexion();

      $idimagen=self::obtenIdImg($idproducto);

      $sql="DELETE FROM productos WHERE id_producto = '$idproducto'";

      $result=mysqli_query($conexion, $sql);

      if($result){
        $ruta=self::obtenRutaImagen($idimagen);

        $sql="DELETE FROM imagenes WHERE id_imagen = '$idimagen'";
        $result=mysqli_query($conexion, $sql);

        if($result){
          if(unlink($ruta)){
            return 1;
          }
        }
      }
    }

    public function obtenIdImg($idProducto){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_imagen 
					from productos 
					where id_producto='$idProducto'";
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenRutaImagen($idImg){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ubicacion 
					from imagenes 
					where id_imagen='$idImg'";

			$result=mysqli_query($conexion, $sql);

			return mysqli_fetch_row($result)[0];
		}
  }
?>