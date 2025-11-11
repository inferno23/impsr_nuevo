<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$id=$_POST['id'];
$correo=$_POST['correo'];
$telefono=$_POST['telefono'];
$celular=$_POST['celular'];
$nombre=$_POST['nombre'];
$passold=$_POST['passold'];
$pass1=$_POST['pass'];
if ($passold==$pass1){
    $pass=$passold;
}
else{
    $pass=password_hash($_POST['pass'], PASSWORD_DEFAULT);
}
$query="UPDATE `personas` SET `CLAVE`='$pass',`APELLYNOMBRE`='$nombre',`TELEFONO`='$telefono',`celular`='$celular',`mail`='$correo' WHERE IDPERSONA='$id' ";
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.$query;
}
echo json_encode($respuesta);	

?>