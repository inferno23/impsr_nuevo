<?php
include_once 'constants.php';
include_once 'connect.php';
global $con;
require_once 'PHPMailerAutoload.php';
$respuesta= new stdClass();
function fecha($fecha){
    if ($fecha=='0000-00-00'){
        return ' ';
    }else {
        return strftime("%d/%m/%Y",strtotime($fecha));
    }
}
$dni=$_POST['dni'];
$email=$_POST['mail'];
if(empty($dni)){
    $query="SELECT t.*,ts.nombre seccion,su.etiqueta subseccion FROM `turnos` t LEFT JOIN turnos_secciones ts ON t.id_seccion=ts.id LEFT JOIN turnos_subsecciones su ON t.id_subseccion=su.id WHERE t.email = '$email' AND t.confirmado = 1 ORDER BY t.id DESC LIMIT 1";
}else{
    $query="SELECT t.*,ts.nombre seccion,su.etiqueta subseccion FROM `turnos` t LEFT JOIN turnos_secciones ts ON t.id_seccion=ts.id LEFT JOIN turnos_subsecciones su ON t.id_subseccion=su.id WHERE t.dni = '$dni' AND t.confirmado = 1 ORDER BY t.id DESC LIMIT 1";
}

$tur=$con->query($query);
$respuesta->query=$query;
if($tur->num_rows>0){
    $turno=$tur->fetch_assoc();
    $id=$turno['id'];
    $dni=$turno['dni'];
    $nombre=$turno['nombre'].' '.$turno['apellido'];
    $fecha=fecha($turno['fecha']);
    $correo=$turno['email'];
    $hora =$turno['hora'];
    $titulo='Turno asignado para : '.$turno['seccion'].' - '.$turno['subseccion'].'';
    $nroturno=str_pad($turno['id_seccion'], 2, "0", STR_PAD_LEFT).str_pad($turno['id_subseccion'], 2, "0", STR_PAD_LEFT).$id;
    $obs='<p>Deberá concurrir con D.N.I y la documentación correspondiente al trámite a realizar en calle San Lorenzo 1055 de Rosario</p>';
    
    $asunto='Turno IMPSR';
    $cuerpo='<div class="row justify-content-center">
	    	<div class="col-md-8 col-12 ">
	    		<div class="card" id="paraimprimir" style="position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0,0,0,.125);border-radius: .25rem;">
	    			<div class="card-header" style="padding: .75rem 1.25rem;margin-bottom: 0;background-color: rgba(0,0,0,.03);border-bottom: 1px solid rgba(0,0,0,.125);">
	    				<h2 class="h3" style="font-size: 1.75rem;margin-bottom: .5rem;font-family: inherit;font-weight: 500;line-height: 1.2;">'.$titulo.'</h2>
	    			</div>
	    			<div class="card-body" style="flex: 1 1 auto;padding: 1.25rem;">
    	    			<div class="descripcion text-center" style="font-size:1rem;">
                			<p style="margin-bottom: 1rem;">DNI : '.$dni.'></p>
                			<p style="margin-bottom: 1rem;">Nombre : '.$nombre.'</p>
                			<p style="margin-bottom: 1rem;">Su turno ha sido confirmado para el dia '.$fecha.' y hora '.$hora.'</p>
                			<p style="margin-bottom: 1rem;">Su numero de Turno es '.$nroturno.'</p>
                			<div class="border p-3" style="padding: 1rem!important; border: 1px solid #dee2e6!important;">
                				<p  style="margin-bottom: 1rem;">'.$obs.'</p>
                			</div>
                			<br>
                			
                		</div>
        	        
        	    	</div>
        		
	    		</div>
	    	</div>
	    </div>';
    $cuerpoalt='Su turno para '.$titulo.' \\r\\n          ';
    $cuerpoalt.='Dni : '.$dni.' \\r\\n  ';
    $cuerpoalt.='Nombre : '.$nombre.' \\r\\n  ';
    $cuerpoalt.='Su turno ha sido confirmado para el dia '.$fecha.' y hora '.$hora.'  \\r\\n  ';
    $cuerpoalt.='Su numero de turno es '.$nroturno.' \\r\\n ';
    $cuerpoalt.='Observaciones : '.$obs.' \\r\\n';
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
    }else{
        $respuesta->success=true;
        $respuesta->email=$correo;
    }
    //
}else{
    $respuesta->success=false;
    $respuesta->error=$con->error.' '.$query;
    $respuesta->msg='Error el dato enviado no existe';
}
//


echo json_encode($respuesta);