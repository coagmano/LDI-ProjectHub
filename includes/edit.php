<!-- From Start (There's no action on this from) -->

<div class="container">
	<div class="boxLayout editProject bootstrap">
	<form class="form-horizontal editForm" role="form" enctype="multipart/form-data" action="/new-project.php" method="post">
  <input type="hidden" name="project" value="<?php echo $project->projectId; ?>">

<!-- Title -->
  <div class="form-group">
    <label class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="title" placeholder="Project Name" value="<?php echo $project->title; ?>">
      <p class="form-control-static"> What are you going to call your grand idea? </p>
    </div>
  </div>

<!-- Category -->
  <div class="form-group">
    <label class="col-sm-2 control-label">Category</label>
    <div class="col-sm-10">
      <select name="category" class="form-control">
        <?php echo '<option value="'.$project->category.'">'.$project->category.'</option>';?>
        <option disabled="">-----------------</option>
        <option value="Personal Development Project">Personal Development Project</option>
        <option value="Social &amp; Global Change Project">Social &amp; Global Change Project</option>
        <option value="Student/Campus Community Project">Student/Campus Community Project</option>
        <option value="Community Development Project">Community Development Project</option>
        <option value="Social Enterprise">Social Enterprise</option>
        <option value="Business Enterprise">Business Enterprise</option>
        <option value="Technical Innovation">Technical Innovation</option>
      </select>
       <p class="form-control-static"> What category does it fit best? </p>
    </div>
  </div>


<!-- Pitch text -->
  <div class="form-group">
    <label class="col-sm-2 control-label">Pitch text</label>
    <div class="col-sm-10">
        <textarea maxlength="155" name="summary" placeholder="what is your project about?" class="form-control pitchTextarea">
          <?php echo $project->summary; ?>
        </textarea>
      <p class="form-control-static pitchText"> This short description will be at the top of your project page and should tell them what your project is about <b>in 150 characters or less </b></p>
    </div>
  </div>

  
<!-- Upload Image -->
  <div class="form-group uploadImage">
    <label class="col-sm-2 control-label">Image</label>
    <div class="col-sm-10">
      <?php echo '<img src="images/'.$project->featureImageUrl.'" style="width:100%;" alt="'.$project->title.'" />'; ?>
      <p class="form-control-static"> Do you have a photo or image to feature on your page? <br/>This image will be the first thing people see when they land on your project! </p>
      <input id="uploadFile" name="featureImage" placeholder="Choose File" disabled="disabled" />
      <div class="fileUpload btn">
          <span>Upload Image</span>
          <input id="uploadBtn" type="file" class="upload"  name="featureImage" accept="image/*" />
      </div>
      
    </div>
  </div>


<!-- Video -->
  <div class="form-group video">
    <label class="col-sm-2 control-label">Video</label>
    <div class="col-sm-10">
      <input type="text" name="videoUrl" class="form-control" placeholder="https://www.youtube.com/watch?v=" value="<?php echo $project->videoUrl; ?>">
      <p class="form-control-static"> Have a video that shows off your idea? <br/>Just enter the web address to a <b>youtube</b> or <b>vimeo</b> video </p>
    </div>
  </div>

<div class="hr"></div>

<!-- Description -->
  <div class="form-group description">
    <label>Description</label>
    <p class="form-control-static"> Here's where you get to flesh out all the details<br/>We put this here are just to help, write whatever you want </p>
       <textarea name="description" id="description">
       <?php echo $project->description; ?>
      </textarea>
  </div>

  <div class="save right">
     <button type="button" class="btn btn-default">Preview</button>
    <button type="submit" data-loading-text="Saving..." class="loading btn btn-success">Save</button>
  </div>

</form>

	</div> <!-- /editProject -->
</div>	<!-- /container -->

<script>



  $(function() {
        $('#description').editable({
            inlineMode: false, 
            language: 'en_gb'
        });
    });
  
</script>