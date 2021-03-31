<?php
require_once('db_config.php');
require_once('function.php');

if(isset($_POST['firstname'])){

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $birthday=$_POST['birthday'];
  $gender=$_POST['gender'];
  $usertype="Customer";


  $sqlchkrow="select max(UserID) as m from user";
  $result=mysqli_query($db_conn,$sqlchkrow);
  $row=mysqli_fetch_assoc($result);
  $maxval=$row['m']+1;

  $chkuser = "SELECT * FROM user WHERE `email` = '".$email."'";
  $userresult = mysqli_query($db_conn, $chkuser);

  if(mysqli_num_rows($userresult) > 0){
      echo "<script>alert('email already registered. Please enter the other email.')</script>";
  }else{


  $sqlinsert = "INSERT INTO `user` (`FirstName`, `LastName`, `email`, `password`, `Birthday`, `Gender`,`UserID`,`UserType`)
              VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$password."', '".$birthday."', '".$gender."','".$maxval."','".$usertype."')";


              $result=mysqli_query($db_conn,$sqlinsert);
              $to="login.php";
              if ($result>0){
                //delete  Success
              $msg="Sign up is Success";
              }else{
                //delete failure
                 $msg="Sign up is not successful";
              }
              goto2($to,$msg);
}
}

 ?>

<html>
<head>
<link id="pagestyle" rel="stylesheet" type="text/css" href="../css/Signup1.css"/>
<script src="../javascript/FormValidation.js"></script>
<title>Sign Up</title>
</head>

<body>
<div class="form">

<h1><u>Create your account here</u></h1>

<br>

<form action="signup.php" method="post" id="sign_up_form">
<div class="grid_container">
<p class="firstname">First name</p> <input type="text" class="firstname" name="firstname">
<p class="lastname">Last name</p> <input type="text" class="lastname" name="lastname">
<p class="email">Email</p> <input type="email" class="email" name="email">
<p class="password">Password</p> <input type="password" class="password" name="password">
<p class="cpassword">Confirm Password</p> <input type="password" class="cpassword" name="cpassword">
<p class="gender">Gender</p> <select class="gender" name="gender">
       <option value="Male">Male</option>
       <option value="Female">Female</option>
     </select>

<p class="birthday">Birthday</p> <input type="date" class="birthday" name="birthday">
<br><br>
</div>
<div class="button">
<button type="button" class="signup" onclick="signUpValidation()" >Sign up</button>
</div>
<div class="linker">
  <a class="linker" href="login.php">Login</a>
  <a class="linker" href="../index.php">Back to homepage</a>
</div>
</form>
</div>
</body>
</html>
