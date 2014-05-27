<?php

class BlogPost {
	
	public /*.int.*/ $blogPostId = NULL;
	public /*.int.*/ $projectId = NULL;
	public $title = "";
	public $content = "";
	public $timestamp = 0;
	public $timeElapsed = "";
	public $postedBy = NULL;

	public function constructFromRow(array $row)
	{
		global $hiddenMessage;
		$this->blogPostId		= $row["id"];
		$this->projectId 		= $row["project_id"];
		$this->title			= $row["title"];
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
		if (!is_null($this->blogPostId) && $this->blogPostId != 0) 
		{
			$sql = 
			   "UPDATE BlogPosts
		    	SET 
				user_id = $this->postedBy->userId,
				title = $this->title,
				content = $this->content,
		   		WHERE id = ".$this->blogPostId;
		    $type = "UPDATE";
		    $hiddenMessage .= $sql."<br>\n";

		} 
		else 
		{
			$sql = 
				"INSERT INTO BlogPosts 
				SET 
				project_id = $this->project_id,
				user_id = $this->postedBy->userId,
				title = $this->title,
				content = $this->content,
				postedTimestamp = ".time();
			$type = "INSERT";
			$hiddenMessage .= $sql."<br>\n";
		}

		$result = mysql_query($sql) or die(mysql_error());

		if ($result)
		{
			if ($type == "INSERT") {
				$this->blogPostId = mysql_insert_id();
			}
			return true;
		} 
		else
		{
			$error = "Error saving BlogPost to database: ".mysql_error();
			return $error;
		}
	}
}
?>