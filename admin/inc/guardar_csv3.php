<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", "error.log");
header('Content-Type: application/json');
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
$respuesta = new stdClass;
$columnas=$_POST['column'];
//var_dump($_POST);
//die();

foreach ($columnas as $valor){
    
}
function vacio($valor){
	if (empty($valor)) {
		return '0';
	}else{
		return $valor;
	}
}
$cols=$_POST['col'];
$contador=0;
$error=0;
foreach ($cols as $valor){
    //print_r($valor);
    $idpersona=$valor[1];
    $nrojub=$valor[2];
    $nropen=$valor[3];
    $fechafall=$valor[4];
    $nroexp=$valor[5];
    $fechaalta=$valor[6];
    $fechavig=$valor[7];
    $fechacese=$valor[8];
    $diasimps=vacio($valor[9]);
    $fechault=$valor[10];
    //echo $nropen.'<br>\n\r';
    $query="UPDATE `municxper` SET `NROJUBILADO`='$nrojub',`NROEXPTE`='$nroexp',`DIASIMPS`='$diasimps',`NROPEN`='$nropen'";
    if(!empty($fechaalta)){
    	$query.=",`FECHAALTA`='$fechaalta'";}
    if(!empty($fechavig)){
    	$query.=",`FECHAVIG`='$fechavig'";}
    if(!empty($fechacese)){
    	$query.=",`FECHACESE`='$fechacese'";}
    if(!empty($fechafall)){
    	$query.=",`FECHAFALLECJUB`='$fechafall'";}
    if(!empty($fechault)){
    	$query.=",`FECHA_ULT_ACREDIT`='$fechault'";}
    $query.=" WHERE IDPERSONA='$idpersona'";
    error_log('query '.$query);
    $res=$conectar->query($query);
    error_log('error query '.$conectar->error);
    if($res){
    	$contador++;}
    else{
    	$respuesta->error[$idpersona]=$conectar->error;
    	$respuesta->query[$idpersona]=$query;
    	$error++;
    }
    if ($fechafall>'1970-01-01') {
        
        $query2="UPDATE `personas` SET `MUERTO`='1',`FECHAFALLEC`='$fechafall' WHERE `IDPERSONA`='$idpersona'";
        $conectar->query($query2);
    }
    
   
}
$respuesta->updates=$contador;


//print_r($_POST);
echo json_encode($respuesta, JSON_FORCE_OBJECT);
