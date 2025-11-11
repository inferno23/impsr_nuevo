<?php
session_start();
header('Content-Type: application/json');
date_default_timezone_set('America/Argentina/Buenos_Aires');
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;

$respuesta= new stdClass();

$fecha=$_POST['fecha'];
$seccion=$_POST['seccion'];
if (isset($_POST['sel'])) {
    $sel=$_POST['sel'];
}else{
    $sel='';
}
//
$sec=$conectar->query("SELECT * FROM turnos_secciones WHERE id='$seccion'");
$row_sec=$sec->fetch_assoc();
$fraccion=$row_sec['fraccion'];
$puestos=$row_sec['puestos'];
$date = new DateTime($row_sec['hora_ini']);
$inicio=$date->format('H:i');
$date = new DateTime($row_sec['hora_fin']);
$fin=$date->format('H:i');

$fec=new DateTime($fecha);
$ndi =$fec->format('N');
$now=date('H:i');
$dia=date('Y-m-d');
//
$tomadas=array();
$query="SELECT COUNT(*) as turnos,hora FROM turnos WHERE fecha='$fecha' AND id_seccion='$seccion' AND confirmado='1' GROUP BY hora ORDER BY `turnos`.`hora` DESC";
//echo $query;
$res=$conectar->query($query);
if ($res) {
    while ($row=$res->fetch_assoc()) {
        
            $date = new DateTime($row['hora']);
            $ho=$date->format('H:i');
            $tomadas[$ho]=$row['turnos'];
        
        
    }
}
//

$feriados=array();
$queryfe="SELECT fecha FROM turnos_feriados WHERE id_seccion='$seccion' AND fecha>='$dia' ";
$resf=$conectar->query($queryfe);
if($resf){
    while ($rowf=$resf->fetch_assoc()) {
        $feriados[]=$rowf['fecha'];
    }
}
//


$hora=$inicio;
$respuesta->now=$now;
$respuesta->inicio=$inicio;
if (!empty($sel)) {
    $hora=$inicio;
}else{
    $respuesta->nosel=true;
    if (($fecha==$dia) && ($now>=$inicio)) {
        $ho=date('H')+1;
        $hora=$ho.':00';
    }else{
        $hora=$inicio;
    }
}
$respuesta->hora=$hora;
$respuesta->fecha=$fecha;


$minutoAnadir=$fraccion;
$turnos='';

if(($ndi=='6') || ($ndi=='7') || (in_array($fecha, $feriados)) ){
    $turnos.='<p class="alert alert-info text-center"> Sin Turnos </p>';
}else{
    if ($fecha<$dia) {
        $turnos.='<p class="alert alert-info text-center"> Sin Turnos </p>';
    }else{
        while ($hora<$fin) {
            $class='';
            if ($sel==$hora) {
                $selected=' selected ';
            }else{
                
                $selected='';
            }
            $dis='';
            $men='('.$puestos.')';
            if (isset($tomadas[$hora])) {
                $tom=$puestos-$tomadas[$hora];
                $men=' ('.$tom.')';
            	if ($tom<='0') {
                    $dis=' disabled ';
                }
            }
            if ($puestos<='0') {
                $dis=' disabled ';
            }
            $id=str_replace(':','',$hora);
            $turnos.='<option id="hora'.$id.'" class="'.$class.'" '.$selected.' '.$dis.' value="'.$hora.'">'.$hora.$men.'</option>';
            $segundos_horaInicial=strtotime($hora);
            $segundos_minutoAnadir=$minutoAnadir*60;
            $hora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
        }
    }
}

$respuesta->success=true;
$respuesta->turnos=$turnos;
$respuesta->tomadas=serialize($tomadas);

echo json_encode($respuesta);