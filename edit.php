<?php
$style = "dashboard";
require_once('includes/include.php');
// $project = new Project(); 
// $project->getById($_GET['id']);
// $pageTitle = "$project->title";
include 'includes/header.php';
include 'includes/navbar.php';

// if(empty($_GET))
// {
// 	header("Location: http://".$_SERVER['HTTP_HOST']);
// 	die();
// }

?>

<div class="container dashboard">

	<!-- Nav bar -->

	<div class="dashboard-nav">
		<ul>
			<li class="first"><a href="dashboard.php">Dashboard</a></li>
			<li class="active"><a href="edit.php">Edit Project</a></li>
			<li><a href="#">Updates</a></li>
			<li class="last"><a href="#">Team members</a></li>
		</ul>
	</div>

</div>

<div class="container">
	<div class="boxLayout editProject">



	</div> <!-- /editProject -->
</div>	<!-- /container -->