<?php
//echo 'empezar envio';

require 'PHPMailerAutoload.php';

$mensaje = '
	Mail desde el sitio
	-------------------
	Fecha: '.date("d/m/Y H:i:s").'
	Nombre: '.$_POST['nombre'].'
	Telefono: '.$_POST['telefono'].'
	Email: '.$_POST['correo'].'
	-------------------
	Mensaje:
		'.$_POST['mensaje'].'
				';



if(isset($_POST['g-recaptcha-response'])){
	$captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
	echo '<h2>Please check the the captcha form.</h2>';
	exit;
}
$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfLOgcUAAAAADwOh77C1-KK8yYtaUzVoWgM7WcU&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
if($response['success'] == false)
{
	echo '<h2>You are spammer ! Get the @$%K out</h2>';
}else
{
	
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = 'fuentenaturaldispenser.com.ar';
		$mail->Port = 25;
		$mail->SMTPAuth = true;
		$mail->Username = 'info@fuentenaturaldispenser.com.ar';
		$mail->Password = 'fuente159';
		$mail->setFrom('info@fuentenaturaldispenser.com.ar', 'Fuente Natural');
		$mail->addReplyTo('info@fuentenaturaldispenser.com.ar', 'Fuente Natural');
		$mail->addAddress('info@fuentenaturaldispenser.com.ar', 'Fuente Natural');
		$mail->Subject = 'Nuevo Mensaje desde la WEB';
		$mail->msgHTML($mensaje);
		$mail->AltBody = $mensaje;
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	
}
?>
