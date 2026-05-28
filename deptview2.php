<?php
include('session.php');
include('conn.php');
include('design.php');

$uname = $_GET['uname'] ?? '';
$cname = $_GET['cname'] ?? '';

if (empty($uname) || empty($cname)) {
  echo "<p style='text-align:center; color:red;'>University or College not selected.</p>";
  exit;
}

$stmt = $conn->prepare("SELECT dept FROM department WHERE uname = ? AND cname = ?");
$stmt->bind_param("ss", $uname, $cname);
$stmt->execute();
$result = $stmt->get_result();
?>

<div style="margin: 30px auto; max-width: 800px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
  <h2 style="text-align:center; color: #2c3e50;">Departments under <?php echo htmlspecialchars($cname); ?>, <?php echo htmlspecialchars($uname); ?></h2>
  
  <table style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead>
      <tr style="background-color: #2a5298; color: white;">
        <th style="padding: 10px; border: 1px solid #ccc;">No.</th>
        <th style="padding: 10px; border: 1px solid #ccc;">Department Name</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i = 1;
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td style='text-align:center; border:1px solid #ccc;'>$i</td>";
          echo "<td style='text-align:center; border:1px solid #ccc;'>{$row['dept']}</td>";
          echo "</tr>";
          $i++;
        }
      } else {
        echo "<tr><td colspan='2' style='text-align:center; padding: 10px;'>No departments found.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
