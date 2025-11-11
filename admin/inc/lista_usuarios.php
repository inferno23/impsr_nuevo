 <?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';	
global $conectar;

    
$query_usu = "SELECT a.LEGAJO,a.CLAVE,a.IDPERSONA,a.CUIL,a.APELLYNOMBRE,a.TELEFONO,a.celular,b.NROJUBILADO,b.NROPEN FROM personas a LEFT JOIN municxper b ON a.IDPERSONA=b.IDPERSONA WHERE  a.IDPERSONA>'0' AND (b.NROJUBILADO>'0' OR b.NROJUBILADO <> NULL OR b.NROPEN>'0' OR b.NROPEN<> NULL) ";
$usuarios = $conectar->query($query_usu);
//echo $conectar->error.$query_usu;

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
    					//$('#centro').load('inc/lista_usuarios.php');
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
	$('#imprimirT').click(function(e){
		e.preventDefault();
		var div=$(this).data('div');
		console.log(div);
		//$(div).printThis();
		$('#aimprimirT').printThis();
	});
	$('.clave').click(function(e){
		e.preventDefault();
		var id=$(this).data('id');
		$.post( "inc/carga_usuario.php",{ id:id }, function( json ) {
			if (json.success){
    			$('#id1').val(id);
    			$('#cnombre').val(json.usu.APELLYNOMBRE);
    			$('#nbene').val(json.usu.NROJUBILADO);
    			$('.pass').val(json.usu.CLAVE);
    			$('#passold').val(json.usu.CLAVE);
    			$('#modalClave').modal({
    			    backdrop: 'static',
    				keyboard: false 
    			});
			}else{
				alert('Error '+json.error);
				}
	    },'json');
	});
	$('#mostrar').click(function(e){
		e.preventDefault();
		//console.log('mostrar');
	      if($('#ver').hasClass('fa-eye'))
	      {
	      $('.pass').removeAttr('type');
	      $('#ver').addClass('fa-eye-slash').removeClass('fa-eye');
	      }
	 
	      else
	      {
	      //Establecemos el atributo y valor
	      $('.pass').attr('type','password');
	      $('#ver').addClass('fa-eye').removeClass('fa-eye-slash');
	      }
	});	
//
});
</script>
<div class="row mb-2">
	<div class="col-6">
		<h6>Lista de Usuarios</h6>
	</div>
	
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-hover table-bordered table-sm display compact nowrap" id="tablausuarios">
        	<thead class="thead-dark">
        	  	<tr>
        			<th>ID</th>
        			<th>Nro Jubilado</th>
        			<th>Nro Pension</th>
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
        			<td><?php echo $row_hc["IDPERSONA"];?></td>
        			<td><?php echo $row_hc['NROJUBILADO']?></td>
        			<td><?php echo $row_hc['NROPEN']?></td>
        			<td><?php echo $row_hc["APELLYNOMBRE"];?></td>
        			<td><?php echo $row_hc["CUIL"];?></td>
        			<td><?php echo $row_hc['TELEFONO'].'-'.$row_hc['celular']; ?></td>
        			<td><?php echo clave($row_hc['CLAVE']);?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info clave" data-id="<?php echo $row_hc["IDPERSONA"];?>"><i class="fas fa-key"></i></button>
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
	        
	        <h5 class="modal-title" id="modal-titulo">Cambiar Clave</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <input type="hidden" name="id" id="id1">
	      </div>
	      <div class="modal-body" id="aimprimirT">
	      	
            <div class="form-group row"> 
                	<div class="input-group col-12">
                		<div class="input-group-prepend">
                        	<span class="input-group-text">Nombre</span>
                        </div>	
                		<input class="form-control" disabled type="text" name="nombre" id="cnombre"  />
                	</div>
            </div>
            <div class="form-group row"> 
                	<div class="input-group col-12">
                		<div class="input-group-prepend">
                        	<span class="input-group-text">Nro Beneficiario</span>
                        </div>	
                		<input class="form-control" disabled type="text" name="nbene" id="nbene"  />
                	</div>
            </div>
	      	<div class="form-group row">
            	<div class="input-group col-12 ">
            		<div class="input-group-prepend">
                    	<span class="input-group-text">Password</span>
                    </div>	
            		<input class="form-control pass" type="password" name="pass" id="pass1"  />
            		<div class="input-group-append">
            			<button type="button" class="btn mostrar"><i class="fas fa-eye ver" ></i></button>
            		</div>
            	</div>
            </div>
            <div class="form-group row">	
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
		  	<button class="btn btn-primary" type="button" id="imprimirT" data-div="#aimprimirT">imprimir</button>
		   	<input name="guardar" type="submit" class="btn btn-primary" value="Guardar" />
		    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
		  </div>
	      </form>
	    </div>
	  </div>
	</div>