<?php

	include_once 'constants.php';
	include_once 'connect.php';
	include_once 'password_compat-master/lib/password.php';

	if ( !isset($_POST['username'], $_POST['password'], $_POST['new_password'], $_POST['new_password_confirm']) ) {
		// Could not get the data that should have been sent.
		die ('Please fill both the username and password field!');
	}

	if ( $_POST['new_password'] !== $_POST['new_password_confirm'] ) {
		// Could not get the data that should have been sent.
		// die ('Please fill both the username and password field!');
		header('Location: '.BASE_URL.'login-recuperar.html?error=claves_diferentes');
	}

	$redirectURL = isset($_GET['redirect']) ? BASE_URL.urldecode($_GET['redirect']) : BASE_URL;

	$stmt = buscarPensionado();

	if (!$stmt->num_rows) {
		$stmt = buscarJubilado();
	}
	if (!$stmt->num_rows) {
		$stmt = buscarPersona();
	}
	
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($IDPERSONA, $CLAVE, $APELLYNOMBRE, $NROJUBILADO, $NROPEN);
		$stmt->fetch();

		$ok = password_verify($_POST['password'], $CLAVE);
		if ($ok OR $_POST['password'] == $CLAVE) {
			$stmt->close();
			$clave = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
			$stmt2 = $con->prepare("UPDATE personas SET CLAVE = ? WHERE IDPERSONA = ?");
			$stmt2->bind_param("ss", $clave, $IDPERSONA);
			$stmt2->execute();
			$stmt2->close();
    		header('Location: '.BASE_URL.'login-recuperar.html?update_password=success');
		} else {
			header('Location: '.BASE_URL.'login-recuperar.html?error=datos_incorrectos');
		}
	} else {
		// die($redirectURL.'?error='.urlencode('Datos incorrectos'));
		header('Location: '.BASE_URL.'login-recuperar.html?error=datos_incorrectos');
	}
	
	// $stmt->close();

	function buscarPensionado() {
		global $con;

		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, M.NROJUBILADO, M.NROPEN FROM personas P, causante C, municxper M
				WHERE (
					P.IDPERSONA = C.IDPERSONA
					AND C.IDPER = M.IDPERSONA
					AND M.NROPEN = ?
				)";

		$stmt = $con->prepare($sql);
		// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
		if ($stmt) {
			// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			// Store the result so we can check if the account exists in the database.
			$stmt->store_result();
			
			return $stmt;
		} else {
			return false;
		}
	}

	function buscarJubilado() {
		global $con;
		
		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, M.NROJUBILADO, M.NROPEN FROM personas P, municxper M
				WHERE (
					P.IDPERSONA = M.IDPERSONA
					AND M.NROJUBILADO = ?
				)";

		$stmt = $con->prepare($sql);
		// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
		if ($stmt) {
			// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			// Store the result so we can check if the account exists in the database.
			$stmt->store_result();
			
			return $stmt;
		} else {
			return false;
		}
	}

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

?>