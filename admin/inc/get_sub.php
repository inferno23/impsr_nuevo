<?php
include '../conexion/conectar.inc';
global $conectar;

$respuesta= new stdClass();

$seccion=$_POST['seccion'];
$sel=$_POST['sel'];
//
$res=$conectar->query("SELECT * FROM turnos_subsecciones WHERE id_seccion='$seccion'");
if ($res) {
    $respuesta->success=true;
    $sec='';
    while ($row=$res->fetch_assoc()) {
            if ($sel==$row['id']) {
                $selected=' selected ';
            }else{
                $selected='';
            }
        $sec.='<option id="sub'.$row['id'].'" '.$selected.' value="'.$row['id'].'">'.$row['etiqueta'].'</option>';
   } 
   $respuesta->opciones=$sec;
}else{
    $respuesta->success=false;
}

echo json_encode($respuesta);