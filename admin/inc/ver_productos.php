<?php
include '../conexion/conectar.inc.php';
global $conectar;

$respuesta= new stdClass();

$area=$_POST['area'];
//
$res=$conectar->query("SELECT im.id_producto,ip.referencia,ip.descripcion,ip.precio,it.tipo FROM `inv_movimientos` im LEFT JOIN inv_productos ip ON im.id_producto=ip.id LEFT JOIN inv_tipo_producto it ON ip.tipo_producto=it.id WHERE im.id_area='$area'");
if ($res) {
    $respuesta->success=true;
    $item='';
    while ($row=$res->fetch_assoc()) {
        $item.='<tr>';    
        $item.='<td>'.$row['referencia'].'</td>';
        $item.='<td>'.$row['tipo'].'-'.$row['descripcion'].'</td>';
        $item.='<td>'.$row['precio'].'</td>';
        $item.='</tr>';
   } 
   $respuesta->items=$item;
}else{
    $respuesta->success=false;
}

echo json_encode($respuesta);