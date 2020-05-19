<?php 
require_once('db_credentials.php');

function db_connect(){
	$usernameDB = DB_USER;
	$password = DB_PASS;
	$dsn = 'mysql:host='. DB_SERVER .';dbname=' . DB_NAME;
	$db = new PDO($dsn, $usernameDB , $password);
	return $db;
}

	
?>