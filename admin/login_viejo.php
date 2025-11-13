<!doctype html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Iniciar Sesión</title>
                                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
                                <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
                                <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
                                <style>::-webkit-scrollbar {
                                  width: 8px;
                                }
                                /* Track */
                                ::-webkit-scrollbar-track {
                                  background: #f1f1f1; 
                                }
                                 
                                /* Handle */
                                ::-webkit-scrollbar-thumb {
                                  background: #888; 
                                }
                                
                                /* Handle on hover */
                                ::-webkit-scrollbar-thumb:hover {
                                  background: #555; 
                                } /* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #ecf0f3;
}

.wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
}

.logo {
    width: 286px;
    height: 196px;
    margin: 0 auto 18px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0px 0px 3px #5f5f5f,
        0px 0px 0px 5px #ecf0f3,,
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

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px;
    /* border: 1px solid red; */
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
}

.wrapper .form-field .fas {
    color: #555;
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #03A9F4;
    color: #fff;
    border-radius: 25px;
    box-shadow: 3px 3px 3px #b1b1b1,
        -3px -3px 3px #fff;
    letter-spacing: 1.3px;
}

.wrapper .btn:hover {
    background-color: #039BE5;
}

.wrapper a {
    text-decoration: none;
    font-size: 0.8rem;
    color: #03A9F4;
}

.wrapper a:hover {
    color: #039BE5;
}

@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px;
    }
}</style>
 </head>
    <body style="background-image: url('images/logo3.jpg');background-size: cover; background-repeat: no-repeat;">
    
    
    <div class="wrapper" style="max-width: 480px; min-height: 520px; background: rgba(255,255,255,0.85); border-radius: 18px; box-shadow: 0 8px 32px rgba(60,120,180,0.12), 0 1.5px 8px #b3e0ff; position: relative; overflow: hidden;">
                <div class="text-center mt-4 name" style="font-weight: 700; font-size: 1.5rem; letter-spacing: 1.5px; color: #1976d2; text-shadow: 0 1px 0 #e6f7ff; margin-bottom: 10px;">BIENVENIDO AL HOTEL PAGO DE LOS ARROYOS</div>

        <div class="text-center mt-4 name" style="font-weight: 700; font-size: 1.5rem; letter-spacing: 1.5px; color: #1976d2; text-shadow: 0 1px 0 #e6f7ff; margin-bottom: 10px;">Iniciar Sesión</div>
        <?php 
        $url='https://pagodelosarroyos.impsr.gob.ar/index.php?c=inicio&a=login';
        //$url='http://localhost/pagodelosarroyos/';

        //c=habitaciones&a=listar

       //  echo $url;
        ?>

        <form action= "<?php echo $url;?>" method="POST" class="p-3 mt-3">
          <div class="form-field d-flex align-items-center" style="padding-left: 10px; margin-bottom: 22px; border-radius: 16px; box-shadow: inset 4px 4px 8px #b3e0ff, inset -4px -4px 8px #e6f7ff; background: #e6f7ff; position: relative; z-index: 1;">
            <span class="far fa-user" style="color: #1976d2; font-size: 1.2em; margin-right: 8px;"></span>
            <input type="text" name="username" id="username" placeholder="Usuario" style="width: 100%; border: none; outline: none; background: none; font-size: 1.15rem; color: #1976d2; padding: 10px 15px 10px 10px; background: #e6f7ff; border-radius: 12px; box-shadow: 0 1px 4px #b3e0ff; font-weight: 500;">
          </div>
          <div class="form-field d-flex align-items-center" style="padding-left: 10px; margin-bottom: 22px; border-radius: 16px; box-shadow: inset 4px 4px 8px #b3e0ff, inset -4px -4px 8px #e6f7ff; background: #e6f7ff; position: relative; z-index: 1;">
            <span class="fas fa-key" style="color: #1976d2; font-size: 1.2em; margin-right: 8px;"></span>
            <input type="password" name="password" id="password" placeholder="Contraseña" style="width: 100%; border: none; outline: none; background: none; font-size: 1.15rem; color: #1976d2; padding: 10px 15px 10px 10px; background: #e6f7ff; border-radius: 12px; box-shadow: 0 1px 4px #b3e0ff; font-weight: 500;">
          </div>
          <button type="submit" class="btn mt-3" style="width: 100%; height: 44px; background: linear-gradient(90deg, #90caf9 0%, #1976d2 100%); color: #fff; border-radius: 25px; box-shadow: 0 2px 8px #b3e0ff; letter-spacing: 1.3px; font-weight: 700; font-size: 1.1em; border: none; transition: background 0.2s;">Ingresar</button>
          <p id="message" style="color:red;"></p>
        </form>
       </div>
      <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
       
  </html>

