<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Cobro de haberes en el exterior</p>
  </div>
  <div class="titulo-pag">
    <p>Cobro de Haberes en el Exterior</p>
  </div>
  <div class="row">
    <div class="col-md-9 descripcion">
      <p style="text-align: justify;">
        Encuentre aqui la información necesaria para llevar a cabo los pasos administrativos que le permitan acceder al traspaso de sus haberes jubilatorios a cuentas bancarias de países fuera de la Argentina.
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
          <div><p>Para solicitar que se transfieran los fondos, los beneficiarios deberán completar el formulario de Residentes en el exterior, presentarlo por Mesa de Entrada o enviarlo por correo electrónico a mesadeentradas@impsr.gob.ar.</p></div>
        </div>
              <div class="grey tab-content__item">
          <div class="numero"><span>2</span></div>
          <div><p>Los datos que deben informar son:</p><ul><li>1- Nombre y Apellido</li><li>2- Documento de Identidad</li><li>3- Número de cuenta en el exterior</li><li>4- Dirección completa del Banco en el exterior</li><li>5- Número de SWIFT del Banco en el exterior</li><li>6- Moneda de la cuenta informada en el exteior</li><li>7- Número IBAN para residentes de la Comunidad Europea</li></ul></div>
        </div>
          </div>
  </div>
  <!-- Formularios -->
  <div role="tabpanel" class="tab-pane fade" id="formularios">
    <ul class="lista-form">
            <li>
        <i class="fa fa-file-pdf-o" style="color: grey"></i>
        <a target="_blank" href="form_cobro_ext.php">Formulario F0006: Cobros en el exterior</a>
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