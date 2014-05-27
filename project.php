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
$teamCount = count($project->teamMembers);

?>
<div class="container">
	<div class="content">
		<a name="top"></a>
		<!-- project title -->
		<div class="projectTitle bootstrap">
			<h1><?php echo $project->title; ?><br/>
			<small><?php echo $project->summary; ?></small>
			</h1>
		</div>
		<div class="project">
			<!-- right panel -->
			<div class="rightPanel right">
				
				<!-- project stages & status -->
				<?php echo "<div class=\"stages {$project->stage}\">{$project->stage}</div>"; ?>
				
				<div class="status right">
					<div class="statusTitle">Looking for</div>
					<div class="number"> 2 </div>
					<div class="statusText">members </div>
				</div>
				<div class="status">
					<div class="statusTitle"> Currently </div>
					<div class="number"> <?php echo $teamCount; ?> </div>
					<div class="statusText">collaboraters</div>
				</div>
				
				<!-- like button -->
				<div class="bubble right">
					<span><?php echo $project->likes; ?></span>
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
					<a href="profile.php?id=<?php echo $project->createdBy->userId; ?>">
					<div class="people">
						<div class="peopleInfo right">
							<div class="peopleInfos">
								<span class="position">Project Leader </span><br/>
								<span class="name"> <?php echo $project->createdBy->firstName." ".$project->createdBy->lastName; ?> </span>
							</div>
						</div>
						<div class="profileImg">
							<img src="<?php echo $project->createdBy->profilePicUrl; ?>" alt="Project Leader" />
						</div>
					</div>
					</a>
				</div>
				<?php 
				foreach ($project->teamMembers as $teamMember) 
				{
					echo <<<HTML
					<div class="peopleBorder">
						<a href="profile.php?id={$teamMember->userId}">
						<div class="people">
							<div class="peopleInfo right">
								<div class="peopleInfos">
									<span class="position">Team Member</span><br/>
									<span class="name"> {$teamMember->firstName} {$teamMember->lastName} </span>
								</div>
							</div>
							<div class="profileImg">
								<img src="{$teamMember->profilePicUrl}" alt="" />
							</div>
						</div>
						</a>
					</div>
HTML;
				} ?>
			</div> <!-- End right panel -->
			
			<!-- left panel -->
			<div class="left">
				<div class="bootstrap">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#top">Project</a></li>
						<li><a href="#look">Looking for <span class="badge">2</span></a></li>
						<li><a href="#blog">Blog Post <span class="badge">3</span></a></li>
						<li><a href="#comments">Comments <span class="badge">0</span></a></li>
					</ul>
				</div>
				<!-- pic/ video of the project -->
				<div class="videoPic"><img src="images/emptyProject.jpg" alt=""></div>
				<div class="projectContent">
					<!-- descriptions -->
					<div class="block">
						<h2>Lorem ipsum dolor sit amet</h2>
						<p>
						consectetur adipisicing elit. Assumenda, eum vitae pariatur quae amet nisi dolorem cupiditate reiciendis quibusdam repellat esse voluptatem dicta repellendus id officiis corrupti dolore repudiandae in ex modi consequatur rem non odit. Deserunt, labore optio beatae aliquam autem aliquid tenetur! Unde, quam facilis tempora itaque. Assumenda aspernatur inventore consequuntur quo. Ipsum, distinctio, nobis, quo, provident illum officiis iusto earum non itaque quos est unde repellat voluptatibus recusandae voluptas laboriosam dolor assumenda placeat neque doloribus necessitatibus enim voluptate minus maxime nisi eligendi obcaecati tempore. Reprehenderit, quidem, esse, dolore totam commodi aut itaque repudiandae ratione quod officiis vero.
						</p>
						<h3>Lorem ipsum dolor sit amet</h3>
						<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, delectus, voluptas, atque, earum ut accusantium illo veniam cumque nihil tenetur hic qui labore impedit blanditiis sunt quasi eaque unde. Aliquid, commodi, vel, explicabo soluta velit repellendus et harum ea vitae assumenda provident unde autem dignissimos omnis voluptatibus repellat mollitia animi iusto cum illo voluptates incidunt deserunt quos voluptatum accusamus ratione praesentium laborum labore laboriosam dolorem molestiae itaque aperiam maiores. Magnam.
						</p>
					</div>
					
					<!-- looking for -->
					<div class="block"><a name="look"></a>
						<h2>Looking for</h2>
						
						<div class="lookingFor bootstrap">
							<h3>Programmer</h3>
							<p class="tags">Skills :
							<a href="#"><span class="label label-warning">java</span></a>
							<a href="#"><span class="label label-warning">C#</span></a>
							</p>
							<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, fugiat, at, natus, deserunt nemo maiores minus nesciunt sed facere exercitationem sint blanditiis eaque laborum nisi voluptate nulla mollitia quia. Saepe, aliquam veniam dignissimos maiores eaque! Placeat, soluta inventore perferendis totam in impedit ex recusandae tenetur possimus sunt libero similique accusamus.
							</p>
							<button type="button" class="btn btn-success right">Apply</button>
						</div>
						<div class="lookingFor bootstrap">
							<h3>Designer</h3>
							<p class="tags">Skills :
							<a href="#"><span class="label label-warning">photoshop</span></a>
							<a href="#"><span class="label label-warning">laa</span></a>
							<a href="#"><span class="label label-warning">foo</span></a>
							</p>
							<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, fugiat, at, natus, deserunt nemo maiores minus nesciunt sed facere exercitationem sint blanditiis eaque laborum nisi voluptate nulla mollitia quia. Saepe, aliquam veniam dignissimos maiores eaque! Placeat, soluta inventore perferendis totam in impedit ex recusandae tenetur possimus sunt libero similique accusamus.
							</p>
							<button type="button" class="btn btn-success right">Apply</button>
						</div>
						<div class="lookingFor bootstrap">
							<h3>Title</h3>
							<p class="tags">Skills :
							<a href="#"><span class="label label-warning">yay</span></a>
							<a href="#"><span class="label label-warning">anything</span></a>
							<a href="#"><span class="label label-warning">okay</span></a>
							<a href="#"><span class="label label-warning">brabra</span></a>
							</p>
							<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, fugiat, at, natus, deserunt nemo maiores minus nesciunt sed facere exercitationem sint blanditiis eaque laborum nisi voluptate nulla mollitia quia. Saepe, aliquam veniam dignissimos maiores eaque! Placeat, soluta inventore perferendis totam in impedit ex recusandae tenetur possimus sunt libero similique accusamus.
							</p>
							<button type="button" class="btn btn-success right">Apply</button>
						</div>
					</div>
					
					<!-- Blog post -->
					<div class="block"><a name="blog"></a>
						<h2 class="blogPostTitle">Blog post</h2>
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
						</div></div>  <!-- /content, /container -->
						<?php
							include 'includes/footer.php';
						?>