<?php 

	define('HOST', 'http://'.$_SERVER['HTTP_HOST']);
	define('BASE_URL', HOST.'/impsr/');
	define('LOCAL_ENV', $_SERVER['HTTP_HOST'] === 'localhost');
