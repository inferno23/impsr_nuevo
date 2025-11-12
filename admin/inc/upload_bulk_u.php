<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc';
$respuesta = new stdClass;
global $conectar;

$dir_f='ultimos';
$cant=count($_FILES['bkArchivo']['tmp_name']);
for ($i = 0; $i < $cant; $i++) {
    
    if(is_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i]))
    {
        $dir='../../ultimos';
        $valor=$_FILES['bkArchivo']['name'][$i];
        $exts=explode(".", $valor);
        $ext=$exts[1];
        $idpersona=$exts[0];
        $arch=uniqid();
        $archivo2=$dir.'/'.$arch;
        $archivo=$dir_f.'/'.$arch;
        $query="SELECT * FROM personas WHERE IDPERSONA='$idpersona'";
        $res=$conectar->query($query);
        if (mysqli_num_rows($res)>0) {
            $row=mysqli_fetch_assoc($res);
            $idp=$row['IDPERSONA'];
            
            if(move_uploaded_file($_FILES['bkArchivo']['tmp_name'][$i], "$archivo2"))
            {
                $conectar->query("DELETE FROM `ultimosrecibos` WHERE `idpersona`='$idpersona'");
                $query = "INSERT INTO `ultimosrecibos`(`idpersona`, `archivo`) VALUES ('$idpersona','$archivo')";
                $res=$conectar->query($query);
			$respuesta->query[]=$query;
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