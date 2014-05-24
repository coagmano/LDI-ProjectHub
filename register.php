<?php
/**
 * Register.php
 * User registration page
 */
require_once('includes/include.php');


if ($user->isLoggedIn){ header("Location: index.php"); die(); }

$errors = array();
$message = "";

// Process registration if forms posted
if(!empty($_POST))
{
	//Sanitise entire POST array
	$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	$errors = array();
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
		$user->signupTimeStamp 	= time();

		$user->tags 				= array_map('trim',explode(",",$_POST["tags"]));
		
		var_dump($user);
		// Persist new User to database
		$result = $user->saveToDatabase();
		if(!$result) 
		{ 
			var_dump($result);
			$errors[] = $result; 
		}
		else
		{
			$message = "Account created successfully";
			//header('Location: dashboard.php');
		}
	}
}
	// Load registration form
	include 'includes/header.php';
	include 'includes/navbar.php';
?>

        <div id="success">
        
           <p><?php echo $message ?></p>
           
        </div>
        <div id="errors">
        
           <p><?php foreach ($errors as $error) { echo $error; } ?></p>
           
        </div>

            <div id="regbox">
                <form name="register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                
                <p>
                    <label>First Name:</label>
                    <input type="text" name="firstName" />
                </p>
                <p>
                    <label>Last Name:</label>
                    <input type="text" name="lastName" />
                </p>

                <p>
                    <label>About you:</label>
                    <input type="text" name="blurb" />
                </p>

                <p>
                    <label>Profile Photo:</label>
                    <input type="text" name="profilePicUrl" />
                </p>

                <p>
                    <label>Email:</label>
                    <input type="email" name="email" />
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
                    <label>Email:</label>
                    <input type="text" name="email" />
                </p>
                <p>
                    <input type="submit" name="Register" value="Register" />
                </p>

            	</form>
    
      </div>           
      </div>


 <?php
 include('includes/footer.php');
 ?>