<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc';
include '../inc/funciones.inc';
global $conectar;
$respuesta = new stdClass;
$columnas=$_POST['column'];
foreach ($columnas as $valor){
    
}
$cols=$_POST['col'];
$contador=0;
foreach ($cols as $valor){
    //print_r($valor);
    $idpersona=$valor[1];
    $nrojub=$valor[2];
    $nropen=$valor[3];
    $fechafall=$valor[4];
    $nroexp=$valor[5];
    $fechaalta=$valor[6];
    $fechavig=$valor[7];
    $fechacese=$valor[8];
    $diasimps=$valor[9];
    //echo $nropen.'<br>\n\r';
    if (($nropen>0) OR (!empty($nropen))) {
        $query1="SELECT * FROM `municxper` WHERE IDPERSONA='$idpersona' AND NROJUBILADO='$nrojub'";
        $res=$conectar->query($query1);
        
        $row=$res->fetch_assoc();
        if (($row['NROPEN']==0) OR (empty($row['NROPEN'])) ) {
            $query="UPDATE `municxper` SET `NROEXPTE`='$nroexp',`FECHAALTA`='$fechaalta',`FECHAVIG`='$fechavig',`FECHACESE`='$fechacese',`DIASIMPS`='$diasimps',`NROPEN`='$nropen',`FECHAFALLECJUB`='$fechafall' WHERE IDPERSONA='$idpersona' AND NROJUBILADO='$nrojub'";
            $res2=$conectar->query($query);
            if ($res2) {
                $contador++;
                $query2="UPDATE `personas` SET `MUERTO`='1',`FECHAFALLEC`='$fechafall' WHERE `IDPERSONA`='$idpersona'";
                $conectar->query($query2);
            }
            $respuesta->query[]=$query;
        }else{
            $respuesta->nropen[]='no existe';
        }
        
    }else{
        $respuesta->nropen[]='vacio '.$nropen;
    }
}
$respuesta->updates=$contador;


//print_r($_POST);
echo json_encode($respuesta, JSON_FORCE_OBJECT);
