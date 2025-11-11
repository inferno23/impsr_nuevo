<?php 
header('Content-Type: application/json');
session_start();
include '../conexion/conectar.inc';
include 'funciones.inc';
global $conectar;
$respuesta = new stdClass;
$query="SELECT a.IDPERSONA,a.NRODOC,a.APELLYNOMBRE,a.LEGAJO,b.NROJUBILADO,b.NROPEN FROM personas a LEFT JOIN municxper b ON a.IDPERSONA=b.IDPERSONA WHERE a.CLAVE='' OR a.CLAVE IS NULL";
$res=$conectar->query($query);
if ($res->num_rows>0) {
    $respuesta->success=true;
    $tabla='<table id="tablaPw" class="table table-sm table-bordered"><thead><tr><th>ID</th><th>Nombre</th><th>DOC</th><th>Legajo</th><th>Nro Jub.</th><th>Nro Pen.</th><th>Clave</th></tr></thead><tbody>';
    while ($row=$res->fetch_assoc()) {
        $clave=generapasswd(8);
        $tabla.='<tr><td>'.$row["IDPERSONA"].'</td><td>'.$row['APELLYNOMBRE'].'</td><td>'.$row['NRODOC'].'</td><td>'.$row['LEGAJO'].'</td><td>'.$row['NROJUBILADO'].'</td><td>'.$row['NROPEN'].'</td><td>'.$clave.'</td></tr>';
        $passw=password_hash($clave, PASSWORD_DEFAULT);
        $id=$row['IDPERSONA'];
        $conectar->query("UPDATE `personas` SET `CLAVE`='$clave' WHERE `IDPERSONA`='$id'");
        $respuesta->error[]=$conectar->error;
    }
    $tabla.='</tbody></table>';
    $respuesta->tabla=$tabla;
}else{
    $respuesta->success=false;
}
echo json_encode($respuesta);	

?>