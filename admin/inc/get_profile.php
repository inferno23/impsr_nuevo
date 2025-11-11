<?php
// Devuelve el perfil del usuario en JSON
if (session_status() === PHP_SESSION_NONE) { session_start(); }
header('Content-Type: application/json; charset=utf-8');
if (!isset($_SESSION['imps']) || empty($_SESSION['imps'])) {
    echo json_encode(['success' => false, 'error' => 'No autenticado']);
    exit;
}
$uid = isset($_GET['user_id']) ? intval($_GET['user_id']) : intval($_SESSION['imps']['IDPERSONA']);
// Conexión
$connectPath = __DIR__ . '/../functions/connect.php';
if (!file_exists($connectPath)) {
    // intentar desde public root
    $connectPath = __DIR__ . '/../../functions/connect.php';
}
if (!file_exists($connectPath)) {
    echo json_encode(['success' => false, 'error' => 'No se encontró el archivo de conexión a BD']);
    exit;
}
require_once $connectPath; // debe definir $con (mysqli)

// Obtener datos de personas (autoritativos)
$profile = null;
if (isset($con)) {
    // Leer desde personas
    $person = null;
    if ($stmt = $con->prepare('SELECT IDPERSONA, APELLYNOMBRE, FECHANACIMIENTO, DOMICILIO, TELEFONO, celular, mail FROM personas WHERE IDPERSONA = ? LIMIT 1')) {
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $person = $res->fetch_assoc();
        $stmt->close();
    }

    // Leer extras desde user_profiles
    $extra = null;
    if ($stmt = $con->prepare('SELECT user_id, position, image_path, about FROM user_profiles WHERE user_id = ?')) {
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $extra = $res->fetch_assoc();
        $stmt->close();
    }

    // Merge
    if ($person || $extra) {
        $profile = [];
        // From personas
        if ($person) {
            $profile['user_id'] = $person['IDPERSONA'];
            $profile['full_name'] = $person['APELLYNOMBRE'];
            $profile['fechanacimiento'] = $person['FECHANACIMIENTO'];
            $profile['domicilio'] = $person['DOMICILIO'];
            // prefer celular over TELEFONO
            $profile['phone'] = !empty($person['celular']) ? $person['celular'] : $person['TELEFONO'];
            $profile['email'] = $person['mail'];
        }
        // From extras (user_profiles)
        if ($extra) {
            $profile['position'] = $extra['position'];
            $profile['image_path'] = $extra['image_path'];
            $profile['about'] = $extra['about'];
        }
    }
}

if ($profile) {
    // Normalizar rutas de imagen
    if (!empty($profile['image_path'])) {
        // ruta relativa creada por save_profile: uploads/profiles/xxx
        $candidate = __DIR__ . '/../' . $profile['image_path'];
        if (file_exists($candidate)) {
            $profile['image_url'] = dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/' . $profile['image_path'];
        } else {
            $profile['image_url'] = $profile['image_path'];
        }
    } else {
        $profile['image_url'] = null;
    }
    // Añadir debug para diagnóstico: person y extra sin procesar y la sesión (solo claves relevantes)
    $debug = ['person_raw' => $person, 'extra_raw' => $extra, 'session' => isset($_SESSION['imps']) ? $_SESSION['imps'] : null];
    echo json_encode(['success' => true, 'profile' => $profile, 'debug' => $debug]);
} else {
    $debug = ['person_raw' => $person, 'extra_raw' => $extra, 'session' => isset($_SESSION['imps']) ? $_SESSION['imps'] : null];
    echo json_encode(['success' => true, 'profile' => null, 'debug' => $debug]);
}