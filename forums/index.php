<?php
session_start();
echo "Forums, programmed by @programmer_user and @18001767679 in PHP <br> <br>";
?>
<a href="/topics_index.php">Index of topics</a> <br>
<?php if (isset($_SESSION['LOGGED_IN'])): ?> 
<a href="/new_topic.php">New Topic</a> <br>
<a href="/signout.php">Sign Out</a>
<?php else: ?>
<a href="/login.php">Login</a> <br>
<a href="/signup.php">Sign up</a>
<?php endif ?>
