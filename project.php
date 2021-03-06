 <?php
$style = "project";
require_once('includes/include.php');
$project = new Project(); 
$project->getById($_GET['id']);
$pageTitle = "$project->title";
include 'includes/header.php';
include 'includes/navbar.php';

if(empty($_GET))
{
	header("Location: http://".$_SERVER['HTTP_HOST']);
	die();
}

// Spagetti code Party! 
$isTeamMember = ($user == $project->createdBy || in_array($user, $project->teamMembers)) ? "true" : "false";
$teamCount = $project->countTeam();
$emptyRolesCount = $project->countEmptyRoles();
$blogPostCount = $project->countBlogPosts();
$commentCount = $project->countComments();
$userlikesthis = likesActiveProject($user->userId, $project->projectId);

$hiddenMessage = $isTeamMember;

if ($user->isLoggedIn) {
	$liketext = ($userlikesthis) ? "Liked" : "Like this" ;
} else {
	$liketext = "<a href=\"/\">Login</a>";
}

echo <<<HTML
<div class="container">
	<div class="content">
		<a name="top"></a>
		<!-- project title -->
		<div class="projectTitle bootstrap">
			<h1>{$project->title}<br/>
			<small>{$project->summary}</small>
			</h1>
		</div>
		<div id="success">
HTML;
            if (isset($message)) {
                foreach ($message as $message) { echo "<p class='message'>".$message."</p>"; }
                unset($_SESSION['message']);
            } 
            if (isset($errors)) {
                foreach ($errors as $error) { echo "<p class='error'>".$error."</p>"; }
                unset($_SESSION['errors']);
            } 
echo <<<HTML
        </div>
		<div class="project boxLayout">
			<!-- right panel -->
			<div class="rightPanel right">
				
				<!-- project stages & status -->
				<div class="stages {$project->stage}">{$project->stage}</div>
				
				<div class="status right">
					<div class="statusTitle">Looking for</div>
					<div class="number"> {$emptyRolesCount} </div>
					<div class="statusText">members </div>
				</div>
				<div class="status">
					<div class="statusTitle"> Currently </div>
					<div class="number"> {$teamCount} </div>
					<div class="statusText">collaboraters</div>
				</div>
				
				<!-- like button -->
				<div class="bubble right">
					<span id="likeCount">{$project->likes}</span>
				</div>
				<div class="bootstrap">
					<button type="button" class="btn btn-success like" id="likes">
					<span class="glyphicon glyphicon-thumbs-up"></span><br/>
					<span class="likeIt">{$liketext}</span>
					</button>
					
					<!-- Other buttons -->
HTML;
if(!$isTeamMember)
{
	echo <<<HTML
					<a href="join-project.php?id={$project->projectId}"><button type="button" class="btn longBtn join">
					I want to join
					</button></a>
HTML;
}
echo <<<HTML
					<a href="mailto:{$project->createdBy->email}"><button type="button" class="btn longBtn ask">
					Contact project leader
					</button></a>
				</div>
				<!-- collaboraters -->
				<div class="peopleBorder">
					<a href="profile.php?id={$project->createdBy->userId}">
					<div class="people">
						<div class="peopleInfo right">
							<div class="peopleInfos">
								<span class="position">Project Leader </span><br/>
								<span class="name"> {$project->createdBy->firstName} {$project->createdBy->lastName} </span>
							</div>
						</div>
						<div class="profileImg">
							<img src="images/profile/{$project->createdBy->profilePicUrl}" alt="Project Leader" />
						</div>
					</div>
					</a>
				</div>
HTML;

foreach ($project->roles as $role) 
{
	if ($role->filledBy != NULL)
	{
						echo <<<HTML
					<div class="peopleBorder">
						<a href="profile.php?id={$role->filledBy->userId}">
						<div class="people">
							<div class="peopleInfo right">
								<div class="peopleInfos">
									<span class="position">{$role->title}</span><br/>
									<span class="name"> {$role->filledBy->firstName} {$role->filledBy->lastName} </span>
								</div>
							</div>
							<div class="profileImg">
								<img src="images/profile/{$role->filledBy->profilePicUrl}" alt="" />
							</div>
						</div>
						</a>
					</div>
HTML;
	}
	
} 

echo <<<HTML
			</div> <!-- End right panel -->
			
			<!-- left panel -->
			<div class="left">
				<div class="bootstrap">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#top">Project</a></li>
						<li><a href="#look">Looking for <span class="badge emptyRolesCount">{$emptyRolesCount}</span></a></li>
						<li><a href="#blog">Updates <span class="badge blogPostCount">{$blogPostCount}</span></a></li>
						<li><a href="#comments">Comments <span class="badge commentCount">{$commentCount}</span></a></li>
HTML;
if (!$isTeamMember) { echo "<li><a href=\"dashboard.php?id={$project->projectId}\">Dash</a></li>";}
echo <<<HTML
					</ul>
				</div>
HTML;
if ($project->videoType == "youtube")
{
	echo "<!-- Youtube -->
				<div class='embed-container'><iframe src='http://www.youtube.com/embed/{$project->videoId}' frameborder='0' allowfullscreen></iframe></div>";
}
else if ($project->videoType == "vimeo") 
{
	echo "<!-- Vimeo -->
				<div class='embed-container'><iframe src='http://player.vimeo.com/video/{$project->videoId}' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";
}
else
{
	echo '<!-- Project Image -->
				<div class="videoPic"><img src="images/project/'.$project->featureImageUrl.'" alt=""></div>';
}
echo <<<HTML
				<div class="projectContent">
					<!-- descriptions -->
					<div class="block">
						$project->description 
					</div>
					
					<!-- looking for -->
					<div class="block"><a name="look"></a>
						<h2>Looking for</h2>
HTML;
foreach ($project->roles as $role) 
{
	if (is_null($role->filledBy))
	{
		echo <<<HTML
						<div class="lookingFor bootstrap">
							<h3>{$role->title}</h3>
							<p class="tags">Skills:
HTML;
		foreach ($role->tags as $tag) 
		{
			echo '<a href="#"><span class="label label-warning">'.$tag.'</span></a>';
		}
		echo <<<HTML
							</p>
							<p>{$role->blurb}</p>
							<a href="join-project.php?id={$project->projectId}&amp;role={$role->roleId}"><button type="button" class="btn btn-success right">Apply</button></a>
						</div>
HTML;
	}
}
echo <<<HTML
					</div> <!-- End looking for -->
					
					<!-- Blog post -->
					<div class="block"><a name="blog"></a>
						<h2 class="blogPostTitle">Updates</h2>
HTML;
		foreach ($project->blogPosts as $blogPost) 
{
	echo <<<HTML
						<div class="blogPost">
							<h3>$blogPost->title</h3>
							<h4>$blogPost->timeElapsed</h4>
							$blogPost->content
						</div>
HTML;
}
echo <<<HTML
					</div> <!-- End blog posts -->
					
					<!-- Comments -->
					<div class="block CommentsBlock"><a name="comments"></a>
						<h2>Comments</h2>
HTML;
foreach ($project->comments as $comment) 
{
	$commentClass = "";
	$commentTeam = "";
	if ($comment->postedBy == $project->createdBy || in_array($comment->postedBy, $project->teamMembers))
	{
		$commentClass = "owner yellowBorder";
		$commentTeam = '<span class="label label-warning team">Team</span>';
	} 
	
	echo <<<HTML
						<div class="commentsBox {$commentClass}">
							<div class="right commentsContainer">
								<div class="nameDate bootstrap">
									{$commentTeam}{$comment->postedBy->firstName} {$comment->postedBy->lastName} <span class="date">{$comment->timeElapsed}</span>
								</div>
								<div class="comments">
									$comment->content
								</div>
							</div>
							<div class="photo">
								<img src="images/profile/{$comment->postedBy->profilePicUrl}" alt="profile picture" />
							</div>
						</div>
HTML;
}
echo <<<HTML
					<!-- Post a Comment -->
						<div class="post">
							<h3>Post a Comment</h3>
							<form accept-charset="UTF-8" action="" method="post">
								<textarea data-fieldlength="500" id="newcomment" name="comment"></textarea><br>
								<input type="hidden" name="private" value="0" />
								<div class="bootstrap submit right">
									<button type="button" id="postnewcomment" class="btn btn-success right">Submit</button>
								</div>
							</form>
						</div>
					</div> <!-- /Commentsblock -->
				</div> <!-- /projectContent -->
			</div> <!-- /left panel -->
			
		</div> <!-- /project -->
	</div>
</div>  <!-- /content, /container -->
<script>
	$( "#likes" ).click(function() {
		var likes = parseInt($( "#likeCount" ).html());
		var userlikesthis = $( ".likeIt" ).html();
		if (userlikesthis === "Liked") {
			console.log("if->Liked");
			$.post( "ajax/like.php", { task: "unlike", user: "{$user->userId}", project: "{$project->projectId}" })
				.done(function( data ) {
					if (data) {
						$( "#likeCount" ).html( likes - 1 );
						$( ".likeIt" ).html("Like this");
						userlikesthis = "Like this";
						console.log("unliked successfully");
					} else {
						console.log("unlike failed");
					}
				
				});
		} else {
			console.log("if->Like this");
			$.post( "ajax/like.php", { task: "like", user: "{$user->userId}", project: "{$project->projectId}" })
				.done(function( data ) {
					if (data) {
						$( "#likeCount" ).html( likes + 1 );
						$( ".likeIt" ).html("Liked");
						userlikesthis = "Liked";
						console.log("Liked successfully");
					} else {
						console.log("like failed");
					}
				});
		}
	});
	
	$( "#newcomment" ).editable({
            inlineMode: false, 
            language: 'en_gb',
            buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline'],
            editorClass: "newcomment",
        });
	
	$( "#postnewcomment" ).click(function() {
		
		var newCommentHtml = $( ".newcomment" ).html();

		$.post( "ajax/comment.php", { user: "{$user->userId}", project: "{$project->projectId}", content: newCommentHtml, private: 0 } )
			.done(function( data ) {
				
				if (data === false) {
					$( ".newcomment" ).after( "Sorry, something went wrong" );
				} else {
					$( ".post" ).before( data );
					$( ".commentCount" ).html(parseInt($( ".commentCount" ).html()) + 1);
				}
				
			
			});
	});


	
</script>
HTML;
include 'includes/footer.php';
?>