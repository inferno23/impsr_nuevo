<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Reconocimiento de Servicios</p>
  </div>
  <div class="titulo-pag">
    <p>Reconocimiento de Servicios</p>
  </div>
  <div class="row">
    <div class="col-md-9 descripcion">
      <p style="text-align: justify;">
        El Reconocimiento de Servicios es un trámite que se realiza para que el I.M.P.S.R. reconozca años de servicios aportados en la órbita de la Municipalidad de Rosario o demás instituciones aportantes, a los fines de solicitar un beneficio previsional en otra institución integrante del Sistema de Reciprocidad Jubilatoria enunciado en el decreto/ley 9316/46, o para hacer valer la antigüedad en otros organismos.
      </p> 
      			<ul class="nav nav-tabs" role="tablist">
			  							<li role="documentacion" class="nav-item active">
				    <a href="#documentacion" class="nav-link active" aria-controls="documentacion" role="tab" data-toggle="tab">
				    	<span><img src="img/ico_documentacion.png"></span>
				     	<span>Documentacion</span>
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
  <div role="tabpanel" class="tab-pane fade" id="requisitos">
      </div>
  <!-- Documentacion -->
  <div role="tabpanel" class="tab-pane active" id="documentacion">
    <div class="items">
              <div class="grey tab-content__item">
          <div class="numero"><span>1</span></div>
          <div><p>Documento de Identidad y fotocopia del mismo.</p></div>
        </div>
              <div class="grey tab-content__item">
          <div class="numero"><span>2</span></div>
          <div><p>Foja de Servicios y Plancha Técnica de cómputos. (Solicitar en Dir. Gral. de Personal - 4º piso del Correo Argentino: Córdoba 741)</p></div>
        </div>
          </div>
  </div>
  <!-- Formularios -->
  <div role="tabpanel" class="tab-pane fade" id="formularios">
    <ul class="lista-form">
            <li>
        <i class="fa fa-file-pdf-o" style="color: grey"></i>
        <a target="_blank" href="https://impsr.gob.ar//formulario_servicio.php">Formulario F0004: Solicitud de Reconocimiento de Servicio</a> 
      </li>
      <li>
      <i class="fa fa-file-pdf-o" style="color: grey"></i>
        	<a target="_blank" href="https://impsr.gob.ar/formulario_poder.php">Formulario F0003: Poder</a> 
          </li>
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