<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
setlocale(LC_ALL,"es_ES");

if (!function_exists('fecha')) {
    function fecha($fecha){
        if ($fecha=='0000-00-00'){
            return ' ';
        }else {
            return strftime("%d/%m/%Y",strtotime($fecha));
        }
    }
}
function getConfirmacion($id,$code){
    include_once 'constants.php';
    include_once 'connect.php';
    global $con;
    $query="SELECT t.*,ts.nombre seccion,su.etiqueta subseccion FROM `turnos` t LEFT JOIN turnos_secciones ts ON t.id_seccion=ts.id LEFT JOIN turnos_subsecciones su ON t.id_subseccion=su.id WHERE t.id='$id'";
    $turno=$con->query($query);
    $row=$turno->fetch_assoc();
    $id=$row['id'];
    $nombre=$row['nombre'];
    $apellido=$row['apellido'];
    $nom=$nombre.' '.$apellido;
    $titulo=' '.$row['seccion'].' - '.$row['subseccion'].'';
    $url = 'https://impsr.gob.ar/confirmar.php?code='.$code.'&id='.$id;

    $cuerpo='<div  style="font-family: Arial,Helvetica,sans-serif;font-size:14px;padding-bottom:2rem;display:block;background-color:#e3e1e2;background-repeat:repeat;margin:0px;width:100%;height:auto;padding-top:3rem;">
	<div style="display:flex;  width:90%; max-width:600px; margin-left:auto;margin-right:auto;padding:1rem;">
		<div style="display:block;text-align:left; width:50%;">
			<img alt="" height="66px" src="https://impsr.gob.ar/img/logo.jpg" style="max-width:149px" width="100%" />
		</div>
		<div style="display:block; width:50%;text-align:center;">
			<h2><a href="https://impsr.gob.ar/solicitar-turno" style="color:#1E619A;font-family:Arial,Helvetica,sans-serif;font-size:1.6em;text-decoration:none;text-transform:uppercase" target="_blank" >TURNOS WEB</a></h2>
		</div>
	</div>
	<div style="font-family: Arial,Helvetica,sans-serif;background-color: #fff; width:90%; max-width:600px; margin-left:auto;margin-right:auto;padding:1rem;">
		<div style="display:block;font-size:1em; text-align:left; width:100%;">
			<h4 style="color:#1E619A;font-weight:bold;font-size:1.4em;line-height:20px;margin-bottom:12px;">Confirme la solicitud del turno.</h4>
			<h4 style="color:#494948;font-size:1.3em;font-weight:bold;line-height:30px;margin-bottom:12px;font-family:Arial,Helvetica,sans-serif">Hola '.$nom.'</h4>
			<p style="font-size:1.1em;">Hemos recibido en nuestro sistema la solicitud de un turno para realizar el siguiente trámite: '.$titulo.' </p>
            <br>
            <p style="font-size:1.1em;">Para finalizar la gestión, y otorgar el turno requerido es necesario que lo confirmes. En caso que no lo hagas el turno será dado de baja a las 24 horas.</p>
            <p style="font-size:1.1em;">Para confirmar el turno presionar el siguiente enlace <a href="'.$url.'">CONFIRMAR</a></p>
            <p style="font-size:1.1em;">Si no has realizado esta gestión ignora este correo.</p>
            <p style="font-size:1.1em;"><b>IMPORTANTE:</b></p>
            <ul>
                <li><p style="font-size:1.1em;">La recepción de este correo no implica la confirmación del turno. Para esto, debe presionar el enlace indicado anteriormente.</p></li>
                <li><p style="font-size:1.1em;">La impresión de este correo no tiene validez para la realización del trámite.</p></li>
            </ul>
        	<br>
		</div>
	</div>
</div>';
    return $cuerpo;
}

function getTurno($id){
    include_once 'constants.php';
    include_once 'connect.php';
    global $con;
    $query="SELECT t.*,ts.nombre seccion,su.etiqueta subseccion FROM `turnos` t LEFT JOIN turnos_secciones ts ON t.id_seccion=ts.id LEFT JOIN turnos_subsecciones su ON t.id_subseccion=su.id WHERE t.id='$id'";
    $turno=$con->query($query);
    $row=$turno->fetch_assoc();
    $id=$row['id'];
    $doc=$row['dni'];
    $nombre=$row['nombre'];
    $apellido=$row['apellido'];
    $fecha=fecha($row['fecha']);
    $hora =$row['hora'];
    $titulo=' '.$row['seccion'].' - '.$row['subseccion'].'';
    $nroturno=str_pad($row['id_seccion'], 2, "0", STR_PAD_LEFT).str_pad($row['id_subseccion'], 2, "0", STR_PAD_LEFT).$id;
    $cuerpo='<div  style="padding-bottom:2rem;display:block;background-color:#e3e1e2;background-repeat:repeat;margin:0px;width:100%;height:auto;padding-top:3rem;">
	<div style="display:flex;  width:90%; max-width:600px; margin-left:auto;margin-right:auto;padding:1rem;">
		<div style="display:block;text-align:left; width:50%;">
			<img alt="" height="66px" src="https://impsr.gob.ar/img/logo.jpg" style="max-width:149px" width="100%" />
		</div>
		<div style="display:block; width:50%;">
			<h2><a href="https://impsr.gob.ar/solicitar-turno" style="color:#1E619A;font-family:Arial,Helvetica,sans-serif;font-size:21px;text-decoration:none;text-transform:uppercase" target="_blank" >TURNOS WEB</a></h2>
		</div>
	</div>
	<div style="background-color: #fff; width:90%; max-width:600px; margin-left:auto;margin-right:auto;padding:1rem;">
		<div style="display:block;font-size:1rem; text-align:left; width:100%;">
			<h4 style="color:#1E619A;font-weight:bold;font-size:1.4rem;line-height:20px;margin-bottom:12px;">Su solicitud ha sido confirmada.</h4>
			<p style="font-size:1.1rem;">Turno asignado para: '.$titulo.' </p>
            <br>
            <p style="font-size:1.1rem;">Documento:  '.$doc.'</p>
            <p style="font-size:1.1rem;">Apellido:  '.$nombre.'</p>
            <p style="font-size:1.1rem;">Nombre:  '.$apellido.'</p>
            <p style="font-size:1.1rem;">Número de Identificación de Turno: <b>'.$nroturno.'</b></p>
            <p style="font-size:1.1rem;">Su turno se reservó para el día: '.$fecha.' a la hora '.$hora.' .</p>
            <p style="font-size:1.1rem;">Debe concurrir a: San Lorenzo 1055  - Rosario</p>
            <p style="font-size:1.1rem;">Teléfono Oficina: 341 - 4256085 </p>
            <br>
            <fieldset style="text-align:left;border:1px solid #666;padding:1rem;">
                <legend style="font-size:1.1rem;width:auto;">Observaciones</legend>
                <p style="text-align:center">Es importante que se presente a horario respetando el turno elegido.</p>
            	<p style="text-align:center">Recuerde que debe traer toda la documentación para completar su trámite.</p>
            </fieldset>
        	<br>
		</div>
	</div>
</div>';
    return $cuerpo;
}
function enviarMail($correo,$nombre,$asunto,$cuerpo){
    require_once 'PHPMailerAutoload.php';
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
    $mail->AltBody = $cuerpo;
    if (!$mail->send()) {
        return $mail->ErrorInfo;
        
    }else{
        return true;
    }
}