<?php
include_once 'connect.php';
global $con;


$selectedValue =  $_POST['selectedValue'];

$sql = "SELECT codpostal FROM localidad WHERE idlocalidad = '$selectedValue'";
$result = $con->query($sql);

// Guardas el resultado en la variable $row
$row = $result->fetch_assoc();

// Verifica si $row contiene un resultado antes de intentar acceder a sus datos
if($row) {
    // Imprime el contenido completo del registro para depuración
 
    // Ahora puedes acceder a los valores del registro sin problemas
    echo "<option>" . $row['codpostal'] . "</option>";
} else {
    // Si no se encontró ningún registro, puedes manejar el error aquí
    echo "<option value='-'></option>";

}

?>