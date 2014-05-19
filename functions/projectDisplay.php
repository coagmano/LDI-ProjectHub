<?php
	if(checkCount($result)){					// If there is result
		
		echo "<div class='displayProjects'>
				<table class='projects'>
					<tr>";

		$colum = 1;
		while ($row = mysql_fetch_assoc($result)) {

			if($colum==1){echo "<tr>";}	// a new row

			echo 	"<td>
						<div class='box'>";
							//	Image
			echo			"<img src='images/{$row["featureImageUrl"]}' alt='{$row["featureImageUrl"]}' />	";
							//  Title
			echo			'<h2 class="projectTitle">'.$row["title"].'</h2>';	
							//  Description 
			echo			'<p class="descrption">'.$row["description"].'</p>';
							//  Tags
			echo			'<p class="tags"><a href="#">Category</a><a href="#">Skill</a></p>';
							//  Progress bar (bootstrap)
			echo			"<div class='bootstrap'><div class='progress'>
							 <div class='progress-bar {$status}' role='progressbar' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100' style='width: {$percentage}%;'>
							    <span class='{$status}Label'>{$status}({$percentage}%)</span>
							  </div>
							</div></div>";
							//  Status
			echo			'<p class="status">';
								//  Number of collaborators
			echo				'<span class="bootstrap"><span class="glyphicon glyphicon-user"></span> 3';
								//  Number of groupmates looking for
			echo				"<span class='middle'><span class='glyphicon glyphicon-search'></span> 2</span>";
								//  Number of likes
			echo				"<span class='right'><span class='glyphicon glyphicon-thumbs-up'></span> {$row["likes"]}</span>
							</p>
						</div>
					</td>";

			// Display 3 <td> per row
			if($colum!=3){$colum++;} else{$colum=1; echo "</tr>";}

		}	// End of while

		echo'	</table>
			</div>	';

			// Load more button (just a empty button atm)
		echo'	<div class="bootstrap loadmore"><button type="button" class="btn btn-primary">Load more</button></div>';
	}
	else { 	// if there isn't a result, display message no result
		echo "</table>
			</div>	
			<h1><center> <br/> <br/> Sorrry :( There is no project at the moment. <br /> Why not <a href='#'>Adding some </a> ?</center></h1>";
	}	
?>