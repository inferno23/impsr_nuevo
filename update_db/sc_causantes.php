<?php 
echo "Insertar datos en tabla causantes" . "\n";
$conn = mysqli_connect("localhost", "impsr_root", "BvCZRvJ4A3av", "impsr_impsr");

if (!$conn) {
    die('No pudo conectarse: ' . mysql_error());
}
echo 'Conectado satisfactoriamente' . "\n";
$affectedRow = 0;

$nombre_fichero = 'causantes.xml';

if (file_exists($nombre_fichero)) {
		$xml = simplexml_load_file("causantes.xml") or die("Error: No se puede crear el objeto" . "\n");
		foreach ($xml->children() as $row) {
			$idcausante = $row->IDCAUSANTE;
			$nrodoc = $row->NRODOC;
			$apellynom = $row->APELLYNOM;
			$fechanac = $row->FECHANAC;
			$idtpodoc = $row->IDTPODOC;
			$idtpotramite = $row->IDTPOTRAMITE;
			$idtpojub = $row->IDTPOJUB;
			$idpersona = $row->IDPERSONA;
			$idper = $row->IDPER;
			$fechafallec = $row->FECHAFALLEC;

			$sql = "INSERT INTO causante(   IDCAUSANTE,
											NRODOC,
											APELLYNOM,
											FECHANAC,
											IDTPODOC,
											IDTPOTRAMITE,
											IDTPOJUB,
											IDPERSONA,
											IDPER,
											FECHAFALLEC)
									VALUES ( 
											'".$idcausante."',
											'".$nrodoc."',
											'".$apellynom."',
											'".$fechanac."',
											'".$idtpodoc."',
											'".$idtpotramite."',
											'".$idtpojub."',
											'".$idpersona."',
											'".$idper."',
											'".$fechafallec."')"; 
				$sql=str_replace("''","NULL",$sql);	
			$result = mysqli_query($conn, $sql);
			echo mysqli_error($conn).'\r\n';
			if (! empty($result)) {
				$affectedRow ++;
			} else {
				$error_message = mysqli_error($conn) . "\n";
			}
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