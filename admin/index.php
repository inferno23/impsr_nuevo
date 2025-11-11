<?php
// Start session and require login
session_start();
if (!isset($_SESSION['imps']) || empty($_SESSION['imps'])) {
    // Not logged in - redirect to login page
    header('Location: login.php');
    exit;
}
?>
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

  <!-- Tooltips: la inicialización se realiza al final del documento (después de bootstrap.bundle) -->
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

    /**** */
    $(document).on('click', '#buscaCuil', function(e) {
      console.log('Buscar CUIL clicked');
		e.preventDefault();
         $('#resultadosCuil').empty();

        $('#modal-titulo').text('Buscar CUIL');

        const modal = new bootstrap.Modal(document.getElementById('modalCuil'));
        modal.show();
    });
    
    
    $('#buscaCuil2333').click(function(e){
      alert('Buscando CUIL...');
        e.preventDefault();
        $('#resultadosCuil').empty();
        $('#modalCuil').modal({
            backdrop: 'static',
            keyboard: false 
        });
    });
  // Mejorado: mostrar errores del JSON en pantalla
  $('#cuilBuscar').click(function(e){
    e.preventDefault();
    $('#resultadosCuil').empty();
    $('#cuilError').remove();
    var cuil = $('#cuil').val();
    $.ajax({
      type: 'POST',
      url: 'inc/buscar_cuit.inc.php',
      data: {cuil: cuil},
      dataType: 'json',
      success: function(resp) {
        if (resp.error) {
          var errorHtml = '<div id="cuilError" class="alert alert-danger mt-2">'+resp.error+'</div>';
          $('#resultadosCuil').before(errorHtml);
        } else {
          $('#resultadosCuil').html(resp.html || resp.result || '');
        }
      },
      error: function(xhr) {
        var msg = 'Error de red o formato de respuesta.';
        if (xhr.responseText) {
          try {
            var json = JSON.parse(xhr.responseText);
            if (json.error) msg = json.error;
          } catch(e) {
            msg = xhr.responseText;
          }
        }
        var errorHtml = '<div id="cuilError" class="alert alert-danger mt-2">'+msg+'</div>';
        $('#resultadosCuil').before(errorHtml);
      }
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
            {    $('.btn-guardar').prop('disabled',false);return false; }
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
            {    $('.btn-guardar').prop('disabled',false);return false; }
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
            {    $('.btn-guardar').prop('disabled',false);return false; }
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
            {    $('#btnGuardarMov').prop('disabled',false);return false; }
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
            {    $('#btnGuardarCsv').prop('disabled',false);return false; }
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
            {    $('#btnGuardarCsv').prop('disabled',false);return false; }
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
          var url = $(this).data('url');
          var titulo = $(this).data('titulo');
          var seccion = $(this).data('seccion');
          var sub_seccion = $(this).data('subseccion');
          var condicion = $(this).data('condicion');
        $('.abre').parent().removeClass('active');
        $(this).parent().addClass('active');
        $('#crm_titulo').html(titulo);
    
       // Cargamos el contenido y luego inicializamos el calendario
        $('#centro').load(url, function() {
          if (typeof inicializarCalendario === 'function') {
            inicializarCalendario(); // ✅ Aquí se inicializa
          }
        });
        // Compatibilidad: si está disponible el plugin jQuery de Bootstrap (v4) lo usamos;
        // si no, usamos la API de Bootstrap 5.
        if (typeof $.fn.collapse === 'function') {
            $('.navbar-collapse').collapse('hide');
        } else {
            var _el = document.querySelector('.navbar-collapse');
            if (_el && typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                var _inst = bootstrap.Collapse.getInstance(_el) || new bootstrap.Collapse(_el);
                _inst.hide();
            }
        }
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
                        alert('Error ' + data.error);
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
    //    $(:file).filestyle();
    //
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
            <h3 class="mb-0">Administración IMPSR</h3>
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
                  <button class="btn btn-default btn-flat me-auto" id="btnProfile">Mi perfil</button>
                  <a href="inc/salir.php" class="btn btn-default btn-flat">Cerrar sesión</a>
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
            <?php if ($_SESSION['imps']['admin']=='1'){ ?>
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Escritorio
                  </p>
                </a>
                
              </li>
              <?php } ?>
                  	<?php if ($_SESSION['imps']['usuarios']=='1'){ ?>

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

              <?php } ?>

             <?php if ($_SESSION['imps']['empleados']=='1'){ ?>

              <li class="nav-item">
                <a href="#" class=" nav-link abre" title="Gestion de Empleados" data-titulo="Empleados" data-url="inc/lista_empleados.php" >
                  <i class="nav-icon bi bi-clipboard-fill"></i>
                  <p>
                    Empleados
                  </p>
                </a>
                
              </li>

              <?php } ?>
              <?php if ($_SESSION['imps']['recibos']=='1'){ ?>

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

              <?php } ?>
              <?php if ($_SESSION['imps']['novedades']=='1'){ ?>

              <li class="nav-item">
               	<a href="#" class="abre nav-link" title="Novedades del sitio" data-titulo="Novedades del sitio" data-url="novedades.php" ><i class="nav-icon bi bi-pencil-square"></i>
                  <p>
                   Novedades
                  </p>
                </a>
              </li>
            <?php } ?>
			        <?php if ($_SESSION['imps']['licitaciones']=='1'){ ?>
			      

              <li class="nav-item">
                <a href="#" class=" abre nav-link" title="Lista de Licitaciones" data-titulo="Licitaciones" data-url="licitaciones.php" >
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Licitaciones
                
                  </p>
                </a>
                
              </li>
             <?php } ?>

  <?php if ($_SESSION['imps']['admin']=='1'){ ?>

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
                    <a href="normativa_tipo.php" class="nav-link" title="Gestion Tipos" data-titulo="Lista de Tipos" data-url="" >
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

               <?php } ?>
              <?php 
             //  ver tabla roles echo '$_SESSION fechas '.$_SESSION['imps']['fechas'];
              
             /// print_r($_SESSION['imps']);
              if ($_SESSION['imps']['fechas']=='1'){ ?>

              <li class="nav-item">
                <a href="#" class="nav-link">
                    
                  <i class="nav-icon bi bi-table"></i>
                  <p>
                    Fechas
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                    <ul class="nav nav-treeview">
                      <?php if ($_SESSION['imps']['admin']=='1'){ ?>
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
                        <a href="inc/calendario.php" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Bloquear Fechas
                           <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                    
                      </li>
                     <?php } ?>
                      	<?php if ($_SESSION['imps']['seccion']=='3'||$_SESSION['imps']['admin']=='1'){ ?>
                      <li class="nav-item">
                        <a href="inc/calendario_mesa.php?id_seccion=3" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Bloquear Fechas Mesa
                           <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                    
                      </li>
                    <?php } ?>
                    	<?php if ($_SESSION['imps']['seccion']=='2'||$_SESSION['imps']['admin']=='1'){ ?>
                      <li class="nav-item">
                        <a href="inc/calendario_jubilaciones.php?id_seccion=2" class="nav-link">
                          <i class="nav-icon bi bi-circle"></i>
                          <p>Bloquear Fechas Jubilaciones
                           <i class="nav-arrow bi bi-chevron-right"></i></p>
                        </a>
                    
                      </li>
                       <?php } ?>
                    </ul>
              </li>
            <?php } ?>
			        <?php if ($_SESSION['imps']['turnos']=='1'){ ?>

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
                  	<a href="#" class="abre nav-link" title="Agenda" data-titulo="Agenda de turnos" data-url="inc/agenda_turnos.php?admin=<?php echo $_SESSION['imps']['admin']; ?>&seccion=<?php echo $_SESSION['imps']['seccion']; ?>" >
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Agenda</p>
                    </a>
                  </li>
                    <?php if ($_SESSION['imps']['admin']=='1'){ ?>
                  <li class="nav-item">
                   <a href="#" class="abre nav-link" title="Excepcion" data-titulo="Pedidos Excepcion" data-url="inc/turnos_excepcion.php">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Excepcion</p>
                    </a>
                  </li>
                                 <?php } ?>

                </ul>
              </li>                  
               </li>

               <?php } ?>
                <?php if ($_SESSION['imps']['admin']=='1'){ ?>
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
                      <?php }?>
                      
			        	    	<?php if ($_SESSION['imps']['cuil']=='1'){ ?>

                       <li class="nav-item">
                        	<a href="#" class="nav-link" id="buscaCuil" title="Buscar Cuil en COFEPRES">
                             <i class="nav-icon bi bi-circle"></i>                          
                          <p>Buscar Cuil</p>
                        </a>
                      </li>
                      <?php }?>
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
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0"></h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
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
    </div> <!-- /.app-wrapper -->

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

    <!-- Dialog nativo para editar perfil (elemento <dialog> en lugar de modal) -->
<dialog id="dialogPerfil" class="p-0" style="max-width:720px;width:100%;border:none;border-radius:.5rem;">
  <form id="formPerfil" method="POST" action="inc/save_profile.php" enctype="multipart/form-data" style="margin:0;">
    <input type="hidden" name="id" id="perfil_id" value="<?php echo $_SESSION['imps']['IDPERSONA']; ?>">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="m-0">Editar Perfil</h5>
        <button type="button" class="btn btn-sm btn-outline-secondary" id="dialogCloseBtn">Cerrar</button>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-12">
            <label for="perfil_nombrecompleto" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="perfil_nombrecompleto" name="nombrecompleto" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="perfil_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="perfil_email" name="email" required>
          </div>
          <div class="col-md-6">
            <label for="perfil_telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="perfil_telefono" name="telefono">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="perfil_fechanac" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="perfil_fechanac" name="fechanacimiento">
          </div>
          <div class="col-md-6">
            <label for="perfil_domicilio" class="form-label">Domicilio</label>
            <input type="text" class="form-control" id="perfil_domicilio" name="domicilio">
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="perfil_position" class="form-label">Puesto</label>
            <input type="text" class="form-control" id="perfil_position" name="position" placeholder="Ej: Desarrollador/a, Administrador">
          </div>
          <div class="col-md-6"></div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="perfil_imagen" class="form-label">Imagen de Perfil</label>
            <input type="file" class="form-control" id="perfil_imagen" name="imagen" accept="image/*">
          </div>
        </div>
        <div class="mb-3">
          <label for="perfil_acerca" class="form-label">Acerca de mí</label>
          <textarea class="form-control" id="perfil_acerca" name="acerca" rows="3"></textarea>
        </div>
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </form>
</dialog>
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
<!--end::Body-->
<script>
  // DEBUG: mostrar en consola cuando se cargue el dialog
  //console.log('Dialog de perfil cargado');

  (function(){
    // ID del usuario desde la sesión
    var userId = <?php echo intval($_SESSION['imps']['IDPERSONA']); ?>;
    var placeholder = 'dist/assets/img/user2-160x160.jpg';

    function setProfileUI(profile){
      var img = profile && profile.image_url ? profile.image_url : placeholder;
      var name = (profile && profile.full_name) ? profile.full_name : 'Usuario';
      var position = profile && profile.position ? profile.position : '';
      $('#user_image').attr('src', img);
      $('#user_image_large').attr('src', img);
      $('#user_name').text(name).removeClass('d-none');
      $('#user_name_large').text(name);
      if (position) {
        $('#user_position').text(position).removeClass('d-none');
        $('#user_position_large').text(position);
      } else {
        $('#user_position').text('').addClass('d-none');
        $('#user_position_large').text('');
      }
    }

    function loadProfile(){
      $.getJSON('inc/get_profile.php', { user_id: userId })
        .done(function(resp){
          if (resp.success && resp.profile){
            setProfileUI(resp.profile);
          } else {
            setProfileUI(null);
          }
        }).fail(function(){ setProfileUI(null); });
    }

    // Abrir dialog y rellenar campos (usando elemento <dialog>)
    $('#btnProfile').on('click', function(e){
      e.preventDefault();
      $.getJSON('inc/get_profile.php', { user_id: userId })
        .done(function(resp){
          try {
            var p = resp && resp.profile ? resp.profile : null;
            if (!p && resp && resp.debug && resp.debug.person_raw) {
              var per = resp.debug.person_raw;
              p = {};
              if (per.APELLYNOMBRE) p.full_name = per.APELLYNOMBRE;
              if (per.mail) p.email = per.mail;
              if (per.celular) p.phone = per.celular;
              else if (per.TELEFONO) p.phone = per.TELEFONO;
              if (per.FECHANACIMIENTO) p.fechanacimiento = per.FECHANACIMIENTO;
              if (per.DOMICILIO) p.domicilio = per.DOMICILIO;
              if (resp.debug.extra_raw) {
                var ex = resp.debug.extra_raw;
                if (ex.position) p.position = ex.position;
                if (ex.about) p.about = ex.about;
                if (ex.image_path) p.image_path = ex.image_path;
              }
            }
            // Solo nombre completo
            $('#perfil_nombrecompleto').val(p.full_name || '');
            $('#perfil_email').val(p.email || '');
            $('#perfil_telefono').val(p.phone || '');
            $('#perfil_position').val(p.position || '');
            $('#perfil_acerca').val(p && (p.about || p.ABOUT) ? (p.about || p.ABOUT) : '');
            $('#perfil_fechanac').val(p.fechanacimiento || '');
            $('#perfil_domicilio').val(p.domicilio || '');
          } catch (err) {
            $('#perfil_nombrecompleto').val('');
            $('#perfil_email').val('');
            $('#perfil_telefono').val('');
            $('#perfil_position').val('');
            $('#perfil_acerca').val('');
            $('#perfil_fechanac').val('');
            $('#perfil_domicilio').val('');
          }
          var d = document.getElementById('dialogPerfil');
          if (typeof d.showModal === 'function') {
            d.showModal();
          } else {
            $('#dialogPerfil').addClass('show');
            $('body').addClass('modal-open');
          }
        }).fail(function(jqXHR, textStatus, err){
          alert('No se pudo cargar los datos del perfil. Revise la consola.');
        });
    });

    document.addEventListener('click', function(ev){
      if (ev.target && ev.target.id === 'dialogCloseBtn') {
        var d = document.getElementById('dialogPerfil');
        if (typeof d.close === 'function') d.close();
      }
    });

    // Envío del formulario por AJAX
    $('#formPerfil').on('submit', function(e){
      e.preventDefault();
      var fd = new FormData(this);
      fd.set('id', userId);
      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        dataType: 'json'
      }).done(function(resp){
        if (resp.success){
          if (resp.profile) setProfileUI(resp.profile);
          var d = document.getElementById('dialogPerfil');
          if (typeof d.close === 'function') d.close();
          alert('Perfil guardado correctamente');
        } else {
          alert('Error: ' + (resp.error || 'No se pudo guardar'));
        }
      }).fail(function(xhr, ts, err){
        alert('Error de red. Intente nuevamente.');
      });
    });

    // Cargar al inicio
    $(function(){ loadProfile(); });
  })();
</script>
</body>
</html>
