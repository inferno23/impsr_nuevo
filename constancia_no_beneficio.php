<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php
$form_enviado = false;
$encontrado = false;
$persona_encontrada = false;

if (isset($_POST['dni']) && $_POST['dni'] != ''&&is_numeric($_POST['dni'])) {
	include_once 'functions/connect.php';

	$sql = "SELECT nombre, nro_documento, tipo_beneficio, t.DESCRIPCION as DESCRIPCION
			FROM liq_negativa l, tipo_de_tramite t 			
			WHERE nro_documento = ? AND l.tipo_beneficio = t.IDTPOTRAMITE";
	$stmt = $con->prepare($sql);
 
	if ($stmt) {
		$stmt->bind_param("d", $_POST['dni']);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($nombre,$nro_documento,$tipo_beneficio, $descripcion);

		$beneficio = array();
		while( $stmt->fetch()) {

			//mysqli_close($con);
			// var_dump($FECHAACTUAL, $IDTPOTRAMITE);
			$encontrado = true;
		
			$persona_encontrada = array(
				'nombre' => $nombre,
				'nro_documento' => $nro_documento,
				'tipo_beneficio' => $tipo_beneficio,
				'descripcion' => $descripcion,
			);
			$beneficio[] = $descripcion;
		}
	}
			
	
	$form_enviado = true;
}

?>
<body>

	<div class="container" id="tramites">
	        <div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Constancia no beneficio</p>
	      </div>
	      <div class="titulo-pag">
	        <p>Constancia no beneficio</p>
	      </div>
<div class="descripcion">
				<p></p>
</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
			<?php
				if ($form_enviado) {				
					if (count($beneficio) > 0 ) { ?>			
					<div id="certificacion">

					<img src="img/encabezado.png" width="650px;">
					<h4>CONSTANCIA NO BENEFICIO</h4>
					<p><strong>CERTIFICAMOS</strong> que el/la Señor/a <?php echo $persona_encontrada['nombre'] ?> con el DNI 
					<?php echo $persona_encontrada['nro_documento'] ?>, registra los siguientes <strong>BENEFICIOS</strong> en este Instituto.
					<ul>
					<?php foreach($beneficio as $desc){?>
						<li><?php echo $desc; ?></li>
					<?php } ?>
					</ul>
				

					<p>Rosario, <?php echo date('d-m-Y'); ?></p>

					<p>Esta información es válida como documento por el término de 30 días a partir de la fecha de emisión.</p>
					
					<p>La certificación negativa emitida aquí no requiere la autenticación con sello y firma de un agente del IMPSR.</p>

					<p><b>Ante cualquier consulta puede comunicarse con el Instituto Municipal de Previsión Social de Rosario
					 al (0341) 5587023 en el horario de 8:00 a 13:00 hs.</b></p>
					
					<?php
					} else {
					?>
					
					
					<div id="certificacion">
					<img src="img/encabezado.png" width="650px;">
					<h4>CONSTANCIA NO BENEFICIO</h4>
					<p><strong>CERTIFICAMOS</strong> que el documento <?php echo $_POST['dni'] ?> <strong>NO</strong> registra
					 <strong>BENEFICIO</strong> en este Instituto.
					
					
					<p>Rosario, <?php echo date('d-m-Y'); ?></p>

					<p>Esta información es válida como documento por el término de 30 días a partir de la fecha de emisión.</p>
					
					<p>La certificación negativa emitida aquí no requiere la autenticación con sello y firma de un agente del IMPSR.</p>

					<p><b>Ante cualquier consulta puede comunicarse con el Instituto Municipal de Previsión Social de Rosario
					 al (0341) 5587023 en el horario de 8:00 a 13:00 hs.</b></p>
									
										
					<?php } ?>
					</div>
					<p>&nbsp;</p>
						<input class="btn btn-success" type="button" value="Imprimir constancia" onclick="PrintElem('#certificacion')" />

					<p style="text-align: center;">
						<a class="btn btn-outline-secondary" href="./constancia_no_beneficio.php">Volver a consultar</a>
					</p>
				<?php
				} else {
					
				?>
			
				<form class="form" action="constancia_no_beneficio.php" method="post">
				
					<input class="form-control my-3" placeholder="Ingrese su DNI" type="number" name="dni">
					<button class="btn btn-success btn-lg btn-block" type="submit">
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
