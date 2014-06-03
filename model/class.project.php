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
	
	public /*.User.*/ $createdBy = NULL;
	public $roles = array();
	public $teamMembers = array();
	public $blogPosts = array();
	public $comments = array();


	public function constructFromRow(array $row)
	{
		$this->projectId 		= $row['id'];
		$this->title 			= $row['title'];
		$this->summary 			= $row['summary'];
		$this->description 		= $row['description'];
		$this->category 		= $row['category'];
		$this->featureImageUrl 	= $row['featureImageUrl'];
		$this->stage 			= $row['stage'];
		$this->createdTimestamp = $row['createdTimestamp'];
		$this->videoUrl 		= $row['videoUrl'];
		$this->fileShareUrl 	= $row['fileShareUrl'];
		$this->location 		= $row['location'];

		$this->skills 			= $this->getSkills();
		$this->likes 			= $this->countLikes();
		$this->createdBy 		= $this->getCreatedBy();
		$this->roles			= $this->getRoles(); // Roles contain team members
		$this->teamMembers 		= $this->getTeamMembersFromRoles();
		$this->blogPosts		= $this->getBlogPosts();
		$this->comments			= $this->getComments();

	}

	public function getById($id)
	{
		$i = mysql_real_escape_string(sanitise($id));
		$sql = "SELECT *
				FROM Projects
				WHERE id = $i";
		$result = mysql_query($sql) or die("failed to getById: SQL=".$sql." <br>\n Error=".mysql_error());
		$row = mysql_fetch_assoc($result);
		$this->constructFromRow($row);

		return $this;
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

	public function getRoles()
	{
		global $hiddenMessage;
		$rs = array();

		$sql = "SELECT *
				FROM project_roles
				WHERE project_id = $this->projectId";
		$result = mysql_query($sql) or die(mysql_error()."\n".$sql);
		
		while ($row = mysql_fetch_assoc($result)) 
		{
			$r = new Role();
			$r->constructFromRow($row);
			$rs[] = $r;
		}
		return $rs;
	}

	private function getTeamMembersFromRoles()
	{
		$tms = array();
		foreach ($this->roles as $role) 
		{
			if (isset($role->filledBy)) { $tms[] = $role->filledBy; }
		}
		return $tms;
	}

	public function getBlogPosts()
	{
		global $hiddenMessage;
		$bps = array();

		$sql = "SELECT *
				FROM BlogPosts
				WHERE project_id = $this->projectId";
		$result = mysql_query($sql) or die(mysql_error());
		
		while ($row = mysql_fetch_assoc($result)) 
		{
			//var_dump($row);
			$bp = new BlogPost();
			$bp->constructFromRow($row);
			$bps[] = $bp;
		}
		return $bps;
	}

	public function getComments()
	{
		global $hiddenMessage;
		$cs = array();

		$sql = "SELECT *
				FROM Comments
				WHERE project_id = $this->projectId
				AND private = 0";
		$result = mysql_query($sql) or die(mysql_error());
		
		while ($row = mysql_fetch_assoc($result)) 
		{
			$c = new Comment();
			$c->constructFromRow($row);
			$cs[] = $c;
		}
		return $cs;
	}

	public function getPrivateComments()
	{
		global $hiddenMessage;
		$cs = array();

		$sql = "SELECT *
				FROM Comments
				WHERE project_id = $this->projectId
				AND private = 1";
		$result = mysql_query($sql) or die(mysql_error());
		
		while ($row = mysql_fetch_assoc($result)) 
		{
			$c = new Comment();
			$c->constructFromRow($row);
			$cs[] = $c;
		}
		return $cs;
	}

	public function getSkills()
	{
		$tags = Array();
		$sql = "SELECT tag, COUNT(*) freq
		        FROM tags
		        WHERE project_id = $this->projectId
		        GROUP BY tag
		        ORDER BY freq DESC";
		$result = mysql_query($sql) or die("Error getting tags: ".mysql_error());
		while ($row = mysql_fetch_assoc($result)) 
		{
		    $tags[] = $row['tag'];
		}
		return $tags;
	}

	public function getJoinRequests()
	{
		$requests = Array();
		$sql = "SELECT *
		        FROM project_requests
		        WHERE project_id = $this->projectId ";
		$result = mysql_query($sql) or die("Error getting tags: ".mysql_error());
		while ($row = mysql_fetch_assoc($result)) 
		{
		    $request = new JoinRequest();
		    $request->constructFromRow($row);
		    $requests[] = $request;
		}
		return $requests;
	}

	public function countLikes()
	{
		global $hiddenMessage;
		$sql = "SELECT COUNT(*) as likes
				FROM project_likes
				WHERE project_id = '$this->projectId'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		return $row['likes'];
	}

	public function countTeam() 
	{
		$i = 1; // Starts at 1 because of project creator

		foreach ($this->roles as $role) 
		{
			if (isset($role->filledBy)) { $i++; }
		}

		return $i;
	}

	public function countEmptyRoles() 
	{
		$i = 0;

		foreach ($this->roles as $role) 
		{
			if (is_null($role->filledBy)) { $i++; }
		}

		return $i;
	}

	public function countBlogPosts() 
	{
		$i = 0;

		foreach ($this->blogPosts as $blog) 
		{
			if (isset($blog)) { $i++; }
		}

		return $i;
	}

	public function countComments() 
	{
		$i = 0;

		foreach ($this->comments as $comment) 
		{
			if (isset($comment)) { $i++; }
		}

		return $i;
	}

	public function saveToDatabase()
	{
		global $hiddenMessage, $errors; // Use hiddenMessage for debug messages
		if (projectExists($this->projectId)) 
		{
			// For existing projects, delete all tags before update.
			$tagDeleteSql = "DELETE FROM tags WHERE project_id = ".$this->projectId;
			$tagDeleteResult = mysql_query($tagDeleteSql) or die("Error clearing tags before update: ".mysql_error());
			$sql = 
			   'UPDATE Projects
		    	SET 
				title ="'.$this->title.'",
				summary ="'.$this->summary.'",
				description = "'.$this->description.'",
				category ="'.$this->category.'",
				stage = "'.$this->stage.'",
				featureImageUrl = "'.$this->featureImageUrl.'",
				createdTimestamp = "'.$this->createdTimestamp.'",
				videoUrl = "'.$this->videoUrl.'",
				location = "'.$this->location.'",
				createdBy_id = "'.$this->createdBy_id.'"
		   		WHERE
			    id = "'.$this->projectId.'"';
		    $type = "UPDATE";
		    $hiddenMessage .= $sql."<br>";

		} 
		else 
		{
			$sql = 'INSERT INTO Projects
					(title, summary, description, category, stage, featureImageUrl, createdTimestamp, videoUrl, location, createdBy_id)
			    	VALUES (
			    	"'.$this->title.'", 
					"'.$this->summary.'", 
					"'.$this->description.'", 
					"'.$this->category.'", 
					"'.$this->stage.'", 
					"'.$this->featureImageUrl.'", 
					"'.$this->createdTimestamp.'", 
					"'.$this->videoUrl.'", 
					"'.$this->location.'", 
					"'.$this->createdBy->userId.'
					")';

			$type = "INSERT";
			$hiddenMessage .= $sql."<br>";
		}

		$result1 = mysql_query($sql) or die(mysql_error());
		if ($type == "INSERT") { $this->projectId = mysql_insert_id(); }

		$tagInsertSql = 'INSERT INTO tags (tag, project_id) VALUES';
		for ($i=0; $i < count($this->skills); $i++) 
		{ 
			$tagInsertSql .= '("'.$this->skills[$i].'", '.$this->projectId.')';
        	if ($i != (count($this->skills)-1)) 
        	{ 
        		$tagInsertSql .= ", "; 
        	}
		}

        $result2 = mysql_query($tagInsertSql) or die(mysql_error());

		if ($result1 && $result2) { return true; } 
		else
		{
			$errors[] = "Error saving Project to database: ".mysql_error();
			return false;
		}
	}
}
?>