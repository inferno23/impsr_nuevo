<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
    $query_rol = "SELECT l.*,le.estado,lt.tipo FROM licitaciones l LEFT JOIN licitaciones_tipos lt ON l.id_tipo=lt.id LEFT JOIN licitaciones_estados le ON l.id_estado=le.id ";

$roles = $conectar->query($query_rol);

$tipos=$conectar->query("SELECT * FROM licitaciones_tipos");
$estados=$conectar->query("SELECT * FROM licitaciones_estados");
$repar=$conectar->query("SELECT * FROM licitaciones_reparticiones");

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
					$('#modalNovedad').modal('hide');
					$("#formNovedad")[0].reset();
					$('#centro').load('inc/lista_licitaciones.php');
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
		var id= $(this).data('target');
		$("#formNovedad")[0].reset();	
		$('#modalNovedad').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
		$('#id').val('');
	});
    //editar
	$('.editar').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.getJSON( "inc/carga_licitacion.php", { id: id } )
	    .done(function( json ) {
			$('#id').val(id);
			$('#titulo').val(json.data.titulo);
			$('#codigo').val(json.data.codigo);
			$('#codigo_mes').val(json.data.codigo_mes);
			$('#codigo_ano').val(json.data.codigo_ano);
			$('#expediente').val(json.data.expediente);
			$('#apertura').val(json.data.apertura);
			$('#presupuesto').val(json.data.presupuesto);
			$('#pliego').val(json.data.costo_pliego);
			$('#oferta').val(json.data.costo_oferta);
			$('#impugnacion').val(json.data.costo_impugnacion);
			$('#desc').val(json.data.descripcion);
			$('#fecha').val(json.data.fecha);
			$('#tipo'+json.data.id_tipo).prop( "selected", true );
			$('#est'+json.data.id_estado).prop( "selected", true );
			$('#rep'+json.data.id_reparticion).prop( "selected", true );
			$('#archivos').empty();
			for (i=0;i<json.cantar;i++){
				var idl=json.archivos[i].id;
				var archivo=json.archivos[i].archivo;
				$( "#archivos" ).append( "<div class=\"thumbParent\" id=\"ar"+idl+"\"><a targe=\"_blank\" href=\"../"+archivo+"\">"+archivo+"</a><button type=\"button\" class=\"btn btn-sm borrarA\" data-padre=\"ar"+idl+"\" data-db=\"licitaciones_archivos\" data-id=\""+idl+"\"><i class=\"fa fa-trash\"></i></button></div> " );
			
			}
			if (json.data.activo==1){ $('#activo').prop( "checked", true ); }else{$('#activo').prop( "checked", false );};
			$('#modal-titulo').html('Editar Novedad');
			$('#modalNovedad').modal({
			    backdrop: 'static',
			    keyboard: false 
			});
	    });
	});	
	//carga imagenes
    $("#carga-imagen").on('change', function (event) {
    		var tmppath = URL.createObjectURL(event.target.files[0]);
    		$('#imagen-cargada').attr('src',tmppath);
    });
    //		
});
</script>
<style>
/* === Tipografía general === */

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
		<h6>Lista de Licitaciones</h6>
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
    	<table  class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Fecha</th>
        	  		<th>Nro</th>
        	  		<th>Tipo</th>
        	  		<th>Estado</th>
        	    	<th>Titulo</th>
        	    	<th>Archivos</th>
        	    	<th>Activo</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $roles->fetch_assoc()) {
        			$id=$row_hc['id'];
$mes=str_pad($row_hc['codigo_mes'], 2, '0', STR_PAD_LEFT);
        			$ar=$conectar->query("SELECT * FROM licitaciones_archivos WHERE id_licitacion='$id'");
        		?>
        		<tr>
        		    <td><?php echo $row_hc["fecha"];?></td>
				<td><?php echo $mes.'/'.$row_hc['codigo_ano'];?></td>
        			<td><?php echo $row_hc["tipo"];?></td>
        			<td><?php echo $row_hc["estado"];?></td>
        			<td><?php echo $row_hc["titulo"];?></td>
        			
        			<td>
        			<?php while ($row=$ar->fetch_assoc()) {
        			    echo '<a href="../'.$row['archivo'].'">'.$row['archivo'].'</a><br>';
        			} ?>
        			</td>
        			<td><?php echo check($row_hc["activo"]);?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="licitaciones" data-url="inc/lista_licitaciones.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
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
	      <form action="inc/guardar_licitacion.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formNovedad" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal-titulo">Nueva Licitacion</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id">
	      </div>
	      <div class="modal-body">
	        <div class="form-group row">	
            	<div class="input-group col-4">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Fecha</span>
                    </div>	
            		<input class="form-control" type="date" name="fecha" id="fecha"  />
            	</div>
            	<div class="input-group col-5">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Fecha Apertura</span>
                    </div>	
            		<input class="form-control" type="datetime-local" name="apertura" id="apertura"  />
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
	      		<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Nro. Contratacion</span>
                    </div>	
            		<input class="form-control" type="text" name="codigo" id="codigo"  placeholder="XX/XXXX" />
            	</div>
            	<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Expediente.</span>
                    </div>	
            		<input class="form-control" type="text" name="expediente" id="expediente"  placeholder="XX/XXXX" />
            	</div>
            </div>
		<div class="form-group row">
	      		<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Año. Contratacion</span>
                    </div>	
            		<input class="form-control" type="text" name="codigo_ano" id="codigo_ano"  placeholder="XXXX" />
            	</div>
            	<div class="input-group col-6">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Mes Contratacion</span>
                    </div>	
            		<input class="form-control" type="text" name="codigo_mes" id="codigo_mes"  placeholder="XX" />
            	</div>
            </div>
            
	      	<div class="form-group row">
	      		<div class="input-group col-4">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Tipo</span>
                    </div>	
            		<select class="form-control" name="tipo">
            			<option value="0" id="tipo0">--Seleccioné</option>
            			<?php while ($rowt=$tipos->fetch_assoc()) {?>
            			<option value="<?php echo $rowt['id']; ?>" id="tipo<?php echo $rowt['id']?>"><?php echo $rowt['tipo']?></option>    
            			<?php }?>
            		</select>
            	</div>
            	<div class="input-group col-4">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Estado</span>
                    </div>	
            		<select class="form-control" name="estado">
            			<option value="0" id="estado0">--Seleccioné</option>
            			<?php while ($rowe=$estados->fetch_assoc()) {?>
            			<option value="<?php echo $rowe['id']; ?>" id="est<?php echo $rowe['id']?>"><?php echo $rowe['estado']?></option>    
            			<?php }?>
            		</select>
            	</div>
	      		<div class="input-group col-4">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Reparticion</span>
                    </div>	
            		<select class="form-control" name="reparticion">
            			<option value="0" id="rep0">--Seleccioné</option>
            			<?php while ($rowr=$repar->fetch_assoc()) {?>
            			<option value="<?php echo $rowr['id']; ?>" id="rep<?php echo $rowr['id']?>"><?php echo $rowr['reparticion']?></option>    
            			<?php }?>
            		</select>
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-7">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Titulo</span>
                    </div>	
            		<input class="form-control" type="text" name="titulo" id="titulo"  />
            	</div>
	      		<div class="input-group col-5">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Presupuesto</span>
                    </div>	
            		<input class="form-control" type="number" step="any" min="0" value="0" name="presupuesto" id="presupuesto"  />
            	</div>
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-4">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Costo Pliego</span>
                    </div>	
            		<input class="form-control" type="number" step="any" min="0" value="0" name="pliego" id="pliego"  />
            	</div>
            	<div class="input-group col-4">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Garantia Oferta</span>
                    </div>	
            		<input class="form-control" type="number" step="any" min="0" value="0" name="oferta" id="oferta"  />
            	</div>
            	<div class="input-group col-4">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Costo Impug.</span>
                    </div>	
            		<input class="form-control" type="number" step="any" min="0" value="0" name="impugnacion" id="impugnacion"  />
            	</div>
	      		
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Descripcion</span>
                    </div>	
            		<textarea class="form-control" rows="2"  name="desc" id="desc" ></textarea>
            	</div>
	      		
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Archivos</span>
                    </div>	
            		<input type="file" multiple class="form-control" name="archivos[]"  >
            	</div>
	      		
	      	</div>
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div id="archivos"></div>
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