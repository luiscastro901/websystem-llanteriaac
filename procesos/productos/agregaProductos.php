<?php
  session_start();
  $iduser=$_SESSION['iduser'];
  require_once "../../classes/Conexion.php";
  require_once "../../classes/Productos.php";

  $obj=new productos();

  $datos=array();

  $nombreImg=$_FILES['imagen']['name'];
  $rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
  $carpeta='../../files/';
  $rutaFinal=$carpeta.$nombreImg;

  $datosImg=array($_POST['categoriaSelect'], $nombreImg, $rutaFinal);
  
  if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
    $idImagen=$obj->agregaImagen($datosImg);

    if($idImagen > 0){

      $datos[0]=$_POST['categoriaSelect'];
      $datos[1]=$idImagen;
      $datos[2]=$iduser;
      $datos[3]=$_POST['nombre'];
      $datos[4]=$_POST['descripcion'];
      $datos[5]=$_POST['cantidad'];
      $datos[6]=$_POST['precio'];
      echo $obj->agregaProducto($datos);
    }else{
      echo 0;
    }
  }
?>