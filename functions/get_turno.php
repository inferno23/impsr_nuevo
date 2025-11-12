<?php
include_once 'constants.php';
include_once 'connect.php';
global $con;

$respuesta= new stdClass();

$dni=$_POST['dni'];
$idturno=$_POST['idturno'];
$secsub=substr($idturno, 0, 4);
$nturno = substr($idturno, 4,4);
$query="SELECT * FROM turnos WHERE id='$nturno' AND dni='$dni'";
$tur=$con->query($query);

if($tur->num_rows>0){
    $row=$tur->fetch_assoc();
    $respuesta->success=true;
    $respuesta->datos=$row;
    $id=$row['id'];
    $respuesta->nroturno=$idturno;
    $_SESSION['impsr']['nroturno']=$idturno;
    $_SESSION['impsr']['idturno']=$id;
    $_SESSION['impsr']['seccion']=$row['id_seccion'];
    $_SESSION['impsr']['subseccion']=$row['id_subseccion'];
}else{
    $respuesta->success=false;
    $respuesta->error=$con->error.' '.$query;
    $respuesta->msg='Error el dato enviado no existe';
}
//


echo json_encode($respuesta);