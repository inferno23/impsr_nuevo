<?php
include '../functions/connect.php';
global $con;
$conectar=$con;

$estados=$conectar->query("SELECT * FROM `licitaciones_estados`");
$tipos=$conectar->query("SELECT * FROM `licitaciones_tipos`");
$reparticiones=$conectar->query("SELECT * FROM `licitaciones_reparticiones`");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Busqueda de licitaciones</title>
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
    <link href="styles.css?v=1.2" rel="stylesheet">

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

    <!-- ======= Hero Section ======= -->
    <section id="hero">

        <!-- Slide 1 -->
        <div class="container">
            <h2>Compras y licitaciones</h2>
            <div class="buscador">
                <h6>Buscador:</h6>
                <a>Información Gral. y Régimen legal</a>
            </div>

        </div>
    </section><!-- End Hero -->

    <main id="main" class="container licitaciones">

        <div class="where">
            <p style="text-transform: none">Para obtener información acerca de Compras y Licitaciones que lleva a cabo
                el Instituto Municipal de Previsión Social de Rosario, puede realizar las siguientes busquedas:
                </p>
        </div>


        <section class="busqueda_expediente">


            <div class="expediente1">
                <div class="diferencial">
                    Búsqueda por Nº de expediente
                </div>
                <div>
                    <p>Ingrese el N º de expediente que desea consultar</p>
                </div>
                <form action="resultadobusqueda.php" method="post">
                <div class="d-flex justify-content-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nro" placeholder="" aria-label="">
                        <span class="input-group-text">/</span>
                        <input type="text" class="form-control" name="year" placeholder="" aria-label="">
                    </div>
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            [aaaa]
                        </span>
                    </div>
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
				</form>
            </div>

            <div class="expediente2">
                <h4>Búsquedas recomendadas</h4>
                <div class="d-grid gap-2">
                    <a href="contrataciones.php?estado=apertura"><button type="button" class="btn btn-light">Contrataciones para apertura</button></a>
                    <a href="contrataciones.php?estado=evaluacion"><button type="button" class="btn btn-light">Contrataciones en evaluacion</button></a>
                </div>

            </div>
        </section>

        <section>
            <div class="expediente">
            	<form id="resul" method="post" action="resultados.php">
                <div class="diferencial">
                    Búsqueda combinada
                </div>
                <div class="d-flex">
                    <p class="w-100 text-bold">Tipo de contratacion</p>
                    <select name="tipo" class="form-select" aria-label="tipo de contraatacion">
                        <option value="" selected>--Todos--</option>
                        <?php while($row=$tipos->fetch_assoc()){ ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['tipo']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="d-flex mt-2">
                    <p class="w-100 text-bold">Estado</p>
                    <select name="estado" class="form-select" aria-label="tipo de contraatacion">
                        <option value="" selected>--Todos--</option>
                        <?php while($row=$estados->fetch_assoc()){ ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['estado']?></option>
                        <?php }?>
                    </select>
                </div>
                <div>
                    <p class="w-100 text-bold mt-4">Fecha de Apertura:</p>
                    <div class="d-flex  selector2 selectores">
                        <p class="w-100 text-bold">Mes</p>
                        <select  name="nro" class="form-select" aria-label="tipo de contraatacion">
                            <option value="" selected>--Todos--</option>
                            <option value="01">Enero</option>
                            <option value="02">Febrero</option>
                            <option value="03">Marzo</option>
                            <option value="04">Abril</option>
                            <option value="05">Mayo</option>
                            <option value="06">Junio</option>
                            <option value="07">Julio</option>
                            <option value="08">Agosto</option>
                            <option value="09">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                        <p class="w-100 text-bold">Año</p>
                        <select name="year" class="form-select" aria-label="tipo de contraatacion">
                            <option value="" selected>--Todos--</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex mt-4">
                    <p class="w-100 text-bold">Reparticion</p>
                    <select name="reparticion" class="form-select" aria-label="tipo de contraatacion">
                        <option value="" selected>--Todos--</option>
                        <?php while($row=$reparticiones->fetch_assoc()){ ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['reparticion']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
				</form>
            </div>
        </section>

        <section>
            <div class="expediente">
            	<form method="get" action="resultadoconsulta.php">
                <div class="diferencial">
                    Búsqueda por palabra asociada
                </div>
                <div class="">
                    <p class="w-100">Ingrese una palabra asociada a la consulta que desea realizar</p>
                    <input type="text" name="q" class="form-control" placeholder="" aria-label="">
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
			    </form>
            </div>
        </section>
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