<?php
include 'functions/connect.php';
global $con;
$respuesta=new stdClass();
if ($_POST['pass1']==$_POST['passold']) {
    $pass=$_POST['passold'];
}else{
    $pass=password_hash($_POST['pass1'], PASSWORD_DEFAULT);
}


$id=$_POST['idp'];
$telefono=$_POST['telefono'];
$cel=$_POST['celular'];
$email=$_POST['email'];
$dir=$_POST['direccion'];
$telefono_old=$_POST['telefono_old'];
$cel_old=$_POST['celular_old'];
$email_old=$_POST['email_old'];
$dir_old=$_POST['direccion_old'];

$apenom=$_POST['apellynombre'];
$query="UPDATE `personas` SET `CLAVE`='$pass',`celular`='$cel',`TELEFONO`='$telefono',`DOMICILIO`='$dir',`mail`='$email' WHERE `IDPERSONA`='$id'";
$res=mysqli_query($con, $query);

if($telefono!=$telefono_old || $email!=$email_old || $cel!=$cel_old || $dir!=$dir_old){
    $query2="INSERT INTO `update_personas`(`id_persona`, `apenom`, `email`, `telefono`, `celular`, `direccion`) VALUES ('$id','$apenom','$email','$telefono','$cel','$dir')";
    mysqli_query($con,$query2);
    //$respuesta->update[]=$query2;
    $respuesta->updateerror[]=mysqli_error($con);
}

if ($res) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=mysqli_error($con);
}

echo json_encode($respuesta);