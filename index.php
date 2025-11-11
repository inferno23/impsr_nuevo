<?php



include 'head.php'; ?>

<?php include 'header.php'; ?>



<div class="sub-menu">

    <div class="container">

        <div class="row">

            <div class="col-12 col-lg-4 col-md-5 col-sm-6">

                <div class="row  mt-2 mt-sm-0">

                    <form class="col-12 form-inline input-group input-group-sm">

                        <input class="form-control" id="inputBuscar" type="search" placeholder="Buscar"

                            aria-label="Search">

                        <div class="input-group-append">

                            <button class="btn btn-outline-success my-2 my-sm-0" id="btnBuscar" type="submit"><svg

                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"

                                    class="bi bi-search" viewBox="0 0 16 16">

                                    <path

                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />

                                </svg></button>

                        </div>

                    </form>

                </div>



            </div>

            <div class="col-12 col-lg-8 col-md-7 col-sm-6">

                <div class="row  mt-sm-0">

                    <div class="col-12 d-flex" style="justify-content: flex-end;">

                        <a href="http://facebook.com/impsr" target="_blank" class="mx-1 d-flex"><img

                                src="img/logofb.png" class="img-fluid my-auto" style="width:32px;"></a>

                        <a href="http://instagram.com/imps_rosario" target="_blank" class="mx-1 d-flex"><img

                                src="img/logoin.png" class="img-fluid my-auto" style="width:32px;"></a>

                        <a href="https://walink.co/c05914" target="_blank" class="mx-1 d-flex"><img src="img/logowa.png"

                                class="img-fluid my-auto" style="width:32px;"></a>

                        <?php if (isset($_SESSION['APELLYNOMBRE'])) { ?>

                        <div class="dropdown ml-auto">

                            <button class="btn btn-link btn-drop dropdown-toggle" type="button" id="dropdownMenuButton"

                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fa fa-user-circle" aria-hidden="true"></i>

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item px-2" href="mis-datos.php">Mis Datos</a>

                                <a class="dropdown-item px-2" href="recibo-haberes.php">Mis Recibos</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item px-2" href="logout.php">Salir</a>

                            </div>

                        </div>

                        <?php }else {?>

                        <a class="btn btn-link btn-icono p-0" href="login.php"><img src="img/login.png"

                                class="img-fluid my-auto" style="width:32px;"></a>

                        <!--<a class="btn btn-link btn-icono p-0 ml-auto" href="login.php"><i class="fa fa-sign-in " aria-hidden="true"></i></a>-->

                        <?php } ?>

                    </div>

                </div>

            </div>



        </div>

    </div>

    <hr>

</div>



<script>

$('#carouselExampleControls').carousel('pause');

</script>

<style>

<!--

.carousel-item .mascara {

    display: block;

    width: 100%;

    height: 100%;

    position: absolute;

    top: 0;

    left: 0;

    z-index: 10;

    background: rgba(0, 0, 0, 0.25);

    background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.26) 0%, rgba(237, 237, 237, 0) 13%, rgba(255, 255, 255, 0) 14%, rgba(255, 255, 255, 0) 35%, rgba(255, 255, 255, 0) 48%, rgba(255, 255, 255, 0.06) 51%, rgba(0, 0, 0, 1) 96%);

    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0.25)), color-stop(0%, rgba(0, 0, 0, 0.26)), color-stop(13%, rgba(237, 237, 237, 0)), color-stop(14%, rgba(255, 255, 255, 0)), color-stop(35%, rgba(255, 255, 255, 0)), color-stop(48%, rgba(255, 255, 255, 0)), color-stop(51%, rgba(255, 255, 255, 0.06)), color-stop(96%, rgba(0, 0, 0, 1)));

    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.26) 0%, rgba(237, 237, 237, 0) 13%, rgba(255, 255, 255, 0) 14%, rgba(255, 255, 255, 0) 35%, rgba(255, 255, 255, 0) 48%, rgba(255, 255, 255, 0.06) 51%, rgba(0, 0, 0, 1) 96%);

    background: -o-linear-gradient(top, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.26) 0%, rgba(237, 237, 237, 0) 13%, rgba(255, 255, 255, 0) 14%, rgba(255, 255, 255, 0) 35%, rgba(255, 255, 255, 0) 48%, rgba(255, 255, 255, 0.06) 51%, rgba(0, 0, 0, 1) 96%);

    background: -ms-linear-gradient(top, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.26) 0%, rgba(237, 237, 237, 0) 13%, rgba(255, 255, 255, 0) 14%, rgba(255, 255, 255, 0) 35%, rgba(255, 255, 255, 0) 48%, rgba(255, 255, 255, 0.06) 51%, rgba(0, 0, 0, 1) 96%);

    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.26) 0%, rgba(237, 237, 237, 0) 13%, rgba(255, 255, 255, 0) 14%, rgba(255, 255, 255, 0) 35%, rgba(255, 255, 255, 0) 48%, rgba(255, 255, 255, 0.06) 51%, rgba(0, 0, 0, 1) 96%);

    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000', GradientType=0);

}



.carousel-item .seccion {

    position: absolute;

    top: 10px;

    font-size: .6797rem;

    padding: .3rem 2rem;

    margin-bottom: 2%;

    text-transform: uppercase;

    display: inline-block;

    vertical-align: top;

    background-color: #1E619A;

    color: #FFF !important;

}



.list-link {

    background-position: center;

    border-radius: 0 !important;

    padding: 0;

    border: 0;

}



.list-front {

    padding: .75rem 1.25rem;

    width: 100%;

    height: 100%;

    background-color: #00bee3;

    display: flex;

    background: linear-gradient(to right, rgb(20 101 149 / 99%) 20%, rgb(210 195 195 / 0%));

}



.list-span {

    color: #fff;

    font-size: 1.5em;

    font-weight: 600;

    margin-top: auto;

    margin-bottom: auto;

}



.list-link:hover {

    background-color: #1E619A;

    color: #fff;

}



.list-link:active {

    background-color: #1E619A;

    color: #fff;

}



.list-link:focus {

    background-color: #1E619A;

    color: #fff;

}



.menu-detalle .dropdown-item {

    font-size: 1.2em;

    color: #1e619a;

    display: flex;

    padding-top: 0.6rem;

    padding-bottom: 0.6rem;

}



.menu-detalle .dropdown-item:hover {

    color: #fff;

}



.menu-detalle .dropdown-item span {

    margin-left: auto;

}



.box-style-pens-eturnos {

    padding: 5px;

    border: Gainsboro 1px solid;

    border-radius: 5px;

    background-color: #f8f8f8;

}



.box-style-pens-eturnos-head {

    padding: 0px;

    text-align: center;

}



.box-style-pens-eturnos-head img {

    width: 20%;

    margin: auto;

    height: auto;



}



.box-style-pens-eturnos-body {

    border: 0px;

    text-align: center;

}



.box-style-pens-eturnos-body p {

    font-size: 11pt;

}

-->

.link-acceso

{

text-decoration:none

 !important;

display:

block;

background-color:

#E2EFF0;

padding:

5px

10px

5px

10px

 !important;

border:

#1DA1F2

1px

solid

 !important;

color:

#1DA1F2;

border-radius:5px;

align-items:

center;

justify-content:

center;

padding:5px;

text-align:

center;

}

.link-acceso

img

{

display:block;

margin-left:auto;

margin-right:

auto;

width:

30%;

margin-top:5px;

margin-bottom:

5px;

}

.link-acceso

span

{

color:

#0072BC;

font-size:1em;

font-weight:700;

text-align:

center;

}

.link-acceso:hover

span

{

color:

#646464;

text-decoration:

underline;

}

#botones

{

position:relative;

}

.menu-detalle

{

position:

absolute;

top:

0px;

right:

calc(-200%

-

60px);

z-index:

10;

width:

100%;

}

@media

(max-width:

768px)

{

.menu-detalle

{

position:

relative;

top:

0px;

right:

0px;

z-index:

10;

width:

100%;

}

}

</style>



<div class="container">

    <div class="row">

        <div class="col-12 mb-3">

            <img src="https://impsr.gob.ar/img/bannerwap.png" alt="imagen banner" class="w-100 img-fluid ">

        </div>

    </div>



    <div class="row">

        <div class="col-12 col-sm-4 order-md-1 order-2">

            <section id="botones">

                <div class="list-group">

                    <a href="#" data-id="menu1" style="background-image: url(https://impsr.gob.ar/img/tramites.jpg);"

                        class="list-group-item list-group-item-action list-link abreMenu mb-3 ">

                        <span class="list-front">

                            <span class="list-span">Trámites</span>

                        </span>

                    </a>

                    <div class="collapse menu-detalle" id="menu1">

                        <div class="card card-body">

                            <div class="list-group">

                                <a class="dropdown-item" href="jubilacionord.php">Jubilación ordinaria <span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="jubilacion_para_ex_presos_politicos.php">Jubilación

                                    optativa para ex presos políticos<span><i class="fa fa-chevron-right"

                                            aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="jubilacion_por_edad_avanzada.php">Jubilación por edad

                                    avanzada<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="jubilacion_por_invalidez.php">Jubilación por

                                    invalidez<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="jubilacion_por_discapacidad.php">Jubilación por

                                    discapacidad<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item"

                                    href="jubilacion_para_ex_combatientes_de_malvinas.php">Jubilación para ex

                                    combatientes de Malvinas<span><i class="fa fa-chevron-right"

                                            aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="pensiones.php">Pensiones<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="subsidio_jubilatorio.php">Subsidio Jubilatorio<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="cobro_haberes_ext.php">Cobro de haberes en el

                                    exterior<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                              <a class="dropdown-item" href="salario_familiar.php">Salario familiar<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="pago_de_haberes.php">Pago de Haberes<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="comunicacion_de_fallecimiento.php">Comunicación subsidio

                                    por fallecimiento<span><i class="fa fa-chevron-right"

                                            aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="reco_de_servicio.php">Reconocimiento de Servicio<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="creditos_personales.php">Créditos Personales<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                 <a class="dropdown-item" href="poder.php">Formulario Poder<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                            </div>

                        </div>

                    </div>

                    <a href="#" data-id="menu2" style="background-image: url(https://impsr.gob.ar/img/servicios.jpg);"

                        class="list-group-item list-group-item-action list-link abreMenu mb-3">

                        <span class="list-front">

                            <span class="list-span">Servicios</span>

                        </span></a>

                    <div class="collapse menu-detalle" id="menu2">

                        <div class="card card-body">

                            <div class="list-group">

                                <a class="dropdown-item" href="calendario.php">Calendario de pagos<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item"

                                    href="http://servicioswww.anses.gov.ar/ConstanciadeCuil2/Inicio.aspx"

                                    target="_blank">Constancia de Cuil<span><i class="fa fa-chevron-right"

                                            aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="constancia_no_beneficio.php">Contancia No

                                    Beneficio<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="consulta.php">Consulta de expedientes<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="no_inicio_tramite.php">NO Inicio de Trámite<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="http://impsr.gob.ar/turismo/">Turismo<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="iapos.php">Iapos<span><i class="fa fa-chevron-right"

                                            aria-hidden="true"></i></span></a>

                                <a class="dropdown-item" href="servicios_funebres.php">Servicios fúnebres<span><i

                                            class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item"

                                    href="https://www.lacaja.com.ar/estaticos/micrositio-rosario/MS-Rosario/">Seguros

                                    de vida<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>

                                <a class="dropdown-item"

                                    href="https://seguros.lacaja.com.ar/personas/centro-de-operaciones-online">Certificados

                                    de Incorporación<span><i class="fa fa-chevron-right"

                                            aria-hidden="true"></i></span></a>

                            </div>

                        </div>

                    </div>

                    <a href="legislacion.php" style="background-image: url(https://impsr.gob.ar/img/legislacion.jpg);"

                        data-id="menu3" class="list-group-item list-group-item-action list-link mb-3">

                        <span class="list-front">

                            <span class="list-span">Legislación</span>

                        </span>

                    </a>



                    <a href="licitaciones"

                        style="background-image: url(https://impsr.gob.ar/img/licitaciones.jpg);" data-id="menu4"

                        class="list-group-item list-group-item-action list-link ">

                        <span class="list-front">

                            <span class="list-span">Licitaciones</span>

                        </span>

                    </a>



                </div>









            </section>

        </div>

        <div class="col-12 col-sm-8 order-md-2 order-1" id="sliders">

            <section id="presentacion">

                <?php 

                include_once 'functions/connect.php';

                global $con;

                $nov=mysqli_query($con, "SELECT a.*,b.nombre nomseccion FROM novedades a LEFT JOIN novedades_secciones b ON a.seccion=b.id WHERE a.activo='1' ORDER BY `a`.`principal` DESC , a.fecha DESC");		

                ?>

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">

                        <?php 

                      $i=0;

                      while ($row=mysqli_fetch_assoc($nov)) { ?>

                        <li data-target="#carouselExampleControls" data-slide-to="<?php echo $i;?>"

                            <?php if ($row['principal']=='1') { echo ' class=\"active\" '; }?>></li>

                        <?php

                        $i++;

                      } ?>

                    </ol>

                    <div class="carousel-inner" style="min-height: 200px;">

                        <?php 

                      $i=0;

                      mysqli_data_seek($nov, 0);

                      while ($row=mysqli_fetch_assoc($nov)) { ?>

                        <div class="carousel-item <?php if ($row['principal']=='1') { echo ' active '; }?>">

                            <div class="seccion"><?php echo $row['nomseccion'];?></div>

                            <a href="novedades.php?id=<?php echo $row['id'];?>">

                                <img class="d-block w-5 img-fluid" src="<?php echo $row['imagen'];?>" alt="First slide">

                            </a>

                            <div class="carousel-caption d-none d-md-block">

                                <h3><a href="noticia.php?id=<?php echo $row['id'];?>"><?php echo $row['titulo'];?></a>

                                </h3>

                                <p><a href="noticia.php?id=<?php echo $row['id'];?>"><?php echo $row['subtitulo'];?></a>

                                </p>

                            </div>

                        </div>

                        <?php

                        $i++;

                      } ?>

                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                        <span class="sr-only">Previous</span>

                    </a>

                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

                        <span class="carousel-control-next-icon" aria-hidden="true"></span>

                        <span class="sr-only">Next</span>

                    </a>

                </div>

            </section>

            <section id="accesos" class="w-100">



                <div class="row h-100 mt-3">

                    <div class="col-6 col-md-6 col-lg-3 d-flex mb-3">

                        <a href="https://impsr.gob.ar/constancia_no_beneficio.php" class="w-100  border link-acceso">

                            <img alt="icono constancia" src="img/constancia.svg" class="img-fluid">

                            <span>Constancia NO Beneficio</span>

                        </a>

                    </div>

                    <div class="col-6 col-md-6 col-lg-3 d-flex mb-3">

                        <a href="https://impsr.gob.ar/consulta.php" class="w-100  border link-acceso">

                            <img alt="icono constancia" src="img/logo1111.jpg" class="img-fluid">

                            <span>Consulta Expediente</span>

                        </a>

                    </div>

                    <div class="col-6 col-md-6 col-lg-3 d-flex mb-3">

                        <a href="https://impsr.gob.ar/calendario.php" class="w-100  border link-acceso">

                            <img alt="icono constancia" src="img/calendario.svg" class="img-fluid">

                            <span>Calendario de Pagos</span>

                        </a>

                    </div>

                    <div class="col-6 col-md-6 col-lg-3 d-flex mb-3">

                        <a href="https://impsrtest.impsr.gob.ar/login.php" class="w-100  border link-acceso">

                            <img alt="icono constancia" src="img/recibo.svg" class="img-fluid">

                            <span>Recibo Digital</span>

                        </a>

                    </div>

                </div>

            </section>

        </div>

    </div>

    <div class="row mb-1">

        <div class="col-md-6">

            <div class="box-style-pens-eturnos">



                <div class="box-style-pens-eturnos-body">

                    <a href="https://impsr.gob.ar/turismo/"><img class="img-fluid" src="img/hotel.jpg"></a>



                </div>

            </div>

            <br>

        </div>

        <div class="col-md-6">

            <div class="box-style-pens-eturnos">

                <div class="box-style-pens-eturnos-head">

                    <a href="https://impsr.gob.ar/solicitar_turnonew.php" target="_blank">

                        <img src="img/turnos.svg">

                    </a>

                </div>

                <div class="box-style-pens-eturnos-body">

                    <a href="https://impsr.gob.ar/solicitar_turnonew.php" target="_blank">

                        <h4>TURNOS ONLINE.<br>INICIACIÓN DE NUEVOS TRÁMITES</h4>

                    </a>

                    <p>

                        Les recordamos que la atención presencial se realiza <strong>solamente mediante Turnos

                            previamente solicitados</strong>.

                        <br><br>

                        Solicite su turno online haciendo click <a href="https://impsr.gob.ar/solicitar_turnonew.php"

                            target="_blank">aquí</a>.

                    </p>

                </div>

            </div>

            <br>

        </div>

    </div>

</div>











<?php include 'footer.php'; ?>



<script src="js/index.js" defer>



</script>