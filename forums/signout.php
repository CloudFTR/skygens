<?php
session_start();
if($_SESSION['LOGGED_IN']) {
  session_unset();
  session_destroy();
  echo "Logged out";
} else {
  echo "You are not signed in.";
}
?>