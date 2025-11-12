<?php 
include '../functions/connect.php';
global $con;
$query="SELECT l.*,lt.tipo,le.estado,le.estado FROM licitaciones l LEFT JOIN licitaciones_tipos lt ON l.id_tipo=lt.id LEFT JOIN licitaciones_estados le ON l.id_estado=le.id LEFT JOIN licitaciones_reparticiones lr ON l.id_reparticion=lr.id WHERE l.id_tipo='1' AND l.id_estado='1' ORDER BY l.fecha DESC";
$query1="SELECT l.*,lt.tipo,le.estado,le.estado FROM licitaciones l LEFT JOIN licitaciones_tipos lt ON l.id_tipo=lt.id LEFT JOIN licitaciones_estados le ON l.id_estado=le.id LEFT JOIN licitaciones_reparticiones lr ON l.id_reparticion=lr.id WHERE l.id_tipo='2' AND l.id_estado='1' ORDER BY l.fecha DESC";
$query2="SELECT l.*,lt.tipo,le.estado,le.estado FROM licitaciones l LEFT JOIN licitaciones_tipos lt ON l.id_tipo=lt.id LEFT JOIN licitaciones_estados le ON l.id_estado=le.id LEFT JOIN licitaciones_reparticiones lr ON l.id_reparticion=lr.id WHERE l.id_tipo='3' AND l.id_estado='1' ORDER BY l.fecha DESC";

$licitaciones=$con->query($query);
$licitacionesp=$con->query($query1);
$concursos=$con->query($query2);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Compras y licitaciones</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="styles.css?v=1.7" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medicio - v4.10.0
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?php 
    include 'inc/header.inc.php';
    ?>


    <main id="main" class="container licitaciones">

        <div class="where d-flex gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill"
                viewBox="0 0 16 16">
                <path
                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
            </svg>
            <p>Inicio <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L7 6C7.18048 6.15268 7.18929 6.26386 7 6.5L1 11.5" stroke="black" />
                </svg>
                Licitaciones</p>
        </div>

        <div class="titulo-pag">
            <p>Licitaciones</p>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-8 sectionhome">
                    <h3>Búsquedas por expediente</h3>
                    <p>Realizá búsquedas por número de expediente y año, por tipo de compra o bien por palabras
                        asociadas</p>
                    <a href="busqueda.php" class="btn btn-primary">Buscar</a>
                    <h3 style="margin-top: 1rem; border-top: 1px solid #143c5e; padding-top: 2rem">Para Apertura
                    </h3>
                    <p>Accedé al listado de compras y licitaciones públicas y privadas en estado para apertura</p>
                    <a href="licitaciones.php?estado=apertura" class="btn btn-primary">Buscar</a>
                </div>

                <div class="col-md-3 side-tramites">
                    <img src="img/bn_atencion.png">
                    <h2>Consultas</h2>
                    <hr>
                    <i class="fa fa-phone-square"></i>
                    <p> Comunicate al (0341) 4212015</p>
                    <img src="img/trabajadores.png">
                    <a href="sala.html"><img src="img/multiespacio.jpg" style="margin-top: 2rem;"></a>
                </div>
            </div>

            <div class="row">
                <div class="col-8 sectionhome3">
                    <a href="infogeneral.php">
                        <h3><u> Información general </u></h3>
                    </a>
                    <p>Compras y erogaciones menores, Licitaciones privadas y Licitaciones públicas.</p>
                    <br>
                    <a href="oferentes.php">
                        <h3><u> Oferentes y/o Adjudicatarios </u></h3>
                    </a>
                    <p>Conocé en detalle la información y sobre oferentes y/o adjudicatarios de las compras y
                        licitaciones del Instituto Municipal de Previsión Social de Rosario.</p>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link nav-link2 active" id="home-tab" data-bs-toggle="tab"
                    data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                    aria-selected="true">Licitaciones
                    Privadas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link nav-link2" id="publicas-tab" data-bs-toggle="tab" data-bs-target="#publicas-tab-pane" type="button" role="tab" aria-controls="publicas-tab-pane" aria-selected="true">Licitaciones Publicas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link nav-link2" id="profile-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Concurso de
                    precios</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="tabinterno">
                    <h3 class="text-blue">Licitaciones Privadas</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Expediente</th>
                                <th scope="col" colspan="2">Objeto</th>
                                <th scope="col">Apertura</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($rowl=$licitaciones->fetch_assoc()){?>
                            <tr>
                                <th scope="row"><?php echo $rowl['codigo']; ?></th>
                                <td colspan="2"><a href="licitacion.php?id=<?php echo $rowl['id']?>"><?php echo $rowl['titulo']; ?></a></td>
                                <td><?php echo $rowl['apertura'];?></td>
                        	</tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <div class="flex-end">
                        <a href="licitaciones.php?tipo=privada&estado=apertura" class="btn btn-link">+licitaciones para apertura</a>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade show" id="publicas-tab-pane" role="tabpanel" aria-labelledby="publicas-tab" tabindex="0">
                <div class="tabinterno">
                    <h3 class="text-blue">Licitaciones Publicas</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Expediente</th>
                                <th scope="col" colspan="2">Objeto</th>
                                <th scope="col">Apertura</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($rowl=$licitacionesp->fetch_assoc()){?>
                            <tr>
                                <th scope="row"><?php echo $rowl['codigo']; ?></th>
                                <td colspan="2"><a href="licitacion.php?id=<?php echo $rowl['id']?>"><?php echo $rowl['titulo']; ?></a></td>
                                <td><?php echo $rowl['apertura'];?></td>
                        	</tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <div class="flex-end">
                        <a href="licitaciones.php?tipo=publicas&estado=apertura" class="btn btn-link">+licitaciones para apertura</a>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="tabinterno">
                    <h3 class="text-blue">Concursos de precios</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Expediente</th>
                                <th scope="col" colspan="2">Objeto</th>
                                <th scope="col">Apertura</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($rowl=$concursos->fetch_assoc()){?>
                            <tr>
                                <th scope="row"><?php echo $rowl['codigo']; ?></th>
                                <td colspan="2"><a href="licitacion.php?id=<?php echo $rowl['id'];?>"><?php echo $rowl['titulo']; ?></a></td>
                                <td><?php echo $rowl['apertura'];?></td>
                        	</tr>
                        <?php } ?>   
                        </tbody>
                    </table>

                    <div class="flex-end">
                        <a href="concursos.php?estado=apertura" class="btn btn-link">+ concursos para apertura</a>
                    </div>

                </div>
            </div>
        </div>

    </main><!-- End #main -->



    <!-- ======= Footer ======= -->
    <?php 
    include 'inc/footer.inc.php';
    ?>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

</body>

</html>