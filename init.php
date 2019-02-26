<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('functions/functions.php');
// DISABLE ERRORS, WARNINGS
// error_reporting(E_ERROR | E_PARSE);


$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'ppk'
	), 'current_dir' => __DIR__
);


// Autoload classes in /classes directory
spl_autoload_register(function ($class) {
	require_once  __DIR__ . '/classes/' . $class . '.php';
});

?>
