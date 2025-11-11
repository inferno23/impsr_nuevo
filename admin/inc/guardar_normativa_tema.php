<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$id=$_POST['id'];
$tema=$_POST['tema'];

if (empty($id)){
    $query="INSERT INTO `normativa_tema` (`tema`) VALUES ('$tema')";
}else{
    $query="UPDATE `normativa_tema` SET `tema`='$tema' WHERE id='$id'";
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