
<div class="container">
	<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header">Bloquear Fechas para renovacion de credito(las fechas bloqueadas no estaran disponibles para renovacion</div>
						<form class="form" id="remForm" method="post" action="inc/bloqueo_dia.php" enctype="multipart/form-data">
						<div class="card-body">							
							<h5 class="card-title">Seleccione día para bloquear</h5>
							<div class="row mb-3">
								<div class="col-12">
									<div class="input-group">
									
											<div class="input-group-text">Seleccione día</div>
											<input type="date" required class="form-control" name="fecha" >
									
									</div>
								</div>
								</div>
							
						<div class="card-footer">
							<button type="submit" class="btn btn-block btn-outline-success">Procesar</button>
						</div>
						</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#remForm').submit(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea bloquear esta fecha?")) 
			{	return false; }
		else { 
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
        			    alert('Fecha bloqueada correctamente para renovación de creditos');

        			}else{
        				alert('Error '+data.error);	
        			}
    			}          
    		});
    	}
    				
    });

</script>