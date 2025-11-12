<style>
<!--
.novedades_principal a:hover{
    text-decoration: none;
} 
.novedades a:hover{
    text-decoration: none;
}
.novedades_principal{
    display: block;
    position: relative;

}
.novedades_principal .novedades_seccion{
    text-transform: uppercase;
    font-size: 12px;
    color: #ffffff;
    font-weight: 500;
    position: absolute;
    background: #1E619A;
    top: 20px;
    padding: 4px 20px 4px 15px;
    z-index: 20;
    }
.novedades_principal .contenido {
    position: absolute;
    padding: 0 15px;
    width: 100%;
    display: block;
    vertical-align: top;
    z-index: 20;
    bottom: 10px;
    color: #ffffff;
    z-index: 20;
    }   
.novedades_principal .titulo{
    font-size: 30px;
    font-weight: 600;
    line-height: 30px;
    padding-top: 5px;
    margin-bottom: .5rem;
}     

.novedades_imagen img{
    width: 100%;
    width: 100%;
    display: block;
    vertical-align: top;

}
.novedades_principal .novedades_imagen .mascara {
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
.novedades .novedades_seccion {
    font-size: .6797rem;
    padding: .3rem 2rem;
    margin-bottom: 2%;
    text-transform: uppercase;
    display: inline-block;
    vertical-align: top;
    background-color: #1E619A;
    color: #FFF !important;
}
.novedades time {
    font-size: .875rem;
    margin-bottom: 2px;
    font-weight: 500;
    color: #666666;
    padding-left: 20px;
}
.novedades .novedades_titulo{
    color:  #1E619A;
}
.novedades .novedades_bajada{
    color: #212529;
}
-->
</style>
<article class="mt-3">
			      
			<div class="row">
			<?php 
			include_once 'functions/connect.php';
			global $con;
			$nov=mysqli_query($con, "SELECT a.*,b.nombre nomseccion FROM novedades a LEFT JOIN novedades_secciones b ON a.seccion=b.id WHERE a.activo='1' ORDER BY `a`.`principal` DESC , a.fecha DESC");
			while ($row=mysqli_fetch_assoc($nov)) { 
			    if ($row['principal']=='1'){
			?>
			 				
				<div class="col-lg-8 mb-1">
					<article class="border">
			        	<div class="novedades_principal">

							  <div class="novedades_seccion"><?php echo $row['nomseccion']?></div>
							  <div class="novedades_imagen" style="position: relative;">
							  	<img class="imagen" alt="<?php echo $row['titulo']?>" src="<?php echo $row['imagen'];?>">
							  	<div class="mascara"></div>
							  </div>
							  <a href="noticia.php?id=<?php echo $row['id']?>" class="contenido">
							    <div class="fecha"><?php echo $row['fecha']?></div>
							    <div class="titulo"><?php echo $row['titulo'];?></div>
							    <div class="bajada"><p><?php echo $row['subtitulo'];?></p></div>
							  </a>
							</div>
					</article>
				</div>
			<?php 
			}else{ ?>
			    <div class="col-lg-4 mb-1">
					<article class="border">
			        	<div class="novedades">
							<a href="noticia.php?id=<?php echo $row['id']?>">
								<div class="novedades_imagen">
									<span class="rollover" ></span>
									<img src="<?php echo $row['imagen'];?>">
								</div>
								<span class="novedades_seccion"><?php echo $row['nomseccion']?></span>
								<time pubdate="pubdate"><?php echo $row['fecha']?></time>
								<h4 class="novedades_titulo"><?php echo $row['titulo'];?></h4>
								<div class="novedades_bajada"><p><?php echo $row['subtitulo'];?></p>
								</div>
							</a>
						</div>
					</article>
				</div>
			<?php }
			}
			?>	
				
				
				
			</div>
		</article>