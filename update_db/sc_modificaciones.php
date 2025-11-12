<?php
echo "Modificaciones de Datos Personales" . "\n";
$mysqli = new mysqli("localhost", "impsr_root", "BvCZRvJ4A3av", "impsr_impsr");

//Verificar la conexión
if (mysqli_connect_errno()) {
    printf("Conexión Fallida: %s\n", mysqli_connect_error());
    exit();
}

$fecha = date('Y-m-j');
$fecha_ayer = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
$fecha_ayer = date ( 'Y-m-j' , $fecha_ayer );
//echo "fecha Nueva: " . $fecha_ayer . "<br>";

$nombre_archivo = "modificaciones.txt";
//Si existe borrar el archivo
if (file_exists($nombre_archivo)) {
	unlink($nombre_archivo);
}

$consulta = "SELECT idpersona, domicilio, telefono, celular, mail FROM personas where date(actualiza) = " . "'" . $fecha_ayer . "'";

if ($resultado = $mysqli->query($consulta)) {
$row_cnt = mysqli_num_rows($resultado);
    $archivo = fopen($nombre_archivo, "a");
if ($row_cnt > 0){
    //$archivo = fopen($nombre_archivo, "a");
    //Obtener el array asociativo
    while ($fila = mysqli_fetch_row($resultado)) {
		//echo $fila[0] . "  " . $fila[1] . "  " . $fila[2] . "  " . $fila[3] . "  " . $fila[4];
		//echo "<br>";
		//Escribir en el archivo
		fwrite($archivo, $fila[0]. "\t" . $fila[1] . "\t" . $fila[2]  . "\t" . $fila[3]  . "\t" . $fila[4] . "\n");

    }
	fclose($archivo);
}else{
	fwrite($archivo, "Modificaciones de Datos Personales" . "\n" . "No existen registros");
	fclose($archivo);
}	
	//Liberar el conjunto de resultados 
    mysqli_free_result($resultado);
}

echo "Cantidad de filas " . $row_cnt;

//Cerrar la conexión 
$mysqli->close();
?>
