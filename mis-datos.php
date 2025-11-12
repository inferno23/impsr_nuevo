<?php include 'functions/with-login.php'; ?>
<?php include 'head.php'; ?>
<?php include 'header.php'; ?>
<?php include 'functions/connect.php';

global $con;
$id=$_SESSION['id'];
if ($_SESSION['tipo']=='pensionado') {
    $query="SELECT p.*,m.NROJUBILADO,m.NROPEN FROM personas p LEFT JOIN causante c ON p.IDPERSONA=c.IDPERSONA LEFT JOIN municxper m ON m.IDPERSONA=c.IDPER WHERE p.IDPERSONA='$id'";
}else{
    $query="SELECT p.*,m.NROJUBILADO,m.NROPEN FROM personas p LEFT JOIN municxper m ON p.IDPERSONA=m.IDPERSONA WHERE p.IDPERSONA='$id'";
}
$not=mysqli_query($con,"SELECT *,DATEDIFF(CURDATE(),fecha) as pasado,DATE_FORMAT(fecha, '%d/%m/%Y') as fecha FROM notificaciones WHERE idpersona='$id' ORDER BY fecha DESC");
$res=mysqli_query($con, $query);
$row=mysqli_fetch_assoc($res);
//echo mysqli_error($con);
//echo $query;
?>
<script>
	$(function() {
    	$('#formDatos').submit(function(e){
    		e.preventDefault();
    		if (!confirm("Esta seguro de que desea guardar los datos?")) 
				{	return false; }
			else { 
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
            				//console.log(data);
        					if (data.success){
            				    alert('Datos Guardados');
            				    location.replace("salir.php");
            				    	
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
			}
        				
        });
    	$(document).on('keyup', '.pass', function(e) {
    		//$('.pass').keyup(function(e){
    			if ( e.which == 13 ) {
    			     e.preventDefault();
    			  }
    			var pass1=$('#pass1').val();
    			var pass2=$('#pass2').val();
    			console.log(pass1+'--'+pass2)
    			if (pass1===pass2){
    				$('.pass').addClass( "is-valid" );
    				$('.pass').removeClass("is-invalid");
    				
    				}
    			else{
    				$('.pass').addClass( "is-invalid" );
    				$('.pass').removeClass("is-valid");
    				}
    		});
	});
	</script>
<body>	
	<div class="container" id="recibo-haberes">
		<div class="titulo-pag mb-3">
		    <p>Mis Datos</p>
	    </div>
	    <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" role="tab" data-toggle="tab" href="#perfil">Mi Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" role="tab" data-toggle="tab" href="#recibos">Recibos</a>
          </li>
		<li class="nav-item">
          	<a class="nav-link" role="tab" data-toggle="tab" href="#ultimo">Último Recibo</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" role="tab" data-toggle="tab" href="#carnet">Carnet</a>
          </li>
          <li class="nav-item">
          	<a class="nav-link" role="tab" data-toggle="tab" href="#notificaciones">Notificaciones</a>
          </li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active show" id="perfil">
          	<form action="guardar_datos.php" id="formDatos" role="form" class="form" method="post">
          	<input type="hidden" name="idp" value="<?php echo $row['IDPERSONA'];?>">
          	<div class="row mt-2">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Nombre y Apellido</span>
                  </div>
                  <input type="text" class="form-control" disabled name="apellynombre" value="<?php echo $row['APELLYNOMBRE'];?>">
                  <input type="hidden" name="apellynombre" value="<?php echo $row['APELLYNOMBRE'];?>">
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >ID</span>
                  </div>
                  <input type="text" class="form-control" disabled name="id" value="<?php echo $row['IDPERSONA'];?>">
                </div>
          	</div>
          	<div class="row">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >DNI</span>
                  </div>
                  <input type="text" class="form-control" disabled name="dni" value="<?php echo $row['NRODOC'];?>">
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >CUIL</span>
                  </div>
                  <input type="text" class="form-control" disabled name="cuit" value="<?php echo $row['CUIL'];?>">
                </div>
          	</div>
          	<div class="row">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Telefono</span>
                  </div>
                  <input type="text" class="form-control" name="telefono" value="<?php echo $row['TELEFONO'];?>">
                  <input type="hidden" name="telefono_old" value="<?php echo $row['TELEFONO'];?>">
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Celular</span>
                  </div>
                  <input type="text" class="form-control" name="celular" value="<?php echo $row['celular'];?>">
                  <input type="hidden" name="celular_old" value="<?php echo $row['celular'];?>">
                </div>
          	</div>
          	<div class="row">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Direccion</span>
                  </div>
                  <input type="text" class="form-control" name="direccion" value="<?php echo $row['DOMICILIO'];?>">
                  <input type="hidden" name="direccion_old" value="<?php echo $row['DOMICILIO'];?>">
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >E-mail</span>
                  </div>
                  <input type="text" class="form-control" name="email" value="<?php echo $row['mail'];?>">
                  <input type="hidden" name="email_old" value="<?php echo $row['mail'];?>">
                </div>
          	</div>
          	<hr>
          	<div class="row">
          		<div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Contraseña</span>
                  </div>
                  <input type="password" class="form-control pass" name="pass1" id="pass1" value="<?php echo $row['CLAVE'];?>">
                  <div class="invalid-feedback">Las claves no coinciden</div>
                </div>
                <div class="col-12 col-sm-6 input-group mb-2">
          		  <div class="input-group-prepend">
                    <span class="input-group-text" >Repita Contraseña</span>
                  </div>
                  <input type="password" class="form-control pass" name="pass2" id="pass2" value="<?php echo $row['CLAVE'];?>">
                  <input type="hidden"  name="passold" value="<?php echo $row['CLAVE'];?>">
                </div>
          	</div>
          	<div class="row mb-3">
          		<div class="col-12 col-sm-6">
          			<button type="submit" class="btn btn-primary">Guardar</button>
          		</div>
          		<div class="col-12">
          			<div id="mensaje"></div>
          		</div>
          	</div>
          	</form>
          </div>
		<div role="tabpanel" class="tab-pane fade" id="ultimo">
        		<div class="row">
        			<div class="col-12 my-3">
        				<p>Presionando el botón descagar recibo podra acceder a su última liquidación.</p>	
        			</div>
        		</div>
        		
        		<?php 
        		$idpersona=$row['IDPERSONA'];
        		$res=$con->query("SELECT * FROM ultimosrecibos WHERE idpersona='$idpersona'");
        		if ($res->num_rows>0) {
        		    $rowc=$res->fetch_assoc();
        		    $archivo=$rowc['archivo'];
        		    if (file_exists($archivo)) {
        		        echo '<a href="'.$archivo.'" download="recibo-'.$idpersona.'.pdf" class="btn btn-info">Descargar ultimo recibo</a>';
        		    }
        		}else{
        		  $nrojub=$row['NROJUBILADO'];
        		  $nropen=$row['NROPEN'];
        		  if (empty($nrojub)) {
        		      $archivo= 'ultimo/'.$nropen.'.pdf';   
        		  }else{
        		      $archivo= 'ultimo/'.$nrojub.'.pdf';
        		  }
        		  $nombre_fichero=$archivo;
        		  //echo __DIR__.'/'.$nombre_fichero;
        		  if (file_exists($nombre_fichero)) {
        		      echo '<a href="'.$archivo.'" download class="btn btn-info">Descargar recibo</a>';
        		  } else {
        		      //echo 'no existe archivo '.$nombre_fichero;
        		  }
        		}
        		?>
        	</div>
          	<div role="tabpanel" class="tab-pane fade" id="recibos">
          		<?php
          		    $idpersona=$_SESSION['id'];
          		    
          		    if (($idpersona =='25959') || ($idpersona=='25960') || ($idpersona=='32222')) {
          		        switch ($idpersona){
          		            case '25959':
          		                $dir='recibos-sueldo/CENTRO';
          		                $query="SELECT * FROM recibos_centro ";
          		            break;
          		            case '25960':
          		                $dir='recibos-sueldo/SINDICATO';
          		                $query="SELECT * FROM recibos_sindicato ";
          		            break;
          		            case '32222':
          		                $dir='recibos-sueldo/NUEVOCENTRO';
          		                $query="SELECT * FROM recibos_centro2 ";
          		                break;
          		        }
          		        $recibos=mysqli_query($con,$query);
          		        ?>
        				<ul class="list-group">
        				<?php
        				if (mysqli_num_rows($recibos)>0) {
        				    while ($rowr=mysqli_fetch_assoc($recibos)) { ?>
          		            
        				 
        					<li class="list-group-item">
        							<a download="https://impsrtest.<?php echo $rowr['nombre']?>" href="<?php echo $rowr['archivo']; ?>" target="_blank">
        								<?php echo $rowr['nombre']; ?> <span class="carousel-control-next-icon"></span>
        							</a>
        						</li>                         
                           <?php }
                      	} else {
        					?>
        					<li class="list-group-item">No hay recibos</li>
        					<?php
        				}
        				?>
          		        </ul>
        			<?php 		
                    }else{
          		        if ( $_SESSION['NOMBREUSUARIO']) {
          		            global $con;
          		            if ($_SESSION['empleado']=='1') {
          		                $usuario=$_SESSION['id'];
          		                $query="SELECT * FROM recibos WHERE codigo='$usuario' ORDER BY ano DESC,mes DESC";
          		            }else{
          		                $usuario=$_SESSION['NOMBREUSUARIO'];
          		                $query="SELECT * FROM recibos WHERE codigo='$usuario' ORDER BY ano DESC,mes DESC";
          		            }
//echo $query;
          		            $recibos=mysqli_query($con, $query);
          		            ?>
        				<ul class="list-group">
        				<?php
        				if (mysqli_num_rows($recibos)>0) {
                            while ($rowr=mysqli_fetch_assoc($recibos)) { ?>
        					<li class="list-group-item">
        							<a download="<?php echo $rowr['titulo'].'.pdf';?>" href="<?php echo $rowr['archivo']; ?>" target="_blank">
        								<?php echo $rowr['titulo'] ?> <span class="carousel-control-next-icon"></span>
        							</a>
        						</li>                         
                            <?php }
                      	} else {
        					?>
        					<li class="list-group-item">No hay recibos</li>
        					<?php
        				}
        				?>
        				</ul>
        				<?php
        			     }
          		   }
        			
        		?>		
          	</div>
        	<div role="tabpanel" class="tab-pane fade" id="carnet">
        		<div class="row">
        			<div class="col-12 my-3">
        				<p>Si su carnet se encuentra digitalizado podra descargar una copia en pdf para poder imprimirlo.</p>	
        			</div>
        		</div>
        		
        		<?php
        		$idpersona=$row['IDPERSONA'];
        		$res=$con->query("SELECT * FROM carnets WHERE idpersona='$idpersona'");
        		if ($res->num_rows>0) {
        		    $rowc=$res->fetch_assoc();
        		    $archivo=$rowc['archivo'];
        		    if (file_exists($archivo)) {
        		        echo '<a href="'.$archivo.'" download="Carnet-'.$idpersona.'.pdf" class="btn btn-info">Descargar Carnet A</a>';
        		    }
        		}else{
        		  $nrojub=$row['NROJUBILADO'];
        		  $nropen=$row['NROPEN'];
        		  if (empty($nrojub)) {
        		      $archivo= 'carnets/'.$nropen.'.pdf';   
        		  }else{
        		      $archivo= 'carnets/'.$nrojub.'.pdf';
        		  }
        		  $nombre_fichero=$archivo;
        		  //echo __DIR__.'/'.$nombre_fichero;
        		  if (file_exists($nombre_fichero)) {
        		      echo '<a href="'.$archivo.'" download class="btn btn-info">Descargar Carnet</a>';
        		  } else {
				$archivo= 'carnets/'.$nropen.'.pdf';
				 if (file_exists($archivo)) {
        		      	echo '<a href="'.$archivo.'" download class="btn btn-info">Descargar Carnet</a>';
        		  	}
        		      //echo 'no existe archivo '.$nombre_fichero;
        		  }
        		}
        		?>
        	</div>
        	<div role="tabpanel" class="tab-pane fade" id="notificaciones">
        		<div class="row">
        			<div class="col-12 my-3">
        				<p>Últimas Notificaciones</p>
        				<div class="accordion" id="accordionExample">
        				<?php 
        				$i=1;
        				while($rown=mysqli_fetch_assoc($not)){
        				    $id=$rown['id'];
        				    $archivos=mysqli_query($con,"SELECT * FROM archivos WHERE id_notificacion='$id'");
        				    ?>
                          <div class="card">
                            <div class="card-header" id="heading<?php echo $i;?>">
                              <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i;?>">
                                  <?php echo $rown['titulo'];?> 
                                  <?php echo '- '.$rown['fecha'];?>
                                </button>
                                <?php if($rown['pasado']<=15){?>
                                	<span class="badge badge-pill badge-danger">Nueva</span>
                                <?php }?>
                              </h5>
                            </div>
                        	<div id="collapse<?php echo $i;?>" class="collapse <?php if($i==1){echo 'show';}?>" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordionExample">
                              <div class="card-body">
                                <?php while($rowa=mysqli_fetch_assoc($archivos)){ ?>
                                <a href="archivos/<?php echo $rowa['archivo']?>" download class="nav-link"><?php echo $rowa['archivo'];?></a><br>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                          <?php
                            $i++;
        				    }?>
                          
                        </div>
        			</div>
        		</div>
        	</div>
        </div>
		
	</div>
	<?php include 'footer.php'; ?>
</body>
</html>