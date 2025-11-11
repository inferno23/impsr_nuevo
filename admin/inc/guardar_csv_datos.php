<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
$respuesta = new stdClass;

$idpersonas=$_POST['idpersona'];
$telefonos=$_POST['telefono'];
$direcciones=$_POST['direccion'];
$celulares=$_POST['celular'];
$emails=$_POST['email'];
$n=0;
$error='';
foreach ($idpersonas as $i=>$id){
    //print_r($valor);
    if ($id>'') {
        $idpersona=$id;
        $telefono=$telefonos[$i];
        $dir=$direcciones[$i];
        $celu=$celulares[$i];
        $email=$emails[$i];
        $query2="UPDATE `personas` SET `DOMICILIO`='$dir',`TELEFONO`='$telefono',`celular`='$celu',`mail`='$email' WHERE `IDPERSONA`='$idpersona'";
        //echo $query2;
        $res=$conectar->query($query2);
        
        if($res){
            $n++;
        }else{
            $error.=$conectar->error;
        }
    }
    
}
$respuesta->updates=$n;
$respuesta->error=$error;

//print_r($_POST);
echo json_encode($respuesta, JSON_FORCE_OBJECT);
