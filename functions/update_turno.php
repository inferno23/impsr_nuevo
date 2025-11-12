<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL,"es_ES");
include_once 'constants.php';
include_once 'connect.php';
global $con;
require_once 'PHPMailerAutoload.php';

function verificarToken($token, $claveSecreta)
{
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $datos = [
        "secret" => $claveSecreta,
        "response" => $token,
    ];
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), # Agregar el contenido definido antes
        ),
    );
    $contexto = stream_context_create($opciones);
    $resultado = file_get_contents($url, false, $contexto);
    if ($resultado === false) {
        return false;
    }
    $resultado = json_decode($resultado);
    $pruebaPasada = $resultado->success;
    return $pruebaPasada;
}

function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
}
function extension($filename){
    return substr(strrchr($filename, '.'), 1);
}
function fecha($fecha){
    if ($fecha=='0000-00-00'){
        return ' ';
    }else {
        return strftime("%d/%m/%Y",strtotime($fecha));
    }
}
$respuesta= new stdClass();

define("CLAVE_SECRETA", "6LeXVGwaAAAAAGyExZBWhpue7miNAcu0RBGAwrL3");

if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
    $respuesta->msg="Debes completar el captcha";
    $respuesta->success=false;
}else{
    $token = $_POST["g-recaptcha-response"];
    $verificado = verificarToken($token, CLAVE_SECRETA);
    if ($verificado) {
        $idold=$_POST['id'];
        $fecha=$_POST['fecha'];
        $hora=$_POST['hora'];
        $seccion=$_POST['seccion'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $correo=$_POST['correo'];
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $motivo=$_POST['motivo'];
        $calle=$_POST['calle'];
        $altura=$_POST['altura'];
        $localidad=$_POST['localidad'];
        
        if (isset($_POST['condicion'])){
            $condicion=$_POST['condicion'];
        }else{
            $condicion='';
        }
        $code=generarCodigo(64);
        $archivo='';
        if($condicion=='activo'){
            if (!file_exists($_FILES['recibo']['tmp_name']) || !is_uploaded_file($_FILES['recibo']['tmp_name']))
            {
                $archivo='';
            }
            else
            {
                if(is_uploaded_file($_FILES['recibo']['name']))
                {
                    $dir='../admin/archivos';
                    $nameold = $_FILES['recibo']['name'];
                    $file=str_replace(' ', '', $dni);
                    $name = rand().$file.'.'.extension($nameold);
                    if(move_uploaded_file($_FILES['recibo']['tmp_name'], "$dir/$name"))
                    {
                        $archivo=$name;
                    }
                }else{
                    $archivo='';
                }
            }
        }
        
        
        
        
        $query="INSERT INTO `turnos`(`calle`,`altura`,`localidad`,`recibo`,`tipo`,`nombre`,`apellido`, `email`, `fecha`, `hora`, `dni`, `telefono`, `id_seccion`, `id_subseccion`, `confirmado`, `code`, `observaciones`, `verificado`) VALUES ('$calle','$altura','$localidad','$archivo','$condicion','$nombre','$apellido','$correo','$fecha','$hora','$dni','$telefono','$seccion','$motivo','0','$code','','0')";
        
        $res=$con->query($query);
        if ($res) {
            $con->query("DELETE FROM turnos WHERE id='$idold'");
            $id=$con->insert_id;
            $asunto='IMPS - Confirme su turno';
            $url='https://impsr.gob.ar/confirmar-turno/'.$code.'-'.$id;
            $cuerpo='<img style="margin-left:auto;margin-right:auto; display: block" src="http://impsr.gob.ar/impsr/img/validacion.png" alt="logo validacion"><h1>Proceso de verificación de correo electrónico iniciado.</h1><p>Hola '.$nombre.'</p><p>Solicito turno para el DNI '.$dni.',el dia '.fecha($fecha).' a las '.$hora.'</p><p>Para completar la verificación de tu correo electrónico, por favor ingresá al <a href="'.$url.'">Link</a></p><p>o copiá el siguiente enlace:'.$url.'</p><p>Muchas gracias.</p><p style="display:flex;"><img style="margin-left:auto;margin-right:auto; display: block" src="http://impsr.gob.ar/impsr/img/logo_impsr.png"></p><p><small>El contenido del presente mensaje es privado, confidencial y de exclusivo uso para el titular de la dirección de correo electrónico a quien está dirigido.</smal>l</p>';
            $cuerpoalt='Proceso de verificacion de correo electrónico iniciado. \r\n Hola '.$nombre.' \r\n Solicito turno para el DNI '.$dni.',el dia '.fecha($fecha).' a las '.$hora.' \r\n  Para completar la verificación de tu correo electrónico, por favor copiá el siguiente enlace: \r\n'.$url.' \r\n Muchas gracias.';
            
            //
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
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
                $respuesta->success=false;
                $respuesta->error="Mailer Error: " . $mail->ErrorInfo;
                $respuesta->msg="Error al enviar el correo, por favor intente de nuevo";
                $con->query("DELETE * FROM turnos WHERE id='$id'");
                unset($_SESSION['impsr']['nroturno']); 
                unset($_SESSION['impsr']['idturno']); 
                unset($_SESSION['impsr']['seccion']); 
                unset($_SESSION['impsr']['subseccion']); 
                
            }else{
                $respuesta->success=true;
                $nroturno=str_pad($seccion, 2, "0", STR_PAD_LEFT).str_pad($motivo, 2, "0", STR_PAD_LEFT).$id;
                $respuesta->nroturno=$nroturno;
            }
            //
        }else{
            $respuesta->success=false;
            $respuesta->msg="Error al guardar los datos, por favor intente de nuevo";
            $respuesta->error=$con->error;
        }
        
    } else {
        $respuesta->msg="Eres un robot";
        $respuesta->success=false;
    }
}


echo json_encode($respuesta);
?>