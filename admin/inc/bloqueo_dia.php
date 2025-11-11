<?php
session_start();
header('Content-Type: application/json');

$respuesta = new stdClass;
global $conectar;
include '../conexion/conectar.inc.php';

if ($conectar->connect_error) {
    die('Error de conexión: ' . $conectar->connect_error);
}
  ///echo('_POSTfechas'.$_POST['fechas'].$_POST['id_seccion'].'--sub_seccion'.$_POST['sub_seccion'].'-condicion:'.$_POST['condicion']);
// Validar entradas  

// Si se solicita eliminación explícita
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    if (!isset($_POST['id'])) {
        echo 'ID faltante para eliminación.';
        exit;
    }

    $id_del = intval($_POST['id']);
    $delStmt = $conectar->prepare("DELETE FROM turnos_feriados WHERE id = ?");
    if (!$delStmt) {
        echo 'Error en la preparación de la consulta de eliminación.';
        exit;
    }
    $delStmt->bind_param('i', $id_del);
    if ($delStmt->execute()) {
        echo "Se eliminó el feriado (id=$id_del).";
    } else {
        echo 'No se pudo eliminar el feriado.';
    }
    $delStmt->close();
    $conectar->close();
    exit;
}

// Validar entradas para inserción
if (
    !isset($_POST['fechas']) || !is_array($_POST['fechas']) ||
    !isset($_POST['id_seccion']) ||
    !isset($_POST['sub_seccion']) ||
    !isset($_POST['condicion'])
) {
    echo 'Datos incompletos para guardar.';
    exit;
}

$fechas = $_POST['fechas'];
$id_seccion = intval($_POST['id_seccion']);
$sub_seccion = $conectar->real_escape_string($_POST['sub_seccion']);
$condicion = $conectar->real_escape_string($_POST['condicion']);

$stmt = $conectar->prepare("INSERT INTO turnos_feriados (id_seccion, fecha, sub_seccion, condicion) VALUES (?, ?, ?, ?)");
$guardadas = 0;

foreach ($fechas as $fecha) {
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
        $stmt->bind_param('isss', $id_seccion, $fecha, $sub_seccion, $condicion);
        if ($stmt->execute()) {
            $guardadas++;
        }
    }
}

$stmt->close();
$conectar->close();

if ($guardadas > 0) {
    echo "Se guardaron $guardadas fecha(s) correctamente.";
} else {
    echo "No se guardó ninguna fecha.";
}
?>
