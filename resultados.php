<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php 
include 'functions/connect.php';

global $con;
$q=$_GET['q'];
$resultado=mysqli_query($con,"SELECT * FROM `buscador` WHERE `titulo` LIKE '%$q%' OR descripcion LIKE '%$q%'");


?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"></i>
    <p><a href="index.html">Inicio</a> <i class="fa fa-angle-right"></i> Busqueda </p>
  </div>
  <div class="titulo-pag">
    <p style="font-size: 2.5rem;">Resultados : "<?php echo $q;?>"</p>
  </div>
  <div class="row">		
    <div class="col-md-9 descripcion">
    	<div class="row">
    		<div class="col-12">
    			<div class="list-group">
    			<?php if ($resultado->num_rows>0) {
            	    while ($row=mysqli_fetch_assoc($resultado)) {
            	    echo '<a href="'.$row['url'].'" class="list-group-item list-group-item-action list-group-item-light mb-1">'.$row['titulo'].'</a>';
            	    }
            	}else {?>
            		<a href="#" class="list-group-item list-group-item-action disabled">Sin Resultados</a>
            	<?php }?>	    	  
                </div>
    		</div>
    	</div>	
    </div>
    <div class="col-md-3 side-tramites">
      <?php include_once 'side-tramites_jubilacion.html'; ?>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
