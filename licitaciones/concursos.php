<?php 
include '../functions/connect.php';
global $con;

$query="SELECT l.*,lt.tipo,le.estado,le.estado FROM licitaciones l LEFT JOIN licitaciones_tipos lt ON l.id_tipo=lt.id LEFT JOIN licitaciones_estados le ON l.id_estado=le.id LEFT JOIN licitaciones_reparticiones lr ON l.id_reparticion=lr.id WHERE l.id_tipo='1' AND l.id_tipo='3' ";

if (isset($_GET['estado'])) {
    switch ($_GET['estado']){
        case 'apertura':
            $estado='1';
            $tituloe='Publicada para apertura';
        break;
        case 'evaluacion':
            $estado='2';
            $tituloe="Abierta para evaluacion";
            break;
        case 'adjudicada':
            $estado='3';
            $tituloe="Adjudicada";
            break;
        case 'anulada':
            $estado='4';
            $tituloe="Anulada";
            break;
        case 'fracasada':
            $estado='5';
            $tituloe="Fracasada";
            break;
        case 'desierta':
            $estado='6';
            $tituloe="Desierta";
            break;
    }
    $query.=" AND l.id_estado='$estado' ";
}

$licitaciones=$con->query($query);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Busqueda | Compras y licitaciones</title>
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

        <div class="criterios">
            <h4>Criterios de busqueda:</h4>

            <div class="estado">
                <h6>Estado:</h6>
                <p><?php echo $tituloe; ?></p>
            </div>
        </div>

        <section>
            
            <div class="container blue">
                Concurso de precios
            </div>

            <table class="table">
                <thead class="thead-light">
                    <tr>
                    	<th scope="col">Estado</th>
                        <th scope="col">Expediente</th>
                        <th scope="col">Objeto</th>
                        <th scope="col">Apertura</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($rowl=$licitaciones->fetch_assoc()){?>
                    <tr class="bodytable">
						<td><?php echo $rowl['estado']; ?></td>
                        <td><?php echo $rowl['codigo']?></td>
                        <td> <a href="licitacion.php?id=<?php echo $rowl['id']; ?>"><?php echo $rowl['titulo']; ?></a></td> 
                        <td><?php echo $rowl['apertura']; ?></td>

                    </tr>
                <?php } ?>    
                </tbody>
            </table>
        </section>

        
        

        


        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="index.php" tabindex="-1">Volver</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="busqueda.php">Nueva Busqueda</a>
                </li>
            </ul>
        </nav>

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