<?php
include('session.php');
include('conn.php');
include('design.php');

$uname = $_GET['uname'];
$cname = $_GET['cname'];
$dept = $_GET['dept'];

$stmt = $conn->prepare("SELECT sname, staffid, semail, sphone, sphoto FROM staff WHERE uname = ? AND cname = ? AND dept = ?");
$stmt->bind_param("sss", $uname, $cname, $dept);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Custom CSS -->
<style>
.staff-table-container {
  max-width: 1000px;
  margin: 40px auto;
  background: #ffffff;
  border-radius: 10px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.1);
  padding: 30px;
}

.staff-table-container h2 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 20px;
  font-weight: bold;
}

.staff-table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
}

.staff-table thead {
  background-color: #2c3e50;
  color: white;
}

.staff-table th, .staff-table td {
  padding: 12px 15px;
  border: 1px solid #ccc;
  text-align: center;
}

.staff-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.staff-table tbody tr:hover {
  background-color: #f1f1f1;
}

.staff-photo {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #ddd;
}
</style>

<!-- Staff Table -->
<div class="staff-table-container">
  <h2>Staff Details</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="staff-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Staff ID</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Photo</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['sname']) ?></td>
            <td><?= htmlspecialchars($row['staffid']) ?></td>
            <td><?= htmlspecialchars($row['semail']) ?></td>
            <td><?= htmlspecialchars($row['sphone']) ?></td>
            <td><img src="<?= htmlspecialchars($row['sphoto']) ?>" class="staff-photo" alt="Staff Photo"></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p style="text-align: center;">No staff found for the selected filters.</p>
  <?php endif; ?>
</div>
