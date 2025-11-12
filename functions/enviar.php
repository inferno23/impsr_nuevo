<?php
header('Content-Type: application/json');
//ini_set('log_errors',TRUE);
//ini_set('error_reporting', E_ALL);
$correo=$_POST['email'];
$nombre=$_POST['nombre'];
$mensaje=$_POST['mensaje'];
$recaptcha = $_POST['g-recaptcha-response'];
$respuesta = new stdClass;
$secret_key = '6LeXVGwaAAAAAGyExZBWhpue7miNAcu0RBGAwrL3';
$url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key.'&response='.$recaptcha;
$response = file_get_contents($url);
$response = json_decode($response);
if ($response->success == true) {
    
    require_once 'PHPMailerAutoload.php';
    $cuerpoHtml = '
	<h2>Nueva Consulta desde el sitio</h2>
	<hr>
	<p>Fecha: '.date("d/m/Y H:i:s").'</p>
    <p>Nombre: '.$nombre.'</p>
	<p>E-mail: '.$correo.'</p>
	<p>Mensaje: '.$mensaje.'</p>';
    $cuerpo='
	Mail desde el sitio \r\n
	-------------------\r\n
	Fecha: '.date("d/m/Y H:i:s").'\r\n
	Nombre: '.$nombre.'\r\n
	Email: '.$correo.'\r\n
    Mensaje: '.$mensaje.'
				';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.titan.email';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;
    $mail->Username = 'impsrweb@impsr.gob.ar';
    $mail->Password = 'Web123';
    $mail->setFrom('impsrweb@impsr.gob.ar', 'IMPS Rosario');
    $mail->addReplyTo($correo, $nombre);
    $mail->addAddress( 'impsrweb@impsr.gob.ar', 'IMPS Rosario');
    //$mail->addAddress( 'aolamas@gmail.com', 'IMPS Rosario');
    $mail->Subject = 'Nuevo mensaje desde la WEB';
    $mail->msgHTML($cuerpoHtml);
    $mail->AltBody = $cuerpo;
    if (!$mail->send()) {
        $respuesta->success=false;
        $respuesta->error="Mailer Error: " . $mail->ErrorInfo;
    }else{
        $respuesta->success=true;
    }
} else {
    $respuesta->success=false;
}


echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>