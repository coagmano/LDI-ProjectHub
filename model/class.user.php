<?php

class User {

	public $userId = NULL;
	public $email = NULL;
	public $hashPass = NULL;
	public $firstName = NULL;
	public $lastName = NULL;
	public $blurb = NULL;
	public $profilePicUrl = NULL;
	public $tags = array();
	public $isLoggedIn = FALSE;
	public $isAdmin = FALSE;
	public $remember_me = NULL;
	public $remember_me_sessid = NULL;
	public $signupTimeStamp = NULL;
	
	public function constructFromRow(array $row)
	{
		
		$user->userId 			= $row["id"];
		$user->email 			= $row["email"];
		$user->hashPass 		= $row["password"];
		$user->firstName 		= $row["first_name"];
		$user->lastName 		= $row["last_name"];
		$user->profilePicUrl 	= $row["profilePicUrl"];
		$user->blurb 			= $row["blurb"];
		$user->tags 			= explode(",", $row["tags"]);
		$user->isAdmin			= $row["is_admin"];
		$user->signupTimeStamp	= $row["created_timestamp"];
	}


	//Update a users password
	public function updatepassword($pass)
	{
		$secure_pass = sha1($pass);
		
		$this->hashPass = $secure_pass;
		if($this->remember_me == 1)
		
		$sql = "UPDATE users
		       SET
			   password = '".$secure_pass."' 
			   WHERE
			   id = '".$this->userId."'";
	
		return (mysql_query($sql) or die('Problem updating database:'.mysql_error()));
	}
	
	//Update a users email
	public function updateemail($email)
	{
			
		$this->email = $email;
		if($this->remember_me == 1) 
		{ 
			updateSessionObj(); 
		}
		
		$sql = "UPDATE users
				SET email = '".$email."'
				WHERE
				id = '".mysql_real_escape_string($this->userId)."'";
		
		return (mysql_query($sql) or die('Problem updating database:'.mysql_error()));
	}

	public function getById($id)
	{
		//do things
	}

	public function getByEmail($email)
	{	
		$userdetails = fetchUserDetails($email);
		$user->isAdmin			= $userdetails["is_admin"];
		$user->email 			= $email;
		$user->userId 			= $userdetails["id"];
		$user->hashPass 		= $userdetails["password"];
		$user->firstName 		= $userdetails["first_name"];
		$user->lastName 		= $userdetails["last_name"];
		$user->profilePicUrl 	= $userdetails["profilePicUrl"];
		$user->blurb 			= $userdetails["blurb"];
		$user->tags 			= $userdetails["tags"];
		$user->signupTimeStamp	= $userdetails["created_timestamp"];
	}

	/**
	 * Saves all attributes to database
	 * @return bool True on success
	 * @return string Description of error
	 */
	public function saveToDatabase()
	{
		global $hiddenMessage;
		if (userExists($this->email)) 
		{
			$sql = 
			   'UPDATE users
		    	SET 
				first_name ="'.mysql_real_escape_string($this->firstName).'",
				last_name ="'.mysql_real_escape_string($this->lastName).'",
				email = "'.mysql_real_escape_string($this->email).'",
				password ="'.mysql_real_escape_string($this->hashPass).'",
				blurb = "'.mysql_real_escape_string($this->blurb).'",
				tags ="'.mysql_real_escape_string(implode(",", $this->tags)).'",
				profilePicUrl = "'.mysql_real_escape_string($this->profilePicUrl).'"
		   		WHERE
			    email = "'.$this->email.'"';
		    $type = "UPDATE";
		    $hiddenMessage .= $sql."<br>";
		} 
		else 
		{
			$sql = 
				'INSERT INTO users (first_name, last_name, email, password, blurb, tags, profilePicUrl, created_timestamp)
		    	VALUES (
       		    "'.mysql_real_escape_string($this->firstName).'",
   			    "'.mysql_real_escape_string($this->lastName).'",
   			    "'.mysql_real_escape_string($this->email).'",
   			    "'.mysql_real_escape_string($this->hashPass).'",
   			    "'.mysql_real_escape_string($this->blurb).'",
   			    "'.mysql_real_escape_string(implode(",", $this->tags)).'",
   			    "'.mysql_real_escape_string($this->profilePicUrl).'",
		        "'.mysql_real_escape_string($this->signupTimeStamp).'"
		        )';
			$type = "INSERT";
			$hiddenMessage .= $sql."<br>";
		}

		$result = mysql_query($sql) ;//or die(mysql_error());

		if ($result)
		{
			if ($type == "INSERT") {
				$this->userId = mysql_insert_id();
			}
			return true;
		} 
		else
		{
			$error = mysql_error();
			return $error;
		}
	}
	
	
	//Logout
	function logOut()
	{
		destorySession("user");
	}

}
?>