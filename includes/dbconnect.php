<?php
	

	$dbHost = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbName = "ldi-projecthub";

	$link = mysql_connect($dbHost, $dbUsername, $dbPassword); //connect to the server
	if (!$link)
	{
		header ("Location: error.php");
	}
	if (!mysql_select_db($dbName, $link)) //select the MySQL database
	{
		header ("Location: error.php");
	}
?>	