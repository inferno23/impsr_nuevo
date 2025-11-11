<?php
session_start();
ini_set('display_errors', 'off');
header('Content-Type: application/json');
include '../conexion/conectar_hotel.inc.php';
$respuesta = new stdClass;
global $conectar;
$id=$_POST['id'];
$archivo='../../'.$_POST['imagen'];
        if (unlink($archivo)) {
            $query2="DELETE FROM `imagenes` WHERE id='$id'";
            $res2=$conectar->query($query2);
            if ($res2) {
                $respuesta->success=true;
            }else{
                $respuesta->success=false;
                $respuesta->msg="error al eliminar registro de la base";
            }
        }else{
            $respuesta->success=false;
            $respuesta->msg="error al borrar el archivo ".$archivo;
        }

echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>