<?php include 'head.php'; ?>
<?php include 'header.php'; 
include 'functions/connect.php';
global $con;
$query="SELECT * FROM legislacion";
$res=mysqli_query($con, $query);
?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Legislación</p>
  </div>
  <div class="titulo-pag">
    <p>Legislación</p>
  </div>
  <div class="row">
    <div class="col-md-9 descripcion">
      <p style="text-align: justify;">
        En esta sección encontra toda la legislación Municipal vigente en material previsional.
      </p>
      	<div class="row">
      		<div class="col-12 col-sm-8">
      			<h3><i class="fa fa-file-text" aria-hidden="true"></i> Formularios</h3>
              	<div class="list-group mt-3">
                <?php while ($row=mysqli_fetch_assoc($res)) { ?>
                 <a href="<?php echo $row['archivo']?>" target="_blank" class="list-group-item list-group-item-action"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?php echo $row['titulo'];?></a>
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