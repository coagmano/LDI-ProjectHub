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


	public function fuction() {

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