<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc.php';
global $conectar;

// === DIAGNÓSTICO INICIO ===
date_default_timezone_set('America/Argentina/Buenos_Aires');
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__.'/upload_bulk_diag.log'); // log junto al script

error_log("=== Start upload_bulk.php at ".date('Y-m-d H:i:s')." ===");
error_log("REQUEST_TIME_FLOAT=".($_SERVER['REQUEST_TIME_FLOAT'] ?? ''));
error_log("ini: max_execution_time=".ini_get('max_execution_time')
    .", max_input_time=".ini_get('max_input_time')
    .", memory_limit=".ini_get('memory_limit')
    .", upload_max_filesize=".ini_get('upload_max_filesize')
    .", post_max_size=".ini_get('post_max_size')
    .", max_file_uploads=".ini_get('max_file_uploads'));

$__t0 = microtime(true);

if (!isset($_FILES['bkArchivo'])) {
    error_log("No llegó \$_FILES['bkArchivo']");
} else {
    $n = is_array($_FILES['bkArchivo']['name']) ? count($_FILES['bkArchivo']['name']) : 0;
    error_log("FILES count=".$n);
    if ($n) {
        for ($__i=0; $__i<$n; $__i++){
            $e = (int)($_FILES['bkArchivo']['error'][$__i] ?? -1);
            $s = (int)($_FILES['bkArchivo']['size'][$__i] ?? -1);
            $nm= (string)($_FILES['bkArchivo']['name'][$__i] ?? '');
            error_log("File[$__i]: name='$nm' size=$s error=$e");
        }
    }
}

function diag_step($msg){
    error_log(sprintf("[+%0.3fs] %s", microtime(true) - $GLOBALS['__t0'], $msg));
}

register_shutdown_function(function() {
    $err = error_get_last();
    if ($err) {
        error_log("SHUTDOWN last_error: type={$err['type']} msg={$err['message']} file={$err['file']} line={$err['line']}");
    }
    error_log("=== End upload_bulk.php (shutdown) at ".date('Y-m-d H:i:s')." ===");
});
    // === DIAGNÓSTICO FIN ===
    
    $respuesta = new stdClass;
    
    function mes($mes) {
        switch ($mes){
            case 'Enero': return '01';
            case 'Febrero': return '02';
            case 'Marzo': return '03';
            case 'Abril': return '04';
            case 'Mayo': return '05';
            case 'Junio': return '06';
            case 'Julio': return '07';
            case 'Agosto': return '08';
            case 'Septiembre': return '09';
            case 'Octubre': return '10';
            case 'Noviembre': return '11';
            case 'Diciembre': return '12';
            case 'Primer Medio Aguinaldo': return '071';
            case 'Segundo Medio Aguinaldo': return '121';
            case 'Enero.pdf': return '01';
            case 'Febrero.pdf': return '02';
            case 'Marzo.pdf': return '03';
            case 'Abril.pdf': return '04';
            case 'Mayo.pdf': return '05';
            case 'Junio.pdf': return '06';
            case 'Julio.pdf': return '07';
            case 'Agosto.pdf': return '08';
            case 'Septiembre.pdf': return '09';
            case 'Octubre.pdf': return '10';
            case 'Noviembre.pdf': return '11';
            case 'Diciembre.pdf': return '12';
            case 'Primer Medio Aguinaldo.pdf': return '071';
            case 'Segundo Medio Aguinaldo.pdf': return '121';
        }
        return '00';
    }
    
    $dir_f='recibos-sueldo/empleados';
    $cant = isset($_FILES['bkArchivo']['tmp_name']) ? count($_FILES['bkArchivo']['tmp_name']) : 0;
    
    for ($i = 0; $i < $cant; $i++) {
        diag_step("Procesando índice $i");
        
        if(is_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i]))
        {
            $dir='../../recibos-sueldo/empleados';
            $valor=$_FILES['bkArchivo']['name'][$i];
            $val = explode(" - ", $valor);
            $valor=htmlentities($valor,ENT_QUOTES);
            
            $id=$val[1] ?? '';
            $nombre=$val[1].' - '.$val[2].' - '.$val[3];
            $ano=$val[2] ?? '';
            $exts=explode(".", $val[4] ?? '');
            $ext=$exts[1] ?? '';
            $mes=mes($val[3] ?? '');
            $nombre=addslashes(mb_convert_encoding($nombre, 'UTF-8'));
            

            $respuesta33= "--- Procesando archivo: $valor, id=$id, nombre=$nombre, ano=$ano, mes=$mes, ext=$ext\n";

error_log($val[3].$respuesta33);

            //echo json_encode($respuesta33, JSON_FORCE_OBJECT);
           // print_r($val);
            $arch=uniqid().($ext ? '.'.$ext : '');
            $archivo2=$dir.'/'.$arch;
            $archivo=$dir_f.'/'.$arch;
            $archivo=addslashes(mb_convert_encoding($archivo, 'UTF-8'));
            
            $query="SELECT * FROM personas WHERE APELLYNOMBRE LIKE '$id' AND LEGAJO!='0'";
            $res=$conectar->query($query);
            diag_step("Query personas: ".$query);
            
            if ($res && mysqli_num_rows($res)>0) {
                $row=mysqli_fetch_assoc($res);
                $idp=$row['IDPERSONA'];
                
                if(move_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i], "$archivo2"))
                {
                    diag_step("Archivo movido: $archivo2");
                    $query = "INSERT INTO `recibos`(`codigo`, `mes`, `ano`, `titulo`, `archivo`, `tipo`)
                          VALUES ('$idp','$mes','$ano','$nombre','$archivo','1')";
                    $respuesta->query[]=$query;
                    $res=$conectar->query($query);
                    if ($res) {
                        $respuesta->success[]=true;
                        $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' OK';
                    }else{
                        $respuesta->success[]=false;
                        $respuesta->error[]=$conectar->error;
                        $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' NO';
                        diag_step("Error insert: ".$conectar->error);
                    }
                }else{
                    $respuesta->success[]=false;
                    $respuesta->error[]=$_FILES['bkArchivo']['error'][$i];
                    $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' NO';
                    diag_step("Error move_uploaded_file");
                }
            }else{
                diag_step("No existe persona para id=".$id);
            }
        }else{
            $respuesta->success[]=false;
            $respuesta->error[]='archivo no subido';
            $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' NO';
            diag_step("is_uploaded_file() devolvió false");
        }
    }
    
    echo json_encode($respuesta, JSON_FORCE_OBJECT);
    