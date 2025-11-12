<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home" style= "letter-spacing: 2pt;" ></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Subsidio por fallecimiento</p>
  </div>
  <div class="titulo-pag">
    <p>Subsidio por fallecimiento</p>
  </div>
  <div class="row">
    <div class="col-md-9 descripcion">
      <p>
	  Se abonará a los derecho habientes del afiliado fallecido una suma fija, previa presentación de los comprobantes legales correspondientes.
      
      </p>
      			<ul class="nav nav-tabs" role="tablist">
							<li role="requisitos" class="nav-item active">
			    	<a href="#requisitos" class="nav-link active" aria-controls="requisitos" role="tab" data-toggle="tab">
			      		<span><img src="img/ico_requisitos.png" width="41" height="41" alt="Requisitos"></span>
			      		<span>Requisitos</span>
			      	</a>
			 	</li>
  			  
		  	  			</ul>
  		<div class="tab-content">
  <!-- Requisitos -->
  <div role="tabpanel" class="tab-pane active" id="requisitos">
        <div class="grey tab-content__item">
      <div class="numero"><span>1</span></div>
      <p>Comunicarse telefónicamente al 425-6085 INT 114</p>
    </div>
      </div>
  <!-- Documentacion -->
  <div role="tabpanel" class="tab-pane fade" id="documentacion">
    <div class="items">
  
      </div>
  </div>  
    <!-- Formularios  -->
  <div role="tabpanel" class="tab-pane fade" id="formularios">
    <ul class="lista-form">
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