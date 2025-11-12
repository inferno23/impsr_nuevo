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
	   			<form id="formRecuperar" method="POST" action="functions/recuperar_turno.php">
    			<div class="card">
              		<div class="card-header" id="card-titulo">Gestión de Turnos - Recuperación de Datos de Turnos</div>
              		<div class="card-body">
              			<div id="errores">
                        </div>
                        <h3>Recuperación de datos de Turnos</h3>
                        <div class="form-row">
                            <div class="form-group col-md-12">
            					<div>
                                    <label><input name="recupera" id="recupera1" value="mail" type="radio" checked="checked">Recuperar por correo electrónico</label>      
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div>  
                                    <label><input name="recupera" id="recupera2" value="dni" type="radio"> Recuperar por número de documento</label>     
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-7 col-12">
                                <div id="campoEmail">
                                    <label>
                                        Ingrese su correo electrónico y los datos serán enviados al mismo
                                    </label>
                                    <input type="text" id="mail" name="mail" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-7 col-12">
                                <div id="campoDNI" style="display: none;">
                                    <label for="numeroDoc">
                                    	Ingrese número de documento
                                    </label>
                                    <input type="text" id="dni" name="dni" class="form-control" value="">
                                </div> 
                            </div> 
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
            					<button type="submit" class="btn btn-primary btn-submit">Enviar Solicitud</button>
                            </div>
                        </div>
                    </div>
            	</div>
            	</form>
			</div>
		</div>
		
	</div>


<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
	$("input[name=recupera]").change(function(e){
		e.preventDefault();
		if ($("input[name=recupera]:checked").val() == "mail") {
		    $("#campoDNI").hide();
		    $("#campoEmail").show();
		  } else {
		    $("#campoEmail").hide();
		    $("#campoDNI").show();
		  }
	});
	
	$('#formRecuperar').submit(function(e){
		e.preventDefault();
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
					console.log(data.query);
					if (data.success){
						alert('Comprobante enviado a '+data.email);
					}
					else{
						console.log(data.error);
						$('#errores').html(data.msg);
						$('#errores').addClass('alert-danger');
						$('#errores').removeClass('alert-success');
						$('#errores').show(0).delay(5000).hide(0);
					}
					$('.btn-submit').prop('disabled',false);
					$('.btn-submit').html(txt);
				}  
			});	
		
				
	});
});

</script>
</body>
</html>
