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
$desc=addslashes($_POST['desc']);
$fecha=$_POST['fecha'];
$activo=isset($_POST['activo'])?$_POST['activo']:'1';

if (empty($id)){
    $query="INSERT INTO `licitaciones`(`fecha`, `titulo`, `descripcion`, `activo`) VALUES ('$fecha','$titulo','$desc','$activo')";
}else{
    $query="UPDATE `licitaciones` SET `fecha`='$fecha',`titulo`='$titulo',`descripcion`='$desc',`activo`='$activo' WHERE id='$id'";
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
    //print_r($_FILES['archivos']);
    if ($longitud>0) {
        $respuesta->pasos[]='inicia';
        for ($i = 0; $i < $longitud; $i++) {
            $respuesta->pasos[]='empieza el primero'.$i;
            if(is_uploaded_file($_FILES['archivos']['tmp_name'][$i]))
            {
                $respuesta->errorup[]='existe';
                $dir='../../img/licitaciones';
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
}else{
    $respuesta->success=false;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>