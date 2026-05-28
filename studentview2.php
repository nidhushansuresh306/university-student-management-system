<?php
include('session.php');
include('conn.php');
include('design.php');

$uname = $_GET['uname'];
$cname = $_GET['cname'];
$dept = $_GET['dept'];

$stmt = $conn->prepare("SELECT name, rollno, email, phone, photo FROM student WHERE uname = ? AND cname = ? AND dept = ?");
$stmt->bind_param("sss", $uname, $cname, $dept);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Custom CSS -->
<style>
.student-table-container {
  max-width: 1000px;
  margin: 40px auto;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.1);
  padding: 30px;
}

.student-table-container h2 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 20px;
  font-weight: bold;
}

.student-table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
}

.student-table thead {
  background-color: #2c3e50;
  color: white;
}

.student-table th, .student-table td {
  padding: 12px 15px;
  border: 1px solid #ccc;
  text-align: center;
}

.student-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.student-table tbody tr:hover {
  background-color: #f1f1f1;
}

.student-photo {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #ddd;
}
</style>

<!-- Student Table -->
<div class="student-table-container">
  <h2>Student Details</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="student-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Roll No</th>
          <th>Email</th>
          <th>Phone No</th>
          <th>Photo</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['rollno']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td>
              <img src="studentuploads/<?= htmlspecialchars($row['photo']) ?>" class="student-photo" alt="Student Photo">
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p style="text-align: center;">No students found for the selected filters.</p>
  <?php endif; ?>
</div>
