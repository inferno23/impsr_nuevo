<?php
include 'functions/connect.php';
global $con;
$dir='recibos-sueldo/NUEVOCENTRO';
$id='25959';

$recibos= preg_grep('/^([^.])/', scandir($dir));
echo  count($recibos).' archivos <br>';
$con->query("DELETE * FROM recibos_centro2 ");
foreach ($recibos AS $valor){
    $pos=strpos($valor, '.');
    if($pos !== false){
        $nuevo=uniqid();
        $archivo=$dir.'/'.$nuevo;
        if (rename($dir.'/'.$valor, $dir.'/'.$nuevo)){
            $con->query("INSERT INTO `recibos_centro2`(`nombre`, `archivo`) VALUES ('$valor','$archivo')"); 
            echo $valor.' a '.$nuevo.'<br>';
        }
    }
    
}