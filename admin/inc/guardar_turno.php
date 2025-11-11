<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL, "es_ES");

include '../conexion/conectar.inc';
global $conectar;

function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern) - 1;
    for ($i = 0; $i < $longitud; $i++) {
        $key .= $pattern[random_int(0, $max)];  // Reemplazamos mt_rand() con random_int()
    }
    return $key;
}

function fecha($fecha) {
    if ($fecha == '0000-00-00') {
        return ' ';
    } else {
        return strftime("%d/%m/%Y", strtotime($fecha));
    }
}


$respuesta = new stdClass();

$id = isset($_POST['id']) ? $_POST['id'] : '';
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$seccion = $_POST['seccion'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$dni = $_POST['dni'];
$telefono = $_POST['telefono'];
$motivo = $_POST['seccion'];
$tipo = $_POST['tipo'];
$obs = $_POST['obs'];
$code = generarCodigo(64);

if (empty($id)) {
    // Inserción de un nuevo turno
    $query = "INSERT INTO `turnos`(`tipo`, `nombre`, `email`, `fecha`, `hora`, `dni`, `telefono`, `id_seccion`, `id_subseccion`, `confirmado`, `code`, `observaciones`, `verificado`, `excepcion`, `recibo`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '1', ?, ?, '0', '0', '')";
    
    $stmt = $conectar->prepare($query);
    $stmt->bind_param("sssssssssss", $tipo, $nombre, $correo, $fecha, $hora, $dni, $telefono, $seccion, $motivo, $code, $obs);
    
} else {
    // Actualización de un turno existente
    $query = "UPDATE `turnos` SET `nombre` = ?, `email` = ?, `dni` = ?, `telefono` = ?, `fecha` = ?, `hora` = ?, `id_seccion` = ?, `id_subseccion` = ?, `tipo` = ?, `confirmado` = '1', `excepcion` = '0', `observaciones` = ? WHERE id = ?";
    
    $stmt = $conectar->prepare($query);
    $stmt->bind_param("ssssssssssi", $nombre, $correo, $dni, $telefono, $fecha, $hora, $seccion, $motivo, $tipo, $obs, $id);
}

// Ejecutar consulta
if ($stmt->execute()) {
    $respuesta->success = true;

    // Si es una inserción, devolver el ID generado
    if (empty($id)) {
        $respuesta->id = $conectar->insert_id;
    } else {
        $respuesta->id = $id; // Si es actualización, devolver el mismo ID
    }

} else {
    $respuesta->success = false;
    $respuesta->error = $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conectar->close();

// Devolver JSON
echo json_encode($respuesta);
?>
