<?php
session_start();
header('Content-Type: application/json');
$respuesta = new stdClass;
global $conectar;
include '../conexion/conectar.inc';
function extension($filename){
    return substr(strrchr($filename, '.'), 1);
}
$id=$_POST['id'];
$titulo=$_POST['titulo'];
$desc=addslashes($_POST['descripcion']);
$fecha=$_POST['fecha'];
$codigo=$_POST['codigo'];
$codigoano=$_POST['codigo_ano'];
$codigomes=$_POST['codigo_mes'];
$tipo=$_POST['id_tipo'];
$estado=$_POST['id_estado'];
$rep=$_POST['id_reparticion'];
$exp=$_POST['expediente'];
$apertura=$_POST['apertura'];
$presupuesto=$_POST['presupuesto'];
$pliego=$_POST['costo_pliego'];
$oferta=$_POST['costo_oferta'];
$impugnacion=$_POST['costo_impugnacion'];

$activo=isset($_POST['activo'])?$_POST['activo']:'1';

if (empty($id)){
    $query="INSERT INTO `licitaciones`(`apertura`,`expediente`,`presupuesto`,`costo_pliego`,`costo_oferta`,`costo_impugnacion`,`codigo`,`codigo_ano`,`codigo_mes`,`id_tipo`,`id_estado`,`id_reparticion`,`fecha`, `titulo`, `descripcion`, `activo`) VALUES 
('$apertura','$exp','$presupuesto','$pliego','$oferta','$impugnacion','$codigo','$codigoano','$codigomes','$tipo','$estado','$rep','$fecha','$titulo','$desc','$activo')";
}else{
    $query="UPDATE `licitaciones` SET `apertura`='$apertura',`expediente`='$exp',`presupuesto`='$presupuesto',`costo_pliego`='$pliego',`costo_oferta`='$oferta',`costo_impugnacion`='$impugnacion',`codigo`='$codigo',`codigo_ano`='$codigoano',`codigo_mes`='$codigomes',`id_tipo`='$tipo',`id_estado`='$estado',`id_reparticion`='$rep',`fecha`='$fecha',`titulo`='$titulo',`descripcion`='$desc',`activo`='$activo' WHERE id='$id'";
}
$resultado=$conectar->query($query);
//$respuesta->error=$conectar->error.'error inicial '.$query;
if ($resultado){
    $respuesta->success=true;
    if (empty($id)) {
        $id=$conectar->insert_id;
    }
    /*
    $longitud = count($_FILES['archivos']['name']);
    $respuesta->longitud=$longitud;
    //print_r($_FILES['archivos']);
    if ($longitud>0) {
        $respuesta->pasos[]='inicia';
        for ($i = 0; $i < $longitud; $i++) {
            $respuesta->pasos[]='empieza el primero'.$i;
            if(is_uploaded_file($_FILES['archivos']['tmp_name'][$i]))
            {
                $respuesta->errorup[]='existe';
                $dir='../../licitaciones/img/licitaciones';
                $nameold = $_FILES['archivos']['name'][$i];
                $namev=str_replace(' ', '_', $nameold);
                $name = rand().'-'.$namev;
                if(move_uploaded_file($_FILES['archivos']['tmp_name'][$i], "$dir/$name"))
                {
                    $archivo='img/licitaciones/'.$name;
                    $query = "INSERT INTO `licitaciones_archivos`(`id_licitacion`, `archivo`) VALUES ('$id','$archivo')";
                    $conectar->query($query);
                }else{
                    $respuesta->error2[]=$_FILES['archivos']['error'][$i];
                }
                
                
            }
            $respuesta->error[]=$_FILES['archivos']['error'][$i];
        }
    } 
        
    */
}else{
    $respuesta->success=false;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>