<?php 
ini_set('error_reporting', E_STRICT);
include '../conexion/conectar.inc.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
//
include 'config.inc.php';

function guardarNotificacion($id,$archivos){
    global $conectar;
    foreach ($archivos as $item){
        $temp=$item['archivo'];
        $nombre=$item['nombre'];
        $destino=$id.'_'.$nombre;
        if (move_uploaded_file($temp, '../../archivos/'.$destino)) {
            $res=$conectar->query("INSERT INTO `notificaciones`(`idpersona`, `archivo`) VALUES ('$id','$destino')");
            echo $conectar->error;
        }
        
    }
}

function enviarMail($correo,$nombre,$asunto,$cuerpo,$archivo){
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      
        $mail->isSMTP();       
	$mail->CharSet = "UTF-8";                                     
        $mail->Host       = 'smtp.titan.email';
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'notificacion@impsr.gob.ar';
        $mail->Password   = '123456';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                   
        
        $mail->setFrom('notificacion@impsr.gob.ar', 'IMPS Rosario');
        $mail->addAddress($correo, $nombre);   
        foreach ($archivo as $item){
        $mail->addAttachment($item['archivo'],$item['nombre']);         
        }
        $mail->isHTML(true);                                 
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;
        $mail->AltBody = $cuerpo;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}
//
function check($dato){
	switch ($dato){
		case 0:
			return '';
			break;
		case 1:
			return '<i class="far fa-check-square"></i>';
			break;
	}
}
function clave($dato){
    if (!empty($dato)) {
        return '<i class="far fa-check-square"></i>';
    }else{
        return '';
    }
}
function generapasswd($length, $options = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
    $password = '';
    $optionlength = strlen($options)-1;
    for($i = 0; $i < $length; $i++)
    {
        $randomPick = rand(0,$optionlength);
        $password = $password.substr($options,$randomPick, 1);
    }
    return $password;
}

function getToken(){
	include 'config.inc.php';
	$ch = curl_init();
	$post = [
			'email' => API_USER,
			'clave' => API_KEY,
	];
	curl_setopt($ch, CURLOPT_URL,"https://apirest.cofepres.org.ar/public/auth/autenticar");
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$remote_server_output = curl_exec ($ch);
	curl_close ($ch);
	
	$json=json_decode($remote_server_output);
	if($json-response==true){
		return $json->result;
	}else{
		return 'errorde token';
	}
	
}

function getCuit($token,$cuit){
	$ch = curl_init();
	$url= "https://apirest.cofepres.org.ar/public/certificacion/obtener/".$cuit;
	$header = array(
			'Content-Type: application/x-www-form-urlencoded',
			'app-token: '.$token
	);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET' );
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	$result = curl_exec($ch);
	curl_close($c);
	$json=json_decode($result);
	return $json;
	
	
}
	
function tipoDoc($valor){
	switch ($valor){
		case '1':
			return 'DNI';
		break;
		case '2':
			return 'LC';
			break;
		case '3':
			return 'LE';
			break;
		case '4':
			return 'OTRO';
			break;
		default:
			return '';
	}
}
function tipoBene($valor){
	switch ($valor){
		case '1':
			return 'JUBILACION';
			break;
		case '2':
			return 'PENSION';
			break;
		case '3':
			return 'RETIRO';
			break;
		case '4':
			return 'MALVINAS';
			break;
		case '5':
			return 'OTRO BENEFICIO';
			break;
		default:
			return '';
			
	}
}
function tipoDeta($valor){
	switch ($valor){
		case '10':
			return 'Jubilación Ordinaria';
			break;
		case '20':
			return 'Jubilación por Invalidez';
			break;
		case '30':
			return 'Jubilación por Edad Avanzada';
			break;
		case '41':
			return 'Pensión Directa PBU';
			break;
		case '42':
			return 'Pensión Directa RTI';
			break;
		case '43':
			return 'Pensión Directa PEA';
			break;
		case '50':
			return 'Pensión Derivada';
			break;
		case '60':
			return 'Ex Combatiente de Malvinas';
			break;
		case '61':
			return 'Movilizado de Malvinas ';
			break;
		default:
			return '';
			
	}

}
function tipoEs($valor){
	switch ($valor){
		case '1':
			return '00 Comunes o Generales';
			break;
		case '2':
			return '01 Docentes';
			break;
		case '3':
			return '02 Policía';
			break;
		case '4':
			return '03 Servicio Penitenciario';
			break;
		case '5':
			return '04 Magistrados';
			break;
		case '6':
			return '05 Luz y Fuerza';
			break;
		default:
			return '';
			
	}
}
?>