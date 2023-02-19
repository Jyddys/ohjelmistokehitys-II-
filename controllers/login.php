
<?php
  session_start();
  
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: protected_page.php');
    exit;
  }
  
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === 'testi1' && $password === '123') {
      $_SESSION['logged_in'] = true;
      header('Location: protected_page.php');
      exit;
    }
  }
?>

<form action="login.php" method="post">
  <label for="username">Username:</label>
  <input type="text" name="username" id="username">
  
  <label for="password">Password:</label>
  <input type="password" name="password" id="password">
  
  <input type="submit" value="Login">
</form>