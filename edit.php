<?php
$style = "dashboard";
require_once('includes/include.php');
// $project = new Project(); 
// $project->getById($_GET['id']);
// $pageTitle = "$project->title";
include 'includes/header.php';
include 'includes/navbar.php';

//User must be logged in
if (!$user->isLoggedIn){ header("Location: http://".$_SERVER['HTTP_HOST']); die(); }

// if(empty($_GET))
// {
// 	header("Location: http://".$_SERVER['HTTP_HOST']);
// 	die();
// }

?>

<div class="container dashboard">

	<!-- Nav bar -->

	<div class="dashboard-nav">
		<ul>
			<li class="first"><a href="dashboard.php">Dashboard</a></li>
			<li class="active"><a href="edit.php">Edit Project</a></li>
      <li><a href="roles.php">Assign roles</a></li>
			<li><a href="#">Updates</a></li>
			<li class="last"><a href="#">Team members</a></li>
		</ul>
	</div>

</div>

<!-- From Start (There's no action on this from) -->

<div class="container">
	<div class="boxLayout editProject bootstrap">
	<form class="form-horizontal editForm" role="form">

<!-- Title -->
  <div class="form-group">
    <label class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Project Name">
      <p class="form-control-static"> What are you going to call your grand idea? </p>
    </div>
  </div>

<!-- Category -->
  <div class="form-group">
    <label class="col-sm-2 control-label">Category</label>
    <div class="col-sm-10">
      <select class="form-control">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
      </select>
       <p class="form-control-static"> What category does it fit best? </p>
    </div>
  </div>


<!-- Pitch text -->
  <div class="form-group">
    <label class="col-sm-2 control-label">Pitch text</label>
    <div class="col-sm-10">
        <textarea name="summary" id="summary"></textarea>
      <p class="form-control-static pitchText"> This short description will be at the top of your project page and should tell them what your project is about in 200 characters or less </p>
    </div>
  </div>

  
<!-- Upload Image -->
  <div class="form-group uploadImage">
    <label class="col-sm-2 control-label">Image</label>
    <div class="col-sm-10">
      <input id="uploadFile" placeholder="Choose File" disabled="disabled" />
      <div class="fileUpload btn">
          <span>Upload Image</span>
          <input id="uploadBtn" type="file" class="upload"  name="featureImageUrl" accept="image/*" />
      </div>
      <p class="form-control-static"> Do you have a photo or image to feature on your page? <br/>This image will be the first thing people see when they land on your project! </p>
    </div>
  </div>


<!-- Video -->
  <div class="form-group video">
    <label class="col-sm-2 control-label">Video</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="https://www.youtube.com/watch?v=">
      <p class="form-control-static"> Have a video that shows off your idea? <br/>Just enter the web address to a youtube or vimeo video </p>
    </div>
  </div>

<div class="hr"></div>

<!-- Description -->
  <div class="form-group description">
    <label>Description</label>
    <p class="form-control-static"> Here's where you get to flesh out all the details<br/>We put this here are just to help, write whatever you want </p>
       <textarea name="description" id="description">
          <h3>A little bit of context</h3>
          <em>[Set the scene. Zoom right out and set the scene for your audience. Many of them will already know this, but it moves their brain into the right frame to introduce what you’re doing.]</em><br>
           <br>
          <h3>But there’s a problem</h3>
          <em>[Explain what the problem is in the current context. Normally there’s something broken in the current context or there’s an opportunity – whichever it is, tell people what the issue is, before you tell them how you’re going to solve (or take advantage of) it.]</em><br>
           <br>
          <h3>Here’s what we’re doing about it</h3>
          <em>[What are you doing to solve the issue? This is where you talk about what you’re going to do. Keep it simple and specific.]</em><br>
           <br>
          And what you hope to achieve<br>
          <em>[How will what you do change the world? Here’s where you talk about how what you’re doing will make a difference.]</em><br>
           <br>
          <h3>You can join us</h3>
          <em>[Every leader needs followers, encourage people to join you! Explain briefly what people can expect to put in and get out]</em><br>
      </textarea>
  </div>

  <div class="save right">
     <button type="button" class="btn btn-default">Preview</button>
    <button type="button" class="btn btn-success">Save</button>
  </div>

</form>

	</div> <!-- /editProject -->
</div>	<!-- /container -->

<script>

  document.getElementById("uploadBtn").onchange = function () {
      document.getElementById("uploadFile").value = this.value;
  };

  $(function() {
        $('#summary').editable({
            inlineMode: false,  
            language: 'en_gb',
             buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline']
        });
        $('#description').editable({
            inlineMode: false, 
            language: 'en_gb'
        });

        // $("#skills").select2({
        //               tokenSeparators: [",", " "],
        //               placeholder: "type your skills separated by commas",
        //               formatNoMatches: "type to search or add new skills"
        //           });
    });
  
</script>