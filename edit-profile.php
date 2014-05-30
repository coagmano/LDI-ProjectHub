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
                    <label>Email:</label>
                    <input type="email" name="email" />
                </p>

                <p>
                    <label>About you:</label>
                    <textarea name="blurb" id="blurb"></textarea>
                </p>
                <p>
                    <label>Your skills and interests:</label>
                    <input type="text" name="tags" />
                </p>