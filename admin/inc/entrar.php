<?php 
header('Content-Type: application/json');
session_start();
include ("../conexion/conectar.inc");
global $conectar;
$usuario=$_POST['email'];
$passwd=$_POST['password'];

$respuesta = new stdClass;
$query="SELECT a.*,c.nicasio,c.turnos,c.hotel,c.cuil,b.id_rol,b.seccion,c.fechas,c.legislacion,c.notificaciones,c.recibos,c.empleados,c.licitaciones,c.novedades,c.usuarios,c.admin FROM personas a LEFT JOIN permisos b ON a.LEGAJO=b.legajo LEFT JOIN roles c ON b.id_rol=c.id WHERE a.LEGAJO='$usuario'";
//echo $query;
$login = $conectar->query($query);
$respuesta->error=$conectar->error;
//echo $error;
 if ($login->num_rows>0)
 {
    $data=$login->fetch_assoc();
 	$original = trim($passwd);
    $codificado = trim($data['CLAVE']); 	
    $iguales = password_verify($original, $codificado);
    if ($iguales) {
    	$_SESSION['imps']=$data;
     	$respuesta->success=true;
     	$respuesta->mensaje="Contraseña aceptada";
    } else {
        $respuesta->success=false;
    	$respuesta->mensaje='La contraseña indicada no es correcta';
    }
 		
 }
 else { 
     $respuesta->success=false;
     $respuesta->mensaje="No existe email"; 
 }
 echo json_encode($respuesta);
?> 