<?php 
header('Content-Type: application/json');
include ("../conexion/conectar.inc.php");
include 'funciones.inc';
global $conectar;
$id=$_GET['id'];
$tabla=$_GET['tabla'];
//echo $id.'-'.$tabla;
$query = $conectar->query("SELECT * FROM $tabla WHERE id='$id'");
$respuesta = new stdClass;

if ($data=$query->fetch_assoc())
{
	$respuesta->item=$data;
	$respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.' '.$query;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>