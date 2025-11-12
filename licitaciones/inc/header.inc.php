<?php
$_url = explode('/', $_SERVER['REQUEST_URI']);
$_url = explode('.', $_url[count($_url) - 1])[0];
$activeItems[$_url] = 'active';
?>
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
    margin: 0 20px;
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

.sub-menu {
    margin-top: 5rem;
}
</style>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg nav-blue fixed-top">
        <div class="container nav-blue">

            <div class="collapse" id="navbarToggleExternalContent">
                <div class="nav-blue p-4">
                    <a class="nav-link" href="../">Inicio <span class="sr-only">(current)</span> </a>
                    <a class="nav-link" href="../institucional.html">Institucional</a>
                    <a class="nav-link" href="../sala.html">Multiespacio Nicasio</a>
                    <a class="nav-link" href="../novedades.php">Novedades</a>
                    <a class="nav-link" href="../contacto.php">Contacto</a>
                </div>
            </div>
            <nav class="navbar navbar-dark nav-blue">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>

            <div class="collapse navbar-collapse " id="navbarResponsive">
                <ul class="navbar-nav ml-auto mr-auto w-100">
                    <li style=" width: 20%; ">
                        <div class="">
                            <img src="img/logo (1).png" class="img-fluid my-auto">
                        </div>
                    </li>
                    <li class="nav-item" style="width:20%;">
                        <a class="nav-link" href="../">Inicio <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item" style="width:20%;">
                        <a class="nav-link" href="../institucional.html">Institucional</a>
                    </li>
                    <li class="nav-item" style="width:20%;">
                        <a class="nav-link" href="../sala.html">Multiespacio Nicasio</a>
                    </li>
                    <li class="nav-item" style="width:20%;">
                        <a class="nav-link" href="../novedades.php">Novedades</a>
                    </li>
                    <li class="nav-item" style="width:20%;">
                        <a class="nav-link" href="../contacto.php">Contacto</a>
                    </li>
                </ul>
            </div>

            <div class="navbar-brand">

                <a class="ml-1" style=" margin-right: 10px; color: #fff !important;  line-height: 40px;    padding-top: 0;    padding-bottom: 0; text-transform: none;     font-size: 16px;
">Rosario
                    <span id="tiempoTemp" style="margin-left: 5px;">0°</span> <img style="height:40px;" id="tiempoIcono"
                        alt="icono clima" src="http://openweathermap.org/img/w/01n.png"></a>
            </div>
        </div>

    </nav>