<?php include 'head.php'; ?>
<?php include 'header.php'; ?>

    
    <!-- Page Content -->
   
<div class="container" id="contacto">
        <div class="where">
        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> contacto</p>
      </div>
      <div class="titulo-pag">
        <p>Contacto</p>
      </div>
      <div class="row">
       <div class="col-md-6">
              <form action="functions/enviar.php" id="formContacto" method="post">
                        <div class="card  rounded-0">
                            <div class="card-header p-0">
                                <div class=" text-center py-2">
                                    <h3><i class="fa fa-envelope"></i> Consultas, reclamos y denuncias</h3>
                                </div>
                            </div>
                            <div class="card-body p-3">

                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user"></i></div>
											
                                        </div>
										
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="nombre" name="email" placeholder="ejemplo@gmail.com" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment"></i></div>
                                        </div>
                                        <textarea name="mensaje" class="form-control" placeholder="Envianos tu Mensaje" required></textarea>
                                    </div>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6LeXVGwaAAAAAO0wnvfmCaV4QaekFoW5-se9_eOr"></div>
                                      <br/>
                                <div class="text-center">
                                    <button type="submit" id="btnenviar" class="btn btn-enviar btn-block rounded-0 py-2">Enviar</button> 
									                       
                       
                                </div>
                                <div id="aviso" class="mt-2 alert"></div>
                            </div>

                        </div>
                    </form>
      </div>
    

    <div class="col-md-6">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.2446186466846!2d-60.63925468463889!3d-32.94455047911252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b7ab18f662f581%3A0x99ea501319767d6!2sInstituto+Municipal+de+Previsi%C3%B3n+Social+de+Rosario!5e0!3m2!1ses!2sar!4v1563965222737!5m2!1ses!2sar" width="100%" height="450" frameborder="0" style="border:3px" allowfullscreen></iframe>
	</div>
</div></div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
	$('#formContacto').submit(function(e){
		e.preventDefault();
		$('#btnenviar').prop('disabled',true);
		$('#btnenviar').html('<i class="fa fa-spin fa-circle-o-notch" aria-hidden="true"></i>');
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			cache: false,
			dataType: "json",
			processData: false,
			success: function(data){
				if (data.success){
					$('#aviso').show('slow');
                	$('#aviso').removeClass('alert-warning');
                	$('#aviso').addClass('alert-success');
                	$('#aviso').html('Mensaje Enviado, Gracias');
                	$('#aviso').delay(3000).fadeOut('slow');
                	$('#formContacto')[0].reset();
                	$('#btnenviar').prop('disabled',false);
                	$('#btnenviar').html('Enviar');
				    	
				}else{
					$('#aviso').show('slow');
                	$('#aviso').removeClass('alert-success');
					$('#aviso').addClass('alert-warning');
					$('#aviso').html(data.mensaje);	
					$('#aviso').delay(3000).fadeOut('slow');
					$('#btnenviar').prop('disabled',false);
                	$('#btnenviar').html('Enviar');
				}
			}          
		});
	});
</script>
   
<?php include 'footer.php'; ?>