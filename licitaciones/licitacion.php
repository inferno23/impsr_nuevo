<?php 
include '../functions/connect.php';
global $con;
$conectar=$con;
$id=$_GET['id'];

$query="SELECT l.*,lt.tipo,le.estado,le.estado FROM licitaciones l LEFT JOIN licitaciones_tipos lt ON l.id_tipo=lt.id LEFT JOIN licitaciones_estados le ON l.id_estado=le.id LEFT JOIN licitaciones_reparticiones lr ON l.id_reparticion=lr.id  WHERE l.id='$id'";
$lici=$conectar->query($query);
$row=$lici->fetch_assoc();

$archivos=$conectar->query("SELECT * FROM licitaciones_archivos WHERE id_licitacion='$id'");


function getName($file){
    $n=explode('/', $file);
    $nn=explode('.', $n[2]);
    return $nn[0];
}
function getFile($file){
    $n=explode('/', $file);
    return $n[3];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Detalle | Compras y licitaciones</title>
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

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">

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

    <main id="main" class="container">

        <section>

            <div class="container blue">
                Detalle
            </div>

            <table class="table detalle">
                <tbody>
                    <tr>
                        <td class="bg-gray">Tipo de contratacion</td>
                        <td><?php echo $row['tipo']; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-gray">Estado</td>
                        <td><?php echo $row['estado']; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-gray">N° de Contratación</td>
                        <td><?php echo $row['codigo']; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-gray">Expediente</td>
                        <td><?php echo $row['expediente']; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-gray">Presupuesto Oficial</td>
                        <td>$<?php echo $row['presupuesto']; ?></td>
                    </tr>
                    
                    <tr>
                        <td class="bg-gray">Costo de Adquisición del Pliego</td>
                        <td>$<?php echo $row['costo_pliego']; ?></td>
                    </tr>
					<tr>
                        <td class="bg-gray">Garantia de Oferta</td>
                        <td>$<?php echo $row['costo_oferta']; ?></td>
                    </tr>
                    <tr>
                        <td class="bg-gray">Costo de Impugnación</td>
                        <td>$<?php echo $row['costo_impugnacion']; ?></td>
                    </tr>

                    <tr>
                        <td class="bg-gray">Fecha de apertura</td>
                        <td><?php echo $row['apertura']; ?></td>
                    </tr>

                    <tr>
                        <td class="bg-gray">Fecha de Publicación </td>
                        <td><?php echo $row['fecha']; ?></td>
                    </tr>

                </tbody>
            </table>
            
            <div>
                <div class="bg-gray-100">
                    Consulta y venta del pliego
                </div>
                <div>Dirección de Compras - SAN LORENZO 1055 - 5587023 INTERNO 147 - Lunes a
                    viernes de 07:00 a 13:00 - </div>
            </div>
            <div>
                <div class="bg-gray-100">
                    Recepción de ofertas
                </div>
                <div>Dirección de Compras - SAN LORENZO 1055 - 5587023 INTERNO 147 - Lunes a
                    viernes de 07:00 a 13:00 - 2do piso</div>
            </div>
            <div>
                <div class="bg-gray-100">
                    Lugar de apertura
                </div>
                <div>Dirección de Compras - SAN LORENZO 1055 - Lunes a
                    viernes de 07:00 a 13:00 - 2do piso</div>
            </div>
            <div>
                <div class="bg-gray-100">
                    Repartición Licitante
                </div>
                <div>SAN LORENZO 1055- </div>
            </div>
            <div>
                <div class="bg-gray-100">
                    Ver pliego adjunto apto para cotizar
                </div>
                <?php  while ($rowi=$archivos->fetch_assoc()) { ?>
            <a class="btn btn-info mb-1"  href="<?php echo $rowi['archivo'];?>" download="<?php echo getFile($rowi['archivo']);?>"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"/></svg> <?php echo getName($rowi['archivo']);?></a>    
            <?php }?>
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

</body>

</html>