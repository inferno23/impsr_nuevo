<?php
session_start();
ini_set('display_errors', 'off');
header('Content-Type: application/json');
include '../conexion/conectar.inc';
$respuesta = new stdClass;
global $conectar;
$periodo=$_POST['remPeriodo'];
$tipo=$_POST['remTipo'];
$pr=explode('-', $periodo);
$mes=$pr[1];
if(isset($_POST['aguinaldo'])){
    if($mes=='07'){
        $mes='071';
    }elseif ($mes=='12'){
        $mes='121';
    }
}

$ano=$pr[0];
$respuesta->res='';
$query="SELECT * FROM recibos WHERE ano='$ano' AND mes='$mes' AND tipo='$tipo' ";
$respuesta->query=$query;
$res=$conectar->query($query);
if ($res) {
    $respuesta->success=true;
    while ($row=$res->fetch_assoc()) {
        $archivo=$row['archivo'];
        $dir=realpath(__DIR__);
        $respuesta->dir[]=$archivo;
        $respuesta->arch[]=$dir;
        $archi=$dir.'/../../'.$archivo;
        $respuesta->archivo[]=$archi;
        
        
        $id=$row['id'];
        if (file_exists($archi)) {
            $respuesta->ar1[]='existe';
            if (unlink($archi)) {
                $query2="DELETE FROM `recibos` WHERE id='$id'";
                $res2=$conectar->query($query2);
                if ($res2) {
                    $respuesta->res.=$archivo." Borrado totalmente<br>";
                }else{
                    $respuesta->res.=$archivo." Borrado archivo fisico pero no bd<br>";
                }
            }else{
                $respuesta->res.=$archivo." error al borrar archivo fisico<br>";
            }
        }else{
            $query2="DELETE FROM `recibos` WHERE id='$id'";
            $res2=$conectar->query($query2);
        }
        
    }
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error;
    $respuesta->res.='no se encuentra periodo';
}

echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>