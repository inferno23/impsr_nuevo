<?php
session_start();
unset($_SESSION["usuario"]);
unset($_SESSION["rol"]);
unset($_SESSION["id"]);
session_destroy();
header("Location: ../index.php");
exit;
?>