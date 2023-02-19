<?php
$title = 'theTrackerApp';

require_once "../model/model.php";

get_username();

?>

<div class="welcome">
    <h1>Welcome to theTrackerApp</h1>

    <p>An app that helps you track time you spend on your favorite tasks</p>
</div>

<form action="login.php" method="post" class="login-form center">
  <label for="username">Username:</label>
  <input class="login-form" type="text" name="username" id="username">
  
  <label for="password">Password:</label>
  <input class="login-form" type="password" name="password" id="password">
  <br>
  <input id="login-btn" type="submit" value="Login">
</form>

<?php
$content = ob_get_clean();
include '../views/layout.php';
?>