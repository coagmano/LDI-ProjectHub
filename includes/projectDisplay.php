<?php
if(checkCount($result)) // If there is result
{	
	echo "<div class='displayProjects test'>
			<table class='projects'>
				<tr>";
	$column = 1;

	while ($row = mysql_fetch_assoc($result)) 
	{
		if (!is_null($row['id'])) 
		{
		$miniproject = new Project;
		$miniproject->constructFromRow($row);
		$percentage = progress($miniproject->stage);	// this is for the progress bar
		$teamCount = $miniproject->countTeam();

		if($column==1){ echo "<tr>"; }	// a new row

		echo <<<HTML
		<td>
			<div class='box'>
				<a href="project.php?id={$miniproject->projectId}"><img src="images/project/{$miniproject->featureImageUrl}" alt="{$miniproject->title}" />
				<h2 class="projectTitle">{$miniproject->title}</h2></a>
				<p class="descrption">{$miniproject->summary}</p>
				<p class="tags"><a href="#">{$miniproject->category}</a>
HTML;
		foreach ($miniproject->skills as $skill) 
		{
			echo '<a href="#">'.$skill.'</a>';
		}
		echo <<<HTML
			</p>
			<div class='bootstrap'><div class='progress'>
				 <div class='progress-bar {$miniproject->stage}' role='progressbar' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100' style='width: {$percentage}%;'>
				    <span class='{$miniproject->stage}Label'>{$miniproject->stage}</span>
				  </div>
				</div></div>
			<p class="status">
				<span class="bootstrap"><span class="glyphicon glyphicon-user"></span> $teamCount <!-- No of team members --> 
				<span class='middle'><span class='glyphicon glyphicon-search'></span> 2</span> <!-- No of people needed -->
				<span class='right'><span class='glyphicon glyphicon-thumbs-up'></span> {$miniproject->likes}</span> <!-- No of likes -->
				</p>
			</div>
		</td>
HTML;
		// Display 3 <td> per row
		if($column!=3){$column++;} else{$column=1; echo "</tr>";}

		unset($miniproject); // Delete the object for cleanliness 
		}
		else
		{
			echo "<h2><center> <br>Sorry :( We couldn't find any projects with the options you searched for. <br> Why not <a href='new-project.php'>Create your own?</a></center></h2>";
		}
	}	// End of while

	echo'	</table>
		</div>	';

		// Load more button (just a empty button atm)
	//echo'	<div class="bootstrap loadmore"><button type="button" class="btn btn-primary">Load more</button></div>';	
}
?>