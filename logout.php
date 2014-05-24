<?php

require 'includes/include.php';
//Log the user out
if($user->isLoggedIn) $user->logOut();

header("Location: http://".$_SERVER['HTTP_HOST']);
die();
?>


