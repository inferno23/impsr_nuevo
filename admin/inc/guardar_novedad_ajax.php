<?php
// admin/inc/guardar_novedad_ajax.php
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';

header('Content-Type: application/json');

if (!isset($_SESSION['imps'])) {
    echo json_encode(['success' => false, 'error' => 'No autorizado']);
    exit;
}

// Validar datos
$seccion = $_POST['seccion'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$titulo = $_POST['titulo'] ?? '';
$subtitulo = $_POST['subtitulo'] ?? '';
$contenido = $_POST['contenido'] ?? '';
$link = $_POST['link'] ?? '';
$principal = isset($_POST['principal']) ? 1 : 0;
$activo = isset($_POST['activo']) ? 1 : 0;

if ($seccion == '' || $fecha == '' || $titulo == '' || $contenido == '') {
    echo json_encode(['success' => false, 'error' => 'Faltan datos obligatorios']);
    exit;
}

// Procesar imagen
$imagen = '';
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $imgDir = '../../img/novedades/';
    if (!is_dir($imgDir)) {
        mkdir($imgDir, 0777, true);
    }
    $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $imgName = uniqid('novedad_') . '.' . $ext;
    $imgPath = $imgDir . $imgName;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imgPath)) {
        $imagen = 'img/novedades/' . $imgName;
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al subir la imagen']);
        exit;
    }
}

// Insertar novedad
global $conectar;
$id = $_POST['id'] ?? '';
if (!empty($id)) {
    // UPDATE novedad existente
    if ($imagen !== '') {
        $stmt = $conectar->prepare("UPDATE novedades SET seccion=?, fecha=?, titulo=?, subtitulo=?, contenido=?, link=?, principal=?, activo=?, imagen=? WHERE id=?");
        $stmt->bind_param('ssssssiisi', $seccion, $fecha, $titulo, $subtitulo, $contenido, $link, $principal, $activo, $imagen, $id);
    } else {
        $stmt = $conectar->prepare("UPDATE novedades SET seccion=?, fecha=?, titulo=?, subtitulo=?, contenido=?, link=?, principal=?, activo=? WHERE id=?");
        $stmt->bind_param('ssssssiis', $seccion, $fecha, $titulo, $subtitulo, $contenido, $link, $principal, $activo, $id);
    }
    if ($stmt->execute()) {
        // Obtener la novedad actualizada
        $query = "SELECT a.*, b.nombre as nomseccion FROM novedades a LEFT JOIN novedades_secciones b ON a.seccion=b.id WHERE a.id=?";
        $stmt2 = $conectar->prepare($query);
        $stmt2->bind_param('i', $id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'novedad' => $row]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al actualizar novedad']);
    }
    $stmt->close();
} else {
    // INSERTAR nueva novedad
    $stmt = $conectar->prepare("INSERT INTO novedades (seccion, fecha, titulo, subtitulo, contenido, link, principal, activo, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssiis', $seccion, $fecha, $titulo, $subtitulo, $contenido, $link, $principal, $activo, $imagen);
    if ($stmt->execute()) {
        $id = $stmt->insert_id;
        // Obtener la novedad insertada
        $query = "SELECT a.*, b.nombre as nomseccion FROM novedades a LEFT JOIN novedades_secciones b ON a.seccion=b.id WHERE a.id=?";
        $stmt2 = $conectar->prepare($query);
        $stmt2->bind_param('i', $id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'novedad' => $row]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error al guardar novedad']);
    }
    $stmt->close();
}
