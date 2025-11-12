<?php












?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ingreso Sistema</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery-3.1.1.min.js" ></script>
	<script src="js/bootstrap.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" type="text/css" media="all" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Bitter:400,700&subset=latin,latin-ext" type="text/css" media="all" />
	
	<script type="text/javascript" src="js/funciones.js"></script>
	<script>
	$(function(){
		$('#login').submit(function(e){
			e.preventDefault();
			$.post('inc/entrar.php', $("#login").serialize(), function (result) {
                if(result.success){
                	$('#aviso').show('slow');
                	$('#aviso').removeClass('alert-warning');
                	$('#aviso').addClass('alert-success');
                	$('#aviso').html('Datos Aceptados, Bienvenido');
                	//location.href = "admin.php";
                	setTimeout(function(){ window.location = "nuevo_admin.php"; }, 2000);
                    }
                else{
                	$('#aviso').show('slow');
                	$('#aviso').removeClass('alert-success');
					$('#aviso').addClass('alert-warning');
					$('#aviso').html(result.mensaje);
					console.log(result.error);					
					$('#aviso').delay(3000).fadeOut('slow');
                    }
                
            }, "json");
			
			
	    });
		
		
	});
	</script>
</head>
<style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #74ebd5, #9face6);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
      width: 320px;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .input-field {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
    }

    .input-field:focus {
      border-color: #6c63ff;
      box-shadow: 0 0 5px #6c63ff;
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      background: #6c63ff;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background: #574bff;
    }

    .extra-links {
      margin-top: 15px;
      font-size: 14px;
    }

    .extra-links a {
      color: #6c63ff;
      text-decoration: none;
      margin: 0 5px;
    }

    .extra-links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
   <h5 class="card-title text-center">IMPS Rosario</h5>
            <form class="form-signin" id="login">
              <div class="form-label-group">
                <input type="text" id="email" class="form-control" name="email" placeholder="Su usuario" required autofocus>
                <label for="inputEmail">Usuario</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              
              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Ingresar</button>
              <p id="aviso" class="alert" style="display: none;"></p>
              <p><a href="recuperar.php">驴Olvid贸 su clave?</a> </p>
            </form>
       
      </div>
    </form>
  </div>
</body>
</html>