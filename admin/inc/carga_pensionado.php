<?php 
header('Content-Type: application/json');
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;
$id=$_POST['id'];
$query = $conectar->query("SELECT a.LEGAJO,a.CLAVE,a.IDPERSONA,a.CUIL,a.APELLYNOMBRE,a.TELEFONO,a.celular,c.NROJUBILADO,c.NROPEN FROM personas a LEFT JOIN causante b ON a.IDPERSONA=b.IDPERSONA LEFT JOIN municxper c ON b.IDPER=c.IDPERSONA WHERE a.IDPERSONA='$id' ");
$respuesta = new stdClass;

if ($data=$query->fetch_assoc())
{
	$respuesta->usu=$data;
	$respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.' '.$query;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>