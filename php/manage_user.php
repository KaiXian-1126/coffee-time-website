<?php
require_once('db_config.php');
$sql='SELECT * FROM `user`';
$result=mysqli_query($db_conn,$sql);
$num_row=mysqli_num_rows($result);
$counter=1;
 ?>
 <head>
 <link id="pagestyle" rel="stylesheet" type="text/css" href="../css/view_user.css"/>
 <script src="../javascript/searching.js"></script>
 <title>Manage User</title>
 </head>

<body>
 <h1>All user information</h1>
 <a class="back" href="../index.php"> << Back to homepage</a>
 <div class="header4">
   <input class="search" type="text" id="search" onkeyup="search_function()" class="searching" placeholder="Search....">
 </div>
<div class="edit">
  <a class="edit" href="edit_user.php">Edit user</a>
</div>
<div class="table" >
 <table id="User_table">
   <tr>
     <th>No</th>
     <th style="width:20%;">Name</th>
     <th style="width:30%;">email</th>
     <th>birthday</th>
     <th>Gender</th>
     <th>User Type</th>
</tr>
<div style="width:20%; margin:auto;">
<p class="totaluser">Total user : <?php echo $num_row ?></p>
</div>
<?php while($row=mysqli_fetch_assoc($result)){?>
<tr>
<td><?php echo $counter++;?></td>
<td><?php echo $row['FirstName'] ," ",$row['LastName'];?></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['Birthday'];?></td>
<td><?php echo $row['Gender'];?></td>
<td><?php echo $row['UserType'];?></td>


</tr>
<?php } ?>

 </table>

</div>
</body>
