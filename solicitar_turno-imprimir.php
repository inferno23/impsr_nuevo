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
              		<div class="card-header" id="card-titulo">Gestión de Turnos - Impresión de Comprobante</div>
              		<div class="card-body">
              			<form action="functions/get_turno.php" method="post" id="formAnular">
    	                  	<div class="form-row">	
    	                  		<div class="form-group col-12 col-md-6">
                                    	<label for="dni">DNI</label>
                                    	<input type="text" class="form-control" name="dni" id="dni" placeholder="DNI del solicitante" required>
	                        	</div>
	                        </div>
                            <div class="form-row">
    							<div class="form-group col-12 col-md-6">
                                    <label for="idturno">
                                        Número de Identificación del Turno:
                                    </label>
                                    <input type="text" id="idturno" name="idturno" class="form-control" value="">
                                    <div class="alert alert-info" role="alert">
                                        <a href="gestion-turno/recuperar">¿Ha olvidado el Nº de Turno?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <p>El número de identificación del Turno se encuentra impreso en el comprobante
                                        de Turno generado al momento de la reserva del mismo.</p>
                                    <br>
                                    <p id="aviso" class="alert d-none"></p>
                                </div>
                            </div>
                            <div class="form-row">
                            		<button type="submit" class="btn btn-primary">Ver comprobante</button>
                            </div>
                        </form>
              		</div>
            	</div>
			</div>
		</div>
		
	</div>


<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
	
	$('#formAnular').submit(function(e){
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
				if (data.success){
					window.location.href = "gestion-turno/imprimir/"+data.nroturno;
				}else{
					console.log(data.error);
						$('#aviso').html(data.msg);
						$('#aviso').addClass('alert-danger');
						$('#aviso').removeClass('alert-success');
						$('#aviso').removeClass('d-none');	
						$('#aviso').show(0).delay(5000).hide(0);
						
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