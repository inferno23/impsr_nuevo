<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
    $query_rol = "SELECT a.* FROM fechas a   ";

$roles = $conectar->query($query_rol);

echo $conectar->error;
?>
<script>
$(function() {
	$('#tablaroles').DataTable( {
		responsive: true,
        "language": {
            "url": "inc/esp.json"
        },
        responsive: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
    });
	
	//
    //nuevo usuario
	$('#formFechas').submit(function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: data,
			contentType: false,
			dataType: "json",
			cache: false,
			processData: false,
			success: function(data){
				if (data.success){
					$('#modalFechas').modal('hide');
					$("#formFechas")[0].reset();
					$('#centro').load('inc/lista_fechas.php');
					$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();	
					$('#id').val('');
				}else{
					alert('Error '+data.error);	
				}
			    	
			}          
		});			
    });
	
	//nuevo
	$('.nuevo23').click(function(e){
		e.preventDefault();
		var id= $(this).data('target');
		$("#formFechas")[0].reset();	
		$('#modalFechas').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
		$('#id').val('');
	});
	//nuevo
	$('.nuevo').click(function(e){
		e.preventDefault();
		$('#formFechas')[0].reset();
		$('#id').val('');
		$('#modal-titulo').text('Nueva fecha de cobro');
		const modal = new bootstrap.Modal(document.getElementById('modalFechas'));
		modal.show();
	});
    //editar
		$('.editar').click(function(e){
			e.preventDefault();
			var id=$(this).data('id');
					
			$.getJSON( "inc/carga_fecha.php", { id: id} )
			.done(function( json ) {
				console.log('Datos recibidos de carga_item:', json);
				$('#id').val(id);
				$('#fechatexto').val(json.data.mensaje);
				$('#fechapago').val(json.data.fecha_pago);
				
				$('#fechames').val(json.data.nmes);
				if (json.data.activo==1){ $('#fechaactivo').prop( "checked", true ); }else{$('#fechaactivo').prop( "checked", false );};
				$('#modal-titulo').html('Editar Fecha');
				const modal = new bootstrap.Modal(document.getElementById('modalFechas'), {
					backdrop: 'static',
					keyboard: false
				});
				modal.show();
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				console.error('Error en carga_item.php:', textStatus, errorThrown);
				if (jqXHR.responseText) {
					console.error('Respuesta del servidor:', jqXHR.responseText);
				}
			});
		});    
    //editar
	$('.editar23').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.post("inc/carga_fecha.php",{id:id},function(json){
			if (json.success){
				$('#id').val(id);
				$('#fechatexto').val(json.data.mensaje);
				$('#fechapago').val(json.data.fecha_pago);
				
				$('#fechames').val(json.data.nmes);
				if (json.data.activo==1){ $('#fechaactivo').prop( "checked", true ); }else{$('#fechaactivo').prop( "checked", false );};
				$('#modal-titulo').html('Editar Fecha');
				const modal = new bootstrap.Modal(document.getElementById('modalFechas'), {
					backdrop: 'static',
					keyboard: false
				});
				modal.show();
			}
			
		},'json');
		
	});	
	
    //		
});
</script>
<style>
  body {
    font-family: 'Roboto', sans-serif;
  }

  h6, .modal-title {
    color: #003366;
    font-weight: 600;
  }


  .badge-status {
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
  /* Tabla */
  #tablaroles {
    border: 1px solid #dee2e6 !important;
    border-radius: 6px;
    background-color: #ffffff;
  }

  #tablaroles thead {
    background-color: #003366;
    color: white;
  }

  #tablaroles tbody tr:hover {
    background-color: #e8f1fc;
  }

  #tablaroles td, #tablaroles th {
    vertical-align: middle;
  }

  /* Botones */
  .btn-info {
    background-color: #0056b3;
    border-color: #0056b3;
    color: white;
  }

  .btn-success {
    background-color: #007b8a;
    border-color: #007b8a;
    color: white;
  }

  .btn-primary {
    background-color: #003366;
    border-color: #003366;
  }

  .btn-outline-dark {
    border-color: #003366;
    color: #003366;
  }

  .btn-outline-dark:hover {
    background-color: #003366;
    color: white;
  }

  /* Modal */
  .modal-content {
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .modal-header {
    background-color: #003366;
    color: white;
    border-bottom: none;
  }

  .modal-footer {
    border-top: none;
  }

  /* Inputs */
  .input-group-text {
    background-color: #e1ecf7;
    color: #003366;
    font-weight: 500;
  }

  .form-control {
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
  }

  .form-control:focus {
    border-color: #0056b3;
    box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
  }
  /* distancia en los inputs dentro del modal */
  .form-group {
  margin-bottom: 1.5rem; 

}

</style>

<!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-calendar me-2"></i>
                Gestión de Fechas
            </a>
          
        </div>
    </nav>
<div class="row mb-2">
	<div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Lista de Fechas de Cobro
                    </h5>
                    <button type="button" class="btn btn-success btn-sm nuevo" title="Nueva fecha de cobro">
                        <i class="fas fa-plus me-1"></i>Nueva Fecha de Cobro
                    </button>
                </div>
            </div>
    
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Mes</th>
        	    	<th>Fecha Pago</th>
        	    	<th>Texto</th>
        	    	<th>Activo</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $roles->fetch_assoc()) {
        		?>
        		<tr>
        		    <td><?php echo date('m-Y', strtotime($row_hc["mes"]));?></td>
        			<td><?php echo date('d-m-Y',strtotime($row_hc["fecha_pago"]));?></td>
        			<td><?php echo $row_hc["mensaje"];?></td>
        			<td>
                                    <?php if ($row_hc["activo"] == 1) { ?>
                                        <span class="badge badge-status badge-active">Activo</span>
                                    <?php } else { ?>
                                        <span class="badge badge-status badge-inactive">Inactivo</span>
                                    <?php } ?>
                                </td>
					
					<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="fechas" data-url="inc/lista_fechas.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
		</table>
	</div>	
</div>

<!-- Modal Nuevo/editar -->
	<div class="modal fade" id="modalFechas" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_fecha.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formFechas" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal-titulo">Nueva Fecha</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id">
	      </div>
	      <div class="modal-body">
	      	<div class="form-group row">
	      		
	      		<div class="input-group col-6 ml-auto">
                	<div class="input-group-prepend">
                    	<div class="input-group-text">
                    		<input checked type="checkbox" name="activo" id="fechaactivo" value="1">
                    	</div>
                    </div>
                    <div class="input-group-append">
                    	<span class="input-group-text">Activo</span>
                    </div>	
                </div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Mes</span>
                    </div>	
            		<input class="form-control" type="month" name="mes" id="fechames"  />
            	</div>
            	<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Fecha Pago</span>
                    </div>	
            		<input class="form-control" type="date" name="fecha" id="fechapago"  />
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Texto</span>
                    </div>	
            		<input class="form-control" type="text" name="texto" id="fechatexto"  />
            	</div>
	      		
	      	</div>
	      	
		  </div>
		  <div class="modal-footer">
		   	<input name="guardar" type="submit" class="btn btn-primary" value="Guardar" />
		    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
		  </div>
	      </form>
	    </div>
	  </div>
	</div>