<?php
// inc/eliminar_tipo.php
header('Content-Type: application/json');
require_once '../conexion/conectar.inc';

$response = ["success" => false];

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $response["error"] = "ID inválido";
    echo json_encode($response);
    exit;
}

$id = intval($_POST['id']);

// Conexión
if (!isset($conectar)) {
    global $conectar;
}

if (!$conectar) {
    $response["error"] = "No se pudo conectar a la base de datos";
    echo json_encode($response);
    exit;
}

$stmt = $conectar->prepare("DELETE FROM normativa_tipo WHERE id = ?");
if ($stmt) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $response["success"] = true;
    } else {
        $response["error"] = "No se pudo eliminar el registro";
    }
    $stmt->close();
} else {
    $response["error"] = "Error en la consulta";
}

echo json_encode($response);
