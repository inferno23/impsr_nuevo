<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$id=$_POST['id'];
$passold=$_POST['passold'];
$pass1=$_POST['pass'];
if ($passold==$pass1){
    $pass=$passold;
}
else{
    $pass=$_POST['pass'];
}
    $query="UPDATE `personas` SET `CLAVE`='$pass' WHERE IDPERSONA='$id' ";
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.$query;
}
echo json_encode($respuesta);	

?>