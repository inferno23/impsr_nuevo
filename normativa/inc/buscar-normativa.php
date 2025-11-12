<?php 
include '../../functions/connect.php';
global $con;

$tema=$_POST['tema'];
$tipo=$_POST['tipo'];
$nro=$_POST['nro'];
$ano=$_POST['ano'];
$asociada=$_POST['asociada'];

$query="SELECT n.*,nt.tema,nti.tipo FROM `normativa` n LEFT JOIN normativa_tema nt ON n.id_tema=nt.id LEFT JOIN normativa_tipo nti ON n.id_tipo=nti.id WHERE n.id>0 ";

if($tema>0){
    $query.=" AND n.id_tema=".$tema;
}
if($tipo>0){
    $query.=" AND n.id_tipo=".$tipo;
}
if($nro<>''){
    $query.=" AND n.nro=".$nro;
}
if($ano<>''){
    $query.=" AND n.ano=".$ano;
}
if($asociada<>''){
    $query.=" AND n.asociadas LIKE '%".$asociada."%' ";
}
$query.=" ORDER BY n.nro DESC, n.ano DESC ";
//echo $query;
$res=$con->query($query);
$items=array();
while ($row=$res->fetch_assoc()) {
    $items[]=$row;
}


$respuesta=new stdClass();
$respuesta->success=true;
$respuesta->items=$items;
$respuesta->query=$query;
echo json_encode($respuesta);
?>