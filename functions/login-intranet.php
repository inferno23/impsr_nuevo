<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include_once 'constants.php';
include_once 'connect.php';
//include_once 'permissions.php';

$respuesta = new stdClass();

// Verificamos que los datos necesarios estén presentes.
if (!isset($_POST['username'], $_POST['password'])) {
    $respuesta->success = false;
    $respuesta->mensaje = "Por favor, completa ambos campos: usuario y contraseña.";
    echo json_encode($respuesta);
    exit;
}

// Ejecutamos la consulta para buscar el usuario.
$stmt = buscarUsuario();

if ($stmt && $stmt->num_rows > 0) {
    $stmt->bind_result($IDPERSONA, $LEGAJO, $CLAVE, $APELLYNOMBRE);
    $stmt->fetch();

    $claveIngresada = trim($_POST['password']);
    $claveGuardada = trim($CLAVE);
    $ok = password_verify($claveIngresada, $claveGuardada);

    // Verificamos la contraseña.
    if ($ok || $claveIngresada === $claveGuardada) {
        session_regenerate_id();
        $_SESSION['loggedin'] = true;
        $_SESSION['NOMBREUSUARIO'] = $LEGAJO;
        $_SESSION['id'] = $IDPERSONA;
        $_SESSION['APELLYNOMBRE'] = $APELLYNOMBRE;
        $_SESSION['empleado'] = true;
       // $_SESSION['can-change-passwords'] = CanChangeUserPassword($LEGAJO);

        $respuesta->success = true;
        $respuesta->mensaje = "Datos correctos, bienvenido.";
    } else {
        $respuesta->success = false;
        $respuesta->mensaje = "Contraseña incorrecta, intente de nuevo o comuníquese con soporte.";
    }
} else {
    $respuesta->success = false;
    $respuesta->mensaje = "Usuario no existe o está mal escrito.";
}

if ($stmt) {
    $stmt->close();
}


// Función para buscar al usuario en la base de datos.
function buscarUsuario() {
    global $con;

    $sql = "SELECT IDPERSONA, LEGAJO, CLAVE, APELLYNOMBRE
            FROM personas 
            WHERE LEGAJO = ?";

    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        return $stmt;
    } else {
        // Manejo de errores en la preparación del SQL.
        error_log("Error en la preparación del SQL: " . $con->error);
        return false;
    }
}
 if($respuesta == true){
     header('Location: ../mis-datos.php');
exit();
 }
	

?>
