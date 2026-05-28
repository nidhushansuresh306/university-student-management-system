<?php
// Start output buffering to prevent header issues
ob_start();

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include DB connection
include('session.php');
include('conn.php');

// Check database connection
if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

// Handle deletion logic before any HTML output
if (isset($_GET['delete'])) {
    $idToDelete = intval($_GET['delete']);
    $deleteQuery = "DELETE FROM university WHERE id = $idToDelete";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: uniview.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Now load layout
include('design.php');

// Fetch university records
$result = $conn->query("SELECT * FROM university");
?>

<h2 style="text-align:center; margin-bottom: 20px;">View Universities</h2>

<table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
  <thead style="background-color: #2c3e50; color: white;">
    <tr>
      <th style="padding: 12px;">ID</th>
      <th style="padding: 12px;">University Name</th>
      <th style="padding: 12px;">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr style='border-bottom: 1px solid #eee;'>";
            echo "<td style='padding: 12px; text-align: center;'>" . $row['id'] . "</td>";
            echo "<td style='padding: 12px;'>" . htmlspecialchars($row['uname']) . "</td>";
            echo "<td style='padding: 12px; text-align: center;'>
                    <a href='edituni.php?id={$row['id']}' style='color: blue; text-decoration: none; margin-right: 10px;'>Edit</a>
                    <a href='uniview.php?delete={$row['id']}' 
                       style='color: red; text-decoration: none;' 
                       onclick=\"return confirm('Are you sure you want to delete this university?');\">
                       Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' style='padding: 20px; text-align:center;'>No universities found.</td></tr>";
    }
    ?>
  </tbody>
</table>

</div> <!-- close content -->
</div> <!-- close main -->
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();
?>
