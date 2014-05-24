<?php

class User {

	public $email = NULL;
	public $hashPass = NULL;
	public $userId = NULL;
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

	public function getFromDatabaseByEmail($email)
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

		if (userExists($this->email)) 
		{
			$sql = "UPDATE users
			       SET 
		       	   first_name = '".$this->firstName."',
		       	   last_name = '".$this->lastName."',
		       	   email = '".$this->email."',
		       	   password = '".$this->hashPass."',
		       	   blurb = '".$this->blurb."',
		       	   tags = '".implode(",", $this->tags)."',
		       	   profilePicUrl = '">$this->profilePicUrl."'
				   WHERE
				    id = '".$this->userId."'";
		    $type = "UPDATE";
		} 
		else 
		{
			$sql = "INSERT INTO users (first_name, last_name, email, password, blurb, tags, profilePicUrl, created_timestamp)
			       VALUES (
	       		   '".$this->firstName."',
       			   '".$this->lastName."',
       			   '".$this->email."',
       			   '".$this->hashPass."',
       			   '".$this->blurb."',
       			   '".implode(",", $this->tags)."'
       			   '".$this->profilePicUrl."',
			       '".$this->signupTimeStamp."'
			       )";
			$type = "INSERT";
		}

		if (mysql_query($sql))
		{
			if ($type == "INSERT") {$this->userId = mysql_insert_id();}
			return true;

		} 
		else
		{
			$result = mysql_error();
			return $result;
		}
	}
	
	
	//Logout
	function logOut()
	{
		destorySession("user");
	}

}
?>