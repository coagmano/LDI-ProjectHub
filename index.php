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
?>



<!-- LDI Title -->

<div class="header">
	<div class="container">	
		<div class="title">
			<p class="ldi">LDI</p><p class="ph">Project Hub</p>

			<!-- log in from  -->
			<?php
			if ($user->isLoggedIn) {
				echo <<<EOD
				<div class="bootstrap">
				<form class="form-horizontal loginForm" role="form" action="login.php" method="post">
				  <div class="form-group">
				  	<p> You have successfully logged in! </p>
			  	</div>
		  	</form>
		  	</div>
EOD;
			} else {
				include 'includes/_loginform.html';
			} ?>
			<img src="images/01d.png" class="titlePicture" alt="titlePicture" />	<!-- LDI cartoon pic -->
		</div> <!-- /bootstrap -->



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
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Required Skills</button>
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu" role="menu">
			    <li><a href="#">Skill 1</a></li>
			    <li><a href="#">Skill 2</a></li>
			    <li><a href="#">Skill 3</a></li>
			    <li><a href="#">Skill 4</a></li>
			  </ul>
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
	// Set up search fillers
	$status = "Aspiration";
	$category = "none";
	$skill = "none";
	$sort = "none";
	include 'functions/fetchProjects.php';		// Fetch from database

	$percentage = progress($status);			// this is for the progress bar 

	include 'functions/projectDisplay.php';		// Display projects	
 ?>




</div> <!-- end of contant -->
</div> <!-- end of container -->


<?php
	include 'includes/footer.php';
?>


