<?php
include('session.php');
include('conn.php');
include('design.php');

// Get the university name from GET request
if (isset($_GET['uname'])) {
    $uname = $_GET['uname'];

    // Sanitize input
    $uname = $conn->real_escape_string($uname);

    // Prepare and execute SQL to fetch colleges
    $stmt = $conn->prepare("SELECT cname FROM college WHERE uname = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Redirect if no university selected
    header("Location: viewcollege_select.php");
    exit();
}
?>

<h2 style="text-align:center; margin-bottom: 20px;">Colleges under <?php echo htmlspecialchars($uname); ?></h2>

<<table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
  <thead style="background-color: #2c3e50; color: white;">
    <tr>
      <th style="padding: 12px; border-right: 1px solid #ddd; text-align: center;">No.</th>
      <th style="padding: 12px; text-align: center;">College Name</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $count = 1;
    if ($result->num_rows > 0): 
      while ($row = $result->fetch_assoc()): 
    ?>
        <tr style="border-bottom: 1px solid #eee;">
          <td style="padding: 12px; border-right: 1px solid #ddd; text-align: center;"><?php echo $count++; ?></td>
          <td style="padding: 12px; text-align: center;"><?php echo htmlspecialchars($row['cname']); ?></td>
        </tr>
    <?php 
      endwhile; 
    else: 
    ?>
      <tr>
        <td colspan="2" style="padding: 20px; text-align:center;">No colleges found under <?php echo htmlspecialchars($uname); ?>.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>


</div> <!-- close content -->
</div> <!-- close main -->
</body>
</html>
