<?php
	// All object definitions must be declared before the start of the session
	require_once("model/class.user.php");

	session_start(); //Start the session here and include this on all sessioned pages.
	
	require_once('dbconnect.php');
	require_once("functions/userHelper.php");

	if (isset($_SESSION["user"])) {$user = $_SESSION["user"];} else {$user = new User();}

	// include 'loginCheck.php';
	

	
	
?>