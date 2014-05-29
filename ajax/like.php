<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/include.php");

if (!empty($_POST)) 
{
	$result = addLike($_POST['project'], $_POST['user']);
	echo "".$result;
}
else
{
	echo "false";
}
?>