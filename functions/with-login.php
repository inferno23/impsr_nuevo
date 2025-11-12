<?php
	
	include_once 'constants.php';
	include_once 'connect.php';
	include_once 'password_compat-master/lib/password.php';

	// We need to use sessions, so you should always start sessions using the below code.
	// If the user is not logged in redirect to the login page...
	if (!isset($_SESSION['loggedin'])) {
		$urlArray = explode('/', $_SERVER['REQUEST_URI']);
		header('Location: login.html?redirect='.urlencode($urlArray[count($urlArray)-1]));
		exit();
	}
