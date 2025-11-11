<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;

// Función para mostrar ✓ o ✗ según el valor
function check2($val) {
	if ($val == 1) {
		return '<i class="fa fa-check-square pastel-green" aria-hidden="true"></i>';
	} else {
		return '<span style="color:#d9534f;font-size:1.2em">&#10007;</span>';
	}
}
    $query_rol = "SELECT a.* FROM roles a   ";

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
	$('#form-rol').submit(function(e){
		e.preventDefault();
		var $guardarBtn = $(this).find('input[type="submit"]');
		var originalBtnHtml = $guardarBtn.html();
		$guardarBtn.prop('disabled', true).val('Guardando...');
		$('#aviso').hide().removeClass('alert-success alert-danger').text('');
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
					$('#modal-rol').modal('hide');
					$("#form-rol")[0].reset();
					$('#centro').load('inc/lista_roles.php');
					$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();    
					$('#id_rol').val('');
				}else{
					$('#aviso').removeClass('alert-success').addClass('alert-danger').text('Error: '+data.error).show();
				}
				$guardarBtn.prop('disabled', false).val('Guardar');
			},
			error: function(jqXHR) {
				$('#aviso').removeClass('alert-success').addClass('alert-danger').text('Error de red o servidor.').show();
				$guardarBtn.prop('disabled', false).val('Guardar');
			}
		});            
	});
	
	//nuevo

	 $(document).on('click', '.nuevo', function(e) {
      console.log('Nuevo rol clicked');
		e.preventDefault();
        $('#form-rol')[0].reset();
        $('#id').val('');
        $('#modal-titulo').text('Nuevo Rol');

        const modal = new bootstrap.Modal(document.getElementById('modal-rol'));
        modal.show();
    });
	$('.nuevo23').click(function(e){
		e.preventDefault();
		var id= $(this).data('target');
		$("#form-rol")[0].reset();	
		$('#modal-rol').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
		$('#id_rol').val('');
	});
    //editar
$(document).on('click', '.editar', function(e) {
	e.preventDefault();
	var $btn = $(this);
	var id = $btn.data('id');
	var originalHtml = $btn.html();
	$btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
	// Limpiar aviso al abrir modal
	$('#aviso').hide().removeClass('alert-success alert-danger').text('');
	$.getJSON("inc/carga_rol.php", { id: id })
	.done(function(json) {
		if (json.success && json.rol) {
			$('#id_rol').val(id);
			$('#codigo').val(json.rol.nombre);
			$('#bene').prop('checked', json.rol.usuarios == 1);
			$('#turnos').prop('checked', json.rol.turnos == 1);
			$('#hotel').prop('checked', json.rol.hotel == 1);
			$('#cuil').prop('checked', json.rol.cuil == 1);
			$('#noti').prop('checked', json.rol.notificaciones == 1);
			$('#emple').prop('checked', json.rol.empleados == 1);
			$('#recibos').prop('checked', json.rol.recibos == 1);
			$('#nove').prop('checked', json.rol.novedades == 1);
			$('#lici').prop('checked', json.rol.licitaciones == 1);
			$('#legi').prop('checked', json.rol.legislacion == 1);
			$('#nicasio').prop('checked', json.rol.nicasio == 1);
			$('#admin').prop('checked', json.rol.admin == 1);
			$('#modal-titulo').html('Editar Rol');
			const modal = new bootstrap.Modal(document.getElementById('modal-rol'), {
				backdrop: 'static',
				keyboard: false
			});
			modal.show();
		} else {
			$('#aviso').removeClass('alert-success').addClass('alert-danger').text(json.error || 'Error al cargar el rol.').show();
			const modal = new bootstrap.Modal(document.getElementById('modal-rol'), {
				backdrop: 'static',
				keyboard: false
			});
			modal.show();
		}
		$btn.prop('disabled', false).html(originalHtml);
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		let errorMsg = 'Error de red o servidor al cargar el rol.';
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
		const modal = new bootstrap.Modal(document.getElementById('modal-rol'), {
			backdrop: 'static',
			keyboard: false
		});
		modal.show();
		$btn.prop('disabled', false).html(originalHtml);
	});
	});	

	// Eliminado handler duplicado .editar223, solo se usa el robusto .editar
			
});
</script>
<style>
/* Verde pastel para el ícono de check */
.pastel-green {
	color: #7ed6a2 !important;
	font-size: 1.3em;
}
/* === Tipografía general === */

  body {
    font-family: 'Roboto', sans-serif;
  }

  h6, .modal-title {
    color: #ffffff;
    font-weight: 450;
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
 /* distancia en los inputs dentro del modal */
  .form-group {
  margin-bottom: 1.5rem; 
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

 <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-gavel me-2"></i>
                Gestión de Configuracion de Roles
            </a>
          
        </div>
    </nav>


	 <!-- Main Content -->
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Lista de Roles
                    </h5>
                    <button type="button" class="btn btn-success btn-sm nuevo" title="Nuevo Rol">
                        <i class="fas fa-plus me-1"></i>Nuevo Rol
                    </button>
                </div>
            </div>

<div class="row">
	<div class="col-12">
    	<table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Rol</th>
        	    	<th>Beneficiarios</th>
        	    	<th>Empleados</th>
        	    	<th>Recibos</th>
        	    	<th>Fechas</th>
        	    	<th>Novedades</th>
        	    	<th>Licitaciones</th>
        	    	<th>Legislacion</th>
        	    	<th>Notificacion</th>
        	    	<th>Turnos</th>
        	    	<th>Hotel</th>
        	    	<th>Cuil</th>
        	    	<th>Nicasio</th>
        	    	<th>Admin</th>
        	    	<th>Acciones</th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $roles->fetch_assoc()) {
        			
        		?>
        		<tr>
        		    <td><?php echo $row_hc["nombre"];?></td>
        			<td><?php echo check2($row_hc["usuarios"]);?></td>
        			<td><?php echo check2($row_hc["empleados"]);?></td>
        			<td><?php echo check2($row_hc["recibos"]);?></td>
        			<td><?php echo check2($row_hc["fechas"]);?></td>
        			<td><?php echo check2($row_hc["novedades"]);?></td>
        			<td><?php echo check2($row_hc["licitaciones"]);?></td>
        			<td><?php echo check2($row_hc["legislacion"]);?></td>
        			<td><?php echo check2($row_hc["notificaciones"]);?></td>
        			<td><?php echo check2($row_hc["turnos"]);?></td>
        			<td><?php echo check2($row_hc["hotel"]);?></td>
        			<td><?php echo check2($row_hc["cuil"]);?></td>
        			<td><?php echo check2($row_hc["nicasio"]);?></td>
        			<td><?php echo check2($row_hc["admin"]);?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["id"];?>"><i class="fas fa-edit"></i></button>
        				<button class="btn btn-sm btn-danger borrar" data-id="<?php echo $row_hc["id"];?>" data-db="roles" data-url="inc/lista_roles.php" ><i class="fa fa-trash" aria-hidden="true"></i></button>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
		</table>
	</div>	
</div>

<!-- Modal Nuevo/editar -->
	<div class="modal fade" id="modal-rol" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_rol.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="form-rol" >
	      <div class="modal-header">
		  
	        <h5 class="modal-title" id="modal-titulo">Nuevo Rol</h5>
                  <button type="button" class="close ms-auto" data-dismiss="modal" aria-label="Close" style="color: #003366; background: #fff; border: none; font-size: 2.2rem; opacity: 1; position: relative; z-index: 2; width: 44px; height: 44px; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.12); display: flex; align-items: center; justify-content: center; margin-left: 12px;">
				<span aria-hidden="true" style="line-height: 1;">&times;</span>
			</button>	        <input type="hidden" name="id_rol" id="id_rol">
	      </div>
	      <div class="modal-body">
	      	
	      	<div class="form-group row">
	      		<div class="input-group col-12">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Nombre</span>
                    </div>	
            		<input class="form-control" type="text" name="codigo" id="codigo"  />
            	</div>
	      		
	      	</div>
	      	<div class="form-group row">
				   <div class="row">
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="admin" id="admin" value="1" checked>
							   <label class="form-check-label" for="admin">Admin</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="bene" id="bene" value="1" checked>
							   <label class="form-check-label" for="bene">Beneficiarios</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="turnos" id="turnos" value="1" checked>
							   <label class="form-check-label" for="turnos">Turnos</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="hotel" id="hotel" value="1" checked>
							   <label class="form-check-label" for="hotel">Hotel</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="cuil" id="cuil" value="1" checked>
							   <label class="form-check-label" for="cuil">CUIL</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="emple" id="emple" value="1" checked>
							   <label class="form-check-label" for="emple">Empleados</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="recibos" id="recibos" value="1" checked>
							   <label class="form-check-label" for="recibos">Recibos</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="fechas" id="fechas" value="1" checked>
							   <label class="form-check-label" for="fechas">Fechas</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="nove" id="nove" value="1" checked>
							   <label class="form-check-label" for="nove">Novedades</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="lici" id="lici" value="1" checked>
							   <label class="form-check-label" for="lici">Licitaciones</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="legi" id="legi" value="1" checked>
							   <label class="form-check-label" for="legi">Legislacion</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="noti" id="noti" value="1" checked>
							   <label class="form-check-label" for="noti">Notificacion</label>
						   </div>
					   </div>
					   <div class="col-md-4 mb-3">
						   <div class="form-check">
							   <input class="form-check-input" type="checkbox" name="nicasio" id="nicasio" value="1">
							   <label class="form-check-label" for="nicasio">Nicasio</label>
						   </div>
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