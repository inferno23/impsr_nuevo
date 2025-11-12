<?php
include_once 'connect.php';
global $con;
$respuesta= new stdClass();
//var_dump($_POST);
$manifiesto1=$_POST['manifiesto1'];
$manifiesto2=$_POST['manifiesto2'];
$manifiesto3=$_POST['manifiesto3'];
$nombre1=$_POST['nombre'];
$nombre = strtoupper($nombre1);
$tipo=$_POST['tipo'];
$fallece=$_POST['fallece'];
$cuit=$_POST['cuit'];
$fnac=$_POST['fnac'];
$fecha = new DateTime($fnac);
$fechanac = $fecha->format('d-m-Y');
$nacionalidad=$_POST['nacionalidad'];
$estadocivil=$_POST['estadocivil'];
$reside=$_POST['reside']??'NO';
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

$celular =$_POST['celular'];
$email =$_POST['email'];
$beneficio1=$_POST['beneficio1'];
 
$beneficiotipo=$_POST['beneficio1tipo'];
$beneficio1tipo=strtoupper($beneficiotipo);
$beneficiocaja=$_POST['beneficio1caja'];
$beneficio1caja=strtoupper($beneficiocaja);
$beneficionro=$_POST['beneficio1nro'];
$beneficio1nro=strtoupper($beneficionro);
$beneficio2=$_POST['beneficio2']??'';
$beneficio2tipo=$_POST['beneficio2tipo']??'';
$beneficio2caja=$_POST['beneficio2caja']??'';
$beneficio2nro=$_POST['beneficio2nro']??'';
$trabaja=$_POST['trabaja'];
$trabajanombre1=$_POST['trabajanombre'];
$trabajanombre=strtoupper($trabajanombre1);
$trabajaiapos=$_POST['trabajaiapos'];
$causante1=$_POST['causantenombre'];
$causante=strtoupper($causante1);
$causantedni=$_POST['causantedni'];
$causanteestado=$_POST['causanteestado'];
if($_POST['causantefecha']!=''){
    $causaf=$_POST["causantefecha"];
    $fechaca = new DateTime($causaf);
    $causantefecha = $fechaca->format('d-m-Y');
}else{
    $causantefecha='';
}
$causantelugar1=$_POST['causantelugar'];
$causantelugar =strtoupper($causantelugar1);
$causantenro1=$_POST['causantenrojub'];
$causantenro =strtoupper($causantenro1);
$causanteactivo1=$_POST['causanteactivo'];
$causanteactivo =strtoupper($causanteactivo1);

$causantetrabaja=$_POST["causantetrabaja"];
$obsdatos=$_POST["observacionesdatos"];
$tnombre1=$_POST['tutornombre'];
$tnombre=strtoupper($tnombre1);
$tdni=$_POST['tutordni'];
if($_POST['tutorfnac']!=''){
$tfnact=$_POST['tutorfnac'];
$fechatt = new DateTime($tfnact);
$tfechanac = $fechatt->format('d-m-Y');
}else{
    $tfechanac='';
}
$tnacionalidad=$_POST['tutornacionalidad'];
$tparentesco=$_POST['tutorparentesco'];
$tcalle1 =$_POST['tutorcalle'];
$tcalle =strtoupper($tcalle1);
$taltura =$_POST['tutoraltura'];
$tpiso =$_POST['tutorpiso'];
$tdpto =$_POST['tutordpto'];
$tcp =$_POST['tutorcp'];
$tlocalidad =$_POST['tutorlocalidad'];
$query="SELECT descripcion FROM localidad WHERE idlocalidad = '$tlocalidad' ";
$res=$con->query($query);
while($row = $res->fetch_assoc()) {
    $tlocalidad = $row['descripcion'];
}
$tprovincia =$_POST['provincia'];
$query="SELECT descripcion FROM provincia WHERE idprovincia = '$tprovincia' ";
$res=$con->query($query);
while($row = $res->fetch_assoc()) {
    $tprovincia = $row['descripcion'];
}

$tcelular =$_POST['tutorcelular'];
$temail =$_POST['tutoremail'];
$obsdetalle=$_POST["observacionesdetalle"];
$reconocimiento=$_POST["reconocimiento"];
$simultaneo=$_POST["simultaneo"];
$obsotro=$_POST['otroobs'];

$sql = "INSERT INTO `form_pension` (
    `nombre`, `tipo`, `fallece`, `cuit`, `fnac`, `nacionalidad`, `estadocivil`, `reside`, 
    `calle`, `altura`, `piso`, `dpto`, `cp`, `localidad`, `provincia`, `telefono`, `celular`, 
    `email`, `beneficio1`, `beneficio1tipo`, `beneficio1caja`, `beneficio1nro`, 
    `beneficio2`, `beneficio2tipo`, `beneficio2caja`, `beneficio2nro`, `trabaja`, 
    `trabajanombre`, `trabajaiapos`, `causante`, `causantedni`, `causanteestado`, 
    `causantefecha`, `causantelugar`, `causantenro`, `causanteactivo`, 
    `causantetrabaja`, `obsdatos`, `tnombre`, `tdni`, `tfechanac`, `tnacionalidad`, 
    `tparentesco`, `tcalle`, `taltura`, `tpiso`, `tdpto`, `tcp`, `tlocalidad`, `tprovincia`,`tcelular`, `temail`, `obsdetalle`, `reconocimiento`, `simultaneo`, `obsotro`) VALUES (
    '$nombre', '$tipo', '$fallece', '$cuit', '$fnac', '$nacionalidad', 
    '$estadocivil', '$reside', '$calle', '$altura', '$piso', '$dpto', '$cp', 
    '$localidad', '$provincia', '$telefono', '$celular', '$email', '$beneficio1', 
    '$beneficio1tipo', '$beneficio1caja', '$beneficio1nro', '$beneficio2', 
    '$beneficio2tipo', '$beneficio2caja', '$beneficio2nro', '$trabaja', 
    '$trabajanombre', '$trabajaiapos', '$causante', '$causantedni', 
    '$causanteestado', '$causantefecha', '$causantelugar', '$causantenro', 
    '$causanteactivo', '$causantetrabaja', '$obsdatos', '$tnombre', '$tdni', 
    '$tfechanac', '$tnacionalidad', '$tparentesco', '$tcalle', '$taltura', 
    '$tpiso', '$tdpto', '$tcp', '$tlocalidad', '$tprovincia', 
    '$tcelular', '$temail', '$obsdetalle', '$reconocimiento', '$simultaneo', '$obsotro'
)";
if ($con->query($sql) === TRUE) {
    $res->status = "success";
    $res->message = "Datos insertados correctamente";
} else {
    $res->status = "error";
    $res->message = "Error: " . $con->error;
}


if($res){
$respuesta->success=true;
$datos['nombre']=$nombre;
$datos['tipo']=$tipo;
$datos['fallece']=$fallece;
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
$datos['telefono']=$telefono;
$datos['celular']=$celular;
$datos['email']=$email;
$datos['tnombre']=$tnombre;
$datos['tdni']=$tdni;
$datos['tfnac']=$tfechanac;
$datos['tnac']=$tnacionalidad;
$datos['tcalle']=$tcalle;
$datos['taltura']=$taltura;
$datos['tpiso']=$tpiso;
$datos['tdpto']=$tdpto;
$datos['tcp']=$tcp;
$datos['tlocalidad']=$tlocalidad;
$datos['tprovincia']=$tprovincia;
$datos['ttelefono']=$ttelefono;
$datos['tcelular']=$tcelular;
$datos['temail']=$temail;
$datos['tparentesco']=$tparentesco;
$datos['beneficio1']=$beneficio1;
$datos['beneficio1caja']=$beneficio1caja;
$datos['beneficio1nro']=$beneficio1nro;
$datos['beneficio1tipo']=$beneficio1tipo;
$datos['beneficio2']=$beneficio2;
$datos['beneficio2caja']=$beneficio2caja;
$datos['beneficio2nro']=$beneficio2nro;
$datos['beneficio2tipo']=$beneficio2tipo;
$datos['trabaja']=$trabaja;
$datos['trabajaiapos']=$trabajaiapos;
$datos['trabajanombre']=$trabajanombre;
$datos['obsdetalle']=$obsdetalle;
$datos['causante']=$causante;
$datos['causanteactivo']=$causanteactivo;
$datos['causantedni']=$causantedni;
$datos['causanteestado']=$causanteestado;
$datos['causantefecha']=$causantefecha;
$datos['causantelugar']=$causantelugar;
$datos['causantenro']=$causantenro;
$datos['causantetrabaja']=$causantetrabaja;
$datos['reconocimiento']=$reconocimiento;
$datos['simultaneo']=$simultaneo;
$datos['obsdatos']=$obsdatos;
$datos['obsotro']=$obsotro;
$datos['manifiesto1'] = $manifiesto1;
$datos['manifiesto2'] = $manifiesto2;
$datos['manifiesto3'] = $manifiesto3;
$respuesta->datos=$datos;
$respuesta->success=true;
}
echo json_encode($respuesta);