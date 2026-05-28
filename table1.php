<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
</head>
<body>
<h1>STUDENT DETAILS</h1>
<table border="5">
  <<tr>
  <th>S.no</th>
  <th>Name</th>
  <th>Phone</th>
  <th>Email</th>
  <th>Department</th>
  <th>Image</th> <!-- NEW -->
  <th>Image Path</th> <!-- NEW -->
  <th>Update</th>
  <th>Delete</th>
</tr>


  <?php

  include('conn.php');
  $tab=mysqli_query($conn,"Select * from student");
  $num = 1;
  while($fetch=mysqli_fetch_assoc($tab))

  {
    $id=$fetch['id'];

  ?>
  <<tr>
  <td><?php echo $num++ ?></td>
  <td><?php echo $fetch['name'] ?></td>
  <td><?php echo $fetch['email'] ?></td>
  <td><?php echo $fetch['phone'] ?></td>
  <td><?php echo $fetch['dpet'] ?></td>
  <td><img src="<?php echo $fetch['img']; ?>" width="80" height="80"></td>
  <td><?php echo $fetch['img']; ?></td> <!-- Show image path -->
  <td><a href="update.php?id=<?php echo $id;?>"> Update </a></td>
  <td><a href="delete.php?id=<?php echo $id;?>"> delete </a></td>
</tr>

  <?php
  }
  ?>


</body>
</html>