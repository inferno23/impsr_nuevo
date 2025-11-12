<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php
$consulta_enviada = false;
$encontrado = false;
$tramite_encontrado = false;
$persona_tramite = false;

var_dump($_POST);
if ((isset($_POST['nroexpte']) && $_POST['nroexpte'] != '')){
	$expdte = $_POST['nroexpte'];
}else {
	$expdte = false;
}

if ((isset($_POST['dni']) && $_POST['dni'] != '')){
	$nrodni = $_POST['dni'];
}else {
	$nrodni = false;
}

	if($expdte||$nrodni) {
	
	include_once 'functions/connect.php';

		if($nrodni) {

			$sql_persona = "SELECT p.APELLYNOMBRE
					FROM personas p
					WHERE p.NRODOC = ?
					";
			$con->set_charset("utf8");
			$stmt_persona = $con->prepare($sql_persona);
			$stmt_persona->bind_param("s", $nrodni);
			
			$stmt_persona->execute();
		
			$stmt_persona->store_result();
				
			$stmt_persona->bind_result($persona_tramite);

			$stmt_persona->fetch();

		}
		
		$tramites = array();
		if($expdte) {
			$sql = "SELECT m.nroexpte, m.titular, m.tramite, m.destino, m.fecha
					FROM mov_exped m
					WHERE m.NROEXPTE = ? ORDER BY m.fecha ASC, m.destino ASC
					";
					//echo $sql;
                        $con->set_charset("utf8");
			$stmt = $con->prepare($sql);
		
			if ($stmt) {
				if($expdte){
				$stmt->bind_param("s", $expdte);
			}

				$stmt->execute();
				
				$stmt->store_result();
				
				$stmt->bind_result($NROEXPTE, $TITULAR,$TRAMITE,$DESTINO, $FECHA);
				while($stmt->fetch()){
					$tramite_encontrado = array(
						'NROEXPTE' => $NROEXPTE,
						'TITULAR' => $TITULAR,
						'TRAMITE' => $TRAMITE,
						'DESTINO' => $DESTINO,
						'FECHA' => $FECHA
					);
					$tramites[] = $tramite_encontrado;
				}
			}
		}elseif ($nrodni) {

				$sql = 'SELECT m.nroexpte, m.titular, m.tramite, m.destino, m.fecha
				FROM mov_exped m
				WHERE m.titular LIKE "?%" ORDER BY m.fecha';
			
				$stmt = $con->prepare($sql);
			
				if ($stmt) {
					$stmt->bind_param("s", $persona_tramite);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($NROEXPTE, $TITULAR,$TRAMITE,$DESTINO);
					while($stmt->fetch())
					{	
						$tramite_encontrado = array(
							'NROEXPTE' => $NROEXPTE,
							'TITULAR' => $TITULAR,
							'TRAMITE' => $TRAMITE,
							'DESTINO' => $DESTINO,
							'FECHA' => $FECHA
						);
						$tramites[] = $tramite_encontrado;
					}
				}
		}
		$consulta_enviada = true;
	}
?>
<body>

	<div class="container" id="tramites">
		<div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Consulta de Expedientes</p>
	    </div>
	   	<div class="titulo-pag">
	        <p>Consulta de Expedientes</p>
	    </div>
		<div class="descripcion">
			<!--	<p>En esta sección Usted puede conocer en qué dependencia del Organismo se encuentra su trámite.</p>-->
		</div>
        <div class="limiter">
        	<div class="container-login100">
       			<div class="wrap-login100 p-t-85 p-b-20">
                <?php	if ($consulta_enviada&&$NROEXPTE) {	?>
        
        					<div id="certificacion">					
        
        						<!--<img src="img/encabezado.png" width="650px;">-->
        						<h4>MOVIMIENTO DE EXPEDIENTE</h4>
        						<div style="text-align: left;">
        							<p><strong>EXPEDIENTE</strong> <?php echo $tramite_encontrado['NROEXPTE'] ?></p>
        							<p><strong>NOMBRE</strong> <?php echo $tramite_encontrado['TITULAR']?></p>							
        							<p><strong>TRAMITE</strong> <?php echo $tramite_encontrado['TRAMITE'] ?></p>
        							<p><strong>Actualmente</strong> <?php echo $tramite_encontrado['DESTINO'] ?></p>
        						</div>
        						<hr/>	
        						<div>
        							<?php $tramites = array_reverse($tramites); ?>
            						<table border="1" style="width:100%">
            							<tr><th>Fecha </th><th>Destino</th></tr>
            							<?php foreach($tramites as $t)	{ ?>
            							<tr>
            								<td><?php echo date('d-m-Y', strtotime($t['FECHA'])) ?></td>
            								<td><?php echo $t['DESTINO']?></td>
            							</tr>
            							<?php }?>
            							<tr></tr>
            						</table>
        						</div>
        					</div>
        					<hr/>	
        					<div>
            					<p>
            						<input type="button" class="btn btn-success" value="Imprimir constancia" onclick="PrintElem('#certificacion')">
            					</p>	
            					<p style="text-align: center;">
            						<a class="btn btn-outline-secondary" href="consulta.php">Volver a consultar</a>
            					</p>
        					
        					</div>
        			<?php } else { ?>
        			<!--<script>alert('este expediente no tiene ,MOVIEMINTO'); </script>-->
        				
        
        				<form class="login100-form validate-form" method="post" action="consulta.php">
        					<?php if (isset($_GET['error']) && $_GET['error'] === 'datos_incorrectos') { ?>
        					
        					<div class="wrap-input100 validate-input m-b-50" style="border: none!important; text-align: center;">
        						<span class="alert alert-danger">Los datos ingresados son incorrectos</span>
        					</div>
        					 <?php } ?>
        					
        					<input class="form-control mb-2" placeholder="NUMERO DE EXPEDIENTE" type="text" name="nroexpte">
        					
        					<!--<div class="wrap-input100 validate-input m-b-50" data-validate="Documento">
        						<input class="input100" type="number" name="dni">
        						<span class="focus-input100" data-placeholder="Número Documento"></span>
        					</div>-->
        
        					<div class="container-login100-form-btn">
        						<button class="btn btn-success btn-block btn-lg" class="login100-form-btn" >
        							Consultar
        						</button>
        					</div>
        
        					<p class="txt1 restringido">Ingrese el Número Único de su Expediente</p>
        
        				</form>
        				<?php } ?>
        				
        			</div>
        	</div>
        </div>
	</div>


<?php include 'footer.php'; ?>

</body>
</html>
