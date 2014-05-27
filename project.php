<?php
$pageTitle = "LDI ProjectHub";
$style = "project";
require('includes/include.php');
include 'includes/header.php';
include 'includes/navbar.php';

if(empty($_GET))
{
	header("Location: http://".$_SERVER['HTTP_HOST']);
	die();
}

$project = new Project();
$project->getById($_GET['id']);
$teamCount = $project->countTeam();
$emptyRolesCount = $project->countEmptyRoles();
$blogPostCount = 4;
$commentCount = 6;


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
		<div class="project">
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
					<span>{$project->likes}</span>
				</div>
				<div class="bootstrap">
					<button type="button" class="btn btn-success like">
					<span class="glyphicon glyphicon-thumbs-up"></span><br/>
					<span class="likeIt"> I Like This</span>
					</button>
					
					<!-- Other buttons -->
					<button type="button" class="btn longBtn join">
					I want to join
					</button>
					<button type="button" class="btn longBtn ask">
					Contact project leader
					</button>
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
							<img src="{$project->createdBy->profilePicUrl}" alt="Project Leader" />
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
								<img src="{$role->filledBy->profilePicUrl}" alt="" />
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
						<li><a href="#look">Looking for <span class="badge">{$emptyRolesCount}</span></a></li>
						<li><a href="#blog">Updates <span class="badge">{$blogPostCount}</span></a></li>
						<li><a href="#comments">Comments <span class="badge">{$commentCount}</span></a></li>
					</ul>
				</div>
HTML;
if (!($project->videoUrl == ""))
{
	echo <<<HTML
				<!-- Embed video here -->
				<div class="videoPic"><img src="{$project->videoUrl}" alt=""></div>
HTML;
}
elseif (!($project->featureImageUrl) == "")
{
	echo <<<HTML
				<div class="videoPic"><img src="images/{$project->featureImageUrl}" alt=""></div>
HTML;
}
else
{
	echo <<<HTML
				<!-- Placeholder image -->
				<div class="videoPic"><img src="images/emptyProject.jpg" alt=""></div>
HTML;
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
							<a href="project-apply.php?role={$role->roleId}"><button type="button" class="btn btn-success right">Apply</button></a>
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
							<h3>$blogPost->postedAt</h3>
							<h4>$blogPost->title</h4>
							$blogPost->content
						</div>
HTML;
}
						<div class="blogPost">
							<h3>5 Days ago</h3>
							<h4>New exciting update!</h4>
							<p>
							consectetur adipisicing elit. Assumenda, eum vitae pariatur quae amet nisi dolorem cupiditate reiciendis quibusdam repellat esse voluptatem dicta repellendus id officiis corrupti dolore repudiandae in ex modi consequatur rem non odit. Deserunt, labore optio beatae aliquam autem aliquid tenetur! Unde, quam facilis tempora itaque. Assumenda aspernatur inventore consequuntur quo. Ipsum, distinctio, nobis, quo, provident illum officiis iusto earum non itaque quos est unde repellat voluptatibus recusandae voluptas laboriosam dolor assumenda placeat neque doloribus necessitatibus enim voluptate minus maxime nisi eligendi obcaecati tempore. Reprehenderit, quidem, esse, dolore totam commodi aut itaque repudiandae ratione quod officiis vero.
							</p>
						</div>
						<div class="blogPost">
							<h3>22 Days ago</h3>
							<h4>Yo! dude</h4>
							<p>
							Merry Christmas Happy Brithday NEW YEARRRRRRAAAAAA!<br/>
							</p>
						</div>
						<div class="blogPost">
							<h3>February 14</h3>
							<h4>Lorem ipsum dolor sit amet</h4>
							<p>
							consectetur adipisicing elit. Assumenda, eum vitae pariatur quae amet nisi dolorem cupiditate reiciendis quibusdam repellat esse voluptatem dicta repellendus id officiis corrupti dolore repudiandae in ex modi consequatur rem non odit. Deserunt, labore optio beatae aliquam autem aliquid tenetur! Unde, quam facilis tempora itaque. Assumenda aspernatur inventore consequuntur quo. Ipsum, distinctio, nobis, quo, provident illum officiis iusto earum non itaque quos est unde repellat voluptatibus recusandae voluptas laboriosam dolor assumenda placeat neque doloribus necessitatibus enim voluptate minus maxime nisi eligendi obcaecati tempore. Reprehenderit, quidem, esse, dolore totam commodi aut itaque repudiandae ratione quod officiis vero.
							</p>
						</div>
						
					</div>
					
					<!-- Comments -->
					<div class="block CommentsBlock"><a name="comments"></a>
						<h2>Comments</h2>
						<!-- Post a Comment -->
						<div class="post">
							<h3>Post a Comment</h3>
							<form accept-charset="UTF-8" action="#" method="post">
								<textarea cols="70" rows="10" data-fieldlength="500" name="comment"></textarea>
								<div class="bootstrap right">
									<button type="submit" class="btn btn-success right">Submit</button>
								</div>
							</form>
						</div>
						<!-- comments -->
						<div class="commentsBox">
							<div class="right commentsContainer">
								<div class="nameDate">
									Dotty Arleen<span class="date">about 30 minutes ago</span>
								</div>
								<div class="comments">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, in, numquam illum commodi provident soluta minima explicabo repudiandae consequuntur tempora hic impedit? Illum, eius animi consequuntur unde necessitatibus sed provident.
								</div>
							</div>
							<div class="photo">
								<img src="images/profile/tempProfile4.jpg" alt="profile picture" />
							</div>
						</div>
						
						<div class="commentsBox yellowBorder">
							<div class="right commentsContainer">
								<div class="nameDate">
									Charlie Sebastian<span class="date">about 8 hours ago</span>
								</div>
								<div class="comments">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, in, numquam illum commodi provident soluta minima explicabo repudiandae consequuntur tempora hic impedit? Illum, eius animi consequuntur unde necessitatibus sed provident.
								</div>
							</div>
							<div class="photo">
								<img src="images/profile/tempProfile5.jpg" alt="profile picture" />
							</div>
						</div>
						<!-- team member comment -->
						<div class="commentsBox owner yellowBorder">
							<div class="right commentsContainer">
								<div class="nameDate bootstrap">
									<span class="label label-warning team">Team</span>Kayden Gerard<span class="date">about 2 days ago</span>
								</div>
								<div class="comments">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, in, numquam illum commodi provident soluta minima explicabo repudiandae consequuntur tempora hic impedit? Illum, eius animi consequuntur unde necessitatibus sed provident.
								</div>
							</div>
							<div class="photo">
								<img src="images/profile/tempProfile2.jpg" alt="profile picture" />
							</div>
						</div>
						<div class="commentsBox yellowBorder">
							<div class="right commentsContainer">
								<div class="nameDate">
									Dotty Arleen<span class="date">about 28 days ago</span>
								</div>
								<div class="comments">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, in, numquam illum commodi provident soluta minima explicabo repudiandae consequuntur tempora hic impedit? Illum, eius animi consequuntur unde necessitatibus sed provident.
								</div>
							</div>
							<div class="photo">
								<img src="images/profile/tempProfile4.jpg" alt="profile picture" />
							</div>
						</div>
						
						<!-- team member comment -->
						<div class="commentsBox owner yellowBorder">
							<div class="right commentsContainer">
								<div class="nameDate bootstrap">
									<span class="label label-warning team">Team</span>Laureen Noelene<span class="date">on March 20</span>
								</div>
								<div class="comments">
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, in, numquam illum commodi provident soluta minima explicabo repudiandae consequuntur tempora hic impedit? Illum, eius animi consequuntur unde necessitatibus sed provident.
								</div>
							</div>
							<div class="photo">
								<img src="images/profile/tempProfile1.jpg" alt="profile picture" />
							</div>
						</div>
					</div> <!-- /block -->
				</div> <!-- /projectContent -->
			</div> <!-- /left panel -->
			
		</div> <!-- /project -->
	</div>
</div>  <!-- /content, /container -->
HTML;
include 'includes/footer.php';
?>