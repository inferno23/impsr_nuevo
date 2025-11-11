<?php
header('Content-Type: application/json');
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;
$id=$_GET['id'];
$query = $conectar->query("SELECT * FROM novedades WHERE id=$id ");
$respuesta = new stdClass;

if ($data=$query->fetch_assoc())
{
    $respuesta->data=$data;
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.' '.$query;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>