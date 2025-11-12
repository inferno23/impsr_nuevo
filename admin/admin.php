<?php
session_start();
if (!isset($_SESSION['imps'])){
    header("location:index.php");
} 


?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Ingreso Sistema</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--/*<base href="/sistema/" target="_blank">*/
	
	<!-- bootstrap -->
	  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet" >
	<!-- bootstrap select -->
	
	<!-- fontawesome -->
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
	
	<!-- Jquery 3 -->
<!--	<script src="js/jquery-3.1.1.min.js"></script> -->


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- TinyMCE -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<!-- FullCalendar: cargalo aquí, una vez -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/es.js"></script>





	
<script>
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
	
       // Cargamos el contenido y luego inicializamos el calendario
        $('#centro').load(url, function() {
          if (typeof inicializarCalendario === 'function') {
            inicializarCalendario(); // ✅ Aquí se inicializa
          }
        });
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
	$(":file").filestyle();
	//
	$('[data-toggle="tooltip"]').tooltip()
});

</script>
<style>
html{
    font-family: 'Magra', sans-serif;
}
body{
	font-size:14px;
	padding: 0 !important;
	margin: 0 !important;
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
.table th{
    font-size:14px;
    
}
.table td{
    font-size:14px !important;
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
.loading {
  position: fixed;
  z-index: 9999;
  height: 2em;
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
.loading:before {
  content: '';
  display: block;
  position: fixed;
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

<body>
<header class="bg-dark navbar navbar-expand-lg navbar-dark  bd-navbar noprint mb-2">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            	<span class="navbar-toggler-icon"></span>
          	</button>
			<span class="h1 navbar-brand mb-0 mr-0 mr-md-2">IMPS Rosario</span>
			
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
    			<ul class="navbar-nav bd-navbar-nav   mr-auto">
                  	<?php if ($_SESSION['imps']['usuarios']=='1'){ ?>
			        <li class="nav-item dropdown">
			        	<a href="#" class="nav-link dropdown-toggle" id="benelista" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bene.<span class="caret"></span></a>
			        	<div class="dropdown-menu"  aria-labelledby="benelista">
			        		<a href="#" class="abre dropdown-item" title="Gestion de Jubilados" data-titulo="Jubilados" data-url="inc/lista_jubilados.php" >Jubilados</a>
			        		<a href="#" class="abre dropdown-item" title="Gestion de Pensionados" data-titulo="Pensionados" data-url="inc/lista_pensionados.php">Pensionados</a>
						</div>
			        </li>
			        <?php } ?>
			        <?php if ($_SESSION['imps']['empleados']=='1'){ ?>
			        <li class="nav-item"><a href="#" class=" nav-link abre" title="Gestion de Empleados" data-titulo="Empleados" data-url="inc/lista_empleados.php" >Empleados</a></li>
			        <?php } ?>
			        <?php if ($_SESSION['imps']['recibos']=='1'){ ?>
			        <li class="nav-item dropdown">
			        	<a href="#" class="nav-link dropdown-toggle" id="droprecibos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Recibos<span class="caret"></span></a>
			        	<div class="dropdown-menu"  aria-labelledby="droprecibos">
			        		<a href="#" class="abre dropdown-item" title="Carga de Recibos de Beneficiarios" data-titulo="Recibos" data-url="inc/recibos_beneficiarios.php" >Recibos Beneficiarios</a>
			        		<a href="#" class="abre dropdown-item" title="Carga de Recibos de Empleados" data-titulo="Recibos" data-url="inc/recibos_empleados.php" >Recibos Empleados</a>
						</div>
			        </li>
			        <li class="nav-item dropdown">
			        	<a href="#" class="nav-link dropdown-toggle" id="droprecibos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bloquear Fechas<span class="caret"></span></a>
			        	<div class="dropdown-menu"  aria-labelledby="droprecibos">
			        		<a href="#" class="abre dropdown-item" title="bloquear fechas libres" data-titulo="Recibos" data-url="inc/fechas_libres.php" >Fechas Libres</a>
			        		<a href="#" class="abre dropdown-item" title="bloquear fechas para renovacion" data-titulo="Recibos" data-url="inc/credito_renovacion.php" >Crédito Renovación</a>
			        		<a href="#" class="abre dropdown-item" title="bloquear fechas para solicitud" data-titulo="Recibos" data-url="inc/credito_solicitud.php" >Crédito Solicitud</a>
						</div>
			        </li>
			        <?php } ?>
			        
			        <?php if ($_SESSION['imps']['novedades']=='1'){ ?>
			        <li class="nav-item"><a href="#" class="abre nav-link" title="Novedades del sitio" data-titulo="Novedades" data-url="inc/lista_novedades.php" >Novedades</a></li>
			        <?php } ?>
			        <?php if ($_SESSION['imps']['licitaciones']=='1'){ ?>
			        <li class="nav-item"><a href="#" class="nav-link abre" title="Lista de Licitaciones" data-titulo="Licitaciones" data-url="inc/lista_licitaciones.php" >Lici.</a></li>
			        <?php } ?>
			        <?php if ($_SESSION['imps']['legislacion']=='1'){ ?>
			        <li class="nav-item"><a href="#" class="nav-link abre" title="Lista de Archivos Legislacion" data-titulo="Legislacion" data-url="inc/lista_legislacion.php" >Legis.</a></li>
			        <?php } ?>
			        <?php if ($_SESSION['imps']['notificaciones']=='1'){ ?>
			        <li class="nav-item"><a href="#" class="nav-link abre" title="Lista de Notificacion de Fallecimiento" data-titulo="Notificaciones" data-url="inc/lista_notificaciones.php" >Notif.</a></li>
			        <?php } ?>
			        <?php if ($_SESSION['imps']['fechas']=='1'){ ?>
			        <li class="nav-item"><a href="#" class="nav-link abre" title="Fecha de Cobro" data-titulo="Fecha de cobro" data-url="inc/lista_fechas.php" >Fechas</a></li>
			        <?php } ?>
			        
			        <?php if ($_SESSION['imps']['turnos']=='1'){ ?>
			        <li class="nav-item dropdown">
			        	<a href="#" class="nav-link dropdown-toggle" id="droprecibos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Turnos<span class="caret"></span></a>
			        	<div class="dropdown-menu"  aria-labelledby="droprecibos">
			        		<a href="#" class="abre dropdown-item" title="turnos" data-titulo="Lista de Turnos" data-url="inc/lista_turnos.php" >Turnos</a>
			        		<a href="#" class="abre dropdown-item" title="Agenda" data-titulo="Agenda de turnos" data-url="inc/agenda_turnos.php" >Agenda</a>
			        		<a href="#" class="abre dropdown-item" title="Excepcion" data-titulo="Pedidos Excepcion" data-url="inc/turnos_excepcion.php" >Excepcion</a>
						</div>
			        </li>
			        
			        <?php } ?>
			    
			       
			        <li class="nav-item dropdown">
			        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs" ></i><span class="caret"></span></a>
			        	<div class="dropdown-menu"  aria-labelledby="navbarDropdownMenuLink">
			        		<?php if ($_SESSION['imps']['admin']=='1'){ ?>
			        		<a href="#" class="abre dropdown-item" title="Lista de roles permisos" data-titulo="Roles" data-url="inc/lista_roles.php" >Roles</a>
			        		<a href="#" class="abre dropdown-item" title="Lista de usuarios sin passwd" data-titulo="Roles" data-url="inc/lista_passwd.php" >Generar Passwd</a>
			        		<a href="#" class="dropdown-item" id="cargaCsv1" title="Update MUNIXPER con csv" >Updater Munixper</a>
			        		<a href="#" class="dropdown-item" id="cargaCsv3" title="Update Datos con csv" >Update Datos</a>
			        		<a href="#" class="dropdown-item" id="cargaMov" title="Update Expedientes con csv" >Update Expedientes</a>
			        		<a href="#" class="dropdown-item" id="cargaLiq" title="Update Liq con csv" >Update Liq</a>
			        		<a href="#" class="dropdown-item" id="cargaUpdate" title="Update Liq con csv" >Update Modificacion</a>
			        		<?php }?>
			        		<?php if ($_SESSION['imps']['cuil']=='1'){ ?>
			        		<a href="#" class="dropdown-item" id="buscaCuil" title="Buscar Cuil en COFEPRES" >Buscar Cuil</a>
			        		<?php }?>
						    <div class="dropdown-divider"></div>
						    <a href="#" class="misdatos dropdown-item" data-id="<?php echo $_SESSION['imps']['IDPERSONA'];?>" >Mis Datos</a>
						    <a href="inc/salir.php" class="dropdown-item">Salir</a>
						</div>
			        </li>
			      </ul>  
				</div>
				<span id="usuario" class="navbar-text ml-md-auto">Usuario : <?php echo $_SESSION['imps']['APELLYNOMBRE']; ?></span>
		</header>
		<div id="centro" class="container-fluid">
		</div>
	<!-- ingreso -->
    <div class="modal fade" id="modalCsv1" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-ingreso">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<form action="inc/cargar_csv2alt.php" method="post" id="formCsv1" enctype="multipart/form-data" >
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="modal-titulo-ingreso">Nuevo Update</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    	      </div>
    	      <div class="modal-body">
    			
                <div class="row form-group">	
                	  
                    <div class="input-group col-12 ml-auto ">
                        <span class="input-group-addon">Archivo </span>
                        <input class="form-control" type="file" name="archivo" id="archivo" accept=".csv" />
                        
                    </div>            	
    			</div>
    			
    		  </div>
    		  <div class="modal-footer">
    		  	<button type="submit" class="btn btn-primary" id="cambiar-pago">Cargar</button>
    		   	<button type="button" class="cerrar btn btn-default" data-dismiss="modal">Cerrar</button>
    		  </div>
    		  </form>
    	    </div>
    	</div>
    </div>
    <!-- buscar cuit -->
    <!-- ingreso -->
    <div class="modal fade" id="modalMov" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-ingreso">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<form action="inc/cargar_csvmov.php" method="post" id="formMov" enctype="multipart/form-data" >
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="modal-titulo-ingreso">Nuevo Update</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    	      </div>
    	      <div class="modal-body">
    			
                <div class="row form-group">	
                	  
                    <div class="input-group col-12 ml-auto ">
                        <span class="input-group-addon">Archivo </span>
                        <input class="form-control" type="file" name="archivo"  accept=".csv" />
                        
                    </div>            	
    			</div>
    			
    		  </div>
    		  <div class="modal-footer">
    		  	<button type="submit" class="btn btn-primary" >Cargar</button>
    		   	<button type="button" class="cerrar btn btn-default" data-dismiss="modal">Cerrar</button>
    		  </div>
    		  </form>
    	    </div>
    	</div>
    </div>
    <!-- Liq -->
    <div class="modal fade" id="modalLiq" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-ingreso">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<form action="inc/cargar_liq.php" method="post" id="formLiq" enctype="multipart/form-data" >
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="modal-titulo-ingreso">Nuevo Update</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    	      </div>
    	      <div class="modal-body">
    			
                <div class="row form-group">	
                	  
                    <div class="input-group col-12 ml-auto ">
                        <span class="input-group-addon">Archivo </span>
                        <input class="form-control" type="file" name="archivo"  accept=".csv" />
                        
                    </div>            	
    			</div>
    			
    		  </div>
    		  <div class="modal-footer">
    		  	<button type="submit" class="btn btn-primary" >Cargar</button>
    		   	<button type="button" class="cerrar btn btn-default" data-dismiss="modal">Cerrar</button>
    		  </div>
    		  </form>
    	    </div>
    	</div>
    </div>
    <!-- fin liq-->
    <!-- buscar cuit -->
    <!-- ingreso -->
    <div class="modal fade" id="modalCuil" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-ingreso">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    		  <div class="modal-header">
    	        <h5 class="modal-title" id="modal-titulo-ingreso">COFEPRES - BUSCAR CUIL</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    	      </div>
    	      <div class="modal-body">
    			
                <div class="row form-group">	
                	  
                    <div class="input-group col-12 ml-auto ">
                        <span class="input-group-addon">CUIL <small>Solo Numeros</small></span>
                        <input class="form-control" type="text" placeholder="XXXXXXXXXXX" id="cuil" pattern="[0-9]+" />
                        
                    </div>            	
    			</div>
    			<div class="row">
    				<div class="col-12" id="resultadosCuil"></div>
    			</div>
    		  </div>
    		  <div class="modal-footer">
    		  	<button type="button" class="btn btn-secondary imprime" data-print="resultadosCuil">Imprimir</button>
    		  	<button type="button" class="btn btn-primary" id="cuilBuscar">Buscar</button>
    		   	<button type="button" class="cerrar btn btn-default" data-dismiss="modal">Cerrar</button>
    		  </div>
    		  </form>
    	    </div>
    	</div>
    </div>
    <!-- fin buscar -->
    <div class="modal fade" id="modalCsv2" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-ingreso">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<form action="inc/cargar_csv.php" method="post" id="getcsv2" enctype="multipart/form-data" >
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="modal-titulo-ingreso2">Nuevo Ingreso</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    	      </div>
    	      <div class="modal-body">
    			
                <div class="row form-group">	
                	  
                    <div class="input-group col-7 ml-auto ">
                        <span class="input-group-addon">Archivo </span>
                        <input class="form-control" type="file" name="archivo" id="archivo2" accept=".csv" />
                        
                    </div>            	
    			</div>
    			<div class="row form-group">	
                	
    			</div>
    			
    		  </div>
    		  <div class="modal-footer">
    		  	<button type="submit" class="btn btn-primary">Cargar</button>
    		   	<button type="button" class="cerrar btn btn-default" data-dismiss="modal">Cerrar</button>
    		  </div>
    		  </form>
    	    </div>
    	</div>
    </div>
    
    <div class="modal fade" id="modalCsv3" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-ingreso">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<form action="inc/cargar_csv_datos.php" method="post" id="getcsvdatos" enctype="multipart/form-data" >
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="modal-titulo-ingreso2">Actualizar Datos</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    	      </div>
    	      <div class="modal-body">
    			
                <div class="row form-group">	
                	  
                    <div class="input-group col-7 ml-auto ">
                        <span class="input-group-addon">Archivo </span>
                        <input class="form-control" type="file" name="archivo"  accept=".csv" />
                        
                    </div>            	
    			</div>
    			<div class="row form-group">	
                	
    			</div>
    			
    		  </div>
    		  <div class="modal-footer">
    		  	<button type="submit" class="btn btn-primary">Cargar</button>
    		   	<button type="button" class="cerrar btn btn-default" data-dismiss="modal">Cerrar</button>
    		  </div>
    		  </form>
    	    </div>
    	</div>
    </div>
    <!-- Modal CSV -->
	<div class="modal fade" id="modal-misdatos" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_misdatos.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="form-misdatos" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal-titulo">Editar Mis Datos</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
	        <input type="hidden" name="id" id="u_id_user" value="<?php echo $_SESSION['crm']['id'];?>">
	        <input type="hidden" name="activo" value="<?php echo $_SESSION['crm']['activo'];?>">
	      </div>
	      <div class="modal-body">
	      	<div class="form-group row">
	      		<div class="input-group col-12">
    				<div class="input-group-prepend">
                    	<span class="input-group-text">Apellido y Nombre</span>
                    </div>	
        			<input class="form-control" type="text" name="nombre" id="u_nombre" required />
        		</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-4">
    				<div class="input-group-prepend">
                    	<span class="input-group-text">Correo</span>
                    </div>	
        			<input class="form-control" type="text" name="correo" id="u_correo"  />
        		</div>
        		<div class="input-group col-4">
    				<div class="input-group-prepend">
                    	<span class="input-group-text">Telefono</span>
                    </div>	
        			<input class="form-control" type="tel" name="telefono" id="u_telefono" />
        		</div>
        		<div class="input-group col-4">
    				<div class="input-group-prepend">
                    	<span class="input-group-text">Celular</span>
                    </div>	
        			<input class="form-control" type="tel" name="celular" id="u_celular" />
        		</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-6">
    				<div class="input-group-prepend">
                    	<span class="input-group-text">Password</span>
                    </div>	
        			<input class="form-control pass" type="password" name="pass" id="u_pass1" required >
        			<div class="input-group-append">
            			<button type="button" class="btn mostrar"><i class="fas fa-eye ver" ></i></button>
            		</div>
        		</div>
        		<div class="input-group col-6">
    				<div class="input-group-prepend">
                    	<span class="input-group-text">Repita Password</span>
                    </div>	
        			<input class="form-control pass" type="password" name="pass" id="u_pass2" required >
        		</div>
	      	</div>
			
			<input type="hidden" name="passold" id="u_passold">
			<output id="mensaje"></output>
		  </div>
		  <div class="modal-footer">
		   	<input name="guardar" type="submit" class="btn btn-primary" value="Guardar" />
		    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
		  </div>
	      </form>
	    </div>
	  </div>
	</div>
	
    <!-- Liq -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog">
    	<div class="modal-dialog" role="document">
    		<div class="modal-content">
    			<form action="inc/cargar_csv_modificacion.php" method="post" id="formUpdate" enctype="multipart/form-data" >
    	      <div class="modal-header">
    	        <h5 class="modal-title" >Subi Actualizacion</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    	      </div>
    	      <div class="modal-body">
    			
                <div class="row form-group">	
                	  
                    <div class="input-group col-12 ml-auto ">
                        <span class="input-group-addon">Archivo </span>
                        <input class="form-control" type="file" name="archivo"  accept=".csv" />
                        
                    </div>            	
    			</div>
    			
    		  </div>
    		  <div class="modal-footer">
    		  	<button type="submit" class="btn btn-primary" >Cargar</button>
    		   	<button type="button" class="cerrar btn btn-default" data-dismiss="modal">Cerrar</button>
    		  </div>
    		  </form>
    	    </div>
    	</div>
    </div>
	<div id="wait" class="loading">
		<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
		<span class="sr-only">Loading...</span>
	</div>
	
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
	<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
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
	
</html>