<?php
require($_SERVER['DOCUMENT_ROOT']."/includes/include.php");

if (!empty($_POST) && $user->isLoggedIn)
{
	switch ($_POST['action']) 
	{
		case 'create':
			$l = new Link();
			$l->projectId	= $_POST['project'];
			$l->title 		= $DIRTY_POST['title'];
			$l->location	= $DIRTY_POST['location'];

			$result = $l->saveToDatabase();
			if ($result) 
			{
				echo "<li class=\"list-group-item\"><a href=\"{$l->location}\" target=\"_blank\"><span class=\"icon glyphicon glyphicon-link\"></span> {$l->title}</a></li>";
			}
			else
			{
				echo "false";
			}
			break;
		
		case 'update':
			# code...
			break;

		case 'delete':
			# code...
			break;	

		default:
			echo "false";
			break;
	}
}
else
{
	echo "false";
}
?>