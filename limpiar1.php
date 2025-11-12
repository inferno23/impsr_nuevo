<?php
$dir='recibos-sueldo';
$i=0;
$b=0;
$recibos= preg_grep('/^([^.])/', scandir($dir));
echo  count($recibos).' archivos en '.$dir.'<br>';
foreach ($recibos AS $valor){
    $pos=strpos($valor, '.');
    if($pos !== false){
        
        $i++;
        if(unlink($dir.'/'.$valor)){
            $b++;
        }
    }
    
}
echo 'a borrar '.$i.'<br>';
echo 'borrados '.$b.'<br>';

$dir='recibos-sueldo/empleados';
$i=0;
$b=0;
$recibos= preg_grep('/^([^.])/', scandir($dir));
echo  count($recibos).' archivos en '.$dir.'<br>';
foreach ($recibos AS $valor){
    $pos=strpos($valor, '-');
    echo $valor.'<br>';
    if($pos !== false){
        
        $i++;
        if(unlink($dir.'/'.$valor)){
            $b++;
        }
    }
    
}
echo 'a borrar '.$i.'<br>';
echo 'borrados '.$b.'<br>';