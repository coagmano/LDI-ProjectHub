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
           	    if (isset($message)) { echo "<p class='message'>".$message."</p>"; }
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



<!-- Category and View  -->
<div class="container">	
	<div class="content">

		<p class="ProjectStages"> Project Stages : </p>

		<div class="breadcrumb">
			<a href="#" class="active first">Aspiration</a>
			<a href="#" class="second">Incubating </a>
			<a href="#" class="third">Developing</a>
			<a href="#" class="forth">Mature</a>
		</div>

		<!-- Prefixfree -->
		<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript">
		</script>


		<!-- Category -->
		<div class="bootstrap cate">
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Category</button>
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
			    <li><a href="#">Category 1</a></li>
			    <li><a href="#">Category 2</a></li>
			    <li><a href="#">Category 3</a></li>
			    <li><a href="#">Category 4</a></li>
			  </ul>
			</div>
			<div class="btn-group">
				<input type="text" name="searchTags" id="tags" style="width:100%" value="" />
			  <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Required Skills</button>
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button> -->
			  <div class="" role="menu">
			  <!-- <select class="dropdown-menu" role="menu">
				<?php 
			    // foreach ($tags as $tag) {
			    // 	echo "<option>{$tag}</option>";
			    // }
			    ?>
			  </select> -->
			  </div>
			</div>
		</div>
		<div class="category">
			<ul class="view"> 
				<li>View By : </li>
				<li>
					<select name ="viewBy">
					  <option value="something">Something</option>
					  <option value="something">something</option>
					  <option value="something">something</option>
					  <option value="something">something</option>
					</select>
				</li>
			</ul>
		</div>



<!-- Display Projects -->

<?php 
	// Set up default search filters
	$stage = "Aspiration";
	$category = "none";
	$skill = "none";
	$sort = "none";
	
	// Figure what fillers are set then fetch from databse using below functions
	if($sort="none"){$sort= "id";}	// default sort by popularily (likes)
	if($category = "none" && $skill = "none")
		{
			$result = noCate_noSkill($stage,$sort);
		}
	else if($category = "none")
		{
			$result = noCate($skill,$stage,$sort);
		}
	else if($skill = "none")
		{
			$result = noSkill($category,$stage,$sort);
		}
	else 
		{
			$result = allFillers($category,$skill,$stage,$sort);
		}

	if(checkCount($result)) // If there is result
	{
		include 'includes/projectDisplay.php';		// Display projects	
	}
	else 
	{ 	// if there isn't a result, display message no result
		echo "<h2><center> <br/> <br/> Sorrry :( There is no project at the moment. <br /> Why not <a href='new-project.php'>Create your own?</a></center></h2>";
	}	
 ?>


</div> <!-- end of contant -->
</div> <!-- end of container -->

<script type="text/javascript">

	$("#tags").select2({
                      tokenSeparators: [",", " "],
                      placeholder: "Search by Required Skills",
                      formatNoMatches: "Hit enter to search"
                  });

</script>
<?php
	include 'includes/footer.php';
?>


