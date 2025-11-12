<?php
include_once 'connect.php';
global $con;
$respuesta= new stdClass();
//var_dump($_POST);

$nombre1=$_POST['nombre'];
$nombre =strtoupper($nombre1);
$tipo=$_POST['tipo'];
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




$conyuge1=$_POST["conyugenombre"];
$conyuge = strtoupper($conyuge1);
$conyugedni=$_POST["conyugedni"];
$conyugenacionalidad=$_POST["conyugenacionalidad"];
if($_POST['conyugefnac']!=''){
    $cfnac=$_POST["conyugefnac"];
    $fechac = new DateTime($cfnac);
    $conyugefnac = $fechac->format('d-m-Y');
}else{
    $conyugefnac='';
}
$conyugeestado=$_POST["conyugeestadocivil"];
if($_POST['conyugemat']!=''){
    $cfmat=$_POST["conyugemat"];
    $fecha = new DateTime($cfmat);
    $conyugefmat = $fecha->format('d-m-Y');
}else{
    $conyugefmat='';
}
$conyugeconvive=$_POST["conyugeconvive"];

if($_POST['conyugeconvivencia']!=''){
    $ccon=$_POST["conyugeconvivencia"];
    $fecha= new DateTime($ccon);
    $conyugeconvivencia=$fecha->format('d-m-Y');
}else{
    $conyugeconvivencia='';
}
$conyugecobertura=$_POST["conyugecobertura"];
$conyugeprevisional=$_POST["conyugeprevisional"];
$conyugetipo1=$_POST["conyugetipo"];
$conyugetipo = strtoupper($conyugetipo1);
$conyugecaja1=$_POST["conyugecaja"];
$conyugecaja= strtoupper($conyugecaja1);
$conyugetrabaja=$_POST["conyugetrabaja"];
$conyugeempleador1=$_POST["conyugeempleador"];
$conyugeempleador=strtoupper($conyugeempleador1);
$conyugeasignacion=$_POST["conyugeasignacion"];
$conyugehijos=$_POST["conyugehijos"];
$conyugeahijos=$_POST["conyugeahijos"];
$datosobservacion=$_POST["observacionesdatos"];
$descuentosin='';
$descuentocen='';
$manifiesto=1;
$otrobeneficio=$_POST["otrobeneficio"];
$otrotipo=$_POST["otrotipo"];
$otrocaja=$_POST["otroinstituto"];
$otronro=$_POST["otronro"];
$trabajaact=$_POST["trabajaactual"];
$publica=$_POST["publica"];
$privado=$_POST["privado"];
$privadocontinua=$_POST["continuara"];
$autonomo=$_POST["autonomo"];
$autonomocontinua=$_POST["continuaraautonomo"];
$simultaneo=$_POST["simultaneo"];
$otroobs=$_POST['otroobs'];

$sql = "INSERT INTO `form_jubilacion` (
    `nombre`, `tipo`, `cuit`, `fechanac`, `nacionalidad`, `estadocivil`, `reside`,
    `calle`, `altura`, `piso`, `dpto`, `cp`, `localidad`, `provincia`, `celular`, `email`,
    `conyuge_nombre`, `conyuge_dni`, `conyuge_nacionalidad`, `conyuge_fnac`, `conyuge_estado`, `conyuge_fmat`,
    `conyuge_convive`, `conyuge_convivencia`, `conyuge_cobertura`, `conyuge_previsional`, `conyuge_tipo`,
    `conyuge_caja`, `conyuge_trabaja`, `conyuge_empleador`, `conyuge_asignacion`, `conyuge_hijos`, `conyuge_ahijos`,
    `datos_observacion`, `descuentos_in`, `descuentos_cen`, `manifiesto`, `otro_beneficio`, `otro_tipo`, `otro_caja`,
    `otro_nro`, `trabaja_act`, `publica`, `privado`, `privado_continua`, `autonomo`, `autonomo_continua`,
    `simultaneo`, `otro_obs`
) VALUES (
    '$nombre', '$tipo', '$cuit', '$fechanac', '$nacionalidad', '$estadocivil', '$reside',
    '$calle', '$altura', '$piso', '$dpto', '$cp', '$localidad', '$provincia', '$celular', '$email',
    '$conyuge', '$conyugedni', '$conyugenacionalidad', '$conyugefnac', '$conyugeestado', '$conyugefmat',
    '$conyugeconvive', '$conyugeconvivencia', '$conyugecobertura', '$conyugeprevisional', '$conyugetipo',
    '$conyugecaja', '$conyugetrabaja', '$conyugeempleador', '$conyugeasignacion', '$conyugehijos', '$conyugeahijos',
    '$datosobservacion', '$descuentosin', '$descuentocen', '$manifiesto', '$otrobeneficio', '$otrotipo', '$otrocaja',
    '$otronro', '$trabajaact', '$publica', '$privado', '$privadocontinua', '$autonomo', '$autonomocontinua',
    '$simultaneo', '$otroobs'
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

$datos['celular']=$celular;
$datos['email']=$email;
$datos['reside']=$reside;
$datos['conyuge']=$conyuge;
$datos['conyugenacionalidad']=$conyugenacionalidad;
$datos['conyugedni']=$conyugedni;
$datos['conyugefnac']=$conyugefnac;
$datos['conyugeestado']=$conyugeestado;
$datos['conyugefmat']=$conyugefmat;
$datos['conyugeconvive']=$conyugeconvive;
$datos['conyugeconvivencia']=$conyugeconvivencia;
$datos['conyugecobertura']=$conyugecobertura;
$datos['conyugeprevisional']=$conyugeprevisional;
$datos['conyugetipo']=$conyugetipo;
$datos['conyugecaja']=$conyugecaja;
$datos['conyugetrabaja']=$conyugetrabaja;
$datos['conyugeempleados']=$conyugeempleador;
$datos['conyugeasignacion']=$conyugeasignacion;
$datos['conyugehijos']=$conyugehijos;
$datos['conyugeahijos']=$conyugeahijos;
$datos['obs']=$datosobservacion;
$datos['descuentosin']=$descuentosin;
$datos['descuentocen']=$descuentocen;
$datos['otrobeneficio']=$otrobeneficio;
$datos['otrotipo']=$otrotipo;
$datos['otrocaja']=$otrocaja;
$datos['otronro']=$otronro;
$datos['trabaja']=$trabajaact;
$datos['publica']=$publica;
$datos['privada']=$privado;
$datos['privadoc']=$privadocontinua;
$datos['autonomo']=$autonomo;
$datos['autonomoc']=$autonomocontinua;
$datos['simultaneo']=$simultaneo;
$datos['manifiesto']=$_POST['manifiesto'];
$datos['otroobs']=$otroobs;
$respuesta->datos=$datos;
$respuesta->success=true;
}
echo json_encode($respuesta);