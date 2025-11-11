<?php
session_start();
header('Content-Type: application/json');
$respuesta = new stdClass;
global $conectar;
include '../conexion/conectar.inc';

$id=$_POST['id'];
$titulo=$_POST['titulo'];
$archivoold=$_POST['archivoold'];
if(is_uploaded_file($_FILES['archivo']['tmp_name']))
{
    $dir='../../formularios/legislacion';
    $name = $_FILES['archivo']['name'];
    $name=str_replace(' ', '_', $name);
    $archivo='formularios/legislacion/'.$name;
    if(move_uploaded_file($_FILES['archivo']['tmp_name'], "$dir/$name"))
    {
        $respuesta->subir=true;
    }else{
        $respuesta->error=$_FILES['archivo']['error'];
    }
}else{
    $archivo=$archivoold;
}
if (empty($id)){
    $query="INSERT INTO `legislacion`( `titulo`, `archivo`) VALUES ('$titulo','$archivo')";
}else{
    $query="UPDATE `legislacion` SET `titulo`='$titulo',`archivo`='$archivo' WHERE id='$id'";
}
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->sucsess=false;
    $respuesta->error=$conectar->error;
}


echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>