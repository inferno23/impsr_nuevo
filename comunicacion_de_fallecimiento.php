<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<div class="container" id="tramites">
  <div class="where">
    <i class="fa fa-home"style= "letter-spacing: 2pt;"></i>
    <p>Inicio <i class="fa fa-angle-right"></i> Trámites <i class="fa fa-angle-right"></i> Comunicación por Fallecimiento</p>
  </div>
  <div class="titulo-pag">
    <p>Comunicación por Fallecimiento</p>
  </div>
	<div class="row">
		<div class="col-md-9 descripcion">
      		<p style="text-align: justify;">
        		El tramite se realiza para comunicar al Intituto el fallecimiento de un jubilado o pensionado con el fin que se deje de liquidar el haber y de esa manera evitar inconvenientes.
      		</p>
      		<ul class="nav nav-tabs" role="tablist">
			  	<li role="documentacion" class="nav-item active">
				    <a href="#documentacion" class="nav-link active" aria-controls="documentacion" role="tab" data-toggle="tab">
				    	<span><img src="img/ico_documentacion.png"></span>
				     	<span>Documentacion</span>
				    </a>
			  	</li>
				<li role="requisitos" class="nav-item active">
			    	<a href="#requisitos" class="nav-link" aria-controls="requisitos" role="tab" data-toggle="tab">
			      		<span><img src="img/ico_requisitos.png" width="41" height="41" alt="requisitos"></span>
			      		<span>Como hacer el tramite</span>
			      	</a>
			 	</li>			
			</ul>
  		<div class="tab-content">
  <!-- Requisitos -->
  <div role="tabpanel" class="tab-pane fade" id="requisitos">
  
     <div class="grey tab-content__item">
      <div class="numero"><span>1</span></div>
      <div><p>De manera online</p><ul><li>Para comunicar el fallecimiento de un beneficiario ingrese <a href="#" id="abrirModal">Aquí</a></li></br><li>Debe informar nombre y apellido del fallecido, fecha de fallecimiento y número de documento. A su vez, debe adjuntar una copia del acta de defunción, si la tuviera, caso contrario constancia de sala velatoria.</li></ul>
    </div>
	</div>
	
	  <div class="grey tab-content__item">
      <div class="numero"><span>2</span></div>
      <div><p>De manera presencial</p><ul><li>Si usted es familiar o conoce la situación de un beneficiario fallecido, puede declararlo presentándose en el Instituto Municipal de Previsión Social  de Rosario.</li></ul>
    </div>

     </div>  
  
      </div>
  <!-- Documentacion -->
  <div role="tabpanel" class="tab-pane active" id="documentacion">
    <div class="items">
              <div class="grey tab-content__item">
          <div class="numero"><span>1</span></div>
          <div><p>Al momento de declarar el fallecimiento de un beneficiario deberá informar:</p><ul><li>1 Número de D.N.I</li><li>2 Fecha de fallecimiento</li></ul></div>
        </div>
          </div>
  </div>
  <!-- Formularios -->
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

<!-- modal -->
<div class="modal" tabindex="-1" role="dialog" id="modalNot">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Formulario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="functions/guardar_notificacion.php" method="POST" enctype="multipart/form-data" id="uploadNotificacion" >
      <div class="modal-body">
      <div class="form-group">
                        	<label for="nombre">Nombre</label>
                        	<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre y Apellido del Denunciante" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="dni">DNI</label>
                        	<input type="text" class="form-control" name="dni" id="dni" placeholder="DNI del Denunciante" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="domicilio">Domicilio</label>
                        	<input type="text" class="form-control" name="domicilio" id="domicilio" placeholder="Calle y altura" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="pensionada">Nombre Beneficiario/a</label>
                        	<input type="text" class="form-control" name="pensionada" id="pensionada" placeholder="Nombre Fallecido/a" required>
                      	</div>
                      	<div class="form-row">
                      		<div class="form-group col-12 col-md-6">
                            	<label for="nro">Nro</label>
                            	<input type="text" class="form-control" name="nro" id="nro" placeholder="Nro Beneficiario/a" required>
                          	</div>
                          	<div class="form-group col-12 col-md-6">
                            	<label for="fecha">Fecha Fallecimiento</label>
                            	<input type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha Fallecimiento" required>
                          	</div>
                      	</div>
       					<div class="form-group">
                            <label for="archivo">Adjuntar Certificado Fallecimiento</label>
                            <input type="file" class="form-control-file" name="archivo" id="archivo" required>
                            <small id="emailHelp" class="form-text text-muted">Debe scanear o sacar una foto del certificado para adjuntar en el formulario antes de enviarlo</small>
                        </div>
                        <p id="aviso" class="alert" role="alert"></p>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn-enviar" class="btn btn-primary btn-block btn-lg">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	$('#abrirModal').click(function(e){
		e.preventDefault();
		$('#modalNot').modal({
			  keyboard: false
		});
	});
	$('#uploadNotificacion').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$('#btn-enviar').prop('disabled',true);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				$('#btn-enviar').prop('disabled',false);
				if (data.success){
					
					$('#aviso').html('Formulario Enviado, gracias');
					$('#aviso').addClass('alert-success');
					$('#aviso').removeClass('alert-danger');
					$("#uploadNotificacion")[0].reset();
					setTimeout(cerrar(),10000);
				}
				else{
					console.log(data.error);
					$('#aviso').html('Error al subir formulario. contactese con la asistencia');
					$('#aviso').addClass('alert-danger');
					$('#aviso').removeClass('alert-success');
					$('#aviso').show(0).delay(5000).hide(0);
					
				}
			}  
		});			
	});
	function cerrar(){
		$('#modalNot').modal('hide');
		alert('Formulario Enviado, Gracias');
		$('#aviso').html('');
		}
});
</script>

       					
                        
       				