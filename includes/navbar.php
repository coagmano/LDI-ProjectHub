<body>

<!-- 	Navegation Bar  -->

<div class="navbarBackground"></div>	
<div class="container">		

	<div class="navbar">
	  <ul class="left"> 
		<li><a href="#">LDI ProjectHub</a></li> 
		<li><a href="#">LDI CareerHub</a></li> 
		<li> | </li> 
		<li><a href="#">Discover</a></li> 
		<li><a href="#">Create</a></li> 
		<li> | </li> 
	  </ul> 


	  <!-- Search button by bootstrap -->
			<div class="bootstrap"><div class="row">
			  <div class="col-lg-6">
			    <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">
						<span class="glyphicon glyphicon-search"></span>
			        </button>
			      </span>
			      <input type="text" class="form-control">
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			</div><!-- /.row --></div>
		</a></li> 
	  </ul> 
<?php
	if ($user->isLoggedIn) {
		echo <<<EOD
	 <ul class="right">
	  	<li><a href="logout.php">Log out</a></li>
	  </ul>
EOD;
	} else {
	 echo <<<EOD
	 <ul class="right">
	  	<li><a href="#">Register</a></li>
	  </ul>
EOD;
	} ?>
	</div>
</div>
