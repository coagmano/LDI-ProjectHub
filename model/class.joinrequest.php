<?php

class JoinRequest {

	public $id 				= 0;
	public $projectId 		= NULL;
	public $user 			= NULL;
	public $role 			= NULL;
	public $message 		= "";

	public function constructFromRow(array $row)
	{
		global $hiddenMessage;
		$this->id 				= $row["id"];
		$this->projectId 		= $row["project_id"];
		if ($row["role_id"] != 0)
		{ 
			$this->role 		= new Role();
			$this->role->getById($row["role_id"]); 
		}
		$this->user				= new User();
		$this->user->getById($row["user_id"]);
		$this->message 			= $row["message"];
		$this->timestamp 		= $row["timestamp"];
	}

	public function getById($id)
	{
		$i = mysql_escape_string(sanitise($id));
		$sql = "SELECT *
		        FROM project_requests
		        WHERE id = $i ";
		$result = mysql_query($sql) or die("Error getting tags: ".mysql_error());
		$row = mysql_fetch_assoc($result);
		$this->constructFromRow($row);

		return $this;
	}
	/**
	 * Approve JoinRequest
	 * @TODO Notification system for accepted user
	 * @return bool true on success false on failure
	 */
	public function approve()
	{
		// Add user to team members
		$sql = "INSERT INTO project_user
				SET 
				project_id = {$this->projectId}, 
				user_id = {$this->user->userId}";

		$sql .= (!is_null($this->role)) ? ", 
				role_id = ".$this->role->roleId : "";

		$result1 = mysql_query($sql) or die("Error adding user to project: ".mysql_error());
		$sql = "DELETE FROM project_requests
				WHERE id = {$this->id}";
		$result2 = mysql_query($sql) or die("Error removing request: ".mysql_error());

		if ($result1 && $result2) 
		{
			return(true);
		}
		else
		{
			return(false);
		}
	}

	/**
	 * Reject JoinRequest
	 * @TODO Notification system for rejected user
	 * @return bool true on success false on failure
	 */
	public function reject()
	{
		// Delete Request
		$sql = "DELETE FROM project_requests
				WHERE id = {$this->id}";
		if (mysql_query($sql) or die("Error removing request: ".mysql_error())) 
		{
			return(true);
		}
		else
		{
			return(false);
		}
	}

	public function saveToDatabase()
	{
		global $hiddenMessage; // Use hiddenMessage for debug messages
		if (!is_null($this->id) && $this->id != 0) 
		{
			$sql = 
			   "UPDATE project_requests 
			   	SET 
			   	message = {$this->message}
		   		WHERE project_id = {$this->projectId}
		   		AND user_id = {$this->user->userId}
		   		AND role_id = {$this->role->roleId}";
		    $hiddenMessage .= $sql."<br>\n";

		} 
		else 
		{
			$sql = 
				"INSERT INTO project_requests 
			   	SET 
			   	project_id = {$this->projectId},
			   	user_id = {$this->user->userId},
			   	message = '{$this->message}'";
			if (!is_null($this->role->roleId)) {
				$sql .= ", role_id = {$this->role->roleId}";
			}
			
			$hiddenMessage .= $sql."<br>\n";
		}

		$result = mysql_query($sql) or die(mysql_error()."<br>\nSQL: ".$sql);

		if ($result)
		{
			return true;
		} 
		else
		{
			$error = "Error saving JoinRequest to database: ".mysql_error();
			return $error;
		}
	}

}

?>