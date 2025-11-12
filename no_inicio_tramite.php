<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php
$form_enviado = false;
$encontrado = false;
$persona_encontrada = false;

if (isset($_POST['dni']) && $_POST['dni'] != ''&&is_numeric($_POST['dni'])) {
	include_once 'functions/connect.php';

	$sql = "SELECT p.FECHAACTUAL as FECHAACTUAL, p.APELLYNOMBRE as APELLYNOMBRE, p.NRODOC as NRODOC, p.SEXO as SEXO, p.IDTPOTRAMITE as IDTPOTRAMITE, t.DESCRIPCION as DESCRIPCIONTRAMITE
			FROM personas p, tipo_de_tramite t
			WHERE NRODOC = ? AND FECHAACTUAL >'1970-01-01' AND t.IDTPOTRAMITE = p.IDTPOTRAMITE";
	$stmt = $con->prepare($sql);
	if ($stmt) {
		$stmt->bind_param("s", $_POST['dni']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($FECHAACTUAL, $APELLYNOMBRE,$NRODOC,$SEXO,$IDTPOTRAMITE, $DESCRIPCIONTRAMITE);

		$beneficio = array();
		while( $stmt->fetch()) {
			$encontrado = true;
			$persona_encontrada = array(
				'FECHAACTUAL' => $FECHAACTUAL,
				'APELLYNOMBRE' => $APELLYNOMBRE,
				'NRODOC' => $NRODOC,
				'SEXO' => $SEXO,
				'IDTPOTRAMITE' => $IDTPOTRAMITE,
				'DESCRIPCIONTRAMITE' => $DESCRIPCIONTRAMITE,				
			);
			$beneficio[] = $DESCRIPCIONTRAMITE;
		}
	}

	$form_enviado = true;
}

?>
<body>

	<div class="container" id="tramites">
	        <div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> NO Inicio de TRAMITE</p>
	      </div>
	      <div class="titulo-pag">
	        <p>NO Inicio de Trámite</p>
	      </div>
<div class="descripcion">
				<p></p>
</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
			<?php
				if ($form_enviado) {				
					if (!empty($beneficio)) { ?>
					<div id="certificacion">
					<img src="img/encabezado.png" width="650px;">
					<h4>CONSTANCIA DE TRAMITE INICIADO</h4>
					<p>Se deja <strong>CONSTANCIA</strong> que el/la Señor/a 
					<?php echo $persona_encontrada['APELLYNOMBRE'] ?>, con el DNI <?php echo $persona_encontrada['NRODOC'] ?>
					<?php if (count($beneficio) == 1) { ?>
					ha iniciado expediente por el<strong> BENEFICIO</strong> de <em><?php echo $DESCRIPCIONTRAMITE ?> </p></em>
					<?php } else { ?>
					ha iniciado expediente por los siguientes<strong> BENEFICIOS</strong> 
					<ul>
					<?php foreach($beneficio as $desc) {?>
						<li><?php echo $desc ?></li>
					<?php } ?>
					</ul>
					<?php } ?>
					 

					<p>Rosario, <?php echo date('d-m-Y'); ?></p>

					<p>Esta información es válida como documento por el término de 30 días a partir de la fecha de emisión.</p>

					<p><b>Ante cualquier consulta puede comunicarse con el Instituto Municipal de Previsión Social de Rosario
					 al (0341) 425-6085 en el horario de 7:00 a 13:00 hs.</b></p>
					
					<?php
					} else {
					?>
					
					<div id="certificacion">
					
					<img src="img/encabezado.png" width="650px;">
					<h4>CONSTANCIA DE TRAMITE NO INICIADO</h4>
					Se deja <strong>CONSTANCIA</strong> que a la fecha, el documento <?php echo $_POST['dni'] ?>,
					no ha iniciado expediente solicitando algún tipo de <strong>BENEFICIO</strong>
					en este Instituto.
					
					
					<p>Rosario, <?php echo date('d-m-Y'); ?></p>

					<p>Esta información es válida como documento por el término de 30 días a partir de la fecha de emisión.</p>

					<p><b>Ante cualquier consulta puede comunicarse con el Instituto Municipal de Previsión Social de Rosario
					 al (0341) 5587023 en el horario de 7:00 a 13:00 hs.</b></p>
					 					
					
					<?php } ?>
					</div>
					<!--<p>&nbsp;</p>-->
					<input type="button" class="btn btn-success" value="Imprimir constancia" onclick="PrintElem('#certificacion')" />

					<p style="text-align: center;">
						<a class="btn btn-outline-secondary" href="./no_inicio_tramite.php">Volver a consultar</a>
					</p>
				<?php
				} else {
					
				?>
			
				<form class="form " action="no_inicio_tramite.php" method="post">
				
						<input class="form-control my-3" placeholder="Ingrese su DNI" type="number" name="dni">
					
					
						<button type="submit" class="btn btn-lg btn-success btn-block">
							Consultar
						</button>
					

				</form>
				<?php } ?>
			</div>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>

</body>
</html>
