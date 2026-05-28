<?php 
include('conn.php');
$id=$_GET['id'];

$sel = mysqli_query($conn,"SELECT * FROM student WHERE id = '$id' ");
$row = mysqli_fetch_assoc($sel);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Student Form</h1>
    <form method="post">
      <input type="hidden" name="id" value="<?php echo $row['id'];?>"><br>
      
      <label> Enter your name : </label><br>
      <input type="text" name="name" value="<?php echo $row['name'];?>"><br>

      <label> Enter your Phone Number : </label><br>
      <input type="number" name="phone" value="<?php echo $row['phone'];?>"><br>

      <label> Enter your EMail : </label><br>
      <input type="email" name="email" value="<?php echo $row['email'];?>"><br>

      <label> Enter your Department : </label><br>
      <input type="text" name="dpet" value="<?php echo $row['dpet'];?>"><br>

      <input type="submit" name="submit">
</form>

  <?php
  include('conn.php');

  if(isset($_POST['submit']))
  {
     $name=$_POST['name'];
     $phone=$_POST['phone'];
     $email=$_POST['email'];
     $dpet=$_POST['dpet'];

     $update =mysqli_query($conn,"UPDATE student SET name = '$name' , phone ='$phone',email = '$email',dpet = '$dpet' where id = '$id' ");
     if($update)
     {
        echo ("<script> alert('updated');window.location.replace('table2.php');</script>");
     }
     else
     {
        echo ("<script> alert('not updated');</script>");
     }
  }

  ?>
</body>
</html>