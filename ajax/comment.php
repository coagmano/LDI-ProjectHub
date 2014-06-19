<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/include.php");

if (!empty($_POST) && $user->isLoggedIn)
{
	$c = new Comment();
	$c->projectId 			= $_POST['project'];
	$c->content 			= $_POST['content'];
	$c->postedBy			= $user;
	$c->timeElapsed 		= "Just now";
	$c->private 			= $_POST['private'];

	

	$result = $c->saveToDatabase();

	$p = new Project();
	$p->getById($_POST['project']);

	$commentClass = "";
	$commentTeam = "";
	if ($c->postedBy == $p->createdBy || in_array($c->postedBy, $p->teamMembers))
	{
		$commentClass = "owner yellowBorder";
		$commentTeam = '<span class="label label-warning team">Team</span>';
	} 

	if ($result) 
	{
		echo <<<HTML
		<div class="commentsBox {$commentClass}">
			<div class="right commentsContainer">
				<div class="nameDate bootstrap">
					{$commentTeam}{$c->postedBy->firstName} {$c->postedBy->lastName} <span class="date">{$c->timeElapsed}</span>
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