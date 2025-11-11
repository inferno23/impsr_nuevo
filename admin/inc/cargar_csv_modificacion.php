<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", "error.log");


function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item);
        }
    });
    return $array;
}
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];

$handle = fopen($archivotmp, "r");
$csv=[];
$csv2=[];
//$handle=utf8_converter($handle);
$fp = fopen($archivotmp, "r");

while (!feof($fp)){
    $linea = fgets($fp);
    $linea=trim($linea);
    $col2=explode(',', $linea);
    //var_dump($col2);
    $csv[]=$col2;
}
//print_r($csv);
fclose($fp);

//array_walk($csv, function(&$a) use ($csv) {
//    $a = array_combine($csv[0], $a);
//});
//array_shift($csv);
//print_r($csv);
$_SESSION['l_csv']=array();
$_SESSION['l_csv']=$csv;
?>
<form action="inc/guardar_csv_modificacion.php" method="post" id="formUpdate1">
<?php
$cant=count($csv);
error_log('cantidad de registros '.$cant);
echo '<table class="table table-bordered table-sm">';
echo '<thead>';
echo '<th>IDPERSONA</th>';
echo '<th>idtpotramite</th>';
echo '<th>fechaactual</th>';
echo '</thead>';
echo '<tbody>';
$c=0;
foreach ($csv AS $clave=>$valor){
    
    if($valor[0]>0){
        $c++;  
    $val1=$valor[0]??'';
    $val2=$valor[1]??'';
    $val3=$valor[2]??'';
    if(!empty($valor[2])){
        $f=explode('/', $valor[2]);
        $val3=$f[2].'-'.$f[1].'-'.$f[0];
    }else{
        $val3='';
    }
    echo '<tr class="fila'.$clave.'">';
    echo '<td><input class="form-control" type="text" name="idpersona['.$clave.']" value="'.$val1.'"></td>';
    echo '<td><input class="form-control" type="text" name="idtpotramite['.$clave.']" value="'.$val2.'"></td>';
    echo '<td><input class="form-control" type="date" name="fechaactual['.$clave.']" value="'.$val3.'"></td>';
    echo '</tr>';
    }
}

echo '</tbody>';
 echo '</table>';

?>
<div class="row">
	<p>Total : <?php echo $c.' registros Para Actualizar '; ?></p>
</div>
<div class="row">
	<div class="col-12">
		<button type="submit" class="btn btn-success btn-guardar" id="btnGuardarCsv">Guardar</button>
	</div>
</div>	
</form>