<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';    
global $conectar;

// Verificación de la existencia de las claves en la sesión antes de usarlas
$fecha= date('Y-m-d', strtotime('-8 months'));
if (isset($_SESSION['imps']['admin']) && $_SESSION['imps']['admin'] == '1') {
    $query_usu = "SELECT a.*, b.nombre AS seccion, c.etiqueta AS motivo 
                  FROM turnos a 
                  LEFT JOIN turnos_secciones b ON a.id_seccion = b.id 
                  LEFT JOIN turnos_subsecciones c ON a.id_subseccion = c.id 
                  WHERE a.excepcion = '0' AND a.fecha >= '$fecha'
                  ORDER BY id ASC";
    $secciones = $conectar->query("SELECT * FROM turnos_secciones");
} else {
    $sec = $_SESSION['imps']['seccion'] ?? '';  // Evita errores si no está definida la clave
    if (!empty($sec)) {
        $query_usu = "SELECT a.*, b.nombre AS seccion, c.etiqueta AS motivo 
                      FROM turnos a 
                      LEFT JOIN turnos_secciones b ON a.id_seccion = b.id 
                      LEFT JOIN turnos_subsecciones c ON a.id_subseccion = c.id 
                      WHERE a.excepcion = '0' AND a.id_seccion = '$sec'  AND a.fecha >= '$fecha' ";
        $secciones = $conectar->query("SELECT * FROM turnos_secciones WHERE id = '$sec'");
    } else {
        // Si no existe la sección, manejar el caso adecuadamente
        $query_usu = "SELECT a.*, b.nombre AS seccion, c.etiqueta AS motivo 
                      FROM turnos a 
                      LEFT JOIN turnos_secciones b ON a.id_seccion = b.id 
                      LEFT JOIN turnos_subsecciones c ON a.id_subseccion = c.id 
                      WHERE a.excepcion = '0' AND a.fecha >= '$fecha'
                      ORDER BY id ASC ";
        $secciones = $conectar->query("SELECT * FROM turnos_secciones");
    }
}

//echo $query_usu;
$usuarios = $conectar->query($query_usu);
//echo $conectar->error.$query_usu;

// Actualización de la función fecha para usar DateTime::format()
function fecha($fecha){
    if ($fecha == '0000-00-00') {
        return ' ';
    } else {
        $date = new DateTime($fecha);
        return $date->format("d/m/Y");
    }
}
?>

<script>
$(function() {
	$('#tablausuarios').DataTable( {
		
        "language": {
            "url": "inc/esp.json"
        },
        responsive: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
    });
	//nuevo
	$('.nuevo').click(function(e){
		e.preventDefault();
		$('#formTurno')[0].reset();
		$('#id').val('');
		$('#modal-titulo').text('Nueva fecha de cobro');
			getMotivo(1,0);//seccion 1 creditos 
			getHorarios(getFecha(),1,0);

		const modal = new bootstrap.Modal(document.getElementById('modalTurno'));
		modal.show();
	});
	

	//
	var seccion=$('#seccion').val();
	getHorarios(getFecha(),seccion,0);
	getMotivo(seccion,0);
//	alert(seccion);
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
		$('#centro').load('inc/lista_turnos.php');
    })
    
	//editar
		$('.editar233').click(function(e){
			e.preventDefault();
			var id=$(this).data('id');
					
			$.getJSON( "inc/carga_turno.php", { id: id } )
			.done(function( json ) {
				//console.log('Datos recibidos de carga_item:', json);
				$('#id').val(id);
				$('#nombre').val(json.data.nombre);
				$('#dni').val(json.data.dni);
				$('#telefono').val(json.data.telefono);
				$('#correo').val(json.data.email);
				$('#obs').val(json.data.observaciones);
				$("select[name='seccion']").val(json.data.id_seccion);
				$("select[name='tipo']").val(json.data.tipo);
				$('#fecha').val(json.data.fecha);
				$('#hora').val(json.data.hora);
				getHorarios(json.data.fecha, json.data.id_seccion, json.data.hora);
				getMotivo(json.data.id_seccion, json.data.id_subseccion);
				$('#modal-titulo').html('Editar Turno');
				const modal = new bootstrap.Modal(document.getElementById('modalTurno'), {
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
	$(document).on('click', '.editar', function(e) {
	//$('.editar').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.post("inc/carga_turno.php", { id: id }, function(json) {
			//console.log('Datos recibidos de carga_turno:', json);
			if (json.success) {
				$('#id').val(id);
				$('#nombre').val(json.data.nombre);
				$('#dni').val(json.data.dni);
				$('#telefono').val(json.data.telefono);
				$('#correo').val(json.data.email);
				$('#obs').val(json.data.observaciones);
				$("select[name='seccion']").val(json.data.id_seccion);
				$("select[name='tipo']").val(json.data.tipo);
				$('#fecha').val(json.data.fecha);
				$('#hora').val(json.data.hora);
				getHorarios(json.data.fecha, json.data.id_seccion, json.data.hora);
				getMotivo(json.data.id_seccion, json.data.id_subseccion);
				$('#modal-titulo').html('Editar Turno');
				const modal = new bootstrap.Modal(document.getElementById('modalTurno'), {
					backdrop: 'static',
					keyboard: false
				});
				modal.show();
				$('#aviso').hide();
			} else {
				// Mostrar error en el modal
				$('#aviso').removeClass('alert-success').addClass('alert-danger').text(json.error || 'Error al cargar el turno.').show();
				const modal = new bootstrap.Modal(document.getElementById('modalTurno'), {
					backdrop: 'static',
					keyboard: false
				});
				modal.show();
			}
		}, 'json').fail(function(jqXHR, textStatus, errorThrown) {
			// Error de red o de servidor
			let errorMsg = 'Error de red o servidor al cargar el turno.';
			if (jqXHR.responseText) {
				try {
					var resp = JSON.parse(jqXHR.responseText);
					if (resp.error) {
						errorMsg = resp.error;
					} else {
						errorMsg = jqXHR.responseText;
					}
				} catch (e) {
					errorMsg = jqXHR.responseText;
				}
			}
			$('#aviso').removeClass('alert-success').addClass('alert-danger').text(errorMsg).show();
			const modal = new bootstrap.Modal(document.getElementById('modalTurno'), {
				backdrop: 'static',
				keyboard: false
			});
			modal.show();
		});
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
    				$('#centro').load('inc/lista_turnos.php');
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
	//
	$('.excepcion').click(function(e){
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
	$('.unverificar').click(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea marcar como NO verificado el turno?")) 
		{	return false; }
    	else { 
    		var id=$(this).data('id');
    		var valor=0;
    		$.post('inc/verificar_turno.php',{id:id,valor:valor},function(data){
    			if(data.success){
    				$('#centro').load('inc/lista_turnos.php');
    				//console.log('unverificar');
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
					$('#centro').load('inc/lista_turnos.php');
				}
			},'json');
		}
	});
});
function getHorarios(fecha,seccion,sel){
	
	$.post('inc/get_libres.php',{fecha:fecha,seccion:seccion,sel:sel},function(data){
		//console.log('Datos recibidos de get_libres:', data);	
		if(data.success){
			$('#hora').html(data.turnos);
		}
	},'json');
}
function getMotivo(seccion,sel){
	
	$.post('inc/get_sub.php',{seccion:seccion,sel:sel},function(data){
		//console.log('Datos recibidos de get_sub:', data);
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
<div class="row mb-2">
	<div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Lista de Turnos
                    </h5>
                    <button type="button" class="btn btn-success btn-sm nuevo" title="Nuevo Turno">
                        <i class="fas fa-plus me-1"></i>Nuevo Turno
                    </button>
                </div>
            </div>
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablausuarios">
        	<thead>
        	  	<tr>
        			<th data-priority="1">Fecha-Hora</th>
        			<?php if ($_SESSION['imps']['admin']=='1'){ ?>
        			<th data-priority="2">Seccion/Motivo</th>	    
        			<?php }else{ ?>
        			<th data-priority="2">Motivo</th>    
        			<?php } ?>
        			<th data-priority="3">Tipo</th>
        	    	<th data-priority="1">DNI - Nombre</th>
        	    	<th>Telefono - Email</th>
        	    	<th>Recibo</th>
        	    	<th>Conf.</th>
        	    	<th>Obs.</th>
        	    	<th data-priority="1">Verif.</th>
        	    	<th>P Exc.</th>
        	    	<th></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $usuarios->fetch_assoc()) {
        			
        		?>
        		<tr>
        			<td style="width:50px;"><span style="display:none;"><?php echo $row_hc['fecha']?></span><?php echo fecha($row_hc['fecha']).'-'.$row_hc['hora'];?></td>
        			<?php if ($_SESSION['imps']['admin']=='1'){ ?>
        			<td style="width:200px;"><?php echo substr($row_hc["seccion"].'/'.$row_hc["motivo"], 0, 40);?></td>
        			<?php }else{ ?>
        			<td><?php echo $row_hc["motivo"];?></td>
        			<?php } ?>
        			<td><?php echo $row_hc['tipo']; ?></td>
        			<td><?php echo $row_hc['dni'].' - '.strtolower($row_hc['nombre'].' '.$row_hc['apellido']); ?></td>
        			<td><?php echo $row_hc['telefono'].' - '.strtolower($row_hc['email']); ?></td>
        			<td><?php if (!empty($row_hc['recibo'])) { ?>
        			    <a href="<?php echo 'archivos/'.$row_hc['recibo'];?>" download="recibo <?php echo $row_hc['dni']?>"><i class="fas fa-download"></i></a>
        				<?php }?>
        			</td>
<td>
                                    <?php if ($row_hc["confirmado"] == 1) { ?>
                                        <span class="badge badge-status badge-active">confirmado</span>
                                    <?php } else { ?>
                                        <span class="badge badge-status badge-inactive">Sin confirmar</span>
                                    <?php } ?>
                                </td>





        			<td style="width:min-content;"><?php if(!empty($row_hc['observaciones'])){echo '<span class="btn btn-sm btn-link" title="'.$row_hc['observaciones'].'" ><i class="fas fa-info-circle"></i></span>';}?><button type="button" title="" class="btn btn-link btn-sm obs" data-texto="<?php echo $row_hc['observaciones']; ?>" data-id="<?php echo $row_hc['id']; ?>"><i class="fas fa-pencil-alt"></i></button></td>
        			<td><?php if ($row_hc['verificado']=='1'){echo '<btn type="button" class="btn btn-link btn-sm unverificar" data-id="'.$row_hc['id'].'"><i class="fas fa-check-square"></i></btn>'; }else{echo '<btn type="button" class="btn btn-link btn-sm verificar" data-id="'.$row_hc['id'].'"><i class="far fa-square"></i></btn>';}?></td>
        			<td><?php if ($row_hc['excepcion']=='0'){echo '<btn type="button" class="btn btn-link btn-sm excepcion" data-id="'.$row_hc['id'].'"><i class="far fa-square"></i></btn>'; }?></td>
        			<td class="noprint btn-group btn-sm-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="turnos" data-url="inc/lista_turnos.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
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
	      <form action="#" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formTurno" >
	      <div class="modal-header">
<h5 class="modal-title" id="modal-titulo">Nuevo Turno</h5>
			<button type="button" class="close ms-auto" data-dismiss="modal" aria-label="Close" style="color: #003366; background: #fff; border: none; font-size: 2.2rem; opacity: 1; position: relative; z-index: 2; width: 44px; height: 44px; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.12); display: flex; align-items: center; justify-content: center; margin-left: 12px;">
				<span aria-hidden="true" style="line-height: 1;">&times;</span>
			</button>
			
			<input type="hidden" name="id" id="id">
	      </div>
	      <div class="modal-body">
	      	<div class="row">
        		<div class="col-6">
					<div class="form-group row">
					    <div class="input-group col-12">
						<div class="input-group-prepend">
							<span class="input-group-text">Nombre</span>
						</div>	
							<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre y Apellido" required>
						</div>
	                </div>
					<div class="form-group row">
                         <div class="input-group col-12">
						<div class="input-group-prepend">
							<span class="input-group-text">DNI</span>
						</div>
                      	        	<input type="text" class="form-control" name="dni" id="dni" placeholder="DNI del solicitante" />
                      	</div>

						</div>

                      	<div class="form-group row">
                         <div class="input-group col-12">
						<div class="input-group-prepend">
							<span class="input-group-text">telefono</span>
						</div>
                        	<input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Telefono del solicitante" required >
                      	</div>
						</div>
                      	<div class="form-group row">
                         <div class="input-group col-12">
						<div class="input-group-prepend">
							<span class="input-group-text">Correo</span>
						</div>
                        	<input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo" >
                      	</div>
						</div>
                      	
                      	<div class="form-group row">
							<div class="input-group col-12">
							<div class="input-group-prepend">
								<span class="input-group-text">Observaciones</span>
							</div>
								<textarea rows="2" id="obs" name="obs" class="form-control"></textarea>
							</div>

                        </div>
				<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Seccion</span>
                    </div>	
            		<select id="seccion" name="seccion" class="form-control" required>
            		<?php while($row=$secciones->fetch_assoc()){?>
                      			<option id="sec<?php echo $row['id']?>" value="<?php echo $row['id'];?>" ><?php echo $row['nombre'];?></option>
                    <?php }?>
            		</select>
            	</div>
	      	</div>
                
                	<div class="form-group row">   
							<div class="input-group col-12">
							<div class="input-group-prepend">
								<span class="input-group-text">Condicion (<small>Si corresponde</small>)</span>
							</div>                      		
                      		<select name="tipo" class="form-control" id="tipo">
                      			<option id="Activo" value="Activo">Activo</option>
                      			<option id="Jubilado" value="Jubilado">Jubilado</option>
                      			<option id="Pensionado" value="Pensionado">Pensionado</option>
                      		</select>
                      	</div>
					</div>

					<div class="form-group row">   
							<div class="input-group col-12">
							<div class="input-group-prepend">
								<span class="input-group-text">Motivo</span>
							</div>
                      		<select name="motivo" class="custom-select" id="motivo">
                      		</select>
                      	</div>
					</div>
                      	
                	<div class="form-group row">   
							<div class="input-group col-12">
							<div class="input-group-prepend">
								<span class="input-group-text">Fecha</span>
							</div> 
							<input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d')?>" required>
						</div>
					</div>

                    <div class="form-group row">   
							<div class="input-group col-12">
							<div class="input-group-prepend">
								<span class="input-group-text">Horario:</span>
							</div>
						
                      	<select name="hora" class="custom-select" id="hora">
                    	</select>
                    </div>
                      	</div>
                    </div>
                    <p id="aviso" class="alert" role="alert"></p>
                
            </div>
            	
		  </div>
		  <div class="modal-footer">
		      <button id="btnEliminar" class="btn btn-danger" style="display: none;">Desbloquear Turno</button>

		  	<button type="submit" class="btn btn-primary btn-submit">Guardar Turno</button>
		  	<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
		  </div>
	      </form>
	    </div>
	  </div>
	</div>
<script>
$(document).ready(function () {
    // Evento cuando cambia el horario
    $("#hora").change(function () {
        let formData = $("#formTurno").serialize(); // Captura todos los datos del formulario

        $.ajax({
            type: "POST",
            url: "inc/guardar_turno.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                $("#aviso").removeClass("alert-success alert-danger").hide(); // Limpiar mensajes previos

                if (response.success) {
                    $("#id").val(response.id); // Guardamos el ID del turno creado
                     $("#btnEliminar").show(); // Mostrar botón de eliminar si hay ID
                    $("#aviso").text("El turno fue bloqueado en el front a la espera de confirmacion!!. Puedes editarlo y bloquearlo nuevamente.")
                        .addClass("alert-success").show();
                } else {
                    $("#aviso").text("Error al bloquear el turno: " + response.error)
                        .addClass("alert-danger").show();
                }
            },
            error: function () {
                $("#aviso").text("Ocurrió un error al procesar la solicitud.")
                    .addClass("alert-danger").show();
            }
        });
    });

    // Evento para eliminar el turno
$("#btnEliminar").click(function () {
     $("#hora").off("change");
    let turnoId = $("#id").val(); 

    if (!turnoId) {
        $("#aviso").text("No hay un turno seleccionado para desbloquear.")
            .removeClass("alert-success alert-danger")
            .addClass("alert-danger").show();
        return;
    }

    if (!confirm("¿Estás seguro de que deseas desbloquear este turno?")) return;

    $.ajax({
        type: "POST",
        url: "inc/eliminar_turno.php",
        data: { id: turnoId },
        dataType: "json",
        beforeSend: function () {
            $("#aviso").hide(); // Oculta cualquier mensaje anterior
        },
        success: function (response) {
          //  console.log("Respuesta del servidor:", response);

            if (response.success) {
                $("#aviso").text("Turno desbloqueado correctamente.recarga el modal para asignar un nuevo turno!")
                    .removeClass("alert-danger")
                    .addClass("alert-success").show();

                // Limpiar el formulario y ocultar el botón eliminar
                $("#formTurno")[0].reset();
                $("#id").val("");
                $("#btnEliminar").hide();
            } else {
                $("#aviso").text("Error al desbloquear el turno: " + response.error)
                    .removeClass("alert-success")
                    .addClass("alert-danger").show();
            }
        },
        error: function () {
            $("#aviso").text("Ocurrió un error al eliminar el turno.")
                .removeClass("alert-success")
                .addClass("alert-danger").show();
        }
    });
});
	// Evento cuando se presiona el botón Guardar
	$("#formTurno").submit(function (event) {
		event.preventDefault(); // Evita el envío tradicional del formulario
		var formData = new FormData(this);
		$(".btn-submit").prop("disabled", true);
		$.ajax({
			type: "POST",
			url: "inc/guardar_turno.php",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (response) {
				$("#aviso").removeClass("alert-success alert-danger").hide();
				if (response.success) {
					$("#aviso").text("Turno registrado correctamente.").addClass("alert-success").show();
					$("#formTurno")[0].reset();
					$("#modalTurno").on('hidden.bs.modal', function () {
						$('#centro').load('inc/lista_turnos.php');
					});
					setTimeout(function(){
						var modal = bootstrap.Modal.getInstance(document.getElementById('modalTurno'));
						if(modal) modal.hide();
					}, 1200);
				} else {
					$("#aviso").text("Error al registrar el turno: " + response.error).addClass("alert-danger").show();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				var errorMsg = "Ocurrió un error al registrar el turno.";
				if (jqXHR.responseText) {
					try {
						var resp = JSON.parse(jqXHR.responseText);
						if (resp.error) {
							errorMsg = "Error: " + resp.error;
						} else {
							errorMsg = jqXHR.responseText;
						}
					} catch (e) {
						errorMsg = jqXHR.responseText;
					}
				}
				$("#aviso").text(errorMsg).addClass("alert-danger").show();
			},
			complete: function () {
				$(".btn-submit").prop("disabled", false);
			}
		});
	});
});
</script>

