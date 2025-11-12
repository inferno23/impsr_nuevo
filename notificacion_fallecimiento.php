<?php include 'head.php'; ?>
<?php include 'header.php'; ?>

<body>

	<div class="container" id="tramites">
		<div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Denuncia por Fallecimiento</p>
	    </div>
	   	<div class="titulo-pag">
	        <p>Denuncia por Fallecimiento</p>
	    </div>
		<div class="descripcion">
			<!-- 	-->
		</div>
        <div class="limiter">
        	<div class="container-login100">
       			<div class="pb-5 pt-5">
       				<form action="functions/guardar_notificacion.php" method="POST" enctype="multipart/form-data" id="uploadNotificacion" >
       					<div class="form-group">
                        	<label for="nombre">Nombre</label>
                        	<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre y Apellido del Denunciante" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="dni">DNI</label>
                        	<input type="text" class="form-control" name="dni" id="dni" placeholder="DNI del Denunciante" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="domicilio">Domicilio</label>
                        	<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Calle y altura" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="pensionada">Nombre Beneficiario/a</label>
                        	<input type="text" class="form-control" name="pensionado/a" id="pensionada" placeholder="Nombre Fallecido/a" required>
                      	</div>
                      	<div class="form-row">
                      		<div class="form-group col-12 col-md-6">
                            	<label for="nro">Nro</label>
                            	<input type="text" class="form-control" name="nro" id="nro" placeholder="Nro Beneficiario/a" required>
                          	</div>
                          	<div class="form-group col-12 col-md-6">
                            	<label for="fecha">Fecha Fallecimiento</label>
                            	<input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha Fallecimiento" required>
                          	</div>
                      	</div>
       					<div class="form-group">
                            <label for="archivo">Adjuntar Certificado Fallecimiento</label>
                            <input type="file" class="form-control-file" name="archivo" id="archivo" required>
                            <small id="emailHelp" class="form-text text-muted">Debe scanear o sacar una foto del certificado para adjuntar en el formulario antes de enviarlo</small>
                        </div>
                        <p id="aviso" class="alert" role="alert"></p>
                        <button type="submit" class="btn btn-primary btn-block btn-lg my-5">Enviar</button>
       				</form>
                	
                </div>
        	</div>
        </div>
	</div>


<?php include 'footer.php'; ?>
<script>
$(document).ready(function(){
	$('#uploadNotificacion').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				if (data.success){
					
					$('#aviso').html('Formulario Enviado, gracias');
					$('#aviso').addClass('alert-success');
					$('#aviso').removeClass('alert-danger');
					$('#aviso').show(0).delay(5000).hide(0);
					$("#uploadNotificacion")[0].reset();
				}
				else{
					console.log(data.error);
					$('#aviso').html('Error al subir formulario. contactese con la asistencia');
					$('#aviso').addClass('alert-danger');
					$('#aviso').removeClass('alert-success');
					$('#aviso').show(0).delay(5000).hide(0);
					
				}
			}  
		});			
	});
});
</script>
</body>
</html>
