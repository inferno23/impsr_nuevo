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
$secciones=$con->query("SELECT * FROM turnos_secciones WHERE front='1'");
?>
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
                      	<form id="formPreturno" method="post" enctype="multipart/form-data" >
                      		<div class="row">
                      			<div class="form-group col-12 col-md-4">
                                	<label for="seccion">Seccion</label>
                                  	<select class="custom-select" id="seccion">
                                  	<?php while($row=$secciones->fetch_assoc()){?>
                                  		<option data-seo="<?php echo $row['seo']; ?>" value="<?php echo $row['id']; ?>" data-url="<?php echo getUrl(strtolower(quitar_tildes($row['nombre'])));?>" ><?php echo $row['nombre'];?></option>
                                  	<?php }?>
                                  	</select>
                        		</div>		
                      			<div class="form-group col-12 col-md-4">
                                	<label for="motivo">Motivo</label>
                                  	<select class="custom-select" id="motivo">
                                  	</select>
                        		</div>
                        		<div class="form-group col-12 col-md-4" id="group-condicion">
                                	<label for="tipo">Condicion </label>
                                  	<select name="tipo" class="custom-select" id="tipo">
                                  		<option value="Activo">Trabajador Activo</option>
                                  		<option value="Jubilado">Jubilado</option>
                                  		<option value="Pensionado">Pensionado</option>
                                  	</select>
                            	</div>
                      		</div>
                      		<div class="row">
                      			<div class="col-12">
                      				<p id="aviso1" class="alert d-none" role="alert"></p>
                      			</div>
                      			<div class="col-12 text-right">
                      				<button type="submit" class="btn btn-turno" id="btnPre">Solicitar turno</button>
                      			</div>
                      		</div>
                        </form>
                        
              		</div>
            	</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="fondoBlanco" style="background-color: white;padding: 1.25rem;border: 1px solid rgba(0,0,0,.125); border-radius: .25rem;">
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
	
	
	$('#formPreturno').submit(function(e){
		e.preventDefault();
		var seccion=$('#seccion').find(':selected').data('seo');
		var secid=$('#seccion').val();
		var sub=$('#motivo').val();
		var cond=$('#tipo').val();
		
		if(secid=='1'){
			var condi=cond.toLowerCase();
			// Construir la URL con parámetros GET
var url = "solicitar_turno-datos.php?seccion=" + encodeURIComponent(seccion) + 
          "&sub=" + encodeURIComponent(sub) + 
          "&condi=" + encodeURIComponent(condi);

// Redirigir a la nueva URL
window.location.href = url;
	}else{
			// Construir la URL con parámetros GET
var url = "solicitar_turno-datos.php?seccion=" + encodeURIComponent(seccion) + 
          "&sub=" + encodeURIComponent(sub);
          

// Redirigir a la nueva URL
window.location.href = url;	}
	});
	
	var seccion=$('#seccion').val();
	//getHorarios(getFecha(),seccion);
	getMotivo(seccion);
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
		
		
		if(mensaje!=''){
			if(mensaje!='undefined'){
    			console.log('mensaje lleno '+mensaje );
    			$('#aviso1').show();
    			$('#aviso1').addClass('alert-info');
    			$('#aviso1').removeClass('d-none');
    			$('#aviso1').html(mensaje);
			}else{
				console.log('mensaje vacio '+mensaje);
				$('#aviso1').hide();
				$('#aviso1').removeClass('alert-info');
				$('#aviso1').addClass('d-none');
				}
		}else{
			console.log('mensaje vacio '+mensaje);
			$('#aviso1').hide();
			$('#aviso1').removeClass('alert-info');
			$('#aviso1').addClass('d-none');
		}
	});
	
	$('#seccion').change(function(e){
		e.preventDefault();
		//var fecha=$('#fecha').val();
		var seccion=$(this).val();
		if (seccion=='1'){
			$('#group-condicion').show();
			$('#tipo').show();
			$('#aviso1').html('');
			$('#aviso1').removeClass('alert-info');
		}else if(seccion=='2'){
			
			$('#aviso1').html('Para solicitar turno para jubilacion y pension, debera contar con toda la documentaciÃ³n requerida');
			$('#aviso1').addClass('alert-info');
			$('#group-condicion').hide();
		}else{
			$('#aviso1').html('');
			$('#aviso1').removeClass('alert-info');
			$('#group-condicion').hide();
			$('#tipo').hide();
		}
		//getHorarios(fecha,seccion);
		getMotivo(seccion);
	});
	//
	
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
						var seccion=$('#gseccion').val();
						$('#horarios').html('');
						getMotivo(seccion);
						$('.btn-submit').focus();
						
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
			alert('Por favor, SeleccionÃ© una hora');
			
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
function getMotivo(seccion){
	
	$.post('functions/get_sub.php',{seccion:seccion},function(data){
		if(data.success){
			$('#motivo').html(data.opciones);
			var mensaje=$('#motivo').find(':selected').data('mensaje');
			var valor=$('#motivo').find(':selected').val();
			var texto=$('#motivo').find(':selected').text();
			console.log(mensaje+' '+valor+''+texto);
			if(mensaje!=''){
				if(mensaje!='undefined'){
					console.log('mensaje lleno '+mensaje );
					$('#aviso1').show();
					$('#aviso1').addClass('alert-info');
					$('#aviso1').removeClass('d-none');
					$('#aviso1').html(mensaje);
				}else{
					console.log('mensaje vacio '+mensaje);
					$('#aviso1').hide();
					$('#aviso1').removeClass('alert-info');
					$('#aviso1').addClass('d-none');
					}
			}else{
				console.log('mensaje vacio '+mensaje);
				$('#aviso1').hide();
				$('#aviso1').removeClass('alert-info');
				$('#aviso1').addClass('d-none');
			}
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
