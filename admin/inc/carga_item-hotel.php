<?php 
header('Content-Type: application/json');
include ("../conexion/conectar_hotel.inc.php");
global $conectar;
$id=$_POST['id'];
$tabla=$_POST['tabla'];
$query = $conectar->query("SELECT * FROM $tabla WHERE id='$id'");
$respuesta = new stdClass;

if ($data=$query->fetch_assoc())
{
	$respuesta->item=$data;
	$respuesta->success=true;
	if($tabla=='habitacion_tipo'){
	    $imagenes=$conectar->query("SELECT * FROM imagenes WHERE id_habitacion='$id'");
	    $cant=$imagenes->num_rows;
	    $respuesta->imgCant=$cant;
	    $i=1;
	    $imgs=new stdClass();
	    while ($row2=$imagenes->fetch_object()){
	        $imgs->{$i}=$row2;
	        $i++;
	    }
	    $respuesta->imgs=$imgs;
	}
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.' '.$query;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>