<?php
/**
 * src /functions/funcs.project.php
 * 
 */

function projectExists($id)
{
	global $hiddenMessage;
	$i = mysql_escape_string(sanitise($id));
	$sql = "SELECT id FROM Projects
			WHERE
			id = '".$i."'
			LIMIT 1";
	
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	//$hiddenMessage .= $row;
	//$hiddenMessage .= $row[0]."<br>/n";
	if($row[0] > 0) 
	{
		return true;
	}
	else 
	{
		return false;
	}
}

/********************************
 * Start project display block 	*
 * @author Yancie				*
 ********************************/

// Both category and skill fillers not set
function noCate_noSkill($status,$sort) {
	$sql = "SELECT * 
			FROM Projects  
			WHERE status = '$status' 
			ORDER BY $sort 
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}

// Category filler not set
function noCate($skill,$status,$sort) {
	$sql = "SELECT *
			FROM Projects 
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
			FROM Projects 
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
			FROM Projects 
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
/*****************************
 * End project display block *
 *****************************/

?>