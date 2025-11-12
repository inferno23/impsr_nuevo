<?php include 'head.php'; ?>
<?php include 'header.php'; ?>


	<div class="limiter">
		<div class="container">
			<div class="card col-sm-5 col-12 ml-auto mr-auto mb-2">
								
				<div class="card-header">
                    <img src="img/logo_impsr.png" style="width:20%; display:block; margin-left:auto;margin-right:auto;" alt="Card image cap">
                </div>
				<div class="card-body">
					<form class="form" method="post" action="https://impsrtest.impsr.gob.ar/functions/login.php" id="formLogin">
                    	<div class="form-group">
                            <label for="username">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username">
                         </div>
                         <div class="form-group">
                            <label for="passwd">Contraseña</label>
                            <input type="password" class="form-control" id="passwd" name="password">
                         </div>
                    	<button type="submit" class="btn btn-success btn-block">Ingresar</button>
                    </form>	
                </div>
                <div class="card-footer text-center" id="aviso">
                </div>
            </div>
		</div>
	</div>
	<script>
	$('#formLogin').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			cache: false,
			dataType: "json",
			processData: false,
			success: function(data){
				console.log(data);
				
				if (data.success){
					$('#aviso').show('slow');
                	$('#aviso').removeClass('alert-warning');
                	$('#aviso').addClass('alert-success');
                	$('#aviso').html('Datos Aceptados, Bienvenido');
				    setTimeout(function(){ window.location = "https://impsrtest.impsr.gob.ar/mis-datos.php"; }, 1000);
				    	
				}else{
					$('#aviso').show('slow');
                	$('#aviso').removeClass('alert-success');
					$('#aviso').addClass('alert-warning');
					$('#aviso').html(data.mensaje);	
					$('#aviso').delay(3000).fadeOut('slow');
				}
			}          
		});
	});
</script>
<?php include 'footer.php'; ?>
</body>
</html>