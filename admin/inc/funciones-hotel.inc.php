<?php
include __dir__.'/../conexion/conectar_hotel.inc.php';

function estado($status){
    switch ($status){
        case '0':
            return 'Sin Confirmar';
            break;
        case '1':
            return 'Confirmada/reservada';
            break;
    }
}
function generarCodigoReserva(){
    global $conectar;
    $correct=false;
    while ($correct==false) {
        $key=generarCodigo(8);
        $res=$conectar->query("SELECT * FROM reservas WHERE codigo='$key'");
        if($res->num_rows>0){
            $correct=false;
        }else{
            $correct=true;
        }
    }
    return $key;
    
}
function generarCodigo($longitud) {
    
    $key = '';
    $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    
    return $key;
}   
function guardar_reserva($idroom,$cliente,$fin,$fout,$monto,$status=0){
    global $conectar;
    $respuesta=new stdClass();
    $codigo=generarCodigoReserva();
    $query="INSERT INTO `reservas` (`codigo`,`id_habitacion`, `id_pasajero`, `fecha_in`, `fecha_out`, `monto`, `status`) VALUES ('$codigo','$idroom','$cliente','$fin','$fout','$monto','$status')";
    $res=$conectar->query($query);
    //echo $query.$conectar->error;
    if($res){
        $respuesta->success=true;
        $respuesta->id=$conectar->insert_id;
        $respuesta->codigo=$codigo;
    }else{
        $respuesta->success=false;
        $respuesta->error=$conectar->error;
    }
    return $respuesta;
}
function confirmar_reserva($id,$codigo){
    global $conectar;
    $respuesta=new stdClass();
    $query="UPDATE `reservas` SET `status`='1' WHERE id='$id' AND codigo='$codigo'";
    $res=$conectar->query($query);
    if($res){
        $respuesta->success=true;
    }else{
        $respuesta->success=false;
    }
    return $respuesta;
}
function cancelar_reserva($id,$codigo){
    global $conectar;
    $respuesta=new stdClass();
    $query="DELETE FROM `reservas` WHERE id='$id' AND codigo='$codigo'";
    $res=$conectar->query($query);
    if($res){
        $respuesta->success=true;
    }else{
        $respuesta->success=false;
    }
    return $respuesta;
}
function buscar_reserva($pax,$in,$out) {
    global $conectar;
    $respuesta=new stdClass();
    $fechain=new DateTime($in);
    $fechaout=new DateTime($out);
    $dias = $fechain->diff($fechaout);
    $hab=$conectar->query("SELECT h.*,ht.nombre as tipo FROM `habitacion` h LEFT JOIN habitacion_tipo ht ON h.id_tipo=ht.id WHERE h.maxpax>='$pax'");
    while ($row=$hab->fetch_assoc()) {
        $idroom=$row['id'];
        $item['id']=(int)$idroom;
        $item['pax']=$pax;
        $item['dias']=$dias->days;
        $item['tipo']=$row['tipo'];
        $item['tipoId']=$row['id_tipo'];
        $item['habitacion']=$row['nombre'];
        $item['precio']=(float)$row['precio'];
        $query2="SELECT * FROM `reservas` WHERE (('$in'>=fecha_in AND '$in'<=fecha_out ) OR ('$out'>=fecha_in AND '$out'<=fecha_out) OR (fecha_in>='$in' AND fecha_in<='$out' )) AND id_habitacion='$idroom' ";
        $res=$conectar->query($query2);
        if ($res->num_rows>0) {
            $row2=$res->fetch_assoc();
            if($row2['status']=='0'){
                $item['status']='Sin Confirmar';
            }elseif ($row2['status']=='1'){
                $item['status']='Confirmada/reservada';
            }
            $item['statusId']=1;
        }else{
            $item['statusId']=0;
            $item['status']='Disponible';
        }
        $respuesta->dias=$dias->days;
        $respuesta->fechain=$in;
        $respuesta->fechaout=$out;
        $respuesta->pax=$pax;
        $respuesta->habitacion[]=$item;
    }
    return $respuesta;
}

function buscar_cliente($nombre,$doc,$telefono,$email){
    global $conectar;
    $query="SELECT * FROM clientes WHERE doc='$doc'";
    $res=$conectar->query($query);
    if($res->num_rows>0){
        $row=$res->fetch_assoc();
        return $row['id'];
    }else{
        $res2=$conectar->query("INSERT INTO `clientes`(`nombre`, `doc`, `telefono`, `email`) VALUES ('$nombre','$doc','$telefono','$email')");
        if($res2){
            return $conectar->insert_id;
        }else{
            return false;
        }
    }
}
