<?php

include_once 'connect.php';
global $con;
$respuesta= new stdClass();



$dni = $_POST['dni'];
$nombre_beneficiario= $_POST['nombre_beneficiario'];
$numero_beneficiario = $_POST['numero_beneficiario'];
$email = $_POST['email'];

$cuil =$_POST['cuil'];

$nombre = $_POST['nombre'];

$telefono = $_POST['telefono'];
$fnac = $_POST['fecha_nac'];
$fecha = new DateTime($fnac);
$fecha_nac = $fecha->format('d-m-Y');
$domicilio = $_POST['domicilio'];

$fin = $_POST['fecha_fin'];
$fecha = new DateTime($fin);
$valido = $fecha->format('d-m-Y');

$ciclo = $_POST['ciclo'];

$ciclo_lectivo = $_POST['ciclo_lectivo'];

$estado = $_POST['estado'];
$fecha_es = $_POST['fecha_estado'];
$fecha = new DateTime($fecha_es);
$fecha_estado = $fecha->format('d-m-Y');
$nombre_establecimiento = $_POST['nombre_establecimiento'];
$fechemi = $_POST['fecha_emision'];
$fecha = new DateTime($fechemi);
$fecha_emision =  $fecha->format('d-m-Y');

$escolar = $_POST['escolar'];

$inicial = $_POST['inicial'];
$grado  = $_POST['grado'];
$año  = $_POST['año'];


$respuesta->success=true;

$datos['dni']= $dni;
$datos['nombre_beneficiario'] = $nombre_beneficiario;
$datos['numero_beneficiario'] = $numero_beneficiario;
$datos['email']=$email;

$datos['cuil']=$cuil;

$datos['nombre']=$nombre;

$datos['telefono']=$telefono;
$datos['fecha_nac']=$fecha_nac;
$datos['domicilio']=$domicilio;
$datos['ciclo'] = $ciclo;
$datos['ciclo_lectivo']= $ciclo_lectivo;
$datos['estado']= $estado;
$datos['nombre_establecimiento'] = $nombre_establecimiento;
$datos['fecha_emision'] = $fecha_emision;
$datos['fecha_es']= $fecha_estado;
$datos['escolar'] = $escolar;
$datos['grado'] = $grado;
$datos['año'] = $año;
$datos['inicial'] = $inicial;
$datos['valido'] = $valido;



$respuesta->datos=$datos;
$respuesta->success=true;

echo json_encode($respuesta);

 ?>
