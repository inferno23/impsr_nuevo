<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Poderes</p>
  </div>
  <div class="titulo-pag">
    <p>PODERES</p>
  </div>
  <div class="row">
    <div class="col-md-9 descripcion">
      <p style="text-align: justify;">
        Se podrán realizar dos tipos de poderes en caso de que el titular no pueda asistir presencialmente a nuestras oficinas, o que lo represente un profesional, deberá completar e imprimir el siguiente formulario, que se presentará por la Mesa de Entradas de nuestro Instituto, previa certificación de firmas por autoridad competente.
      </p>
      <p style="text-align: justify;">
        Unicamente pueden certificar funcionarios del I.M.S.R, poder judicial, juez de paz, escribano y autoridades con enlaces.
      </p>
      			<ul class="nav nav-tabs" role="tablist">
			  							<li role="documentacion" class="nav-item active">
				    <a href="#documentacion" class="nav-link active" aria-controls="documentacion" role="tab" data-toggle="tab">
				    	<span><img src="img/ico_documentacion.png"></span>
				     	<span>Información</span>
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
          <div><p>REPRESENTACIÓN PERMANENTE DEL BENEFICIARIO: Para que en su nombre y representación realice trámites pertinentes a su beneficio previsional y perciba, hasta nueva orden, sus haberes, reajustes, asignaciones familiares y aguinaldos, devengados o/a devengarse por el sistema de pago que disponga el Instituto y firme los recibos y demás documentos que fuera menester, relevado al precitado Instituto, de las consecuencias de los actos de su apoderado.</p></div>
        </div>
              <div class="grey tab-content__item">
          <div class="numero"><span>2</span></div>
          <div><p>TRÁMITES EXCLUSIVAMENTE: Para que en su nombre y representación realice trámites en este Instituto relacionados con el beneficio previsional, y sus derivaciones, hasta que el titular lo revoque por medio de telegrama o carta documento. El presente no permite percibir haberes, ni reajustes.</p></div>
        </div>
          </div>
  </div>
  <!-- Formularios -->
  <div role="tabpanel" class="tab-pane fade" id="formularios">
    <ul class="lista-form">
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