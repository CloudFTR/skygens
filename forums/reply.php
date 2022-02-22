<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if($_SESSION['LOGGED_IN']) {
    $posts = json_decode(file_get_contents("topics.json"), true);
    array_push($posts[htmlspecialchars($_POST['topic-name'])], array('author' => $_SESSION['user'], 'content' => str_replace("\n","<br>",htmlspecialchars($_POST['content']))));
    file_put_contents("topics.json", json_encode($posts));
    header("Location: /topic.php?topic=" . urlencode(htmlspecialchars($_POST['topic-name'])));
    exit();
  } else {
    http_response_code(401);
    echo "You need to be logged in to post";
  }
}
?>
<?php if(!($_SERVER['REQUEST_METHOD'] === 'POST') && $_SESSION['LOGGED_IN']): ?>
<form id="post-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <input type="text" 
  name="topic-name" 
  placeholder="Topic Name" 
  value="<?php if($_GET['topic'] ?? null) echo $_GET['topic']; ?>"
  <?php if($_GET['topic'] ?? null) {
    echo "readonly"; 
  }
  ?>
  /> <br>
  <textarea form="post-form" name="content" placeholder="Post Content"></textarea> <br>
  <input type="submit"/>
</form>
<?php else: ?>
<?php http_response_code(401); ?>
Please login to post.
<?php endif; ?>