<?php

// figure what fillers are set
if($sort="none"){$sort= "likes";}	// default sort by popularily (likes)
if($category = "none" && $skill = "none"){$result = noCate_noSkill($status,$sort);}
else if($category = "none"){$result = noCate($skill,$status,$sort);}
else if($skill = "none"){$result = noSkill($category,$status,$sort);}
else {$result = allFillers($category,$skill,$status,$sort);}

// Both category and skill fillers not set
function noCate_noSkill($status,$sort) {
	$sql = "SELECT * 
			FROM Project  
			WHERE status = '$status' 
			ORDER BY $sort 
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}

// Category filler not set
function noCate($skill,$status,$sort) {
	$sql = "SELECT *
			FROM Project 
			WHERE status = '$status'
			AND category = '$category'
			ORDER BY $sort
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}

// Skill filler not set
function noSkill($category,$status,$sort) {
	$sql = "SELECT *
			FROM Project 
			WHERE status = '$status'
			AND skill = '$skill'
			ORDER BY $sort
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}

// All fillers set
function allFillers($category,$skill,$status,$sort) {
	$sql = "SELECT *
			FROM Project 
			WHERE status = '$status'
			AND category = '$category'
			AND skill = '$skill'
			ORDER BY $sort
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}


//check if there is an result
function checkCount($result){
	$count = mysql_num_rows($result);
	if ($count != 0) { return true;}
	else {return false;}
}


// progress bar string to perstange 
function progress($status){
	if($status=="Aspiration"){return 0;}
	else if($status=="Incubating"){return 25;}
	else if($status=="Developing"){return 75;}
	else if($status=="Mature"){return 100;}
}
