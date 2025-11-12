<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración IMPSR</title>


  <!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Google Fonts (opcional) -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;700&display=swap" rel="stylesheet"> -->

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- OverlayScrollbars -->
  <link href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" rel="stylesheet">

  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">

  <!-- ApexCharts CSS -->
  <link href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link href="css/datatables.min.css" rel="stylesheet">

  <!-- Select Picker -->
  <link href="css/bootstrap-select.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/estilo.css" rel="stylesheet">
  <link href="css/tableexport.css" rel="stylesheet">
  <link href="dist/css/adminlte.css" rel="stylesheet">

  <!-- jQuery (si realmente lo necesitás) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap 5 JS con Popper incluido -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/es.js"></script>

  <!-- ApexCharts JS -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1"></script>

  <!-- OverlayScrollbars JS -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>

  <!-- DataTables JS (si lo usas) -->
  <script src="js/datatables.min.js"></script>

  <!-- printThis (si usas impresiones) -->
  <script src="js/printThis.js"></script>

<style>

body {
  font-family: 'Open Sans', sans-serif;
  background-color: #f4f7fb;
  color: #2c2c2c;
}

h1, h2, h3, h4, h5 {
  font-family: 'Merriweather', serif;
  color: #1e3a8a;
}

/* === Header === */
.app-header {
  background-color: #1d4ed8;
  border-bottom: 3px solid #60a5fa;
  color: white;
}

.app-header .nav-link {
  color:black;
  font-weight: 300;
}

.app-header .nav-link:hover {
  color: #93c5fd;
}

.navbar-badge.badge {
  font-size: 0.35rem;
  padding: 4px 7px;
}

/* === Sidebar === */
.app-sidebar {
  background-color: #1e40af;
  color: white;
}

.sidebar-brand {
  background-color: #3b82f6;
  color: #ffffff;
  font-weight: bold;
}

.sidebar-wrapper {
  background-color: #1e3a8a;
}

.sidebar-wrapper .nav-link {
  color: #cbd5e1;
  font-weight: 500;
  transition: background 0.3s, color 0.3s;
}

.sidebar-wrapper .nav-link.active,
.sidebar-wrapper .nav-link:hover {
  background-color: #334155;
  color: #60a5fa;
}

.nav-icon {
  color: #ffffff;
  margin-right: 8px;
}

/* === Main Content === */
.app-main {
  background-color: #ffffff;
  padding: 30px;
  min-height: 100vh;
  border-left: 1px solid #e0e0e0;
}

.app-content-header {
  background-color: #ffffff;
  padding: 20px;
  border-bottom: 1px solid #dee2e6;
}

.breadcrumb {
  background: none;
  margin-bottom: 0;
}

.breadcrumb a {
  color: #1e3a8a;
}

/* === Footer === */
.app-footer {
  background-color: #1d4ed8;
  color: white;
  padding: 15px 30px;
  text-align: center;
  font-size: 0.9rem;
}

.app-footer a {
  color: #93c5fd;
  text-decoration: none;
}

/* === Progress Bar === */
.load .progress-bar {
  background-color: #1e3a8a !important;
}

/* === Dropdowns === */
.dropdown-menu {
  font-size: 0.9rem;
  border-radius: 0.5rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.dropdown-item-title {
  font-weight: 600;
}

/* === User Menu === */
.user-header {
  background-color: #1e3a8a;
}

.user-header p small {
  font-size: 0.8rem;
  color: #e0e0e0;
}

.user-footer .btn {
  background-color: #f8f9fa;
  border: 1px solid #ccc;
  font-size: 0.85rem;
}

/* === Custom Scrollbar === */
.sidebar-wrapper::-webkit-scrollbar {
  width: 8px;
}

.sidebar-wrapper::-webkit-scrollbar-track {
  background: #1e3a8a;
}

.sidebar-wrapper::-webkit-scrollbar-thumb {
  background: #3b82f6;
  border-radius: 10px;
}


.imagen{
    display: block;
    margin: 0 auto;
    width:100px;
    height:100px;
    background-color: grey;
}
.margen{
	
	padding: 20px;
	
}

.tab-content{
	padding-top: 5px;
}
/* */
#wait{
	display: none;
	text-align: center;
	padding:20px;
	margin:auto;
	width:100px;
	text-align:center;
	margin:auto auto;
}
.load {
  position: relative; /* o absolute/fixed según tu diseño */
  z-index: 0;
  height: 8em;
  text-align: center;
  width: 400px;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.load:before {
  content: '';
  display: block;
  position: fixed; /* o absolute/fixed según tu diseño */
 
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  color: #000;
  background-color: rgba(255,255,255,0.7);
}

#wait i{
	margin:10px auto;
}
.subnav{
	margin-bottom: 10px !important;
	border-top: 1px solid #999;
	padding:2px 16px !important;
}
.navbar{
    padding: 8px 16px;
}
#titulo{
	color: #0b4984;
	font-size: 1.2em;
	font-weight: bold;
}
#grantitulo{
	color: #0b4984;
	font-size: bolder;
}

.revision{
	color: #FFFF00;
}
.publica{
	color: green;
}
.filtros input{
	display: inline-block;
	width:140px;
}
/* centro tarjeta */
#centro .card{
    margin: 8px 8px;
    display: inline-flex;
    font-size:12px;
}
/**/
#tablesorter{
    width:100% !important;
}
.table-sm td, .table-sm th {
    padding: .2rem !important;
}
.table td, .table th {
    vertical-align: middle !important;
    }
#detalle-sub{
max-height: 400px;
    overflow: scroll;
}
@media print {
   	.noprint{
   	display: none;
   	}
   	#tablesorter_length{
	display:none;
	}
	#tablesorter_filter{
		display:none;
	}
	#tablesorter_paginate{
		display:none;
	}
	#tablesorter_info{
		display:none;
	}
	table.dataTable thead .sorting:after{
		display:none;
	}
	table.dataTable thead .sorting:after {
	    opacity: 0;
	    content: "";
	}
	table.dataTable thead .sorting_asc:after {
	    content: "";
	}
	table.dataTable thead .sorting_desc:after {
	    content: "";
	}
}

dialog[open] {
  position: fixed !important;
  top: 50% !important;
  left: 50% !important;
  transform: translate(-50%, -50%) !important;
  margin: 0 !important;
  z-index: 1055;
}

</style>
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="index.php" class="nav-link">Inicio</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contacto</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown d-none">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user1-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="dist/assets/img/user8-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                     <img
                        src="dist/assets/img/user3-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown d-none">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" id="userMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <img id="user_image" src="dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image" width="34" height="34" />
                <span id="user_name" class="d-none d-md-inline ms-2">Usuario</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="userMenuLink">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary text-center py-3">
                  <img id="user_image_large" src="dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow mb-2" alt="User Image" style="width:80px;height:80px;" />
                  <p><strong id="user_name_large">Usuario</strong></p>
                </li>
                <!--end::User Image-->
                <!-- NOTA: No mostrar email ni teléfono en el menú, se ven sólo desde el modal de perfil -->
                <!--begin::Menu Body (vacío) -->
                <li class="user-body px-3">
                <p><small id="user_position_large"></small></p>
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer d-flex px-3 py-2">
                  <button class="btn btn-default btn-flat me-auto" id="btnProfile">Profile</button>
                  <a href="inc/salir.php" class="btn btn-default btn-flat">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand" >
          <!--begin::Brand Link-->
          <a href="./index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">IMPSR Rosario</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Escritorio
                  </p>
                </a>
              </li>
              <li class="nav-item menu-open" id="beneficiosMenu">
  <a href="#" class="nav-link" id="beneficiosToggle">
    <i class="nav-icon bi bi-box-seam-fill"></i>
    <p>
      Beneficios
      <i class="nav-arrow bi bi-chevron-right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview show" id="beneficiosSubmenu">
    <li class="dropdown-item">
      <a href="#" class="nav-link abre" title="Gestion de Jubilados" data-titulo="Jubilados" data-url="inc/lista_jubilados.php">
        <i class="nav-icon bi bi-circle"></i>
        <p>Jubilados</p>
      </a>
    </li>
    <li class="dropdown-item">
      <a href="#" class="nav-link abre" title="Gestion de Pensionados" data-titulo="Pensionados" data-url="inc/lista_pensionados.php">
        <i class="nav-icon bi bi-circle"></i>
        <p>Pensionados</p>
      </a>
    </li>
    <!-- Puedes agregar aquí más ítems relacionados si lo deseas -->
  </ul>
</li>
              <li class="nav-item">
                <a href="#" class=" nav-link abre" title="Gestion de Empleados" data-titulo="Empleados" data-url="inc/lista_empleados.php" >
                  <i class="nav-icon bi bi-clipboard-fill"></i>
                  <p>
                    Empleados
                  </p>
                </a>
                
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-tree-fill"></i>
                  <p>
                    Recibos
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="abre nav-link" title="Carga de Recibos de Beneficiarios" data-titulo="Recibos" data-url="inc/recibos_beneficiarios.php" >
			        
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Recibos Beneficiarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                   	<a href="#" class="abre nav-link" title="Carga de Recibos de Empleados" data-titulo="Recibos" data-url="inc/recibos_empleados.php" >
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Recibos Empleados</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
               	<a href="novedades.php" class="nav-link" title="Novedades del sitio" data-titulo="Novedades del sitio" data-url="" ><i class="nav-icon bi bi-pencil-square"></i>
                  <p>
                   Novedades
                  </p>
</a>
                
              </li>
              <li class="nav-item">
                <a href="licitaciones.php" class="nav-link " title="Lista de Licitaciones" data-titulo="Licitaciones" data-url="" >
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Licitaciones
                
                  </p>
                </a>
                
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Normativas
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class=" dropdown-item">
                    <a href="#" class="nav-link abre" title="Gestion Tipos" data-titulo="Lista de Tipos" data-url="inc/normativa_tipos.php" >
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Tipos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                   <a href="#" class="abre nav-link" title="Gestion Temas" data-titulo="Agenda de Temas" data-url="inc/normativa_temas.php">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Temas</p>
                    </a>
                  </li>
                  <li class="nav-item">
                   <a href="#" class="abre nav-link" title="Gestion Normativas" data-titulo="Lista de Normativas" data-url="inc/normativa_lista.php">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Normativas</p>
                    </a>
                  </li>
                </ul>
              </li>                  
               </li>
              <li class="nav-item">
                <a href="inc/calendario.php" class="nav-link">
                    
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Fechas
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Fecha Cobro
                          <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                      <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-item"><a href="#" class="nav-link abre" title="Fecha de Cobro" data-titulo="Fecha de cobro" data-url="inc/lista_fechas.php">
                          <p>Lista de Cobros</p>
                        </a>
                      </li>
                      </ul>
                      </li>
         <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Bloquear Fechas
                           <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                     <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link " 
                          <p>Bloquear Solicitud Credito</p>
                        </a>
                         <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="abre dropdown-item" title="bloquear fechas para solicitud" data-titulo="Recibos" data-url="inc/credito_solicitud_activo.php">
                          <p>Activos</p>
                        </a>
                      </li>
                      </ul>
                       <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="abre dropdown-item" title="bloquear fechas para solicitud" data-titulo="Recibos" data-url="inc/credito_solicitud_pasivo.php">
                          <p>Pasivos</p>
                        </a>
                      </li>
                      </ul>
                      </li>
                      </ul>
                       <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link " 
                          <p>Bloquear Renovación Credito</p>
                        </a>
                         <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="abre dropdown-item" title="bloquear fechas para renovacion" data-titulo="Recibos" data-url="inc/renovacion_bloqueo_activo.php">
                          <p>Activos</p>
                        </a>
                      </li>
                      </ul>
                       <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="abre dropdown-item" title="bloquear fechas para renovacion" data-titulo="Recibos" data-url="inc/renovacion_bloqueo_pasivo.php"">
                          <p>Pasivos</p>
                        </a>
                      </li>
                      </ul>
                      </li>
                      </ul>
                      </li>
                    </ul>
              </li>
                     <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Turnos
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class=" dropdown-item">
                    <a href="#" class="abre nav-link" title="turnos" data-titulo="Lista de Turnos" data-url="inc/lista_turnos.php">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Turnos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                  	<a href="#" class="abre nav-link" title="Agenda" data-titulo="Agenda de turnos" data-url="inc/agenda_turnos.php" >
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Agenda</p>
                    </a>
                  </li>
                  <li class="nav-item">
                   <a href="#" class="abre nav-link" title="Excepcion" data-titulo="Pedidos Excepcion" data-url="inc/turnos_excepcion.php">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Excepcion</p>
                    </a>
                  </li>
                </ul>
              </li>                  
               </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p>
                        Configuración
                           <i class="nav-arrow bi bi-chevron-right"></i>        
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="abre nav-link" title="Lista de roles permisos" data-titulo="Roles" data-url="inc/lista_roles.php" >
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Roles</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="abre nav-link" title="Lista de usuarios sin passwd" data-titulo="Roles" data-url="inc/lista_passwd.php"> <i class="nav-icon bi bi-circle"></i>
                          <p>Generar Password</p>
                        </a>
                      </li>
                  
                       <li class="nav-item">
                        <a href="#" class="nav-link" id="cargaMov" title="Update Expedientes con csv" >
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Actualizar Expedientes</p>
                        </a>
                      </li>
                       <li class="nav-item">
                        <a href="#" class="nav-link" id="cargaLiq" title="Update Liq con csv" >
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Actualizar Liquidaciones</p>
                        </a>
                      </li>
                       <li class="nav-item">
                        <a href="#" class="nav-link" >
                          <i class="nav-icon bi bi-circle"></i>                          
                          <p>Actualizar Inicio de Trámites</p>
                        </a>
                      </li>
                       <li class="nav-item">
                        	<a href="#" class="nav-link" id="buscaCuil" title="Buscar Cuil en COFEPRES">
                             <i class="nav-icon bi bi-circle"></i>                          
                          <p>Buscar Cuil</p>
                        </a>
                      </li>
                      
                 </ul>
                  </li>
                   <li class="nav-item">
                   <a href="inc/salir.php" class="nav-link">
                      <i class="nav-icon bi bi-box-arrow-in-right"></i>
                      <p>
                        Salir
                        <i class="nav-arrow bi bi-chevron-right"></i>
                      </p>
                    </a>
                  
                </ul>
              </li>
              
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
