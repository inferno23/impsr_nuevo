<?php
header('Content-Type: application/json');
	include_once 'constants.php';
	include_once 'connect.php';
	//include_once 'password_compat-master/lib/password.php';
	// var_dump(password_hash('2019', PASSWORD_BCRYPT));
$respuesta=new stdClass();
	if ( !isset($_POST['username'], $_POST['password']) ) {
		die ('Please fill both the username and password field!');
	}

	

	$stmt = buscarPensionado();
    $respuesta->tipo='pensionado';
	if (!$stmt->num_rows) {
		$stmt = buscarJubilado();
		$respuesta->tipo='jubilado';
	}

	if (!$stmt->num_rows) {
		$stmt = buscarGraciable();
		$respuesta->tipo='graciable';
	}

	if (!$stmt->num_rows) {
		$stmt = buscarPersona();
		$respuesta->tipo='persona';
	}


	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	//print_r($stmt);
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($IDPERSONA, $CLAVE, $APELLYNOMBRE, $NROJUBILADO, $NROPEN);
		$stmt->fetch();

		//var_dump(password_verify($_POST['password'], $CLAVE)); die();
		$ok = password_verify($_POST['password'], $CLAVE);

		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if ($ok OR $_POST['password'] == $CLAVE) {
			// Verification success! User has loggedin!
			// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['NOMBREUSUARIO'] = $_POST['username'];
			$_SESSION['id'] = $IDPERSONA;
			$_SESSION['APELLYNOMBRE'] = $APELLYNOMBRE;
			$_SESSION['tipo']=$respuesta->tipo;

			$respuesta->success=true;
			$respuesta->mensaje="Datos Correctos";
		} else {
			$respuesta->success=false;
			$respuesta->mensaje="Clave Incorrecta, intente de nuevo o comuniquese con soporte";
		}
	} else {
		$respuesta->success=false;
		$respuesta->mensaje="Usuario no existe o mal escrito";
	}
	
	$stmt->close();

	function buscarPersona() {
		global $con;

		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, P.APELLYNOMBRE, P.APELLYNOMBRE FROM personas P WHERE P.NRODOC = ?";

		$stmt = $con->prepare($sql);
		if ($stmt) {
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();			
			return $stmt;
		} else {
			return false;
		}
	}

	function buscarPensionado() {
		global $con;

		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, M.NROJUBILADO, M.NROPEN 
            FROM personas P, causante C, municxper M
				WHERE (
					P.IDPERSONA = C.IDPERSONA
					AND C.IDPER = M.IDPERSONA
					AND M.NROPEN = ?
				)";
		$stmt = $con->prepare($sql);
		if ($stmt) {
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();			
			return $stmt;
		} else { return false;	}
	}

	function buscarGraciable() {
		global $con;
		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, M.NROJUBILADO, M.NROPEN 
				FROM personas P, municxper M 
				WHERE ( P.IDPERSONA = M.IDPERSONA AND M.NROPEN = ?)";
		$stmt = $con->prepare($sql);
		if ($stmt) {
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();			
			return $stmt;
		} else { return false;	}
	}

	function buscarJubilado() {
		global $con;		
		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, M.NROJUBILADO, M.NROPEN 
				FROM personas P, municxper M
				WHERE P.IDPERSONA = M.IDPERSONA AND M.NROJUBILADO = ?";
		//echo $sql;
		$stmt = $con->prepare($sql);
		if ($stmt) {
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();			
			return $stmt;
		} else { return false;	}
	}
	echo json_encode($respuesta, JSON_FORCE_OBJECT);
?>
