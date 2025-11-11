<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
$query_rol = "SELECT a.*,b.APELLYNOMBRE usuario FROM fallecimiento_not  a LEFT JOIN PERSONAS b ON a.estado_usuario=b.IDPERSONA";

$roles = $conectar->query($query_rol);

echo $conectar->error;
?>
<script>
$(function() {
	$('#tablaroles').DataTable( {
		responsive: true,
        "language": {
            "url": "inc/esp.json"
        },
        responsive: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        
    });
	
    
	//nuevo
	$(document).on('click', '.validar', function(e) {
		e.preventDefault();
		if (!confirm("Esta seguro de que desea validar el registro?")) 
    		{	return false; }
    	else { 
    		var id= $(this).data('id');
    		$.post( "inc/estado_notificaciones.php",{ id:id}, function( data ) {	        
				if(data.success){
    				$('#centro').load('inc/lista_notificaciones.php');
				}
    		},'json');
    	}	
	});
    
    //		
});
</script>
<style>
<!--
/* controles imagen */
    .imagen{
        display: block;
        margin: 0 auto;
        min-width: 400px;
        height:300px;
        background-color: grey;
    }
    .imagen-div{
    	min-width: 400px;
    	margin: 0 auto;
    }
    .imagen-controles{
        position: absolute;
        top: 0;
        left: auto;
        bottom: auto;
        min-width: 400px;
        margin:0 auto;
        color: white;
        background-color: #007bff;
        opacity: 0;
        transition: opacity ease 400ms;
    }    
    .imagen-label{
    	margin:0px !important;
    }
    #imagen-cargada{
    	border: 1px solid #c2c2c2;
    }
    .imagen-controles:hover{
    	opacity:1;
    }
    .imagen-div:hover .imagen-controles{
    	opacity: 1;
    }
    .imagen-div img:hover .imagen-controles{
    	opacity: 1;
    }
    .imagen-controles .fa {
        margin: 5px;
        cursor: pointer;
    }
    .imagen-controles-ocultos{
    	display: none;
    }
    .imagen-controles-ocultos input[type="file"] {
        display: none;
    }
-->
</style>
<div class="row mb-2">
	<div class="col-6">
		<h6>Lista de Notificaciones</h6>
	</div>
	<div class="col-6">
		<div class="pull-right noprint btn-group">
        	<button type="button" id="imprimir" class="btn btn-sm btn-outline-dark" title="Imprimir"><i class="fa fa-print " aria-hidden="true"></i></button>
        </div>
	</div>
    
</div>
<div class="row">
	<div class="col-12">
    	<table class="table table-hover table-bordered table-sm display compact nowrap" id="tablaroles">
        	<thead class="thead-dark">
        	  	<tr>
        	  		<th>Nombre</th>
        	  		<th>DNI</th>
        	    	<th>Dirección</th>
        	    	<th>Pensionado/a</th>
        	    	<th>Nro</th>
        	    	<th>Fecha</th>
        	    	<th>Archivo</th>
        	    	<th>Validado</th>
        	    	<th class="noprint"></th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php 
        		while ($row_hc = $roles->fetch_assoc()) {
        			
        		?>
        		<tr>
        		    <td><?php echo $row_hc["nombre"];?></td>
        		    <td><?php echo $row_hc["dni"];?></td>
        			<td><?php echo $row_hc["direccion"];?></td>
        			<td><?php echo $row_hc['pensionado'];?></td>
        			<td><?php echo $row_hc["nro_pen"];?></td>
        			<td><?php echo $row_hc["fecha_fall"];?></td>
        			<td><a href="archivos/<?php echo $row_hc["certificado"];?>" download>Archivo</a></td>
        			<td><?php echo check($row_hc["estado"]);?> <?php if($row_hc['estado']=='1'){echo '('.$row_hc['usuario'].')';}?></td>
        			<td class="noprint btn-group">
        				<button class="btn btn-sm btn-warning validar" title="Validar" data-id="<?php echo $row_hc["id"];?>" ><i class="fas fa-toggle-on"></i></button>
        			</td>
        		</tr>
        	<?php } ?>
        	</tbody>
		</table>
	</div>	
</div>

