<?php
include_once 'constants.php';
include_once 'connect.php';
global $con;

$respuesta= new stdClass();

$id=$_POST['id'];
$query="DELETE FROM `turnos` WHERE id='$id'";
$tur=$con->query($query);

if($tur){
    $respuesta->success=true;
    $respuesta->msg='Turno Eliminado';
}else{
    $respuesta->success=false;
    $respuesta->error=$con->error.' '.$query;
    $respuesta->msg='Error al eliminar el turno, intente de nuevo';
}

echo json_encode($respuesta);