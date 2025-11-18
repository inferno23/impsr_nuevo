 <?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';	
global $conectar;

    
$query_usu = "SELECT a.mail,a.mail2,a.LEGAJO,a.CLAVE,a.IDPERSONA,a.CUIL,a.APELLYNOMBRE,a.TELEFONO,a.celular,b.NROJUBILADO,b.NROPEN FROM personas a LEFT JOIN municxper b ON a.IDPERSONA=b.IDPERSONA WHERE a.IDPERSONA>'0' AND (b.NROJUBILADO>'0' OR b.NROJUBILADO <> NULL) AND (a.MUERTO='0' OR MUERTO IS NULL)";
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
		$('#aimprimirT').printThis({
			importCSS: true,
            importStyle: true,
            loadCSS: "/css/bootstrap.min.css",
            header:'<h1>Clave usuario</h1>'});
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
	//
	$('.notificar').click(function(e){
		e.preventDefault();
		console.log('ACA ENTRO');
		var id=$(this).data('id');
		var nombre=$(this).data('nombre');
		var mail=$(this).data('mail');
		console.log(id);
		console.log(nombre);
		console.log(mail);
		$('.id').val(id);
		$('#mail2').val(mail);
		$('#modal-titulo-not').html('Enviar Notificacion a '+nombre);
		$('#modalNotificacion').modal('show');
	});
	$('#formNotificacion').submit(function(e){
		e.preventDefault();
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
    			    $('#modalNotificacion').modal('hide');
    				$("#formNotificacion")[0].reset();
    				$('body').removeClass('modal-open');
    				$('.modal-backdrop').remove();	
    				$('.id').val('');	
    			}else{
    				alert('Error '+data.error);	
    			}
			}          
		});
		
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
<!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #003366 0%, #0056b3 100%);">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-users me-2"></i>
                Gestión de Beneficiarios
            </a>
          
        </div>
    </nav>
	<p></p>
<div class="row mb-2">
	<div class="col-6">
		<h6>Lista de Jubilados</h6>
	</div>
	
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-striped table-hover " style="border:1px solid #CCCCCC" id="tablausuarios">
        	<thead >
        	  	<tr>
        			<th>ID</th>
        			<th>Nro Jubilado</th>
        			<th>Nombre</th>
        	    	<th>Teléfono</th>
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
        		
        			<td><?php echo $row_hc["APELLYNOMBRE"];?></td>

        			<td><?php echo $row_hc['TELEFONO'].'-'.$row_hc['celular']; ?></td>
        			<td><?php echo clave($row_hc['CLAVE']);?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-info clave" data-id="<?php echo $row_hc["IDPERSONA"];?>"><i class="fas fa-key"></i></button>
        				<?php if($row_hc['mail']!=''){?>	
        				<button type="button" class="btn btn-sm btn-success notificar" data-mail="<?php echo $row_hc['mail']?>" data-nombre="<?php echo $row_hc['APELLYNOMBRE']?>" data-id="<?php echo $row_hc['IDPERSONA'];?>"><i class="far fa-envelope"></i></button>
        				<?php } ?>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
    	</table>
	</div>
</div>

<div class="modal fade" id="modalNotificacion" tabindex="-1" role="dialog" aria-labelledby="modal-titulo-not">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="inc/notificar2.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formNotificacion" >
			<div class="modal-header">
	        	<h5 class="modal-title" id="modal-titulo-not" style="color:white">Enviar Notificación</h5>
    	        <button  type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	        <input type="hidden" name="id" class="id">
    	    </div>
    	    <div class="modal-body">
    	    	<div class="form-group row"> 
                	<div class="input-group col-12">
                		<div class="input-group-prepend">
                        	<span class="input-group-text">Título</span>
                        </div>	
                		<input class="form-control" type="text" name="titulo"  />
                	</div>
            	</div>
            	<div class="form-group row"> 
                	<div class="input-group col-12">
                		<div class="input-group-prepend">
                        	<span class="input-group-text">Mail Apoderado</span>
                        </div>	
                		<input class="form-control" type="text" name="mail2" id="mail2"  />
                	</div>
            	</div>
            	<div class="form-group row"> 
                	<div class="input-group col-12">
    					<input type="file" name="archivos[]" accept="application/pdf" multiple="multiple" class="form-control">
    				</div>
    			</div>	
    	    </div>
    	    <div class="modal-footer">
		  		<button type="submit" class="btn btn-primary" ><i class="far fa-paper-plane"></i>Enviar</button>
		   		<button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
		  	</div>
		  	</form>
		</div>
	</div>
</div>

<!-- Modal CSV -->
	<div class="modal fade" id="modalClave" tabindex="-1" role="dialog" aria-labelledby="modal-titulo">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <form action="inc/guardar_clave.php" class="form-horizontal" enctype="multipart/form-data" role="form" method="post" id="formClave" >
	      <div class="modal-header">
	        
		   <h5 class="modal-title" id="modal-titulo" style="color:white">Cambiar Clave</h5>
	        <button type="button" style="margin-left:320px" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                    	<span class="input-group-text">Contraseña</span>
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
                    	<span class="input-group-text">Repita Contraseña</span>
                    </div>	
            		<input class="form-control pass" type="password" name="pass" id="pass2"  />
            	</div>
            </div>		
            <div class="show">
            	<hr>
            	<p style="text-align:center; font-size:13px;">Ingrese a su cuenta en impsr.gob.ar <br>o a Recibo digital</p>
            </div>	
		  </div>
		  <div class="modal-footer">
		  	<button class="btn btn-primary" type="button" id="imprimirT" data-div="#aimprimirT">Imprimir</button>
		   	<input name="guardar" type="submit" class="btn btn-primary" value="Guardar" />
		    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
		  </div>
	      </form>
	    </div>
	  </div>
	</div>
