<?php
session_start();
$data = json_decode(file_get_contents("users.json"),true);
if(!isset($_SESSION['LOGGED_IN']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  if(password_verify($_POST['password'], $data[htmlspecialchars($_POST['username'])])) {
    $_SESSION['LOGGED_IN'] = true;
    $_SESSION['user'] = $_POST['username'];
    echo "Signed in as " . $_SESSION['user'];
    exit();
  } else {
    http_response_code(401);
    echo "Signin failed";
    exit();
  }
} 
if(isset($_SESSION['LOGGED_IN'])) {
  echo "You are already signed in as " . $_SESSION['user'] . "<br>";
  echo '<button onclick="' . "location.href='/signout.php'" . '">Log Out</button>';
  exit();
}
?>
<?php if (!isset($_SESSION['LOGGED_IN'])): ?>
<form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <input type="text" name="username" placeholder="Username" autocomplete="off" required/> <br>
  <input type="password" name="password" placeholder="Password" required/> <br>
  <input type="submit"/>
</form>
<?php endif ?>