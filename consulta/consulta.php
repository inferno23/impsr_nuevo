<?php
ini_set("log_errors", 1);
ini_set("error_log", "error.log");
require_once("RcivilWs.php");
       ini_set("soap.wsdl_cache_enabled", "0");
        //----------------------------------------------------------------------
		$web_url = "https://aswe.santafe.gov.ar/proxy.php/MJYDDHH/externodefuncion";
		$user = "uExternoInstPrevRos";
		$web_cla= "G3P6P5WDzQ@hS5-";
		$debug="?XDEBUG_SESSION_START=17477";
		//$debug="";
		try{
        $ws =  new RcivilWs($web_url ."?wsdl", array(
            'username' => $user,
            'Version' => SOAP_1_2,
            'password' => $web_cla,
            'uri' => "urn:rcDigitalSalud",
            "location" => $web_url.$debug
        ));
		}catch (\Exception $e ) {
            //----------------------------------------------------------------------------------------------------------
		echo  $e->getMessage();
            //----------------------------------------------------------------------------------------------------------
        }

        //Recibimos por post los datos de sexo y numerodoc
        $sexo = $_POST["sexo"];

        $numerodoc = $_POST["numerodoc"];

        //exit(var_dump($sexo));
        //Se pasan los datos recibidos a la consulta
		$data = array(
		);
		try{
			$data = array(
				"sexo"=>$sexo,
				"documento"=>$numerodoc
			);
			$r = $ws->__soapCall("consultaDefuncionesPorSexoDocumento", $data) ;
			$success = $r->success;
			//-----------------------------------------------------------------------------------------------------------------------------------------------
		}catch (\Exception $e ) {
            //----------------------------------------------------------------------------------------------------------
			echo  $e->getMessage();
            //----------------------------------------------------------------------------------------------------------
        }		
		
		if($success){

			$consulta = json_decode($r->data);
			$datos = $consulta[0];
			
			$mensaje ='<p>El resultado de la consulta es <br>';
			$mensaje .= 'Estado: Fallecido <br>';
			$mensaje .= 'Doc: '.$datos->doc.'<br>';
			$mensaje .= 'Apellido: '.$datos->ape.'<br>';
			$mensaje .= 'Nombre: '.$datos->nom.'<br>';
			$mensaje .= 'Fecha fall.: '.$datos->fecha.'<br>';
			$mensaje .= 'Fecha carga: '.$datos->fcarga.'<br>';
			$mensaje .= 'Acta : '.$datos->ofi.'-'.$datos->anio.'-'.$datos->nro.'-'.$datos->letra.'</p>';


		}else{
			$mensaje = '<p>La consulta no encuentra resultados</p>';
		}

		echo $mensaje;
 
