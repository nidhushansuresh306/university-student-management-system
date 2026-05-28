<?php
include('session.php');
include('conn.php');
include('design.php');

// Fetch university list
$result = $conn->query("SELECT DISTINCT uname FROM university");
?>

<h2 style="text-align:center; margin-bottom: 20px;">Select University</h2>

<form action="clgview2.php" method="GET" style="max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px;">
  <label for="uname" style="display:block; margin-bottom: 8px;">Choose University:</label>
  <select name="uname" id="uname" required style="width:100%; padding: 10px; margin-bottom: 20px;">
    <option value="" disabled selected>Select a university</option>
    <?php while ($row = $result->fetch_assoc()): ?>
      <option value="<?php echo htmlspecialchars($row['uname']); ?>"><?php echo htmlspecialchars($row['uname']); ?></option>
    <?php endwhile; ?>
  </select>
  <input type="submit" value="View Colleges" style="padding: 10px 20px; background-color: #2a5298; color: white; border: none; border-radius: 4px;">
</form>

</div> <!-- close content -->
</div> <!-- close main -->
</body>
</html>
