<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL,"es_ES");

include '../conexion/conectar.inc';
global $conectar;

$respuesta= new stdClass();

$id=$_POST['id'];
$valor=$_POST['valor'];

$query="UPDATE `turnos` SET `confirmado`='0',`excepcion`='$valor' WHERE id='$id'";

$res=$conectar->query($query);
if ($res) {
    $respuesta->success=true;
    //
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error;
}
echo json_encode($respuesta);

?>