<?php
include '../conexion/conectar.inc.php';
global $conectar;
include 'funciones.inc';
$respuesta=new stdClass();
$id=$_POST['id'];
$titulo=$_POST['titulo'];
$he=$conectar->query("SELECT a.mail,a.LEGAJO,a.CLAVE,a.IDPERSONA,a.CUIL,a.APELLYNOMBRE,a.TELEFONO,a.celular,c.NROJUBILADO,c.NROPEN FROM personas a LEFT JOIN causante b ON a.IDPERSONA=b.IDPERSONA LEFT JOIN municxper c ON b.IDPER=c.IDPERSONA  WHERE a.IDPERSONA='$id'");
$row=$he->fetch_assoc();
$asunto=$titulo;
$cuerpo="<h1>Estimado ".$row['APELLYNOMBRE']."</h1><p> NRO PENSION : #".$row['NROPEN']."</p><p>LE ENVIAMOS ESTA NOTIFICACION Con PDF ADJUNTO</p>";
$pie='<div style="width:100%; text-align:center;">
	<h2>INSTITUTO MUNICIPAL DE PREVISION SOCIAL DE ROSARIO</h2>
	<img src="https://impsr.gob.ar/img/logo_impsr.png" slt="logo" style="height: 60px; display:block; margin-left:auto;margin-right:auto; margin-top:10px;margin-botom:10px;">
	<p>SAN LORENZO 1055 – ROSARIO</p>
	<p>TEL: 4256085-4212015</p>
	<p style="font-size: 0.9rem; color: #999;">DECRETO 518/43 Artículo 25.- Toda notificación se considerará efectuada el día de la fecha en que ella se realice. Artículo 27.- Toda vista o traslado que se acuerde en los expedientes, será evacuada en el término de cinco días hábiles, a contar desde el  siguiente de la notificación, siempre que no se acordara un plazo especial distinto. Artículo 28.- Los interesados no podrán retirar los expedientes, pero para evacuar las vistas o traslados, se les permitirá examinarlos en la oficina respectiva, no siendo obligatorio el darles copia de los escritos que motiven la vista o traslado.</p>
	<p style="font-size: 0.9rem; color: #999;">LEY 2756 Art. 66 - Contra las resoluciones del Intendente Municipal, dictadas de oficio o a petición de partes, procederá el recurso de reconsideración, tendiente a dejarlas sin efecto o modificarlas. También procederá el recurso en materia disciplinaria contra las resoluciones del Concejo Municipal o del órgano que las dicte en último término en ese ámbito. Art. 67 - El recurso se interpondrá dentro del término de diez días hábiles administrativos, contados desde la notificación de la resolución al interesado, sin computarse el día en que ésta se verifique.En el escrito de interposición del recurso se expondrán las razones de hecho y de derecho en que se funde la impugnación, y, en su caso, se ofrecerá la prueba que se estime necesaria, para cuya producción se fijará un plazo no mayor de treinta días hábiles administrativos.Art.69- Si la resolución hubiese sido dictada por una autoridad municipal con poder de resolver que no sea el Intendente Municipal o por un ente autárquico del municipio, será susceptible del recurso de reconsideración, que se deducirá, sustanciará y resolverá de acuerdo con las normas que anteceden. La decisión que en tal caso recaiga será apelable por ante el Intendente Municipal. El recurso se interpondrá dentro de los diez días hábiles administrativos, posteriores a la notificación al interesado, ante el órgano que hubiese dictado la resolución. Este concederá el recurso, si ha sido deducido en término, y elevará el expediente al Intendente Municipal por medio de la Secretaría que corresponda.Art.70.- Se entenderá que existe denegación tácita si el órgano apelado no se expide sobre la revocatoria dentro del plazo de treinta días hábiles administrativos. En tal supuesto, el interesado podrá recurrir directamente ante el Intendente Municipal pidiendo se requiera el expediente y se le conceda el recurso de apelación. Art.71. Notificado de la recepción del expediente o, en su caso, de la concesión del recurso, el recurrente fundará la apelación dentro del término de diez días hábiles administrativos, exponiendo los motivos de hecho y de derecho que estime pertinentes. Art. 73.- Cuando el procedimiento de sustanciación de los recursos estuviese paralizado durante seis meses sin que el interesado instase su prosecusión, se operará su caducidad por el simple transcurso del tiempo, sin necesidad de declaración alguna. </p>
</div>';
$cuerpo.=$pie;
$resn=$conectar->query("INSERT INTO `notificaciones`(`idpersona`, `titulo`) VALUES ('$id','$titulo')");
if($resn){
    $idnot=$conectar->insert_id;
    $archivos=array();
    $longitud = count($_FILES['archivos']['name']);
    for ($i = 0; $i < $longitud; $i++) {
        $item=array();
        $temp=$_FILES['archivos']['tmp_name'][$i];
        $destino=$idnot.'_'.$_FILES['archivos']['name'][$i];
        if (move_uploaded_file($temp, '../../archivos/'.$destino)) {
            $res=$conectar->query("INSERT INTO `archivos`(`id_notificacion`, `archivo`) VALUES ('$idnot','$destino')");
            echo $conectar->error;
        }
        
        $item['archivo']='../../archivos/'.$destino;
        $item['nombre']=$destino;
        $archivos[]=$item;
        
    }
    
    $nombre=$row['APELLYNOMBRE']; 
    $correo=$row['mail'];
 $mail2=$_POST['mail2'];
    if(!empty($mail2)){
        $conectar->query("UPDATE personas SET mail2='$mail2' WHERE IDPERSONA='$id'");
        enviarMail($mail2, $nombre, $asunto, $cuerpo, $archivos);
    }else{
        $conectar->query("UPDATE personas SET mail2='' WHERE IDPERSONA='$id'");
    }
    $res=enviarMail($correo, $nombre, $asunto, $cuerpo, $archivos);
    if($res){
        $respuesta->success=true;
    }else{
        $respuesta->success=false;
        $respuesta->error=$res;
    }
}else{
    $respuesta->success=false;
    $respuesta->error=$conectar->error;
}

echo json_encode($respuesta);