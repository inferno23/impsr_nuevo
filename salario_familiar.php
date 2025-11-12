<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<style type="text/css">
/* Estilo básico para la lista no ordenada */
ul {
    list-style-type: disc; /* Estilo de viñeta por defecto */
    padding-left: 20px; /* Espaciado desde el borde izquierdo */
}

/* Personalización de la viñeta */
ul.custom-bullets {
    list-style-type: none; /* Quitar viñetas predeterminadas */
}

ul.custom-bullets li {
    position: relative;
    padding-left: 20px; /* Espaciado para la viñeta personalizada */
}

ul.custom-bullets li::before {
    content: '►'; /* Contenido de la viñeta personalizada */
    position: absolute;
    left: 0;
    color: #007BFF; /* Color de la viñeta */
}
</style>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Salario Familiar</p>
  </div>
  <div class="titulo-pag">
    <p>Salario Familiar</p>
  </div>
  <div class="row">
    <div class="col-md-9 descripcion">
      <p style="text-align: justify;">
        Encuentre aqui la información necesaria para llevar a cabo los pasos administrativos que le permitan acceder al Certificado de Escolaridad.
      </p>
      			<ul class="nav nav-tabs" role="tablist">
			  		<li role="documentacion" class="nav-item active">
				    <a href="#documentacion" class="nav-link active" aria-controls="documentacion" role="tab" data-toggle="tab">
				    	<span><img src="img/ico_documentacion.png"></span>
				     	<span>INSTRUCTIVO PARA COMPLETAR EL FORMULARIO</span>
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
          <div><p><b>Datos del beneficiario:</b></p><ul><li>Completar todos los datos solicitados: D.N.I apellido(s) y nombres(s), Nº Beneficiario/a, correo electrónico</li></div>
        </div>
        <div class="grey tab-content__item">
          <div class="numero"><span>2</span></div>
          <div><p><b>Datos del alumno:</b></p><ul><li>Completar todos los datos solicitados: CUIL, apellido(s) y nombres(s),fecha de nacimiento y teléfono</li></div>
        </div>
        <div class="grey tab-content__item">
          <div class="numero"><span>3</span></div>
          <div><p><b>Datos de escolaridad:</b></p><ul><li>Ciclo lectivo: indicar el año correspondiente al ciclo lectivo que se desea informar</li></div>
        </div>
          <div class="grey tab-content__item">
          <div class="numero"><span>4</span></div>
          <div><p><b>Qué tipo de certificado seleccionar</b>:</p>
            <ul  class="custom-bullets">
              <b>1- Escolar:</b>
              <li><p>Si el alumno concurre a nivel inicial / Jardín, Primaria, Secundaria</p>
              </li>
              <li>Si se indica nivel Primaria se debe completar el campo <b>Grado</b>
              </li>
              <li> Si se indica nivel Secundaria se debe completar el campo <b>Año</b>
              </li>
              
              <b>2- Formación/Superior:</b>
              <li><p>Si el alumno concurre a terciario / universitario</p>
              </li >
               <!-- <b>3- Especial:</b>
                <li> <p>Si el alumno concurre a rehabilitación, maestro</p>
              </li>
            </ul>-->
        </div>
        </div>
          </div>
          <div class="grey tab-content__item">
          <div class="numero"><span>5</span></div>
          <div><p><b>Datos de la escuela/Instituto/Universidad/Escuela diferencial:</b>
          <p> <ul><li>
          Debe completarse solo si se indicó en tipo de certificado: Escolar, Formación/Superior o Escolar diferencial</p></li>
          <li>Los datos de este apartado deberán ser completados en su totalidad por el Director o responsable del establecimiento al que asiste el alumno</li></ul></div>
        </div>
  </div>
  <!-- Formularios -->
  <div role="tabpanel" class="tab-pane fade" id="formularios">
    <ul class="lista-form">
            <li>
        <i class="fa fa-file-pdf-o" style="color: grey"></i>
        <a target="_blank" href="https://impsr.gob.ar/escolaridad.php">Formulario F0005: Certificado de Escolaridad</a>
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