<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/include.php");

switch ($_POST['task']) {
	case 'like':
		$result = addLike($_POST['project'], $_POST['user']);
		echo "".$result;
		break;
	
	case 'unlike':
		$result = removeLike($_POST['project'], $_POST['user']);
		echo "".$result;
		break;

	default:
		echo "false";
		break;
}

?>