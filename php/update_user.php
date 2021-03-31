<?php
require_once('db_config.php');
require_once('function.php');
$fname = $_POST['fname'];
$lname=$_POST['lname'];
$email =$_POST['email'];
$birthday =$_POST['birthday'];
$gender =$_POST['gender'];
$userid=$_POST['userid'];
$usertype=$_POST['usertype'];

foreach($fname as $key=>$firstname ){
  $sqlupdate="UPDATE `user` SET `FirstName` ='".$fname[$key]."', `LastName`='".$lname[$key]."'
  , `email` ='".$email[$key]."', `Birthday` ='".$birthday[$key]."',
  `Gender` ='".$gender[$key]."',`UserType` ='".$usertype[$key]."' WHERE `UserID` = ".$userid[$key];

  $result=mysqli_query($db_conn,$sqlupdate);
}
// exit;
$to="manage_user.php";
if ($result>0){
  //delete  Success
$msg="Update was Success";
}else{
  //delete failure
  $msg="Update is not successful";
}
goto2($to,$msg);

 ?>
