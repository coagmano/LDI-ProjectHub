<?php

class Project {
	
	public $id 					= 0;
	public $title 				= "";
	public $description 		= "";
	public $category 			= "";
	public $skills 				= array();
	public $featureImageUrl 	= "";
	public $status 				= "";
	public $likes 				= 0;
	public $createdTimestamp 	= "";
	public $videoUrl 			= "";
	public $fileShareUrl 		= "";
	public $location 			= "";
	public $createdBy_id 		= "";

	public function getProjectById(int $id)
	{
		// do something
	}

}
?>