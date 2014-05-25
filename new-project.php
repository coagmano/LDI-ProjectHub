<?php
/**
 * @src /new-project.php
 * New Project creation page
 * @author Fred Stark
 */
require_once('includes/include.php');

// Set page settings
$pageTitle = "Create your vision - ProjectHub";
$style = "homepage";

//User must be logged in
if (!$user->isLoggedIn){ header("Location: index.php"); die(); }

$errors = array();
$message = "";

// Process creation if forms posted
if(!empty($_POST))
{
	$title = trim($_POST["title"]);
	$description = trim($_POST["description"]);

	//Perform some validation
	if(strlen($title) == 0 )
	{
		$errors[] = "Looks like you forgot to enter a title! A title helps draw attention to your project.";
	}
	

	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a project object and populate its variables
		$project = new Project();

		$project->title				= $_POST["title"];
		$project->summary			= $_POST["summary"];
		$project->description		= $_POST["description"];
		$project->category			= $_POST["category"];
		$project->skills			= array_map('trim',explode(",",$_POST["skills"]));
		$project->featureImageUrl	= $_POST["featureImageUrl"];
		$project->status			= "Aspiration";
		$project->createdTimestamp	= time();
		$project->videoUrl			= $_POST["videoUrl"];
		//$project->fileShareUrl		= $_POST["fileShareUrl"];
		$project->location			= $_POST["location"];
		$project->createdBy_id		= $user->userId;
		
		// Persist new project to database
		$result = $project->saveToDatabase();
		if($result) 
		{ 
			$message .= "Account created successfully";

		}
		else
		{
			$message .= $result;
		}
	}
}

// Load form
include 'includes/header.php';
include 'includes/navbar.php';
?>
<div class="container">	
	<div class="content">
        <div id="success">
        
           <p><?php echo $message ?></p>
           
        </div>
        <div id="errors">
        
           <p><?php foreach ($errors as $error) { echo $error; } ?></p>
           
        </div>

        <div id="regbox">
            <form name="register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            
            <p>
                <label>title</label>
                <input type="text" name="title" />
            </p>
            <p>
                <label>summary:</label>
                <textarea name="summary" id="summary"></textarea>
            </p>
            <p>
                <label>description:</label>
                <textarea name="description" id="description"></textarea>
            </p>

            <p>
                <label>category:</label>
                <select name="category">
                	<option value="personal excellence">Personal Excellence</option>
                	<option value="social change">social change</option>
                	<option value="community leadership">community leadership</option>
                	<option value="something else">something else</option>
                </select>
            </p>
            <p>
                <label>What skills do you need for the proejct?:</label>
                <input type="text" name="skills" />
            </p>
            <p>
                <label>Featured Image:</label>
                <input type="text" name="featureImageUrl" />
            </p>
            
            <p>
                <label>Location:</label>
                <input type="text" name="location" />
            </p>
            <p>
                <input type="submit" name="Get Started" value="Get Started" />
            </p>

        	</form>
    
      	</div>           
  	</div>
</div>
<script>
    $(function() {
        $('#summary').editable({inlineMode: false, width: 800})
        $('#description').editable({inlineMode: false, width: 800})
    });
</script>

<?php
include('includes/footer.php');
?>