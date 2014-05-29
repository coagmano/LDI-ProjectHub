<?php
/**
 * @src /register.php
 * User registration page
 * @author Fred Stark
 */
require_once('includes/include.php');

// Set page settings
$pageTitle = "Register - ProjectHub";
$style = "project";


if ($user->isLoggedIn)
{ 
    header("Location: http://".$_SERVER['HTTP_HOST']); 
    die(); 
}

$errors = array();
$message = "";

// Process registration if forms posted
if(!empty($_POST))
{
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);

	//Perform some validation
	if(strlen($password) < 6 )
	{
		$errors[] = "Password must be 6 or more characters long";
	}
	else if($password != $confirm_pass)
	{
		$errors[] = "Passwords do not match";
	}
	if(!isValidEmail($email))
	{
		$errors[] = "Please enter a valid email address";
	}
	if(userExists($email))
	{
		$errors[] = "An account with that email already exists. Do you want to <a href='login.php'>Login instead?</a>";
	}

	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object and populate it's variables
		$user = new User();

		$user->email 				= $email;
		$user->hashPass 			= sha1($password);
		$user->firstName 			= $_POST["firstName"];
		$user->lastName 			= $_POST["lastName"];
		$user->blurb 				= $_POST["blurb"];
		$user->profilePicUrl 		= $_POST["profilePicUrl"];
		$user->isLoggedIn 			= true;
		$user->signupTimeStamp 		= time();

		$user->tags 				= array_map('trim',explode(",",$_POST["tags"]));
		
		// Persist new User to database
		$result = $user->saveToDatabase();
		if($result) 
		{ 
			$message .= "Account created successfully";
			//header('Location: dashboard.php');

		}
		else
		{
			$message .= $result;
			
		}
	}
}
	// Load registration form
	include 'includes/header.php';
	include 'includes/navbar.php';
?>
<div class="container">	
	<div class="content">

        <div class="projectTitle bootstrap">
            <h1>Join ProjectHub<br/>
            <small> </small>
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
        </div>

        <div class="project">
            <div id="regbox">
                <form name="register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <small>To become a member of ProjectHub, you must be an LDI member on CareerHub.</small>
                <p>
                    <label>First Name:</label>
                    <input type="text" name="firstName" />
                </p>
                <p>
                    <label>Last Name:</label>
                    <input type="text" name="lastName" />
                </p>

                <p>
                    <label>Email:</label>
                    <input type="email" name="email" />
                </p>

                <p>
                    <label>About you:</label>
                    <textarea name="blurb" id="blurb"></textarea>
                </p>
                <p>
                    <label>Your skills and interests:</label>
                    <input type="text" name="tags" />
                </p>

                <p>
                    <label>Profile Photo:</label>
                    <input type="text" name="profilePicUrl" />
                </p>
                
                <p>
                    <label>Password:</label>
                    <input type="password" name="password" />
                </p>
                
                <p>
                    <label>Re-type Password:</label>
                    <input type="password" name="passwordc" />
                </p>
                <p>
                    <input type="submit" name="Register" value="Register" />
                </p>

            	</form>
        
          	</div>
        </div>           
  	</div>
</div>
<script>
    $(function() {
        $('#blurb').editable({
        	inlineMode: false, 
        	width: 800,  
        	language: 'en_gb',
        	 buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline']
        })
    });
</script>

<?php
include('includes/footer.php');
?>