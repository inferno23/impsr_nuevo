<?php
header('Content-Type: application/json');
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;
$leg=trim($_POST['leg']);
$query = $conectar->query("SELECT * FROM personas WHERE LEGAJO=$leg ");
$respuesta = new stdClass;

if ($data=$query->fetch_assoc())
{
    $respuesta->nombre=$data['APELLYNOMBRE'];
    $respuesta->dni=$data['NRODOC'];
    $respuesta->cuil=$data['cuit'];
    $respuesta->id=$data['IDPERSONA'];
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.' '.$query;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>