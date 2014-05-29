<?php
	// All object definitions must be declared before the start of the session
	require_once($_SERVER['DOCUMENT_ROOT']."/model/class.user.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/class.role.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/class.blogpost.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/class.comment.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/model/class.project.php");

	session_start(); //Start the session here and include this on all sessioned pages.
	
	$hiddenMessage = ""; // Initialise hidden message for display in footer.

	require_once($_SERVER['DOCUMENT_ROOT']."/includes/dbconnect.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/funcs.general.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/funcs.user.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/functions/funcs.project.php");

	// Initialise user
	if (isset($_SESSION["user"])) {$user = $_SESSION["user"];} else {$user = new User();}
	
	//Sanitise POST and GET array
	$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
	
	$errors = (isset($_SESSION['errors'])) ? $_SESSION['errors'] : NULL;
	// include 'loginCheck.php';
	

	
	
?>