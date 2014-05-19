<!-- 

THINGS THAT NEED TO BE DONE

	1. project stages breadcrumb 
	2. load more
	3. Log in

 -->


<?php
	$pageTitle = "LDI ProjectHub";
	include 'includes/include.php';
?>



<!-- LDI Title -->

<div class="header">
	<div class="container">	
		<div class="title">
			<p class="ldi">LDI</p><p class="ph">Project Hub</p>

			<!-- log in from  -->
			<div class="bootstrap">
				<form class="form-horizontal loginForm" role="form">
				  <div class="form-group">
				  	<p> Login </p>
				    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <div class="checkbox">
				        <label>
				          <input type="checkbox"> Remember me
				        </label>
				      </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-default">Sign in</button>
				    </div>
				  </div>
				</form>
			</div>
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


<!-- 	 This section should be auto generated using SQL, this is a demo HTML table  --> 
<?php 
	// Set up search fillers
	$status = "Developing";
	$category = "none";
	$skill = "none";
	$sort = "none";
	include 'functions/projectDisplay.php';		// Fetch from database

	$percentage = progress($status);			

	if(checkCount($result)){					// If there is result
		
		echo "<div class='displayProjects'>
				<table class='projects'>
					<tr>";

		$colum = 1;
		while ($row = mysql_fetch_assoc($result)) {

			if($colum==1){echo "<tr>";}	// a new row

			echo 	"<td>
						<div class='box'>";
							//	Image
			echo			"<img src='images/{$row["featureImageUrl"]}' alt='{$row["featureImageUrl"]}' />	";
							//  Title
			echo			'<h2 class="projectTitle">'.$row["title"].'</h2>';	
							//  Description 
			echo			'<p class="descrption">'.$row["description"].'</p>';
							//  Tags
			echo			'<p class="tags"><a href="#">Category</a><a href="#">Skill</a></p>';
							//  Progress bar (bootstrap)
			echo			"<div class='bootstrap'><div class='progress'>
							 <div class='progress-bar {$status}' role='progressbar' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100' style='width: {$percentage}%;'>
							    <span class='{$status}Label'>{$status}({$percentage}%)</span>
							  </div>
							</div></div>";
							//  Status
			echo			'<p class="status">';
								//  Number of collaborators
			echo				'<span class="bootstrap"><span class="glyphicon glyphicon-user"></span> 3';
								//  Number of groupmates looking for
			echo				"<span class='middle'><span class='glyphicon glyphicon-search'></span> 2</span>";
								//  Number of likes
			echo				"<span class='right'><span class='glyphicon glyphicon-thumbs-up'></span> {$row["likes"]}</span>
							</p>
						</div>
					</td>";

			// Display 3 <td> per row
			if($colum!=3){$colum++;} else{$colum=1; echo "</tr>";}
		}
	}			
 ?>

	</table>
</div>	

<div class="bootstrap loadmore"><button type="button" class="btn btn-primary">Load more</button></div>


</div> <!-- end of contant -->
</div> <!-- end of container -->


<?php
	include 'includes/footer.php';
?>


