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

function getProjectTags() 
{
	$sql = "SELECT";
}

function searchTags($term) 
{
	$sql = "SELECT * FROM Projects
    		WHERE MATCH (skills) AGAINST ('{$term}')";
	$result = mysql_query($sql);
	return $$result;

}

function addLike($projectId, $userId)
{
	$p = mysql_escape_string(sanitise($projectId));
	$u = mysql_escape_string(sanitise($userId));

	$sql = "INSERT INTO project_likes
			SET 
			project_id = $p,
			user_id = $u";
	if(mysql_query($sql) or die(mysql_error())) 
	{
		return "true";
	}
	else 
	{
		return "false";
	}
}

function removeLike($projectId, $userId)
{
	$p = mysql_escape_string(sanitise($projectId));
	$u = mysql_escape_string(sanitise($userId));

	$sql = "DELETE FROM project_likes
			WHERE project_id = $p
			AND user_id = $u";
	if(mysql_query($sql) or die(mysql_error())) 
	{
		return "true";
	}
	else 
	{
		return "false";
	}
}

/********************************
 * Start project display block 	*
 * @author Yancie				*
 ********************************/

// Both category and skill filters not set
function noCate_noSkill($stage,$sort) {
	$sql = "SELECT * 
			FROM Projects  
			WHERE stage = '$stage' 
			ORDER BY $sort 
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}

// Category filler not set
function noCate($skill,$stage,$sort) {
	$sql = "SELECT *
			FROM Projects 
			WHERE stage = '$stage'
			AND category = '$category'
			ORDER BY $sort
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}

// Skill filler not set
function noSkill($category,$stage,$sort) {
	$sql = "SELECT *
			FROM Projects 
			WHERE stage = '$stage'
			AND skill = '$skill'
			ORDER BY $sort
			LIMIT 15 ";

	$result = mysql_query($sql);
	return $result;
}

// All filters set
function allFilters($category,$skill,$stage,$sort) {
	$sql = "SELECT *
			FROM Projects 
			WHERE stage = '$stage'
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
function progress($stage){
	if($stage=="Aspiration"){return 0;}
	else if($stage=="Incubating"){return 25;}
	else if($stage=="Developing"){return 75;}
	else if($stage=="Mature"){return 100;}
}
/*****************************
 * End project display block *
 *****************************/

?>
