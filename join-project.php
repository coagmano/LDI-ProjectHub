<?php
/**
 * @src /join-project.php
 * Join Project page
 * @author Fred Stark
 */
require_once('includes/include.php');

// Set page settings
$pageTitle = "Collaborate - ProjectHub";
$style = "project";

//User must be logged in
if (!$user->isLoggedIn){ header("Location: http://".$_SERVER['HTTP_HOST']); die(); }
if(empty($_GET))
{
	if(empty($_POST)) {
		echo "<script>history.go(-1);</script>";
		die();
	}
}

$roleId = (isset($_GET['role'])) ? $_GET['role'] : "" ;

$project = new Project();
if (isset($_GET['id'])) {
	$project->getById($_GET['id']);
} else {
	$project->getById($_POST['project']);
}

// Process creation if forms posted
if(!empty($_POST))
{

	//Perform some validation
	// if(strlen($title) == 0 )
	// {
	// 	$errors[] = "Looks like you forgot to enter a title! A title helps draw attention to your project.";
	// }
	

	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a project object and populate its variables

		$joinRequest 				= new JoinRequest();
		$joinRequest->projectId		= $_POST["project"];
		$joinRequest->user			= $user;
		$joinRequest->message		= $_POST["message"];
		$joinRequest->role 			= new Role();
		if ($_POST['role'] !== "") { $joinRequest->role->getById($_POST['role']); }
		
		// Persist new project to database
		$result = $joinRequest->saveToDatabase();
		if($result) 
		{ 
			$message[] = "Request sent successfully";
			$_SESSION['message'] = $message;
			$user->tags = explode(',', $_POST['skills']);
			$result = $user->saveToDatabase();
			if (!$result) {
				$errors[] = "could not add skills"; 
			} else {
                header("Location: http://".$_SERVER['HTTP_HOST']."/project.php?id=".$_POST["project"]);
                die();
            }

		}
		else
		{
			$message[] = $result;
            $_SESSION['message'] = $message;
		}
	}
}

// Load form
include 'includes/header.php';
include 'includes/navbar.php';

echo <<<HTML
<div class="container">	
	<div class="content">
        <div class="projectTitle bootstrap">
            <h1>Join $project->title <br/>
            <small> </small>
            </h1>
        </div>

        <div id="success">
HTML;
    if (isset($message)) {
        foreach ($message as $message) { echo "<p class='message'>".$message."</p>"; }
        unset($_SESSION['message']);
    } 
    if (isset($errors)) {
        foreach ($errors as $error) { echo "<p class='error'>".$error."</p>"; }
        unset($_SESSION['errors']);
    }
echo <<<HTML
        </div>
        
        <div class="boxLayout">
            <div id="regbox" class="bootstrap">
                <form name="join" action="{$_SERVER['PHP_SELF']}" method="post">
                
                <p>
                    <label><h3>Write a quick message to the team</h3></label>
                    <small>Tell why you want to work on "{$project->title}" </small><br>
                    <textarea name="message" id="message"></textarea>
                </p>
                <p>
                    <label><h3>What skills do you bring?:</h3></label>
HTML;
?>                    <input type="text" id="skills" name="skills" style="width:33%" value="<?php echo implode(", ", $user->tags); ?>"/>
<?php echo <<<HTML
                </p>
                <p>
                	<input type="hidden" name="project" value="{$project->projectId}" />
                	<input type="hidden" name="role" value="{$roleId}" />
                    <button type="submit" name="submit" value="submit" class="btn btn-success">Send Request</button>
                </p>

            	</form>
        
          	</div>
        </div>
  	</div>
</div>
HTML;
?>
<script>
    $(function() {
        $('#message').editable({
            inlineMode: false,   
            language: 'en_gb',
             buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline']
        });
    });
	
	$("#skills").select2({
                      tags: [],
                      tokenSeparators: [",", " "],
                      placeholder: "type your skills separated by commas",
                      formatNoMatches: "type to search or add new skills"
                  });
</script>
<?php
include('includes/footer.php');
?>