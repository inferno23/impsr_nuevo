<?php
error_reporting(E_ALL); // Reportar todos los errores
ini_set('display_errors', '1'); // Mostrar errores en pantalla
ini_set('display_startup_errors', '1'); // Mostrar errores de inicio

date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL, "es_ES.UTF-8"); // Asegúrate de que este locale esté instalado

include_once 'constants.php';
include_once 'connect.php';
include 'funciones.inc.php';
global $con;
require_once 'PHPMailerAutoload.php';

function verificarToken($token, $claveSecreta) {
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    $opciones = [
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos),
        ],
    ];
    $contexto = stream_context_create($opciones);
    $resultado = @file_get_contents($url, false, $contexto); // Manejo de errores
    if ($resultado === false) {
        return false;
    }
    $resultado = json_decode($resultado);
    return $resultado->success ?? false;
}

function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
   
    $max = strlen($pattern) - 1;
    for ($i = 0; $i < $longitud; $i++) {
        $key .= $pattern[mt_rand(0, $max)];
    }
    return $key;
}

function extension($filename) {
    return pathinfo($filename, PATHINFO_EXTENSION);
}

function fecha($fecha) {
    return ($fecha == '0000-00-00') ? ' ' : strftime("%d/%m/%Y", strtotime($fecha));
}

$respuesta = new stdClass();

define("CLAVE_SECRETA", "6LeXVGwaAAAAAGyExZBWhpue7miNAcu0RBGAwrL3");

/*if (!empty($_POST["g-recaptcha-response"])) {
    $respuesta->msg = "Debes completar el captcha";
    $respuesta->success = false;
} else {*/
   // $token = $_POST["g-recaptcha-response"];
   // $verificado = verificarToken($token, CLAVE_SECRETA);
   $verificado = true;
    if ($verificado) {
        $fecha = $_POST['fecha'] ?? '';
        $hora = $_POST['hora'] ?? '';
        $seccion = $_POST['seccion'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $dni = $_POST['dni'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $motivo = $_POST['motivo'] ?? '';
        $calle = $_POST['calle'] ?? '';
        $altura = $_POST['altura'] ?? '';
        $localidad = $_POST['localidad'] ?? '';
        $condicion = $_POST['condicion'] ?? '';

        $code = generarCodigo(64);
        $archivo = '';

        if ($condicion == 'activo' && isset($_FILES['recibo']) && is_uploaded_file($_FILES['recibo']['tmp_name'])) {
            $dir = '../admin/archivos';
            $nameold = $_FILES['recibo']['name'];
            $file = str_replace(' ', '', $dni);
            $name = rand() . $file . '.' . extension($nameold);
            if (move_uploaded_file($_FILES['recibo']['tmp_name'], "$dir/$name")) {
                $archivo = $name;
            }
        }

        $query = "INSERT INTO `turnos`(`calle`,`altura`,`localidad`,`recibo`,`tipo`,`nombre`,`apellido`, `email`, `fecha`, `hora`, `dni`, `telefono`, `id_seccion`, `id_subseccion`, `confirmado`, `code`, `observaciones`, `verificado`) VALUES ('$calle','$altura','$localidad','$archivo','$condicion','$nombre','$apellido','$correo','$fecha','$hora','$dni','$telefono','$seccion','$motivo','0','$code','','0')";

        if ($con->query($query)) {
            $id = $con->insert_id;
            $asunto = 'IMPS - Confirme su turno';
            $cuerpo = getConfirmacion($id, $code);
            $url = 'https://impsr.gob.ar/confirmar.php?code=' . urlencode($code) . '&id=' . urlencode($id);
            $cuerpoalt = "Hola $nombre $apellido, para confirmar tu turno copia el siguiente enlace: $url";

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0; // Desactiva depuración en producción
            $mail->Host = 'smtp.titan.email';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = 'notificacion@impsr.gob.ar';
            $mail->Password = '123456';
            $mail->setFrom('notificacion@impsr.gob.ar', 'IMPS Rosario');
            $mail->addAddress($correo, $nombre);
            $mail->Subject = $asunto;
            $mail->msgHTML($cuerpo);
            $mail->CharSet = 'UTF-8';
            $mail->AltBody = $cuerpoalt;

            if (!$mail->send()) {
                $respuesta->success = false;
                $respuesta->msg = "Error al enviar el correo, por favor intente de nuevo";
                $respuesta->error = $mail->ErrorInfo;
                $con->query("DELETE FROM turnos WHERE id='$id'");
            } else {
                $respuesta->success = true;
                $respuesta->nroturno = str_pad($seccion, 2, "0", STR_PAD_LEFT) . str_pad($motivo, 2, "0", STR_PAD_LEFT) . $id;
            }
        } else {
            $respuesta->success = false;
            $respuesta->msg = "Error al guardar los datos, por favor intente de nuevo";
            $respuesta->error = $con->error;
        }
    } else {
        $respuesta->msg = "Eres un robot";
        $respuesta->success = false;
    }
//}

echo json_encode($respuesta);
?>
