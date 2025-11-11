<?php
session_start();
header('Content-Type: application/json');

include '../conexion/conectar.inc';
include '../inc/funciones.inc';

global $conectar;

$respuesta = new stdClass();

// Verifica si se enviaron los campos esperados
$columnas = $_POST['column'] ?? [];
$cols = $_POST['col'] ?? [];

$contador = 0;
$existe = 0;
$querys = [];
$errores = [];

foreach ($cols as $valor) {
    // Validación para evitar errores si el array no tiene todos los índices
    $nroexpte = $valor[1] ?? '';
    $titular  = $valor[2] ?? '';
    $tramite  = $valor[3] ?? '';
    $destino  = $valor[4] ?? '';
    $fecha    = $valor[5] ?? '';

    // Evitar SQL injection (mejor usar consultas preparadas, pero se mantiene estructura original)
    $nroexpte = $conectar->real_escape_string($nroexpte);
    $titular  = $conectar->real_escape_string($titular);
    $tramite  = $conectar->real_escape_string($tramite);
    $destino  = $conectar->real_escape_string($destino);
    $fecha    = $conectar->real_escape_string($fecha);

    // Comprobar si el registro ya existe
    $res = $conectar->query("SELECT * FROM mov_exped WHERE nroexpte='$nroexpte' AND destino='$destino' AND fecha='$fecha'");

    if ($res && $res->num_rows > 0) {
        $existe++;
    } else {
        $query = "INSERT INTO mov_exped (nroexpte, titular, tramite, destino, fecha) VALUES ('$nroexpte', '$titular', '$tramite', '$destino', '$fecha')";
        $querys[] = $query;

        if ($conectar->query($query)) {
            $contador++;
            $errores[] = null;
        } else {
            $errores[] = $conectar->error;
        }
    }
}

// Armado del objeto de respuesta
$respuesta->querys = $querys;
$respuesta->errores = $errores;
$respuesta->existe = $existe;
$respuesta->updates = $contador;

// Respuesta en formato JSON
echo json_encode($respuesta, JSON_FORCE_OBJECT);
