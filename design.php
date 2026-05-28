<?php
// design.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      background-color: #f4f7fa;
      color: #333;
    }

    .sidebar {
      width: 220px;
      background: linear-gradient(180deg, #1e3c72, #2a5298);
      color: white;
      height: 100vh;
      padding-top: 20px;
      position: fixed;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .sidebar ul {
      list-style: none;
    }

    .sidebar ul li {
      padding: 12px 20px;
      transition: background 0.3s;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      display: block;
      font-weight: 500;
    }

    .sidebar ul li:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .dropdown-content {
      display: none;
      background-color: rgba(255, 255, 255, 0.1);
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown-content li {
      padding-left: 30px;
      font-size: 14px;
    }

    .main {
      margin-left: 220px;
      width: calc(100% - 220px);
    }

    .header {
      background-color: #fff;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .header .title {
      font-size: 26px;
      font-weight: 600;
      color: #2c3e50;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .profile img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      border: 2px solid #2a5298;
      object-fit: cover;
    }

    .profile span {
      font-weight: 500;
    }

    .content {
      padding: 30px;
    }

    .form-container {
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      width: 100%;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
    }

    .message {
      color: green;
      text-align: center;
      margin: 10px 0;
    }

    label, input {
      width: 100%;
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"] {
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #2c3e50;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #34495e;
    }

    .logout-button {
      background-color: #e74c3c;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      display: block;
      margin: 20px;
    }
  </style>
</head>
<body>

  <nav class="sidebar">
    <div>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>

        <li class="dropdown">
          <a href="#">University</a>
          <ul class="dropdown-content">
            <li><a href="uniadd.php">Add</a></li>
            <li><a href="uniview.php">View</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#">College</a>
          <ul class="dropdown-content">
            <li><a href="clgadd.php">Add</a></li>
            <li><a href="clgview1.php">View</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#">Department</a>
          <ul class="dropdown-content">
            <li><a href="deptadd.php">Add</a></li>
            <li><a href="deptview.php">View</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#">Staff</a>
          <ul class="dropdown-content">
            <li><a href="staffadd.php">Add</a></li>
            <li><a href="staffview.php">View</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#">Student</a>
          <ul class="dropdown-content">
            <li><a href="studentadd.php">Add</a></li>
            <li><a href="studentview.php">View</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- 🔴 Logout Button at the end -->
    <div>
    <a href="logout.php" class="logout-button">Logout</a>

    </div>
  </nav>

  <div class="main">
    <div class="header">
      <div class="title">Admin Dashboard</div>
      <div class="profile">
        <img src="profile/download.jfif" alt="Student">
        <span>Student Name</span>
      </div>
    </div>

    <div class="content">
      <!-- Content goes here (this is dynamic) -->
