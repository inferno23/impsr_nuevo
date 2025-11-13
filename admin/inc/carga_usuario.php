<?php 
header('Content-Type: application/json');
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;
$id=$_POST['id'];
 if(empty($id)){
    $id=$_GET['id'];
 }  
$query = $conectar->query("SELECT a.*,b.id_rol rol,b.seccion,c.NROJUBILADO FROM personas a LEFT JOIN permisos b ON a.LEGAJO=b.legajo LEFT JOIN municxper c ON a.IDPERSONA=c.IDPERSONA WHERE a.IDPERSONA='$id' ");
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