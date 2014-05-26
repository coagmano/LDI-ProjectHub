<?php
	
		echo "<div class='displayProjects test'>
				<table class='projects'>
					<tr>";
		$colum = 1;
		while ($row = mysql_fetch_assoc($result)) {
			$miniproject = new Project;
			$miniproject->constructFromRow($row);
			$percentage = progress($miniproject->status);	// this is for the progress bar
			$teamCount = count($miniproject->teamMembers);
			//var_dump($miniproject);

			if($colum==1){ echo "<tr>"; }	// a new row

			echo <<<EOD
			<td>
				<div class='box'>
					<img src='{$miniproject->featureImageUrl}' alt='{$miniproject->title}' />
					<h2 class="projectTitle">{$miniproject->title}</h2>
					<p class="descrption">{$miniproject->summary}</p>
					<p class="tags"><a href="#">{$miniproject->category}</a>
EOD;
		foreach ($miniproject->skills as $skill) 
		{
			echo "<a href=\"#\">$skill</a>";
		}
		echo <<<EOD
				</p>
				<div class='bootstrap'><div class='progress'>
					 <div class='progress-bar {$miniproject->status}' role='progressbar' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100' style='width: {$percentage}%;'>
					    <span class='{$miniproject->status}Label'>{$miniproject->status}</span>
					  </div>
					</div></div>
				<p class="status">
					<span class="bootstrap"><span class="glyphicon glyphicon-user"></span> $teamCount; <!-- No of team members --> 
					<span class='middle'><span class='glyphicon glyphicon-search'></span> 2</span> <!-- No of people needed -->
					<span class='right'><span class='glyphicon glyphicon-thumbs-up'></span> {$miniproject->likes}</span> <!-- No of likes -->
					</p>
				</div>
			</td>
EOD;
			foreach ($miniproject->teamMembers as $tm) 
			{
				echo "<!-- $tm->firstName $tm->lastName -->";
			}
			// Display 3 <td> per row
			if($colum!=3){$colum++;} else{$colum=1; echo "</tr>";}

			unset($miniproject); // Delete the object for cleanliness 
		}	// End of while

		echo'	</table>
			</div>	';

			// Load more button (just a empty button atm)
		echo'	<div class="bootstrap loadmore"><button type="button" class="btn btn-primary">Load more</button></div>';
	
?>