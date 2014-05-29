<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/include.php");

if (!empty($_POST)) 
{
	$c = new Comment();
	$c->projectId 			= $_POST['project'];
	$c->content 			= $_POST['content'];
	$c->postedBy			= new User();
	$c->postedBy->getById($_POST['user']);
	$c->timeElapsed 		= "Just now";

	$result = $c->saveToDatabase();
	if ($result) 
	{
		echo <<<HTML
		<div class="commentsBox">
			<div class="right commentsContainer">
				<div class="nameDate bootstrap">
					{$c->postedBy->firstName} {$c->postedBy->lastName} <span class="date">{$c->timeElapsed}</span>
				</div>
				<div class="comments">
					{$c->content}
				</div>
			</div>
			<div class="photo">
				<img src="images/profile/{$c->postedBy->profilePicUrl}" alt="profile picture" />
			</div>
		</div>
HTML;
	}
	else
	{
		echo "false";
	}
}
else
{
	echo "false";
}
?>