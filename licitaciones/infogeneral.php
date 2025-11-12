<!DOCTYPE html>
<html lang="en">

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
            <h2>Información general de compras y licitaciones</h2>
        </div>
    </section><!-- End Hero -->

    <main id="main" class="container licitaciones">

        <div class="where">
            <h3>Compras y erogaciones menores</h3>
            <p>Son compras que realizan las áreas del Insituto Municipal de Previsión Social de Rosario.</p>
        </div>

        <section class="busqueda_expediente">

            <div class="monto">
                <div class="alert alert-primary" role="alert">
                    Monto: hasta $200.000,00.-
                </div>
                <p>Tipos de Compras y erogaciones menores:</p>
                <p><strong>- Compra Directa hasta $ 100.000 SOLO CON FACTURA</strong>,
                </p>
                <br>
                <p><strong>- Compra Directa hasta $ 200.000 con 3 presupuestos</strong>.</p>
                <br>
                <p><strong>- Concursos de Precios: de $ 200.000,01 a $ 700.000 invitar a por lo menos 3 proveedores y la autorización del Jefe del Área.</strong></p>
                <br>
            </div>

            <div class="monto2">
                <h4>Compras menores</h4>

                <ul>
                    <li>Montos actualizados por <a href="archivos/decreto-comprasmenores.pdf" target="_blank"> Decreto Nº546/2023 </a>.</li>
                    <!--<li><a href=""> Formulario de presentación de compras menores</a> [doc]</li>-->
                </ul>

            </div>
        </section>

        <div class="where">
            <h3>Licitaciones Privadas</h3>
            <p>Régimen legal</p>
        </div>

        <section class="busqueda_expediente">

            <div class="monto">
                <div class="alert alert-primary" role="alert">
                    Monto: de $ 700.000,01 a $ 10.000.000 .-
                </div>
                <!--<p>La Dirección General de Compras y Suministros (Santa Fe 664 PA) gestiona las licitaciones
                    correspondientes a todas las reparticiones municipales a excepción de las que dependen de las
                    Secretarias de <a href="">Salud Pública </a> , <a href="">Desarrollo Humano y Hábitat </a> y <a
                        href="">Cultura y Educación</a> .
                </p>-->
                <br>
                <h5 class="mb-4">Tiempo y modalidad de publicación</h5>
                <p>Como <strong>mínimo 10 días hábiles</strong> anteriores al fijado para la apertura de sobres.</p>
                <p>Las mismas se anuncian por medio de avisos que se publican en los transparentes de:</p>
                <ul>
                    <li>Insituto Municipal de Previsión Social de Rosario</li>
                    <li>Dirección (San Lorenzo 1055)</li>
                </ul>
                <p>Asimismo, el Sector de Comprascursa <strong>invitaciones</strong> del
                    siguiente modo: </p>
                <ul>
                    <li>Por medio de notificaciones entregadas personalmente con personal del IMPSR.</li>
                    <li>Por medio de cartas certificadas (a aquellos proveedores que tengan su domicilio fuera de la ciudad de Rosario).</li>
                    <li>Por medio de correo electrónico que los envía automáticamente el Sistema Contable al momento de
                        Cargar las contrataciones a todos los proveedores inscriptos en el Padrón de Agentes de Cobro en
                        el rubro licitado.</li>
                </ul>
                <br>
                No obstante, los proveedores no invitados pueden participar (cotizar) del acto licitatorio descargando
                el pliego correspondiente en las <a href="licitaciones.php?tipo=privada&estado=apertura">licitaciones publicadas.</a>
                <p></p>
                <button id="toggleButton3" class="link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                    Consultas y adquisición de pliego
                </button>
                <p id="hiddenText3" style="display: none; margin: 0">Durante el período de publicación y previo al acto de apertura, los interesados podrán consultar los pliegos licitatorios en el sector Compras,o de forma online en www.impsr.gob.ar/licitaciones.
                .
                Previa presentación de la oferta deberá generar el sellado correspondiente.  El costo se calcula de acuerdo a un porcentaje sobre el valor base de la licitación que varía de 2 a 2,7 por mil, pudiendo el pliego de bases y condiciones establecer otro valor.</p>
                
            </div>

            <div class="monto2">
                <h4>Licitaciones privadas</h4>

                <ul>
                    <li><a href=""> Pliego de condiciones generales y anexo</a> [doc]</li>
                </ul>

            </div>
        </section>

        <div class="where">
            <h3>Licitaciones Públicas</h3>
            <p>Régimen legal</p>
        </div>

        <section class="busqueda_expediente">

            <div class="monto">
                <div class="alert alert-primary" role="alert">
                    Monto: desde $10.000.000,01.-
                </div>

                <p>Se realiza el llamado por medio del Sector Compras del IMPSR.</p>
                <button id="toggleButton" class="link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                    Tiempo y modalidad de publicación
                </button>
                <p id="hiddenText" style="display: none; margin: 0">Se anuncia por medio de avisos a publicarse en el Boletín Oficial de la Provincia de Santa Fe, por un término no inferior
                   de 10 días habiles anteriores al acto de apertura, los que pueden suplirse mediante la publicación de edictos en un diario de amplia difusión de la ciudad (La Capital, El Ciudadano o Rosario 12) por un lapso
                   no menor a los 10 días corridos.</p>
                <br>
                <button id="toggleButton2" class="link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>
                    Consulta y venta de pliegos
                </button>
                <p id="hiddenText2" style="display: none; margin: 0">Durante el período de publicación y previo al acto de apertura pueden consultarse de forma online en www.impsr.gob.ar/licitaciones. 
                Para la compra de los mismos deberá procederse de acuerdo a lo indicado para la adquisición de pliegos de licitaciones privadas.</p>


                    
            </div>
        </section>

        <!--<div class="where">
            <h3>Licitaciones sobre obras públicas</h3>
        </div>

        <section class="busqueda_expediente">

            <div class="monto">
                <p>Para toda licitación cuyo objeto sea de Obra Pública es necesario acreditar el conocimiento del
                    "Pliego de condiciones generales, especificaciones técnicas y general de planos" aprobado por
                    <a href=""> Ordenanza Nº 2841/1981. </a>
                </p>
                <p>
                    En tal sentido, <strong> se deberá abonará por única vez la Boleta de Pago </strong> por el concepto
                    "Pliego General
                    contratación Obras Publicas Ord. 2841/1981 - OGI Art. 110. <a href=""> Generar Boleta de pago</a>
                </p>
                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>Tomo I. Pliego de condiciones generales</a> [.pdf]
                <br>
                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path
                            d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                    </svg>Tomo II. Planos</a> [.zip]


                <div class="normativa">


                    <h5>Normativa Licitaciones publicas y privadas</h5>

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Reglamento de Compras y Erogaciones Menores
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="">Decreto Nº438/1998</a></div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Padrón de Agente de Cobros
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="">Decreto 736/2016</a>
                                    <br>
                                    <a href="">Decreto 2842/2014</a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    Violencia de Género
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="">Decreto 396/2019 </a>
                                    <br>
                                    <a href="">Decreto 204/2019</a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFour" aria-expanded="false"
                                    aria-controls="flush-collapseFour">
                                    Régimen compre local
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="">Ord. 1962/2004 </a>
                                    <br>
                                    <a href="">Ord. 7602/2004</a>
                                    <br>
                                    <a href="">Ord. 9915/2018</a>
                                    <br>
                                    <a href="">Ord. 7844/2005</a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseFive" aria-expanded="false"
                                    aria-controls="flush-collapseFive">
                                    Notificación Electrónica
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="">Decreto 1172/2020</a></div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseSix" aria-expanded="false"
                                    aria-controls="flush-collapseSix">
                                    Depósito en garantía
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"><a href="">Decreto 2810/2000</a></div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseSeven" aria-expanded="false"
                                    aria-controls="flush-collapseSeven">
                                    Regularización Fiscal
                                </button>
                            </h2>
                            <div id="flush-collapseSeven" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="">Decreto 736/2001 </a>
                                    <br>
                                    <a href="">Resolución 227/2001</a>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseEight" aria-expanded="false"
                                    aria-controls="flush-collapseEight">
                                    Cesión de Derechos
                                </button>
                            </h2>
                            <div id="flush-collapseEight" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="">Decreto 2962/1997</a>
                                    <br>
                                    <a href="">Decreto 1120/2008 </a>
                                </div>
                            </div>
                        </div>
                    </div>-->


                </div>
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

            <script>
                    const toggleButton = document.getElementById("toggleButton");
                    const hiddenText = document.getElementById("hiddenText");
                    const toggleButton2 = document.getElementById("toggleButton2");
                    const hiddenText2 = document.getElementById("hiddenText2");
                    const toggleButton3 = document.getElementById("toggleButton3");
                    const hiddenText3 = document.getElementById("hiddenText3");
            
                    toggleButton.addEventListener("click", function() {
                    if (hiddenText.style.display === "none") {
                        hiddenText.style.display = "block";
                    } else {
                        hiddenText.style.display = "none";
                    }
                    });
                    
                    toggleButton2.addEventListener("click", function() {
                    if (hiddenText2.style.display === "none") {
                        hiddenText2.style.display = "block";
                    } else {
                        hiddenText2.style.display = "none";
                    }
                    });

                    toggleButton3.addEventListener("click", function() {
                    if (hiddenText3.style.display === "none") {
                        hiddenText3.style.display = "block";
                    } else {
                        hiddenText3.style.display = "none";
                    }
                    });
            
                </script>

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