<?php 
include_once 'functions/constants.php';
include_once 'functions/connect.php';
include_once 'functions/funciones.inc.php';
global $con;
$code=$_GET['code'];
$id=$_GET['id'];
function fecha($fecha){
    if ($fecha=='0000-00-00'){
        return ' ';
    }else {
        return strftime("%d/%m/%Y",strtotime($fecha));
    }
}
$res=$con->query("SELECT a.*,b.nombre as seccion,b.puestos,c.etiqueta subseccion  FROM `turnos` a LEFT JOIN turnos_secciones b ON a.id_seccion=b.id LEFT JOIN turnos_subsecciones c ON a.id_subseccion=c.id WHERE a.id ='$id' AND a.code='$code'");
if($res){
    $turno=$res->fetch_assoc();
    if($turno['confirmado']=='1'){
        $mensaje='<p>Su Turno ya fue confirmado con anterioridad</p>';
    }else{
        $id=$turno['id'];
        $puestos=$turno['puestos'];
        $date = new DateTime($turno['hora']);
        $hora=$date->format('H:i');
        $fecha=$turno['fecha'];
        $seccion=$turno['id_seccion'];
        $secnombre=$turno['seccion'];
        $subseccion=$turno['subseccion'];
        //
        $query="SELECT * FROM turnos WHERE hora='$hora' AND fecha='$fecha' AND id_seccion='$seccion' AND confirmado='1' ";
        $res=$con->query($query);
        $conf=$res->num_rows;
        if($conf<$puestos){
            $res2=$con->query("UPDATE turnos SET confirmado='1' WHERE id='$id'");
            if($res2){
                $cuerpo=getTurno($id);
                $asunto='Confirmacion de Turno';
                $correo=$turno['email'];
                $nom=$turno['nombre'].' '.$turno['apellido'];
                enviarMail($correo, $nom, $asunto, $cuerpo);
                
                $titulo='Turno asignado para : '.$secnombre.' - '.$subseccion.'';
                $doc=$turno['dni'];
                $nombre=$turno['nombre'];
                $apellido=$turno['apellido'];
                $fechaf=fecha($fecha);
                $hora =$hora;
                $nroturno=str_pad($seccion, 2, "0", STR_PAD_LEFT).str_pad($turno['id_subseccion'], 2, "0", STR_PAD_LEFT).$id;
                $obs='<p>Deberá concurrir con D.N.I y la documentación correspondiente al trámite a realizar en calle San Lorenzo 1055 de Rosario</p>';
            }else{
                $mensaje='<p>Error al confirmar</p><p>comuniquese con soporte tenico al 55555-55</p>';
            }
        }else{
            $mensaje='<p>El turno ya fue adjudicado</p><p>solicite un nuevo horario</p>';
        }
        //
        
        
    }
}else{
    header('location: index.php');
}

?>
<?php include 'head.php'; ?>
<?php include 'header.php'; ?>


<style>
@media print 
{
    .noprint {
    display: none !important;
    }
}
</style>

<body>

	<div class="container" id="tramites">
		<div class="where">
	        <i class="fa fa-home"style= "letter-spacing: 2pt;"></i><p> Inicio <i class="fa fa-angle-right"></i> Servicios <i class="fa fa-angle-right"></i> Confirmar turno</p>
	    </div>
	    <div class="row justify-content-center">
	    	<div class="col-md-8 col-12 ">
	    		<div class="card" id="paraimprimir" style="position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;">
	    			<div class="card-header" style="padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
}">
	    				<h2 class="h3" style="font-size: 1.75rem;margin-bottom: .5rem;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.2;"><?php echo $titulo;?></h2>
	    			</div>
	    			<div class="card-body" style="flex: 1 1 auto;
    padding: 1.25rem;">
    	    			<div class="descripcion text-center" style="font-size:1rem;">
                			<p style="margin-bottom: 1rem;">DNI : <?php echo $doc; ?></p>
                			<p style="margin-bottom: 1rem;">Nombre : <?php echo $nombre.' '.$apellido; ?></p>
                			<p style="margin-bottom: 1rem;">Su turno ha sido confirmado para el dia <?php echo $fechaf; ?> y hora <?php echo $hora;?></p>
                			<p style="margin-bottom: 1rem;">Su numero de Turno es <?php echo $nroturno; ?></p>
                			<div class="border p-3" style="padding: 1rem!important; border: 1px solid #dee2e6!important;">
                				<p  style="margin-bottom: 1rem;"><?php echo $obs; ?></p>
                			</div>
                			<br>
                			<button class="btn btn-primary noprint" type="button" id="btn-imprimir" data-id="<?php echo $nroturno;?>">Imprimir</button>
                		</div>
        	        
        	    	</div>
        		
	    		</div>
	    	</div>
	    </div>
	   	
        
	</div>


<?php include 'footer.php'; ?>
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
