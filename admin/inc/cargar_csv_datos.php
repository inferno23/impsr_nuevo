<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", "error.log");

include '../conexion/conectar.inc';
include 'funciones.inc';

function utf8_converter($array) {
    array_walk_recursive($array, function(&$item, $key){
        if (!mb_detect_encoding($item, 'UTF-8', true)) {
            $item = utf8_encode($item);
        }
    });
    return $array;
}

$csv = [];

$archivotmp = $_FILES['archivo']['tmp_name'];

$fp = fopen($archivotmp, "r");
if (!$fp) {
    die("Error al abrir el archivo CSV.");
}

while (($linea = fgets($fp)) !== false) {
    $linea = trim($linea);
    if (empty($linea)) continue;
    $col2 = explode(',', $linea);
    $col2 = utf8_converter($col2);
    $csv[] = $col2;
}
fclose($fp);

$_SESSION['l_csv'] = $csv;
?>
<form action="inc/guardar_csv_datos.php" method="post" id="guardarcsvdatos">
<?php
echo '<table class="table table-bordered table-sm">';
echo '<thead>';
echo '<th>IDPERSONA</th><th>Telefono</th><th>Direccion</th><th>Celular</th><th>Email</th>';
echo '</thead><tbody>';

$c = 0;
foreach ($csv as $clave => $valor) {
    if (count($valor) < 5) continue;
    $c++;
    echo '<tr class="fila' . $clave . '">';
    for ($i = 0; $i < 5; $i++) {
        $name = ['idpersona', 'telefono', 'direccion', 'celular', 'email'][$i];
        echo '<td><input class="form-control" type="text" name="' . $name . '[' . $clave . ']" value="' . htmlspecialchars($valor[$i]) . '"></td>';
    }
    echo '</tr>';
}
echo '</tbody></table>';
?>
<div class="row">
    <p>Total : <?php echo $c . ' registros para actualizar'; ?></p>
</div>
<div class="row">
    <div class="col-12">
        <button type="submit" class="btn btn-success btn-guardar" id="btnGuardarCsv">Guardar</button>
    </div>
</div>
</form>
