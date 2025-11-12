<?php include 'head.php'; ?>
<?php include 'header.php'; ?>


<style>
<!--
.disabled{
background-color:#ffc107 !important;
}
-->
</style>
<?php 
include_once 'functions/constants.php';
include_once 'functions/connect.php';
global $con;
$secciones=$con->query("SELECT * FROM turnos_secciones");
?>
<body>

	<div class="container" id="tramites">
		<div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Denuncia por Fallecimiento</p>
	    </div>
	   	<div class="titulo-pag">
	        <p>Solicitar Turno</p>
	    </div>
		<div class="descripcion">
			<!-- 	-->
		</div>
        <div class="row">
        	<div class="col-12 col-sm-6 col-md-4 offset-md-4 offset-sm-3 pb-5 pt-5">
       				<form action="functions/guardar_turno.php" method="POST"  id="formTurno" >
       					<div class="form-group">
                        	<label for="nombre">Nombre</label>
                        	<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre y Apellido" required>
                      	</div>
                      	<div class="form-group">
                        	<label for="correo">Correo</label>
                        	<input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo" required>
                      	</div>
                      	<div class="form-group">
                      		<label for="seccion">Seccion</label>
                      		<select name="seccion" class="custom-select" id="seccion">
                      		<?php while($row=$secciones->fetch_assoc()){?>
                      			<option value="<?php echo $row['id'];?>" ><?php echo $row['nombre'];?></option>
                      		<?php }?>
                      		</select>
                      	</div>
                      	<div class="form-group">
                        	<label for="fecha">Fecha</label>
                        	<input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d')?>" required>
                      	</div>
                      	<label>Seleccione horario :</label>
                      	<div id="horarios" class="my-2"></div>
                      	<p id="aviso" class="alert" role="alert"></p>
                      	<input type="hidden" name="hora" id="hora">
                        <button type="submit" class="btn btn-primary btn-block btn-lg my-5">Solicitar Turno</button>
       				</form>
            </div>
        </div>
	</div>


<?php include 'footer.php'; ?>
<script>
$(document).ready(function(){
	var seccion=$('#seccion').val();
	getHorarios(getFecha(),seccion);
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
		getHorarios(fecha,seccion);
	});
	//
	$(document).on('click','.acciones',function(e){
		e.preventDefault();
		$('.acciones').removeClass('active');
		$(this).addClass('active');
		var hora=$(this).data('hora');
		$('#hora').val(hora);
	});
	//
	
	$('#formTurno').submit(function(e){
		e.preventDefault();
		var txt=$('.btn-submit').html();
		$('.btn-submit').prop('disabled',true);
		$('.btn-submit').html('<i class="fas fa-spinner fa-pulse"></i>');
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
					getHorarios(getFecha());
				}
				else{
					console.log(data.error);
					$('#aviso').html('Error al solicitar el turno. contactese con la asistencia');
					$('#aviso').addClass('alert-danger');
					$('#aviso').removeClass('alert-success');
					$('#aviso').show(0).delay(5000).hide(0);
					
				}
			}  
		});			
	});
});
function getHorarios(fecha,seccion){
	
	$.post('functions/get_turnos.php',{fecha:fecha,seccion:seccion},function(data){
		if(data.success){
			$('#horarios').html(data.turnos);
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
