<?php
header('Content-Type: application/json');
include 'constants.php';
include 'connect.php';
global $con;
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL,"es_ES");

require_once 'PHPMailerAutoload.php';
$respuesta= new stdClass();
function extension($filename){
    return substr(strrchr($filename, '.'), 1);
}
$nombre=$_POST['nombre'];
$dni=$_POST['dni'];
$direccion=$_POST['domicilio'];
$pen=$_POST['pensionada'];
$nro=$_POST['nro'];
$fechaf=$_POST['fecha'];
if(is_uploaded_file($_FILES['archivo']['tmp_name']))
{
    $dir='../admin/archivos';
    $nameold = $_FILES['archivo']['name'];
    $file1=str_replace(' ', '', $pen);
    $file2=str_replace(' ','',$nro);
    $name = rand().$file1.'-'.$file2.'.'.extension($nameold);
    if(move_uploaded_file($_FILES['archivo']['tmp_name'], "$dir/$name"))
    {
                
        $archivo=$name;
        
        $query="INSERT INTO `fallecimiento_not`( `nombre`, `dni`, `direccion`, `pensionado`, `nro_pen`, `fecha_fall`, `certificado`, `estado`, `estado_usuario`) VALUES ('$nombre','$dni','$direccion','$pen','$nro','$fechaf','$archivo','0','0')";
        $res=mysqli_query($con, $query);
        if ($res) {
            $respuesta->success=true;
            $dia=strftime("%d");
            $mes=strftime("%B");
            $ano=strftime("%G");
            $fecha=date("d/m/Y", strtotime($fechaf));
            $cuerpo='<h2 style="text-align:center;">INSTITUTO MUNICIPAL DE PREVISION SOCIAL DE ROSARIO</h2>';
            $cuerpo.='<div style="padding: 15px;"><p style="text-align: right;">ROSARIO, '.$dia.' '.$mes.' DE '.$ano.'</p>';
            $cuerpo.='<p></p>';
            $cuerpo.='<p style="text-align:justify;">EN LA FECHA COMPARECE EL/LA SEÑOR/A '.$nombre.', DNI NRO'.$dni.' CON DOMICILIO EN LA CALLE '.$direccion.' DE LA CIUDAD DE ROSARIO Y COMUNICA EL FALLECIMIENTO DE/L LA BENEFICIARIO/A SR/A. '.$pen.' Nº '.$nro.' OCURRIDO EL D&Iacute;A '.$fecha.' A LOS FINES QUE HUBIERE LUGAR, FIRMA PARA CONSTANCIA.-</p>';
            $cuerpo.='<p></p>';
           // $cuerpo.='<p style="text-align:center;">EMPLEADO CERTIFICANTE</p>'; 	
            $cuerpo.='<p></p>';
            $cuerpo.='<p></p>';
            $cuerpo.='<p></p>';
            //$cuerpo.='<p style="text-align:center;">FIRMA DEL DENUNCIANTE</p></div>';
            $cuerpo=strtoupper($cuerpo);
            $asunto='NUEVA NOTIFICACION';
            //
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = 'mail.impsr.gob.ar';
            $mail->Port = 25;
            $mail->SMTPAuth = true;
            $mail->Username = 'notificacion@impsr.gob.ar';
            $mail->Password = 'Noti159.';
            $mail->setFrom('notificacion@impsr.gob.ar', 'IMPS Rosario');
            $mail->addAddress('jesicasaia@impsr.gob.ar', 'IMPS Rosario');
            $mail->Subject = $asunto;
            $mail->msgHTML($cuerpo);
            $mail->AddAttachment('../admin/archivos/'.$archivo);
            $mail->AltBody = $cuerpo;
            if (!$mail->send()) {
                $respuesta->envio=false;
                $respuesta->envioerror="Mailer Error: " . $mail->ErrorInfo;
            }else{
                $respuesta->envio=true;
            }
            //
            $respuesta->mensaje=$cuerpo;
            
        
        }else{
            $respuesta->success=false;
            $respuesta->error=mysqli_error($con);
        }
    }
}else{
    $respuesta->success=false;
    $respuesta->error=$_FILES["archivo"]["error"];
}
echo json_encode($respuesta);