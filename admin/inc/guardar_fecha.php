<?php
session_start();
header('Content-Type: application/json');
ini_set('log_errors',TRUE);
ini_set('error_reporting', E_ALL);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
$respuesta = new stdClass;
global $conectar;
include '../conexion/conectar.inc';
$id=$_POST['id'];
$mes=$_POST['mes'].'-01';
$texto=addslashes($_POST['texto']);
$fecha=$_POST['fecha'];
$activo=isset($_POST['activo'])?$_POST['activo']:'1';


if (empty($id)){
    $query="INSERT INTO `fechas`(`mes`, `fecha_pago`, `mensaje`, `activo`) VALUES ('$mes','$fecha','$texto','$activo')";
}else{
    $query="UPDATE `fechas` SET `mes`='$mes',`fecha_pago`='$fecha',`mensaje`='$texto',`activo`='$activo' WHERE `id`='$id'";
}
$resultado=$conectar->query($query);
$respuesta->error=$conectar->error;
if ($resultado){
    $respuesta->success=true;
}else{
    $respuesta->success=false;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>