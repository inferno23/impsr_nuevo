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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
	
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
  padding: 46px;
  border-radius: 15px;
  box-shadow: 0px 4px 15px rgba(0,0,0,0.2);
  width: 423px; /* 368px + 15% = 423px */
  max-width: 95vw;
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

    /* dialog styles using native <dialog> */
dialog{
  border: none;
  border-radius: 8px;
  padding: 18px;
  width: 360px;
  max-width: 95%;
  box-shadow: 0 6px 20px rgba(0,0,0,0.3);
 }
dialog::backdrop{ background: rgba(0,0,0,0.5); }
.dialog-actions { text-align: right; margin-top: 12px; }
.dialog-actions button { margin-left: 8px; }
  </style>	
</head>
<body>
  
  <div class="login-container">
    <img src="../img/logo_impsr.png" alt="Logo IMPSR" style="display:block;margin:0 auto 18px auto;max-width:110px;max-height:110px;">
    <h5 class="card-title text-center mb-4">IMPS Rosario</h5>
   <form class="form-signin" id="login">
      <div class="mb-3">
        <label for="email" class="form-label">
          Usuario <i class="fas fa-user text-primary ms-1"></i>
        </label>
        <div class="input-group">
          <span class="input-group-text bg-white text-primary"><i class="fas fa-user"></i></span>
          <input type="text" id="email" class="form-control" name="email" placeholder="Su usuario" required autofocus>
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">
          Password <i class="fas fa-lock text-primary ms-1"></i>
        </label>
        <div class="input-group">
          <span class="input-group-text bg-white text-primary"><i class="fas fa-lock"></i></span>
          <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
        </div>
      </div>
      <button class="btn btn-lg btn-primary btn-block text-uppercase w-100 mb-2" type="submit"><i class="fas fa-sign-in-alt me-2"></i>Ingresar</button>
      <p id="aviso" class="alert" style="display: none;"></p>
      <p class="extra-links"><a href="#" id="olvido"><i class="fas fa-key me-1"></i>¿Olvidó su clave?</a></p>
   </form>
  </div>

<!-- Diálogo nativo: Solicitar Recupero -->
<dialog id="dialogRecupero" aria-labelledby="recTitle">
  <h5 id="recTitle">Recuperar contraseña</h5>
  <div>
    <label for="rec_email">Ingrese su email</label>
    <input type="email" id="rec_email" class="form-control" placeholder="email@dominio.com">
  </div>
  <div id="rec_msg" class="alert" style="display:none;margin-top:10px;"></div>
  <div class="dialog-actions">
    <button type="button" id="rec_close" class="btn btn-secondary">Cerrar</button>
    <button type="button" id="rec_enviar" class="btn btn-primary">Enviar email de recuperación</button>
  </div>
</dialog>

<!-- Diálogo nativo: Reset Password -->
<dialog id="dialogReset" aria-labelledby="resetTitle">
  <h5 id="resetTitle">Crear nueva contraseña</h5>
  <input type="hidden" id="reset_token">
  <input type="hidden" id="reset_email">
  <div style="margin-top:8px;">
    <label for="new_pass1">Nueva contraseña</label>
    <input type="password" id="new_pass1" class="form-control">
  </div>
  <div style="margin-top:8px;">
    <label for="new_pass2">Repetir contraseña</label>
    <input type="password" id="new_pass2" class="form-control">
  </div>
  <div id="reset_msg" class="alert" style="display:none;margin-top:10px;"></div>
  <div class="dialog-actions">
    <button type="button" id="reset_close" class="btn btn-secondary">Cerrar</button>
    <button type="button" id="reset_submit" class="btn btn-primary">Guardar nueva contraseña</button>
  </div>
</dialog>

  <script type="text/javascript" src="js/funciones.js"></script>
  <script>
 document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('login');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(form);
        fetch('inc/entrar.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) { return response.json(); })
        .then(function(result) {
            var aviso = document.getElementById('aviso');
            if (result.success) {
                aviso.style.display = 'block';
                aviso.classList.remove('alert-warning');
                aviso.classList.add('alert-success');
                aviso.innerHTML = 'Datos Aceptados, Bienvenido';
                setTimeout(function(){ window.location = 'index.php'; }, 2000);
            } else {
                aviso.style.display = 'block';
                aviso.classList.remove('alert-success');
                aviso.classList.add('alert-warning');
                aviso.innerHTML = result.mensaje || 'Error';
                console.log(result.error);
                setTimeout(function(){ aviso.style.transition = 'opacity 0.5s'; aviso.style.opacity = '0'; }, 3000);
            }
        })
        .catch(function(err) {
            var aviso = document.getElementById('aviso');
            aviso.style.display = 'block';
            aviso.classList.remove('alert-success');
            aviso.classList.add('alert-warning');
            aviso.innerHTML = 'Error de red';
            console.error(err);
        });
    });

    // usar elemento <dialog>
    var dialogRecupero = document.getElementById('dialogRecupero');
    var dialogReset = document.getElementById('dialogReset');
    var olvido = document.getElementById('olvido');
    olvido.addEventListener('click', function(e){ e.preventDefault(); document.getElementById('rec_msg').style.display='none'; if (typeof dialogRecupero.showModal === 'function') dialogRecupero.showModal(); else dialogRecupero.style.display='block'; });
    document.getElementById('rec_close').addEventListener('click', function(){ if (typeof dialogRecupero.close === 'function') dialogRecupero.close(); else dialogRecupero.style.display='none'; });

    document.getElementById('rec_enviar').addEventListener('click', function(){
        var email = document.getElementById('rec_email').value.trim();
        var msg = document.getElementById('rec_msg');
        if (!email) { msg.style.display='block'; msg.className='alert alert-warning'; msg.innerText='Ingrese un email válido'; return; }
        msg.style.display='block'; msg.className='alert alert-info'; msg.innerText='Enviando...';
        fetch('inc/solicitar_recupero.php', { method:'POST', body: new URLSearchParams({ email: email }) })
        .then(function(r){ return r.json(); })
        .then(function(res){
            if (res.success) { msg.className='alert alert-success'; msg.innerText='Email enviado. Revise su casilla.'; }
            else { msg.className='alert alert-warning'; msg.innerText = res.mensaje || 'No se pudo enviar el email'; }
        }).catch(function(err){ msg.className='alert alert-danger'; msg.innerText='Error de red'; console.error(err); });
    });

    // Si llegó con token en URL, validar y abrir modal reset
    var urlParams = new URLSearchParams(window.location.search);
    var token = urlParams.get('token');
    var email = urlParams.get('email');
    if (token && email) {
        // limpiar parámetros de la URL para no exponerlos
        if (window.history && window.history.replaceState) {
            var cleanUrl = window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
        }
        // validar token
        fetch('inc/validar_token.php?token='+encodeURIComponent(token)+'&email='+encodeURIComponent(email))
        .then(function(r){ return r.json(); })
        .then(function(res){
            if (res.success) {
                document.getElementById('reset_token').value = token;
                document.getElementById('reset_email').value = email;
                document.getElementById('reset_msg').style.display='none';
                if (typeof dialogReset.showModal === 'function') dialogReset.showModal(); else dialogReset.style.display='block';
            } else {
                alert('Link inválido o expirado');
            }
        }).catch(function(err){ console.error(err); alert('Error validando link'); });
    }

    document.getElementById('reset_close').addEventListener('click', function(){ if (typeof dialogReset.close === 'function') dialogReset.close(); else dialogReset.style.display='none'; });
    document.getElementById('reset_submit').addEventListener('click', function(){
        var p1 = document.getElementById('new_pass1').value;
        var p2 = document.getElementById('new_pass2').value;
        var token = document.getElementById('reset_token').value;
        var email = document.getElementById('reset_email').value;
        var msg = document.getElementById('reset_msg');
        msg.style.display='block';
        if (!p1 || p1 !== p2) { msg.className='alert alert-warning'; msg.innerText='Las contraseñas no coinciden'; return; }
        msg.className='alert alert-info'; msg.innerText='Guardando...';
        fetch('inc/reset_password.php', { method:'POST', body: new URLSearchParams({ token: token, email: email, password: p1 }) })
        .then(function(r){ return r.json(); })
        .then(function(res){
            if (res.success) { msg.className='alert alert-success'; msg.innerText='Contraseña actualizada. Puede ingresar.'; setTimeout(function(){ window.location='login.php'; },1500); }
            else { msg.className='alert alert-warning'; msg.innerText = res.mensaje || 'No se pudo actualizar'; }
        }).catch(function(err){ msg.className='alert alert-danger'; msg.innerText='Error de red'; console.error(err); });
    });

});
</script>
</body>
</html>