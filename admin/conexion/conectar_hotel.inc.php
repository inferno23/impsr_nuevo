<?php 
// Configura los datos de tu cuenta
$hostname_conectar = "localhost";
$database_conectar = "hotel_db";
$username_conectar = "impsr";
$password_conectar = "QmFl&{zwl5}H";
global $conectar;
$conectar = new mysqli($hostname_conectar,$username_conectar, $password_conectar,$database_conectar);
if ($conectar->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conectar->connect_errno . ") " . $conectar->connect_error;
}
$conectar->set_charset('utf8');
?>