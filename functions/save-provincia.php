<?php
include_once 'connect.php';
global $con;


$selectedValue = $_POST['selectedValue'];

$sql = "SELECT * FROM localidad WHERE idprovincia = '$selectedValue'";
$result = $con->query($sql);

$options = "<option value='0'>Seleccione...</option>";

while($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['idlocalidad'] . "'>" . $row['descripcion'] . "</option>";
}

echo $options;
?>
