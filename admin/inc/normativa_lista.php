<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
$query_rol = "SELECT n.*,nt.tema,nti.tipo FROM `normativa` n LEFT JOIN normativa_tema nt ON n.id_tema=nt.id LEFT JOIN normativa_tipo nti ON n.id_tipo=nti.id ";
$normas = $conectar->query($query_rol);
$temas=$conectar->query("SELECT * FROM normativa_tema");
$tipos=$conectar->query("SELECT * FROM normativa_tipo");
echo $conectar->error;
?>
<style>
    #lista-rel{
        display:flex;
        flex-direction:column;
        gap:6px;
    }
    .rel-item{
        display: flex;
        flex-direction: row;
        padding: 0.5rem;
        gap: 0px;
        flex-wrap: wrap;
        border:1px solid #999;
        
    }
    .rel-item select{
        width: 50%;
        border-radius:6px;
        padding:0.5rem 1rem;
        border: 1px solid #999;
        border-bottom: 0;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        border-right: 0;
        border-top-right-radius: 0;
    }
    .rel-item input{
        width: 50%;
        border-radius:6px;
        padding:0.5rem 1rem;
        border: 1px solid #999;
        border-bottom: 0;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        border-top-left-radius: 0;
    }
    .rel-item textarea{
        width: 100%;
        border-radius:6px;
        padding:0.5rem 1rem;
        border: 1px solid #999;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        
    }
</style>

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
  /* distancia en los inputs dentro del modal */
  .form-group {
  margin-bottom: 1.5rem; 
}

</style>
<script>
$(function() {
	$('#tablaroles').DataTable({
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
					$('#centro').load('inc/normativa_lista.php');
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
		$('#formLegislacion')[0].reset();
		$('#id').val('');
		$('#modal-titulo').text('Nueva Normativa');
		const modal = new bootstrap.Modal(document.getElementById('modalLegislacion'));
		modal.show();
	});
    //editar
		$('.editar').click(function(e){
			e.preventDefault();
			var id=$(this).data('id');
			var tabla='normativa';


			
			$.getJSON( "inc/carga_item.php", { id: id,tabla:tabla } )
			.done(function( json ) {
				//console.log('Datos recibidos de carga_item:', json);
				$('#id').val(id);
				$('#asunto').val(json.item.asunto);
				$('#nro').val(json.item.nro);
				$('#ano').val(json.item.ano);
				$("select[name='tema']").val(json.item.id_tema);
				$("select[name='tipo']").val(json.item.id_tipo);
				$('#sancion').val(json.item.sancion);
				$('#promulgacion').val(json.item.promulgacion);
				if(json.item.estado==1){
					$('#vigente').prop( "checked", true );
					$('#derogada').prop( "checked", false );
				}else{
					$('#vigente').prop( "checked", false );
					$('#derogada').prop( "checked", true );
				}
				$('#compete').val(json.item.compete);
				$('#firmantes').val(json.item.firmantes);
				$('#boletin').val(json.item.boletin);
				$('#actualizado').val(json.item.actualizado);
				$('#asociadas').val(json.item.asociadas);
				$('#imagenold').val(json.item.imagen);
				$('#modal-titulo').html('Editar Norma');
				const modal = new bootstrap.Modal(document.getElementById('modalLegislacion'), {
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
	//		
});
</script>
<!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-list me-2"></i>
                Gestión de Normativa
            </a>
          
        </div>
    </nav>
<div class="row mb-2">
	
	<div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Lista de Normativa
                    </h5>
                    <button type="button" class="btn btn-success btn-sm nuevo" title="Nueva Normativa">
                        <i class="fas fa-plus me-1"></i>Nueva Normativa
                    </button>
                </div>
            </div>
    
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Tema</th>
        	    	<th>Tipo</th>
        	    	<th>Nro</th>
        	    	<th>Ano</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $normas->fetch_assoc()) {
        		?>
        		<tr>
        			<td><?php echo $row_hc["tema"];?></td>
        			<td><?php echo $row_hc["tipo"];?></td>
        			<td><?php echo $row_hc["nro"];?></td>
        			<td><?php echo $row_hc["ano"];?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="normativa" data-url="inc/normativa_lista.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
		</table>
	</div>	
</div>
<datalist id="normas">
<?php 
$normas->data_seek(0);
while ($rown=$normas->fetch_assoc()) { ?>
    <option value="<?php echo $rown['id']; ?>"><?php echo $rown['tipo'].' '.$rown['nro'].'/'.$rown['ano']; ?></option>
<?php } ?>
</datalist>
<!-- Modal Nuevo/editar -->
	<div class="modal fade" id="modalLegislacion" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_normativa.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formLegislacion" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal-titulo">Nueva Norma</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id">
	      </div>
	      <div class="modal-body">
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Tema</span>
                    </div>	
            		<select name="tema" class="form-control">
            		<?php while ($row=$temas->fetch_assoc()) {?>
            		    <option value="<?php echo $row['id']?>" id="tema-<?php echo $row['id'];?>"><?php echo $row['tema'];?></option>
            		<?php }?>
            		</select>
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Tipo</span>
                    </div>	
            		<select name="tipo" class="form-control" required>
            		<?php while ($row=$tipos->fetch_assoc()) {?>
            		    <option value="<?php echo $row['id']?>" id="tipo-<?php echo $row['id'];?>"><?php echo $row['tipo'];?></option>
            		<?php }?>
            		</select>
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Asunto</span>
                    </div>	
            		<input type="text" class="form-control" name="asunto" id="asunto">
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Nro</span>
                    </div>	
            		<input type="text" class="form-control" name="nro" id="nro" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            	</div>
            	<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Año</span>
                    </div>	
            		<input type="text" class="form-control" name="ano" id="ano" maxlength="4" placeholder="aaaa" onkeypress="return event.charCode >= 48 && event.charCode <= 57" >
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Sancion</span>
                    </div>	
            		<input type="date" class="form-control" name="sancion" id="sancion">
            	</div>
            	<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Promulgacion</span>
                    </div>	
            		<input type="date" class="form-control" name="promulgacion" id="promulgacion">
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-6">
	      			<div class="input-group-prepend">
                    	<span class="input-group-text">Estado Vigencia</span>
                    </div>	
	      			<div class="form-check">
                      <input class="form-check-input" type="radio" name="estado" id="vigente" value="1" checked>
                      <label class="form-check-label" for="vigente">
                        Vigente
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="estado" id="derogada" value="0">
                      <label class="form-check-label" for="derogada">
                        Derogada
                      </label>
                    </div>
	      		</div>
	      	</div>	
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Compete a</span>
                    </div>	
            		<input type="text" class="form-control" name="compete" id="compete">
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Firmantes</span>
                    </div>	
            		<textarea class="form-control" name="firmantes" id="firmantes"></textarea>
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Boletin Oficial</span>
                    </div>	
            		<input type="text" class="form-control" name="boletin" id="boletin">
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Norma Escaneada</span>
                    </div>	
                    <input type="hidden" name="imagenold" id="imagenold" >
            		<input type="file"  class="form-control" name="imagen" >  
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">palabras clave</span>
                    </div>	
            		<textarea class="form-control" name="asociadas" id="asociadas"></textarea>
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Texto Actualizado</span>
                    </div>	
            		<textarea class="form-control" name="actualizado" id="actualizado"></textarea>
            	</div>
	      	</div>
	      	<div class="row d-none">
	      		<div class="col-12">
	      			<button class="btn btn-outline-primary" type="button" onclick="addItem()">Agregar relacionado</button>
	      		</div>
	      		
	      		<div class="col-12" id="lista-rel">
	      			<div class="rel-item">
	      				<select name="mode[]" class="item-tipo">
	      					<option value="Modificada por">Modificada por</option>
	      					<option value="Deroga a">Deroga a</option>
	      				</select>
	      				<input name="norma[]" list="normas" placeholder="Seleccione Norma" >
	      				<textarea name="obs[]" placeholder="Observaciones"></textarea>
	      			</div>
	      			
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
	<script>
		function addItem(){
			var div=document.getElementById('lista-rel');
			var item=document.createElement('div');
			item.classList.add('rel-item');
			var sel=document.createElement('select');
			sel.name="mode[]";
			sel.classList.add('item-tipo');
			let op1=document.createElement('option');
			op1.value="Modificada por";
			op1.innerHTML="Modificada por";
			let op2=document.createElement('option');
			op2.value="Deroga a";
			op2.innerHTML="Deroga a";
			sel.appendChild(op1);
			sel.appendChild(op2);
			var input=document.createElement('input');
			input.type="text";
			input.name="norma[]";
			input.setAttribute('list', 'normas');
			input.placeholder="Seleccione norma";
			var text=document.createElement('textarea');
			text.name="obs[]";
			text.placeholder="Observaciones";
			item.appendChild(sel);
			item.appendChild(input);
			item.appendChild(text);
			div.appendChild(item);
		}
	</script>