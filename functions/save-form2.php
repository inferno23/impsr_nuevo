<?php
include_once 'connect.php';
global $con;
$respuesta= new stdClass();

$nombre1=$_POST['nombre'];
$nombre=strtoupper($nombre1);
$ddjj='1';
$tipo=$_POST['tipo']??'0';
$presentar=$_POST['presentado'];
$cuit=$_POST['cuit'];
$fnac=$_POST['fnac'];
$fecha = new DateTime($fnac);
$fechanac = $fecha->format('d-m-Y');
$nacionalidad=$_POST['nacionalidad'];
$estadocivil=$_POST['estadocivil'];

$reside=$_POST['reside'];
$calle1 =$_POST['calle'];
$calle = strtoupper($calle1);
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
$obs=$_POST['obs'];
$pensionnombre1 =$_POST['nombrep'];
$pensionnombre = strtoupper($pensionnombre1);
$pensioncuit =$_POST['cuitp'];
$pensiontipo =$_POST['tipopension']??'';


$query="INSERT INTO `form_servicios`(`ddjj`, `tipo`, `nombre`, `doc`, `fnac`, `nacionalidad`, `estadocivil`, `reside`, `calle`, `altura`, `piso`, `dpto`, `cp`, `localidad`, `provincia`, `celular`, `email`) VALUES ('$ddjj','$tipo','$nombre','$cuit','$fnac','$nacionalidad','$estadocivil','$reside','$calle','$altura','$piso','$dpto','$cp','$localidad','$provincia','$celular','$email')";
$res=$con->query($query);
///echo $con->error.' '.$query;
if($res){
    $id=$con->insert_id;
    $query2="INSERT INTO `ddjj_pension`( `id_ddjj`, `nombre`,  `cuit`, `tipo`,`presentar`) VALUES ('$id','$pensionnombre','$pensioncuit','$pensiontipo','$presentar')";
    $res2=$con->query($query2);
  //  echo $con->error.' '.$query2;
    if($res2){
        $respuesta->success=true;
        $datos['nombre']=$nombre;
        $datos['tipo']=$tipo;
        $datos['doc']=$cuit;
        $datos['fnac']=$fechanac;
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
        $datos['pensionnombre']=$pensionnombre;
        $datos['pensioncuit']=$pensioncuit;
        $datos['pensiontipo']=$pensiontipo;
        $datos['presentado']=$presentar;
        $datos['obs']=$obs;
        $respuesta->datos=$datos;
        
    }
}

$respuesta->success=true;

echo json_encode($respuesta);