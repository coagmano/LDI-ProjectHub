<?php 

class Project {
	
	public $projectId;
	public $title;
	public $summary;
	public $description;
	public $category;
	public $skills;
	public $featureImageUrl;
	public $status;
	public $likes;
	public $createdTimestamp;
	public $videoUrl;
	public $fileShareUrl;
	public $location;
	public $createdBy_id;
	public $teamMembers;


	public function constructFromRow(array $row)
	{
		$this->projectId 		= $row['id'];
		$this->title 			= $row['title'];
		$this->summary 			= $row['summary'];
		$this->description 		= $row['description'];
		$this->category 		= $row['category'];
		$this->skills 			= explode(',', $row['skills']);
		$this->featureImageUrl 	= $row['featureImageUrl'];
		$this->status 			= $row['status'];
		$this->likes 			= $row['likes'];
		$this->createdTimestamp = $row['createdTimestamp'];
		$this->videoUrl 		= $row['videoUrl'];
		$this->fileShareUrl 	= $row['fileShareUrl'];
		$this->location 		= $row['location'];
		$this->createdBy_id 	= $row['createdBy_id'];

		$this->teamMembers		= $this->getTeamMembers();
	}

	public function getById(int $id)
	{
		$sql = "SELECT *
				FROM Projects
				WHERE id = $id
				LIMIT 1";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$this->constructFromRow($row);
	}

	public function getCreatedBy()
	{
		$sql = "SELECT u.id
				FROM users u
				INNER JOIN Projects p
				ON p.createdBy_id = u.id";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		
		$u = new User;
		$u->getById($row['id']);
	
		return $u;
	}

	public function getTeamMembers()
	{
		$tms = array();

		$sql = "SELECT user_id
				FROM project_user
				WHERE project_id = $this->projectId";
		$result = mysql_query($sql) or die(mysql_error());
		foreach ($row = mysql_fetch_assoc($result) as $r) 
		{
			$tm = new User;
			$tm->getById($r['user_id']);
			$tms[] = $tm;
		}
		return $tms;
	}

	public function saveToDatabase()
	{
		global $hiddenMessage; // Use hiddenMessage for debug messages
		if (projectExists($this->projectId)) 
		{
			$sql = 
			   'UPDATE Projects
		    	SET 
				title ="'.mysql_real_escape_string($this->title).'",
				summary ="'.mysql_real_escape_string($this->summary).'",
				description = "'.mysql_real_escape_string($this->description).'",
				category ="'.mysql_real_escape_string($this->category).'",
				status = "'.mysql_real_escape_string($this->status).'",
				skills ="'.mysql_real_escape_string(implode(",", $this->skills)).'",
				featureImageUrl = "'.mysql_real_escape_string($this->featureImageUrl).'",
				createdTimestamp = "'.mysql_real_escape_string($this->createdTimestamp).'",
				videoUrl = "'.mysql_real_escape_string($this->videoUrl).'",
				location = "'.mysql_real_escape_string($this->location).'",
				createdBy_id = "'.mysql_real_escape_string($this->createdBy_id).'"
		   		WHERE
			    id = "'.$this->projectId.'"';
		    $type = "UPDATE";
		    $hiddenMessage .= $sql."<br>";

		} 
		else 
		{
			$sql = 
				'INSERT INTO Projects
		    	SET 
       		    title ="'.mysql_real_escape_string($this->title).'",
				summary ="'.mysql_real_escape_string($this->summary).'",
				description = "'.mysql_real_escape_string($this->description).'",
				category ="'.mysql_real_escape_string($this->category).'",
				status = "'.mysql_real_escape_string($this->status).'",
				skills ="'.mysql_real_escape_string(implode(",", $this->skills)).'",
				featureImageUrl = "'.mysql_real_escape_string($this->featureImageUrl).'",
				createdTimestamp = "'.mysql_real_escape_string($this->createdTimestamp).'",
				videoUrl = "'.mysql_real_escape_string($this->videoUrl).'",
				location = "'.mysql_real_escape_string($this->location).'",
				createdBy_id = "'.mysql_real_escape_string($this->createdBy_id).'"
		        ';
			$type = "INSERT";
			$hiddenMessage .= $sql."<br>";
		}

		$result = mysql_query($sql) or die(mysql_error());

		if ($result)
		{
			if ($type == "INSERT") {
				$this->projectId = mysql_insert_id();
			}
			return true;
		} 
		else
		{
			$error = mysql_error();
			return $error;
		}
	}
}

?>