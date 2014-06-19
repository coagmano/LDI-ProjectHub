<?php

/**
* 
*/
class Link {
	
	private /*.int.*/ $id = NULL;
	public /*.int.*/ $linkId = NULL;
	public /*.int.*/ $projectId = NULL;
	public $title = "";
	public $location = "";

	public function constructFromRow(array $row)
	{
		global $hiddenMessage;
		foreach ($row as $key => $value) 
		{
			$this->$key = $value;
		}
		$this->linkId = $this->id;
	}

	public function saveToDatabase()
	{
		global $hiddenMessage; // Use hiddenMessage for debug messages

		$escapedTitle = mysql_real_escape_string($this->title);
		$escapedLocation = mysql_real_escape_string($this->location);

		if (!is_null($this->linkId) && $this->linkId != 0) 
		{
			$sql = mysql_real_escape_string(
			   "UPDATE project_links
		    	SET 
				title = \"{$escapedTitle}\",
				location = \"{escapedLocation}\"
		   		WHERE id = ".$this->linkId);
		    $type = "UPDATE";
		    $hiddenMessage .= $type." ".$sql."<br>\n";
		} 
		else 
		{
			$sql = "INSERT INTO project_links 
					SET 
					project_id = {$this->projectId}, 
					title = '{$escapedTitle}', 
					location = '{$escapedLocation}'";
			$type = "INSERT";
			$hiddenMessage .= $type." ".$sql."<br>\n";
		}
		
		$result = mysql_query($sql) or die(mysql_error()."<br>\n ".$sql);

		if ($result)
		{
			if ($type == "INSERT") {
				$this->id = mysql_insert_id();
				$this->linkId = $this->id;
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