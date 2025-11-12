<?php

function CanChangeUserPassword($legajo)
{
    global $con;

	$sql = "SELECT count(*) FROM `pass_reset_users` WHERE LEGAJO = ?";
	$stmt = $con->prepare($sql);
	// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
	if ($stmt) {
		$stmt->bind_param("s", $legajo);
		$stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($found);
        $stmt->fetch();
        return $found === 1;
	} else {
		return false;
	}
}