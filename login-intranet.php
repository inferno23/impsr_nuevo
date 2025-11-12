<?php 

session_start();
if (isset($_SESSION['empleado']) && $_SESSION['empleado'] === true) {
	header('Location: ./mis-datos.php');
	
}
?>
<?php include 'head.php'; ?>
<?php include 'header.php'; ?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="post" action="functions/login-intranet.php" id="formLogin">
					<span class="login100-form-avatar">
						<img src="img/logo_impsr.png" alt="AVATAR">
					</span>
					
					<p style="display:none;" id="aviso"></p>
					
					<div class="input-group mt-2 mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text" >Usuario</span>
						</div>
						<input class="form-control" type="text" name="username" id="username">
						
					</div>
					<div class="input-group mb-2" >
						<div class="input-group-prepend">
							<span class="input-group-text" >Contrase√±a</span>
						</div>
						<input class="form-control" type="password" name="password" id="password">
					</div>
					<button type="submit" class="btn btn-success btn-block mb-2">
							Ingresar
						</button>
						<p class="txt1 restringido">Acceso exclusivamente restringido al personal del Instituto Municipal de Previsi√≥n Social de Rosario</p>
					 
				</form>
			</div>
		</div>
	</div>
	<script>
	
$('#formLogin').submit(function(e){
    e.preventDefault();
        const username = $('#username').val();
        const password = $('#password').val();

     $.ajax({
        url: 'login-intranet.php',
        type: 'POST', // Aseg®≤rate de que 'action' est®¶ bien definido en el formulario
          data: { username, password },
            dataType: 'json',
            success: function (response)
            contentType: false, // Esto asegura que se maneje FormData
            cache: false,
            processData: false, // Esto es necesario para FormData
            success: function(data){
            if (data.success){
                $('#aviso').show('slow');
                $('#aviso').removeClass('alert-warning');
                $('#aviso').addClass('alert-success');
                $('#aviso').html('Datos Aceptados, Bienvenidos');
                setTimeout(function(){ window.location = "mis-datos.php"; }, 1000);
            } else {
                $('#aviso').show('slow');
                $('#aviso').removeClass('alert-success');
                $('#aviso').addClass('alert-warning');
                $('#aviso').html(data.mensaje);    
                $('#aviso').delay(3000).fadeOut('slow');
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud Ajax: ", error);
        }
    });
});

</script>
<?php include 'footer.php'; ?>
</body>
</html>