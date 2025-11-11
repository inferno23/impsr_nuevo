<?php
session_start();
header('Content-Type: application/json');

// Verificar autenticación
if (!isset($_SESSION['imps'])) {
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

// Verificar que se proporcione el ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['success' => false, 'error' => 'ID de licitación no proporcionado']);
    exit;
}

include '../conexion/conectar.inc';
global $conectar;

function logError($message) {
    error_log("Error en carga_licitacion.php: " . $message);
}

try {
    $id = intval($_GET['id']);
    
    // Consulta preparada para obtener los datos de la licitación
    $sql = "SELECT * 
            FROM licitaciones WHERE id = ?";
    
    $stmt = $conectar->prepare($sql);
    
    if (!$stmt) {
        logError("Error preparando consulta: " . $conectar->error);
        echo json_encode(['success' => false, 'error' => 'Error interno del servidor']);
        exit;
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'error' => 'Licitación no encontrada']);
        exit;
    }
    
    $row = $result->fetch_assoc();
    
    // Formatear las fechas para el input datetime-local
    if (!empty($row['apertura'])) {
        $fechaApertura = new DateTime($row['apertura']);
        $row['apertura'] = $fechaApertura->format('Y-m-d');
    }
    if (!empty($row['fecha'])) {
        $fechaCierre = new DateTime($row['fecha']);
        $row['fecha'] = $fechaCierre->format('Y-m-d\TH:i');
    }
    
    // Convertir activo a entero
    $row['activo'] = intval($row['activo']);
    // Asegurar que los nuevos campos estén presentes
    $row['expediente'] = $row['expediente'] ?? '';
    $row['codigo_ano'] = $row['codigo_ano'] ?? '';
    $row['codigo_mes'] = $row['codigo_mes'] ?? '';
    $row['presupuesto'] = $row['presupuesto'] ?? '';
    $row['costo_pliego'] = $row['costo_pliego'] ?? '';
    $row['costo_oferta'] = $row['costo_oferta'] ?? '';
    $row['costo_impugnacion'] = $row['costo_impugnacion'] ?? '';
    echo json_encode(['success' => true, 'data' => $row]);
    
    $stmt->close();
    //echo json_encode($respuesta, JSON_FORCE_OBJECT);

    
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