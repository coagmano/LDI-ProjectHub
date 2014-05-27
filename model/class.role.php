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

}

?>