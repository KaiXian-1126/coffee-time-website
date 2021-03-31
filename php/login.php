<?php
require_once('db_config.php');
require_once('function.php');
session_start();
if(isset($_SESSION['email'])){
    echo "<script>window.location = '../index.php'</script>";
}
else if(isset($_POST['email']) && isset($_POST['password'])){
    $sql = "SELECT * FROM `user`
    WHERE `email` = '".$_POST['email']."' AND `password` = '".$_POST['password']."'";

    $result = mysqli_query($db_conn, $sql);
    $num_row = mysqli_num_rows($result);
    if($num_row > 0){
        $result_row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $result_row['email'];
        echo "<script>window.location = '../index.php'</script>";
    }else{
        echo "<script>alert('Invalid Username and Password')</script>";
        echo "<script>window.location = 'login.php'</script>";
    }

}
 ?>

 <head>
 <link id="pagestyle" rel="stylesheet" type="text/css" href="../css/login.css"/>
 <title>Login</title>
 </head>

 <html>
 <body>

  <div class="login">
  <img src="../img/coffeeicon.jpg" class="avatar.jpg">
  <h1>Login your account here</h1>

  <form method="post" action="login.php">

  <p class="pattern">Email</p><input type="text" class="pattern" name="email" placeholder="Enter your email"><br>
  <p class="pattern">Password</p><input type="password"  class="pattern" name="password" placeholder="Enter your password"><br><br>
  <div class="submit">
  <input class="submit" type="submit" value="Login">
  </div>


  <p class="noaccount">Dont have account?</p>

  <a class="signup-link" href="signup.php">Sign up</a>
  <a class="homepage-link" href="../index.php">Back to homepage</a>
  </form>
  </div>
 </body>
 </html>
