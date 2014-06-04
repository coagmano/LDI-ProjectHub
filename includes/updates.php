<?php 



if(!empty($_POST))
{
	$title = trim($_POST["title"]);

	//Perform some validation
	if(strlen($title) == 0 )
	{
		$errors[] = "Looks like you forgot to enter a title! A title helps draw attention to your project.";
	}
    
	//End data validation
	if(count($errors) == 0)
	{	
        //Construct a BlogPost object and populate its variables
		$post = new BlogPost();
        if (!empty($_POST['blogPost'])) { $post->id = $_POST['blogPost']; }

		$post->projectId 		= $project->projectId;
		$post->title			= $_POST['title'];
		$post->content 			= mysql_escape_string($DIRTY_POST['content']);
		$post->timeElapsed 		= "Just now";
		$post->postedBy 		= $user;
		
		// Persist new Post to database
		$result = $post->saveToDatabase();
		if($result) 
		{ 
			$message[] = "Post created/updated successfully";
            $_SESSION['message'] = $message;
		}
		else
		{
			$errors[] = $result;
		}
	}
}

?>

<div class="container">
	<div class="boxLayout editProject bootstrap">

	<!-- New Updates -->
	 <form class="form-horizontal editForm" role="form" action="<?php echo $_SERVER['PHP_SELF']."?id={$project->projectId}&page=updates"; ?>" method="post">
		<div class="form-group description">
		    <label>Add new updates</label>
		    <p class="form-control-static"> New exciting updates come out? Tell them about it!<br/></p>
		 </div>

		<div class="form-group">
		    <label class="col-sm-2 control-label">Title</label>
		    <div class="col-sm-10">
		      <input type="text" name="title" class="form-control" placeholder="Title of the update">
		    </div>
	  	</div>

	  	<div class="form-group">
		    <label class="col-sm-2 control-label">Content</label>
		    <div class="col-sm-10">
		      <textarea name="content" id="updates"></textarea>
		    </div>
	  	</div>

	  <div class="save newUpdateSave right">
	    <button type="submit" data-loading-text="Saving..." class="loading btn btn-success">Save</button>
	  </div>
	</form>


	  <div class="hr updateHr"></div>

	<!-- Lateset Update -->
	<div class="form-group description">
	    <label>Latest update</label>
	    <p class="form-control-static"> Here you can edit your very last update <br/></p>
	  
		<span class="latestUpdate">
			<div class="right">
		    	<button type="button" class="btn btn-warning editUpdate">Edit</button>
		  	</div>

			<div class="update">
				<h3><b>Hello I'm THE update</b></h3>
				<h4><b>4 days ago</b></h4>
				What about this update? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, dolor, ipsa, porro quo esse sint modi itaque ducimus sunt labore tempore non recusandae laborum delectus est! Culpa, dolor sint nisi vero amet quae veniam nobis dolore velit quaerat harum magnam error enim vel dicta! Cupiditate, perferendis, quia dolorem nemo facilis ex similique iusto quisquam deserunt hic ipsum tempore deleniti dolores natus laudantium quae earum tenetur harum repellat repudiandae magni sit officia rerum. Quod, magni ab libero deserunt harum fuga ullam voluptas! Sed, voluptate, molestias, veniam veritatis in saepe quam officiis hic quas eligendi necessitatibus velit illo provident iste a animi.
			</div>
		</span>
	</div>
	
		<span class="editLatestUpdate invis">
			<form class="form-horizontal editForm" role="form">
				<div class="form-group">
				    <label class="col-sm-2 control-label">Title</label>
				    <div class="col-sm-10">
				      <input type="text" name="title" class="form-control" value="Hello I'm THE update">
				    </div>
			  	</div>

			  	<div class="form-group">
				    <label class="col-sm-2 control-label">Content</label>
				    <div class="col-sm-10">
				      <textarea name="editUpdates" id="editUpdates">
				      	What about this update? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, dolor, ipsa, porro quo esse sint modi itaque ducimus sunt labore tempore non recusandae laborum delectus est! Culpa, dolor sint nisi vero amet quae veniam nobis dolore velit quaerat harum magnam error enim vel dicta! Cupiditate, perferendis, quia dolorem nemo facilis ex similique iusto quisquam deserunt hic ipsum tempore deleniti dolores natus laudantium quae earum tenetur harum repellat repudiandae magni sit officia rerum. Quod, magni ab libero deserunt harum fuga ullam voluptas! Sed, voluptate, molestias, veniam veritatis in saepe quam officiis hic quas eligendi necessitatibus velit illo provident iste a animi.
				      </textarea>
				    </div>
			  	</div>

			  <div class="save newUpdateSave right">
			    <button type="submit" data-loading-text="Saving..." class="loading btn btn-success">Save</button>
			  </div>
			</form>
		</span>
	

	</div> <!-- /editProject -->
</div>	<!-- /container -->

<script>

$(document).ready(function(){
  $(".editUpdate").click(function(){
    $(".latestUpdate").hide(300);
    $(".editLatestUpdate").show(300);
  });
});

  $(function() {
        $('#updates').editable({
            inlineMode: false, 
            language: 'en_gb'
        });
         $('#editUpdates').editable({
            inlineMode: false, 
            language: 'en_gb'
        });
    });

  
</script>

