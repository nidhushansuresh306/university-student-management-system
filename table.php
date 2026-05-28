<?php
include('session.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Table</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f7fa;
      padding: 30px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .top-bar {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
    }

    .add-btn {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .add-btn:hover {
      background-color: #218838;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    a {
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    img {
      border-radius: 4px;
    }
  </style>
</head>
<body>

  <h1>EMPLOYEE DETAILS</h1>

  <div class="top-bar">
    <a href="index1.php" class="add-btn">+ Add Employee</a>
  </div>

  <table>
    <tr>
      <th>S.No</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Location</th>
      <th>Photo</th>
      <th>DOB</th>
      <th>Join Date</th>
      <th>Position</th>
      <th>Salary</th>
      <th>Aadhar</th>
      <th>PAN</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>

    <?php
      include('conn.php');
      $get = mysqli_query($conn , "SELECT * FROM employees");
      $cnt = 1;
      while($row = mysqli_fetch_assoc($get)) {
          $id = $row['id'];
    ?>
      <tr>
        <td><?php echo $cnt++; ?></td>
        <td><?php echo $row['emp_name']; ?></td>
        <td><?php echo $row['emp_phone']; ?></td>
        <td><?php echo $row['emp_email']; ?></td>
        <td><?php echo $row['emp_location']; ?></td>
        <td><img src="<?php echo $row['emp_photo']; ?>" alt="Photo" width="50" height="50"></td>
        <td><?php echo $row['emp_dob']; ?></td>
        <td><?php echo $row['emp_joindate']; ?></td>
        <td><?php echo $row['emp_position']; ?></td>
        <td><?php echo $row['emp_salary']; ?></td>
        <td><?php echo $row['emp_aadhar']; ?></td>
        <td><?php echo $row['emp_pan']; ?></td>
        <td><a href="update.php?id=<?php echo $id;?>">Update</a></td>
        <td><a href="delete.php?id=<?php echo $id;?>">Delete</a></td>
      </tr>
    <?php } ?>
  </table>

</body>
</html>
