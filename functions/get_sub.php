<?php
include_once 'constants.php';
include_once 'connect.php';
global $con;

$respuesta= new stdClass();

$seccion=$_POST['seccion'];
//
$query="SELECT * FROM turnos_subsecciones WHERE id_seccion='$seccion'";
$respuesta->query=$query;
$res=$con->query($query);
if ($res) {
    $respuesta->success=true;
    $sec='';
    $sel='';
    $i=1;
    while ($row=$res->fetch_assoc()) {
        if ($i==1) {
            $sel=' selected ';
        }else{
            $sel='';
        }
        $sec.='<option '.$sel.' data-mensaje="'.$row['mensaje'].'" value="'.$row['seo'].'">'.$row['etiqueta'].'</option>';
        $i++;
        
   } 
   $respuesta->opciones=$sec;
}else{
    $respuesta->success=false;
}

echo json_encode($respuesta);