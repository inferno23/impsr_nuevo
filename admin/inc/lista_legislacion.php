<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
    $query_rol = "SELECT a.* FROM legislacion a   ";

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
	$(document).on('click', '.borrarA', function(e) {
		e.preventDefault();
		if (!confirm("Esta seguro de que desea eliminar el registro?")) 
			{	return false; }
		else { 
			var id= $(this).data('id');
			var db= $(this).data('db');
			var padre=$(this).data('padre');
			console.log(padre);
			$.post( "inc/borrar.php",{ id:id, db:db }, function( data ) {	        
				$('#'+padre).remove();
			});
		}	
    });
	//
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
					$('#centro').load('inc/lista_legislacion.php');
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
		$.getJSON( "inc/carga_legislacion.php", { id: id } )
	    .done(function( json ) {
			$('#id').val(id);
			$('#titulo').val(json.data.titulo);
			$('#archivoold').val(json.data.archivo);
			var archivo=json.data.archivo;
			$('#archivo').html('');
			$('#archivo').append( "<div class=\"thumbParent\" id=\"ar"+id+"\"><a targe=\"_blank\" href=\"../"+archivo+"\">"+archivo+"</a><button type=\"button\" class=\"btn btn-sm borrarA\" data-padre=\"ar"+id+"\" data-db=\"licitaciones_archivos\" data-id=\""+id+"\"><i class=\"fa fa-trash\"></i></button></div> " );
			$('#modal-titulo').html('Editar Legislacion');
			$('#modalLegislacion').modal({
			    backdrop: 'static',
			    keyboard: false 
			});
	    });
	});	
	//		
});
</script>
<div class="row mb-2">
	<div class="col-6">
		<h6>Lista de Roles</h6>
	</div>
	<div class="col-6">
		<div class="pull-right noprint btn-group">
        	<button type="button" class="btn btn-sm btn-outline-info nuevo" title="Nuevo Permiso" ><i class="fa fa-plus-square " aria-hidden="true"></i></button>
        	<button type="button" id="imprimir" class="btn btn-sm btn-outline-dark" title="Imprimir"><i class="fa fa-print " aria-hidden="true"></i></button>
        </div>
	</div>
    
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-hover table-bordered table-sm display compact nowrap" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Titulo</th>
        	    	<th>Archivos</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $roles->fetch_assoc()) {
        		?>
        		<tr>
        			<td><?php echo $row_hc["titulo"];?></td>
        			<td><?php echo $row_hc["archivo"];?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="legislacion" data-url="inc/lista_legislacion.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
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
	      <form action="inc/guardar_legislacion.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formLegislacion" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal-titulo">Nueva Legislacion</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id">
	      </div>
	      <div class="modal-body">
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Titulo</span>
                    </div>	
            		<input class="form-control" type="text" name="titulo" id="titulo"  />
            	</div>
	      		
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Archivos</span>
                    </div>	
            		<input type="file" class="form-control" name="archivo"  >
            		<input type="hidden" name="archivoold" id="archivoold">
            	</div>
	      		
	      	</div>
	      	<div class="row">
	      		<div class="col-12">
	      			<div id="archivo"></div>
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