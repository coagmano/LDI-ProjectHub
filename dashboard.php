<?php
$style = "dashboard";
require_once('includes/include.php');
// $project = new Project(); 
// $project->getById($_GET['id']);
// $pageTitle = "$project->title";
include 'includes/header.php';
include 'includes/navbar.php';

//User must be logged in
if (!$user->isLoggedIn){ header("Location: http://".$_SERVER['HTTP_HOST']); die(); }

// if(empty($_GET))
// {
// 	header("Location: http://".$_SERVER['HTTP_HOST']);
// 	die();
// }

?>

	<div class="container dashboard">
		<div class="dashboard-nav">
		<ul>

<?php

	// This is your menu
	// $items = array("dashboardHome", "edit", "roles", "updates","settings");
	$items = array
	  (
	  array("dashboardHome","Dashboard"),
	  array("edit","Edit Project"),
	  array("roles","Team members"),
	  array("updates","Updates"),
	  array("settings","Settings")
	  );

	foreach ($items as $item)
	{
	    if (!isset($_GET['page']) && $item[0] == "dashboardHome")
	    {
	        echo '<li class="active"><a href="?page=' . $item[0] . '"> ' . $item[1] . '</a></li>';
	        $activePage = $item[0] . ".php";
	    }
	    else if (isset($_GET['page']) && $_GET['page'] == $item[0])
	    {
	        echo '<li class="active"><a href="?page=' . $item[0] . '"> ' . $item[1] . '</a></li>';
	        $activePage = $item[0] . ".php";
	    }
	    else
	    {
	        echo '<li><a href="?page=' . $item[0] . '"> ' . $item[1] . '</a></li>';
	    }
	}

	echo '</ul>
	</div>

</div>';

	// Include your page
	if (isset($activePage))
	{
	    include "includes/" . $activePage;   
	}
	else
	{
	    include "dashboardHome.php";
	}


	include 'includes/footer.php';
?>