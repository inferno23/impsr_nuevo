<?php
include_once 'constants.php';
include_once 'connect.php';
global $con;

$respuesta= new stdClass();

$seccion=$_POST['seccion'];
//
$sql="SELECT * FROM turnos_secciones WHERE id='$seccion'";
//$respuesta->sql=$sql;
$sec=$con->query($sql);
$row_sec=$sec->fetch_assoc();
$fraccion=$row_sec['fraccion'];
$puestos=$row_sec['puestos'];
$date1 = new DateTime($row_sec['hora_ini']);
$inicio=$date1->format('H:i');
$date2 = new DateTime($row_sec['hora_fin']);
$fin=$date2->format('H:i');
$respuesta->ini=$inicio;
$respuesta->fin=$fin;
$dif=$date1->diff($date2);
$tiempo=(($dif->h * 60) + $dif->i);
$respuesta->dif=$tiempo;
$p=($tiempo/$fraccion);
$p2=($p * $puestos);
$respuesta->p=$p;
$respuesta->puestost=$p2;
$hoy=date('Y-m-d');
$tomadas=array();
$query="SELECT COUNT(hora) as tomados,fecha FROM turnos WHERE id_seccion='$seccion' AND confirmado='1' AND fecha>'$hoy' GROUP BY fecha";
$tom= $query;
$res=$con->query($query);
if ($res) {
    while ($row=$res->fetch_assoc()) {
        $fec=$row['fecha'];
        $toma=$row['tomados'];
        if ($toma>=$p2) {
            $date = new DateTime($fec);
            $fe=$date->format('j-n-Y');
            $tomadas[]=$fe;
        }
    }
}
//
$respuesta->tomadas=$tomadas;

$feriados=array();
$queryfe="SELECT fecha FROM turnos_feriados WHERE id_seccion='$seccion' AND fecha>=NOW() ";
$resf=$con->query($queryfe);
if($resf){
    while ($rowf=$resf->fetch_assoc()) {
        $date = new DateTime($rowf['fecha']);
        $fe=$date->format('j-n-Y');
        $feriados[]=$fe;
    }
}
//

$respuesta->success=true;
$respuesta->fer=array_merge($feriados,$tomadas);
$respuesta->fer1=$feriados;
//$respuesta->tom=$tom;
$respuesta->puestos=$puestos;

echo json_encode($respuesta);