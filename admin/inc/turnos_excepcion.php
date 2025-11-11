 <?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';	
global $conectar;

if ($_SESSION['imps']['admin']=='1'){
    $query_usu = "SELECT a.*,b.nombre seccion,c.etiqueta motivo FROM turnos a LEFT JOIN turnos_secciones b ON a.id_seccion=b.id LEFT JOIN turnos_subsecciones c ON a.id_subseccion=c.id WHERE a.excepcion='1' ORDER BY id ASC";
    $secciones=$conectar->query("SELECT * FROM turnos_secciones");
}else{
    $sec=$_SESSION['imps']['seccion'];
    $query_usu = "SELECT a.*,b.nombre seccion,c.etiqueta motivo FROM turnos a LEFT JOIN turnos_secciones b ON a.id_seccion=b.id LEFT JOIN turnos_subsecciones c ON a.id_subseccion=c.id WHERE a.excepcion='1' AND a.id_seccion='$sec'";
    $secciones=$conectar->query("SELECT * FROM turnos_secciones WHERE id='$sec'");
}

$usuarios = $conectar->query($query_usu);
//echo $conectar->error.$query_usu;
function fecha($fecha){
    if ($fecha=='0000-00-00'){
        return ' ';
    }else {
        return strftime("%d/%m/%Y",strtotime($fecha));
    }
}
?>
<script>
$(function() {
	$('#tablausuarios').DataTable( {
		responsive: true,
        "language": {
            "url": "inc/esp.json"
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
    });
	
	//nuevo
	$('.nuevo').click(function(e){
		e.preventDefault();
		$("#formTurno")[0].reset();	
		$('#modalTurno').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
	});

	//
	var seccion=$('#seccion').val();
	getHorarios(getFecha(),seccion,0);
	getMotivo(seccion,0);
	$('#fecha').change(function(e){
		e.preventDefault();
		var fecha=$(this).val();
		var seccion=$('#seccion').val();
		getHorarios(fecha,seccion,0);
	});
	$('#seccion').change(function(e){
		e.preventDefault();
		var fecha=$('#fecha').val();
		var seccion=$(this).val();
		getHorarios(fecha,seccion,0);
		getMotivo(seccion,0);
	});
	//
	$(document).on('click','.acciones',function(e){
		e.preventDefault();
		$('.acciones').removeClass('activo');
		$(this).addClass('activo');
		var hora=$(this).data('hora');
		console.log(hora);
		$('#hora').val(hora);
	});
	//
	$('#modalTurno').on('hidden.bs.modal', function (e) {
		$('#centro').load('inc/turnos_excepcion.php');
    })
	
	$('#formTurno').submit(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea guardar el turno?")) 
			{	return false; }
		else { 
    		var txt=$('.btn-submit').html();
    		$('.btn-submit').prop('disabled',true);
    		$('.btn-submit').html('<i class="fa fa-spinner fa-pulse"></i>');
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
    					$('#aviso').html('turno solicitado y confirmado');
    					$('#aviso').addClass('alert-success');
    					$('#aviso').removeClass('alert-danger');
    					$('#aviso').show(0).delay(5000).hide(0);
    					$("#formTurno")[0].reset();
    					var seccion=$('#seccion').val();
    					getHorarios(getFecha(),seccion,0);
    					getMotivo(seccion,0);
    				}
    				else{
    					console.log(data.error);
    					$('#aviso').html('Error al solicitar el turno. intente de nuevo');
    					$('#aviso').addClass('alert-danger');
    					$('#aviso').removeClass('alert-success');
    					$('#aviso').show(0).delay(5000).hide(0);
    					
    				}
    				$('.btn-submit').prop('disabled',false);
    				$('.btn-submit').html(txt);
    			}  
    		});
		}				
	});
	//editar
	$('.editar').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		console.log(id);
		$.post( "inc/carga_turno.php", { id: id },function(json){
			if(json.success){
				$('#id').val(id);
				$('#nombre').val(json.data.nombre);
				$('#dni').val(json.data.dni);
				$('#telefono').val(json.data.telefono);
				$('#correo').val(json.data.email);
				$('#obs').val(json.data.observaciones);
				$('#sec'+json.data.id_seccion).prop( "selected", true );
				$('#'+json.data.tipo).prop( "selected", true );
				var str = json.data.hora;
				var res = str.split(":");
				var hora =res[0]+':'+res[1];
				
				getHorarios(json.data.fecha,json.data.id_seccion,hora);
				getMotivo(json.data.id_seccion,json.data.id_subseccion);
				$('#fecha').val(json.data.fecha);
				$('#modal-titulo').html('Editar Turno');
				$('#modalTurno').modal({
				    backdrop: 'static',
				    keyboard: false 
				});
			}
		},'json');
	});	
	//
	$('.unexcepcion').click(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de pasar a prestamos de excepcion el turno?")) 
		{	return false; }
    	else { 
    		var id=$(this).data('id');
    		var valor=1;
    		$.post('inc/excepcion_turno.php',{id:id,valor:valor},function(data){
    			if(data.success){
    				$('#centro').load('inc/lista_turnos.php');
    				//$(this).html('<btn type="button" class="btn btn-link btn-sm unverificar" data-id="'+id+'"><i class="fas fa-check-square"></i></btn>');
    			}
    		},'json');
    	}
	});
	//
	$('.verificar').click(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de verificar el turno?")) 
		{	return false; }
		else { 
    		var id=$(this).data('id');
    		var valor=1;
    		$.post('inc/verificar_turno.php',{id:id,valor:valor},function(data){
    			if(data.success){
    				$('#centro').load('inc/turnos_excepcion.php');
    				console.log('verificar');
    				$(this).removeClass('verificar');
    				$(this).addClass('unverificar');
    				$(this).find('i').addClass('fa-square');
    				$(this).find('i').removeClass('fa-check-square');
    				//$(this).html('<btn type="button" class="btn btn-link btn-sm unverificar" data-id="'+id+'"><i class="fas fa-check-square"></i></btn>');
    			}
    		},'json');
		}
	});
	$('.unverificar').click(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea marcar como NO verificado el turno?")) 
		{	return false; }
    	else { 
    		var id=$(this).data('id');
    		var valor=0;
    		$.post('inc/verificar_turno.php',{id:id,valor:valor},function(data){
    			if(data.success){
    				$('#centro').load('inc/turnos_excepcion.php');
    				console.log('unverificar');
    				$(this).removeClass('unverificar');
    				$(this).addClass('verificar');
    				$(this).find('i').addClass('fa-check-square');
    				$(this).find('i').removeClass('fa-square');
    				//$(this).html('<btn type="button" class="btn btn-link btn-sm verificar" data-id="'+id+'"><i class="far fa-square"></i></btn>');
    			}
    		},'json');
    	}
	});
	//
	$('.obs').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		var texto=$(this).data('texto');
		var obs=prompt('Ingrese Observacion ',texto);
		if(obs){
			$.post('inc/obs_turno.php',{id:id,texto:obs},function(data){
				if(data.success){
					$('#centro').load('inc/turnos_excepcion.php');
				}
			},'json');
		}
	});
});
function getHorarios(fecha,seccion,sel){
	
	$.post('inc/get_libres.php',{fecha:fecha,seccion:seccion,sel:sel},function(data){
		if(data.success){
			$('#hora').html(data.turnos);
		}
	},'json');
}
function getMotivo(seccion,sel){
	
	$.post('inc/get_sub.php',{seccion:seccion,sel:sel},function(data){
		if(data.success){
			$('#motivo').html(data.opciones);
			$("#motivo").change();
		}
	},'json');
}
function getFecha(){
	var date = new Date()

	var day = date.getDate()
	var month = date.getMonth() + 1
	var year = date.getFullYear()

	if(month < 10){
	  return year+'-0'+month+'-'+day;
	}else{
	  return year+'-'+month+'-'+day;
	}

}
//
</script>
<style>
.list-group-item{
    margin-bottom: 1px;
    padding: .50rem 1.25rem;
    cursor: pointer;
}
.disabled{
    border: 1px solid #007bff;
    cursor: not-allowed;
}
.activo{
    border: 2px solid #007bff;
        background-color: #e9ecef;
}
#tablausuarios{
    font-size: 0.9em;
}
</style>
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
/* === Tipografía general === */

  body {
    font-family: 'Roboto', sans-serif;
  }

  h6, .modal-title {
    color: #ffffff;
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
  #tablausuarios {
    border: 1px solid #dee2e6 !important;
    border-radius: 6px;
    background-color: #ffffff;
  }

  #tablausuarios thead {
    background-color: #003366;
    color: white;
  }

  #tablausuarios tbody tr:hover {
    background-color: #e8f1fc;
  }

  #tablausuarios td, #tablausuarios th {
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


.list-group-item{
    margin-bottom: 1px;
    padding: .50rem 1.25rem;
    cursor: pointer;
}
.disabled{
    border: 1px solid #007bff;
    cursor: not-allowed;
}
.activo{
    border: 2px solid #007bff;
        background-color: #e9ecef;
}

.hidden{
    display: none;
}
#tablausuarios{
    font-size: 0.9em;
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
 /* distancia en los inputs dentro del modal */
  .form-group {
  margin-bottom: 1.5rem; 
  }
</style>
<!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-gavel me-2"></i>
                Gestión de Turnos
            </a>
          
        </div>
    </nav>

<div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Prestamos de Excepcion
                    </h5>
                   
                </div>
            </div>
</div>

<div class="row">
	<div class="col-12">
    	<table class="table table-hover table-bordered table-sm display compact nowrap " id="tablausuarios">
        	<thead class="thead-dark">
        	  	<tr>
        			<th>Fecha</th>
        			<th>Hora</th>
        			<?php if ($_SESSION['imps']['admin']=='1'){ ?>
        			<th>Seccion/Motivo</th>	    
        			<?php }else{ ?>
        			<th>Motivo</th>    
        			<?php } ?>
        			<th>Tipo</th>
        	    	<th>Nombre</th>
        	    	<th>DNI</th>
        	    	<th>Telefono</th>
        	    	<th>Email</th>
        	    	<th>Recibo</th>
        	    	<th>Conf.</th>
        	    	<th>Obs.</th>
        	    	<th>Verif.</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $usuarios->fetch_assoc()) {
        			
        		?>
        		<tr>
        			<td><span style="display:none;"><?php echo $row_hc['fecha']?></span><?php echo fecha($row_hc['fecha']);?></td>
        			<td><?php echo $row_hc['hora']?></td>
        			<?php if ($_SESSION['imps']['admin']=='1'){ ?>
        			<td><?php echo $row_hc["seccion"].'/'.$row_hc["motivo"];?></td>
        			<?php }else{ ?>
        			<td><?php echo $row_hc["motivo"];?></td>
        			<?php } ?>
        			<td><?php echo $row_hc['tipo']; ?></td>
        			<td><?php echo $row_hc['nombre']; ?></td>
        			<td><?php echo $row_hc['dni']; ?></td>
        			<td><?php echo $row_hc['telefono']; ?></td>
        			<td><?php echo $row_hc['email']; ?></td>
        			<td><?php if (!empty($row_hc['recibo'])) { ?>
        			    <a href="<?php echo 'archivos/'.$row_hc['recibo'];?>" download="recibo <?php echo $row_hc['dni']?>"><i class="fas fa-download"></i></a>
        				<?php }?>
        			</td>
        			<td><?php echo check($row_hc['confirmado']);?></td>
        			<td style="width:min-content;"><?php if(!empty($row_hc['observaciones'])){echo '<span class="btn btn-sm btn-link" title="'.$row_hc['observaciones'].'" ><i class="fas fa-info-circle"></i></span>';}?><button type="button" title="" class="btn btn-link btn-sm obs" data-texto="<?php echo $row_hc['observaciones']; ?>" data-id="<?php echo $row_hc['id']; ?>"><i class="fas fa-pencil-alt"></i></button></td>
        			<td><?php if ($row_hc['verificado']=='1'){echo '<btn type="button" class="btn btn-link btn-sm unverificar" data-id="'.$row_hc['id'].'"><i class="fas fa-check-square"></i></btn>'; }else{echo '<btn type="button" class="btn btn-link btn-sm verificar" data-id="'.$row_hc['id'].'"><i class="far fa-square"></i></btn>';}?></td>
        			<td class="noprint btn-group btn-sm-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="turnos" data-url="inc/turnos_excepcion.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
    	</table>
	</div>
</div>

<!-- Modal CSV -->
	<div class="modal fade" id="modalTurno" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_turno.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formTurno" >
	      <div class="modal-header">
	        <h5 class="modal-title" id="modal-titulo">Nuevo Turno</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id">
	      </div>
	      <div class="modal-body">
	      	<div class="row">
        		<div class="col-6">
       					<div class="form-group">
                        	<label for="nombre">Nombre</label>
                        	<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre y Apellido" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="dni">DNI</label>
                        	<input type="text" class="form-control" name="dni" id="dni" placeholder="DNI del solicitante" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="dni">Telefono</label>
                        	<input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Telefono del solicitante" required >
                      	</div>
                      	<div class="form-group">
                        	<label for="correo">Correo</label>
                        	<input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo" >
                      	</div>
                      	
                      	<div class="form-group">
                      		<label for="obs">Observaciones</label>
                      		<textarea rows="2" id="obs" name="obs" class="form-control"></textarea>
                      	</div>
                </div>
                <div class="col-6">
                	<div class="form-group">
                      		<label for="seccion">Seccion</label>
                      		<select name="seccion" class="custom-select" id="seccion">
                      		<?php while($row=$secciones->fetch_assoc()){?>
                      			<option id="sec<?php echo $row['id']?>" value="<?php echo $row['id'];?>" ><?php echo $row['nombre'];?></option>
                      		<?php }?>
                      		</select>
                      	</div>
                      	<div class="form-group">
                      		<label for="tipo">Condicion (<small>Si corresponde</small>)</label>
                      		<select name="tipo" class="custom-select" id="tipo">
                      			<option id="Activo" value="Activo">Activo</option>
                      			<option id="Jubilado" value="Jubilado">Jubilado</option>
                      			<option id="Pensionado" value="Pensionado">Pensionado</option>
                      		</select>
                      	</div>
                      	<div class="form-group">
                      		<label for="motivo">Motivo</label>
                      		<select name="motivo" class="custom-select" id="motivo">
                      		</select>
                      	</div>
                	<div class="form-group">
                    	<label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d')?>" required>
                    </div>
                    <div class="form-group">
                    	<label for="motivo">Horario :</label>
                      	<select name="hora" class="custom-select" id="hora">
                    	</select>
                    </div>
                    <p id="aviso" class="alert" role="alert"></p>
                </div>
            </div>
            	
		  </div>
		  <div class="modal-footer">
		  	<button type="submit" class="btn btn-primary btn-submit">Guardar Turno</button>
		  	<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
		  </div>
	      </form>
	    </div>
	  </div>
	</div>