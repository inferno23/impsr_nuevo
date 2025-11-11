<?php
session_start();
header('Content-Type: application/json');
$respuesta = new stdClass;
global $conectar;
include '../conexion/conectar_hotel.inc.php';
function extension($filename){
    return substr(strrchr($filename, '.'), 1);
}
$id=$_POST['id'];
$nombre=$_POST['nombre'];

if (empty($id)){
    $query="INSERT INTO `habitacion_tipo`(`nombre`) VALUES ('$nombre')";
}else{
    $query="UPDATE `habitacion_tipo` SET nombre='$nombre' WHERE id='$id'";
}

$resultado=$conectar->query($query);
$respuesta->query=$query.' '.$conectar->error;
if ($resultado){
    $respuesta->success=true;
    if (empty($id)) {
        $id=$conectar->insert_id;
    }
    $longitud = count($_FILES['imagenes']['name']);
    if ($longitud>0) {
        for ($i = 0; $i < $longitud; $i++) {
            if(is_uploaded_file($_FILES['imagenes']['tmp_name'][$i]))
            {
                $dir='../../img/hotel';
                $nameold = $_FILES['imagenes']['name'][$i];
                $namev=str_replace(' ', '_', $nameold);
                $name = rand().'-'.$namev;
                if(move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], "$dir/$name"))
                {
                    $archivo='img/hotel/'.$name;
                    $query = "INSERT INTO `imagenes`(`id_habitacion`, `url`) VALUES ('$id','$archivo')";
                    $conectar->query($query);
                }else{
                    $respuesta->error2[]=$_FILES['imagenes']['error'][$i];
                }
                
                
            }
            $respuesta->error[]=$_FILES['imagenes']['error'][$i];
        }
    }     
}else{
    $respuesta->success=false;
}
echo json_encode($respuesta, JSON_FORCE_OBJECT);

?>