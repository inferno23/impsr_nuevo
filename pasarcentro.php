<?php
include 'functions/connect.php';

$dir = 'recibos-sueldo/CENTRO';
$id = '25959'; // Esta variable no parece usarse, ¿es necesaria?

// Verificar si el directorio existe
if (!is_dir($dir)) {
    die("El directorio $dir no existe.");
}

// Escanear el directorio
$recibos = preg_grep('/^([^.])/', scandir($dir));
echo count($recibos) . ' archivos <br>';

// Borrar los registros existentes
$sqlDelete = "DELETE FROM recibos_centro";
if (!$con->query($sqlDelete)) {
    die("Error al borrar registros: " . $con->error);
}

// Procesar los archivos
foreach ($recibos as $valor) {
    $pos = strpos($valor, '.');
    if ($pos !== false) {
        $nuevo = uniqid();
        $archivo = $dir . '/' . $nuevo;

        // Renombrar el archivo
        if (rename($dir . '/' . $valor, $archivo)) {
            // Insertar el registro en la base de datos usando consultas preparadas
            $stmt = $con->prepare("INSERT INTO recibos_centro (nombre, archivo) VALUES (?, ?)");
            $stmt->bind_param("ss", $valor, $archivo);

            if ($stmt->execute()) {
                echo "$valor renombrado a $nuevo<br>";
            } else {
                echo "Error al insertar en la base de datos: " . $stmt->error . "<br>";
            }

            $stmt->close();
        } else {
            echo "Error al renombrar el archivo $valor<br>";
        }
    }
}
?>
