<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", "error.log");

// Incluye tus archivos necesarios
include '../conexion/conectar.inc';
include 'funciones.inc';

// Función para convertir a UTF-8
function utf8_converter($string) {
    if (!mb_detect_encoding($string, 'utf-8', true)) {
        return utf8_encode($string);
    }
    return $string;
}

// Validación de archivo
if (!isset($_FILES['archivo'])) {
    die("No se envió ningún archivo.");
}

$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];

// Verificar tamaño del archivo para evitar exceder la memoria
if ($tamanio > 50 * 1024 * 1024) { // Limite de 50MB
    die("El archivo es demasiado grande.");
}

// Procesar CSV
$handle = fopen($archivotmp, "r");
if ($handle === false) {
    die("No se pudo abrir el archivo.");
}

$header = null;
$csv = [];
while (($linea = fgetcsv($handle, 0, ";")) !== false) {
    $linea = array_map("utf8_converter", $linea);
    if (!$header) {
        $header = $linea; // Primera línea como encabezado
    } else {
        $csv[] = array_combine($header, $linea);
    }
}
fclose($handle);

// Almacenar CSV en la sesión
$_SESSION['l_csv'] = $csv;

?>
<form action="inc/guardar_csv3.php" method="post" id="guardarcsv2">
<?php
echo '<table class="table table-bordered table-sm">';
echo '<thead>';
echo '<th>CODIDM</th>';
echo '<th>IDPERSONA</th>';
echo '<th>Nro Jub.</th>';
echo '<th>Nro Pen.</th>';
echo '<th>Fecha Fall</th>';
echo '<th>Nro Exp.</th>';
echo '<th>Fecha Alta</th>';
echo '<th>Fecha Vig.</th>';
echo '<th>Fecha Cese</th>';
echo '<th>Días Imps</th>';
echo '<th>Fecha Última</th>';
echo '</thead>';
echo '<tbody>';

$c = 0;
$t = 0;
foreach ($csv as $clave => $valor) {
    $c++;
    if (isset($valor['CODIDM'], $valor['NROPEN'], $valor['NROJUBILADO']) &&
        is_numeric($valor['CODIDM']) && (!empty($valor['NROPEN']) || !empty($valor['NROJUBILADO']))) {
        $t++;
        echo '<tr>';
        echo '<td>' . htmlspecialchars($valor['CODIDM']) . '</td>';
        for ($i = 1; $i <= 10; $i++) {
            echo '<td><input class="form-control" type="text" name="col[' . $clave . '][' . $i . ']" value="' . htmlspecialchars($valor[array_keys($valor)[$i - 1]]) . '"></td>';
        }
        echo '</tr>';
    }
}

echo '</tbody>';
echo '</table>';
?>
<div class="row">
    <p>Total: <?php echo $c . ' - Para Actualizar: ' . $t; ?></p>
</div>
<div class="row">
    <div class="col-12">
        <button type="submit" class="btn btn-success" id="btnGuardarCsv">Guardar</button>
    </div>
</div>
</form>
