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
$now=date('H:i');
$dia=date('Y-m-d');

//
$tomadas=array();
$query="SELECT COUNT(*) as turnos,hora FROM turnos WHERE fecha='$fecha' AND id_seccion='$seccion' AND confirmado='1' GROUP BY hora ORDER BY `turnos`.`hora` DESC";
$res=$con->query($query);
if ($res) {
   while ($row=$res->fetch_assoc()) {
       if ($row['turnos']>=$puestos) {
           $date = new DateTime($row['hora']);
           $ho=$date->format('H:i');
           $tomadas[$ho]=$row['turnos'];
       }
       
   } 
}
//

$feriados=array();
$queryfe="SELECT fecha FROM turnos_feriados WHERE id_seccion='$seccion' AND fecha>='$dia' ";
$resf=$con->query($queryfe);
if($resf){
    while ($rowf=$resf->fetch_assoc()) {
        $feriados[]=$rowf['fecha'];
    }
}
//

$now=date('H:i');
$dia=date('Y-m-d');
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

$minutoAnadir=$fraccion;
$turnos='';
$sel='';
if(($ndi=='6') || ($ndi=='7') || (in_array($fecha, $feriados)) ){
    $turnos.='<option disabled="disabled"  > Sin Turnos </option>';
}else{
    if ($fecha<$dia) {
        $turnos.='<option disabled="disabled"  > Sin Turnos </option>';
    }else{
        while ($hora<$fin) {
            $class='';
            if ($sel==$hora) {
                $selected=' selected ';
            }else{
                
                $selected='';
            }
            $tom=$puestos;
            $men='('.$puestos.')';
            if (isset($tomadas[$hora])) {
                $tom=$puestos-$tomadas[$hora];
                $men=' ('.$tom.')';
            }
            if ($tom>0) {
                $id=str_replace(':','',$hora);
                $turnos.='<option id="hora'.$id.'" class="'.$class.'" '.$selected.' value="'.$hora.'">'.$hora.$men.'</option>';
            }            
            
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