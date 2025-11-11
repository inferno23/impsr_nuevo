<?php
session_start();
header('Content-Type: application/json');

include("../conexion/conectar.inc.php");
include '../inc/funciones.inc';

global $conectar;

$respuesta = new stdClass();
$columnas = $_POST['column'] ?? []; // Se incluye validación por si no se envía
$cols = $_POST['col'] ?? [];

$contador = 0;
$existe = 0;
$errores = [];

foreach ($cols as $valor) {
    // Validar que existan todos los índices requeridos
    $tipo      = $valor[1] ?? '';
    $dni       = $valor[2] ?? '';
    $beneficio = $valor[3] ?? '';
    $nombre    = $valor[4] ?? '';
    $sexo      = $valor[5] ?? '';

    // Escapar datos para evitar errores o inyecciones SQL (mejor usar prepared statements)
    $tipo      = $conectar->real_escape_string($tipo);
    $dni       = $conectar->real_escape_string($dni);
    $beneficio = $conectar->real_escape_string($beneficio);
    $nombre    = $conectar->real_escape_string($nombre);
    $sexo      = $conectar->real_escape_string($sexo);

    // Verificar si el registro ya existe
    $res = $conectar->query("SELECT 1 FROM `liq_negativa` WHERE `nro_documento` = '$dni'");

    if ($res && $res->num_rows > 0) {
        $existe++;
    } else {
        $query = "INSERT INTO `liq_negativa` (`tipo_documento`, `nro_documento`, `tipo_beneficio`, `nombre`, `sexo`) 
                  VALUES ('$tipo', '$dni', '$beneficio', '$nombre', '$sexo')";
        $res2 = $conectar->query($query);
        
        if ($res2) {
            $contador++;
        } else {
            $errores[] = $conectar->error;
        }
    }
}

$respuesta->errores = $errores;
$respuesta->existe = $existe;
$respuesta->updates = $contador;

echo json_encode($respuesta, JSON_FORCE_OBJECT);
