<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$id=$_POST['id'];
$tipo=$_POST['tipo'];

if (empty($id)){
    $query="INSERT INTO `normativa_tipo` (`tipo`) VALUES ('$tipo')";
}else{
    $query="UPDATE `normativa_tipo` SET `tipo`='$tipo' WHERE id='$id'";
}
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.$query;
}
echo json_encode($respuesta);	

?>