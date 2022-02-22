<?php
session_start();
$posts = json_decode(file_get_contents("topics.json"), true);
if(!array_key_exists($_GET['topic'], $posts)) {
  http_response_code(404);
  echo "That topic does not exist";
  exit();
} else {
  if($_SESSION['user'] === $posts[$_GET['topic']][0]['author']) {
    echo '<form method="POST" action="/delete_topic.php"><input type="hidden" name="topic" value="' . $_GET['topic'] . '"/><input type="submit" value="Delete"/></form>';
  }
  foreach($posts[$_GET['topic']] as $index => $post) {
    echo $post['author'] . ': ' . $post['content'];
    if($index !== count($posts[$_GET['topic']]) - 1) {
      echo "<hr/>";
    }
  }
}
?>
<?php if($_SESSION['LOGGED_IN']): ?>
<br> <br> <a href="<?php echo '/reply.php?topic=' . $_GET['topic'] ?>">Reply</a>
<?php else: ?>
<p>Please login to post.</p>
<?php endif ?>

