<?php 

if (isset($_GET['joinRequest'])) 
{
    $request = new JoinRequest();
    $request->getById($_GET['joinRequest']);

    if ($_GET['action'] == "approve")
    {
        $request->approve();
    }
    elseif ($_GET['action'] == "reject") 
    {
        $request->reject();
    }
}

$pendingRequests = $project->getJoinRequests();
$pendingRequests = (empty($pendingRequests)) ? "" : $pendingRequests;
$links = getLinks($project->projectId);
?>
<div class="container">
    <div class="boxLayout">

        <!-- right panel -->
        <div class="fileLinks rightPanel right">

            <!-- connected files (If there's any)-->
            <div class="bootstrap">
                <div class="panel panel-default">
                  <div class="panel-heading">Connected apps &amp; links</div>
                  <div class="panel-body">
                    <p><a id="add-link" href="#"><span class="icon glyphicon glyphicon-plus"></span> Add app and links</a></p>
                    <div class="row" id="add-link-form" style="display:none;">
                      <input class="col-md-6" type="text" name="title" placeholder="app or link name"><input class="col-md-6" type="text" name="location" placeholder="url address">
                      <button type="submit" id="add-link-save">save</button><br>
                      <span class="add-link-errors"></span>
                    </div>
                  </div>
                  <ul class="links list-group">
                  <?php
                  foreach ($links as $l) {
                    echo "<li class=\"list-group-item\"><a href=\"{$l->location}\" target=\"_blank\"><span class=\"icon glyphicon glyphicon-link\"></span> {$l->title}</a></li>";
                  }
                  ?>
                  </ul>
                </div>
            </div>
        </div> <!-- /right -->

        <!-- left panel -->
        <div class="left">
<?php
if ($pendingRequests != "" && count($pendingRequests) > 0)
{
    echo <<<HTML
          <!-- Join Request (If there's any) -->
          <div class="bootstrap request">
              <div class="panel panel-warning">
                <div class="panel-heading">
                  <h3 class="panel-title">Join Request</h3>
                </div>
HTML;
foreach ($pendingRequests as $request) {
    $timeString = time_elapsed_string($request->timestamp);
    $roleString = (!is_null($request->role)) ? "Apply for role : ".$request->role->title : "";
    echo <<<HTML
                <div class="panel-body">
                  <div class="commentsBox">
                      <div class="right commentsContainer">
                          <div class="nameDate bootstrap">
                           {$request->user->firstName} {$request->user->lastName} <span class="date"> $timeString </span><br/>
                           <span class="apply"> $roleString </span>
                          </div>
                          <div class="comments">
                              $request->message
                          </div>
                      </div>
                      <div class="photo">
                          <img src="images/profile/{$request->user->profilePicUrl}" alt="profile picture" />
                      </div>
                  </div>

                  <!-- approve /reject -->
                  <!-- <button type="submit" class="btn btn-warning right" data-toggle="modal" data-target="#respondModal">Respond to request</button>  -->
                    <a href="{$_SERVER['PHP_SELF']}?id={$project->projectId}&joinRequest={$request->id}&action=approve">
                    <button type="button" class="btn btn-success" value="Approve">Approve</button></a>
                    <a href="{$_SERVER['PHP_SELF']}?id={$project->projectId}&joinRequest={$request->id}&action=reject">
                    <button type="button" class="btn btn-danger" value="Reject">Reject</button></a>
                </div>
HTML;
}
echo <<<HTML
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
                      <form role="form" action="{$_SERVER['PHP_SELF']}?id={$project->projectId}" method="post" id="request_response">
                        <div class="form-group">
                          <label> Message to send </label>
                          <textarea name="rejectReason" class="form-control rejectReason" row="1" placeholder="Welcome message, or why do you reject him/her?"></textarea>
                        </div> 
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" form="request_response" class="btn btn-success" value="Approve">Approve</button>
                      <button type="submit" form="request_response" class="btn btn-danger" value="Reject">Reject</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>
HTML;
}
?>

            <!-- post comments -->
            <div class="post">
                <h3>Got something to say?</h3>
                <form accept-charset="UTF-8" action="" method="post">
                    <textarea data-fieldlength="500" id="newcomment" name="comment"></textarea><br>
                    <input type="hidden" name="private" value="true" />
                    <div class="bootstrap submit right">
                        <button type="button" id="postnewcomment" class="btn btn-success right">Post</button>
                    </div>
                </form>
            </div>
            
            <!-- posts (If there's any) -->
<?php 
$comments = $project->getPrivateComments();
foreach ($comments as $comment) 
{
  
  echo <<<HTML
                        <div class="commentsBox">
                          <div class="commentsContainer">
                          <div class="photo right">
                              <img src="images/profile/{$comment->postedBy->profilePicUrl}" alt="profile picture" />
                            </div>
                            <div class="nameDate bootstrap">
                              {$comment->postedBy->firstName} {$comment->postedBy->lastName} <span class="date">{$comment->timeElapsed}</span>
                            </div>
                            
                            <div class="comments">
                              $comment->content
                            </div>
                          </div>
                          
                        </div>
HTML;
} 
?>
        </div> <!-- /left -->
    </div>  <!-- /boxLayout -->


</div> <!-- /container -->


<script>
  $( "#add-link" ).click(function() {
    $( "#add-link-form" ).toggle(250);
  });
  $( "#add-link-save" ).click(function() {
    var newTitle = $( "input[name='title']" ).val();
    var newLocation = $( "input[name='location']" ).val();
    console.log(newTitle);
    console.log(newLocation);
    $.post( "ajax/link.php", { project: "<?php echo $project->projectId; ?>", title: newTitle, location: newLocation, action: 'create' } )
        .done(function( data ) {
          
          if (data === false) {
            $( ".add-link-errors" ).html( "Sorry, something went wrong" );
            console.log(data);
          } else {
            $( ".links" ).append( data );
          }
          
      
        });

  });

  $( "#newcomment" ).editable({
          inlineMode: false, 
          language: 'en_gb',
          buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline'],
          editorClass: "newcomment",
      });
  
  $( "#postnewcomment" ).click(function() {
      
      var newCommentHtml = $( ".newcomment" ).html();

      $.post( "ajax/comment.php", { user: "<?php echo $user->userId; ?>", project: "<?php echo $project->projectId; ?>", content: newCommentHtml, private: 1 } )
          .done(function( data ) {
              
              if (data === false) {
                  $( ".newcomment" ).after( "Sorry, something went wrong" );
                  console.log(data);
              } else {
                $( ".post" ).after( data );
              }
              
          
          });
  });
    
</script>
