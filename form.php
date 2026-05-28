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
      <label> Enter your name : </label><br>
      <input type="text" name="name"><br>

      <label> Enter your Phone Number : </label><br>
      <input type="number" name="phone"><br>

      <label> Enter your EMail : </label><br>
      <input type="email" name="email"><br>

      <label> Enter your Department : </label><br>
      <input type="text" name="dpet"><br>

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

     $insert=mysqli_query($conn , " INSERT INTO student (name , phone , email , dpet) VALUES ('$name' , '$phone' , '$email' , '$dpet')");
     if($insert)
     {
        echo ("<script> alert('inserted');</script>");
     }
     else
     {
        echo ("<script> alert('not inserted');</script>");
     }
  }

  ?>
</body>
</html>