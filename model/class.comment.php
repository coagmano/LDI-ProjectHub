<?php

class Comment {
	
	public /*.int.*/ $commentId = NULL;
	public /*.int.*/ $projectId = NULL;
	public $content = "";
	public $timestamp = 0;
	public $timeElapsed = "";
	public $postedBy = NULL;

	public function constructFromRow(array $row)
	{
		global $hiddenMessage;
		$this->commentId		= $row["id"];
		$this->projectId 		= $row["project_id"];
		$this->content 			= $row["content"];
		$this->timestamp		= $row["postedTimestamp"];
		$this->timeElapsed 		= time_elapsed_string($this->timestamp);

		$u = new User();
		$u->getById($row["user_id"]);
		$this->postedBy 		= $u;
	}

	public function saveToDatabase()
	{
		global $hiddenMessage; // Use hiddenMessage for debug messages
		if (!is_null($this->commentId) && $this->commentId != 0) 
		{
			$sql = 
			   "UPDATE Comments
		    	SET 
				content = \"{$this->content}\",
		   		WHERE id = ".$this->commentId;
		    $type = "UPDATE";
		    $hiddenMessage .= $type." ".$sql."<br>\n";
		} 
		else 
		{
			$sql = 
				"INSERT INTO Comments 
				SET 
				project_id = ".$this->projectId.",
				user_id = ".$this->postedBy->userId.",
				content = \"{$this->content}\",
				postedTimestamp = '".time()."'";
			$type = "INSERT";
			$hiddenMessage .= $type." ".$sql."<br>\n";
		}

		$result = mysql_query($sql) or die(mysql_error());

		if ($result)
		{
			if ($type == "INSERT") {
				$this->commentId = mysql_insert_id();
			}
			return true;
		} 
		else
		{
			$error = "Error saving Comment to database: ".mysql_error();
			return $error;
		}
	}
}
?>