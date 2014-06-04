<?php


?>
<div class="container">	
	<div class="content">

        <div class="projectTitle bootstrap">
            <h1>Join ProjectHub<br/>
            <small> </small>
            </h1>
        </div>

        <div id="success">
        <?php 
            if (isset($message)) { echo "<p class='message'>".$message."</p>"; }
            if (isset($errors)) {
                foreach ($errors as $error) { echo "<p class='error'>".$error."</p>"; }
                unset($_SESSION['errors']);
            } 
        ?>
        </div>

        <div class="project">
            <div id="regbox">
                <form name="register" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
				

                <p>
                    <label>About you:</label>
                    <textarea name="blurb" id="blurb"></textarea>
                </p>
                <p>
                    <label>Your skills and interests:</label>
                    <input type="text" name="tags" />
                </p>
                
            	</form>
        
          	</div>
        </div>           
  	</div>
</div>
<script>
    $(function() {
        $('#blurb').editable({
        	inlineMode: false, 
        	width: 800,  
        	language: 'en_gb',
        	 buttons: ['undo', 'redo' , 'sep', 'bold', 'italic', 'underline']
        })
    });
</script>

<?php
include('includes/footer.php');
?>