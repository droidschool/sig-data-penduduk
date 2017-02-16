<?php

session_start();
if(!empty($_SESSION['id'])){
  header('Location: index.php');
}
require_once '../classes/database.php';
if(isset($_POST['login'])){
  $mysqli = new Database();
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $login = $mysqli->login($user);
  while($row = $login->fetch_assoc()){
    if(password_verify($pass, $row['pass'])){
      $_SESSION['id'] = $user;
      header('Location: index.php');
    }else{
      header('Location: login.php');
    }
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../template/login.css">
  </head>
  <body>
    <div id="box">
      <div id="box-head">
        <h2>SIG Data Penduduk</h2>
      </div>
      <div id="box-body">
        <form action="" method="post">
            <input type="text" name="username" class="input" placeholder="Username" required>
            <input type="password" name="password" class="input" placeholder="Password" required>
            <input type="submit" name="login" class="input btn-login" value="Login">
        </form>
      </div>
    </div>
  </body>
</html>
