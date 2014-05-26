<?php

class User {

	public $email = "";
	public $hashPass = "";
	public $userId = "";
	public $firstName = "";
	public $lastName = "";
	public $blurb = "";
	public $profilePicUrl = "";
	public $tags = array();
	public $isLoggedIn = 0;
	public $isAdmin = 0;
	public $remember_me = "";
	public $remember_me_sessid = "";
	public $signupTimeStamp = 0;
	
	
	//Update a users password
	public function updatepassword(string $pass)
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
	public function updateemail(string $email)
	{
			
		$this->email = $email;
		if($this->remember_me == 1)
		updateSessionObj();
		
		$sql = "UPDATE ".$db_table_prefix."users
				SET email = '".$email."'
				WHERE
				id = '".$db->sql_escape($this->userId)."'";
		
		return ($db->sql_query($sql));
	}

	public function getFromDatabaseById()
	{
		//do things
	}

	public function getFromDatabaseByEmail(string $email)
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