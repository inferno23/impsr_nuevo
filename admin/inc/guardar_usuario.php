<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$rol=$_POST['rol'];
$legajo=$_POST['legajo'];
$seccion=$_POST['seccion'];
$conectar->query("DELETE FROM `permisos` WHERE legajo='$legajo'");
$query="INSERT INTO `permisos`(`legajo`, `id_rol`, `seccion`) VALUES ('$legajo','$rol','$seccion')";
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error;
}
echo json_encode($respuesta);	

?>