<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$id=$_POST['id'];
$tipo=$_POST['tipo'];
$tema=$_POST['tema'];
$asunto=$_POST['asunto'];
$nro=$_POST['nro'];
$ano=$_POST['ano'];
$estado=$_POST['estado'];
$compete=$_POST['compete'];
$sancion=$_POST['sancion'];
$promulgacion=$_POST['promulgacion'];
$firmantes=$_POST['firmantes'];
$boletin=$_POST['boletin'];
$actualizado=$conectar->real_escape_string($_POST['actualizado']??'');
$asociadas=$_POST['asociadas'];
$imagenold=$_POST['imagenold'];
if(is_uploaded_file($_FILES['imagen']['tmp_name']))
{
    $dir='../../normativa/archivos';
    $name = $_FILES['imagen']['name'];
    $name=str_replace(' ', '_', $name);
    $archivo='archivos/'.$name;
    if(move_uploaded_file($_FILES['imagen']['tmp_name'], "$dir/$name"))
    {
        $respuesta->subir=true;
    }else{
        $respuesta->error=$_FILES['imagen']['error'];
    }
}else{
    $archivo=$imagenold;
}

if (empty($id)){
    $query="INSERT INTO `normativa`(`actualizado`, `id_tema`, `id_tipo`, `nro`, `ano`, `asunto`, `sancion`, `promulgacion`, `estado`, `compete`, `firmantes`, `boletin`, `imagen`, `asociadas`) VALUES ('$actualizado','$tema','$tipo','$nro','$ano','$asunto','$sancion','$promulgacion','$estado','$compete','$firmantes','$boletin','$archivo','$asociadas')";
}else{
    $query="UPDATE `normativa` SET `actualizado`='$actualizado',`id_tema`='$tema',`id_tipo`='$tipo',`nro`='$nro',`ano`='$ano',`asunto`='$asunto',`sancion`='$sancion',`promulgacion`='$promulgacion',`estado`='$estado',`compete`='$compete',`firmantes`='$firmantes',`boletin`='$boletin',`imagen`='$archivo',`asociadas`='$asociadas' WHERE id='$id'";
}
$resultado=$conectar->query($query);
if ($resultado) {
    $respuesta->success=true;
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error.$query;
}
echo json_encode($respuesta);	

?>