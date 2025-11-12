<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"></i><p>Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Iapos
  </div>
  <div class="titulo-pag">
    <p>Iapos</p>
  </div>
  <div class="row">
    <div class="col-md-9 descripcion">
      <p>
        Venta de materiales exlusivos para jubilados y pensionados(Ordenes de Consulta, Bonos Asistenciales,Ordenes de Internación,Recetarios de medicamentos).
      </p>
    <ul class="nav nav-tabs" role="tablist">
		<li role="requisitos" class="nav-item active">
			<a href="#requisitos" class="nav-link active" aria-controls="requisitos" role="tab" data-toggle="tab">
				<span><img src="img/ico_requisitos.png" width="41" height="41" alt="Requisitos"></span>
				<span>Requisitos</span> 						
			</a>
		</li>
		<li role="formularios" class="nav-item">
			<a href="#formularios" class="nav-link" aria-controls="formularios" role="tab" data-toggle="tab">
		    	<span><img src="img/ico_formularios.png" width="41" height="41" alt="Formularios"></span>
		      	<span>Formularios</span>
		    </a>
		</li>
	</ul>
    <div class="tab-content">
      <!-- Requisitos -->
      <div role="tabpanel" class="tab-pane active" id="requisitos">
      		<div class="col-12">
      			<h3 class="h3">Afiliaciones</h3>
              	<div class="list-group">
                  	<a href="afiliacion_titular.php" class="list-group-item list-group-item-action">Para Titulares</a>
            		<a href="afiliacion_familiar.php" class="list-group-item list-group-item-action">Familiares a cargo del Titular</a>
                </div>	
      		</div>
      </div>
      
      <!-- Formularios -->
      <div role="tabpanel" class="tab-pane fade" id="formularios">
        <ul class="lista-form">
    		<li><i class="fa fa-file-pdf-o" style="color: grey"></i><a target="_blank" href="./formularios/F-0007 Ficha de afiliacion.pdf">Formulario F0007: Ficha de afiliaciones.</a>
        </ul>
      </div>
    </div>
    </div>
    <div class="col-md-3 side-tramites">
      <?php include_once 'side-tramites_jubilacion.html'; ?>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
