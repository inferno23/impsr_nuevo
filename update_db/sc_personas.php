<?php 
echo "Insertar datos en tabla personas" . "\n";
$conn = mysqli_connect("localhost", "impsr_root", "BvCZRvJ4A3av", "impsr_impsr");

if (!$conn) {
    die('No pudo conectarse: ' . mysql_error());
}
echo 'Conectado satisfactoriamente' . "\n";
$affectedRow = 0;

$nombre_fichero = 'personas.xml';

if (file_exists($nombre_fichero)) {
			$xml = simplexml_load_file("personas.xml") or die("Error: No se puede crear el objeto");

			foreach ($xml->children() as $row) {
					$idpersona = $row->IDPERSONA;
					$idtpodoc = $row->IDTPODOC;
					$nrodoc = $row->NRODOC;
					$iddirector = $row->IDDIRECTOR;
					$idtpotramite = $row->IDTPOTRAMITE;
					$idtpojub = $row->IDTPOJUB;
					$idtpopension = $row->IDTPOPENSION;
					$idtporecserv = $row->IDTPORECSERV;
					$idtpoestcivil = $row->IDTPOESTCIVIL;
					$fechaactual = $row->FECHAACTUAL;
					$fechadesdeec = $row->FECHADESDEEC;
					$fechahastaec = $row->FECHAHASTAEC;
					$autoridad = $row->AUTORIDAD;
					$juzgado = $row->JUZGADO;
					$apellynombre = $row->APELLYNOMBRE;
					$fechanacimiento = $row->FECHANACIMIENTO;
					$idtponac = $row->IDTPONAC;
					$policia = $row->POLICIA;
					$nombrepadre = $row->NOMBREPADRE;
					$vivepadre = $row->VIVEPADRE;
					$nombremadre = $row->NOMBREMADRE;
					$vivemadre = $row->VIVEMADRE;
					$residepais = $row->RESIDEPAIS;
					$idtpoobrasocial = $row->IDTPOOBRASOCIAL;
					$nroafiliado = $row->NROAFILIADO;
					$seencuentra = $row->SEENCUENTRA;
					$nrobeneficio = $row->NROBENEFICIO;
					$nroexp = $row->NROEXP;
					$lugar = $row->LUGAR;
					$escolaridad = $row->ESCOLARIDAD;
					$idsucursal = $row->IDSUCURSAL;
					$domicilio = $row->DOMICILIO;
					$telefono = $row->TELEFONO;
					$idlocalidad = $row->IDLOCALIDAD;
					$idprovincia = $row->IDPROVINCIA;
					$tip_idtpotramite = $row->TIP_IDTPOTRAMITE;
					$solicitareco = $row->SOLICITARECO;
					$caja = $row->CAJA;
					$nroexpreco = $row->NROEXPRECO;
					$otraactividad = $row->OTRAACTIVIDAD;
					$continua = $row->CONTINUA;
					$observacionfam = $row->OBSERVACIONFAM;
					$observacionserv = $row->OBSERVACIONSERV;
					$foto = $row->FOTO;
					$muerto = $row->MUERTO;
					$idtpoparentesco = $row->IDTPOPARENTESCO;
					$sexo = $row->SEXO;
					$observacionsal = $row->OBSERVACIONSAL;
					$paisext = $row->PAISEXT;
					$localidadext = $row->LOCALIDADEXT;
					$legajo = $row->LEGAJO;
					$celular = $row->CELULAR;
					$mail = $row->MAIL;
					$fechamodif = $row->FECHAMODIF;
					$idtpocaja = $row->IDTPOCAJA;
					$fechafallec = $row->FECHAFALLEC;
					$tipo_persona = $row->TIPO_PERSONA;
					$cuit = $row->CUIT;
					$titular_empresa = $row->TITULAR_EMPRESA;
					$cpext = $row->CPEXT;
					$cuil = $row->CUIL;
					$cod_desc_ordenanza = $row->COD_DESC_ORDENANZA;
					$tipo_activo = $row->TIPO_ACTIVO;
					$cremado = $row->CREMADO;
					$clave = $row->CLAVE;


			//	echo $idpersona . "\n";

				$sql = "INSERT INTO personas(   IDPERSONA,
												IDTPODOC,
												NRODOC,
												IDDIRECTOR,
												IDTPOTRAMITE,
												IDTPOJUB,
												IDTPOPENSION,
												IDTPORECSERV,
												IDTPOESTCIVIL,
												FECHAACTUAL,
												FECHADESDEEC,
												FECHAHASTAEC,
												AUTORIDAD,
												JUZGADO,
												APELLYNOMBRE,
												FECHANACIMIENTO,
												IDTPONAC,
												POLICIA,
												NOMBREPADRE,
												VIVEPADRE,
												NOMBREMADRE,
												VIVEMADRE,
												RESIDEPAIS,
												IDTPOOBRASOCIAL,
												NROAFILIADO,
												SEENCUENTRA,
												NROBENEFICIO,
												NROEXP,
												LUGAR,
												ESCOLARIDAD,
												IDSUCURSAL,
												DOMICILIO,
												TELEFONO,
												IDLOCALIDAD,
												IDPROVINCIA,
												TIP_IDTPOTRAMITE,
												SOLICITARECO,
												CAJA,
												NROEXPRECO,
												OTRAACTIVIDAD,
												CONTINUA,
												OBSERVACIONFAM,
												OBSERVACIONSERV,
												FOTO,
												MUERTO,
												IDTPOPARENTESCO,
												SEXO,
												OBSERVACIONSAL,
												PAISEXT,
												LOCALIDADEXT,
												LEGAJO,
												CELULAR,
												MAIL,
												FECHAMODIF,
												IDTPOCAJA,
												FECHAFALLEC,
												TIPO_PERSONA,
												CUIT,
												TITULAR_EMPRESA,
												CPEXT,
												CUIL,
												COD_DESC_ORDENANZA,
												TIPO_ACTIVO,
												CREMADO,
												CLAVE,
                                                mail2)
										VALUES ('".$idpersona."',
												'".$idtpodoc."',
												'".$nrodoc."',
												'".$iddirector."',
												'".$idtpotramite."',
												'".$idtpojub."',
												'".$idtpopension."',
												'".$idtporecserv."',
												'".$idtpoestcivil."',
												'".$fechaactual."',
												'".$fechadesdeec."',
												'".$fechahastaec."',
												'".$autoridad."',
												'".utf8_decode($juzgado)."',
												'".utf8_decode($apellynombre)."',
												'".$fechanacimiento."',
												'".$idtponac."',
												'".$policia."',
												'".utf8_decode($nombrepadre)."',
												'".$vivepadre."',
												'".utf8_decode($nombremadre)."',
												'".$vivemadre."',
												'".$residepais."',
												'".$idtpoobrasocial."',
												'".$nroafiliado."',
												'".$seencuentra."',
												'".$nrobeneficio."',
												'".$nroexp."',
												'".utf8_decode($lugar)."',
												'".$escolaridad."',
												'".$idsucursal."',
												'".utf8_decode($domicilio)."',
												'".$telefono."',
												'".$idlocalidad."',
												'".$idprovincia."',
												'".$tip_idtpotramite."',
												'".$solicitareco."',
												'".$caja."',
												'".$nroexpreco."',
												'".$otraactividad."',
												'".$continua."',
												'".utf8_decode($observacionfam)."',
												'".utf8_decode($observacionserv)."',
												'".$foto."',
												'".$muerto."',
												'".$idtpoparentesco."',
												'".$sexo."',
												'".utf8_decode($observacionsal)."',
												'".utf8_decode($paisext)."',
												'".utf8_decode($localidadext)."',
												'".$legajo."',
												'".$celular."',
												'".$mail."',
												'".$fechamodif."',
												'".$idtpocaja."',
												'".$fechafallec."',
												'".$tipo_persona."',
												'".$cuit."',
												'".utf8_decode($titular_empresa)."',
												'".$cpext."',
												'".$cuil."',
												'".$cod_desc_ordenanza."',
												'".$tipo_activo."',
												'".$cremado."',
                                                '".$clave."',
												' ')"; 
					$sql=str_replace("''","NULL",$sql);	
                
				$result = mysqli_query($conn, $sql);
				$error_message="";
				if (! empty($result)) {
					$affectedRow ++;
				} else {
					$error_message = mysqli_error($conn) . "\n";
				}
            echo $error_message;
			}
	  //Borrar el fichero
	  //unlink($nombre_fichero);
      echo "El archivo " . $nombre_fichero . " ha sido eliminado." . "\n";			
} else {
    echo "El fichero $nombre_fichero no existe" . "\n";
}				
?>

<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " registros insertados" . "\n";
} else {
    $message = "Registro no insertado" . "\n";
}
?>



<?php  echo $message; ?>
<?php if (! empty($error_message)) { ?>
      <?php echo nl2br($error_message); ?>
<?php } ?>