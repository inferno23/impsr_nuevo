<?php
session_start();
include '../conexion/conectar.inc';
global $conectar;

$respuesta= new stdClass();

$fecha=$_POST['fecha'];
//
if ($_SESSION['imps']['admin']=='1') {
    
    $sec=$conectar->query("SELECT * FROM turnos_secciones ");
}else{
    $seccion=$_SESSION['imps']['seccion'];
    $sec=$conectar->query("SELECT * FROM turnos_secciones WHERE id='$seccion'");
}
$toma=array();
$todos=array();
while ($row_sec=$sec->fetch_assoc()){
    $idseccion=$row_sec['id'];
    $fraccion=$row_sec['fraccion'];
    $date = new DateTime($row_sec['hora_ini']);
    $inicio=$date->format('H:i');
    $date = new DateTime($row_sec['hora_fin']);
    $fin=$date->format('H:i');
    $hora=$inicio;
    $now=date('H:i');
    $dia=date('Y-m-d');
    $fec=new DateTime($fecha);
    $ndi =$fec->format('N');
    $minutoAnadir=$fraccion;
    $turnos='';
    //
    $tomados=array();
    $seccion=$idseccion;
    $query="SELECT a.*,b.etiqueta,c.nombre seccion FROM turnos a LEFT JOIN turnos_subsecciones b ON a.id_subseccion=b.id LEFT JOIN turnos_secciones c ON a.id_seccion=c.id WHERE a.fecha='$fecha' AND a.id_seccion='$seccion' AND a.confirmado='1' GROUP BY a.id ";
    
    
    $res=$conectar->query($query);
    if ($res) {
        while ($row=$res->fetch_assoc()) {
            $item=array();
            $date = new DateTime($row['hora']);
            $ho=$date->format('Hi');
            if ($_SESSION['imps']['admin']=='1') {
                $item['seccion']=$row['seccion'];
                $item['id_sec']=$row['id_seccion'];
            }else{
                $item['seccion']='';
                $item['id_sec']=$seccion;
            }
            $item['hora']=$date->format('H:i');
            $item['motivo']=$row['etiqueta'];
            $item['tipo']=$row['tipo'];
            $item['nombre']=$row['nombre'].' '.$row['apellido'];
            $item['telefono']=$row['telefono'];
            $item['dni']=$row['dni'];
            $tomados[$ho][]=$item;
            
        }
    }
    $toma[$idseccion]=$tomados;
    //
    if(($ndi=='6') || ($ndi=='7')){
        $turnos.='<p class="alert alert-info text-center"> Sin Turnos </p>';
    }else{
        while ($hora<$fin) {
            $clases=' acciones  list-group-item-action ';
            $men='';
            $pro='';
            $secc='';
            $motivo='';
            $dni='';
            $tel='';
            $tipo='';
            
            $date = new DateTime($hora);
            $ho=$date->format('Hi');
            if (isset($tomados[$ho])) {
                $men=$tomados[$ho][0]['nombre'];
                $secc=$tomados[$ho][0]['seccion'];
                $motivo=$tomados[$ho][0]['motivo'];
                $dni=$tomados[$ho][0]['dni'];
                $tel=$tomados[$ho][0]['telefono'];
                $tipo=$tomados[$ho][0]['tipo'];
                $pro=' activo ';
                //echo $ho.$tomados[$ho][0]['nombre'];//print_r($tomados[$ho]);
            }
            //echo $men.$hora;
            $turnos.='<div class="list-group-item  px-1 '.$clases.' '.$pro.'"  data-hora="'.$hora.'">';
            $turnos.=' <div class="row" style="margin-left:-5px;margin-right:-5px;">';
            $turnos.='  <div class="col-1 text-center border-right px-0"><span class="hora"><b>'.$hora.'</b></span></div>';
            $turnos.='  <div class="col-4 border-right">'.$secc.' '.$men.'</div>';
            $turnos.='  <div class="col-2 border-right">'.$dni.'</div>';
            $turnos.='  <div class="col-2 border-right">'.$tel.'</div>';
            $turnos.='  <div class="col-3 ">'.$motivo.' - '.$tipo.'</div>';
            $turnos.=' </div>';
            $turnos.='</div>';
            $segundos_horaInicial=strtotime($hora);
            $segundos_minutoAnadir=$minutoAnadir*60;
            $hora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
        }
    }
    
    $todos[$idseccion]=$turnos;
}



//



$respuesta->success=true;
$respuesta->turnos=$todos;
$respuesta->tomados=$toma;

echo json_encode($respuesta);