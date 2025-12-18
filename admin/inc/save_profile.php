<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
header('Content-Type: application/json; charset=utf-8');
if (!isset($_SESSION['imps']) || empty($_SESSION['imps'])) {
    echo json_encode(['success' => false, 'error' => 'No autenticado']);
    exit;
}
$uid = isset($_POST['id']) ? intval($_POST['id']) : intval($_SESSION['imps']['IDPERSONA']);
// Conexión
$connectPath = __DIR__ . '/../functions/connect.php';
if (!file_exists($connectPath)) {
    $connectPath = __DIR__ . '/../../functions/connect.php';
}
if (!file_exists($connectPath)) {
    echo json_encode(['success' => false, 'error' => 'No se encontró el archivo de conexión a BD']);
    exit;
}
require_once $connectPath; // debe definir $con (mysqli)

// Crear tabla user_profiles si no existe (solo la primera vez)
$createSql = "CREATE TABLE IF NOT EXISTS user_profiles (
    user_id INT PRIMARY KEY,
    position VARCHAR(255) DEFAULT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    about TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
if (isset($con)) {
    $con->query($createSql);
}

$nombrecompleto = isset($_POST['nombrecompleto']) ? trim($_POST['nombrecompleto']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$position = isset($_POST['position']) ? trim($_POST['position']) : '';
$about = isset($_POST['acerca']) ? trim($_POST['acerca']) : '';
$fechanac = isset($_POST['fechanacimiento']) ? trim($_POST['fechanacimiento']) : '';
$domicilio = isset($_POST['domicilio']) ? trim($_POST['domicilio']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$full_name = $nombrecompleto;

$image_path = null;
// Manejar upload de imagen
if (!empty($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../uploads/profiles';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $f = $_FILES['imagen'];
    $ext = pathinfo($f['name'], PATHINFO_EXTENSION);
    $allowed = ['jpg','jpeg','png','gif','webp'];
    if (in_array(strtolower($ext), $allowed)) {
        $fname = 'profile_' . $uid . '_' . time() . '.' . $ext;
        $dest = $uploadDir . '/' . $fname;
        if (move_uploaded_file($f['tmp_name'], $dest)) {
            // Guardar ruta relativa
            $image_path = 'uploads/profiles/' . $fname;
        }
    }
}

if (!isset($con)) {
    echo json_encode(['success' => false, 'error' => 'No hay conexión a BD']);
    exit;
}

// Insertar o actualizar
if ($stmt = $con->prepare('SELECT user_id FROM user_profiles WHERE user_id = ?')) {
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $res = $stmt->get_result();
    $exists = $res->fetch_assoc() ? true : false;
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Error preparandose: ' . $con->error]);
    exit;
}

// Actualizar campos de personas (autoridad): APELLYNOMBRE, FECHANACIMIENTO, DOMICILIO, contacto y mail, CLAVE
// si se envían en el formulario; estos cambios deben persistir en la tabla personas.
$hasPersonas = false;
$res = $con->query("SHOW TABLES LIKE 'personas'");
if ($res && $res->num_rows > 0) { $hasPersonas = true; }
if ($hasPersonas) {
    // construir update dinámica solo con campos que vengan
    $updates = [];
    $params = [];
    $types = '';
    if (!empty($full_name)) { $updates[] = "APELLYNOMBRE = ?"; $params[] = $full_name; $types .= 's'; }
    if (!empty($fechanac)) { $updates[] = "FECHANACIMIENTO = ?"; $params[] = $fechanac; $types .= 's'; }
    if (!empty($domicilio)) { $updates[] = "DOMICILIO = ?"; $params[] = $domicilio; $types .= 's'; }
    // preferir guardar en columna celular si existe, sino TELEFONO
    $phoneCol = null;
    foreach (array('celular','telefono','TELEFONO','CELULAR') as $col) {
        $r = $con->query("SHOW COLUMNS FROM personas LIKE '" . $con->real_escape_string($col) . "'");
        if ($r && $r->num_rows > 0) { $phoneCol = $col; break; }
    }
    // email
    $emailCol = null;
    foreach (array('mail','email','MAIL','EMAIL') as $col) {
        $r = $con->query("SHOW COLUMNS FROM personas LIKE '" . $con->real_escape_string($col) . "'");
        if ($r && $r->num_rows > 0) { $emailCol = $col; break; }
    }
    // Guardar email y teléfono siempre (no solo si está vacío)
    if ($emailCol && !empty($email)) {
        $updates[] = "`$emailCol` = ?"; $params[] = $email; $types .= 's';
    }
    if ($phoneCol && !empty($phone)) {
        $updates[] = "`$phoneCol` = ?"; $params[] = $phone; $types .= 's';
    }
    // password (CLAVE) - si viene, guardarla (se sobreescribe) -> hashear antes
    $pwdCol = 'CLAVE';
    if (!empty($password)) { $hashedPwd = password_hash($password, PASSWORD_DEFAULT); $updates[] = "`$pwdCol` = ?"; $params[] = $hashedPwd; $types .= 's'; }

    if (!empty($updates)) {
        $sql = 'UPDATE personas SET ' . implode(', ', $updates) . ' WHERE IDPERSONA = ?';
        $params[] = $uid; $types .= 'i';
        $stmtu = $con->prepare($sql);
        if ($stmtu) {
            $bind_names = array();
            $bind_names[] = $types;
            for ($i=0;$i<count($params);$i++) {
                $bind_name = 'bind' . $i;
                $$bind_name = $params[$i];
                $bind_names[] = &$$bind_name;
            }
            call_user_func_array(array($stmtu,'bind_param'), $bind_names);
            $stmtu->execute();
            $stmtu->close();
        }
    }
}

// Actualizar o insertar solo los campos de user_profiles que pertenecen a este perfil extendido
if ($exists) {
    if ($image_path) {
        $sql = 'UPDATE user_profiles SET position=?, image_path=?, about=? WHERE user_id=?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssi', $position, $image_path, $about, $uid);
    } else {
        $sql = 'UPDATE user_profiles SET position=?, about=? WHERE user_id=?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssi', $position, $about, $uid);
    }
    $ok = $stmt->execute();
    if (!$ok) {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
        exit;
    }
    $stmt->close();
} else {
    $sql = 'INSERT INTO user_profiles (user_id, position, image_path, about) VALUES (?, ?, ?, ?)';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('isss', $uid, $position, $image_path, $about);
    $ok = $stmt->execute();
    if (!$ok) {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
        exit;
    }
    $stmt->close();
}

// Responder con el perfil actualizado (merge personas + user_profiles)
$profile = null;
if (isset($con)) {
    $person = null;
    if ($stmt = $con->prepare('SELECT IDPERSONA, APELLYNOMBRE, FECHANACIMIENTO, DOMICILIO, TELEFONO, celular, mail FROM personas WHERE IDPERSONA = ? LIMIT 1')) {
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $person = $res->fetch_assoc();
        $stmt->close();
    }
    $extra = null;
    if ($stmt = $con->prepare('SELECT user_id, position, image_path, about FROM user_profiles WHERE user_id = ?')) {
        $stmt->bind_param('i', $uid);
        $stmt->execute();
        $res = $stmt->get_result();
        $extra = $res->fetch_assoc();
        $stmt->close();
    }
    if ($person || $extra) {
        $profile = [];
        if ($person) {
            $profile['user_id'] = $person['IDPERSONA'];
            $profile['full_name'] = $person['APELLYNOMBRE'];
            $profile['fechanacimiento'] = $person['FECHANACIMIENTO'];
            $profile['domicilio'] = $person['DOMICILIO'];
            $profile['phone'] = !empty($person['celular']) ? $person['celular'] : $person['TELEFONO'];
            $profile['email'] = $person['mail'];
        }
        if ($extra) {
            $profile['position'] = $extra['position'];
            $profile['image_path'] = $extra['image_path'];
            $profile['about'] = $extra['about'];
        }
    }
}
if ($profile) {
    if (!empty($profile['image_path'])) {
        $candidate = __DIR__ . '/../' . $profile['image_path'];
        if (file_exists($candidate)) {
            $profile['image_url'] = dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/' . $profile['image_path'];
        } else {
            $profile['image_url'] = $profile['image_path'];
        }
    } else {
        $profile['image_url'] = null;
    }
}

echo json_encode(['success' => true, 'profile' => $profile]);
