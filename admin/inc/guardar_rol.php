<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$id=$_POST['id_rol'];
$nombre=$_POST['codigo'];
$bene=isset($_POST['bene'])?$_POST['bene']:'0';
$emple=isset($_POST['emple'])?$_POST['emple']:'0';
$recibos=isset($_POST['recibos'])?$_POST['recibos']:'0';
$nove=isset($_POST['nove'])?$_POST['nove']:'0';
$lici=isset($_POST['lici'])?$_POST['lici']:'0';
$legi=isset($_POST['legi'])?$_POST['legi']:'0';
$fechas=isset($_POST['fechas'])?$_POST['fechas']:'0';
$admin=isset($_POST['admin'])?$_POST['admin']:'0';
$noti=isset($_POST['noti'])?$_POST['noti']:'0';
$turnos=isset($_POST['turnos'])?$_POST['turnos']:'0';
$cuil=isset($_POST['cuil'])?$_POST['cuil']:'0';
$hotel=isset($_POST['hotel'])?$_POST['hotel']:'0';
$nicasio=isset($_POST['nicasio'])?$_POST['nicasio']:'0';
if (!empty($id)){
	$query="UPDATE `roles` SET `nombre`='$nombre', `nicasio`='$nicasio', `hotel`='$hotel',`cuil`='$cuil',`turnos`='$turnos',`legislacion`='$legi',`notificaciones`='$noti',`usuarios`='$bene',`empleados`='$emple',`fechas`='$fechas',`recibos`='$recibos',`novedades`='$nove',`licitaciones`='$lici',`admin`='$admin' WHERE id='$id' ";
}
else {
	$query="INSERT INTO `roles`(  `nicasio`,`hotel`,`cuil`, `notificaciones`,`nombre`,`licitaciones`,`turnos`,`legislacion`, `novedades`, `recibos`, `empleados`, `usuarios`, `admin`,`fechas`) 
VALUES ('$nicasio','$hotel','$cuil','$noti','$nombre','$lici','$turnos','$legi','$nove','$recibos','$emple','$bene','$admin','$fechas')";
}
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error;
}
echo json_encode($respuesta);	
?>