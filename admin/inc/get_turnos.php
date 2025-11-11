<?php
session_start();
header('Content-Type: application/json');
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;

$fecha=$_POST['fecha'];
if (empty($fecha)) {
  $fecha = date( "Y-m-d" ) ;
}


$respuesta=new stdClass();

 
//
$turnos=array();
if ($_SESSION['imps']['admin']=='1') {
    $seccion=$_SESSION['imps']['seccion'];
    $query="SELECT a.*,b.etiqueta,c.nombre seccion FROM turnos a LEFT JOIN turnos_subsecciones b ON a.id_subseccion=b.id LEFT JOIN turnos_secciones c ON a.id_seccion=c.id WHERE a.fecha='$fecha' AND a.confirmado='1' GROUP BY a.id ";
}else{
    $seccion=$_SESSION['imps']['seccion'];
       
    $query="SELECT a.*,b.etiqueta,c.nombre seccion FROM turnos a LEFT JOIN turnos_subsecciones b ON a.id_subseccion=b.id LEFT JOIN turnos_secciones c ON a.id_seccion=c.id WHERE a.fecha='$fecha' AND a.id_seccion='$seccion' AND a.confirmado='1' GROUP BY a.id ";
    if ($seccion =='2' || $seccion=='3' || empty ($seccion)) {
       $seccion=2;
       $query="SELECT a.*,b.etiqueta,c.nombre seccion FROM turnos a LEFT JOIN turnos_subsecciones b ON a.id_subseccion=b.id LEFT JOIN turnos_secciones c ON a.id_seccion=c.id WHERE a.fecha='$fecha' AND (a.id_seccion =2 OR a.id_seccion =3) AND a.confirmado='1' GROUP BY a.id ";
    }
}
//console.log($query);
//echo ($query);
$res=$conectar->query($query);
$respuesta->query=$query;
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
            $turnos[$ho][]=$item;
        
    }
}



$respuesta->success=true;
$respuesta->turnos=$turnos;

echo json_encode($respuesta);