
<?php 
require_once '../functions/constants.php';
require_once '../functions/connect.php';
require_once '../functions/password_compat-master/lib/password.php';
require_once '../functions/generate_password.php';


$sql_cuantos = "SELECT IDPERSONA FROM personas WHERE CLAVE = '' OR CLAVE IS NULL";
$query_cuantos = $con->query($sql_cuantos);

echo $query_cuantos->num_rows.' registros sin clave';
echo '<hr>';

$sql = "SELECT IDPERSONA, NRODOC FROM personas WHERE CLAVE = '' OR CLAVE IS NULL LIMIT 1000";
// var_dump($sql);

if ($result = $con->query($sql)) {
    while ($fila = $result->fetch_assoc()) {
			$new_password = generate_random_password(8);
			$clave = password_hash($new_password, PASSWORD_BCRYPT);
			//$clave = $new_password;
	    	$sql_update = "UPDATE personas SET CLAVE = '{$new_password}' 
	    			 WHERE IDPERSONA = '".$fila['IDPERSONA']."'";
			// echo '<pre>';
			// var_dump($sql_update);
			// echo '</pre>';	    			 

	    	$con->query($sql_update);
	    	if ($con->affected_rows) {
            	 echo '<pre>';
                echo "{$fila['IDPERSONA']},{$fila['NRODOC']},$new_password\n ";
            	 echo '</pre>';
            }
    }
    /* liberar el conjunto de resultados */
    $result->close();
}

?>