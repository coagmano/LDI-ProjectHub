<?php

class User {


	public $userId = 0;
	public $email = "";
	public $hashPass = "";
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
		$i = mysql_escape_string(sanitise($id));
		$sql = "SELECT * FROM users
				WHERE
				id = ".$i."
				LIMIT
				1";
		$result = mysql_query($sql);
		$userdetails = mysql_fetch_assoc($result);

		$this->userId 			= $id;
		$this->isAdmin			= $userdetails["is_admin"];
		$this->email 			= $userdetails["email"];
		$this->hashPass 		= $userdetails["password"];
		$this->firstName 		= $userdetails["first_name"];
		$this->lastName 		= $userdetails["last_name"];
		$this->profilePicUrl 	= $userdetails["profilePicUrl"];
		$this->blurb 			= $userdetails["blurb"];
		$this->tags 			= explode(',', $userdetails["tags"]);
		$this->signupTimeStamp	= $userdetails["created_timestamp"];


	}


	public function getByEmail($email)
	{	
		$e = mysql_escape_string(sanitise($email));
		$sql = "SELECT * FROM users
				WHERE
				email = '".$e."'
				LIMIT
				1";
		$result = mysql_query($sql);
		$userdetails = mysql_fetch_assoc($result);

		$this->isAdmin			= $userdetails["is_admin"];
		$this->email 			= $email;
		$this->userId 			= $userdetails["id"];
		$this->hashPass 		= $userdetails["password"];
		$this->firstName 		= $userdetails["first_name"];
		$this->lastName 		= $userdetails["last_name"];
		$this->profilePicUrl 	= $userdetails["profilePicUrl"];
		$this->blurb 			= $userdetails["blurb"];
		$this->tags 			= explode(',', $userdetails["tags"]);
		$this->signupTimeStamp	= $userdetails["created_timestamp"];
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