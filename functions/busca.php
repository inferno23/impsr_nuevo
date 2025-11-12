<?php
    function buscarPensionado() {
		global $con;

		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, M.NROJUBILADO, M.NROPEN FROM personas P, causante C, municxper M
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
		} else {
			return false;
		}
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
		} else {
			return false;
		}
	}

	function buscarJubilado() {
		global $con;		
		$sql = "SELECT P.IDPERSONA, P.CLAVE, P.APELLYNOMBRE, M.NROJUBILADO, M.NROPEN 
				FROM personas P, municxper M
				WHERE (P.IDPERSONA = M.IDPERSONA AND M.NROJUBILADO = ?)";
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