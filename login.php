<?php
/**
 * Login page
 */

require_once("includes/include.php");



// if ($user->isLoggedIn) 
// { 
// 	header("Location: http://".$_SERVER['HTTP_HOST']);
// 	die(); 
// }

if(!empty($_POST)) 
{


	$errors = array();
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);
	// $remember_choice = trim($_POST["remember_me"]);


	//Perform some validation
	if($email == "")
	{
		$errors[] = "Please enter a QUT email address";
	}
	if($password == "")
	{
		$errors[] = "Please enter a password";
	}
	
	//End data validation
	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!userExists($email))
		{
			$errors[] = "Email or password incorrect, please try again.";
		}
		else
		{
			$userdetails = fetchUserDetails($email);
		
			//See if the user's account is activation
			if($userdetails["active"] == false)
			{
				$errors[] = "Your account has not been activated. Please contact one of the LDI mentors";
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				//$hashed_pass = generateHash($password,$userdetails["password"]);
				$hashed_pass = sha1($password);

				if($hashed_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = "Email or password incorrect, please try again.";
				}
				else
				{
					//passwords match! we're good to go'
					
					//Construct a new user object
					//Transfer some db data to the session object
					$user = new User;
					$user->constructFromRow($userdetails);
					$user->isLoggedIn			= true;
					$user->remember_me 			= $remember_choice;
					$user->remember_me_sessid 	= generateHash(uniqid(rand(), true));
	
					
					$_SESSION["user"] = $user;
					
					if ($user->remember_me == 1) 
					{
						$sql = "INSERT INTO sessions VALUES('".$user->remember_me_sessid."', '".serialize($user)."', '".time()."')";
						mysql_query($sql) or die("Error initialising session in database.".mysql_error());
						setcookie("user_session", $user->remember_me_sessid, time()+parseLength($remember_me_length));
					}
					
					//Redirect to user account page
					header("Location: index.php");
					die();
				}
			}
		}
	}
} 
else
{
	header("Location: http://".$_SERVER['HTTP_HOST']);
	die();
}

?>