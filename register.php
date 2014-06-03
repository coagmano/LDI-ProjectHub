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


// Process registration if forms posted
if(!empty($_POST))
{
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
    $profilePicUrl = "none.png"; // Set default image, if one is uploaded the var is overwritten

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
    if (isset($_FILES)) 
    {
        if($_FILES['profilePic']['error'] > 0){
            $errors[] = 'An error ocurred when uploading.';
        }
        if(!getimagesize($_FILES['profilePic']['tmp_name'])){
            $errors[] = 'Please ensure you are uploading an image.';
        }
        // Check filetype
        if(!in_array($_FILES['profilePic']['type'], array('image/jpg','image/jpeg','image/png','image/gif'))) {
            $errors[] = 'Unsupported filetype uploaded.';
        }
        // Check filesize
        if($_FILES['profilePic']['size'] > 500000){
            $errors[] = 'File uploaded exceeds maximum upload size.';
        }
        // Set new filename based off image contents
        $profilePicUrl = sha1_file($_FILES['profilePic']['tmp_name']);
        // Check if the file exists
        if(!file_exists('images/profile/'.$profilePicUrl)) {
            // Upload profile image
            if(!move_uploaded_file($_FILES['profilePic']['tmp_name'], 'images/profile/' . $profilePicUrl)) {
                $errors[] = 'Error uploading file - check destination is writeable.';
            }
        } // Else fall back to existing image
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
		$user->profilePicUrl 		= $profilePicUrl;
		$user->isLoggedIn 			= true;
		$user->signupTimeStamp 		= time();

		$user->tags 				= array_map('trim',explode(",",$_POST["tags"]));
		
		// Persist new User to database
		$result = $user->saveToDatabase();
		if($result) 
		{ 
			$message[] = "Account created successfully";
            $_SESSION['user'] = $user;
			header('Location: index.php?search=');

		}
		else
		{
			$message[] = $result;
			
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
            if (isset($message)) {
                foreach ($message as $message) { echo "<p class='message'>".$message."</p>"; }
                unset($_SESSION['message']);
            } 
            if (isset($errors)) {
                foreach ($errors as $error) { echo "<p class='error'>".$error."</p>"; }
                unset($_SESSION['errors']);
            } 
        ?>
        </div>

        <div class="boxLayout">
            <div id="regbox">
                <form name="register" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
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
                    <label>QUT Student Number</label>
                    <input type="text" name="studentNo" />
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
                    <input type="text" name="tags" id="tags" style="width:33%" value="<?php echo implode(", ", $user->tags); ?>" />
                </p>

                <p>
                    <label>Profile Photo:</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
                    <input type="file" name="profilePic" accept="image/*" />
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
        $("#tags").select2({
                      tags: [<?php echo('"'.implode('", "', getAllTags()).'"'); ?>],
                      tokenSeparators: [",", " "],
                      placeholder: "type your skills separated by commas",
                      formatNoMatches: "type to search or add new skills"
                  });
    });
</script>

<?php
include('includes/footer.php');
?>