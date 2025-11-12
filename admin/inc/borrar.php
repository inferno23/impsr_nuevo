<?php
header('Content-Type: application/json');
include '../conexion/conectar.inc';
$id=$_POST['id'];
$db=$_POST['db'];
$respuesta = new stdClass;
$query="DELETE FROM `$db` WHERE id='$id'";
$prod = $conectar->query($query);

$respuesta->error=$conectar->error.$query;
if ($prod)
{
    
    $respuesta->success=true;
}
else {
    $respuesta->success=false;
    $respuesta->error.=" Datos Incorrectos ";
}
//echo $_POST['nombre'];
echo json_encode($respuesta);

?>
