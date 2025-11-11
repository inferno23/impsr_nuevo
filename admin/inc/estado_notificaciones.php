<?php 
header('Content-Type: application/json');
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$id=$_POST['id'];
$usuario=$_SESSION['imps']['IDPERSONA'];
$modificado=date('Y-m-d h:i:s');
$query="UPDATE `fallecimiento_not` SET `estado`='1',`estado_usuario`='$usuario',modificado='$modificado' WHERE id='$id' ";
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error;
}
echo json_encode($respuesta);	
?>