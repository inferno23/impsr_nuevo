<?php
include_once 'functions/constants.php';
session_start();
session_destroy();
// Redirect to the login page:
header('Location: '.BASE_URL);
