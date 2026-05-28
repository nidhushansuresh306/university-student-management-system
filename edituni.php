<?php
ob_start();  // Start output buffering
include('session.php');
include('conn.php');
include('design.php'); // Sidebar + header

// Redirect if no ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: viewuniversity.php");
  exit;
}

$id = intval($_GET['id']);
$message = "";

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $newName = trim($_POST["university_name"]);
  if (!empty($newName)) {
    $stmt = $conn->prepare("UPDATE university SET uname = ? WHERE id = ?");
    $stmt->bind_param("si", $newName, $id);
    if ($stmt->execute()) {
      // Redirect after successful update
      header("Location: uniview.php");
      exit;
    } else {
      $message = "Update failed: " . $conn->error;
    }
    $stmt->close();
  }
}

// Fetch university data
$stmt = $conn->prepare("SELECT uname FROM university WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($universityName);
$stmt->fetch();
$stmt->close();
?>

<div style="margin: 30px auto; max-width: 500px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
  <h2 style="text-align:center; color: #2c3e50;">Edit University</h2>

  <?php if ($message): ?>
    <p style="color: red; text-align: center; margin-top: 10px;"><?php echo $message; ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="university_name" style="display:block; margin: 15px 0 5px;">University Name:</label>
    <input type="text" name="university_name" id="university_name" value="<?php echo htmlspecialchars($universityName); ?>" required style="width:100%; padding: 10px; border:1px solid #ccc; border-radius: 4px;">

    <input type="submit" value="Update" style="margin-top: 20px; background-color: #2a5298; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
  </form>
</div>

</div> <!-- close content -->
</div> <!-- close main -->

<?php
ob_end_flush();  // End output buffering and send output to the browser
?>
</body>
</html>
