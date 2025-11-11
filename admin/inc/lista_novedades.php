<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
    $query_rol = "SELECT a.*,b.nombre nomseccion FROM novedades a LEFT JOIN novedades_secciones b ON a.seccion=b.id  ";

$roles = $conectar->query($query_rol);

$secciones=$conectar->query("SELECT * FROM novedades_secciones");
echo $conectar->error;
?>
<script>
$(function() {
	// Inicializar DataTable
	$('#tablaroles').DataTable({
		responsive: true,
        "language": {
            "url": "inc/esp.json"
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    });

    // NUEVO
$(document).ready(function () {
  $('.nuevo').on('click', function (e) {
    e.preventDefault();
    console.log("Click detectado");

    // Resetear formulario
    $("#formNovedad")[0].reset();	
    $('#id').val('');

    // Abrir modal
    var modal = new bootstrap.Modal(document.getElementById('modalNovedad'), {
      backdrop: 'static',
      keyboard: false
    });
    modal.show();
  });
});


    // EDITAR
    $(document).on('click', '.editar', function(e) {
		e.preventDefault();
		var id = $(this).data('id');

		$.getJSON("inc/carga_novedad.php", { id: id })
	    .done(function(json) {
			$('#id').val(id);
			$('#titulo').val(json.data.titulo);
			$('#subtitulo').val(json.data.subtitulo);
			$('#fecha').val(json.data.fecha);
			$('#contenido').val(json.data.contenido);
			$('#link').val(json.data.link);
			$('#imagenold').val(json.data.imagen);
			$('#imagen-cargada').attr('src', '../' + json.data.imagen);
			$('select[name="seccion"]').val(json.data.seccion);

			$('#activo').prop("checked", json.data.activo == 1);
			$('#principal').prop("checked", json.data.principal == 1);

			$('#modal-titulo').text('Editar Novedad');

			const modalElement = document.getElementById('modalNovedad');
			const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
			modalInstance.show();
	    });
	});

    // SUBMIT FORM
	$('#formNovedad').submit(function(e){
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
					const modalElement = document.getElementById('modalNovedad');
					const modalInstance = bootstrap.Modal.getInstance(modalElement);
					modalInstance.hide();

					$("#formNovedad")[0].reset();
					$('#centro').load('inc/lista_novedades.php');
					$('#id').val('');
				}else{
					alert('Error ' + data.error);	
				}
			}          
		});			
    });

    // CAMBIO DE IMAGEN
    $("#carga-imagen").on('change', function (event) {
    	var tmppath = URL.createObjectURL(event.target.files[0]);
    	$('#imagen-cargada').attr('src', tmppath);
    });
});
</script>

<style>
/* === Tipograf��a general === */

  body {
    font-family: 'Roboto', sans-serif;
  }

  h6, .modal-title {
    color: #003366;
    font-weight: 600;
  }

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

<style>
<!--
/* controles imagen */
    .imagen{
        display: block;
        margin: 0 auto;
        min-width: 400px;
        height:300px;
        background-color: grey;
    }
    .imagen-div{
    	min-width: 400px;
    	margin: 0 auto;
    }
    .imagen-controles{
        position: absolute;
        top: 0;
        left: auto;
        bottom: auto;
        min-width: 400px;
        margin:0 auto;
        color: white;
        background-color: #007bff;
        opacity: 0;
        transition: opacity ease 400ms;
    }    
    .imagen-label{
    	margin:0px !important;
    }
    #imagen-cargada{
    	border: 1px solid #c2c2c2;
    }
    .imagen-controles:hover{
    	opacity:1;
    }
    .imagen-div:hover .imagen-controles{
    	opacity: 1;
    }
    .imagen-div img:hover .imagen-controles{
    	opacity: 1;
    }
    .imagen-controles .fa {
        margin: 5px;
        cursor: pointer;
    }
    .imagen-controles-ocultos{
    	display: none;
    }
    .imagen-controles-ocultos input[type="file"] {
        display: none;
    }
-->
</style>
<div class="row mb-2">
	<div class="col-6">
		<h6>Lista de Novedades</h6>
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
    	<table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Seccion</th>
        	  		<th>Fecha</th>
        	    	<th>Titulo</th>
        	    	<th>Subtitulo</th>
        	    	<th>Link</th>
        	    	<th>Principal</th>
        	    	<th>Activo</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $roles->fetch_assoc()) {
        			
        		?>
        		<tr>
        		    <td><?php echo $row_hc["nomseccion"];?></td>
        		    <td><?php echo $row_hc["fecha"];?></td>
        			<td><?php echo $row_hc["titulo"];?></td>
        			<td><?php echo $row_hc["subtitulo"];?></td>
        			<td><?php echo $row_hc["link"];?></td>
        			<td><?php echo check($row_hc["principal"]);?></td>
        			<td><?php echo check($row_hc["activo"]);?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="novedades" data-url="inc/lista_novedades.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
		</table>
	</div>	
</div>

<!-- Modal Nuevo/editar -->
	<div class="modal fade" id="modalNovedad" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_novedad.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formNovedad" >
	   <div class="modal-header d-flex justify-content-center position-relative">
  <h5 class="modal-title text-white">Editar Novedad</h5>
  <button type="button" class="close position-absolute end-0 me-2" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <input type="hidden" name="id" id="id">
</div>
	      <div class="modal-body">
	      	<div class="form-group new">
                <div class="col-12 ml-auto mr-auto">
                	<div class="imagen-div">
                		<img alt="imagen producto" src="img/placeholder.png" id="imagen-cargada" class="imagen" name="imagenold">
                		<div class="imagen-controles">
                			<label for="carga-imagen" class="imagen-label"><i class="fa fa-upload" aria-hidden="true"></i></label>
                		</div>
                		<div class="imagen-controles-ocultos">
                			<input type="file" id="carga-imagen" name="imagen" accept="image/*" >
                			<input type="hidden" id="imagenold" name="imagenold">
                		</div>
                	</div>
                </div>
            </div>
            <div class="form-group row">
            	<div class="input-group col-12">
            		<div class="input-group-prepend">
            			<span class="input-group-text">Sección</span>
            		</div>
            		<select name="seccion" class="form-control">
            			<?php while ($row=$secciones->fetch_assoc()) { ?>
            			<option id="sec<?php echo $row['id'];?>" value="<?php echo $row['id'];?>"><?php echo $row['nombre'];?></option>    
            			<?php }?>
            		</select>
            	</div>
            </div>
            <div class="form-group row">
	      		<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Fecha</span>
                    </div>	
            		<input class="form-control" type="date" name="fecha" id="fecha"  />
            	</div>
	      		<div class="input-group col-3 ml-auto">
                	<div class="input-group-prepend">
                    	<div class="input-group-text">
                    		<input checked type="checkbox" name="principal" id="principal" value="1">
                    	</div>
                    </div>
                    <div class="input-group-append">
                    	<span class="input-group-text">Principal</span>
                    </div>	
                </div>
	      		<div class="input-group col-3 ml-auto">
                	<div class="input-group-prepend">
                    	<div class="input-group-text">
                    		<input checked type="checkbox" name="activo" id="activo" value="1">
                    	</div>
                    </div>
                    <div class="input-group-append">
                    	<span class="input-group-text">Activo</span>
                    </div>	
                </div>
	      	</div>
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
                    	<span class="input-group-text">Subtitulo</span>
                    </div>	
            		<textarea class="form-control" rows="2"  name="subtitulo" id="subtitulo" ></textarea>
            	</div>
	      		
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Contenido</span>
                    </div>	
            		<textarea class="form-control" rows="4"  name="contenido" id="contenido" ></textarea>
            	</div>
	      		
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Link</span>
                    </div>	
            		<input class="form-control" type="url" name="link" id="link"  />
            	</div>
	      		
	      	</div>
		  </div>
		  <div class="modal-footer">
		   	<input name="guardar" type="submit" class="btn btn-primary" value="Guardar" />
		    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
		  </div>
	      </form>
	    </div>
	  </div>
	</div>