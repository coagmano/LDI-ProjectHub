<?php
	// All object definitions must be declared before the start of the session
	require_once("model/class.user.php");

	session_start(); //Start the session here and include this on all sessioned pages.
	
	require_once('dbconnect.php');
	require_once("functions/funcs.user.php");

	// Initialise user
	if (isset($_SESSION["user"])) {$user = $_SESSION["user"];} else {$user = new User();}
	
	//Sanitise POST and GET array
	$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
	
	// include 'loginCheck.php';
	

	
	
?>