<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
    $query = "SELECT a.* FROM personas a WHERE a.CLAVE=''  OR a.CLAVE IS NULL ";

$personas = $conectar->query($query);
$cant=$personas->num_rows;
echo $conectar->error;
?>
<script>
$(function() {
	
	//imprimir
	$('#imprimirPw').click(function(e){
		e.preventDefault();
		$('#listaPw').printThis();
	});
    //generar
	$('#generarPw').click(function(e){
		e.preventDefault();
		if (!confirm("Esta seguro de que desea Generar claves?")) 
    		{	return false; }
    	else { 
    		var id=$(this).data('id');
    		$.post("inc/generar_pw.php",function(data){
    			if (data.success){
    				$('#listaPw').html(data.tabla);
    				var doc = new jsPDF();
    			    // You can use html:
    			    var fecha=new Date();
    			    var ano=fecha.getFullYear();
    				var mes=( fecha.getMonth() + 1 );
    				var dia=fecha.getDate();
    				var hoy=dia+'/'+mes+'/'+ano; 
    			    doc.text(7, 10, "Lista de claves "+hoy);
    			    doc.autoTable({html: '#tablaPw'});
    			    doc.save('tablaclaves'+hoy+'.pdf');
    				alert('CLAVES GENERADAS Y GUARDADAS, PUEDE IMPRIMIR');
    			}
    		},'json');
    	}
	});	
			
});
</script>

<div class="container">
	<div class="row">
    	<div class="col-12 col-sm-8 ml-auto mr-auto">
        	<div class="card w-100">
              <div class="card-header">
                Generar Claves
              </div>
              <div class="card-body" id="listaPw">
                <h5 class="card-title">Usuarios sin clave</h5>
                <p class="card-text"><?php echo $cant;?></p>
                
              </div>
              <div class="card-footer text-muted text-center">
                  <button type="button" class="btn btn-lg btn-success px-4" title="Generar Passwords" id="generarPw"><i class="fab fa-keybase"></i></button>
                  <button type="button" class="btn btn-outline-secondary px-2" title="Imprimir Lista" id="imprimirPw"><i class="fas fa-print"></i></button>
              </div>
            </div>
    	</div>	
    </div>
</div>


