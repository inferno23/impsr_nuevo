<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", __DIR__."/error_carga.log");
include ("../conexion/conectar.inc.php");
include 'funciones.inc';
global $conectar;


//

echo '<div class="container">';
$archivotmp = $_FILES['archivo']['tmp_name'];
echo '<h2>Archivo Subido '.$_FILES['archivo']['name'].'</h2>';
//cargamos el archivo
//$lineas = fopen($archivotmp);
$fp = fopen($archivotmp, "r");
while (!feof($fp)){
    $linea = fgets($fp);
$linea=trim($linea);
    $col2=explode(',', $linea);
    $csv[]=$col2;
}
//print_r($csv);
fclose($fp);

echo '<div class="row"><div class="col-12"><form action="inc/guardar_liq.php" id="formLiq1" method="post">';
//$lineas=utf8_converter($lineas);

echo '<table class="table table-bordered table-sm">';
echo '<thead><tr>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '</tr></thead>';
echo '<tbody>';
//echo '<pre>';
//var_dump($csv);
//echo '</pre>';
foreach ($csv as $clave=>$valor){
    $cols=$valor;
    //var_dump($valor);
    $dni=$valor[2];
    $query="SELECT * FROM `liq_negativa` WHERE `nro_documento` = '$dni'";
    $res=$conectar->query($query);
    //echo $res->num_rows.$query.'<br>';
    if($res->num_rows==0){
        $c++;
        echo '<tr>';
        echo '<td><input class="form-control" type="text" name="col['.$clave.'][1]" value="'.$valor[1].'"></td>';
        echo '<td><input class="form-control" type="text" name="col['.$clave.'][2]" value="'.$valor[2].'"></td>';
        echo '<td><input class="form-control" type="text" name="col['.$clave.'][3]" value="'.$valor[3].'"></td>';
        echo '<td><input class="form-control" type="text" name="col['.$clave.'][4]" value="'.$valor[4].'"></td>';
        echo '<td><input class="form-control" type="text" name="col['.$clave.'][5]" value="'.$valor[5].'"></td>';
        echo '</tr>';
    }
    
}
echo '</tbody';
echo '</table>';

echo '<div class="row">';
echo '<button type="submit" class="btn btn-lg btn-primary btn-guardar" >Guardar '.$c.' registros</button>';


echo '</div>';
echo '</form></div></div>';
echo '</div>';
?>
