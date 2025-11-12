<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc';
$respuesta = new stdClass;
global $conectar;
function mes($mes) {
    switch ($mes){
        case 'Enero':
            return '01';
            break;
        case 'Febrero':
            return '02';
            break;
        case 'Marzo':
            return '03';
            break;
        case 'Abril':
            return '04';
            break;
        case 'Mayo':
            return '05';
            break;
        case 'Junio':
            return '06';
            break;
        case 'Julio':
            return '07';
            break;
        case 'Agosto':
            return '08';
            break;
        case 'Septiembre':
            return '09';
            break;
        case 'Octubre':
            return '10';
            break;
        case 'Noviembre':
            return '11';
            break;
        case 'Diciembre':
            return '12';
            break;
        case 'Primer Medio Aguinaldo';
        return '071';
        break;
        case 'Segundo Medio Aguinaldo';
        return '121';
        break;
    }
}
$dir_f='recibos-sueldo';
$cant=count($_FILES['bkArchivo']['tmp_name']);
for ($i = 0; $i < $cant; $i++) {
    
    if(is_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i]))
    {
        $dir='../../recibos-sueldo';
        $valor=$_FILES['bkArchivo']['name'][$i];
        
        $val = explode(" - ", $valor);
        $id=$val[0];
        $exts=explode(".", $val[4]);
        $ext=$exts[1];
        $ano=$val[2];
        $meses=explode(".", $val[3]);
        $mes=mes($meses[0]);
        
        $nombre=$val[1].' - '.$val[2].' - '.$val[3];
        $nombre=addslashes(utf8_encode($nombre));
        
        //$arch=rand().$nombre.'.'.$ext;
        $arch=uniqid();
        $archivo=$dir_f.'/'.$arch;
        $archivo2=$dir.'/'.$arch;
        $archivo=addslashes(utf8_encode($archivo));
        //echo $valor.'<br>';
        
        
        
        
            
            if(move_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i], "$archivo2"))
            {
                $query = "INSERT INTO `recibos`(`codigo`, `mes`, `ano`, `titulo`, `archivo`, `tipo`) VALUES ('$id','$mes','$ano','$nombre','$archivo','0')";
                $res=$conectar->query($query);
                if ($res) {
                    $respuesta->success[]=true;
                    $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' OK';
                }else{
                    $respuesta->success[]=false;
                    $respuesta->error[]=$conectar->error;
                    $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' NO';
                }
            }else{
                $respuesta->success[]=false;
                $respuesta->error[]=$_FILES['bkArchivos']['error'][$i];
                $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' NO';
            }
            
        
        
        
        
    }else{
        $respuesta->success[]=false;
        $respuesta->error[]='archivo no subido';
        $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' NO';
    }
    
    
}


echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>