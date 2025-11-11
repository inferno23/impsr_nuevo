<style>
    .card {
  border: 1px solid #cce0f5;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 51, 102, 0.05);
  font-family: 'Segoe UI', sans-serif;
  background-color: #ffffff;
}

.card-header {
  background-color: #003366;
  color: white;
  font-weight: bold;
  font-size: 1rem;
  border-bottom: 1px solid #002244;
  border-radius: 10px 10px 0 0;
}

.card-title {
  color: #003366;
  font-size: 1.1rem;
  margin-bottom: 15px;
}

.input-group-text {
  background-color: #e6f0fa;
  color: #003366;
  border: 1px solid #b3d1f2;
  font-weight: 500;
}

.form-control {
  border: 1px solid #cce0f5;
  border-radius: 5px;
  font-size: 0.95rem;
}

.btn-outline-success,
.btn-outline-primary {
  color: #006699;
  border-color: #99ccee;
}

.btn-outline-success:hover,
.btn-outline-primary:hover {
  background-color: #006699;
  color: white;
  border-color: #006699;
}

.btn-block {
  border-radius: 6px;
  font-weight: 600;
}

hr {
  border-top: 1px solid #cce0f5;
}

.custom-control-label {
  color: #003366;
  font-weight: 500;
  font-size: 0.9rem;
}

.list-group-item {
  background-color: #f7fbff;
  border: 1px solid #cce0f5;
  color: #003366;
}

#recLista,
#bkResultados,
#bkResultadosu,
#bkResultadosc,
#remResultados {
  color: #003366;
  font-size: 0.9rem;
  padding-top: 10px;
}

</style>
<div class="container">
	<div class="row">
		<div class="col-6" >
			<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header">Ver recibos</div>
						<div class="card-body">
    						<h5 class="card-title">Ingrese nro legajo</h5>
    						<div class="input-group">
    							<div class="input-group-prepend">
    								<span class="input-group-text">Legajo</span>
    							</div>
    							<input class="form-control" id="recLegajo" type="text">
    							<div class="input-group-append">
    								<button class="btn btn-outline-success" type="button" id="recBuscar">Buscar</button>
    							</div>
    						</div>
    						<hr>
    						<div class="row">
    							<div class="list-group w-100" id="recLista">
                                  
                                </div>
    						</div>    						
    					</div>
					</div>
					
					
					
				</div>
			</div>
			
		</div>
		<div class="col-6">
		  		<div class="card w-100">
						<div class="card-header">Subir recibo</div>
						<form class="form" id="upBulk" method="post" action="inc/upload_bulk.php" enctype="multipart/form-data">
						<div class="card-body">							
							<h5 class="card-title">Subir recibos por cantidad</h5>
							<div class="row mb-3">
								<div class="col-12">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Seleccione archivos</div>
										</div>
										<input type="file" required class="form-control" multiple accept="application/pdf" name="bkArchivo[]">
									</div>
								</div>
							</div>
							
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-block btn-outline-success">Guardar</button>
						</div>
						</form>
					</div>
				</div>
	</div>
	<div class="row">
			
				    <div class="col-6">
					 <div class="card w-100">
						<div class="card-header">Nuevo recibo</div>
						<form class="form" id="upForm" method="post" action="inc/upload_recibo.php" enctype="multipart/form-data">
						<div class="card-body">							
							<h5 class="card-title">Buscar legajo</h5>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">LEGAJO</span>
								</div>
								<input type="text" class="form-control" required id="upLegajo" name="upLegajo">
								<input type="hidden" name="upId" id="upId">
								<div class="input-group-append">
									<button type="button" class="btn  btn-outline-primary" id="upBuscar">Buscar</button>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-12">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Nombre</div>
										</div>
										<input type="text" disabled class="form-control" name="upNombre" id="upNombre">
									</div>
								</div>
							</div>
							<div class="row mb-3">	
								<div class="col-6">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">DNI</div>
										</div>
										<input type="text" disabled class="form-control" name="upDni" id="upDni">
									</div>
								</div>
								<div class="col-6">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">CUIL</div>
										</div>
										<input type="text" disabled class="form-control" name="upCuil" id="upCuil">
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-12">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Seleccione archivo</div>
										</div>
										<input type="file" required class="form-control" accept="application/pdf" name="upArchivo" id="resArchivo">
									</div>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Período</div>
										</div>
										<input type="month" required class="form-control" name="upPeriodo" id="upPeriodo">
									</div>
								</div>
							</div>	
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-block btn-outline-success">Guardar</button>
						</div>
						</form>
					</div>
	</div>
		
				<div class="col-6">
					<div class="card w-100">
						<div class="card-header">Eliminar período</div>
						<form class="form" id="remForm" method="post" action="inc/remove_recibo.php" enctype="multipart/form-data">
						<div class="card-body">							
							<h5 class="card-title">Seleccione período</h5>
							<div class="row mb-3">
								<div class="col-8">
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">Período</div>
										</div>
										<input type="month" required class="form-control" name="remPeriodo" >
										<input type="hidden" name="remTipo" value="1">
									</div>
								</div>
								<div class="col-4">
									<div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input" id="aguinaldo" name="aguinaldo">
                                      <label class="custom-control-label" for="aguinaldo">Aguinaldo</label>
                                    </div>
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

			<div class="row">
				<div class="col-12" style="font-size:12px;" id="remResultados"></div>
			</div>
		</div>
		</div>
	</div>
		

			<div class="row">
				<div class="col-12" id="bkResultados"></div>
			</div>
		</div>
				<div class="row">
				<div class="col-12" id="bkResultadosu"></div>
			</div>
		</div>
			<div class="row">
				<div class="col-12" id="bkResultadosc"></div>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
	$('#upBuscar').click(function(e){
		e.preventDefault();
		var leg=$('#upLegajo').val();
		$.post('inc/buscar_legajo.php',{leg:leg},function(data){
			if (data.success){
				$('#upNombre').val(data.nombre);
				$('#upDni').val(data.dni);
				$('#upId').val(data.id);
				$('#upCuil').val(data.cuil);
			}else{
				$('#upNombre').val('');
				$('#upDni').val('');
				$('#upCuil').val('');
				$('#upId').val('');
				$('#upLegajo').focus();
			}
		},'json');
	});
	//
	$('#recBuscar').click(function(e){
		e.preventDefault();
		var leg=$('#recLegajo').val();
		$.post('inc/buscar_legajo.php',{leg:leg},function(data){
			if (data.success){
				var cod=data.id;
				$.post('inc/buscar_recibos.php',{cod:cod},function(data){
					if (data.success){
						$('#recLista').html(data.listas);
					}else{
						$('#recLegajo').focus();
					}
				},'json');
			}else{
				$('#upLegajo').focus();
			}
		},'json');
		
	});
	//
	$('#upForm').submit(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea guardar el recibo?")) 
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
        			    alert('Recibo Guardado');
        			    $('#upForm')[0].reset();
        			}else{
        				alert('Error '+data.error);	
        			}
    			}          
    		});
    	}
    				
    });
	$('#upBulk').submit(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea subir los recibos?")) 
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
        			    alert('Recibos Guardado');
        			    $.each(data.res, function(i, item) {
        			    	$('#bkResultados').append('<p>'+item+'</p>');
        			    });
        			    
        			    $('#upBulk')[0].reset();
        			}else{
        				alert('Error '+data.error);	
        			}
    			}          
    		});
    	}
    				
    });
	$('#upBulku').submit(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea subir los ultimos recibos?")) 
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
        			    alert('Recibos Guardado');
        			    $.each(data.res, function(i, item) {
        			    	$('#bkResultadosu').append('<p>'+item+'</p>');
        			    });
        			    
        			    $('#upBulku')[0].reset();
        			}else{
        				alert('Error '+data.error);	
        			}
    			}          
    		});
    	}
    				
    });
	$('#upBulkc').submit(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea subir los carnets?")) 
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
        			    alert('Carnets Guardado');
        			    $.each(data.res, function(i, item) {
        			    	$('#bkResultadosc').append('<p>'+item+'</p>');
        			    });
        			    
        			    $('#upBulkc')[0].reset();
        			}else{
        				alert('Error '+data.error);	
        			}
    			}          
    		});
    	}
    				
    });
	$('#remForm').submit(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea eliminar los recibos?")) 
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
        			    alert('Recibos Eliminados');
        			    $('#remForm')[0].reset();
        			    $('#remResultados').html(data.res);
        			}else{
        				alert('Error '+data.error);	
        			}
    			}          
    		});
    	}
    				
    });
});

</script>