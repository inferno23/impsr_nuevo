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

function extension($filename){
    return substr(strrchr($filename, '.'), 1);
}

function validateInput($data) {
    $errors = [];
    
    // Validar título
    if (empty(trim($data['titulo']))) {
        $errors[] = 'El título es obligatorio';
    }
    
    // Validar fecha
    if (empty($data['fecha'])) {
        $errors[] = 'La fecha es obligatoria';
    } elseif (!DateTime::createFromFormat('Y-m-d', $data['fecha'])) {
        $errors[] = 'La fecha debe tener un formato válido';
    }
    
    // Validar sección
    if (empty($data['seccion'])) {
        $errors[] = 'Debe seleccionar una sección';
    }
    
    // Validar contenido
    if (empty(trim($data['contenido']))) {
        $errors[] = 'El contenido es obligatorio';
    }
    
    // Validar link si se proporciona
    if (!empty($data['link']) && !filter_var($data['link'], FILTER_VALIDATE_URL)) {
        $errors[] = 'El link debe ser una URL válida';
    }
    
    return $errors;
}

function sanitizeInput($data) {
    return [
        'id' => isset($data['id']) ? intval($data['id']) : null,
        'titulo' => htmlspecialchars(trim($data['titulo']), ENT_QUOTES, 'UTF-8'),
        'subtitulo' => htmlspecialchars(trim($data['subtitulo']), ENT_QUOTES, 'UTF-8'),
        'contenido' => trim($data['contenido']), // Mantener HTML del editor
        'link' => filter_var($data['link'], FILTER_SANITIZE_URL),
        'fecha' => $data['fecha'],
        'seccion' => intval($data['seccion']),
        'activo' => isset($data['activo']) ? 1 : 0,
        'principal' => isset($data['principal']) ? 1 : 0,
        'imagenold' => isset($data['imagenold']) ? $data['imagenold'] : ''
    ];
}

try {
    // Validar entrada
    $validationErrors = validateInput($_POST);
    if (!empty($validationErrors)) {
        throw new Exception(implode(', ', $validationErrors));
    }
    
    // Sanitizar datos
    $data = sanitizeInput($_POST);
    
    // Manejo de imagen
    $imagen = $data['imagenold']; // Mantener imagen anterior por defecto
    
    if (!empty($_FILES['imagen']['name']) && is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        // Validar archivo de imagen
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $fileInfo = getimagesize($_FILES['imagen']['tmp_name']);
        
        if ($fileInfo === false) {
            throw new Exception('El archivo no es una imagen válida');
        }
        
        $mimeType = $fileInfo['mime'];
        if (!in_array($mimeType, $allowedTypes)) {
            throw new Exception('Tipo de archivo no permitido. Solo se permiten JPEG, PNG y GIF');
        }
        
        // Validar tamaño (máximo 5MB)
        if ($_FILES['imagen']['size'] > 5 * 1024 * 1024) {
            throw new Exception('El archivo es demasiado grande. Máximo 5MB permitido');
        }
        
        // Procesar imagen
        $nameold = $_FILES['imagen']['name'];
        $extension = extension($nameold);
        $name = uniqid() . '_novedad.' . $extension;
        
        try {
            $image = new abeautifulsite\SimpleImage($_FILES['imagen']['tmp_name']);
            $image->fit_to_height(400);
            
            // Crear directorio si no existe
            $uploadDir = '../../img/novedades/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $image->save($uploadDir . $name);
            $imagen = 'img/novedades/' . $name;
            
            // Eliminar imagen anterior si existe y es diferente
            if (!empty($data['imagenold']) && $data['imagenold'] !== $imagen && file_exists('../../' . $data['imagenold'])) {
                unlink('../../' . $data['imagenold']);
            }
            
        } catch (Exception $e) {
            throw new Exception('Error al procesar la imagen: ' . $e->getMessage());
        }
    }
    
    // Preparar consulta usando prepared statements para seguridad
    if (empty($data['id'])) {
        // Insertar nueva novedad
        $stmt = $conectar->prepare("INSERT INTO novedades (principal, seccion, titulo, subtitulo, contenido, link, fecha, imagen, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssssi", 
            $data['principal'], 
            $data['seccion'], 
            $data['titulo'], 
            $data['subtitulo'], 
            $data['contenido'], 
            $data['link'], 
            $data['fecha'], 
            $imagen, 
            $data['activo']
        );
    } else {
        // Actualizar novedad existente
        $stmt = $conectar->prepare("UPDATE novedades SET principal=?, seccion=?, titulo=?, subtitulo=?, contenido=?, link=?, fecha=?, imagen=?, activo=? WHERE id=?");
        $stmt->bind_param("iissssssii", 
            $data['principal'], 
            $data['seccion'], 
            $data['titulo'], 
            $data['subtitulo'], 
            $data['contenido'], 
            $data['link'], 
            $data['fecha'], 
            $imagen, 
            $data['activo'], 
            $data['id']
        );
    }
    
    if (!$stmt->execute()) {
        throw new Exception("Error al guardar: " . $stmt->error);
    }
    
    $respuesta->success = true;
    $respuesta->message = empty($data['id']) ? 'Novedad creada exitosamente' : 'Novedad actualizada exitosamente';
    
} catch (Exception $e) {
    error_log("Error en guardar_novedad.php: " . $e->getMessage());
    $respuesta->success = false;
    $respuesta->error = $e->getMessage();
}

// Respuesta en JSON
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>