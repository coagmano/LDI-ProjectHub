<?php 

class Project {
	
	
	public /*.int.*/ $projectId = 0; 
	public $title = "";
	public $summary = "";
	public $description = "";
	public $category = "";
	public $skills = array();
	public $featureImageUrl = "";
	public $stage = "";
	public $likes = 0;
	public $createdTimestamp = 0;
	public $videoUrl = "";
	public $fileShareUrl = "";
	public $location = "";
	public $createdBy = 0;
	public $teamMembers = array();


	public function constructFromRow(array $row)
	{
		$this->projectId 		= $row['id'];
		$this->title 			= $row['title'];
		$this->summary 			= $row['summary'];
		$this->description 		= $row['description'];
		$this->category 		= $row['category'];
		$this->skills 			= explode(',', $row['skills']);
		$this->featureImageUrl 	= $row['featureImageUrl'];
		$this->stage 			= $row['stage'];
		$this->likes 			= $row['likes'];
		$this->createdTimestamp = $row['createdTimestamp'];
		$this->videoUrl 		= $row['videoUrl'];
		$this->fileShareUrl 	= $row['fileShareUrl'];
		$this->location 		= $row['location'];

		$this->createdBy 		= $this->getCreatedBy();
		$this->teamMembers		= $this->getTeamMembers();
	}

	public function getById($id)
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
		global $hiddenMessage;
		$tms = array();

		$sql = "SELECT user_id
				FROM project_user
				WHERE project_id = $this->projectId";
		$result = mysql_query($sql) or die(mysql_error());
		
		while ($row = mysql_fetch_assoc($result)) 
		{
			$tm = new User();
			$tm->getById($row['user_id']);
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
				stage = "'.mysql_real_escape_string($this->stage).'",
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
				stage = "'.mysql_real_escape_string($this->stage).'",
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