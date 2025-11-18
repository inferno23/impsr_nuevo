<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
    dialog#dialogRecupero {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        min-width: 340px;
        max-width: 95vw;
        background: rgba(255,255,255,0.97);
        border-radius: 8px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        padding: 28px 24px 18px 24px;
        z-index: 9999;
        color: #222;
        font-family: "Poppins", sans-serif;
    }
    dialog#dialogRecupero h5 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: #3a78b7;
        text-align: center;
    }
    dialog#dialogRecupero label {
        font-weight: 500;
        color: #607d8d;
        margin-bottom: 6px;
        display: block;
    }
    dialog#dialogRecupero input[type="email"] {
        width: 100%;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #b7e4c7;
        margin-bottom: 10px;
        font-size: 15px;
        background: #f8f9fa;
        color: #222;
    }
    dialog#dialogRecupero .alert {
        font-size: 14px;
        border-radius: 5px;
        margin-bottom: 8px;
    }
    dialog#dialogRecupero .dialog-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 10px;
    }
    dialog#dialogRecupero button {
        padding: 7px 18px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        background: #3a78b7;
        color: #fff;
        transition: background 0.2s;
    }
    dialog#dialogRecupero button.btn-secondary {
        background: #607d8d;
    }
    dialog#dialogRecupero button:hover {
        background: #155fa0;
    }
    .shake {
      animation: shake 0.4s cubic-bezier(.36,.07,.19,.97) both;
    }
    @keyframes shake {
      10%, 90% { transform: translateX(-2px); }
      20%, 80% { transform: translateX(4px); }
      30%, 50%, 70% { transform: translateX(-8px); }
      40%, 60% { transform: translateX(8px); }
    }
    </style>
    <script src="js/index.js"></script>
</head>

<body>
    <section>
        <div class="box">

            <div class="form">
                    <img src="../img/logo_impsr.png" alt="Logo IMPSR" style="display:block;margin:0 auto 18px auto;max-width:110px;max-height:110px;">
                <p></p>
                <h2>Ingreso al Sistema</h2>
                <form class="" action="index.html" method="post" enctype="multipart/form-data">
                    <div class="inputBx">
                        <label for="email" class="form-label" style="display:block;margin-bottom:4px;">
                            <span style="display:inline-flex;align-items:center;justify-content:flex-start;font-size:1.1rem;font-weight:600;color:#3a78b7;letter-spacing:1px;width:100%;">
                            <span style="color:white;margin-left:40px;text-align:center;">Usuario</span>
                            </span>
                            
                        </label>
                         </div>
                    <div class="inputBx">
                        <img src="images/user.png" alt="" style="width:24px;height:24px;margin-left:auto;filter:drop-shadow(0 2px 6px #3a78b7) brightness(1.15) saturate(1.2);border-radius:6px;background:#e3f2fd;padding:2px;box-shadow:0 1px 4px #b7e4c7;">

                        <input type="text" id="email" name="email" placeholder="Su usuario" required autofocus>
                    </div>

                    <div class="inputBx">
                       <label for="email" class="form-label" style="display:block;margin-bottom:4px;">
                            <span style="display:inline-flex;align-items:center;justify-content:flex-start;font-size:1.1rem;font-weight:600;color:#3a78b7;letter-spacing:1px;width:100%;">
                            <span style="color:white;margin-left:40px;text-align:center;">Contraseña</span>
                            </span>
                            
                        </label>
                        
                         </div>

                    <div class="inputBx">
                      <img src="images/lock.png" alt="" style="width:24px;height:24px;filter:drop-shadow(0 2px 6px #3a78b7) brightness(1.15) saturate(1.2);border-radius:6px;background:#e3f2fd;padding:2px;box-shadow:0 1px 4px #b7e4c7;">
              
                        <input type="password" id="password" name="password" placeholder="Clave" required>
                    </div>
                    <label class="remeber"><input type="checkbox"> Recordar</label>
                    <div class="inputBx">
                        <button type="submit" id="submit" class="btn-login">Ingresar al Sistema</button>
                    </div>

                   
                    <p id="aviso" class="alert" style="display: none;"></p>
                    <p></p>
                    <p class="extra-links"><a href="#" id="olvido"><img src="images/key.png" alt="" style="width:16px;vertical-align:middle;margin-right:4px;">¿Olvidó su clave?</a></p>
                </form>



                

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

<script>

    function validation() {
    let username = document.getElementById("email").value;
    let pass = document.getElementById("password").value;
    if (username != "" && pass != "") {
        document.getElementById("submit2").disabled = false;
    } else {
        document.getElementById("submit2").disabled = true;
    }
}
document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form');
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
                aviso.classList.remove('alert-warning', 'alert-danger');
                aviso.classList.add('alert-success');
                aviso.innerHTML = 'Datos Aceptados, Bienvenido';
                setTimeout(function(){ window.location = 'index.php'; }, 2000);
            } else {
                aviso.style.display = 'block';
                aviso.classList.remove('alert-success', 'alert-warning');
                aviso.classList.add('alert-danger');
                aviso.style.fontSize = '1.3rem';
                aviso.style.fontWeight = '700';
                aviso.style.transition = 'opacity 0.5s, transform 0.5s';
                aviso.style.opacity = '1';
                aviso.style.transform = 'scale(1.08)';
                aviso.innerHTML = '<div class="alert alert-danger"><strong>Usuario o clave incorrectos. Por favor, intente de nuevo.</strong></div>';
                // Mejorar inputs: bordes rojos y más anchos por 7 segundos
                var emailInput = document.getElementById('email');
                var passInput = document.getElementById('password');
                emailInput.style.border = '3px solid #d32f2f';
                passInput.style.border = '3px solid #d32f2f';
                emailInput.style.paddingLeft = '14px';
                passInput.style.paddingLeft = '14px';
                // Efecto vibración
                emailInput.classList.add('shake');
                passInput.classList.add('shake');
                aviso.classList.add('shake');
                setTimeout(function(){
                    aviso.style.opacity = '0';
                    aviso.style.transform = 'scale(0.95)';
                    emailInput.style.border = '';
                    passInput.style.border = '';
                    emailInput.style.paddingLeft = '';
                    passInput.style.paddingLeft = '';
                    emailInput.classList.remove('shake');
                    passInput.classList.remove('shake');
                    aviso.classList.remove('shake');
                }, 7000);
            }
        })
        .catch(function(err) {
            var aviso = document.getElementById('aviso');
            aviso.style.display = 'block';
            aviso.classList.remove('alert-success');
            aviso.classList.add('alert-warning');
            aviso.innerHTML = 'Error de red';
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



    // Recupero clave (solo modal simple)
    var olvido = document.getElementById('olvido233');
    olvido.addEventListener('click', function(e){
        e.preventDefault();
        alert('Solicite la recuperación de clave al administrador.');
    });
});
</script>
                </form>
               

            </div>

        </div>
    </section>

</body>

</html>