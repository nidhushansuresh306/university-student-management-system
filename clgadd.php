<?php
include('session.php');
include('conn.php');
include('design.php');

$message = "";

$universities = $conn->query("SELECT uname FROM university");
if (!$universities) {
  die("Query failed: " . $conn->error);
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $collegeName = trim($_POST["college_name"]);
  $universityName = trim($_POST["university_name"]);

  if (!empty($collegeName) && !empty($universityName)) {
    $stmt = $conn->prepare("INSERT INTO college (uname, cname) VALUES (?, ?)");
    $stmt->bind_param("ss", $universityName, $collegeName);

    if ($stmt->execute()) {
      $message = "College '$collegeName' added under '$universityName'!";
    } else {
      $message = "Error: " . $conn->error;
    }

    $stmt->close();
  } else {
    $message = "Please fill out all fields.";
  }
}
?>

<div style="margin: 30px auto; max-width: 500px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
  <h2 style="text-align:center; color: #2c3e50;">Add College</h2>

  <?php if ($message): ?>
    <p style="color: green; text-align: center; margin-top: 10px;"><?php echo $message; ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="university_name" style="display:block; margin: 15px 0 5px;">Select University:</label>
    <select name="university_name" id="university_name" required style="width:100%; padding: 10px; border:1px solid #ccc; border-radius: 4px;">
      <option value="">-- Select University --</option>
      <?php while ($row = $universities->fetch_assoc()): ?>
        <option value="<?php echo htmlspecialchars($row['uname']); ?>"><?php echo htmlspecialchars($row['uname']); ?></option>
      <?php endwhile; ?>
    </select>

    <label for="college_name" style="display:block; margin: 15px 0 5px;">College Name:</label>
    <input type="text" name="college_name" id="college_name" required style="width:100%; padding: 10px; border:1px solid #ccc; border-radius: 4px;">

    <input type="submit" value="Add College" style="margin-top: 20px; background-color: #2a5298; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
  </form>
</div>

</div> <!-- close content -->
</div> <!-- close main -->
</body>
</html>
