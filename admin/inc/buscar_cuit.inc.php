<?php
include 'funciones.inc';
$cuit=$_POST['cuil'];
if (empty($cuit)) {
	$cuit=$_GET['cuil'];
}
//echo 'CUIT BUSCADO: '.$cuit.'<br>';
$token=getToken();
echo $token;
$hoy=date('d-m-Y');
$resultado=getCuit($token,$cuit);
$respuesta=new stdClass();
$cuerpo='<div class="list-group">';
if (is_array($resultado)) {
	if (count($resultado)>0) {
		foreach ($resultado as $valor){
			//print_r($valor);
			$res=$valor->resultado;
			if (is_object($res)) {
				$act=' active '; 
			}else{
				$act=' ';
			}
			$cuerpo.='<div class="list-group-item list-group-item-action  flex-column align-items-start ">
	<div class="d-flex w-100 justify-content-between">
		<h2 style="font-size:1.2em;" class="mb-1">'.$valor->nombreOrganismo.'</h2>
		<small>'.$hoy.'</small>
	</div>';
			
			if (is_object($res)) {
				//print_r($res);
				$cuerpo.='<div class="mb-1">';
				$cuerpo.='<ul  class="list-group">';
				$cuerpo.='<li class="list-group-item">CUIL : '.$res->cuil.'</li>';
				$cuerpo.='<li class="list-group-item">'.tipoDoc($res->tipoDocumento).' : '.$res->numeroDocumento.'</li>';
				$cuerpo.='<li class="list-group-item">Apellido y Nombre : '.$res->apellidoNombres.'</li>';
				$cuerpo.='<li class="list-group-item">Sexo : '.$res->sexo.'</li>';
				$cuerpo.='<li class="list-group-item">Fecha de Nacimiento : '.$res->fechaNacimiento.'</li>';
				$cuerpo.='</ul>';
				$beneficios=$res->beneficios;
				
				foreach ($beneficios as $clave=>$bene){
					$cuerpo.='<table class="table table-bordered table-striped"><tbody>';
					$cuerpo.='<tr><td>'.tipoBene($bene->tipo).'</td><td>'.$bene->numero.'</td></tr>';
					$cuerpo.='<tr><td>Fecha Inicio</td><td>'.$bene->fechaInicio.'</td></tr>';
					$cuerpo.='<tr><td>Detalle Beneficio</td><td>'.tipoDeta($bene->detalleTipoBeneficio).'</td></tr>';
					$cuerpo.='<tr><td>Detalle Escalafon</td><td>'.tipoEs($bene->detalleEscalafon).'</td></tr>';
					$cuerpo.='<tr><td>Ultima Liquidacion</td><td>'.$bene->periodoUltimoLiquidado.'</td></tr>';
					$cuerpo.='</tbody></table></div>';
					//print_r($bene);
				}
			}else{
				$cuerpo.='<p class="mb-1">Sin Resultados</p>';
			}
			
			$cuerpo.='</div>';
			
			
			
		}
	}else{
		echo 'SIN RESULTADO';
	}
}else{
	echo 'SIN RESULTADO';
}
$cuerpo.='</div>';
echo $cuerpo;



?>
