<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc.php';
include '../inc/funciones.inc';
global $conectar;
$respuesta = new stdClass;

$idpersonas=$_POST['idpersona'];
$idtpotramites=$_POST['idtpotramite'];
$fechaactuales=$_POST['fechaactual'];
$n=0;
$error='';
$sql=array();
foreach ($idpersonas as $i=>$id){
    //print_r($valor);
    if ($id>0) {
        $idpersona=$id;
        $idtpo=$idtpotramites[$i];
        $fech=$fechaactuales[$i];
        $query2="UPDATE `personas` SET `IDTPOTRAMITE`='$idtpo',`FECHAACTUAL`='$fech' WHERE `IDPERSONA`='$idpersona'";
        $sql[]=$query2;
        $res=$conectar->query($query2);
        
        if($res){
            $n++;
        }else{
            $error.=$conectar->error;
            error_log('error guardando update '.$query2.' '.$conectar->error);
        }
    }
    
}
$respuesta->sql=$sql;
$respuesta->updates=$n;
$respuesta->error=$error;

//print_r($_POST);
echo json_encode($respuesta, JSON_FORCE_OBJECT);
