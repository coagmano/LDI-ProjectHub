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
		
		$this->userId 			= $row["id"];
		$this->email 			= $row["email"];
		$this->hashPass 		= $row["password"];
		$this->firstName 		= $row["first_name"];
		$this->lastName 		= $row["last_name"];
		$this->profilePicUrl 	= $row["profilePicUrl"];
		$this->blurb 			= $row["blurb"];
		$this->tags 			= explode(",", $row["tags"]);
		$this->isAdmin			= $row["is_admin"];
		$this->signupTimeStamp	= $row["created_timestamp"];
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
		
		return (mysql_query($sql) or die("Problem updating database: ".mysql_error()));
	}

	public function getById($id)
	{
		$i = mysql_escape_string(sanitise($id));
		$sql = "SELECT * 
				FROM users
				WHERE id = ".$i."
				LIMIT 1";
		$result = mysql_query($sql) or die("database error in User->getById()".mysql_error());
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

		return $this;
	}


	public function getByEmail($email)
	{	
		$e = mysql_escape_string(sanitise($email));
		$sql = "SELECT * 
				FROM users
				WHERE email = '".$e."'
				LIMIT 1";
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

		return $this;
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
				first_name ="'.$this->firstName.'",
				last_name ="'.$this->lastName.'",
				email = "'.$this->email.'",
				password ="'.$this->hashPass.'",
				blurb = "'.$this->blurb.'",
				tags ="'.implode(",", $this->tags).'",
				profilePicUrl = "'.$this->profilePicUrl.'"
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
       		    "'.$this->firstName.'",
   			    "'.$this->lastName.'",
   			    "'.$this->email.'",
   			    "'.$this->hashPass.'",
   			    "'.$this->blurb.'",
   			    "'.implode(",", $this->tags).'",
   			    "'.$this->profilePicUrl.'",
		        "'.$this->signupTimeStamp.'"
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
			$error = "Error saving User to database: ".mysql_error();
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