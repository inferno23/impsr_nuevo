<?php
include_once 'connect.php';
global $con;
$respuesta= new stdClass();

$nombre=$_POST['nombre'];
$nacionalidad=$_POST['nacionalidad'];
$dni=$_POST['dni'];
$pais=$_POST['pais'];
$beneficio =$_POST['beneficio'];

$calle =$_POST['calle'];

$num_calle =$_POST['num_calle'];

$piso =$_POST['piso'];
$dpto =$_POST['dpto'];

$cp =$_POST['cp'];
$localidad =$_POST['localidad'];
$provincia =$_POST['provincia'];
$telefono =$_POST['telefono'];


$banco_exterior =$_POST['banco_exterior'];
$num_cuenta_ext=$_POST['num_cuenta_ext'];
$moneda_ext =$_POST['moneda_ext'];

$swift_beneficiario =$_POST['swift_beneficiario'];

$iban_euro =$_POST['iban_euro'];

$swift_intermediario =$_POST['swift_intermediario'];

$iban_intermediario=$_POST['iban_intermediario'];
$respuesta->success=true;

        $datos['nombre']=$nombre;
        $datos['nacionalidad']=$nacionalidad;
        $datos['dni']=$dni;
        $datos['pais']=$pais;
        $datos['beneficio']=$beneficio;           
        $datos['calle']=$calle;
        
        $datos['num_calle']=$num_calle;
       
        $datos['piso']=$piso;
        $datos['dpto']=$dpto;

        $datos['cp']=$cp;
        $datos['localidad']=$localidad;
        $datos['provincia']=$provincia;
        $datos['telefono']=$telefono;
        
  

        $datos['banco_exterior']=$banco_exterior;
        $datos['num_cuenta_ext']=$num_cuenta_ext;
        $datos['moneda_ext']=$moneda_ext;
     
        $datos['swift_beneficiario']=$swift_beneficiario;
  
        $datos['iban_euro']=$iban_euro;
      
        $datos['swift_intermediario']=$swift_intermediario;
        
        $datos['iban_intermediario']=$iban_intermediario;
        $respuesta->datos=$datos;
        

$respuesta->success=true;

echo json_encode($respuesta);