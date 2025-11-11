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
    $idpersona=$valor[1];
    $nrojub=$valor[6];
    $nropen=$valor[18];
    $fechafall=$valor[38];
    if (($nropen>0) OR (!empty($nropen))) {
        $res=$conectar->query("SELECT * FROM `municxper` WHERE IDPERSONA='$idpersona' AND NROJUBILADO='$nrojub'" );
        
        $row=$res->fetch_assoc();
        if (($row['NROPEN']==0) OR (empty($row['NROPEN'])) ) {
            $query="UPDATE `municxper` SET `NROPEN`='$nropen',`FECHAFALLECJUB`='$fechafall' WHERE IDPERSONA='$idpersona' AND NROJUBILADO='$nrojub'";
            $res2=$conectar->query($query);
            if ($res2) {
                $contador++;
                $query2="UPDATE `personas` SET `MUERTO`='1',`FECHAFALLEC`='$fechafall' WHERE `IDPERSONA`='$idpersona'";
                $conectar->query($query2);
            }
            $respuesta->query[]=$query;
        }
        
    }
}
$respuesta->updates=$contador;


//print_r($_POST);
echo json_encode($respuesta, JSON_FORCE_OBJECT);
