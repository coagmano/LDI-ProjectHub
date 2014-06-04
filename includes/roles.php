<div class="container">
	<div class="boxLayout teamMembers">

		<!-- right panel -->
		<div class="rightPanel right">
			
			<a name="team"></a>
			<!-- Team member-->
			<h2>Team Members</h2>
			<div class="commentsBox">
				<div class="right commentsContainer">
					<div class="nameDate"><a href="#">Fred Stark </a></div>
					<div class="comments">
						<b>Email: </b> <a href="#">coagmano@gmail.com</a><br />
						<b>Phone: </b> 1234 5678 <br />
						<span class="bootstrap">
							<b>Skills:</b>
							<a href="#"><span class="label label-warning">something</span></a>
							<a href="#"><span class="label label-warning">lalala</span></a>
							<a href="#"><span class="label label-warning">skill</span></a>
							<a href="#"><span class="label label-warning">skill</span></a>
							<a href="#"><span class="label label-warning">skill</span></a>
							<a href="#"><span class="label label-warning">skill</span></a>
							<br />
							<b>Roles: </b>
							<span class="label label-role">something <a href="#" class="tooltipLink" data-toggle="tooltip" data-placement="bottom" title="Remove this role"><span class="glyphicon glyphicon-remove-circle"></span></a></span>
							<span class="label label-role">lalala <a href="#" class="tooltipLink" data-toggle="tooltip" data-placement="bottom" title="Remove this role"><span class="glyphicon glyphicon-remove-circle"></span></a></span></a>
							<span class="label label-role">role <a href="#" class="tooltipLink" data-toggle="tooltip" data-placement="bottom" title="Remove this role"><span class="glyphicon glyphicon-remove-circle"></span></a></span></a>
						</span>
					</div>
				</div>
				<div class="photo">
					<a href="#"><img src="images/profile/fred.jpg" alt="profile picture" /></a>
				</div>
			</div>

			<div class="commentsBox">
				<div class="right commentsContainer">
					<div class="nameDate"><a href="#">Yancie Ng </a></div>
					<div class="comments">
						<b>Email: </b><a href="#">yancieng@gmail.com</a><br />
						<b>Phone: </b>1234 5678 <br />
						<span class="bootstrap">
							<b>Skills:</b>
							no skills assigned yet
							<br />
							<b>Roles: </b>
							<span class="label label-role"> team member</span>
						</span>
					</div>
				</div>
				<div class="photo">
					<a href="#"><img src="images/profile/yancie.jpg" alt="profile picture" /></a>
				</div>
			</div>
			</br></br><a name="roles"></a>
			<div class="hr"></div>

			<!-- Assign Roles -->
			
			<h2>Assign Roles </h2><br/>
			<div class="assignRoles bootstrap">
				<form class="form-horizontal editForm" role="form">

				  <div class="form-group">
				    <label class="col-sm-2 control-label">Team member</label>
				    <div class="col-sm-10">
				      <select class="form-control">
				      	<option>Select team member</option>
				        <option>Fred Stark</option>
				        <option>Yancie Ng</option>
				      </select>
				       <p class="form-control-static"> Which team mebmer are you going to assign to? </p>
				    </div>
				  </div>	
					
					<!-- type in the role name, here might be able to use the tag thing "choosen" to enter muti role at the same time?  -->
				  <div class="form-group">
				    <label class="col-sm-2 control-label">Role</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" placeholder="Role Name">
				      <p class="form-control-static"> What is the role name? for example "project manager"</p>
				  	</div>
	  			  </div>

	  			  <button type="button" class="btn btn-success right">Save</button>
	  			</form>
  			</div> 
			
			</br></br><a name="advertising"></a>
  			<div class="hr"></div>

  			<!-- Advertising -->
			
			<h2>Advertising</h2><br/>
			<div class="lookingFor bootstrap">
				<h3>Role name</h3>
				<p class="tags">Skills:
					<a href="#"><span class="label label-warning">tags</span></a>
					<a href="#"><span class="label label-warning">tags</span></a>
					<a href="#"><span class="label label-warning">tags</span></a>
					<a href="#"><span class="label label-warning">tags</span></a>
				</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, facere explicabo distinctio vitae in obcaecati ipsam soluta necessitatibus dolorem optio odit.</p>
				<button type="button" class="btn btn-danger right" data-toggle="modal" data-target="#deleteModal">Delete</button>
			</div>

			<div class="lookingFor bootstrap">
				<h3>Role name</h3>
				<p class="tags">Skills:
					<a href="#"><span class="label label-warning">tags</span></a>
					<a href="#"><span class="label label-warning">tags</span></a>
					<a href="#"><span class="label label-warning">tags</span></a>
					<a href="#"><span class="label label-warning">tags</span></a>
				</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, facere explicabo distinctio vitae in obcaecati ipsam soluta necessitatibus dolorem optio odit.</p>
				<button type="button" class="btn btn-danger right" data-toggle="modal" data-target="#deleteModal">Delete</button>
			</div>

			<p style="display:none"> No roles being advertise at the moment. </p>

			<!-- Modal -->
			<div class="bootstrap">
			<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Warning</h4>
			      </div>
			      <div class="modal-body">
			        Are you sure you want to delete this?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			        <button type="button" class="btn btn-primary">Confirm</button>
			      </div>
			    </div>
			  </div>
			</div>
			</div>

			</br></br><a name="newRole"></a>
  			<div class="hr"></div>

  			<!-- Advertise new role -->
			
			<h2>Advertise new role </h2><br/>
			<div class="assignRoles bootstrap">
				<form class="form-horizontal editForm" role="form">
					
				  <div class="form-group">
				    <label class="col-sm-2 control-label">Role</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" placeholder="Role Name">
				      <p class="form-control-static"> What is the role name? For example "Designer"</p>
				  	</div>
	  			  </div>

	  			  <div class="form-group">
				    <label class="col-sm-2 control-label">Required skills</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" placeholder="skill tags">
				      <p class="form-control-static"> What skills are required for this role? <br/>For example a <b>"Designer"</b> might need <b>#photoshop</b></p>
				  	</div>
	  			  </div>

	  			  <div class="form-group">
				    <label class="col-sm-2 control-label">Message</label>
				    <div class="col-sm-10">
				      <textarea name="advertise" id="advertise"></textarea>
				      <p class="form-control-static"> some tips about this ... you are better at writing tips :P</p>
				  	</div>
	  			  </div>

	  			  <button type="button" class="btn btn-success right">Save</button>
	  			</form>
  			</div>

		 

		</div> <!-- /rightpanel -->
		
		<!-- left panel -->
		<div class="left teamNav">
			<div class="bootstrap">
				<a href="#team"><button type="button" class="btn btn-primary btn-lg btn-block">Team members</button></a>
				<a href="#roles"><button type="button" class="btn btn-success btn-lg btn-block">Assign roles</button></a>
				<a href="#advertising"><button type="button" class="btn btn-info btn-lg btn-block">Advertising</button></a>
				<a href="#newRole"><button type="button" class="btn btn-warning btn-lg btn-block">Advertise new roles</button></a>
			</div>
		</div> <!-- /left -->
	</div>
</div>

<script>

// Fix the sidebar
 $(window).bind('scroll', function() {
     if ($(window).scrollTop() > 257) {
         $('.teamNav').addClass('fixed');
     }
     else {
         $('.teamNav').removeClass('fixed');
     }
});

// textarea
$(function() {
    $('#advertise').editable({
        inlineMode: false,  
        language: 'en_gb',
         buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline']
    });
    $("#tags").select2({
                      tags: [<?php echo('"'.implode('", "', getAllTags()).'"'); ?>],
                      tokenSeparators: [",", " "],
                      placeholder: "type your skills separated by commas",
                      formatNoMatches: "type to search or add new skills"
                  });
});
</script>