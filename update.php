<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}
?>



<?php
include('conn.php');
$id = $_GET['id'];

$get = mysqli_query($conn, "SELECT * FROM employees WHERE id='$id'");
$row = mysqli_fetch_assoc($get);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Employee</title>
</head>
<body>
  <h1>Employee Form</h1>
  <form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"><br>

    <label>Name:</label><br>
    <input type="text" name="emp_name" value="<?php echo $row['emp_name']; ?>"><br>

    <label>Phone:</label><br>
    <input type="text" name="emp_phone" value="<?php echo $row['emp_phone']; ?>"><br>

    <label>Email:</label><br>
    <input type="email" name="emp_email" value="<?php echo $row['emp_email']; ?>"><br>

    <label>Location:</label><br>
    <input type="text" name="emp_location" value="<?php echo $row['emp_location']; ?>"><br>

    <label>Photo (URL):</label><br>
    <input type="text" name="emp_photo" value="<?php echo $row['emp_photo']; ?>"><br>

    <label>Date of Birth:</label><br>
    <input type="date" name="emp_dob" value="<?php echo $row['emp_dob']; ?>"><br>

    <label>Join Date:</label><br>
    <input type="date" name="emp_joindate" value="<?php echo $row['emp_joindate']; ?>"><br>

    <label>Position:</label><br>
    <input type="text" name="emp_position" value="<?php echo $row['emp_position']; ?>"><br>

    <label>Salary:</label><br>
    <input type="number" name="emp_salary" value="<?php echo $row['emp_salary']; ?>"><br>

    <label>Aadhar:</label><br>
    <input type="text" name="emp_aadhar" value="<?php echo $row['emp_aadhar']; ?>"><br>

    <label>PAN:</label><br>
    <input type="text" name="emp_pan" value="<?php echo $row['emp_pan']; ?>"><br><br>

    <input type="submit" name="submit" value="Update">
  </form>

  <?php
  if (isset($_POST['submit'])) {
    $emp_name = $_POST['emp_name'];
    $emp_phone = $_POST['emp_phone'];
    $emp_email = $_POST['emp_email'];
    $emp_location = $_POST['emp_location'];
    $emp_photo = $_POST['emp_photo'];
    $emp_dob = $_POST['emp_dob'];
    $emp_joindate = $_POST['emp_joindate'];
    $emp_position = $_POST['emp_position'];
    $emp_salary = $_POST['emp_salary'];
    $emp_aadhar = $_POST['emp_aadhar'];
    $emp_pan = $_POST['emp_pan'];

    $update = mysqli_query($conn, "UPDATE employees SET 
      emp_name='$emp_name', 
      emp_phone='$emp_phone', 
      emp_email='$emp_email', 
      emp_location='$emp_location', 
      emp_photo='$emp_photo', 
      emp_dob='$emp_dob', 
      emp_joindate='$emp_joindate', 
      emp_position='$emp_position', 
      emp_salary='$emp_salary', 
      emp_aadhar='$emp_aadhar', 
      emp_pan='$emp_pan' 
      WHERE id='$id'");

    if ($update) {
      echo ("<script>alert('Updated successfully'); window.location.replace('table.php');</script>");
    } else {
      echo ("<script>alert('Update failed');</script>");
    }
  }
  ?>
</body>
</html>
