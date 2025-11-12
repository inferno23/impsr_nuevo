<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Administración IMPSR </title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE | Dashboard v2" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    	<link href="css/all.min.css" rel="stylesheet" >
	<!-- fuentes google 
	<link href="https://fonts.googleapis.com/css?family=Magra:400,700" rel="stylesheet">
	<!-- datatables -->
	<!-- <link rel="stylesheet" href="css/jquery.dataTables.min.css" type="text/css" media="all" />
	<script src="js/jquery.dataTables.min.js"></script>-->	
	<link rel="stylesheet" href="css/datatables.min.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/estilo.css">
	<!-- Export -->
	<link href="css/tableexport.css" rel="stylesheet" type="text/css">
	<!--  -->
	<link rel="stylesheet" href="css/bootstrap-select.min.css">

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />



<!-- Luego el plugin bootstrap-filestyle -->


<script>
//console.log($.fn.filestyle);
var showLoadingEnabled = true;
$(function(){
	
	//
	$.ajaxSetup({
		 beforeSend: function(xhr, status) {
	        	if (showLoadingEnabled) {	
	            	$('#wait').show();
	            	$('.btnguardar').prop('disabled', true);
	        	}
	        },
	        complete: function() {
	        	if (showLoadingEnabled) {
	            	$('#wait').hide();
	            	$('.btnguardar').prop('disabled', false);
	        	}
	        }
    });
    
	$(document).ajaxStart(function(){
		if (showLoadingEnabled) {
		$('#wait').show();
		}
	});

	$(document).ajaxComplete(function(){
		if (showLoadingEnabled) {
		$('#wait').hide();
		}
	});
	$(document).on('click', '#imprimir', function(e) {
		e.preventDefault();
		window.print();
		return false;
		});
	$('.imprime').click(function(e){
		e.preventDefault();
		var div=$(this).data('print');
		$('#'+div).printThis({
			  importCSS: false,
			  importStyle: false 
			});
	});
	$('#salir').click(function(e){
		e.preventDefault();
		$.post( "inc/salir.php");
		window.location="login.php";
		return false;
		});
	$('#cargaCsv1').click(function(e){
		e.preventDefault();
		console.log('abre pedido');
		$('#modalCsv1').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});

	
	
	$('#buscaCuil').click(function(e){
		e.preventDefault();
		$('#resultadosCuil').empty();
		$('#modalCuil').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});
	$('#cuilBuscar').click(function(e){
		e.preventDefault();
		$('#resultadosCuil').empty();
		var cuil=$('#cuil').val();
		$.post('inc/buscar_cuit.inc.php',{cuil:cuil},function(data){
			$('#resultadosCuil').html(data);
		});
	});
	//
	$('#cargaUpdate').click(function(e){
		e.preventDefault();
		console.log('abre pedido');
		$('#modalUpdate').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});
	$('#cargaLiq').click(function(e){
		e.preventDefault();
		console.log('abre pedido');
		$('#modalLiq').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});
	$('#cargaCsv3').click(function(e){
		e.preventDefault();
		$('#modalCsv3').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});
	$('#getcsvdatos').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			//dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				$('#centro').html(data);
				$('#modalCsv3').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();	
			    	
			}          
		});
	});
	$(document).one('submit', '#guardarcsvdatos', function(e) {
		e.preventDefault();
		$('.btn-guardar').prop('disabled',true);
		if (!confirm("Esta seguro de que desea guardar los registro?")) 
    		{	$('.btn-guardar').prop('disabled',false);return false; }
    	else { 
    		var data = new FormData(this);
    		$.ajax({
    			type: 'POST',
    			url: $(this).attr('action'),
    			data: data,
    			contentType: false,
    			dataType: "json",
    			cache: false,
    			processData: false,
    			success: function(data){
        			console.log(data);
					alert('Registros Actualizados '+data.updates);
					console.log(data.error);
    				$('#centro').empty();
    				//location.reload();
    				$('.btn-guardar').prop('disabled',false);
    				$('body').removeClass('modal-open');
    				$('.modal-backdrop').remove();
    				
    			    	
    			}          
    		});
    	}		
	});
	$('#formUpdate').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			//dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				$('#centro').html(data);
				$('#modalUpdate').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();	
			    	
			}          
		});
	});
	$(document).one('submit', '#formUpdate1', function(e) {
		e.preventDefault();
		$('.btn-guardar').prop('disabled',true);
		if (!confirm("Esta seguro de que desea actualizarsesee los registro?")) 
    		{	$('.btn-guardar').prop('disabled',false);return false; }
    	else { 
    		var data = new FormData(this);
    		$.ajax({
    			type: 'POST',
    			url: $(this).attr('action'),
    			data: data,
    			contentType: false,
    			dataType: "json",
    			cache: false,
    			processData: false,
    			success: function(data){
        			console.log(data.error);
					alert('Registros Actualizados '+data.updates);
    				$('#centro').empty();
    				//location.reload();
    				$('.btn-guardar').prop('disabled',false);
    				$('body').removeClass('modal-open');
    				$('.modal-backdrop').remove();
    				
    			    	
    			}          
    		});
    	}		
	});
	$('#formLiq').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			//dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				$('#centro').html(data);
				$('#modalLiq').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();	
			    	
			}          
		});
	});
	$(document).one('submit', '#formLiq1', function(e) {
		e.preventDefault();
		$('.btn-guardar').prop('disabled',true);
		if (!confirm("Esta seguro de que desea guardar los registro?")) 
    		{	$('.btn-guardar').prop('disabled',false);return false; }
    	else { 
    		var data = new FormData(this);
    		$.ajax({
    			type: 'POST',
    			url: $(this).attr('action'),
    			data: data,
    			contentType: false,
    			dataType: "json",
    			cache: false,
    			processData: false,
    			success: function(data){
        			console.log(data);
					alert('Registros Actualizados '+data.updates+', registros existentes '+data.existe);
    				$('#centro').empty();
    				//location.reload();
    				$('.btn-guardar').prop('disabled',false);
    				$('body').removeClass('modal-open');
    				$('.modal-backdrop').remove();
    				
    			    	
    			}          
    		});
    	}		
	});
	//
	//
	$('#cargaMov').click(function(e){
		e.preventDefault();
		console.log('abre pedido');
		$('#modalMov').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});
	$('#formMov').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			//dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				$('#centro').html(data);
				$('#modalMov').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();	
			    	
			}          
		});
	});
	$(document).one('submit', '#formMov1', function(e) {
		e.preventDefault();
		$('#btnGuardarCsv').prop('disabled',true);
		if (!confirm("Esta seguro de que desea guardar los registro?")) 
    		{	$('#btnGuardarMov').prop('disabled',false);return false; }
    	else { 
    		var data = new FormData(this);
    		$.ajax({
    			type: 'POST',
    			url: $(this).attr('action'),
    			data: data,
    			contentType: false,
    			dataType: "json",
    			cache: false,
    			processData: false,
    			success: function(data){
					console.log(data);
    				//alert(data.error);
    				alert('Registros Actualizados '+data.updates+', registros existentes '+data.existe);
    				$('#centro').empty();
    				location.reload();
    				$('#btnGuardarMov').prop('disabled',false);
    				$('body').removeClass('modal-open');
    				$('.modal-backdrop').remove();
    				
    			    	
    			}          
    		});
    	}		
	});
	//
	$('#formCsv1').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			//dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				$('#centro').html(data);
				$('#modalCsv1').modal('hide');
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();	
			    	
			}          
		});
	});
	$(document).one('submit', '#formCsv11', function(e) {
		e.preventDefault();
		$('#btnGuardarCsv').prop('disabled',true);
		if (!confirm("Esta seguro de que desea guardar los registro?")) 
    		{	$('#btnGuardarCsv').prop('disabled',false);return false; }
    	else { 
    		var data = new FormData(this);
    		$.ajax({
    			type: 'POST',
    			url: $(this).attr('action'),
    			data: data,
    			contentType: false,
    			dataType: "json",
    			cache: false,
    			processData: false,
    			success: function(data){
    				//alert(data.error);
    				alert('Registros Actualizados '+data.updates);
    				$('#centro').empty();
    				$('#btnGuardarCsv').prop('disabled',false);
    				$('body').removeClass('modal-open');
    				$('.modal-backdrop').remove();
    				
    			    	
    			}          
    		});
    	}		
	});
	$(document).one('submit', '#guardarcsv2', function(e) {
		e.preventDefault();
		$('#btnGuardarCsv').prop('disabled',true);
		if (!confirm("Esta seguro de que desea guardar los registro?")) 
    		{	$('#btnGuardarCsv').prop('disabled',false);return false; }
    	else { 
    		var data = new FormData(this);
    		$.ajax({
    			type: 'POST',
    			url: $(this).attr('action'),
    			data: data,
    			contentType: false,
    			dataType: "json",
    			cache: false,
    			processData: false,
    			success: function(data){
    				//alert(data.error);
    				alert('Registros Actualizados '+data.updates);
    				$('#centro').empty();
    				$('#btnGuardarCsv').prop('disabled',false);
    				$('body').removeClass('modal-open');
    				$('.modal-backdrop').remove();
    				
    			    	
    			}          
    		});
    	}		
	});
	$(document).on('click', '.abre', function(e) {
		e.preventDefault();		
		var url=$(this).data('url');
		var titulo=$(this).data('titulo');
		$('.abre').parent().removeClass('active');
		$(this).parent().addClass('active');
		$('#crm_titulo').html(titulo);
		$('#centro').load(url);
		$('.navbar-collapse').collapse('hide');
    });
	$(document).on('click', '.abre2', function(e) {
		e.preventDefault();		
		var url=$(this).data('url');
		var titulo=$(this).data('titulo');
		console.log(url+' '+titulo);
		$('.abre2').parent().removeClass('active');
		$(this).parent().addClass('active');
		$('#crm_titulo').html(titulo);
		$('#contenido').load(url);
    });
	//editar
	$('.misdatos').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.post( "inc/carga_usuario.php",{ id:id }, function( data ) {	        
			if (data.success){
				$('#u_id_user').val(id);
				$('#u_nombre').val(data.usu.APELLYNOMBRE);
				$('#u_correo').val(data.usu.mail);
				$('#u_celular').val(data.usu.celular);
				$('#u_pass1').val(data.usu.CLAVE);
				$('#u_telefono').val(data.usu.TELEFONO);
				$('#u_pass2').val(data.usu.CLAVE);
				$('#u_passold').val(data.usu.CLAVE);
				$('#modal-misdatos').modal({
				    backdrop: 'static',
				    keyboard: false 
				});
				}
			else{
				alert('Error '+data.error);
				}
		},'json');
			
	});	
	//nuevo usuario
	$('#form-misdatos').submit(function(e){
		e.preventDefault();
		var pass1=$('#pass1').val();
		var pass2=$('#pass2').val();
		if (pass1===pass2){
			var data = new FormData(this);
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: data,
				contentType: false,
				dataType: "json",
				cache: false,
				processData: false,
				success: function(data){
					if (data.success){
						alert('Datos Actualizados');
						$('#modal-misdatos').modal('hide');					
						$('body').removeClass('modal-open');
						$('.modal-backdrop').remove();	
						}
					else{
						alert('Error '.data.error);
						}
				    
				    }          
			});
		}
		else{
			$('#mensaje').html('Las Claves no Coinciden, Intente de nuevo');
	    	$('#mensaje').focus();
	        $('#mensaje').delay(3000).fadeOut("slow");
			}	
    });
	
	//
//	$(":file").filestyle();
	//
	$('[data-toggle="tooltip"]').tooltip()
});

</script>
<style>

/* === Tipografía general === */
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
  font-weight: 500;
}

.app-header .nav-link:hover {
  color: #93c5fd;
}

.navbar-badge.badge {
  font-size: 0.75rem;
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
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Inicio</a></li>
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
            <li class="nav-item dropdown">
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
            <li class="nav-item dropdown">
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
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="dist/assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="dist/assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
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
          <a href="./index.html" class="brand-link">
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

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Beneficios
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class=" dropdown-item">
                    <a href="#" class=" nav-link abre"  title="Gestion de Jubilados" data-titulo="Jubilados" data-url="inc/lista_jubilados.php">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Jubildados</p>
                    </a>
                  </li>
                  <li class="dropdown-item">
                   <a href="#" class=" nav-link abre" title="Gestion de Pensionados" data-titulo="Pensionados" data-url="inc/lista_pensionados.php">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Pensionados</p>
                    </a>
                  </li>
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
                <a href="#" class="abre nav-link" title="Novedades del sitio" data-titulo="Novedades" data-url="inc/lista_novedades.php" >
                  <i class="nav-icon bi bi-pencil-square"></i>
                  <p>
                   Novedades
                  </p>
                </a>
                
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link abre" title="Lista de Licitaciones" data-titulo="Licitaciones" data-url="inc/lista_licitaciones.php" >
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
                    <a href="#" class="abre nav-link" title="Gestion Tipos" data-titulo="Lista de Tipos" data-url="inc/normativa_tipos.php" >
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
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Notificaciones
                   
                  </p>
                </a>
             </li>
              <li class="nav-item">
              <a href="#" class="abre nav-link" title="Calendario Pago" data-titulo="Novedades" data-url="inc/carga_fecha.php" >
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Fechas
                 
                  </p>
                </a>
              </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class= <ion-icon name="construct-sharp"></ion-icon></i>
                      <p>
                                    
                        Configuración
                           <i class="nav-arrow bi bi-chevron-right"></i>                    
                        
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Roles</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Generar Password</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Actualizar Datos Modificados</p>
                        </a>
                      </li>
                       <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Actualizar Expedentes</p>
                        </a>
                      </li>
                       <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Actualizar Liquidaciones</p>
                        </a>
                      </li>
                       <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Actualizar Inicio de Trámites</p>
                        </a>
                      </li>
                       <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Buscar Cuil</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="./examples/login-v2.html" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Mis Datos</p>
                        </a>
                      </li>
                 </ul>
                  </li>
                   <li class="nav-item">
                    <a href="#" class="nav-link">
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
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Administración IMPSR</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Escritorio</li>
                </ol>
              </div>
            </div>
            	<div id="centro" class="container">
		</div>
		 
          
       
       
       	
       
       	<div id="wait" class="load" >
		         <div
                      class="progress mb-4"
                      role="progressbar"
                      aria-label="Danger striped example"
                      aria-valuenow="100"
                      aria-valuemin="0"
                      aria-valuemax="100"
                    >
                      <div
                        class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                        style="width: 100%; border-radius: 0.375rem"
                      ></div>
     </div>
	  <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
</main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline"></div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          &copy; 2025&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">Área Informática</a>.
        </strong>
        Reservado todos los derechos.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
</div>
</div>
      </main>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    	<script src="js/popper.min.js" ></script>
	<script src="js/bootstrap.min.js" ></script>
	<!-- font awesome -->
	<script src="js/all.min.js"></script>
	<!-- datatables -->
	
	<script src="js/datatables.min.js"></script>
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>


    <!--end::Script-->
  </body>
  <!-- bootstrap -->
	<script src="js/popper.min.js" ></script>
	<script src="js/bootstrap.min.js" ></script>
	<!-- font awesome -->
	<script src="js/all.min.js"></script>
	<!-- datatables -->
	
	<script src="js/datatables.min.js"></script>
	
	<!-- bootstrap select -->
	<script src="js/bootstrap-select.js"></script>
	<!-- bootstrap file -->
<!--	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>  -->
	<!-- imprimir -->
	<script type="text/javascript" src="js/printThis.js"> </script>
	<!-- Exportar -->
	<script src="js/FileSaver.js"></script>
    <script src="js/Blob.js"></script>
    <script src="js/xlsx.core.min.js"></script>
    <script src="js/tableexport.js"></script>
    <!-- Print PDF -->
    <script src="js/jspdf.min.js"></script>
    <script src="js/jspdf.plugin.autotable.js"></script>
    <!-- Funciones Adicionales -->
	<script type="text/javascript" src="js/funciones.js"> </script>
  <!--end::Body-->
</html>
