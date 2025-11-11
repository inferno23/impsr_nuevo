<?php
session_start();
header('Content-Type: application/json');
ini_set('log_errors',TRUE);
ini_set('error_reporting', E_ALL);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
$respuesta = new stdClass;
global $conectar;
include '../conexion/conectar.inc.php';
$id=$_POST['id'];
$fecha=$_POST['fecha'];
$factura=$_POST['factura'];
$proveedor=$_POST['proveedor'];
$producto=$_POST['producto'];
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];

if (empty($id)){
    $query="INSERT INTO `inv_compras`(`id_proveedor`, `id_producto`, `fecha`, `cantidad`, `precio`, `factura`, `archivo`) VALUES ('$proveedor','$producto','$fecha','$cantidad','$precio','$factura','')";
}else{
    $query="UPDATE `inv_compras` SET `id_proveedor`='$proveedor',`id_producto`='$producto',`fecha`='$fecha',`cantidad`='$cantidad',`precio`='$precio',`factura`='$factura' WHERE `id`='$id'";
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