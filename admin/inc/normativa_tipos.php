<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
    $query_rol = "SELECT a.* FROM normativa_tipo a  ";

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
	//nuevo usuario
	$('#formLegislacion').submit(function(e){
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
					$('#modalLegislacion').modal('hide');
					$("#formLegislacion")[0].reset();
					$('#centro').load('inc/normativa_tipos.php');
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
	$('.nuevo').click(function(e){
		e.preventDefault();
		$('#archivo').html('');
		$("#formLegislacion")[0].reset();	
		$('#modalLegislacion').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
		$('#id').val('');
	});
    //editar
	$('.editar').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		var tabla='normativa_tipo';
		$.getJSON( "inc/carga_item.php", { id: id,tabla:tabla } )
	    .done(function( json ) {
			$('#id').val(id);
			$('#tipo').val(json.item.tipo);
			$('#modal-titulo').html('Editar Tema');
			$('#modalLegislacion').modal({
			    backdrop: 'static',
			    keyboard: false 
			});
	    });
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

</style>
<div class="row mb-2">
	<div class="col-6">
		<h6>Lista de Tipos Normativa</h6>
	</div>
	<div class="col-6">
		<div class="pull-right noprint btn-group">
        	<button type="button" class="btn btn-sm btn-outline-info nuevo" title="Nuevo Permiso" ><i class="fa fa-plus-square " aria-hidden="true"></i></button>
        </div>
	</div>
    
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Id</th>
        	    	<th>Tipo</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $roles->fetch_assoc()) {
        		?>
        		<tr>
        			<td><?php echo $row_hc["id"];?></td>
        			<td><?php echo $row_hc["tipo"];?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="normativa_tipo" data-url="inc/normativa_tipos.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
		</table>
	</div>	
</div>

<!-- Modal Nuevo/editar -->
	<div class="modal fade" id="modalLegislacion" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_normativa_tipo.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formLegislacion" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal-titulo">Nuevo Tipo</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id">
	      </div>
	      <div class="modal-body">
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Tipo</span>
                    </div>	
            		<input class="form-control" type="text" name="tipo" id="tipo"  />
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