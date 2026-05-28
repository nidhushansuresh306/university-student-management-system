<?php
include('session.php');
?>



<!DOCTYPE html>
<html>
<head>
  <title>Upload Employee</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
    }

    form {
      max-width: 500px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background: #f9f9f9;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="email"],
    input[type="date"],
    input[type="file"] {
      width: 100%;
      padding: 8px;
      margin: 8px 0 16px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    #preview {
      margin-top: 10px;
      max-width: 100%;
      height: auto;
      border: 1px solid #ccc;
      padding: 4px;
      display: none;
    }
  </style>
</head>
<body>

<h2>Upload Employee Details</h2>
<div style="text-align: right; margin-bottom: 20px;">
  <a href="table.php" style="
      background-color: #4a90e2;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
      transition: background 0.3s ease;
  " onmouseover="this.style.background='#357ab8'" onmouseout="this.style.background='#4a90e2'">
    View Employees
  </a>

  <a href="logout.php" style="
      background-color: #e74c3c;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      font-size: 14px;
  " onmouseover="this.style.background='#c0392b'" onmouseout="this.style.background='#e74c3c'">
    Logout
  </a>
</div>
</div>

<form  method="post" enctype="multipart/form-data">
  <label>Enter your Name:</label><br>
  <input type="text" name="emp_name"><br>

  <label>Enter your Phone Number:</label><br>
  <input type="number" name="emp_phone"><br>

  <label>Enter your Email:</label><br>
  <input type="email" name="emp_email"><br>

  <label>Enter your Location:</label><br>
  <input type="text" name="emp_location"><br>

  <label>Upload your Photo:</label><br>
  <input type="file" name="emp_photo" accept="image/*" onchange="previewImage(event)"><br>
  <img id="preview" alt="Image Preview"><br>

  <label>Enter your Date of Birth:</label><br>
  <input type="date" name="emp_dob"><br>

  <label>Enter your Joining Date:</label><br>
  <input type="date" name="emp_joindate"><br>

  <label>Enter your Position:</label><br>
  <input type="text" name="emp_position"><br>

  <label>Enter your Salary:</label><br>
  <input type="number" name="emp_salary"><br>

  <label>Enter your Aadhar Number:</label><br>
  <input type="text" name="emp_aadhar"><br>

  <label>Enter your PAN Number:</label><br>
  <input type="text" name="emp_pan"><br>

  <input type="submit" name="submit" value="Upload Employee">
</form>
<?php
if (isset($_POST['submit'])) {
    include('conn.php');

    $emp_name = $_POST['emp_name'];
    $emp_phone = $_POST['emp_phone'];
    $emp_email = $_POST['emp_email'];
    $emp_location = $_POST['emp_location'];
    $emp_dob = $_POST['emp_dob'];
    $emp_joindate = $_POST['emp_joindate'];
    $emp_position = $_POST['emp_position'];
    $emp_salary = $_POST['emp_salary'];
    $emp_aadhar = $_POST['emp_aadhar'];
    $emp_pan = $_POST['emp_pan'];

    $photo_name = $_FILES['emp_photo']['name'];
    $tmp_name = $_FILES['emp_photo']['tmp_name'];
    $target = "uploads/" . basename($photo_name);

    if (move_uploaded_file($tmp_name, $target)) {
        $query = "INSERT INTO employees (
            emp_name, emp_phone, emp_email, emp_location, emp_photo,
            emp_dob, emp_joindate, emp_position, emp_salary, emp_aadhar, emp_pan
        ) VALUES (
            '$emp_name', '$emp_phone', '$emp_email', '$emp_location', '$target',
            '$emp_dob', '$emp_joindate', '$emp_position', '$emp_salary', '$emp_aadhar', '$emp_pan'
        )";

        if (mysqli_query($conn, $query)) {
            echo "Employee uploaded successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Image upload failed.";
    }
}
?>

<script>
function previewImage(event) {
  const preview = document.getElementById('preview');
  preview.src = URL.createObjectURL(event.target.files[0]);
  preview.style.display = 'block';
}
</script>

</body>
</html>
