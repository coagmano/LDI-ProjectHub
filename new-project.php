<?php
/**
 * @src /new-project.php
 * New Project creation page
 * @author Fred Stark
 */
require_once('includes/include.php');

// Set page settings
$pageTitle = "Create your vision - ProjectHub";
$style = "project";

//User must be logged in
if (!$user->isLoggedIn){ header("Location: http://".$_SERVER['HTTP_HOST']); die(); }

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
		$project->stage			    = "Aspiration";
		$project->createdTimestamp	= time();
		$project->videoUrl			= $_POST["videoUrl"];
		//$project->fileShareUrl	= $_POST["fileShareUrl"];
		$project->location			= $_POST["location"];
		$project->createdBy		    = $user;
		
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
        <div class="projectTitle bootstrap">
            <h1>Let’s get your project started!<br/>
            <small>( Don't worry, you can come back and change this later )</small>
            </h1>
        </div>

        <div id="success">
        <?php 
            if (isset($message)) { echo "<p class='message'>".$message."</p>"; }
            if (isset($errors)) {
                foreach ($errors as $error) { echo "<p class='error'>".$error."</p>"; }
                unset($_SESSION['errors']);
            } 
        ?>
            </p>
        </div>
        
        <div class="project">
            <div id="regbox">
                <form name="register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                
                <p>
                    <label><h2>What are you going to call your grand idea?</h2></label>
                    <input type="text" name="title" />
                </p>
                <p>
                    <label><h2>So what's the pitch?</h2></label>
                    <small>This short description will be at the top of your campaign page and should tell them what your campaign is about in 200 characters or less</small>
                    <textarea name="summary" id="summary"></textarea>
                </p>
                <p>
                    <label><h2>Here's where you get to flesh out all the details:</h2></label>
                    <small>We put this here are just to help, write whatever you want</small>
                    <textarea name="description" id="description">
                        <h2>A little bit of context</h2>
                        <em>[Set the scene. Zoom right out and set the scene for your audience. Many of them will already know this, but it moves their brain into the right frame to introduce what you’re doing.]</em><br>
                         <br>
                        <h2>But there’s a problem</h2>
                        <em>[Explain what the problem is in the current context. Normally there’s something broken in the current context or there’s an opportunity – whichever it is, tell people what the issue is, before you tell them how you’re going to solve (or take advantage of) it.]</em><br>
                         <br>
                        <h2>Here’s what we’re doing about it</h2>
                        <em>[What are you doing to solve the issue? This is where you talk about what you’re going to do. Keep it simple and specific.]</em><br>
                         <br>
                        And what you hope to achieve<br>
                        <em>[How will what you do change the world? Here’s where you talk about how what you’re doing will make a difference.]</em><br>
                         <br>
                        <h2>You can join us</h2>
                        <em>[Every leader needs followers, encourage people to join you! Explain briefly what people can expect to put in and get out]</em><br>
                    </textarea>
                </p>

                <p>
                    <label><h2>What category does it fit best?</h2></label>
                    <select name="category">
                    	<option value="personal excellence">Personal Excellence</option>
                    	<option value="social change">social change</option>
                    	<option value="community leadership">community leadership</option>
                    	<option value="other">something else</option>
                    </select>
                </p>
                <p>
                    <label><h2>What skills do you need for the project?:</h2></label>
                    <input type="text" name="skills" id="skills"style="width:33%" value="<?php echo implode(", ", $user->tags); ?>" />
                </p>
                <p>
                    <label><h2>Do you have a photo or image to feature on your page?</h2></label>
                    <input type="file" name="featureImageUrl" accept="image/*">
                </p>
                <p>
                    <label><h2>Have a video that shows off your idea?</h2></label>
                    <small>Just enter the web address to a youtube or vimeo video</small><br>
                    <input type="text" name="videoUrl" />
                </p>
                
                <p>
                    <label><h2>Where are you doing this?</h2></label>
                    <small>GP or KG campus? Somewhere else?</small><br>
                    <input type="text" name="location" />
                </p>
                <p>
                    <input type="submit" name="Get Started" value="Get Started" />
                </p>

            	</form>
        
          	</div>
        </div>
  	</div>
</div>
<script>
    $(function() {
        $('#summary').editable({
            inlineMode: false, 
            width: 800,  
            language: 'en_gb',
             buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline']
        });
        $('#description').editable({
            inlineMode: false, 
            width: 800,  
            language: 'en_gb'
        });

        $("#skills").select2({
                      tokenSeparators: [",", " "],
                      placeholder: "type your skills separated by commas",
                      formatNoMatches: "type to search or add new skills"
                  });
    });
</script>

<?php
include('includes/footer.php');
?>