<style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
        .calendar-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .calendar-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .calendar-header h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 600;
        }
        
        .calendar-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }
        
        .time-slot {
            border-bottom: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }
        
        .time-slot:last-child {
            border-bottom: none;
        }
        
        .time-slot:hover {
            background-color: #f8f9fa;
        }
        
        .time-slot.has-data {
            background-color: #d4edda; /* verde claro */
        }
        

       
        
        .time-slot.has-data:hover {
            background-color: #b7e4c7; /* verde más intenso al hover */
        }
        
        .time-column {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-right: 2px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            min-width: 100px;
        }
        
        .content-column {
            padding: 1rem;
        }
        
        .field-group {
            margin-bottom: 0.75rem;
        }
        
        .field-group:last-child {
            margin-bottom: 0;
        }
        
        .field-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        
        .field-value {
            color: #212529;
            padding: 0.5rem;
            background-color: white;
            border-radius: 4px;
            min-height: 38px;
            cursor: pointer;
        }
        
        .field-value.empty {
            color: #adb5bd;
            font-style: italic;
        }
        
        .has-data .field-value {
            background-color: rgba(255, 255, 255, 0.7);
        }
        
        .edit-mode .field-value {
            display: none;
        }
        
        .field-input {
            display: none;
        }
        
        .edit-mode .field-input {
            display: block;
        }
        
        .action-buttons {
            display: none;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }
        
        .edit-mode .action-buttons {
            display: flex;
        }
        
        @media (max-width: 768px) {
            .time-column {
                min-width: 80px;
                font-size: 0.875rem;
            }
            
            .calendar-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>

<?php 
session_start();
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;

if (isset($_GET['fecha'])) {
    $fecha=$_GET['fecha'];
}else{
    $fecha=date('d-m-Y');
}
$fechamas = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
$fechas = date ( 'd-m-Y' , $fechamas );
$fechamenos = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
$fechaa = date ( 'd-m-Y' , $fechamenos );
$fechai=date ( 'Y-m-d' , strtotime ( $fecha ) );

function get_nombre_dia($fech){
    $fechats = strtotime($fech); //pasamos a timestamp
    
    //el parametro w en la funcion date indica que queremos el dia de la semana
    //lo devuelve en numero 0 domingo, 1 lunes,....
    switch (date('w', $fechats)){
        case 0: return "Domingo"; break;
        case 1: return "Lunes"; break;
        case 2: return "Martes"; break;
        case 3: return "Miercoles"; break;
        case 4: return "Jueves"; break;
        case 5: return "Viernes"; break;
        case 6: return "Sabado"; break;
    }
}
$admin=0;
if (isset($_GET['admin'])) {
    $admin=$_GET['admin'];
}
$seccion=2;

if (isset($_GET['seccion'])) {
    $seccion=$_GET['seccion'];
}

if ($_SESSION['imps']['admin']=='1' || $admin=='1') {
    $sql="SELECT * FROM turnos_secciones";
}else{
    $seccion=$_SESSION['imps']['seccion'];
    $sql="SELECT * FROM turnos_secciones WHERE id='$seccion'";
     if ($seccion =='2' || $seccion=='3' || empty ($seccion)) {
       $seccion='2,3';
      $sql="SELECT * FROM turnos_secciones WHERE id IN ($seccion)";
    }
}
   // print_r ($_SESSION['imps']['seccion']);
//echo ($sql);
$sec=$conectar->query($sql);
$secnombre=array();

while ($row_sec=$sec->fetch_assoc()){
     // print_r($row_sec);
    $idsec=$row_sec['id'];
    $fraccion=$row_sec['fraccion'];
    $puestos=$row_sec['puestos'];
    $date = new DateTime($row_sec['hora_ini']);
    $inicio=$date->format('H:i');
    $date = new DateTime($row_sec['hora_fin']);
    $fin=$date->format('H:i');
    $secnombre[$idsec]=$row_sec['nombre'];
    
    $hora=$inicio;
    
    $minutoAnadir=$fraccion;
    $opcion[$idsec]='';
    while ($hora<$fin) {
        $idturno=str_replace(':','',$hora);
    $opcion[$idsec].='<div class="list-group-item list-group-item-action px-1 " id="'.$idsec.'grupo'.$idturno.'">';
    $opcion[$idsec].='<div class="row" style="margin-left:-5px;margin-right:-5px;" >';
    $opcion[$idsec].='<div class="col-1 border-right px-0 text-center" style="px-0"><span class="hora">'.$hora.'</span></div>';
    $opcion[$idsec].='<div class="col-11 turnos px-1" id="'.$idsec.'turno'.$idturno.'">';
    $opcion[$idsec].='<div class="row">';
    $opcion[$idsec].='<div class="col-5 border-right" id="'.$idsec.'nombre'.$idturno.'"><span class="empty-text">-</span></div>';
    $opcion[$idsec].='<div class="col-3 border-right" id="'.$idsec.'dni'.$idturno.'"><span class="empty-text">-</span></div>';
    $opcion[$idsec].='<div class="col-3 border-right" id="'.$idsec.'telefono'.$idturno.'"><span class="empty-text">-</span></div>';
    $opcion[$idsec].='</div>';
    $opcion[$idsec].='</div>';
    $opcion[$idsec].='</div>';
    $opcion[$idsec].='</div>';
        
        $segundos_horaInicial=strtotime($hora);
        $segundos_minutoAnadir=$minutoAnadir*60;
        $hora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
    }
}
//print_r($opcion);
///echo($fecha);
//getTurno($fecha);
?>


    
   <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .calendar-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .calendar-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .calendar-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
        }
        
        .calendar-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
        }
        
        .calendar-body {
            padding: 1.5rem;
        }
        
        .calendar-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .calendar-table thead th {
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .calendar-table tbody tr {
            border-bottom: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }
        
        .calendar-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .calendar-table tbody tr.has-data {
            background-color: #d4edda; /* verde claro */
        }
        
        .calendar-table tbody tr.has-data:hover {
            background-color: #b7e4c7; /* verde más intenso al hover */
        }
        
        .calendar-table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        .time-cell {
            font-weight: 600;
            color: #495057;
            white-space: nowrap;
            width: 120px;
        }
        
        .activity-cell {
            min-width: 250px;
        }
        
        .name-cell {
            min-width: 200px;
        }
        
        .dni-cell {
            min-width: 150px;
        }
        
        .data-text {
                        color: #155724;
                        font-weight: 600;
                        background-color: #eafbe7;
                        border: 1px solid #b7e4c7;
                        border-radius: 6px;
                        width: 100%;
                        height: 100%;
                        min-height: 8px;
                        min-width: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        padding: 0;
                        box-sizing: border-box;
                        box-shadow: 0 1px 4px rgba(40,167,69,0.07);
                        transition: background 0.2s, box-shadow 0.2s;
        }
        
        .empty-text {
            color: #adb5bd;
            font-style: italic;
        }
        
        @media (max-width: 768px) {
            .calendar-container {
                margin: 1rem;
                border-radius: 8px;
            }
            
            .calendar-header {
                padding: 1.5rem;
            }
            
            .calendar-header h1 {
                font-size: 1.5rem;
            }
            
            .calendar-body {
                padding: 0.5rem;
                overflow-x: auto;
            }
            
            .calendar-table {
                font-size: 0.875rem;
            }
            
            .calendar-table thead th,
            .calendar-table tbody td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
	<div class="container-fluid">
		<div class="row my-2">
            <div class="calendar-container">
        <div class="calendar-header">
            <h1>📅 Turnos del dia <?php echo get_nombre_dia($fecha);?></h1>
            <p> <?php echo $fechai;?> Registro  por hora</p>
        </div>
        
			
		</div>
		<div class="row">
		<?php 
		foreach ($opcion as $clave=>$valor){
		   
		
		?>
			<div class="col-12 col-sm-6 ml-auto mr-auto">
				<div class="card w-100">
        			<div class="card-body px-0"  id="div<?php echo $clave?>">
                         <h5 >Turnos <?php echo $secnombre[$clave]; ?></h5>
                         <div class="list-group mt-2">
        		  			<div class="list-group-item list-group-item-dark px-1 py-0">
        		  				<div class="row" style="margin-left:-5px;margin-right:-5px;" id="agenda<?php echo $clave;?>">
        		  					<thead>
                    <tr>
                        <th class="time-cell">Hora</th>
                        <th class="activity-cell">Actividad</th>
                        <th class="name-cell">Nombre</th>
                        <th class="dni-cell">DNI</th>
                    </tr>
                </thead>
            		  				
                				</div>
        		  			</div>
        		  			<?php echo $valor;?>
                        </div>
                        
        		  	</div>
        		  	<div class="cord-footer">
        		  		<button type="button" class="btn btn-outline-primary imprimirAgenda" data-div="#div<?php echo $clave; ?>" >Imprimir Agenda</button>
        		  	</div>
        		</div>
				
			</div>
			
		<?php } ?>	
			
		</div>    	
	</div>
	<!-- nuevo turno -->
    <div class="modal fade" id="modalTurno" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nuevo Turno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formTurno"  class="form-horizontal" action="inc/guardar_turno.php" method="POST">
          <div class="modal-body" >
              	
              	<div class="row mb-1">
              		<div class="input-group col-12">
              			<div class="input-group-prepend">
              				<span class="input-group-text">Diagnostico</span>
              			</div>
              			<select id="trat" name="tratamiento" class="form-control"></select>
              		</div>
              	</div>
              	<hr>
              	<div class="row mb-2">
              		<div class="input-group col-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Fecha</span>
                      </div>
                      <input type="date" class="form-control" name="fecha" id="turnofecha">
                    </div>
                    <div class="input-group col-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Hora</span>
                      </div>
                      <input type="time" step="900" min="08:00" max="17:00" class="form-control" name="hora" id="hora">
                    </div>
              	</div>	
              	
              	<div class="row mb-2">
              		<div class="input-group col-12">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Comentarios</span>
                      </div>
                      <textarea rows="3" class="form-control" name="comentarios" id="comentarios"></textarea>
                    </div>	
                </div>    	
            </div>
        	<div class="modal-footer">
        		<button type="submit" class="btn btn-primary">Guardar</button>
        		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        	</div>
            </form>
        </div>
      </div>
    </div>
    <!--  -->
<script>
    $(function(){
        var fecha=$('#fecha').val();
        getTurnos(fecha);

    	$('#fecha').change(function(e){
			e.preventDefault();
			var fecha=$(this).val();
			
			getTurnos(fecha);
        });

		$('.imprimirAgenda').click(function(e){
			e.preventDefault();
			var div=$(this).data('div');
			$(div).printThis({
				debug: false,  
			    loadCSS: "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css",
			    importStyle: true
			});
		});
    	
        $('#fechaAnt').click(function(e){
			e.preventDefault();
			var fecha=new Date($('#fecha').val());
			fecha.setDate(fecha.getDate() - 1);
			alert(fecha.getDate());
			alert(fecha);
			
        });
        $('#fechaPos').click(function(e){
			e.preventDefault();
			var fecha=new Date($('#fecha').val());
			fecha.setDate(fecha.getDate() + 1);
			alert(fecha);
			
        });
    });
    function getTurnosL(fecha){
        }
    function getTurnos(fecha){
        // Limpiar celdas de datos
            if (fecha === "" || fecha === null || fecha === undefined) {
  fecha = new Date(); // Asigna la fecha actual si está vacía
  fecha = fecha.toISOString().slice(0, 10);
}

console.log(fecha);

        $(".activity-cell span, .name-cell span, .dni-cell span").each(function(){
            $(this).text('-').removeClass('data-text').addClass('empty-text');
        });
        $(".calendar-table tbody tr").removeClass('has-data');
        $.post('inc/get_turnos.php',{fecha:fecha},function(data){
            console.log(data);
            if(data.success){
                $.each(data.turnos,function(index,turno){
                    $.each(turno,function(clave,valor){
                        var ids=valor.id_sec;
                        var telefono=valor.telefono;
                        var hora=valor.hora.replace(':','');
                        var idGrupo = '#'+ids+'grupo'+hora;
                        var idMotivo = '#'+ids+'motivo'+hora;
                        var idNombre = '#'+ids+'nombre'+hora;
                        var idDni = '#'+ids+'dni'+hora;
                        var idTelefono = '#'+ids+'telefono'+hora;
                        $(idGrupo).addClass('has-data');
                        $(idMotivo+'>span').text(valor.motivo+' - '+valor.tipo).removeClass('empty-text').addClass('data-text');
                        $(idNombre+'>span').text(valor.nombre).removeClass('empty-text').addClass('data-text');
                        $(idDni+'>span').text(valor.dni).removeClass('empty-text').addClass('data-text');
                        $(idTelefono+'>span').text(valor.telefono).removeClass('empty-text').addClass('data-text');
                    });
                });
            } else {
                var errorMsg = data.error || data.mensaje || 'Error al cargar los turnos.';
                mostrarErrorTurnos(errorMsg);
            }
        },'json').fail(function(jqXHR, textStatus, errorThrown){
            var errorMsg = 'Error de red: ' + textStatus + ' - ' + errorThrown;
            mostrarErrorTurnos(errorMsg);
        });

        // Función para mostrar el error en pantalla
        function mostrarErrorTurnos(msg) {
            var $errorDiv = $('#errorTurnos');
            if ($errorDiv.length === 0) {
                $('.calendar-container').prepend('<div id="errorTurnos" class="alert alert-danger" style="margin-bottom:12px;">'+msg+'</div>');
            } else {
                $errorDiv.text(msg).show();
            }
            setTimeout(function(){ $('#errorTurnos').fadeOut(); }, 5000);
        }
    }
    
    
    </script>    
		  	    