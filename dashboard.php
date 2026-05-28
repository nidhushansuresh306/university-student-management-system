<?php
include('conn.php');
include('design.php');

// Count students
$student_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM student");
$student_row = mysqli_fetch_assoc($student_result);
$student_count = $student_row['total'];

// Count universities
$university_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM university");
$university_row = mysqli_fetch_assoc($university_result);
$university_count = $university_row['total'];

// Count colleges
$college_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM college");
$college_row = mysqli_fetch_assoc($college_result);
$college_count = $college_row['total'];
?>

<style>
  .dashboard {
    display: flex;
    gap: 20px;
    padding: 30px;
    flex-wrap: wrap;
    justify-content: center;
    background-color: #f4f6f9;
  }

  .card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 30px 40px;
    text-align: center;
    flex: 1 1 250px;
    max-width: 300px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
  }

  .card h3 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
  }

  .card p {
    font-size: 32px;
    font-weight: bold;
    color: #007bff;
    margin: 0;
  }
</style>

<div class="dashboard">
  <div class="card">
    <h3>No. of Students</h3>
    <p><?= $student_count ?></p>
  </div>
  <div class="card">
    <h3>No. of Universities</h3>
    <p><?= $university_count ?></p>
  </div>
  <div class="card">
    <h3>No. of Colleges</h3>
    <p><?= $college_count ?></p>
  </div>
</div>

</div> <!-- close content -->
</div> <!-- close main -->
</body>
</html>
