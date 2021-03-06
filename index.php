<!-- 

THINGS THAT NEED TO BE DONE

	1. project stages breadcrumb 
	2. load more (now it's limited to 15 top result)
	4. search fillers
	3. Log in

 -->


<?php
	$pageTitle = "LDI ProjectHub";
	$style = "homepage";
	require('includes/include.php');
	include 'includes/header.php';
	include 'includes/navbar.php';

	//$tags = getProjectTags();
	//// something something searchTags()

if (is_null($_GET))
{
?>

 <script>

// function afterLogin(){
//   document.getElementById('header').style.height="700px";
//   document.getElementById('page-wrap').style.top="-400px";
// }
 </script>

<!-- LDI Title -->

<div id="header">
	<div class="container">	
		<div class="title">
			<p class="ldi">LDI</p><p class="ph">Project Hub</p>

			<!-- log in from  -->
			<div id="errors">
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
			<?php
			if ($user->isLoggedIn) {
				// echo "<script>afterLogin();</script>";
			} else {
				echo <<<HTML
				<form class="login" action="login.php" method="POST">
					<div class="inputBox"><input name="email" type="text" placeholder="Email" onclick="this.value='';"  onblur="this.value=!this.value?'Email':this.value;" value="Email" /></div>
					<div class="inputBox"><input name="password" type="password" placeholder="Password" onclick="this.value='';" /></div>
					<div class="inputBox"><button type="submit" class="button"><span style="float:left;">Sign in</span> <span class="bootstrap"><span class="glyphicon glyphicon-chevron-right right"></span></span></button></div>
				</form>
HTML;
			} ?>
			<!-- <img src="images/01d.png" class="titlePicture" alt="titlePicture" /> -->	<!-- LDI cartoon pic -->
		
		</div> <!-- /title -->



<!-- Feature Project -->
	<?php
		include 'components/featureBox.php';
	?>


	</div> <!-- End of Container -->
</div> <!-- End of Header -->

<?php 
} // END if GET is null block 
?>

<!-- Category and View  -->
<div class="container">	
	<div class="content">

		<p class="ProjectStages"> Project Stages : </p>

		<div class="breadcrumb">
			<a href="index.php?stage=Aspiration" class="active first">Aspiration</a>
			<a href="index.php?stage=Incubation" class="second">Incubation</a>
			<a href="index.php?stage=Implementation" class="third">Implementation</a>
			<a href="index.php?stage=Maturation" class="forth">Maturation</a>
		</div>

		<!-- Category -->
		<div class="bootstrap cate">
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Category</button>
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
			    <li><a href="index.php?category=Personal Development Project">Personal Development Project</a></li>
			    <li><a href="index.php?category=Social and Global Change Project">Social &amp; Global Change Project</a></li>
			    <li><a href="index.php?category=Student/Campus Community Project">Student/Campus Community Project</a></li>
			    <li><a href="index.php?category=Social Enterprise">Social Enterprise</a></li>
			    <li><a href="index.php?category=Business Enterprise">Business Enterprise</a></li>
			    <li><a href="index.php?category=Technical Innovation">Technical Innovation</a></li>
			  </ul>
			</div>
			<div class="btn-group">
				<input type="text" name="searchTags" id="tags" style="width: 219px" value="" />
			</div>
		</div>
		<div class="category">
			<ul class="view"> 
				<li>Order By : </li>
				<li>
					<select name ="viewBy">
					  <option value="likes DESC">Most liked</option>
					  <option value="likes">Least liked</option>
					  <option value="createdTimestamp DESC">Newest first</option>
					  <option value="createdTimestamp">Oldest first</option>
					</select>
				</li>
			</ul>
		</div>



<!-- Display Projects -->

<?php 

if (isset($_POST['search']) && $_GET['action'] == "search") 
{
	$result = projectSearch($_POST['search']);
}
else 
{
	$tags = getAllTags();
	// Set up default search filters
	$stage = (isset($_GET['stage'])) ? $_GET['stage'] : "Aspiration" ;
	$category = (isset($_GET['category'])) ? $_GET['category'] : "none";
	$skill = (isset($_GET['skill'])) ? $_GET['skill'] : "none";
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : "none";
	if ($category == "Social and Global Change Project") {$category = "Social &amp; Global Change Project";}

	// Figure what fillers are set then fetch from databse using below functions
	if($sort="none"){$sort= "likes DESC";}	// default sort by popularily (likes)
	if($category == "none" && $skill == "none")
	{
		$result = noCate_noSkill($stage,$sort);
	}
	else if($category == "none")
	{
		$result = noCate($skill,$stage,$sort);
	}
	else if($skill == "none")
	{
		$result = noSkill($category,$stage,$sort);
	}
	else 
	{
		$result = allFillers($category,$skill,$stage,$sort);
	}
}

if(checkCount($result)) // If there is result
{
	include 'includes/projectDisplay.php';		// Display projects	
}
else 
{ 	// if there isn't a result, display message no result
	echo "<h2><center> <br>Sorry :( We couldn't find any projects with the options you searched for. <br> Why not <a href='new-project.php'>Create your own?</a></center></h2>";
}	
 ?>


</div> <!-- end of contant -->
</div> <!-- end of container -->

<script type="text/javascript">
	$(document).ready(function() {
        $("input#tags").select2({
                      tags:["tag", "awesome" ],
                      tokenSeparators: [",", " "],
                      placeholder: "Search for tags",
                      formatNoMatches: "start typing"
                  });
    });

</script>
<?php
	include 'includes/footer.php';
?>


