<?php
include 'functions/connect.php';

// Verifica que la conexión esté establecida
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

$dir = 'recibos-sueldo/SINDICATO';
$id = '25959';

// Verifica si el directorio existe
if (!is_dir($dir)) {
    die("El directorio especificado no existe: $dir");
}

// Obtén los archivos del directorio
$recibos = preg_grep('/^([^.])/', scandir($dir));

// Verifica si se obtuvieron archivos
if ($recibos === false) {
    die("Error al leer los archivos del directorio.");
}

echo count($recibos) . " archivos <br>";

// Limpia la tabla antes de insertar nuevos datos
$sql = "DELETE FROM recibos_sindicato";
if (!$con->query($sql)) {
    die("Error al limpiar la tabla: " . $con->error);
}

// Procesa cada archivo
foreach ($recibos as $valor) {
    $pos = strpos($valor, '.');
    if ($pos !== false) {
        $nuevo = uniqid();
        $archivo = $dir . '/' . $nuevo;

        // Renombra el archivo
        if (rename($dir . '/' . $valor, $archivo)) {
            // Escapa los valores para evitar inyecciones SQL
            $valorEscapado = $con->real_escape_string($valor);
            $archivoEscapado = $con->real_escape_string($archivo);

            $sql = "INSERT INTO `recibos_sindicato`(`nombre`, `archivo`) VALUES ('$valorEscapado', '$archivoEscapado')";
            if ($con->query($sql)) {
                echo "$valor a $nuevo<br>";
            } else {
                echo "Error al insertar en la base de datos: " . $con->error . "<br>";
            }
        } else {
            echo "Error al renombrar el archivo: $valor<br>";
        }
    }
}

// Cierra la conexión
$con->close();
?>
