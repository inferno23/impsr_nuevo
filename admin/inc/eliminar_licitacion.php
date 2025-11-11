<?php
session_start();
header('Content-Type: application/json');

// Verificar autenticación
if (!isset($_SESSION['imps'])) {
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

// Verificar que se proporcione el ID
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(['success' => false, 'error' => 'ID de licitación no proporcionado']);
    exit;
}

include '../conexion/conectar.inc';
global $conectar;

function logError($message) {
    error_log("Error en eliminar_licitacion.php: " . $message);
}

try {
    $id = intval($_POST['id']);
    
    // Verificar que la licitación existe
    $checkQuery = "SELECT id, titulo FROM licitaciones WHERE id = ?";
    $stmtCheck = $conectar->prepare($checkQuery);
    
    if (!$stmtCheck) {
        logError("Error preparando consulta de verificación: " . $conectar->error);
        echo json_encode(['success' => false, 'error' => 'Error interno del servidor']);
        exit;
    }
    
    $stmtCheck->bind_param("i", $id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    
    if ($resultCheck->num_rows === 0) {
        echo json_encode(['success' => false, 'error' => 'La licitación no existe']);
        exit;
    }
    
    $licitacion = $resultCheck->fetch_assoc();
    $stmtCheck->close();
    
    // Iniciar transacción
    $conectar->autocommit(false);
    
    try {
        // Eliminar archivos asociados si existen (tabla licitaciones_archivos)
        $deleteArchivosQuery = "DELETE FROM licitaciones_archivos WHERE id_licitacion = ?";
        $stmtArchivos = $conectar->prepare($deleteArchivosQuery);
        
        if ($stmtArchivos) {
            $stmtArchivos->bind_param("i", $id);
            $stmtArchivos->execute();
            $stmtArchivos->close();
        }
        
        // Eliminar la licitación
        $deleteQuery = "DELETE FROM licitaciones WHERE id = ?";
        $stmtDelete = $conectar->prepare($deleteQuery);
        
        if (!$stmtDelete) {
            throw new Exception("Error preparando consulta de eliminación: " . $conectar->error);
        }
        
        $stmtDelete->bind_param("i", $id);
        
        if (!$stmtDelete->execute()) {
            throw new Exception("Error ejecutando eliminación: " . $stmtDelete->error);
        }
        
        if ($stmtDelete->affected_rows === 0) {
            throw new Exception("No se pudo eliminar la licitación");
        }
        
        $stmtDelete->close();
        
        // Confirmar transacción
        $conectar->commit();
        
        echo json_encode([
            'success' => true, 
            'message' => 'Licitación "' . $licitacion['titulo'] . '" eliminada exitosamente'
        ]);
        
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $conectar->rollback();
        logError("Error en transacción: " . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Error al eliminar la licitación: ' . $e->getMessage()]);
    }
    
    // Restaurar autocommit
    $conectar->autocommit(true);
    
} catch (Exception $e) {
    logError("Excepción capturada: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Error interno del servidor']);
} catch (Error $e) {
    logError("Error fatal: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Error interno del servidor']);
} finally {
    if (isset($conectar)) {
        $conectar->close();
    }
}
?>