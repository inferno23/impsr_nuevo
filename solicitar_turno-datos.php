<?php include 'head.php'; ?>
<?php include 'header.php';




function quitar_tildes($cadena) {
    $no_permitidas= array ("Ã¡","Ã©","Ã­","Ã³","Ãº","Ã�","Ã‰","Ã�","Ã“","Ãš","Ã±","Ã€","Ãƒ","ÃŒ","Ã’","Ã™","Ãƒâ„¢","Ãƒ ","ÃƒÂ¨","ÃƒÂ¬","ÃƒÂ²","ÃƒÂ¹","Ã§","Ã‡","ÃƒÂ¢","Ãª","ÃƒÂ®","ÃƒÂ´","ÃƒÂ»","Ãƒâ€š","ÃƒÅ ","ÃƒÅ½","Ãƒâ€�","Ãƒâ€º","Ã¼","ÃƒÂ¶","Ãƒâ€“","ÃƒÂ¯","ÃƒÂ¤","Â«","Ã’","ÃƒÂ�","Ãƒâ€ž","Ãƒâ€¹");
    $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    $texto = str_replace($no_permitidas, $permitidas ,$cadena);
    return $texto;
}
function getUrl($nombre){
    $nuevo=str_replace(' ', '-', $nombre);
    $nuevo=strtolower($nuevo);
    return $nuevo;

}
?>


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

.colort{
    color:#1E619A;
}
.btn-turno{
    background-color: #1E619A;
    border: 1px solid #1E619A;
    color : #fff;
}
#solicitar-turnos{
    background-color: #e4e5e6;
}

</style>
<?php
include_once 'functions/constants.php';
include_once 'functions/connect.php';
global $con;
$seccion=$_GET['seccion'];

$secciones=$con->query("SELECT * FROM turnos_secciones WHERE seo='$seccion'");
if ($secciones->num_rows>0) {
    $rows=$secciones->fetch_assoc();
    $sub=$_GET['sub'];
    $idseccion=$rows['id'];
    $subsecciones=$con->query("SELECT * FROM turnos_subsecciones WHERE id_seccion='$idseccion' AND seo='$sub'");
    if ($subsecciones->num_rows>0) {
        $rowsub=$subsecciones->fetch_assoc();
        $idsub=$rowsub['id'];
    }else{
        header("Location: solicitar-turno");
        exit();
    }
}else{
    header("Location: solicitar-turno");
    exit();
}
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
.ui-datepicker {
    width: 100% !important;
}
.ui-state-default{
    color: green !important;
}
.ui-state-disabled .ui-state-default{
    color: red !important;
}
.ui-state-highlight {
    color: green !important;
}
.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    list-style: none;
    background-color: #e9ecef;
    border-radius: 0.25rem;
}
</style>
<body>
	<div class="container pb-4" id="solicitar-turnos" >
		<!-- <div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Solicitar Turno</p>
	    </div> -->
		<div class="row">
			<div class="col-12 my-4 ">
				<h2 class="h3 colort">Solicitar Turno</h2>
			</div>
		</div>
	   	<div class="row">
	   		<nav aria-label="breadcrumb" role="navigation">
            	<ol class="breadcrumb">
                	<li class="breadcrumb-item"><a href="solicitar-turno">Inicio</a></li>
                </ol>
            </nav>
	   	</div>
	   	<div class="row">
	   		<div class="col-12">
    			<div class="card">
              		<div class="card-header" id="card-titulo">Turnos Disponibles</div>
              		<div class="card-body">

                        <form action="functions/guardar_turno.php" class="w-100 pb-5 pt-5" method="POST"  id="formTurno" enctype="multipart/form-data" >
                    		<div class="row">
                    			<div class="col-12 col-sm-7 col-md-8">
                   					<div class="form-group">
                                    	<label for="nombre">Apellido</label>
                                    	<input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido (requerido)" required>
                                  	</div>
                   					<div class="form-group">
                                    	<label for="nombre">Nombre</label>
                                    	<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre (requerido)" required>
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
                                  	<div class="form-group">
                                    	<label for="correo">Repetir Correo</label>
                                    	<input type="email" class="form-control" name="correo" id="correo2" placeholder="Repita su correo" required>
                                  	</div>
                                  	<div class="form-row">
                                  		<div class="form-group col-9">
                                        	<label for="dni">Calle</label>
                                        	<input type="text" class="form-control" name="calle" id="calle" placeholder="Su calle" >
                                      	</div>
                                      	<div class="form-group col-3">
                                        	<label for="dni">Altura</label>
                                        	<input type="text" class="form-control" name="altura" id="altura" placeholder="Altura de la calle" >
                                      	</div>
                                  	</div>
                                  	<div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="localidad">Localidad</label>
                                            <input type="text" class="form-control" name="localidad" id="localidad">
                        				</div>

                    				</div>
                    				<?php if (isset($_GET['condi'])){ ?>
                    				<input type="hidden" name="condicion" value="<?php echo $_GET['condi']; ?>">
                    				<?php if($_GET['condi']=='activo') { ?>
                    				<div class="form-group" id="group-recibo">
                                      	<label for="recibo">Recibo de Sueldo <small>(si corresponde)</small></label>
                                      	<input type="file" class="form-control" name="recibo" id="recibo" required>
                                	</div>
                                	<?php } ?>
                    				<?php } ?>
                                </div>
                            	<div class="col-12 col-sm-5 col-md-4">
                            		<div id="datepick"></div>
                                	<div class="card mt-3">
                                		<div class="card-header">Horarios Disponibles :</div>
                                		<div class="card-body">
                                			<select name="hora" id="horarios" class="custom-select" required>
                                			</select>
                                		</div>
                                		<div class="card-footer text-muted alert alert-info mb-0">
                                            En los dias y horarios que se encuentran en rojo, no se realizan trámites, o todos los turnos ya fueron otorgados.
                                        </div>
                                	</div>
                            		<div class="form-group">
                            			<div class="invalid-feedback">Sin Horarios Disponibles, Seleccione otra fecha</div>
                            		</div>
                                  	<p id="aviso" class="alert" role="alert"></p>
                                  	<input type="hidden" name="fecha" id="fecha">
                                  	<input type="hidden" name="seccion" value="<?php echo $idseccion; ?>" id="seccion">
                                  	<input type="hidden" name="motivo" value="<?php echo $idsub; ?>" id="motivo">
                                  	<div class="g-recaptcha" data-sitekey="6LeXVGwaAAAAAO0wnvfmCaV4QaekFoW5-se9_eOr"></div>
                                  	<br>
                                    <button type="submit" class="btn btn-primary btn-block btn-lg my-5 btn-submit">Solicitar Turno</button>
                   				</div>
                        	</div>
                    	</form>
              		</div>
            	</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="fondoBlanco" style="background-color: white;padding: 1.25rem;border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;">
					<p>Si usted ya ha solicitado un turno, puede anularlo, modificarlo, imprimir su comprobante, o recuperar la información del mismo.</p>
    				<a href="gestion-turno/anular" type="button" class="btn btn-secondary btn-anular">Anular</a>
    				<a href="gestion-turno/modificar" type="button" class="btn btn-secondary btn-modificar">Modificar</a>
    				<a href="gestion-turno/imprimir" type="button" class="btn btn-secondary btn-imprimir">Imprimir</a>
    				<a href="gestion-turno/recuperar" type="button" class="btn btn-secondary btn-recuperar">Recuperar</a>
    			</div>
			</div>
		</div>
	</div>


<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

	var seccion=$('#seccion').val();
	$.post('functions/get_ocupados.php',{seccion:seccion},function(data){
		if(data.success){
			var disabledDays = data.fer;
			$.datepicker.regional['es'] = {
					closeText: 'Cerrar',
					prevText: 'Previo',
					nextText: 'Siguiente',
					currentText: 'Hoy',
					monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
					'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
					dayNames: ['Domingo', 'Lunes', 'Martes', 'MiÃ©rcoles', 'Jueves', 'Viernes', 'SÃ¡bado'],
					dayNamesShort: ['Dom', 'Lun', 'Mar', 'MiÃ©;', 'Juv', 'Vie', 'SÃ¡b'],
					dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'SÃ¡'],
					weekHeader: 'Sm',
					dateFormat: 'yy-mm-dd',
					firstDay: 1,
					minDate: +1,
					maxDate: new Date('2025-10-01'), //aca tenes que cambiar la fecha final
					isRTL: false,
					showMonthAfterYear: false,
					beforeShowDay: function(date){
				         var day = date.getDay();
				         var string = jQuery.datepicker.formatDate('d-m-yy', date);
				         var isDisabled = ($.inArray(string, disabledDays) != -1);
				         return [day != 0 && day !=6 && !isDisabled];
				      },
					yearSuffix: ''
					};
			$.datepicker.setDefaults($.datepicker.regional['es']);
			$('#datepick').datepicker({
				onSelect: function (date) {
					$('#fecha').val(date);
					var seccion=$('#seccion').val();
					$('#gseccion').val(seccion);
					var motivo=$('#motivo').val();
					$('#gmotivo').val(motivo);
					getHorarios(date,seccion);
					},
				});
		}
	},'json');

	$('#fecha').change(function(e){
		e.preventDefault();
		var fecha=$(this).val();
		var seccion=$('#seccion').val();
		getHorarios(fecha,seccion);
	});

	$('#tipo1').change(function(e){
		e.preventDefault();
		var tipo=$(this).val();
		if(tipo=='Activo'){
			$('#group-recibo').show();
			$('#recibo').prop('required',true);
		}else{
			$('#group-recibo').hide();
			$('#recibo').prop('required',false);
		}
	});

	$('#motivo').change(function(e){
		e.preventDefault();
		var mensaje=$(this).find(':selected').data('mensaje');
		$('#aviso1').html(mensaje);
		if(mensaje!='' || mensaje=='undefined'){
			$('#aviso1').addClass('alert-info');
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

						$('.btn-submit').focus();
						window.location.href = "turno_solicitado.php";
					}
					else{
						console.log(data.error);
						$('#aviso').html(data.msg);
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

	$.post('functions/get_libres2.php',{fecha:fecha,seccion:seccion},function(data){
		if(data.success){
			$('#horarios').html(data.turnos);
			$('#horarios').removeAttr('selected').find('option:first').attr('selected', 'selected');
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
