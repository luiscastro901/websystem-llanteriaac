<?php 

	class empleados{

		public function agregaEmpleado($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$idusuario=$_SESSION['iduser'];

			$sql="INSERT INTO empleados (id_usuario,
										nombre,
										apellido,
										dni,
                    ocupacion,
										email,
										telefono,
                    fechaContrato)
							VALUES ('$idusuario',
									'$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]',
                  '$datos[5]',
                  NOW())";
			return mysqli_query($conexion, $sql);	
		}

    public function obtenDatosEmpleado($idempleado){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_empleado, nombre, apellido, dni, ocupacion, email, telefono, fechaContrato FROM empleados WHERE id_empleado = '$idempleado'";
      $result=mysqli_query($conexion, $sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_empleado' => $ver[0], 
          'nombre' => $ver[1],
					'apellido' => $ver[2],
					'dni' => $ver[3],
          'ocupacion' => $ver[4],
					'email' => $ver[5],
					'telefono' => $ver[6],
          'fechaContrato' => $ver[7]
						);
			return $datos;
		}

		public function actualizaEmpleado($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE empleados SET nombre='$datos[1]',
										apellido='$datos[2]',
										dni='$datos[3]',
                    ocupacion='$datos[4]',
										email='$datos[5]',
										telefono='$datos[6]'
              WHERE id_empleado='$datos[0]'";
			return mysqli_query($conexion, $sql);
		}

		public function eliminaEmpleado($idempleado){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE FROM empleados WHERE id_empleado='$idempleado'";

			return mysqli_query($conexion, $sql);
		}
	}

?>