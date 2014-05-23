<?php
/*
	Adapted from UserPie Version: 1.0
	http://userpie.com
	
*/

class User {

	public $email = NULL;
	public $hashPass = NULL;
	public $userId = NULL;
	public $firstName = NULL;
	public $lastName = NULL;
	public $blurb = NULL;
	public $profilePicUrl = NULL;
	public $tags = array();
	public $loggedIn = FALSE;
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
	
	
	//Logout
	function logOut()
	{
		destorySession("user");
	}

}
?>