<?php 
ini_set("log_errors", 1);
ini_set("error_log", "error.log");
error_log('--Insertar datos en tabla municxper--');
echo "Insertar datos en tabla municxper" . "\n";
$conn = mysqli_connect("localhost", "impsr_root", "BvCZRvJ4A3av", "impsr_impsr");

if (!$conn) {
    die('No pudo conectarse: ' . mysql_error());
	error_log('no puede conectarse '.mysql_error($conn));
}else{
echo 'Conectado satisfactoriamente' . "\n";
$affectedRow = 0;

$nombre_fichero = 'municxper.xml';
function numero($valor){
	if($valor>0){
	return number_format($valor, 4, '.', '');
	}else{
	return $valor;
	}
}
function vacio($var){
	if(($var="" ) || (empty($var)) ){
	echo NULL;
	}else{
	return "'".$var."'";
	}
}
function ceros($var){
	if(($var='' ) || (empty($var))){
	return '0';
	}else{
	return $var;
	}
}
function comaacero($var){
	$var2=str_replace(",",".",$var);
	return $var2;
}

if (file_exists($nombre_fichero)) {
	
			$xml = simplexml_load_file("municxper.xml") or die("Error: No se puede crear el objeto");

			foreach ($xml->children() as $row) {
					$codidm = $row->CODIDM;
					$idpersona = $row->IDPERSONA;
					$idderechohab = $row->IDDERECHOHAB;
					$idtpobenef = $row->IDTPOBENEF;
					$jub6116 = $row->JUB6116;
					$nroexpte = $row->NROEXPTE;
					$nrojubilado = $row->NROJUBILADO;
					$fechaalta = $row->FECHAALTA;
					$fechavig = $row->FECHAVIG;
					$fechacese = $row->FECHACESE;
					$diasimps = $row->DIASIMPS;
					$diasotros = $row->DIASOTROS;
					$anttotal = $row->ANTTOTAL;
					$antforanea = $row->ANTFORANEA;
					$haberpen = comaacero($row->HABERPEN);
					$pc = $row->PC;
					$min = $row->MIN;
					$nropen = $row->NROPEN;
					$minincomp = $row->MININCOMP;
					$casahab = $row->CASAHAB;
					$observacion = $row->OBSERVACION;
					$haberactual = $row->HABERACTUAL;
					$servprivilegiado = $row->SERVPRIVILEGIADO;
					$edadcese = $row->EDADCESE;
					$servfornac = $row->SERVFORNAC;
					$servforcajaprov = $row->SERVFORCAJAPROV;
					$tservmunic = $row->TSERVMUNIC;
					$servdonorem = $row->SERVDONOREM;
					$servconaport = $row->SERVCONAPORT;
					$servsinaport = $row->SERVSINAPORT;
					$codrepart = $row->CODREPART;
					$salariofam = $row->SALARIOFAM;
					$nropencomp = $row->NROPENCOMP;
					$procurador = $row->PROCURADOR;
					$tresmin = $row->TRESMIN;
					$fechaliq = $row->FECHALIQ;
					$fechafallecjub = $row->FECHAFALLECJUB;
					$fechavigpen = $row->FECHAVIGPEN;
					$codsalfam = $row->CODSALFAM;
					$remunprom = $row->REMUNPROM;
					$baja = $row->BAJA;
					$idprofesion = $row->IDPROFESION;
					$fechaliqpen = $row->FECHALIQPEN;
					$edadbonifcese = $row->EDADBONIFCESE;
					$meses = $row->MESES;
					$porcdescbco = $row->PORCDESCBCO;
					$segvida = $row->SEGVIDA;
					$segmut = $row->SEGMUT;
					$amtram = $row->AMTRAM;
					$centrojub = $row->CENTROJUB;
					$sind = $row->SIND;
					$cofarma = $row->COFARMA;
					$ecco = $row->ECCO;
					$porcjub = $row->PORCJUB;
					$cajaahorro = $row->CAJAAHORRO;
					$feccambdh = $row->FECCAMBDH;
					$iapos = $row->IAPOS;
					$controlado = $row->CONTROLADO;
					$diasagui = $row->DIASAGUI;
					$nrosuc = $row->NROSUC;
					$iaposcomp = $row->IAPOSCOMP;
					$codexpediente = $row->CODEXPEDIENTE;
					$idfuncion = $row->IDFUNCION;
					$simultaneos = $row->SIMULTANEOS;
					$anttotanses = $row->ANTTOTANSES;
					$anttotprov = $row->ANTTOTPROV;
					$afibco = $row->AFIBCO;
					$compdicbco = $row->COMPDICBCO;
					$fecbajajub = $row->FECBAJAJUB;
					$fecbajapen = $row->FECBAJAPEN;
					$esposa_no = $row->ESPOSA_NO;
					$hijos_no = $row->HIJOS_NO;
					$idcargo = $row->IDCARGO;
					$carnet = $row->CARNET;
					$fechacarnet = $row->FECHACARNET;
					$idfuncionbco = $row->IDFUNCIONBCO;
					$segobli = $row->SEGOBLI;
					$segopc = $row->SEGOPC;
					$iaposop = $row->IAPOSOP;
					$iaposotros = $row->IAPOSOTROS;
					$bancario = $row->BANCARIO;
					$iapostit = $row->IAPOSTIT;
					$iaposcony = $row->IAPOSCONY;
					$iaposhijos = $row->IAPOSHIJOS;
					$iaposotr = $row->IAPOSOTR;
					//$razonprop = $row->RAZONPROP;
					$fecha_ult_acredit = $row->FECHA_ULT_ACREDIT;
				//$jub6116=vacio($jub6116);
				$haberactual=comaacero($haberactual);
            	$segvida=comaacero($segvida);
            	$segmut=comaacero($segmut);
            $segobli=comaacero($segobli);
            $iapostit=comaacero($iapostit);
            $segopc=comaacero($segopc);
				$sql = "INSERT INTO municxper(  CODIDM,
												IDPERSONA,
												IDDERECHOHAB,
												IDTPOBENEF,
												JUB6116,
												NROEXPTE,
												NROJUBILADO,
												FECHAALTA,
												FECHAVIG,
												FECHACESE,
												DIASIMPS,
												DIASOTROS,
												ANTTOTAL,
												ANTFORANEA,
												HABERPEN,
												PC,
												MIN,
												NROPEN,
												MININCOMP,
												CASAHAB,
												OBSERVACION,
												HABERACTUAL,
												SERVPRIVILEGIADO,
												EDADCESE,
												SERVFORNAC,
												SERVFORCAJAPROV,
												TSERVMUNIC,
												SERVDONOREM,
												SERVCONAPORT,
												SERVSINAPORT,
												CODREPART,
												SALARIOFAM,
												NROPENCOMP,
												PROCURADOR,
												TRESMIN,
												FECHALIQ,
												FECHAFALLECJUB,
												FECHAVIGPEN,
												CODSALFAM,
												REMUNPROM,
												BAJA,
												IDPROFESION,
												FECHALIQPEN,
												EDADBONIFCESE,
												MESES,
												PORCDESCBCO,
												SEGVIDA,
												SEGMUT,
												AMTRAM,
												CENTROJUB,
												SIND,
												COFARMA,
												ECCO,
												PORCJUB,
												CAJAAHORRO,
												FECCAMBDH,
												IAPOS,
												CONTROLADO,
												DIASAGUI,
												NROSUC,
												IAPOSCOMP,
												CODEXPEDIENTE,
												IDFUNCION,
												SIMULTANEOS,
												ANTTOTANSES,
												ANTTOTPROV,
												AFIBCO,
												COMPDICBCO,
												FECBAJAJUB,
												FECBAJAPEN,
												ESPOSA_NO,
												HIJOS_NO,
												IDCARGO,
												CARNET,
												FECHACARNET,
												IDFUNCIONBCO,
												SEGOBLI,
												SEGOPC,
												IAPOSOP,
												IAPOSOTROS,
												BANCARIO,
												IAPOSTIT,
												IAPOSCONY,
												IAPOSHIJOS,
												IAPOSOTR,
												FECHA_ULT_ACREDIT)
										VALUES ('$codidm',
												'$idpersona',
												'$idderechohab',
												'$idtpobenef',
												'$jub6116',
												'$nroexpte',
												'$nrojubilado',
												'$fechaalta',
												'$fechavig',
												'$fechacese',
												'$diasimps',
												'$diasotros',
												'$anttotal',
												'$antforanea',
												'$haberpen',
												'$pc',
												'$min',
												'$nropen',
												'$minincomp',
												'$casahab',
												'$observacion',
												'$haberactual',
												'$servprivilegiado',
												'$edadcese',
												'$servfornac',
												'$servforcajaprov',
												'$tservmunic',
												'$servdonorem',
												'$servconaport',
												'$servsinaport',
												'$codrepart',
												'$salariofam',
												'$nropencomp',
												'$procurador',
												'$tresmin',
												'$fechaliq',
												'$fechafallecjub',
												'$fechavigpen',
												'$codsalfam',
												'$remunprom',
												'$baja',
												'$idprofesion',
												'$fechaliqpen',
												'$edadbonifcese',
												'$meses',
												'$porcdescbco',
												'$segvida',
												'$segmut',
												'$amtram',
												'$centrojub',
												'$sind',
												'$cofarma',
												'$ecco',
												'$porcjub',
												'$cajaahorro',
												'$feccambdh',
												'$iapos',
												'$controlado',
												'$diasagui',
												'$nrosuc',
												'$iaposcomp',
												'$codexpediente',
												'$idfuncion',
												'$simultaneos',
												'$anttotanses',
												'$anttotprov',
												'$afibco',
												'$compdicbco',
												'$fecbajajub',
												'$fecbajapen',
												'$esposa_no',
												'$hijos_no',
												'$idcargo',
												'$carnet',
												'$fechacarnet',
												'$idfuncionbco',
												'$segobli',
												'$segopc',
												'$iaposop',
												'$iaposotros',
												'$bancario',
												'$iapostit',
												'$iaposcony',
												'$iaposhijos',
												'$iaposotr',
												'$fecha_ult_acredit')";
				$sql=str_replace("''","NULL",$sql);	
				$result = mysqli_query($conn, $sql);
				//error_log(' consulta '.$sql);
				error_log(' error '.mysqli_error($conn));
				$error_message='';
				if (! empty($result)) {
					$affectedRow ++;
				} else {
					$error_message = mysqli_error($conn) . "\r\n";
                	//echo $sql.'  -  ';
				}
				echo $error_message;
			}
	  //Borrar el fichero
	  //unlink($nombre_fichero);
      echo "El archivo " . $nombre_fichero . " ha sido eliminado." . "\n";
} else {
	error_log('El fichero $nombre_fichero no existe');
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
<?php } 

}
?>