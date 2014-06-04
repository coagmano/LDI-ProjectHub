<?php

class Role {

	public /*.int.*/ $roleId = NULL;
	public $title = "";
	public $blurb = "";
	public $tags = array();
	public /*.User.*/ $filledBy = NULL;

	public function constructFromRow(array $row)
	{
		global $hiddenMessage;

		$this->roleId 			= $row["id"];
		$this->title			= $row["title"];
		$this->blurb 			= $row["blurb"];
		$this->tags 			= explode(",", $row["tags"]);

		if ($row["filled_by"] == 0 or $row['filled_by'] == NULL)
		{
			$this->filledBy 	= NULL;
		}
		else
		{
			$u 					= new User();
			$u->getById($row["filled_by"]);
			$this->filledBy		= $u;
		}
	}

	public function getById($id)
	{
		$i = mysql_real_escape_string(sanitise($id));
		$sql = "SELECT *
				FROM project_roles
				WHERE id = $i";
		$result = mysql_query($sql) or die("failed to getById: SQL=".$sql." <br>\n Error=".mysql_error());
		$row = mysql_fetch_assoc($result);
		$this->constructFromRow($row);

		return $this;
	}



	public function getFilledBy()
	{
		global $hiddenMessage;

		$sql = "SELECT filled_by
				FROM project_roles
				WHERE id = $this->roleId";
		$result = mysql_query($sql) or die(mysql_error());
		
		$row = mysql_fetch_assoc($result);
		$tm = new User();
		$tm->getById($row['user_id']);

		return $tm;
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