<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php 
	$formAction = 'functions/authentication-recuperar.php';
?>
<script type="text/javascript">
	function onLoginInput(event) {
		var element = document.getElementsByName(event.target.name)[0];
		
		if (event.target.value && event.target.value.length) {
			element.classList.add("has-val");
		} else {
			element.classList.remove("has-val");
		}
	}
</script>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<?php if (isset($_GET['update_password']) && $_GET['update_password'] === 'success') { ?>
				<p class="login100-form-avatar">
					<img src="img/logo_impsr.png" alt="AVATAR">
				</p>
				<div class="wrap-input100 m-b-50" style="border: none!important; text-align: center;">
					<span class="alert alert-success">
						La contraseña fue actualizada con éxito!
					</span>
					<p></p>
					<p></p>
					<div>
						<p>
							<a href="login.html" class="btn btn-outline-success my-2 my-sm-0">
								Iniciar sesión
							</a>
						</p>
					</div>
				</div>
				<?php } ?>
				<?php if (!isset($_GET['update_password'])) { ?>
				<form class="login100-form validate-form" method="post" action="<?php echo $formAction ?>">
					<span class="login100-form-avatar">
						<img src="img/logo_impsr.png" alt="AVATAR">
					</span>
					<?php if (isset($_GET['error']) && $_GET['error'] !== '') { ?>
					<div class="wrap-input100 validate-input m-b-50" style="border: none!important; text-align: center;">
						<span class="alert alert-danger">
						<?php if ($_GET['error'] === 'datos_incorrectos') { ?>
							Los datos ingresados son incorrectos
					 	<?php } ?>
					 	<?php if ($_GET['error'] === 'claves_diferentes') { ?>
							Las contraseñas no coinciden
					 	<?php } ?>
						</span>
					</div>
					 <?php } ?>
					<div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate="Usuario">
						<input class="input100" type="text" name="username" oninput="onLoginInput(event)">
						<span class="focus-input100" data-placeholder="Usuario"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Contraseña">
						<input class="input100" type="password" name="password" oninput="onLoginInput(event)">
						<span class="focus-input100" data-placeholder="Contraseña actual"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Contraseña nueva">
						<input class="input100" type="password" name="new_password" oninput="onLoginInput(event)">
						<span class="focus-input100" data-placeholder="Contraseña nueva"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-50" data-validate="Repita contraseña nueva">
						<input class="input100" type="password" name="new_password_confirm" oninput="onLoginInput(event)">
						<span class="focus-input100" data-placeholder="Repita contraseña nueva"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Actualizar contraseña
						</button>
					</div>
					<div class="m-b-8">
						<p></p>
						<p>
							<a href="login.html" class="txt2">
								Volver al login
							</a>
						</p>
					</div>
				</form>
				<?php } ?>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>
</body>
</html>