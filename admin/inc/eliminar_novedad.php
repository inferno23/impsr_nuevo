<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['imps'])){
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit;
}

include '../conexion/conectar.inc';
global $conectar;

$respuesta = new stdClass;

try {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        throw new Exception('ID de novedad no proporcionado');
    }

    $id = intval($_POST['id']);
    
    // Primero obtener información de la imagen para eliminarla
    $query = "SELECT imagen FROM novedades WHERE id = ?";
    $stmt = $conectar->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $imagen = $row['imagen'];
        
        // Eliminar el registro de la base de datos
        $deleteQuery = "DELETE FROM novedades WHERE id = ?";
        $deleteStmt = $conectar->prepare($deleteQuery);
        $deleteStmt->bind_param("i", $id);
        
        if ($deleteStmt->execute()) {
            // Si se eliminó correctamente y hay imagen, eliminar archivo
            if (!empty($imagen) && file_exists('../../' . $imagen)) {
                unlink('../../' . $imagen);
            }
            
            $respuesta->success = true;
            $respuesta->message = 'Novedad eliminada exitosamente';
        } else {
            throw new Exception('Error al eliminar la novedad: ' . $conectar->error);
        }
    } else {
        throw new Exception('Novedad no encontrada');
    }

} catch (Exception $e) {
    error_log("Error en eliminar_novedad.php: " . $e->getMessage());
    $respuesta->success = false;
    $respuesta->error = $e->getMessage();
}

echo json_encode($respuesta);
?>