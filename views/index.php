<?php 
$title = 'theTrackerApp';

ob_start();
require '../views/nav.php';
session_start();
  
  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
  }

?>

<div class="welcome">
    <h1>Welcome to theTrackerApp</h1>

    <p>An app that helps you track time you spend on your favorite tasks</p>
</div>
<?php
$content = ob_get_clean();
include '../views/layout.php';
?>