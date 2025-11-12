<?php
include_once 'connect.php';
global $con;
$respuesta= new stdClass();



$selectedValue = $_POST['selectedValue'];
if($_POST['selectedValue'] == 'ARGENTINA'){
   $selected = 1;
}
if($selected == 1){
$sql = "SELECT * FROM provincia";
$result = $con->query($sql);

$options = "<option value='0'>Seleccione...</option>";

while($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['idprovincia'] . "'>" . $row['descripcion'] . "</option>";
}
}

echo $options;