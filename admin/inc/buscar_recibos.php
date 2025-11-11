<?php
header('Content-Type: application/json');
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;
$cod=trim($_POST['cod']);
$res = $conectar->query("SELECT * FROM recibos WHERE codigo='$cod' ");
$respuesta = new stdClass;

if ($res)
{
    $respuesta->success=true;
    $respuesta->listas='';
    while ($data=$res->fetch_assoc()) {
        $respuesta->listas.='<a href="../'.$data['archivo'].'" target="_blank" class="list-group-item list-group-item-action">'.$data['titulo'].'</a>';
    }
    
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>