<?php
session_start();
$emp=$_SESSION['empleado'];
session_destroy();
// Redirect to the login page:
if ($emp) {
    header('Location: login-intranet.php');
}else{
    header('Location: login.php');
}

