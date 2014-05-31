<div class="container">
	<div class="boxLayout">

		<!-- right panel -->
		<div class="fileLinks rightPanel right">

			<!-- connected files (If there's any)-->
			<div class="bootstrap">
				<div class="panel panel-default">
				  <div class="panel-heading">Connected files & links</div>
				  <div class="panel-body">
				    <p><a href="#"><span class="icon glyphicon glyphicon-plus"></span> Add file and links</a></p>
				  </div>
				  <ul class="links list-group">
				    <li class="list-group-item"><a href="#" target="_new"><span class="icon glyphicon glyphicon-link"></span> Facebook Group</a></li>
				    <li class="list-group-item"><a href="#" target="_new"><span class="icon glyphicon glyphicon-link"></span> Dropbox</a></li>
				    <li class="list-group-item"><a href="#" target="_new"><span class="icon glyphicon glyphicon-link"></span> Google drive</a></li>
				    <li class="list-group-item"><a href="#" target="_new"><span class="icon glyphicon glyphicon-link"></span> Github</a></li>
				  </ul>
				</div>
			</div>
		</div> <!-- /right -->

		<!-- left panel -->
		<div class="left">
			
			<!-- Join Request (If there's any) -->
			<div class="bootstrap request">
				<div class="panel panel-warning">
				  <div class="panel-heading">
				    <h3 class="panel-title">Join Request</h3>
				  </div>
				  <div class="panel-body">
				    <div class="commentsBox">
						<div class="right commentsContainer">
							<div class="nameDate bootstrap">
							 Catelyn Stark <span class="date"> 3 hours ago</span><br/>
							 <span class="apply"> Apply for role : wife </span>
							</div>
							<div class="comments">
								I'd like to join the family. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, optio.
							</div>
						</div>
						<div class="photo">
							<img src="images/profile/none.png" alt="profile picture" />
						</div>
					</div>

					<!-- approve /reject -->
					<button type="submit" class="btn btn-warning right" data-toggle="modal" data-target="#respondModal">Respond to request</button>  
				  </div>
				</div>
			</div>		

			<!--Respond to request modal -->
			<div class="bootstrap">
				<div class="modal fade" id="respondModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="myModalLabel">Respond to request</h4>
				      </div>
				      <div class="modal-body">
				        <form role="form">
						  <div class="form-group">
						  	<label> Message to send </label>
						    <textarea name="rejectReason" class="form-control rejectReason" row="1" placeholder="Welcome message, or why do you reject him/her?"></textarea>
						  </div> 
						</form>
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn btn-success">Approve</button>
						<button type="submit" class="btn btn-danger">Reject</button>
				      </div>
				    </div>
				  </div>
				</div>
			</div>


			<!-- post stuffs -->
			<div class="post">
				<h3>Post somthing</h3>
				<form accept-charset="UTF-8" action="" method="post">
					<textarea data-fieldlength="500" id="newcomment" name="comment"></textarea><br>
					<div class="bootstrap submit right">
						<button type="button" id="postnewcomment" class="btn btn-success right">Submit</button>
					</div>
				</form>
			</div>
			
			<!-- posts (If there's any) -->

			<!-- <div class="commentsBox {$commentClass}"> -->
			<div class="commentsBox posts">
				<div class="right commentsContainer">
					<div class="nameDate bootstrap">
						<!-- {$commentTeam}{$comment->postedBy->firstName} {$comment->postedBy->lastName} --> Fred Stark <span class="date"> 2 days ago<!-- {$comment->timeElapsed} --></span>
					</div>
					<div class="comments">
						<!-- $comment->content <-->Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, fugit, aliquid, magnam tempora omnis culpa saepe sit provident error dolorem maxime accusamus sint quidem quisquam veniam odit hic quam expedita corporis ex! Voluptas, doloremque enim atque ratione voluptatum qui corrupti vitae accusantium ipsa nesciunt officia fugiat dolorum commodi. Quo, dolore repellat quos cupiditate similique amet tenetur distinctio quibusdam quam iusto. Possimus, perspiciatis, vero, amet, enim expedita velit porro aliquid ab quisquam aspernatur iure pariatur dignissimos voluptatibus eius adipisci id nisi officiis odit laboriosam labore corporis nulla ea ducimus quas architecto! Quo, nemo, ipsa est recusandae deleniti impedit sed placeat optio.</-->
					</div>
				</div>
				<div class="photo">
					<!-- <img src="images/profile/{$comment->postedBy->profilePicUrl}" alt="profile picture" /> -->
					<img src="images/profile/fred.jpg" alt="profile picture" />
				</div>
			</div>
			<div class="commentsBox posts">
				<div class="right commentsContainer">
					<div class="nameDate bootstrap">
					 Jimi <span class="date"> 3 days ago</span>
					</div>
					<div class="comments">
						Hello. I am a test.
					</div>
				</div>
				<div class="photo">
					<img src="images/profile/jimi.jpg" alt="profile picture" />
				</div>
			</div>

		</div> <!-- /left -->
	</div>	<!-- /boxLayout -->


</div> <!-- /container -->


<script>

	$( "#newcomment" ).editable({
            inlineMode: false, 
            language: 'en_gb',
            buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline'],
            editorClass: "newcomment",
        });
	
	$( "#postnewcomment" ).click(function() {
		
		var newCommentHtml = $( ".newcomment" ).html();

		$.post( "ajax/comment.php", { user: "{$user->userId}", project: "{$project->projectId}", content: newCommentHtml } )
			.done(function( data ) {
				
				if (data === false) {
					$( ".newcomment" ).after( "Sorry, something went wrong" );
				} else {

				}
				$( ".post" ).before( data );
			
			});
	});
	
</script>
