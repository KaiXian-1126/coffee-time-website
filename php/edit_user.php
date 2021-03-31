<?php
require_once('db_config.php');
require_once('function.php');
$sql='SELECT * FROM `user`';
$result=mysqli_query($db_conn,$sql);
$num_row=mysqli_num_rows($result);
$counter=1;
 ?>
 <head>
 <link id="pagestyle" rel="stylesheet" type="text/css" href="../css/edit_user.css"/>
 <script src="../javascript/searching.js"></script>
 <script src="../javascript/FormValidation.js"></script>
 <title>Edit User</title>
 </head>


 <h1>Edit user information</h1>
<body>
<a class="back" href="manage_user.php"> << Back to previous page</a>
<div class="table" >
  <form name="UserList" action="update_user.php" method="post" id="update_form">
 <table id="User_table">
   <tr>
     <th>No</th>
     <th >FirstName</th>
     <th >LastName</th>
     <th >email</th>
     <th>birthday</th>
     <th>Gender</th>
     <th>User Type</th>
</tr>



<?php while($row=mysqli_fetch_assoc($result)){?>
<tr>
<td><?php echo $counter++;?></td>
<td><input type="text"  value="<?php echo $row['FirstName'];?>" name="fname[]"></td>
<td><input type="text"  value="<?php echo $row['LastName'];?>" name="lname[]"></td>
<td><input type="text" value="<?php echo $row['email'];?>" name="email[]"></td>
<td><input type="date" value="<?php echo $row['Birthday'];?>" name="birthday[]"></td>
<td><select name="gender[]">
 <option value="Male"<?php if($row['Gender']=="Male"){echo 'selected';} ?>>Male</option>
 <option value="Female"<?php if($row['Gender']=="Female"){echo 'selected';} ?>>Female</option>
</select>
</td>
<td><select  name="usertype[]">
  <option value="Member"<?php if($row['UserType']=="Member"){echo 'selected';} ?>>Member</option>
  <option value="Customer"<?php if($row['UserType']=="Customer"){echo 'selected';} ?>>Customer</option>
     </select>
    <input type="hidden" name="userid[]" value="<?php echo $row['UserID'];?>"></td>
<td class="delete" style="border:solid rgb(253, 227, 167) 1px;"><a class="delete" href="delete_user.php?userid=<?php echo $row['UserID'];?>" onclick="return confirm('Confirm to delete?')">Delete</a></td>

</tr>
<?php } ?>

 </table>
 <div style="text-align:center; margin:30px;">
 <button class="submit" type="button" onclick="updatevalidation()">Update</button>
</div>

<div class="adduser">
  <a href="add_user.php" >Add User</a>
</div>
</form>

</div>
</body>
