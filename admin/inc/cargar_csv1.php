<?php
session_start();
include ("../conexion/conectar.inc");
include 'funciones.inc';
global $conectar;
$titulos=$conectar->query("SHOW COLUMNS FROM municxper WHERE NOT (Field='id' )");
echo $conectar->error;
$select='<option value="0">Ninguno</option>';
while ($row=$titulos->fetch_assoc()) {
    $select.='<option value="'.$row['Field'].'">'.$row['Field'].'</option>';
}


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
echo '<h2>Archivo Suibdo '.$_FILES['archivo']['name'].'</h2>';
//cargamos el archivo
$lineas = file($archivotmp);
echo '<div class="row"><div class="col-12"><form action="inc/guardar_csv1.php" id="formCsv11" method="post">';
//$lineas=utf8_converter($lineas);

echo '<table class="table table-bordered table-sm">';
echo '<thead><tr>';
echo '<th>';
echo '</th>';
echo '<th>';
echo '</th>';
echo '<th>';
echo '</th>';
echo '<th></th>';
echo '<th></th>';
echo '<th></th>';
echo '</tr></thead>';
echo '<tbody>';
foreach ($lineas as $clave=>$valor){
    $cols=explode(';', $valor);
    //print_r($valor);
    echo '<tr>';
    $fechafac=str_replace('"', '', $cols[38]);
    //echo $fechafac;
    $fe=explode('/', $fechafac);
    $fecha=$fe[2].'-'.$fe[1].'-'.$fe[0];
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][1]" value='.$cols[1].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][6]" value='.$cols[6].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][18]" value='.$cols[18].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][38]" value="'.$fecha.'"></td>';
    echo '</tr>';
    
}
echo '</tbody';
echo '</table>';

echo '<div class="row">';
echo '<button type="submit" class="btn btn-lg btn-primary" id="btnGuardarCsv">Guardar</button>';


echo '</div>';
echo '</form></div></div>'; 
echo '</div>';
?>
