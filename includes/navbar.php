<body>

<!-- 	Navegation Bar  -->

<div class="navbarBackground"></div>	
<div class="container">		

	<div class="navbar">
	  <ul class="left navUl"> 
		<li><a href="#">LDI CareerHub</a></li> 
		<li> | </li> 
		<li><a href="./"><span class="bootstrap"><span class="glyphicon glyphicon-home"></span></span></a></li> 
		<li><a href="#">Discover</a></li> 
		<li><a href="new-project.php">Create</a></li> 
		<li> | </li> 
		<li class="bootstrap search">
			<span class="glyphicon glyphicon-search"></span>
			<form class="searchForm" action="#" method="POST">
				<input type="text" name="search" placeholder="Search" onclick="this.value='';"  onblur="this.value=!this.value?'Search':this.value;" value="Search"> </input> 
			</form>
		</li>
	  </ul> 
<?php
if ($user->isLoggedIn) 
{
	echo <<<HTML
	 <ul class="right navUl">
	 	<li class="bootstrap li">   
	 		<span class="dropdown">
		      <a class="dropdown-toggle dropDown" data-toggle="dropdown" href="#">
		
			        <span class="navProfileImg">
						<img src="images/profile/{$user->profilePicUrl}" alt="profilePic" />
		 			</span>	
					<span class="down"><span class="glyphicon glyphicon-chevron-down"></span>

		      </a>
		      <ul class="dropdown-menu">
		         <li><a href="#">My Account</a></li>
		         <li><a href="#">My Projects</a></li>
		         <li><a href="#">Edit profile</a></li>
		         <li class="divider"></li>
		         <li><a href="logout.php">Log out</a></li>
		      </ul>
  			</span>
	 	</li>
	  </ul>
HTML;
}
else 
{
	echo <<<HTML
	 <ul class="right navUl">
	  	<li class="li"><a class="button" href="register.php">Register</a></li>
	  </ul>
HTML;
} 
?>
	</div>
</div>
