<?php
include 'functions/connect.php';
$dir_f='recibos-sueldo/empleados';
$recibos = preg_grep('~\.(pdf)$~', scandir($dir_f));
global $con;
echo count($recibos);

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
$i=0;
foreach ($recibos AS $valor){
    //echo $valor.'<br>';
    $val = explode(" - ", $valor);
    $archivo=$dir_f.'/'.$valor;
    
    $archivo=addslashes(utf8_encode($archivo));
    $id=$val[1];
    $nombre=$val[1].' - '.$val[2].' - '.$val[3];
    $ano=$val[2];
    $meses=explode(".", $val[3]);
    $mes=mes($meses[0]);
    $nombre=addslashes(utf8_encode($nombre));
    //echo $archivo.' ** '.$nombre.' -- '.$id.' -- '.$ano.'<br>';
    $res=mysqli_query($con, "SELECT * FROM personas WHERE APELLYNOMBRE LIKE '$id' ");
    if (mysqli_num_rows($res)>0) {
        $i++;
        $row=mysqli_fetch_assoc($res);
        echo $i.' existe '.$row['IDPERSONA'].' -- '.$meses[0].$mes.'-'.$ano.'<br>';
        $idp=$row['IDPERSONA'];
        
        $query="INSERT INTO `recibos`(`codigo`, `mes`, `ano`, `titulo`, `archivo`) VALUES ('$idp','$mes','$ano','$nombre','$archivo')";
        $res=mysqli_query($con, $query);
        if ($res) {
                echo 'OK<br>';
        }else{
               echo mysqli_error($con).'<br>';
        }
    }else{
        echo 'no existe <br>';
    }
    //echo $id.' -- '.$nombre.'<br>';
    //$query="INSERT INTO `recibos`(`codigo`, `titulo`, `archivo`) VALUES ('$id','$nombre','$archivo')";
    //$res=mysqli_query($con, $query);
    //if ($res) {
    //    echo 'OK<br>';
    //}else{
    //    echo mysqli_error($con).'<br>';
    //}
    
}
echo 'Total '.$i;
