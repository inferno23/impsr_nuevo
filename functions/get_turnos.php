<?php
include_once 'constants.php';
include_once 'connect.php';
global $con;

$respuesta= new stdClass();

$fecha=$_POST['fecha'];
$seccion=$_POST['seccion'];
//
$sec=$con->query("SELECT * FROM turnos_secciones WHERE id='$seccion'");
$row_sec=$sec->fetch_assoc();
$fraccion=$row_sec['fraccion'];
$puestos=$row_sec['puestos'];
$date = new DateTime($row_sec['hora_ini']);
$inicio=$date->format('H:i');
$date = new DateTime($row_sec['hora_fin']);
$fin=$date->format('H:i');

$fec=new DateTime($fecha);
$ndi =$fec->format('N');
//
$tomadas=array();
$query="SELECT COUNT(*) as turnos,hora FROM turnos WHERE fecha='$fecha' AND id_seccion='$seccion' AND confirmado='1' GROUP BY hora ORDER BY `turnos`.`hora` DESC";
$res=$con->query($query);
if ($res) {
   while ($row=$res->fetch_assoc()) {
       if ($row['turnos']>=$puestos) {
           $date = new DateTime($row['hora']);
           $ho=$date->format('H:i');
           $tomadas[]=$ho;
       }
       
   } 
}

$hora=$inicio;
$now=date('H:i');
$dia=date('Y-m-d');

$minutoAnadir=$fraccion;
$turnos='';

if(($ndi=='6') || ($ndi=='7') || ($fecha<'2020-05-12') || ($fecha=='2020-05-21') || ($fecha=='2020-05-22') || ($fecha=='2020-05-25') || ($fecha=='2020-05-26') || ($fecha=='2020-05-27') || ($fecha=='2020-05-28') || ($fecha=='2020-05-29') || ($fecha=='2020-06-01') || ($fecha=='2020-06-02') || ($fecha=='2020-06-03') || ($fecha=='2020-06-04') || ($fecha=='2020-06-05') || ($fecha=='2020-06-24') || ($fecha=='2020-06-25') || ($fecha=='2020-06-26') || ($fecha=='2020-06-29') || ($fecha=='2020-06-30')){
    $turnos.='<p class="alert alert-info text-center"> Sin Turnos </p>';
}else{
    while ($hora<$fin) {
        $clases=' acciones  list-group-item-action ';
        $men='';
        $pro='';
        if (in_array($hora, $tomadas)) {
            $clases=' disabled ';
            $men=' COMPLETO ';
        }
        
        $id=str_replace(':','',$hora);
        if (($fecha<=$dia) && ($hora<$now)) {
            $pro= 'disabled hidden ';
        }
        if(($ndi=='6') || ($ndi=='7')){
            $pro=' disabled hidden ';
        }
        
        $turnos.='<div class="list-group-item  px-1 '.$clases.' '.$pro.'" id="tu'.$id.'"  data-hora="'.$hora.'">';
        $turnos.='<div class="row" style="margin-left:-5px;margin-right:-5px;">';
        $turnos.='<div class="col-2"><span class="hora"><b>'.$hora.'</b></span></div>';
        $turnos.='<div class="col-10 turnos px-1" id="turno'.$id.'"><b>'.$men.'</b></div>';
        $turnos.='</div>';
        $turnos.='</div>';
            		  			$segundos_horaInicial=strtotime($hora);
            		  			$segundos_minutoAnadir=$minutoAnadir*60;
            		  			$hora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
    }
}

$respuesta->success=true;
$respuesta->turnos=$turnos;
$respuesta->tomadas=serialize($tomadas);

echo json_encode($respuesta);