<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc';
$respuesta = new stdClass;
global $conectar;
$legajo=$_POST['upLegajo'];
$id=$_POST['upId'];
$periodo=$_POST['upPeriodo'];
$pr=explode('-', $periodo);
$mes=$pr[1];
$ano=$pr[0];


if(is_uploaded_file($_FILES['upArchivo']['tmp_name']))
{
    $dir='../../recibos-sueldo/empleados';
    $name = rand().'-'.$legajo.'-'.$mes.'-'.$ano.'.pdf';
    $titulo='Recibo_'.$legajo.'-'.$mes.'-'.$ano.'.pdf';
    if(move_uploaded_file($_FILES['upArchivo']['tmp_name'], "$dir/$name"))
    {
        $archivo='recibos-sueldo/empleados/'.$name;
        $query = "INSERT INTO `recibos`(`codigo`, `mes`, `ano`, `titulo`, `archivo`, `tipo`) VALUES ('$id','$mes','$ano','$titulo','$archivo','1')";
        $res=$conectar->query($query);
        if ($res) {
            $respuesta->success=true;
        }else{
            $respuesta->success=false;
            $respuesta->error=$conectar->error;
        }
    }else{
        $respuesta->success=false;
        $respuesta->error=$_FILES['archivos']['error'];
    }
    
    
}else{
    $respuesta->success=false;
    $respuesta->error='archivo no subido';
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>