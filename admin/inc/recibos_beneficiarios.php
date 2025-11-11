<?php
?>
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

.btn-outline-success {
  color: #006699;
  border-color: #99ccee;
}

.btn-outline-success:hover {
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

#remResultados, #bkResultados, #bkResultadosu, #bkResultadosc {
  color: #003366;
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
    						<h5 class="card-title">Ingrese nro beneficiario</h5>
    						<div class="input-group">
    							<div class="input-group-prepend">
    								<span class="input-group-text">Nro</span>
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
			<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header">Subir Recibos</div>
						<form class="form" id="upBulk" method="post" action="inc/upload_bulkb.php" enctype="multipart/form-data">
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
				<div class="col-12" id="bkResultados"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header">Subir últimos recibos</div>
						<form class="form" id="upBulku" method="post" action="inc/upload_bulk_u.php" enctype="multipart/form-data">
						<div class="card-body">							
							<h5 class="card-title">Subir últimos recibos por cantidad</h5>
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
				<div class="col-12" id="bkResultadosu"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header">Subir carnets</div>
						<form class="form" id="upBulkc" method="post" action="inc/upload_bulk_carnet.php" enctype="multipart/form-data">
						<div class="card-body">							
							<h5 class="card-title">Subir carnets por cantidad</h5>
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
				<div class="col-12" id="bkResultadosc"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="row">
				<div class="col-12">
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
										<input type="hidden" name="remTipo" value="0">
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
			<div class="row">
				<div class="col-12" style="font-size:12px;" id="remResultados"></div>
			</div>
		</div>
			<div class="col-6">
			<div class="row">
				<div class="col-12">
					<div class="card w-100">
						<div class="card-header">Subir Recibos de Reajustes</div>
						<form class="form" id="upBulkAjuste" method="post" action="inc/upload_bulkb.php" enctype="multipart/form-data">
						<div class="card-body">							
							<h5 class="card-title">Subir recibos de<br> reajustes por cantidad</h5>
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
				<div class="col-12" id="bkResultadosAjuste"></div>
			</div>
		</div>
	</div>
		
</div>

<script>
$(function() {
	$('#recBuscar').click(function(e){
		e.preventDefault();
		var leg=$('#recLegajo').val();
		$.post('inc/buscar_recibos.php',{cod:leg},function(data){
			if (data.success){
				$('#recLista').html(data.listas);
			}else{
				$('#recLegajo').focus();
			}
		},'json');
		
		
	});
	//
	
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
    	$('#upBulkAjuste').submit(function(e){
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
        			    	$('#bkResultadosAjuste').append('<p>'+item+'</p>');
        			    });
        			    
        			    $('#upBulkAjuste')[0].reset();
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
    //
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