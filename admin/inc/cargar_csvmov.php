<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", "error_carga.log");
include ("../conexion/conectar.inc.php");
include 'funciones.inc';
global $conectar;


//
//
function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item);
            //$item = preg_replace(';', ',', $item);
        }
    });
        
        return $array;
}
echo '<div class="container">';
$archivotmp = $_FILES['archivo']['tmp_name'];
echo '<h2>Archivo Subido '.$_FILES['archivo']['name'].'</h2>';
//cargamos el archivo
$lineas = file($archivotmp);
echo '<div class="row"><div class="col-12"><form action="inc/guardar_mov.php" id="formMov1" method="post">';
//$lineas=utf8_converter($lineas);

echo '<table class="table table-bordered table-sm">';
echo '<thead><tr>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '</tr></thead>';
echo '<tbody>';
foreach ($lineas as $clave=>$valor){
    $cols=explode(';', $valor);
    //$cols=utf8_converter($cols);
    //print_r($cols);
    echo '<tr>';
    $fechafac=str_replace('"', '', $cols[5]);
    //echo $fechafac;
    $fe=explode('/', $fechafac);
    $fecha=$fe[0].'-'.$fe[1].'-'.$fe[2];
    $titular= utf8_encode($cols[2]);
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][1]" value="'.$cols[1].'"></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][2]" value="'.$titular.'"></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][3]" value="'.$cols[3].'"></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][4]" value="'.$cols[4].'"></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][5]" value="'.$fecha.'"></td>';
    echo '</tr>';
    
}
echo '</tbody';
echo '</table>';

echo '<div class="row">';
echo '<button type="submit" class="btn btn-lg btn-primary" id="btnGuardarMov">Guardar</button>';


echo '</div>';
echo '</form></div></div>';
echo '</div>';
?>
