<?php
$_url = explode('/', $_SERVER['REQUEST_URI']);
$_url = explode('.', $_url[count($_url) - 1])[0];
$activeItems[$_url] = 'active';
?>
<script>
$(document).ready(function() {
    $.getJSON(
        "https://api.openweathermap.org/data/2.5/weather?q=Rosario,ar&units=metric&appid=3d5b53f423f564fd725fdfc95e7aa28e",
        function(data) {
            var temp = Math.round(data.main.temp);
            $("#tiempoTemp").html(temp + " °");
            var img = "http://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
            $('#tiempoIcono').attr('src', img);
        });
    $('#btnBuscar').click(function(e) {
        e.preventDefault();
        var q = $('#inputBuscar').val();
        $(location).attr('href', 'resultados.php?q=' + q);

    });
});
</script>
<style>
.navbar-nav .dropdown-item {
    white-space: normal !important;
}

#navbarResponsive .nav-link {
    text-align: center;
    justify-content: center;
    text-transform: none;
    color: white;
    font-weight: normal;
    letter-spacing: 1px;
    font-family: "Roboto", sans-serif;
    font-size: 13px;
    white-space: nowrap;
    font-weight: normal;
    letter-spacing: 1px;
}

#navbarResponsive .nav-link:hover {
    color: #98cfff;
    background-color: transparent;
}

.btn-icono {
    display: flex;
    padding: 0;
}

.btn-icono i {
    border: 2px solid;
    padding: 6px;
    border-radius: 50%;
    color: #0056b3;
}

.btn-drop {
    border: 2px solid #0056b3;
    color: #0056b3;
}

.navbar-brand {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0 10px 30px;
    font-family: "Roboto", sans-serif;
    font-size: 13px;
    color: #626262;
    white-space: nowrap;
    transition: 0.3s;
    text-transform: uppercase;
    font-weight: 500;
    font-weight: bold;
}

.navbar .nav-item:last-child {
    border: none;
}
</style>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark nav-blue fixed-top" style="padding: .5rem 1rem; height: 60px">
        <div class="container">
            <!--a class="navbar-brand" href="#">Start Bootstrap</a-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarResponsive">
                <ul class="navbar-nav ml-auto mr-auto w-100">
                    <li style=" width: 20%; ">
                        <div class="">
                            <img src="img/logowhite.png" class="img-fluid my-auto">
                        </div>
                    </li>
                    <li class="nav-item <?php echo $activeItems['index'] ?>" style="width:20%;">
                        <a class="nav-link" href="./">Inicio <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item <?php echo $activeItems['institucional'] ?>" style="width:20%;">
                        <a class="nav-link" href="institucional.php">Institucional</a>
                    </li>
                    <li class="nav-item <?php echo $activeItems['sala'] ?>" style="width: 30%; font-size: 16px;">
                        <a class="nav-link" href="http://multiespacio.impsr.gob.ar/">Multiespacio Nicasio</a>
                    </li>
                    <li class="nav-item" style="width:20%;">
                        <a class="nav-link" href="novedades.php">Novedades</a>
                    </li>
                    <li class="nav-item" style="width:20%;">
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>



                </ul>
            </div>

            <a class="navbar-brand ml-1" style=" margin-right: 10px; color: #fff !important;  line-height: 40px;    padding-top: 0;    padding-bottom: 0; text-transform: none;     font-size: 16px;
">Rosario
                <span id="tiempoTemp" style="margin-left: 5px;">0°</span> <img style="height:40px;" id="tiempoIcono"
                    alt="icono clima" src="http://openweathermap.org/img/w/01n.png"></a>
        </div>

    </nav>