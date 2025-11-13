<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
    $query = "SELECT a.* FROM personas a WHERE a.CLAVE=''  OR a.CLAVE IS NULL ";

$personas = $conectar->query($query);
$cant=$personas->num_rows;
echo $conectar->error;
?>
<script>
$(function() {
	
	//imprimir
	$('#imprimirPw').click(function(e){
		e.preventDefault();
		$('#listaPw').printThis();
	});
    //generar
	$('#generarPw').click(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea Generar claves?")) 
    		{	return false; }
    	else { 
    		var id=$(this).data('id');
    		$.post("inc/generar_pw.php",function(data){
    			if (data.success){
    				$('#listaPw').html(data.tabla);
    				var doc = new jsPDF();
    			    // You can use html:
    			    var fecha=new Date();
    			    var ano=fecha.getFullYear();
    				var mes=( fecha.getMonth() + 1 );
    				var dia=fecha.getDate();
    				var hoy=dia+'/'+mes+'/'+ano; 
    			    doc.text(7, 10, "Lista de claves "+hoy);
    			    doc.autoTable({html: '#tablaPw'});
    			    doc.save('tablaclaves'+hoy+'.pdf');
    				alert('CLAVES GENERADAS Y GUARDADAS, PUEDE IMPRIMIR');
    			}
    		},'json');
    	}
	});	
			
});
</script>
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
.sidebar-wrapper .nav-link:hover2222 {
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

<!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="index.php">
               <i class="fa fa-cogs" aria-hidden="true"></i>
                Gestión de Configuraciones
            </a>
          
        </div>
    </nav>
    <!-- Main Content -->
	  <!-- Main Content -->
    
        
<div class="container">
	<div class="row">
    	<div class="col-12 col-sm-8 ml-auto mr-auto">
        	<div class="card w-100">
              <div class="card-header">
				<div class="d-flex justify-content-between align-items-center">

                <span style="color:#003366;font-size:1.5em;font-weight:bold;">
					Generar Claves       
					<i class="fa fa-key" aria-hidden="true"></i>
</span>
				</div>
              </div>
              <div class="card-body" id="listaPw">
                <h5 class="card-title">Usuarios sin clave</h5>
                <p class="card-text"><?php echo $cant;?></p>
                
              </div>
              <div class="card-footer text-muted text-center">
                  <button type="button" class="btn btn-lg btn-success btn-custom-width me-3" title="Generar Passwords" id="generarPw" style="min-width:180px;font-size:1.2em;font-weight:600;border-radius:8px;box-shadow:0 2px 8px rgba(0,51,102,0.10);"><i class="fa fa-key" aria-hidden="true"></i> Generar</button>
                  <button type="button" class="btn btn-lg btn-primary btn-custom-width" title="Imprimir Lista" id="imprimirPw" style="min-width:180px;font-size:1.2em;font-weight:600;border-radius:8px;box-shadow:0 2px 8px rgba(0,51,102,0.10);"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
              </div>
            </div>
    	</div>	
    </div>
</div>


