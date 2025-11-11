<?php
include '../conexion/conectar.inc';// Conexión a la base de datos
global $conectar;
$response = new stdClass();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $query = "DELETE FROM turnos WHERE id = '$id'";
    $res = $conectar->query($query);

    if ($res) {
        $response->success = true;
    } else {
        $response->success = false;
        $response->error = $conectar->error;
    }
} else {
    $response->success = false;
    $response->error = "ID no recibido";
}

echo json_encode($response);
?>
