<?php
header('Content-Type: application/json');
include ("../conexion/conectar.inc");
global $conectar;
$id=$_GET['id'];
$query = $conectar->query("SELECT *,YEAR(mes) ano,MONTH(mes) mesn FROM `fechas` WHERE id=$id ");
$respuesta = new stdClass;

if ($data=$query->fetch_assoc())
{
    $respuesta->data=$data;
    $respuesta->data['nmes']=$data['ano'].'-'.str_pad($data['mesn'], 2, "0", STR_PAD_LEFT);
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.' '.$query;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>