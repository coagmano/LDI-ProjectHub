<?php
/**
 * src /functions/funcs.user.php
 * 
 */
//Set default length of cookie life
$remember_me_length = "1wk";



function isValidEmail($email)
{
	return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",trim($email));
}

function userExists($email) 
{
	global $hiddenMessage;
	$e = mysql_escape_string(sanitise($email));
	$sql = "SELECT id FROM users
			WHERE
			email = '".$e."'
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

function fetchUserDetails($email)
{
	$e = mysql_escape_string(sanitise($email));
	$sql = "SELECT * FROM users
			WHERE
			email = '".$e."'
			LIMIT
			1";
	 
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	
	return ($row);
}

function likesActiveProject($u, $p)
{
	if (!is_null($u) && !is_null($p)) 
	{
		$sql = "SELECT *
				FROM project_likes
				WHERE user_id = $u
				AND project_id = $p";
		$result = mysql_query($sql) or die(mysql_error());
		$count = mysql_num_rows($result);
		$row = mysql_fetch_array($result);
		if ($count > 0) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

//@ Thanks to - http://phpsec.org
function generateHash($plainText, $salt = null)
{
	if ($salt === null)
	{
		$salt = substr(md5(uniqid(rand(), true)), 0, 25);
	}
	else
	{
		$salt = substr($salt, 0, 25);
	}

	return $salt . sha1($salt . $plainText);
}

// Destroy the session data
// Remember-Me Hack v0.03
// <http://rememberme4uc.sourceforge.net/>
function destorySession($name)
{
	global $remember_me_length,$user;
		
	   if($user->remember_me == 0) { 
		if(isset($_SESSION[$name]))
		{
			$_SESSION[$name] = NULL;
			unset($_SESSION[$name]);
			$user = NULL;
		}
	}
	else if($user->remember_me == 1) {
		if(isset($_COOKIE[$name]))
		{

			$sql = "DELETE FROM sessions WHERE session_id = '".$user->remember_me_sessid."'";
			mysql_query($sql);
			setcookie($name, "", time() - parseLength($remember_me_length));
			$user = NULL;
		}
	} 
}

// Update the session data
// Remember-Me Hack v0.03
// <http://rememberme4uc.sourceforge.net/>

function updateSessionObj()
{
	global $user;

	$newObj = serialize($user);
	$sql = "UPDATE sessions SET session_data = '".$newObj."' WHERE session_id = '".$user->remember_me_sessid."'";
	return mysql_query($sql);
}

// Remember-Me Hack v0.03
// <http://rememberme4uc.sourceforge.net/>

function parseLength($len) 
{
	$user_units = strtolower(substr($len, -2));
	$user_time = substr($len, 0, -2);
	$units = array("mi" => 60,
	"hr" => 3600,
	"dy" => 86400,
	"wk" => 604800,
	"mo" => 2592000);
	
	if(!array_key_exists($user_units, $units))
	{
		die("Invalid unit of time.");
	}
	else if(!is_numeric($user_time))
	{
		die("Invalid length of time.");
	}
	else
	{
		return (int)$user_time*$units[$user_units];
	}
}


?>