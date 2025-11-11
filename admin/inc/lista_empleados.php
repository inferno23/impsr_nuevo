 <?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';	
global $conectar;

    
/*$query_usu = "SELECT d.NROJUBILADO, a.LEGAJO,a.CLAVE,a.IDPERSONA,a.CUIL,a.APELLYNOMBRE,a.celular,a.TELEFONO,b.id_rol,c.id,c.nombre rol,c.recibos,c.licitaciones,c.novedades,c.usuarios,c.admin FROM personas a LEFT JOIN permisos b ON a.LEGAJO=b.legajo LEFT JOIN roles c ON b.id_rol=c.id LEFT JOIN municxper d ON a.IDPERSONA=d.IDPERSONA WHERE a.LEGAJO>0 AND (d.NROJUBILADO='' OR d.NROJUBILADO is NULL)";*/
$query_usu = "
SELECT 
    d.NROJUBILADO, 
    a.LEGAJO,
    a.CLAVE,
    a.IDPERSONA,
    a.CUIL,
    a.APELLYNOMBRE,
    a.celular,
    a.TELEFONO,
    b.id_rol,
    c.id,
    c.nombre rol,
    c.recibos,
    c.licitaciones,
    c.novedades,
    c.usuarios,
    c.admin
FROM personas a 
LEFT JOIN permisos b ON a.LEGAJO = b.legajo 
LEFT JOIN roles c ON b.id_rol = c.id 
LEFT JOIN municxper d ON a.IDPERSONA = d.IDPERSONA 
INNER JOIN desc_datos_instituto ddi ON ddi.IDPERSONA = a.IDPERSONA
WHERE 
    a.LEGAJO > 0 
    AND (d.NROJUBILADO = '' OR d.NROJUBILADO IS NULL)
    AND ddi.baja = 0
";

$queryr="SELECT a.* FROM roles a ";

$usuarios = $conectar->query($query_usu);
//echo $conectar->error.$query_usu;
$rol=$conectar->query($queryr);

$seccion=$conectar->query("SELECT * FROM turnos_secciones");
?>
<script>

$(function() {
	$('#tablausuarios').DataTable( {
		responsive: true,
        "language": {
            "url": "inc/esp.json"
        },
        responsive: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
    });
	
    //nuevo usuario
	$('#form-user').submit(function(e){
		e.preventDefault();
		var pass1=$('#pass1').val();
		var pass2=$('#pass2').val();
		if (pass1===pass2){
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
    				    $('#modal-user').modal('hide');
    					$("#form-user")[0].reset();
    					$('#centro').load('inc/lista_empleados.php');
    					$('body').removeClass('modal-open');
    					$('.modal-backdrop').remove();	
    					$('#id_user').val('');	
    				}else{
    					alert('Error '+data.error);	
    				}
				}          
			});
		}
		else{
			$('#mensaje').html('Las Claves no Coinciden, Intente de nuevo');
	    	$('#mensaje').focus();
	        $('#mensaje').delay(3000).fadeOut("slow");
			}	
    });
	$('#formClave').submit(function(e){
		e.preventDefault();
		var pass1=$('#pass1').val();
		var pass2=$('#pass2').val();
		if (pass1===pass2){
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
    				    $('#modalClave').modal('hide');
    					$("#formClave")[0].reset();
    					$('#centro').load('inc/lista_empleados.php');
    					$('body').removeClass('modal-open');
    					$('.modal-backdrop').remove();	
    					$('#id1').val('');	
    				}else{
    					alert('Error '+data.error);	
    				}
				}          
			});
		}
		else{
			$('#mensaje').html('Las Claves no Coinciden, Intente de nuevo');
	    	$('#mensaje').focus();
	        $('#mensaje').delay(3000).fadeOut("slow");
			}	
    });
	//nuevo
	$('.nuevo').click(function(e){
		e.preventDefault();
		var id= $(this).data('target');
		$("#form-user")[0].reset();		
		$('#modal-user').modal({
		    backdrop: 'static',
		    keyboard: false 
		});
		$('#id_user').val('');
	});
    //editar
    $(document).on('click', '.editar', function(e) {
	//$('.editar').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.post( "inc/carga_usuario.php",{ id:id }, function( json ) {
			if (json.success){
    			$('#id2').val(id);
    			$('#nombre').val(json.usu.APELLYNOMBRE);
    			$('#legajo').val(json.usu.LEGAJO);
    			$('#legajohid').val(json.usu.LEGAJO);
    			$('#rol'+json.usu.rol).prop( "selected", true );
    			$('#sec'+json.usu.seccion).prop( "selected", true );
    			$('#modal-user').modal({
    			    backdrop: 'static',
    				keyboard: false 
    			});
			}else{
				alert('Error '+json.error);
				}
	    },'json');
	});	
	$(document).on('click', '.clave', function(e) {
	//$('.clave').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.post( "inc/carga_jubilado.php",{ id:id }, function( json ) {
			if (json.success){
			   // console.log(json);
    			$('#id1').val(id);
    			$('#cnombre').val(json.usu.APELLYNOMBRE);
    			$('#nbene').val(json.usu.NROJUBILADO);
    			$('.pass').val(json.usu.CLAVE);
    			$('#passold').val(json.usu.CLAVE);
    		var myModal = new bootstrap.Modal(document.getElementById('modalClave'));
    myModal.show();
			}else{
				alert('Error '+json.error);
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

  /* Tabla */
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

</style>
<div class="row mb-2">
	<div class="col-6">
		<h6>Lista de Empleados</h6>
	</div>
</div>
<div class="row">
	<div class="col-12">
    <table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablausuarios">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<?php if ($_SESSION['imps']['admin']=='1') { ?>
            		<th>Rol</th>
            		<?php }?>
        	  		<th>LEGAJO</th>
        			<th>ID</th>
        			<th>Nombre</th>
        	    	<th>CUIL</th>
        	    	<th>Telefono</th>
        	    	<th>Clave</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $usuarios->fetch_assoc()) {
        			
        		?>
        		<tr>
        			<?php if ($_SESSION['imps']['admin']=='1') { ?>
            		<td><?php echo $row_hc['rol'];?></td>
            		<?php }?>
        			<td><?php echo $row_hc["LEGAJO"];?></td>
        			<td><?php echo $row_hc["IDPERSONA"];?></td>
        			<td><?php echo $row_hc["APELLYNOMBRE"];?></td>
        			<td><?php echo $row_hc["CUIL"];?></td>
        			<td><?php echo $row_hc['TELEFONO'].'-'.$row_hc['celular']; ?></td>
        			<td><?php echo clave($row_hc['CLAVE'])?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info clave" data-id="<?php echo $row_hc["IDPERSONA"];?>"><i class="fas fa-key"></i></button>
        			<?php if ($_SESSION['imps']['admin']=='1') { ?>
        				<button class="btn btn-sm btn-info editar" data-id="<?php echo $row_hc["IDPERSONA"];?>"><i class="fas fa-user-tag"></i></button>
        			<?php }?>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
    	</table>
	</div>
</div>

<!-- Modal CSV -->
	<div class="modal fade" id="modalClave" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_clave.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formClave" >
	      <div class="modal-header">
	        
	        <h5 class="modal-title" style="color:white" id="modal-titulo">Cambiar Clave</h5>
	        <button type="button" style="margin-left:320px" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id1">
	      </div>
	      <div class="modal-body">
	      	
            <div class="form-group row"> 
                	<div class="input-group col-12">
                		<div class="input-group-prepend">
                        	<span class="input-group-text">Nombre</span>
                        </div>	
                		<input class="form-control" disabled type="text" name="nombre" id="cnombre"  />
                	</div>
            </div>
            
	      	<div class="form-group row">
            	<div class="input-group col-12 ">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Password</span>
                    </div>	
            		<input class="form-control pass" type="password" name="pass" id="pass1"  />
            		<div class="input-group-append noshow">
            			<button type="button" class="btn mostrar"><i class="fas fa-eye ver" ></i></button>
            		</div>
            	</div>
            </div>
            <div class="form-group row noshow">	
            	<input type="hidden" name="passold" id="passold">
            	<div class="input-group col-12 ">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Repita Password</span>
                    </div>	
            		<input class="form-control pass" type="password" name="pass" id="pass2"  />
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
<!-- Modal CSV -->
	<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_usuario.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="form-user" >
	      <div class="modal-header">
	        
	        <h5 class="modal-title" id="modal-titulo">Asignar Permisos</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id2">
	      </div>
	      <div class="modal-body">
	      	
            <div class="form-group row"> 
                	<div class="input-group col-12">
                		<div class="input-group-prepend">
                        	<span class="input-group-text">Nombre</span>
                        </div>	
                		<input class="form-control" disabled type="text" name="nombre" id="nombre"  />
                	</div>
            </div>
            <div class="form-group row"> 
                	<div class="input-group col-12">
                		<div class="input-group-prepend">
                        	<span class="input-group-text">Legajo</span>
                        </div>	
                		<input class="form-control" disabled type="text" name="legajo" id="legajo"  />
                		<input type="hidden" name="legajo" id="legajohid"  />
                	</div>
            </div>
            <div class="form-group row">    
			    <div class="input-group col-12 ">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Rol</span>
                    </div>	
            		<select name="rol" class="form-control" id="rol">
            			<option id="rol0" value="0">Ninguno</option>
            			<?php while ($row=$rol->fetch_assoc()) { ?>
            			<option id="rol<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
            			<?php } ?>
            		</select>  
            	</div> 
	      	</div>
	      	<div class="form-group row">    
			    <div class="input-group col-12 ">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Seccion (turnos)</span>
                    </div>	
            		<select name="seccion" class="form-control" id="seccion">
            			<option id="sec0" value="0" selected>Ninguno</option>
            			<?php while ($row=$seccion->fetch_assoc()) { ?>
            			<option id="sec<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
            			<?php } ?>
            		</select>  
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