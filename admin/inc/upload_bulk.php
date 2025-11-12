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
$dir_f='recibos-sueldo/empleados';
$cant=count($_FILES['bkArchivo']['tmp_name']);
for ($i = 0; $i < $cant; $i++) {
    
    if(is_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i]))
    {
        $dir='../../recibos-sueldo/empleados';
        $valor=$_FILES['bkArchivo']['name'][$i];
        
        $val = explode(" - ", $valor);
        //print_r($val);
        $valor=htmlentities($valor,ENT_QUOTES);
        
        
        
        $id=$val[1];
        $nombre=$val[1].' - '.$val[2].' - '.$val[3];
        $ano=$val[2];
        $exts=explode(".", $val[4]);
        $ext=$exts[1];
        $mes=mes($val[3]);
        $nombre=addslashes(utf8_encode($nombre));
        //$arch=rand().$nombre.'.'.$ext;
        $arch=uniqid();
        $archivo2=$dir.'/'.$arch;
        $archivo=$dir_f.'/'.$arch;
        $archivo=addslashes(utf8_encode($archivo));
        $query="SELECT * FROM personas WHERE APELLYNOMBRE LIKE '$id' AND LEGAJO!='0'";
        $res=$conectar->query($query);
        echo $query;
        if (mysqli_num_rows($res)>0) {
            $row=mysqli_fetch_assoc($res);
            $idp=$row['IDPERSONA'];
            
            if(move_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i], "$archivo2"))
            {
                $query = "INSERT INTO `recibos`(`codigo`, `mes`, `ano`, `titulo`, `archivo`, `tipo`) VALUES ('$idp','$mes','$ano','$nombre','$archivo','1')";
                $respuesta->query[]=$query;
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
            echo 'no existe <br>';
        }
        
        
        
    }else{
        $respuesta->success[]=false;
        $respuesta->error[]='archivo no subido';
        $respuesta->res[]=$_FILES['bkArchivo']['name'][$i].' NO';
    }
    
    
}


echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>