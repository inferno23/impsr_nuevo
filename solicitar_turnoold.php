<?php include 'head.php'; ?>
<?php include 'header.php'; ?>


<style>
<!--
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
-->
</style>
<?php 
include_once 'functions/constants.php';
include_once 'functions/connect.php';
global $con;
$secciones=$con->query("SELECT * FROM turnos_secciones WHERE front='1'");
?>
<body>

	<div class="container" id="tramites">
		<div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Solicitar Turno</p>
	    </div>
	   	<div class="titulo-pag">
	        <p>Solicitar Turno</p>
	    </div>
		<div class="descripcion">
			<!-- 	-->
		</div>
		<form action="functions/guardar_turno.php" class="w-100 pb-5 pt-5" method="POST"  id="formTurno" enctype="multipart/form-data" >
        	<div class="row">
        		<div class="col-12 col-sm-5 col-md-4 offset-md-2 offset-sm-1 ">
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
                        	<input type="tel" class="form-control" name="telefono" id="telefono" placeholder="Telefono del solicitante" >
                      	</div>
                      	<div class="form-group">
                        	<label for="correo">Correo</label>
                        	<input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo" required>
                      	</div>
                      	
                      	
                </div>
                <div class="col-12 col-sm-5 col-md-4">  
                		<div class="form-group">
                      		<label for="seccion">Seccion</label>
                      		<select name="seccion" class="custom-select" id="seccion">
                      		<?php while($row=$secciones->fetch_assoc()){?>
                      			<option value="<?php echo $row['id'];?>" ><?php echo $row['nombre'];?></option>
                      		<?php }?>
                      		</select>
                      	</div>
                      	<div class="form-group">
                      		<label for="motivo">Motivo</label>
                      		<select name="motivo" class="custom-select" id="motivo">
                      		</select>
                      	</div>
                      	<div class="form-group" id="group-condicion">
                      		<label for="tipo">Condición (<small>Si corresponde</small>)</label>
                      		<select name="tipo" class="custom-select" id="tipo">
                      			<option value="Activo">Trabajador Activo</option>
                      			<option value="Jubilado">Jubilado</option>
                      			<option value="Pensionado">Pensionado</option>
                      		</select>
                      	</div>
                      	<div class="form-group" id="group-recibo">
                      		<label for="recibo">Recibo de Sueldo (<small>Trabajador Activo</small>)</label>
                      		<input type="file" class="form-control" name="recibo" id="recibo" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="fecha">Fecha</label>
                        	<input type="date" class="form-control" name="fecha" id="fecha" value="" required>
                      	</div>
                		<div class="form-group">
                			<label for="horario">Seleccione horario :</label>
                      		<select name="hora" id="horarios" class="custom-select" required>
                			</select>
                        	<div class="invalid-feedback">Sin Horarios Disponibles, Seleccione otra fecha</div>
                		</div>    	
                      	<p id="aviso" class="alert" role="alert"></p>
                        <button type="submit" class="btn btn-primary btn-block btn-lg my-5 btn-submit">Solicitar Turno</button>
       			</div>
            </div>
        </form>
	</div>


<?php include 'footer.php'; ?>
<script>
$(document).ready(function(){
	var seccion=$('#seccion').val();
	//getHorarios(getFecha(),seccion);
	getMotivo(seccion);
	$('#fecha').change(function(e){
		e.preventDefault();
		var fecha=$(this).val();
		var seccion=$('#seccion').val();
		getHorarios(fecha,seccion);
	});
	$('#seccion').change(function(e){
		e.preventDefault();
		var fecha=$('#fecha').val();
		var seccion=$(this).val();
		if (seccion=='1'){
			$('#group-condicion').show();
			$('#group-recibo').show();
			$('#aviso').html('');
			$('#aviso').removeClass('alert-info');
		}else if(seccion=='2'){
			
			$('#aviso').html('Para solicitar turno para jubilacion y pension, debera contar con toda la documentación requerida');
			$('#aviso').addClass('alert-info');
			$('#group-condicion').hide();
			$('#group-recibo').hide();
			$('#recibo').prop('required',false);
		}else{
			$('#aviso').html('');
			$('#aviso').removeClass('alert-info');
			$('#group-condicion').hide();
			$('#group-recibo').hide();	
			$('#recibo').prop('required',false);
		}
		getHorarios(fecha,seccion);
		getMotivo(seccion);
	});
	//
	$('#tipo').change(function(e){
		e.preventDefault();
		var d=$(this).val();
		var seccion=$('#seccion').val();
		if((d=='Activo') && (seccion=='1')){
			$('#recibo').prop('required',true);
		}else{
			$('#recibo').prop('required',false);
		}
	});
	//
	$(document).on('click','.acciones',function(e){
		e.preventDefault();
		$('.acciones').removeClass('activo');
		$(this).addClass('activo');
		var hora=$(this).data('hora');
		$('#hora').val(hora);
	});
	//
	
	$('#formTurno').submit(function(e){
		e.preventDefault();
		
		var hora=$('#hora').val();
		if(hora!=''){
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
						$('#aviso').html('turno solicitado<br>Recibira un correo para confirmar su turno');
						$('#aviso').addClass('alert-success');
						$('#aviso').removeClass('alert-danger');
						$('#aviso').show(0).delay(5000).hide(0);
						$("#formTurno")[0].reset();
						var seccion=$('#seccion').val();
						//getHorarios(getFecha(),seccion);
						$('#horarios').html('');
						getMotivo(seccion);
						$('.btn-submit').focus();
						window.location.href = "turno_solicitado.php";
					}
					else{
						console.log(data.error);
						$('#aviso').html('Error al solicitar el turno. contactese con la asistencia');
						$('#aviso').addClass('alert-danger');
						$('#aviso').removeClass('alert-success');
						$('#aviso').show(0).delay(5000).hide(0);
						
					}
					$('.btn-submit').prop('disabled',false);
					$('.btn-submit').html(txt);
				}  
			});	
		}else{
			alert('Por favor, Seleccioné una hora');
			
		}
				
	});
});
function getHorarios(fecha,seccion){
	
	$.post('functions/get_libres.php',{fecha:fecha,seccion:seccion},function(data){
		if(data.success){
        	console.log(data.turnos+' turnos');
			if(data.turnos===''){
				console.log('es invalido');	
				$('#horarios').addClass('is-invalid');
			}else{
				$('#horarios').removeClass('is-invalid');
			}
			$('#horarios').html(data.turnos);
		}
	},'json');
}
function getMotivo(seccion){
	
	$.post('functions/get_sub.php',{seccion:seccion},function(data){
		if(data.success){
			$('#motivo').html(data.opciones);
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
</script>
</body>
</html>
