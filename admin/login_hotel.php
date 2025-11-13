<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Hotel - Pago de los Arroyos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
  <style>
    body {
      background: #ecf0f3;
      font-family: 'Poppins', sans-serif;
    }
    .wrapper {
      max-width: 350px;
      margin: 80px auto;
      padding: 40px 30px 30px 30px;
      background-color: #ecf0f3;
      border-radius: 15px;
      box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
    }
    .logo {
      width: 180px;
      margin: auto;
    }
    .logo img {
      width: 100%;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0px 0px 3px #5f5f5f,
        0px 0px 0px 5px #ecf0f3,
        8px 8px 15px #a7aaa7,
        -8px -8px 15px #fff;
    }
    .wrapper .name {
      font-weight: 600;
      font-size: 1.4rem;
      letter-spacing: 1.3px;
      padding-left: 10px;
      color: #555;
    }
    .form-field input {
      width: 100%;
      border: none;
      outline: none;
      background: none;
      font-size: 1.2rem;
      color: #666;
      padding: 10px 15px 10px 10px;
    }
    .form-field {
      padding-left: 10px;
      margin-bottom: 20px;
      border-radius: 20px;
      box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }
    .form-field .fas {
      color: #555;
    }
    .btn {
      width: 100%;
      height: 40px;
      background-color: #03A9F4;
      color: #fff;
      border-radius: 25px;
      box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
      letter-spacing: 1.3px;
      font-weight: 600;
    }
    .btn:hover {
      background-color: #039BE5;
    }
    .message {
      color: red;
      font-size: 1em;
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="logo">
      <img src="images/logo.png" alt="Hotel Logo">
    </div>
    <div class="text-center mt-4 name">
      Login Hotel
    </div>
    <form id="loginHotelForm" class="p-3 mt-3">
      <div class="form-field d-flex align-items-center">
        <span class="far fa-user"></span>
        <input type="text" name="username" id="username" placeholder="Usuario" required>
      </div>
      <div class="form-field d-flex align-items-center">
        <span class="fas fa-key"></span>
        <input type="password" name="password" id="password" placeholder="Contraseña" required>
      </div>
      <button type="submit" class="btn mt-3">Ingresar</button>
      <div id="message" class="message"></div>
    </form>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(function(){
      $('#loginHotelForm').on('submit', function(e){
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        $('#message').text('');
        $.ajax({
          url: 'https://pagodelosarroyos.impsr.gob.ar/index.php?c=inicio&a=login',
          type: 'POST',
          data: { username: username, password: password },
          xhrFields: { withCredentials: true },
          success: function(resp){
            // Suponiendo que la respuesta es JSON con success/error
            console.log(resp);
            try {
              var data = typeof resp === 'string' ? JSON.parse(resp) : resp;
              if(data.success){
                window.location.href = 'https://pagodelosarroyos.impsr.gob.ar/index.php?c=inicio&a=ingreso';
              } else {
                $('#message').text(data.error || 'Usuario o contraseña incorrectos.');
              }
            } catch(e) {
              // Si no es JSON, mostrar la respuesta como texto
              $('#message').text('Error: ' + resp);
            }
          },
          error: function(xhr){
            $('#message').text('Error de conexión o credenciales.');
          }
        });
      });
    });
  </script>
</body>
</html>
