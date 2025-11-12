<?php 
include_once 'functions/constants.php';
include_once 'functions/connect.php';
global $con;
function fecha($fecha){
    if ($fecha=='0000-00-00'){
        return ' ';
    }else {
        return strftime("%d/%m/%Y",strtotime($fecha));
    }
}
$nroturno= $_GET['turno'];
$secsub=substr($nroturno, 0, 4);
$nturno = substr($nroturno, 4,4);

$turnos=$con->query("SELECT t.*,ts.nombre seccion,su.etiqueta subseccion FROM `turnos` t LEFT JOIN turnos_secciones ts ON t.id_seccion=ts.id LEFT JOIN turnos_subsecciones su ON t.id_subseccion=su.id WHERE t.id='$nturno'");
if ($turnos->num_rows>0) {
    $turno=$turnos->fetch_assoc();
    $id=$turno['id'];
    $doc=$turno['dni'];
    $nombre=$turno['nombre'];
    $apellido=$turno['apellido'];
    $fechaf=fecha($turno['fecha']);
    $hora =$turno['hora'];
    $titulo='Turno asignado para : '.$turno['seccion'].' - '.$turno['subseccion'].'';
    $nroturno=str_pad($turno['id_seccion'], 2, "0", STR_PAD_LEFT).str_pad($turno['id_subseccion'], 2, "0", STR_PAD_LEFT).$id;
    $obs='<p>Deberá concurrir con D.N.I y la documentación correspondiente al trámite a realizar en calle San Lorenzo 1055 de Rosario</p>';
    
}else{
    header("Location: /solicitar-turno");
    exit();
}
?>
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
<style>
@media print 
{
    .noprint {
    display: none !important;
    }
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
	   	<div class="row justify-content-center">
	    	<div class="col-md-8 col-12 ">
	    		<div class="card" id="paraimprimir" style="position: relative;display: -ms-flexbox;display: flex;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0,0,0,.125);border-radius: .25rem;">
	    			<div class="card-header" style="padding: .75rem 1.25rem;margin-bottom: 0;background-color: rgba(0,0,0,.03);border-bottom: 1px solid rgba(0,0,0,.125);">
	    				<h2 class="h3" style="font-size: 1.75rem;margin-bottom: .5rem;font-family: inherit;font-weight: 500;line-height: 1.2;"><?php echo $titulo;?></h2>
	    			</div>
	    			<div class="card-body" style="flex: 1 1 auto;padding: 1.25rem;">
    	    			<div class="descripcion text-center" style="font-size:1rem;">
                			<p style="margin-bottom: 1rem;">DNI : <?php echo $doc; ?></p>
                			<p style="margin-bottom: 1rem;">Nombre : <?php echo $nombre.' '.$apellido; ?></p>
                			<p style="margin-bottom: 1rem;">Su turno ha sido confirmado para el dia <?php echo $fechaf; ?> y hora <?php echo $hora;?></p>
                			<p style="margin-bottom: 1rem;">Su numero de Turno es <?php echo $nroturno; ?></p>
                			<div class="border p-3" style="padding: 1rem!important; border: 1px solid #dee2e6!important;">
                				<p  style="margin-bottom: 1rem;"><?php echo $obs; ?></p>
                			</div>
                			<br>
                			
                		</div>
        	        
        	    	</div>
        		
	    		</div>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-12 text-center mt-3">
	    		<button class="btn btn-primary noprint" type="button" id="btn-imprimir" data-id="<?php echo $nroturno;?>">Imprimir</button>
	    	</div>
	    </div>
		
	</div>


<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
	$('#btn-imprimir').click(function(e){
		e.preventDefault();
		$("#paraimprimir").printThis({
		    importCSS: true,
		    importStyle: true
		});
	});
});

</script>
</body>
</html>
