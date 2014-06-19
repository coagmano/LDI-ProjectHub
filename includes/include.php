<?php
	// If ProjectHub is served out of a folder, enter the folder path here
	$path = $_SERVER['DOCUMENT_ROOT'].""; // served from htdocs
	//$path = $_SERVER['DOCUMENT_ROOT']."/LDI-ProjectHub";  // served from LDI-ProjectHub subfolder

	// All object definitions must be declared before the start of the session
	require_once($path."/model/class.user.php");
	require_once($path."/model/class.role.php");
	require_once($path."/model/class.blogpost.php");
	require_once($path."/model/class.comment.php");
	require_once($path."/model/class.project.php");
	require_once($path."/model/class.joinrequest.php");
	require_once($path."/model/class.link.php");
	

	session_start(); //Start the session here and include this on all sessioned pages.
	
	$hiddenMessage = ""; // Initialise hidden message for display in footer.

	require_once($path."/includes/dbconnect.php");
	require_once($path."/functions/funcs.general.php");
	require_once($path."/functions/funcs.user.php");
	require_once($path."/functions/funcs.project.php");

	// Initialise user
	if (isset($_SESSION["user"])) {$user = $_SESSION["user"];} else {$user = new User();}
	
	//Sanitise POST and GET array
	$DIRTY_POST = $_POST;
	$DIRTY_GET = $_GET;
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
	
	$errors = array();
	$message = array();
	$errors = (isset($_SESSION['errors'])) ? $_SESSION['errors'] : array();
	$message = (isset($_SESSION['message'])) ? $_SESSION['message'] : array();
?>