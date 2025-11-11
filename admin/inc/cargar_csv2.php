<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", "error.log");
include '../conexion/conectar.inc';
include 'funciones.inc';
//print_r($_FILES);

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
$tipo = $_FILES['archivo']['type']; 
$tamanio = $_FILES['archivo']['size']; 
$archivotmp = $_FILES['archivo']['tmp_name']; 
//cargamos el archivo
$lineas = file($archivotmp);
error_log('carga archivo'.$lineas);
//var_dump($lineas);
//echo $lineas;
//$fichero = file_get_contents($archivotmp, FILE_USE_INCLUDE_PATH);
//echo $fichero;
//$fichero2 = preg_replace(';', ',', $fichero);
//echo $fichero2;
//error_log('reemplaza puntos');


$lineas=utf8_converter($lineas);
error_log('convierte a utf');
//var_dump($lineas);
//foreach ($lineas AS $clave=>$arr){
    //echo '<br>'.$clave;
    //$arr = preg_replace(';', ',', $arr);
    //print_r($arr);
    //foreach ($arr AS $key=>$ar){
    //    print_r($ar); 
    //    echo '<br>ar'.$key;
    //}
//}
//$lineas = preg_replace(';', ',', $lineas);
//$csv= array_map(function($v){return str_getcsv($v, ";");}, $lineas);



$csv = array_map('str_getcsv', $lineas,[";"]);
print_r($csv);
array_walk($csv, function(&$a) use ($csv) {
	$a = array_combine($csv[0], $a);
});
	array_shift($csv); 
print_r($csv);
//guardar array en variable session
$_SESSION['l_csv']=array();
$_SESSION['l_csv']=$csv;
error_log('carga en session');
print_r($csv);
?>
<form action="inc/guardar_csv3.php" method="post" id="guardarcsv2">
	
	
<?php
$cant=count($csv);
error_log('cantidad de lineas '.$cant);
echo '<table class="table table-bordered table-sm">';
echo '<thead>';
echo '<th>CODIDM</th>';
echo '<th>IDPERSONA</th>';
echo '<th>Nro Jub.</th>';
echo '<th>Nro Pen.</th>';
echo '<th>Fecha Fall</th>';
echo '<th>nro exp</th>';
echo '<th>Fecha alta</th>';
echo '<th>Fecha vig</th>';
echo '<th>Fecha cese</th>';
echo '<th>Dias imps</th>';
echo '<th>fecha_ult</th>';
echo '</thead>';
echo '<tbody>';
$c=0;
$t=0;
foreach ($csv AS $clave=>$valor){
	$c++;
    if ((is_numeric($valor['CODIDM'])) && ( (!empty($valor['NROPEN'])) || (!empty($valor['NROJUBILADO'])) )) {
        
        
    $t++;    
    echo '<tr class="fila'.$clave.'">';
    echo '<td>'.$valor['CODIDM'].'</td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][1]" value='.$valor['IDPERSONA'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][2]" value='.$valor['NROJUBILADO'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][3]" value='.$valor['NROPEN'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][4]" value='.$valor['FECHAFALLECJUB'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][5]" value='.$valor['NROEXPTE'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][6]" value='.$valor['FECHAALTA'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][7]" value='.$valor['FECHAVIG'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][8]" value='.$valor['FECHACESE'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][9]" value='.$valor['DIASIMPS'].'></td>';
    echo '<td><input class="form-control" type="text" name="col['.$clave.'][10]" value='.$valor['FECHA_ULT_ACREDIT'].'></td>';
    echo '</tr>';
    }
}

echo '</tbody>';
 echo '</table>';

?>
<div class="row">
	<p>Total : <?php echo $c.' - Para Actualizar :'.$t; ?></p>
</div>
<div class="row">
	<div class="col-12">
		<button type="submit" class="btn btn-success" id="btnGuardarCsv">Guardar</button>
	</div>
</div>	
</form>