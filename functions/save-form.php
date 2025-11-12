<?php
include_once 'connect.php';
global $con;
$respuesta= new stdClass();


$nombre1=$_POST['nombre'];
$nombre=strtoupper($nombre1);
$ddjj='poder';
$tipo=$_POST['tipo']??'0';

$cuit=$_POST['cuit'];
$fnac=$_POST['fnac'];
$fnac2 = date("d-m-Y", strtotime($fnac));
$nacionalidad=$_POST['nacionalidad'];

$estadocivil=$_POST['estadocivil'];

$reside=$_POST['reside'];
$calle1 =$_POST['calle'];
$calle =strtoupper($calle1);
$altura =$_POST['altura'];
$piso =$_POST['piso'];
$dpto =$_POST['dpto'];
$cp =$_POST['cp'];
$localidad =$_POST['localidad'];
$query="SELECT descripcion FROM localidad WHERE idlocalidad = '$localidad' ";
$res=$con->query($query);
while($row = $res->fetch_assoc()) {
    $localidad = $row['descripcion'];
}
$provincia =$_POST['provincia'];
$query="SELECT descripcion FROM provincia WHERE idprovincia = '$provincia' ";
$res=$con->query($query);
while($row = $res->fetch_assoc()) {
    $provincia = $row['descripcion'];
}
//$telefono =$_POST['telefono'];
$celular =$_POST['celular'];
$email =$_POST['email'];
$beneficio=$_POST['beneficio']??'0';
$beneficiotipo =$_POST['beneficiotipo']??'';
$beneficionro =$_POST['beneficionro']??'';
$tramite=$_POST['tramite']??'0';
$tramitetipo =$_POST['tramitetipo'];
$tramitenro =$_POST['tramitenro'];
$apoderado1 =$_POST['apoderado'];
$apoderado = strtoupper($apoderado1);
$apocuit =$_POST['apoderadocuit'];
$aponacionalidad =$_POST['apoderadonacionalidad'];
if(empty($_POST['apoderadofnac'])){
    $apofnac='1970-01-01';
}else{
    $apofnac=$_POST['apoderadofnac'];
}
$apofnac2= date("d-m-Y", strtotime($apofnac));
$apoprof =$_POST['apoderadoprof'];
$apocalle1 =$_POST['apoderadocalle'];
$apocalle = strtoupper($apocalle1);
$apoaltura =$_POST['apoderadoaltura'];
$apopiso =$_POST['apoderadopiso'];
$apodpto =$_POST['apoderadodpto'];
$apocp =$_POST['apoderadocp'];
$apolocalidad =$_POST['apoderadolocalidad'];
$query="SELECT descripcion FROM localidad WHERE idlocalidad = '$apolocalidad' ";
$res=$con->query($query);
while($row = $res->fetch_assoc()) {
    $apolocalidad = $row['descripcion'];
}
$apoprovincia =$_POST['apoderadorprovincia'];
$query="SELECT descripcion FROM provincia WHERE idprovincia = '$apoprovincia' ";
$res=$con->query($query);
while($row = $res->fetch_assoc()) {
    $apoprovincia = $row['descripcion'];
}
$apocelular =$_POST['apoderadocelular'];
$apoemail =$_POST['apoderadoemail'];

$query="INSERT INTO `form_poder`(`ddjj`, `tipo`, `nombre`, `doc`, `fnac`, `nacionalidad`, `estadocivil`, `reside`, `calle`, `altura`, `piso`, `dpto`, `cp`, `localidad`, `provincia`, `celular`, `email`, `beneficio`, `beneficio_nro`, `tramite`, `tramite_nro`) VALUES ('$ddjj','$tipo','$nombre','$cuit','$fnac','$nacionalidad','$estadocivil','$reside','$calle','$altura','$piso','$dpto','$cp','$localidad','$provincia','$celular','$email','$beneficiotipo','$beneficionro','$tramitetipo','$tramitenro')";
$res=$con->query($query);
if($res){
    $id=$con->insert_id;
    $query2="INSERT INTO `form_poder_apoderados`( `id_ddjj`, `nombre`, `doc`, `fnac`, `nacionalidad`, `profesion`, `calle`, `altura`, `piso`, `dpto`, `cp`, `localidad`, `provincia`, `celular`, `email`) VALUES ('$id','$apoderado','$apocuit','$apofnac','$aponacionalidad','$apoprof','$apocalle','$apoaltura','$apopiso','$apodpto','$apocp','$apolocalidad','$apoprovincia','$apocelular','$apoemail')";
    $res2=$con->query($query2);
    if($res2){
        $respuesta->success=true;
        $datos['nombre']=$nombre;
        $datos['tipo']=$tipo;
        $datos['doc']=$cuit;
        $datos['fnac']=$fnac2;
        $datos['nac']=$nacionalidad;
        $datos['estado']=$estadocivil;
        $datos['reside']=$reside;
        $datos['calle']=$calle;
        $datos['altura']=$altura;
        $datos['piso']=$piso;
        $datos['dpto']=$dpto;
        $datos['cp']=$cp;
        $datos['localidad']=$localidad;
        $datos['provincia']=$provincia;
       // $datos['telefono']=$telefono;
        $datos['celular']=$celular;
        $datos['email']=$email;
        if($beneficio=='0'){
        $datos['beneficio']='';
        $datos['beneficionro']='';
        }else{
            $datos['beneficio']=$beneficiotipo;
            $datos['beneficionro']=$beneficionro;
        }
        if($tramite=='0'){
        $datos['tramite']='';
        $datos['tramitenro']='';
        }else{
            $datos['tramite']=$tramitetipo;
            $datos['tramitenro']=$tramitenro;
        }
        $datos['aponombre']=$apoderado;
        if($apoderado!=''){
            $datos['apodoc']=$apocuit;
            $datos['apofnac']=$apofnac2;
            $datos['aponac']=$aponacionalidad;
            $datos['apoprof']=$apoprof;
            $datos['apocalle']=$apocalle;
            $datos['apoaltura']=$apoaltura;
            $datos['apopiso']=$apopiso;
            $datos['apodpto']=$apodpto;
            $datos['apocp']=$apocp;
            $datos['apolocalidad']=$apolocalidad;
            $datos['apoprovincia']=$apoprovincia;
         
            $datos['apocelular']=$apocelular;
            $datos['apoemail']=$apoemail;
        }else{
            $datos['apodoc']='';
            $datos['apofnac']='';
            $datos['aponac']='';
            $datos['apoprof']='';
            $datos['apocalle']='';
            $datos['apoaltura']='';
            $datos['apopiso']='';
            $datos['apodpto']='';
            $datos['apocp']='';
            $datos['apolocalidad']='';
            $datos['apoprovincia']='';
            //$datos['apotelefono']='';
            $datos['apocelular']='';
            $datos['apoemail']='';
        }
        
        $respuesta->datos=$datos;
        
    }else{
        $respuesta->success=false;
        $respuesta->error=$con->error;
        $respuesta->query=$query2;
    }
}else{
    $respuesta->success=false;
    $respuesta->error=$con->error;
    $respuesta->query=$query;
}



echo json_encode($respuesta);