<?php

class JoinRequest {

	public $id 				= 0;
	public $projectId 		= 0;
	public $user 			= NULL;
	public $role 			= NULL;
	public $message 		= "";

	public function constructFromRow(array $row)
	{
		global $hiddenMessage;

		$this->id 				= $row["id"];
		$this->project_id 		= $row["project_id"];
		$this->role 			= new Role();
		$this->role->getById($row["role_id"]);
		$this->user				= new User();
		$this->user->getById($row["user_id"]);

		$this->message 			= $row["message"];
		$this->timestamp 		= $row["timestamp"];
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

		$result = mysql_query($sql) ;//or die(mysql_error()."<br>\nSQL: ".$sql);

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