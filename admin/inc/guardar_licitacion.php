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
    $longitud = count($_FILES['archivos']['name']);
    $respuesta->longitud=$longitud;
    $erroresArchivos = [];
    if ($longitud>0) {
        for ($i = 0; $i < $longitud; $i++) {
            $nameold = $_FILES['archivos']['name'][$i];
            $filetype = $_FILES['archivos']['type'][$i];
            $extension = strtolower(pathinfo($nameold, PATHINFO_EXTENSION));
            if ($extension !== 'pdf' || $filetype !== 'application/pdf') {
                $erroresArchivos[] = "El archivo '" . $nameold . "' no es un PDF válido.";
                continue;
            }
            if(is_uploaded_file($_FILES['archivos']['tmp_name'][$i])) {
                $dir = '../../licitaciones/img/licitaciones';
                if (!is_dir($dir)) {
                    mkdir($dir, 0775, true);
                }
                $namev = str_replace(' ', '_', $nameold);
                $name = rand().'-'.$namev;
                $destino = "$dir/$name";
                if(move_uploaded_file($_FILES['archivos']['tmp_name'][$i], $destino)) {
                    $archivo = 'img/licitaciones/'.$name;
                    $query = "INSERT INTO `licitaciones_archivos`(`id_licitacion`, `archivo`) VALUES ('$id','$archivo')";
                    $resArchivo = $conectar->query($query);
                    if (!$resArchivo) {
                        $erroresArchivos[] = "Error al insertar archivo '$nameold' en la base de datos: " . $conectar->error;
                    }
                } else {
                    $erroresArchivos[] = "Error al mover el archivo '$nameold'. Código: " . $_FILES['archivos']['error'][$i];
                }
            } else {
                if ($_FILES['archivos']['error'][$i] != 0) {
                    $erroresArchivos[] = "Error al subir el archivo '$nameold'. Código: " . $_FILES['archivos']['error'][$i];
                }
            }
        }
        if (count($erroresArchivos) > 0) {
            $respuesta->success = false;
            $respuesta->error = implode("; ", $erroresArchivos);
        }
    }
}else{
    $respuesta->success=false;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>