<?php

	include_once 'constants.php';
	include_once 'connect.php';
	include_once 'permissions.php';
	include_once 'password_compat-master/lib/password.php';

	// Now we check if the data from the login form was submitted, isset() will check if the data exists.
	if ( !isset($_POST['username'], $_POST['password']) ) {
		// Could not get the data that should have been sent.
		die ('Please fill both the username and password field!');
	}

	$redirectURL = isset($_GET['redirect']) ? BASE_URL.urldecode($_GET['redirect']) : BASE_URL;

	$stmt = buscarUsuario();

	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($IDPERSONA, $LEGAJO, $CLAVE, $APELLYNOMBRE);
		$stmt->fetch();
		$ok = password_verify($_POST['password'], $CLAVE);
		
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if ($ok OR $_POST['password'] == $CLAVE) {
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['NOMBREUSUARIO'] = $LEGAJO;
			$_SESSION['id'] = $IDPERSONA;
			$_SESSION['APELLYNOMBRE'] = $APELLYNOMBRE;
			$_SESSION['empleado'] = true;
			$_SESSION['empleado'] = true;
			$_SESSION['can-change-passwords'] = CanChangeUserPassword($LEGAJO);

			header('Location: '.$redirectURL);
		} else {
			header('Location: '.BASE_URL.'login-intranet.html?error=datos_incorrectos');
		}
	} else {
		header('Location: '.BASE_URL.'login-intranet.html?error=datos_incorrectos');
	}
	
	$stmt->close();

	function buscarUsuario() {
		global $con;

		$sql = "SELECT IDPERSONA, LEGAJO, CLAVE, APELLYNOMBRE
				FROM personas 
				WHERE LEGAJO = ?";
		$stmt = $con->prepare($sql);
		// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
		if ($stmt) {
			// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
			$stmt->bind_param("s", $_POST['username']);
			$stmt->execute();
			// Store the result so we can check if the account exists in the database.
			$stmt->store_result();
			
			return $stmt;
		} else {
			return false;
		}
	}

?>
