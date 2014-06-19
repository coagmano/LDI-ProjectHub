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

function getLinks($projectId)
{
	$p = mysql_escape_string(sanitise($projectId));
	$links = array();

	$sql = "SELECT * FROM project_links
			WHERE project_id = $p";
	$result = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) 
	{
		$l = new Link();
		$l->constructFromRow($row);
		$links[] = $l;
	}
	return $links;
}

/********************************
 * Start project display block 	*
 ********************************/

// Both category and skill filters not set
function noCate_noSkill($stage,$sort) 
{
	global $hiddenMessage;
	$hiddenMessage .= "noCate_noSkill";
	$sql = "SELECT p.*, COUNT(project_id) as likes
			FROM Projects p 
			LEFT JOIN project_likes l
			ON p.id = l.project_id
			WHERE p.stage = '$stage'
			GROUP BY p.id
			ORDER BY $sort 
			LIMIT 9 ";
	$hiddenMessage .= "\n".$sql;
	$result = mysql_query($sql) or die(mysql_error()."\n".$sql);
	return $result;
}

// Category filler not set
function noCate($skill,$stage,$sort) 
{
	global $hiddenMessage;
	$hiddenMessage .= "noCate";
	$sql = "SELECT p.*, COUNT(project_id) as likes
			FROM Projects p 
			LEFT JOIN project_likes l
			ON p.id = l.project_id
			WHERE stage = '$stage'
			AND skill = '$skill'
			GROUP BY p.id
			ORDER BY $sort
			LIMIT 9 ";

	$result = mysql_query($sql)or die(mysql_error()."\n".$sql);
	return $result;
}

// Skill filler not set
function noSkill($category,$stage,$sort) 
{
	global $hiddenMessage;
	$hiddenMessage .= "noSkill";
	$sql = "SELECT p.*, COUNT(project_id) as likes
			FROM Projects p 
			LEFT JOIN project_likes l
			ON p.id = l.project_id
			WHERE stage = '$stage'
			AND category = '$category'
			GROUP BY p.id
			ORDER BY $sort
			LIMIT 9 ";

	$result = mysql_query($sql)or die(mysql_error()."\n".$sql);
	return $result;
}

// All filters set
function allFilters($category,$skill,$stage,$sort) 
{
	global $hiddenMessage;
	$hiddenMessage .= "allFilters";
	$sql = "SELECT p.*, COUNT(project_id) as likes
			FROM Projects p 
			LEFT JOIN project_likes l
			ON p.id = l.project_id
			WHERE stage = '$stage'
			AND category = '$category'
			AND skill = '$skill'
			GROUP BY p.id
			ORDER BY $sort
			LIMIT 9 ";

	$result = mysql_query($sql)or die(mysql_error()."\n".$sql);
	return $result;
}

function projectSearch($term)
{
    $sort = "likes DESC";

    $sql = "SELECT p.*, COUNT(project_id) as likes
			FROM Projects p 
			LEFT JOIN project_likes l
			ON p.id = l.project_id
            WHERE MATCH(title, summary, description, category, stage) AGAINST ('{$term}')
            GROUP BY p.id
            LIMIT 9 ";

    $result = mysql_query($sql)or die(mysql_error()."\n".$sql);
	return $result;
}

//check if there is an result
function checkCount($result)
{
	$count = mysql_num_rows($result);
	if ($count != 0) { return true;}
	else {return false;}
}


// progress bar string to perstange 
function progress($stage)
{
	if($stage=="Aspiration"){return 0;}
	else if($stage=="Incubation"){return 25;}
	else if($stage=="Implementation"){return 75;}
	else if($stage=="Maturation"){return 100;}
}
/*****************************
 * End project display block *
 *****************************/

?>
