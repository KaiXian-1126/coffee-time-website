
<?php

require_once('db_config.php');
require_once('function.php');
$vid=$_GET['userid'];

$sqldelete="DELETE FROM `user` WHERE `UserID` ='$vid'";

$result=mysqli_query($db_conn,$sqldelete);
$to="edit_user.php";
if ($result>0){
  //delete  Success
$msg="Delete was Success";
}else{
  //delete failure
  $msg="Delete is not successful";
}
goto2($to,$msg);
 ?>
