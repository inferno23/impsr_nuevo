<?php

include 'head.php'; ?>
<?php include 'header.php'; ?>

<script>
 

$('#carouselExampleControls').carousel('pause'); 
</script>
<style>
<!--
.carousel-item .mascara {
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 10;
    background: rgba(0,0,0,0.25);
    background: -moz-linear-gradient(top, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.26) 0%, rgba(237,237,237,0) 13%, rgba(255,255,255,0) 14%, rgba(255,255,255,0) 35%, rgba(255,255,255,0) 48%, rgba(255,255,255,0.06) 51%, rgba(0,0,0,1) 96%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0,0,0,0.25)), color-stop(0%, rgba(0,0,0,0.26)), color-stop(13%, rgba(237,237,237,0)), color-stop(14%, rgba(255,255,255,0)), color-stop(35%, rgba(255,255,255,0)), color-stop(48%, rgba(255,255,255,0)), color-stop(51%, rgba(255,255,255,0.06)), color-stop(96%, rgba(0,0,0,1)));
    background: -webkit-linear-gradient(top, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.26) 0%, rgba(237,237,237,0) 13%, rgba(255,255,255,0) 14%, rgba(255,255,255,0) 35%, rgba(255,255,255,0) 48%, rgba(255,255,255,0.06) 51%, rgba(0,0,0,1) 96%);
    background: -o-linear-gradient(top, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.26) 0%, rgba(237,237,237,0) 13%, rgba(255,255,255,0) 14%, rgba(255,255,255,0) 35%, rgba(255,255,255,0) 48%, rgba(255,255,255,0.06) 51%, rgba(0,0,0,1) 96%);
    background: -ms-linear-gradient(top, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.26) 0%, rgba(237,237,237,0) 13%, rgba(255,255,255,0) 14%, rgba(255,255,255,0) 35%, rgba(255,255,255,0) 48%, rgba(255,255,255,0.06) 51%, rgba(0,0,0,1) 96%);
    background: linear-gradient(to bottom, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.26) 0%, rgba(237,237,237,0) 13%, rgba(255,255,255,0) 14%, rgba(255,255,255,0) 35%, rgba(255,255,255,0) 48%, rgba(255,255,255,0.06) 51%, rgba(0,0,0,1) 96%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000', GradientType=0 );
}
.carousel-item .seccion {
    position: absolute;
    top: 10px;
    font-size: .6797rem;
    padding: .3rem 2rem;
    margin-bottom: 2%;
    text-transform: uppercase;
    display: inline-block;
    vertical-align: top;
    background-color: #1E619A;
    color: #FFF !important;
}
.list-link{
    background-position: center;
    border-radius:0 !important;
    padding:0;
    border:0;
}
.list-front{
    padding: .75rem 1.25rem;
    width:100%;
    height:100%;
    background-color: #00bee3;
    display:flex;
    background: linear-gradient(to right, rgb(20 101 149 / 99%) 20%, rgb(210 195 195 / 0%));
}
.list-span{
    color: #fff;
    font-size:1.5em;
    font-weight: 600;
        margin-top: auto;
    margin-bottom: auto;
}

.list-link:hover{
background-color:#1E619A;
color: #fff;
}
.list-link:active{
background-color:#1E619A;
color: #fff;
}
.list-link:focus{
background-color:#1E619A;
color: #fff;
}
.menu-detalle .dropdown-item {
    font-size: 1.2em;
    color: #1e619a;
    display: flex;
    padding-top: 0.6rem;
    padding-bottom: 0.6rem;
}
.menu-detalle .dropdown-item:hover {
    color: #fff;
}
.menu-detalle .dropdown-item span {
    margin-left: auto;
}
-->

.link-acceso{
    text-decoration:none !important;
    
}
.link-acceso:hover {
    color: #495057;
    text-decoration: none;
    background-color: #f8f9fa;
    }
#botones{
    position:relative;
}    
.menu-detalle{
    position: absolute;
    top: 0px;
    right: calc(-200% - 60px);
    z-index: 10;
    width: 100%;
    }   
    
@media (max-width: 768px) {
    .menu-detalle{
    position: relative;
    top: 0px;
    right: 0px;
    z-index: 10;
    width: 100%;
    }   
}     
</style>

<div class="container">
	<div class="row">
		<div class="col-12 mb-3">
			<img src="https://impsr.gob.ar/img/bannerwap.png" alt="imagen banner" class="w-100 img-fluid ">
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-4 order-md-1 order-2">
			<section id="botones">
				<div class="list-group">
                	<a href="#" data-id="menu1" style="background-image: url(https://impsr.gob.ar/img/tramites.jpg);" class="list-group-item list-group-item-action list-link abreMenu mb-3 ">
                		<span class="list-front">
                			<span class="list-span">Tramites</span>	
                		</span>	
                	</a>
                    <div class="collapse menu-detalle" id="menu1">
                      <div class="card card-body">
                       	<div class="list-group">
                       		<a class="dropdown-item" href="jubilacionord.html">Jubilación ordinaria <span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="jubilacion_para_ex_presos_politicos.html">Jubilación optativa para ex presos políticos<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="jubilacion_por_edad_avanzada.html">Jubilación por edad avanzada<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="jubilacion_por_invalidez.html">Jubilación por invalidez<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="jubilacion_por_discapacidad.html">Jubilación por discapacidad<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="jubilacion_para_ex_combatientes_de_malvinas.html">Jubilación para ex combatientes de Malvinas<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="pensiones.html">Pensiones<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="subsidio_jubilatorio.html">Subsidio Jubilatorio<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="cobro_haberes_ext.html">Cobro de haberes en el exterior<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="salario_familiar.html">Salario familiar<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="pago_de_haberes.html">Pago de Haberes<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="comunicacion_de_fallecimiento.html">Comunicación subsidio por fallecimiento<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="creditos_personales.html">Creditos Personales<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                        </div>
                      </div>
                    </div>
                    <a href="#" data-id="menu2" style="background-image: url(https://impsr.gob.ar/img/servicios.jpg);" class="list-group-item list-group-item-action list-link abreMenu mb-3">
                    	<span class="list-front">
                			<span class="list-span">Servicíos</span>	
                		</span></a>
                	<div class="collapse menu-detalle" id="menu2">
                      <div class="card card-body">
                        <div class="list-group">
                          	<a class="dropdown-item" href="calendario.html">Calendario de pagos<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="http://servicioswww.anses.gov.ar/ConstanciadeCuil2/Inicio.aspx" target="_blank">Constancia de Cuil<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="constancia_no_beneficio.html">Contancia No Beneficio<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                            <a class="dropdown-item" href="consulta.php">Consulta de expedientes<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
    						<a class="dropdown-item" href="no_inicio_tramite.html">NO Inicio de Trámite<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
    						<a class="dropdown-item" href="http://impsr.gob.ar/turismo/">Turismo<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
    						<a class="dropdown-item" href="iapos.html">Iapos<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
							<a class="dropdown-item" href="servicios_funebres.html">Servicios fúnebres<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
							<a class="dropdown-item" href="https://www.lacaja.com.ar/estaticos/micrositio-rosario/MS-Rosario/index.html">Seguros de vida<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                        	<a class="dropdown-item" href="https://seguros.lacaja.com.ar/personas/centro-de-operaciones-online">Certificados de Incorporación<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span></a>
                        </div>
                      </div>
                    </div>    
                    <a href="legislacion.html" style="background-image: url(https://impsr.gob.ar/img/legislacion.jpg);" data-id="menu3" class="list-group-item list-group-item-action list-link mb-3">
                    	<span class="list-front">
                    		<span class="list-span">Legislación</span>
                    	</span>
                    </a>
                    
                    <a href="licitaciones.html" style="background-image: url(https://impsr.gob.ar/img/legislacion.jpg);" data-id="menu4" class="list-group-item list-group-item-action list-link ">
                    	<span class="list-front">
                    		<span class="list-span">Licitaciones</span>	
                    	</span>
                    </a>
                	
                </div>
                
                
                
                
			</section>
		</div>
		<div class="col-12 col-sm-8 order-md-2 order-1" id="sliders">
			
			<section id="presentacion" >
            	<?php 
                include_once 'functions/connect.php';
                global $con;
                $nov=mysqli_query($con, "SELECT a.*,b.nombre nomseccion FROM novedades a LEFT JOIN novedades_secciones b ON a.seccion=b.id WHERE a.activo='1' ORDER BY `a`.`principal` DESC , a.fecha DESC");		
                ?>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                      <?php 
                      $i=0;
                      while ($row=mysqli_fetch_assoc($nov)) { ?> 
                		<li data-target="#carouselExampleControls" data-slide-to="<?php echo $i;?>"<?php if ($row['principal']=='1') { echo ' class=\"active\" '; }?> ></li>
                      <?php
                        $i++;
                      } ?>
                      </ol>
                      <div class="carousel-inner" style="min-height: 200px;">
                      <?php 
                      $i=0;
                      mysqli_data_seek($nov, 0);
                      while ($row=mysqli_fetch_assoc($nov)) { ?>
                        <div class="carousel-item <?php if ($row['principal']=='1') { echo ' active '; }?>">
                			<div class="seccion"><?php echo $row['nomseccion'];?></div>        	
                          	<a href="novedades.php?id=<?php echo $row['id'];?>">
                          		<img class="d-block w-5 img-fluid" src="<?php echo $row['imagen'];?>" alt="First slide">
                          	</a>
                          	<div class="mascara"></div>
                          	<div class="carousel-caption d-none d-md-block">
                          		<h3><a href="noticia.php?id=<?php echo $row['id'];?>"><?php echo $row['titulo'];?></a></h3>
                            	<p><a href="noticia.php?id=<?php echo $row['id'];?>"><?php echo $row['subtitulo'];?></a></p>
                            </div>
                        </div>
                	  <?php
                        $i++;
                      } ?>	
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                </div>
            </section>
            <section id="accesos" class="w-100" >
            
            	<div class="row h-100 mt-3">
            		<div class="col-6 col-md-6 col-lg-3 d-flex mb-3">
            			<a href="#" class="w-100  border link-acceso">LINK 1</a>
            		</div>
            		<div class="col-6 col-md-6 col-lg-3 d-flex mb-3">
            			<a href="#" class="w-100  border link-acceso">LINK 1</a>
            		</div>
            		<div class="col-6 col-md-6 col-lg-3 d-flex mb-3">
            			<a href="#" class="w-100  border link-acceso">LINK 1</a>
            		</div>
            		<div class="col-6 col-md-6 col-lg-3 d-flex mb-3">
            			<a href="#" class="w-100  border link-acceso">LINK 1</a>
            		</div>
            	</div>
            </section>
		</div>
	</div>
</div>


    

   
<?php include 'footer.php'; ?>

<script>
	$(function(){

		$('.abreMenu').click(function(e){
			e.preventDefault();
			$('.menu-detalle').collapse("hide");
			var id=$(this).data('id');
			$('#'+id).collapse("toggle");
			
		});
		
		var doc=$(document).outerWidth();
		
		var alto=$('#presentacion').height();
		var ancho=$('#presentacion').width();
		var alto2=$('#accesos').height();
		var anchobotones=$('#botones').width();
		//alert(altot);
		if(doc>'768'){
			var altot=(alto - 32);
			var altoboton=(altot / 3);
			var altoacceso=altoboton;
		}else{
			var altot=(alto - 16);
			var altoboton=(altot / 2);
			var altoacceso=(altoboton + altoboton + 16)
		}
		console.log('alto ventana '+doc);
		console.log('alto boton '+altoboton);
		//alert(altoboton);
		$('.menu-detalle').outerWidth(ancho);
		$('#botones .list-link').outerHeight(altoboton);
		$('#accesos .link-acceso').outerHeight(altoboton);
	});
</script>