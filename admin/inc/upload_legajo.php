<?php
session_start();
header('Content-Type: application/json');
include '../conexion/conectar.inc';
$respuesta = new stdClass;
global $conectar;
print_r($_POST);

?>