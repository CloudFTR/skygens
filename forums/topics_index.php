<h1>Index of topics</h1>
<ul>
<?php
$posts = json_decode(file_get_contents("topics.json"));
foreach($posts as $postname=>$n) {
  echo "<li>";
  echo '<a href="/topic.php?topic=' . urlencode($postname) . '">' . $postname . '</a>';
  echo "</li>";
}
?>
</ul>
