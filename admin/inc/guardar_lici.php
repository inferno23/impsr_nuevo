<?php
session_start();
header('Content-Type: application/json');
ini_set('log_errors', TRUE);
ini_set('error_reporting', E_ALL);
ini_set('error_log', 'error_log1.txt');

$respuesta = new stdClass;
global $conectar;
include '../conexion/conectar.inc';
include 'simpleimage.inc.php';
include 'funciones.inc';


function sanitizeInput($data) {
       
///print_r($data);
    return [
        'id' => isset($data['id']) ? intval($data['id']) : null,
         'codigo' => htmlspecialchars(trim($data['codigo'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'expediente' => htmlspecialchars(trim($data['expediente'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'codigo_ano' => isset($data['codigo_ano']) ? intval($data['codigo_ano']) : null,
        'codigo_mes' => isset($data['codigo_mes']) ? intval($data['codigo_mes']) : null,
        'presupuesto' => !empty($data['presupuesto']) ? floatval($data['presupuesto']) : null,
        'costo_pliego' => !empty($data['costo_pliego']) ? floatval($data['costo_pliego']) : null,
        'costo_oferta' => !empty($data['costo_oferta']) ? floatval($data['costo_oferta']) : null,
        'costo_impugnacion' => !empty($data['costo_impugnacion']) ? floatval($data['costo_impugnacion']) : null,
        'titulo' => htmlspecialchars(trim($data['titulo'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'descripcion' => htmlspecialchars(trim($data['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'apertura' => $data['apertura'] ?? '',
        'fecha' => $data['fecha'] ?? '',
        'id_estado' => isset($data['id_estado']) ? intval($data['id_estado']) : 0,
        'id_tipo' => isset($data['id_tipo']) ? intval($data['id_tipo']) : 0,
        'id_reparticion' => isset($data['id_reparticion']) ? intval($data['id_reparticion']) : 0,
        'activo' => isset($data['activo']) ? 1 : 0
       
    ];
}

function validateLicitacion($data) {
    $errors = [];
    if (empty($data['codigo'])) $errors[] = 'El número es obligatorio';
    if (empty($data['titulo'])) $errors[] = 'El título es obligatorio';
    if (empty($data['descripcion'])) $errors[] = 'La descripción es obligatoria';
    if (empty($data['apertura'])) $errors[] = 'La fecha de apertura es obligatoria';
    if (empty($data['fecha'])) $errors[] = 'La fecha de licitación es obligatoria';
    if ($data['id_estado'] <= 0) $errors[] = 'Debe seleccionar un estado';
    if ($data['id_tipo'] <= 0) $errors[] = 'Debe seleccionar un tipo';
    if ($data['id_reparticion'] <= 0) $errors[] = 'Debe seleccionar una repartición';
    if (!empty($data['apertura']) && !empty($data['fecha'])) {
        $apertura = new DateTime($data['apertura']);
        $cierre = new DateTime($data['fecha']);
        if ($cierre <= $apertura) $errors[] = 'La fecha debe ser posterior a la fecha de apertura';
    }
    return $errors;
}

try {
    $data = sanitizeInput($_POST);
    $validationErrors = validateLicitacion($data);
    if (!empty($validationErrors)) {
        $respuesta->success = false;
        $respuesta->error = implode('. ', $validationErrors);
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
        exit;
    }

    // Verificar duplicado de código (excepto edición)
    $sqlCheck = "SELECT id FROM licitaciones WHERE codigo = ?" . (!empty($data['id']) ? " AND id != ?" : "");
    $stmtCheck = $conectar->prepare($sqlCheck);
    if (!empty($data['id'])) {
        $stmtCheck->bind_param("si", $data['codigo'], $data['id']);
    } else {
        $stmtCheck->bind_param("s", $data['codigo']);
    }
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    if ($resultCheck && $resultCheck->num_rows > 0) {
        $respuesta->success = false;
        $respuesta->error = 'Ya existe una licitación con ese número';
        echo json_encode($respuesta, JSON_FORCE_OBJECT);
        exit;
    }
    $stmtCheck->close();

    // Guardar o editar
    if (empty($data['id'])) {
        $sql = "INSERT INTO licitaciones (codigo, expediente, codigo_ano, codigo_mes, presupuesto, costo_pliego, costo_oferta, costo_impugnacion, titulo, descripcion, apertura, fecha, id_estado, id_tipo, id_reparticion, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conectar->prepare($sql);
        if (!$stmt) throw new Exception('Error preparando la consulta de inserción');
        $stmt->bind_param(
            "ssiiidddssssiii", 
            $data['codigo'], $data['expediente'], $data['codigo_ano'], $data['codigo_mes'], $data['presupuesto'], $data['costo_pliego'], $data['costo_oferta'], $data['costo_impugnacion'],
            $data['titulo'], $data['descripcion'], $data['apertura'], $data['fecha'], $data['id_estado'], $data['id_tipo'], $data['id_reparticion'], $data['activo']
        );
    } else {
        $sql = "UPDATE licitaciones SET codigo=?, expediente=?, codigo_ano=?, codigo_mes=?, presupuesto=?, costo_pliego=?, costo_oferta=?, costo_impugnacion=?, titulo=?, descripcion=?, apertura=?, fecha=?, id_estado=?, id_tipo=?, id_reparticion=?, activo=? WHERE id=?";
        $stmt = $conectar->prepare($sql);
        if (!$stmt) throw new Exception('Error preparando la consulta de actualización');
        $stmt->bind_param(
            "ssiiidddssssiiiis", 
            $data['codigo'], $data['expediente'], $data['codigo_ano'], $data['codigo_mes'], $data['presupuesto'], $data['costo_pliego'], $data['costo_oferta'], $data['costo_impugnacion'],
            $data['titulo'], $data['descripcion'], $data['apertura'], $data['fecha'], $data['id_estado'], $data['id_tipo'], $data['id_reparticion'], $data['activo'], $data['id']
        );
    }
    if (!$stmt->execute()) {
        throw new Exception("Error al guardar: " . $stmt->error);
    }
    $respuesta->success = true;
    if (empty($data['id'])) {
        $respuesta->message = 'Licitación creada exitosamente';
        $respuesta->id = $conectar->insert_id;
    } else {
        $respuesta->message = 'Licitación actualizada exitosamente';
        $respuesta->id = $data['id'];
    }
    $stmt->close();
} catch (Exception $e) {
    error_log("Error en Lici.php: " . $e->getMessage());
    $respuesta->success = false;
    $respuesta->error = $e->getMessage();
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>