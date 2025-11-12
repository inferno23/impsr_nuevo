<?php
include 'functions/connect.php';

global $con;

$query="SELECT * FROM recibos";
$res=$con->query($query);

while ($row=$res->fetch_assoc()) {
    $archivo=$row['archivo'];
    $id=$row['id'];
    $arch=explode('/', $archivo);
    $pos=strpos($archivo, '.');
    $dir='';
    if($pos !== false){
        if (file_exists($archivo)) {
            $nuevo=uniqid();
            switch (count($arch)){
                case 2:
                    $dir=$arch[0].'/'.$nuevo;
                    break;
                case 3:
                    $dir=$arch[0].'/'.$arch[1].'/'.$nuevo;
                    break;
            }
            if(strlen($dir)>2){
                if (rename($archivo, $dir)){
                    $res2=$con->query("UPDATE `recibos` SET `archivo`='$dir' WHERE id='$id'");
                    if($res2){
                        echo 'Cambio OK '.$archivo.' a '.$dir.'<br>';
                    }else{
                        echo $con->error;
                    }
                }
            }
        }else{
            $con->query("DELETE FROM `recibos` WHERE id='$id'");
        }
        
    }else{
        echo 'no cambiar '.$archivo.'<br>';
    }
        
        
    
        
}

